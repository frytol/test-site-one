<?php

namespace App\Tests\Repository;

use App\Entity\MenuItem;
use App\Repository\MenuItemRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MenuItemRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?MenuItemRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(MenuItem::class);

        // Clean existing data
        $this->entityManager->createQuery("DELETE FROM App\Entity\MenuItem")->execute();
    }

    public function testFindActiveOrderedByIndex(): void
    {
        // Create test menu items
        $menuItem1 = new MenuItem();
        $menuItem1->setName("Home")
            ->setUrl("/")
            ->setOrderIndex(2)
            ->setTarget("_self")
            ->setIsActive(true);

        $menuItem2 = new MenuItem();
        $menuItem2->setName("About")
            ->setUrl("/about")
            ->setOrderIndex(1)
            ->setTarget("_self")
            ->setIsActive(true);

        $menuItem3 = new MenuItem();
        $menuItem3->setName("Inactive")
            ->setUrl("/inactive")
            ->setOrderIndex(0)
            ->setTarget("_self")
            ->setIsActive(false);

        $this->entityManager->persist($menuItem1);
        $this->entityManager->persist($menuItem2);
        $this->entityManager->persist($menuItem3);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActiveOrderedByIndex();

        $this->assertCount(2, $result);
        $this->assertEquals("About", $result[0]->getName());
        $this->assertEquals("Home", $result[1]->getName());
    }

    public function testFindAllOrderedByIndex(): void
    {
        // Create test menu items
        $menuItem1 = new MenuItem();
        $menuItem1->setName("Third")
            ->setUrl("/third")
            ->setOrderIndex(3)
            ->setTarget("_self")
            ->setIsActive(true);

        $menuItem2 = new MenuItem();
        $menuItem2->setName("First")
            ->setUrl("/first")
            ->setOrderIndex(1)
            ->setTarget("_self")
            ->setIsActive(false);

        $menuItem3 = new MenuItem();
        $menuItem3->setName("Second")
            ->setUrl("/second")
            ->setOrderIndex(2)
            ->setTarget("_blank")
            ->setIsActive(true);

        $this->entityManager->persist($menuItem1);
        $this->entityManager->persist($menuItem2);
        $this->entityManager->persist($menuItem3);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findAllOrderedByIndex();

        $this->assertCount(3, $result);
        $this->assertEquals("First", $result[0]->getName());
        $this->assertEquals("Second", $result[1]->getName());
        $this->assertEquals("Third", $result[2]->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Clean up
        if ($this->entityManager) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }
}
