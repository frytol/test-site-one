<?php

namespace App\Tests\Repository;

use App\Entity\Card;
use App\Entity\CardBlock;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?CardRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(Card::class);

        // Clean existing data
        $this->entityManager->createQuery("DELETE FROM App\Entity\Card")->execute();
        $this->entityManager->createQuery("DELETE FROM App\Entity\CardBlock")->execute();
    }

    public function testFindActiveOrderedByIndex(): void
    {
        // Create card block
        $cardBlock = new CardBlock();
        $cardBlock->setTitle("Test Block");

        // Create cards with different order
        $card1 = new Card();
        $card1->setImage("card1.jpg")
            ->setTitle("Card 1")
            ->setText("Text 1")
            ->setLinkUrl("https://example.com/1")
            ->setOrderIndex(2)
            ->setIsActive(true)
            ->setCardBlock($cardBlock);

        $card2 = new Card();
        $card2->setImage("card2.jpg")
            ->setTitle("Card 2")
            ->setText("Text 2")
            ->setLinkUrl("https://example.com/2")
            ->setOrderIndex(1)
            ->setIsActive(true)
            ->setCardBlock($cardBlock);

        $card3 = new Card();
        $card3->setImage("card3.jpg")
            ->setTitle("Inactive Card")
            ->setText("Text 3")
            ->setLinkUrl("https://example.com/3")
            ->setOrderIndex(0)
            ->setIsActive(false)
            ->setCardBlock($cardBlock);

        $this->entityManager->persist($cardBlock);
        $this->entityManager->persist($card1);
        $this->entityManager->persist($card2);
        $this->entityManager->persist($card3);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActiveOrderedByIndex();

        $this->assertCount(2, $result);
        $this->assertEquals("Card 2", $result[0]->getTitle());
        $this->assertEquals("Card 1", $result[1]->getTitle());
    }

    public function testFindByCardBlockOrderedByIndex(): void
    {
        // Create two card blocks
        $cardBlock1 = new CardBlock();
        $cardBlock1->setTitle("Block 1");

        $cardBlock2 = new CardBlock();
        $cardBlock2->setTitle("Block 2");

        // Create cards for block 1
        $card1 = new Card();
        $card1->setImage("card1.jpg")
            ->setTitle("Block1 Card1")
            ->setText("Text 1")
            ->setLinkUrl("https://example.com/1")
            ->setOrderIndex(2)
            ->setIsActive(true)
            ->setCardBlock($cardBlock1);

        $card2 = new Card();
        $card2->setImage("card2.jpg")
            ->setTitle("Block1 Card2")
            ->setText("Text 2")
            ->setLinkUrl("https://example.com/2")
            ->setOrderIndex(1)
            ->setIsActive(true)
            ->setCardBlock($cardBlock1);

        // Create card for block 2
        $card3 = new Card();
        $card3->setImage("card3.jpg")
            ->setTitle("Block2 Card1")
            ->setText("Text 3")
            ->setLinkUrl("https://example.com/3")
            ->setOrderIndex(1)
            ->setIsActive(true)
            ->setCardBlock($cardBlock2);

        $this->entityManager->persist($cardBlock1);
        $this->entityManager->persist($cardBlock2);
        $this->entityManager->persist($card1);
        $this->entityManager->persist($card2);
        $this->entityManager->persist($card3);
        $this->entityManager->flush();

        // Test the method for block 1
        $result = $this->repository->findByCardBlockOrderedByIndex($cardBlock1->getId());

        $this->assertCount(2, $result);
        $this->assertEquals("Block1 Card2", $result[0]->getTitle());
        $this->assertEquals("Block1 Card1", $result[1]->getTitle());

        // Test the method for block 2
        $result2 = $this->repository->findByCardBlockOrderedByIndex($cardBlock2->getId());

        $this->assertCount(1, $result2);
        $this->assertEquals("Block2 Card1", $result2[0]->getTitle());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if ($this->entityManager) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }
}
