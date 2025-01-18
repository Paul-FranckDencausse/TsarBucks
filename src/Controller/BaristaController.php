<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BaristaController extends AbstractController
{
    #[Route('/barista', name: 'app_barista')]
    public function index(): Response
    {
        return $this->render('barista/index.html.twig', [
            'controller_name' => 'BaristaController',
        ]);
    }
}
