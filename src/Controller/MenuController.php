<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SaloonMenuRepository;

class MenuController extends AbstractController
{
   // Dans ton contrôleur
#[Route('/menu', name: 'app_menu_index')]
public function menu(MenuRepository $menuRepo, SaloonMenuRepository $saloonMenuRepo): Response
{
    $menus = $menuRepo->findAll();
    $saloonMenus = $saloonMenuRepo->findAll();

    return $this->render('menu/index.html.twig', [
        'allMenus' => [
            'menus' => $menus,
            'specialties' => $saloonMenus,
        ],
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
