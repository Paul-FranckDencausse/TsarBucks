<?php


namespace App\Controller;

use App\Repository\UserActivityRepository; // Le repository pour les activités
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;

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
    #[Route('/{id}/changePassword', name: 'app_change_password')]
    public function changePassword(
        Request $request,
        EntityManagerInterface $entityManager,
        int $id // Identifiant de l'utilisateur
    ): Response {
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'utilisateur à partir de l'ID
            $userRepository = $entityManager->getRepository(\App\Entity\User::class);
            $User = $userRepository->find($id);
    
            if (!$User) {
                throw $this->createNotFoundException('Utilisateur non trouvé.');
            }
    
            // Vérification et mise à jour des mots de passe
            $newPassword = $form->get('newPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();
    
            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les nouveaux mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_change_password', ['id' => $id]);
            }
    
            $User->setPassword($newPassword);
            $entityManager->flush();
    
            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
            return $this->redirectToRoute('app_home'); // Rediriger après succès
        }
    
        return $this->render('user/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
