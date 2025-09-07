<?php

namespace App\Tests\Repository;

use App\Entity\Faq;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FaqRepositoryFeaturedTest extends KernelTestCase
{
    private ?EntityManager $entityManager = null;
    private ?FaqRepository $repository = null;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get("doctrine")
            ->getManager();

        $this->repository = $this->entityManager->getRepository(Faq::class);

        // Clean existing data (clean FAQs and categories)
        $this->entityManager->createQuery("DELETE FROM App\Entity\Faq")->execute();
    }

    public function testFindFeaturedOrderedByIndex(): void
    {
        // Create featured FAQs
        $faq1 = new Faq();
        $faq1->setQuestion("Featured Question 1")
            ->setAnswer("Answer 1")
            ->setSlug("featured-1")
            ->setOrderIndex(2)
            ->setIsActive(true)
            ->setIsFeatured(true);

        $faq2 = new Faq();
        $faq2->setQuestion("Featured Question 2")
            ->setAnswer("Answer 2")
            ->setSlug("featured-2")
            ->setOrderIndex(1)
            ->setIsActive(true)
            ->setIsFeatured(true);

        // Create non-featured FAQ
        $faq3 = new Faq();
        $faq3->setQuestion("Regular Question")
            ->setAnswer("Answer 3")
            ->setSlug("regular-1")
            ->setOrderIndex(0)
            ->setIsActive(true)
            ->setIsFeatured(false);

        // Create inactive featured FAQ
        $faq4 = new Faq();
        $faq4->setQuestion("Inactive Featured")
            ->setAnswer("Answer 4")
            ->setSlug("inactive-1")
            ->setOrderIndex(3)
            ->setIsActive(false)
            ->setIsFeatured(true);

        $this->entityManager->persist($faq1);
        $this->entityManager->persist($faq2);
        $this->entityManager->persist($faq3);
        $this->entityManager->persist($faq4);
        $this->entityManager->flush();

        // Test the method
        $result = $this->repository->findFeaturedOrderedByIndex();

        $this->assertCount(2, $result);
        $this->assertEquals("Featured Question 2", $result[0]->getQuestion());
        $this->assertEquals("Featured Question 1", $result[1]->getQuestion());
        $this->assertTrue($result[0]->isFeatured());
        $this->assertTrue($result[1]->isFeatured());
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
