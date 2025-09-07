<?php

namespace App\Controller;

use App\Repository\FaqCategoryRepository;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/faq')]
class FaqController extends AbstractController
{
    public function __construct(
        private FaqRepository $faqRepository,
        private FaqCategoryRepository $categoryRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('', name: 'app_faq_index')]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findActiveOrderedByIndex();
        $faqs = $this->faqRepository->findActiveOrderedByIndex();
        $popularFaqs = $this->faqRepository->findMostViewed(5);

        return $this->render('faq/index.html.twig', [
            'categories' => $categories,
            'faqs' => $faqs,
            'popularFaqs' => $popularFaqs,
        ]);
    }

    #[Route('/kategorie/{slug}', name: 'app_faq_category')]
    public function category(string $slug): Response
    {
        $category = $this->categoryRepository->findBySlug($slug);
        
        if (!$category) {
            throw $this->createNotFoundException('Kategorie nebyla nalezena.');
        }

        $faqs = $this->faqRepository->findByCategoryOrderedByIndex($category);

        return $this->render('faq/category.html.twig', [
            'category' => $category,
            'faqs' => $faqs,
        ]);
    }

    #[Route('/{slug}', name: 'app_faq_show')]
    public function show(string $slug): Response
    {
        $faq = $this->faqRepository->findBySlug($slug);
        
        if (!$faq) {
            throw $this->createNotFoundException('FAQ položka nebyla nalezena.');
        }

        // Zvýšení počtu zobrazení
        $faq->incrementViewCount();
        $this->entityManager->flush();

        return $this->render('faq/show.html.twig', [
            'faq' => $faq,
        ]);
    }
}