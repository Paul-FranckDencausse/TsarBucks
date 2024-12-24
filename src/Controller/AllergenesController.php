<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AllergenesController extends AbstractController
{
    #[Route('/allergenes', name: 'app_allergenes')]
    public function index(): Response
    {
        return $this->render('allergenes/index.html.twig', [
            'controller_name' => 'AllergenesController',
        ]);
    }
}
