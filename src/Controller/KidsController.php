<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class KidsController extends AbstractController
{
    #[Route('/kids', name: 'app_kids')]
    public function index(): Response
    {
        return $this->render('kids/index.html.twig', [
            'controller_name' => 'KidsController',
        ]);
    }
}
