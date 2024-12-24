<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SalonsController extends AbstractController
{
    #[Route('/salons', name: 'app_salons')]
    public function index(): Response
    {
        return $this->render('salons/index.html.twig', [
            'controller_name' => 'SalonsController',
        ]);
    }
    #[Route('/stalingrad', name: 'app_stalingrad')]
    public function stalingrad(): Response
    {
        return $this->render('stalingrad/index.html.twig', [
            'controller_name' => 'StalingradController',
        ]);
    }
    #[Route('/en/stalingrad', name: 'app_stalingrad_english')]
    public function enStalingrad(): Response
    {
        return $this->render('stalingrad/english.html.twig', [
            'controller_name' => 'StalingradController',
        ]);
    }
    #[Route('/es/stalingrad', name: 'app_stalingrad_castellano')]
    public function caStalingrad(): Response
    {
        return $this->render('stalingrad/castellano.html.twig', [
            'controller_name' => 'StalingradController',
        ]);
    }
    #[Route('/ru/stalingrad', name: 'app_stalingrad_russe')]
    public function ruStalingrad(): Response
    {
        return $this->render('stalingrad/russe.html.twig', [
            'controller_name' => 'StalingradController',
        ]);
    }
    #[Route('/anastasia', name: 'app_anastasia')]
    public function anastasia(): Response
    {
        return $this->render('anastasia/index.html.twig', [
            'controller_name' => 'AnastasiaController',
        ]);
    }
    #[Route('/en/anastasia', name: 'app_anastasia_english')]
    public function enAnastasia(): Response
    {
        return $this->render('anastasia/english.html.twig', [
            'controller_name' => 'AnastasiaController',
        ]);
    }
    #[Route('/es/anastasia', name: 'app_anastasia_castellano')]
    public function esAnastasia(): Response
    {
        return $this->render('anastasia/castellano.html.twig', [
            'controller_name' => 'AnastasiaController',
        ]);
    }
    #[Route('/catherine', name: 'app_catherine')]
    public function catherine(): Response
    {
        return $this->render('catherine/index.html.twig', [
            'controller_name' => 'CatherineController',
        ]);
    }

    #[Route('/ru/catherine', name: 'app_catherine_russe')]
    public function ruCatherine(): Response
    {
        return $this->render('catherine/russe.html.twig', [
            'controller_name' => 'CatherineController',
        ]);
    }

    #[Route('/ivan', name: 'app_ivan')]
    public function ivan(): Response
    {
        return $this->render('ivan/index.html.twig', [
            'controller_name' => 'IvanController',
        ]);
    }

    #[Route('/en/ivan', name: 'app_ivan_english')]
    public function enIvan(): Response
    {
        return $this->render('ivan/english.html.twig', [
            'controller_name' => 'IvanController',
        ]);
    }

    #[Route('/es/ivan', name: 'app_ivan_castellano')]
    public function esIvan(): Response
    {
        return $this->render('ivan/castellano.html.twig', [
            'controller_name' => 'IvanController',
        ]);
    }

    #[Route('/ru/ivan', name: 'app_ivan_russe')]
    public function ruIvan(): Response
    {
        return $this->render('ivan/russe.html.twig', [
            'controller_name' => 'IvanController',
        ]);
    }

    #[Route('/pierre', name: 'app_pierre')]
    public function pierre(): Response
    {
        return $this->render('pierre/index.html.twig', [
            'controller_name' => 'PierreController',
        ]);
    }

    #[Route('/en/pierre', name: 'app_pierre_english')]
    public function enPierre(): Response
    {
        return $this->render('pierre/english.html.twig', [
            'controller_name' => 'PierreController',
        ]);
    }

    #[Route('/es/pierre', name: 'app_pierre_castellano')]
    public function esPierre(): Response
    {
        return $this->render('pierre/castellano.html.twig', [
            'controller_name' => 'PierreController',
        ]);
    }

    #[Route('/ru/pierre', name: 'app_pierre_russe')]
    public function ruPierre(): Response
    {
        return $this->render('pierre/russe.html.twig', [
            'controller_name' => 'PierreController',
        ]);
    }

    #[Route('/raspoutine', name: 'app_raspoutine')]
    public function raspoutine(): Response
    {
        return $this->render('raspoutine/index.html.twig', [
            'controller_name' => 'RaspoutineController',
        ]);
    }

    #[Route('/en/raspoutine', name: 'app_raspoutine_english')]
    public function enRaspoutine(): Response
    {
        return $this->render('raspoutine/english.html.twig', [
            'controller_name' => 'RaspoutineController',
        ]);
    }

    #[Route('/es/raspoutine', name: 'app_raspoutine_castellano')]
    public function esRaspoutine(): Response
    {
        return $this->render('raspoutine/castellano.html.twig', [
            'controller_name' => 'RaspoutineController',
        ]);
    }

    #[Route('/ru/raspoutine', name: 'app_raspoutine_russe')]
    public function ruRaspoutine(): Response
    {
        return $this->render('raspoutine/russe.html.twig', [
            'controller_name' => 'RaspoutineController',
        ]);
    }
}