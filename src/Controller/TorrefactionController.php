<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TorrefactionController extends AbstractController
{
    #[Route('/torrefaction', name: 'app_torrefaction')]
    public function index(): Response
    {
        return $this->render('torrefaction/index.html.twig', [
            'controller_name' => 'TorrefactionController',
        ]);
    }
}
