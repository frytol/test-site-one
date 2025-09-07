<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\MenuItemRepository;
use App\Repository\HeroRepository;
use App\Repository\CardBlockRepository;
use App\Repository\AccordionBlockRepository;
use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(
        UserRepository $userRepository, 
        MenuItemRepository $menuItemRepository,
        HeroRepository $heroRepository,
        CardBlockRepository $cardBlockRepository,
        AccordionBlockRepository $accordionBlockRepository,
        FaqRepository $faqRepository
    ): Response
    {
        $users = $userRepository->findAll();
        $menuItems = $menuItemRepository->findActiveOrderedByIndex();
        $hero = $heroRepository->findActive();
        $cardBlock = $cardBlockRepository->findActive();
        $accordionBlock = $accordionBlockRepository->findActive();
        $featuredFaqs = $faqRepository->findFeaturedOrderedByIndex();
        
        return $this->render('homepage/index.html.twig', [
            'users' => $users,
            'menu_items' => $menuItems,
            'hero' => $hero,
            'card_block' => $cardBlock,
            'accordion_block' => $accordionBlock,
            'featured_faqs' => $featuredFaqs,
        ]);
    }
}