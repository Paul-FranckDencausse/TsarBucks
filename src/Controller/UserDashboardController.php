<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_user_dashboard')]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        
        $role = $user->getRoles()[0]; // Exemple de récupération du rôle de l'utilisateur

        // Passer les données à la vue
        return $this->render('user_dashboard/index.html.twig', [
            'user' => $user,
         
            'role' => $role,
        ]);
    }
}
