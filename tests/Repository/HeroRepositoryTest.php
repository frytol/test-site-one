<?php

namespace App\Tests\Repository;

use App\Entity\Hero;
use App\Repository\HeroRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HeroRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?HeroRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(Hero::class);

        // Clean existing data
        $this->entityManager->createQuery("DELETE FROM App\Entity\Hero")->execute();
    }

    public function testFindActive(): void
    {
        // Create test heroes
        $hero1 = new Hero();
        $hero1->setBackgroundImage("hero1.jpg")
            ->setTitle("Active Hero")
            ->setText("This is an active hero")
            ->setIsActive(true);

        $hero2 = new Hero();
        $hero2->setBackgroundImage("hero2.jpg")
            ->setTitle("Inactive Hero")
            ->setText("This is an inactive hero")
            ->setIsActive(false);

        $this->entityManager->persist($hero1);
        $this->entityManager->persist($hero2);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActive();

        $this->assertNotNull($result);
        $this->assertEquals("Active Hero", $result->getTitle());
        $this->assertTrue($result->isActive());
    }

    public function testFindActiveReturnsNullWhenNoActiveHero(): void
    {
        // Create only inactive hero
        $hero = new Hero();
        $hero->setBackgroundImage("hero.jpg")
            ->setTitle("Inactive Hero")
            ->setText("This is an inactive hero")
            ->setIsActive(false);

        $this->entityManager->persist($hero);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findActive();

        $this->assertNull($result);
    }

    public function testFindAllActive(): void
    {
        // Create test heroes
        $hero1 = new Hero();
        $hero1->setBackgroundImage("hero1.jpg")
            ->setTitle("Hero 1")
            ->setText("Active hero 1")
            ->setIsActive(true);

        $hero2 = new Hero();
        $hero2->setBackgroundImage("hero2.jpg")
            ->setTitle("Hero 2")
            ->setText("Active hero 2")
            ->setIsActive(true);

        $hero3 = new Hero();
        $hero3->setBackgroundImage("hero3.jpg")
            ->setTitle("Inactive Hero")
            ->setText("Inactive hero")
            ->setIsActive(false);

        $this->entityManager->persist($hero1);
        $this->entityManager->persist($hero2);
        $this->entityManager->persist($hero3);
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
