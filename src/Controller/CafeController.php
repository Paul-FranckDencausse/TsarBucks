<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CafeController extends AbstractController
{
    #[Route('/cafe', name: 'app_cafe')]
    public function index(): Response
    {
        return $this->render('cafe/index.html.twig', [
            'controller_name' => 'CafeController',
        ]);
    }
}
