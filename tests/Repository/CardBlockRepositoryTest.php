<?php

namespace App\Tests\Repository;

use App\Entity\CardBlock;
use App\Entity\Card;
use App\Repository\CardBlockRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardBlockRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?CardBlockRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(CardBlock::class);

        // Clean existing data
        $this->entityManager->createQuery("DELETE FROM App\Entity\Card")->execute();
        $this->entityManager->createQuery("DELETE FROM App\Entity\CardBlock")->execute();
    }

    public function testFindActive(): void
    {
        // Create test card block
        $cardBlock = new CardBlock();
        $cardBlock->setTitle("Active Block")
            ->setIsActive(true);

        $card1 = new Card();
        $card1->setImage("card1.jpg")
            ->setTitle("Card 1")
            ->setText("Card 1 text")
            ->setLinkUrl("https://example.com")
            ->setOrderIndex(1)
            ->setIsActive(true);

        $cardBlock->addCard($card1);

        // Create inactive block
        $inactiveBlock = new CardBlock();
        $inactiveBlock->setTitle("Inactive Block")
            ->setIsActive(false);

        $this->entityManager->persist($cardBlock);
        $this->entityManager->persist($card1);
        $this->entityManager->persist($inactiveBlock);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActive();

        $this->assertNotNull($result);
        $this->assertEquals("Active Block", $result->getTitle());
        $this->assertTrue($result->isActive());
        $this->assertCount(1, $result->getCards());
    }

    public function testFindActiveReturnsNullWhenNoActiveBlock(): void
    {
        // Create only inactive block
        $inactiveBlock = new CardBlock();
        $inactiveBlock->setTitle("Inactive Block")
            ->setIsActive(false);

        $this->entityManager->persist($inactiveBlock);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActive();

        $this->assertNull($result);
    }

    public function testFindAllActive(): void
    {
        // Create active blocks
        $block1 = new CardBlock();
        $block1->setTitle("Block 1")
            ->setIsActive(true);

        $block2 = new CardBlock();
        $block2->setTitle("Block 2")
            ->setIsActive(true);

        // Create inactive block
        $block3 = new CardBlock();
        $block3->setTitle("Inactive Block")
            ->setIsActive(false);

        $this->entityManager->persist($block1);
        $this->entityManager->persist($block2);
        $this->entityManager->persist($block3);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findAllActive();

        $this->assertCount(2, $result);
        $this->assertTrue($result[0]->isActive());
        $this->assertTrue($result[1]->isActive());
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
