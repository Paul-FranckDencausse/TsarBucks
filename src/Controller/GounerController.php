<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GounerController extends AbstractController
{
    #[Route('/gouner', name: 'app_gouner')]
    public function index(): Response
    {
        return $this->render('gouner/index.html.twig', [
            'controller_name' => 'GounerController',
        ]);
    }
}
