<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FaqController extends AbstractController
{
    #[Route('/{_locale}/faq', name: 'app_faq', requirements: ['_locale' => 'en|es|ru|fr'])]
    public function faq(string $_locale): Response
    {
        $template = match ($_locale) {
            'en' => 'faq/english.html.twig',
            'es' => 'faq/castellano.html.twig',
            'ru' => 'faq/russe.html.twig',
            default => 'faq/index.html.twig', // Français par défaut
        };
    
        return $this->render($template, [
            'controller_name' => 'FaqController',
        ]);
    }
    
}
