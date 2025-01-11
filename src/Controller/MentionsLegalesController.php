<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MentionsLegalesController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function index(): Response
    {
        return $this->render('mentions_legales/index.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
    #[Route('/en/legal', name: 'app_legal_english')]
    public function enIndex(): Response
    {
        return $this->render('mentions_legales/english.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
    #[Route('/es/legal', name: 'app_legal_castellano')]
    public function esIndex(): Response
    {
        return $this->render('mentions_legales/castellano.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
    #[Route('/ru/legal', name: 'app_legal_russe')]
    public function ruIndex(): Response
    {
        return $this->render('mentions_legales/russe.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpd(): Response
    {
        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
    #[Route('/en/rgpd', name: 'app_rgpd_english')]
    public function enRgpd(): Response
    {
        return $this->render('rgpd/english.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
    #[Route('/es/rgpd', name: 'app_rgpd_castellano')]
    public function esRgpd(): Response
    {
        return $this->render('rgpd/castellano.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
    #[Route('/ru/rgpd', name: 'app_rgpd_russe')]
    public function ruRgpd(): Response
    {
        return $this->render('rgpd/russe.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('cgu/index.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }
    #[Route('/en/cgu', name: 'app_cgu_english')]
    public function enCgu(): Response
    {
        return $this->render('cgu/english.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }
    #[Route('/es/cgu', name: 'app_cgu_castellano')]
    public function esCgu(): Response
    {
        return $this->render('cgu/castellano.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }
    #[Route('/ru/cgu', name: 'app_cgu_russe')]
    public function ruCgu(): Response
    {
        return $this->render('cgu/russe.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }
    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('cgv/index.html.twig', [
            'controller_name' => 'CgvController',
        ]);
    }
    #[Route('/en/cgv', name: 'app_cgv_english')]
    public function enCgv(): Response
    {
        return $this->render('cgv/english.html.twig', [
            'controller_name' => 'CgvController',
        ]);
    }
    #[Route('/es/cgv', name: 'app_cgv_castellano')]
    public function esCgv(): Response
    {
        return $this->render('cgv/castellano.html.twig', [
            'controller_name' => 'CgvController',
        ]);
    }
    #[Route('/ru/cgv', name: 'app_cgv_russe')]
    public function ruCgv(): Response
    {
        return $this->render('cgv/russe.html.twig', [
            'controller_name' => 'CgvController',
        ]);
    }
}
