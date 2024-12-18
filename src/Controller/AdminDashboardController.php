<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\SaloonsRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(
        UserRepository $userRepository,
        SaloonsRepository $saloonsRepository,
        ContactRepository $contactRepository
    ): Response {
        // Récupérer les statistiques des utilisateurs
        $totalUsers = $userRepository->countAllUsers();

        // Récupérer les statistiques des salons
        $totalSaloons = $saloonsRepository->countAllSaloons();

        // Récupérer les statistiques des demandes de contact
        $totalContacts = $contactRepository->countAllContacts();
       
        // Rendre la vue avec les statistiques
        return $this->render('admin_dashboard/index.html.twig', [
            'totalUsers' => $totalUsers,
            'totalSaloons' => $totalSaloons,
            'totalContacts' => $totalContacts,
           
        ]);
    }
}
