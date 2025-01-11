<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu_index')]
    public function index(MenuRepository $menuRepository): Response
    {
        // Récupérer tous les éléments du menu depuis la base de données
        $menus = $menuRepository->findAll();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/ruMenu', name: 'app_menu_russian')]
    public function russian(MenuRepository $menuRepository): Response
    {
        // Récupérer tous les éléments du menu pour la version russe
        $menus = $menuRepository->findAll();

        return $this->render('menu/russian.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/enMenu', name: 'app_menu_english')]
    public function english(MenuRepository $menuRepository): Response
    {
        // Récupérer tous les éléments du menu pour la version anglaise
        $menus = $menuRepository->findAll();

        return $this->render('menu/englishMenu.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/esMenu', name: 'app_menu_castellano')]
    public function castellano(MenuRepository $menuRepository): Response
    {
        // Récupérer tous les éléments du menu pour la version espagnole
        $menus = $menuRepository->findAll();

        return $this->render('menu/castellanoMenu.html.twig', [
            'menus' => $menus,
        ]);
    }
}
