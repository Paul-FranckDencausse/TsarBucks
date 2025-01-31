<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BrunchController extends AbstractController
{
    #[Route('/brunch', name: 'app_brunch')]
    public function index(): Response
    {
        return $this->render('brunch/index.html.twig', [
            'controller_name' => 'BrunchController',
        ]);
    }
}
