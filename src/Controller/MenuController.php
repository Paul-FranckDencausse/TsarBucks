<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu_index')]
    public function index(): Response
    {
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

    #[Route('/ruMenu', name: 'app_menu_russian')]
    public function russian(): Response
    {
        return $this->render('menu/russian.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
    #[Route('/enMenu', name: 'app_menu_english')]
    public function english(): Response
    {
        return $this->render('menu/englishMenu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
    #[Route('/esMenu', name: 'app_menu_castellano')]
    public function castellano(): Response
    {
        return $this->render('menu/castellanoMenu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
