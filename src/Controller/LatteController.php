<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LatteController extends AbstractController
{
    #[Route('/latte', name: 'app_latte')]
    public function index(): Response
    {
        return $this->render('latte/index.html.twig', [
            'controller_name' => 'LatteController',
        ]);
    }
}
