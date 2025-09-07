<?php

namespace App\Tests\Repository;

use App\Entity\AccordionBlock;
use App\Repository\AccordionBlockRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AccordionBlockRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?AccordionBlockRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(AccordionBlock::class);

        // Clean existing data
        $this->entityManager->createQuery("DELETE FROM App\Entity\AccordionBlock")->execute();
    }

    public function testFindActive(): void
    {
        // Create test accordion blocks
        $activeBlock = new AccordionBlock();
        $activeBlock->setTitle("FAQ Section")
            ->setDescription("Most common questions")
            ->setIsActive(true);

        $inactiveBlock = new AccordionBlock();
        $inactiveBlock->setTitle("Inactive FAQ")
            ->setDescription("Not shown")
            ->setIsActive(false);

        $this->entityManager->persist($activeBlock);
        $this->entityManager->persist($inactiveBlock);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActive();

        $this->assertNotNull($result);
        $this->assertEquals("FAQ Section", $result->getTitle());
        $this->assertTrue($result->isActive());
    }

    public function testFindActiveReturnsNullWhenNoActiveBlock(): void
    {
        // Create only inactive block
        $inactiveBlock = new AccordionBlock();
        $inactiveBlock->setTitle("Inactive FAQ")
            ->setDescription("Not shown")
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
        $block1 = new AccordionBlock();
        $block1->setTitle("FAQ Block 1")
            ->setDescription("Description 1")
            ->setIsActive(true);

        $block2 = new AccordionBlock();
        $block2->setTitle("FAQ Block 2")
            ->setDescription("Description 2")
            ->setIsActive(true);

        // Create inactive block
        $block3 = new AccordionBlock();
        $block3->setTitle("Inactive Block")
            ->setDescription("Not shown")
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
