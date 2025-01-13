<?php

namespace App\Controller;

use App\Repository\UserActivityRepository; // Le repository pour les activités
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_user_dashboard')]
    public function index(UserActivityRepository $userActivityRepository): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder au tableau de bord.');
        }

        // Récupérer les 10 dernières activités de l'utilisateur
        $activities = $userActivityRepository->findBy(
            ['user' => $user],
            ['createdAt' => 'DESC'],
            10
        );

        // Récupérer le rôle principal de l'utilisateur
        $role = $user->getRoles()[0];

        // Passer les données à la vue
        return $this->render('user_dashboard/index.html.twig', [
            'user' => $user,
            'role' => $role,
            'activities' => $activities,
        ]);
    }
}
