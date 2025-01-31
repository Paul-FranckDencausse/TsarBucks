<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BoissonsChaudesController extends AbstractController
{
    #[Route('/boissons/chaudes', name: 'app_boissons_chaudes')]
    public function index(): Response
    {
        return $this->render('boissons_chaudes/index.html.twig', [
            'controller_name' => 'BoissonsChaudesController',
        ]);
    }
}
