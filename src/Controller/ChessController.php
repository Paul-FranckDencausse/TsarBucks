<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ChessController extends AbstractController
{
    #[Route('/chess', name: 'app_chess')]
    public function index(): Response
    {
        return $this->render('chess/index.html.twig', [
            'controller_name' => 'ChessController',
        ]);
    }
}
