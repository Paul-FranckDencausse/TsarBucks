<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        // Créer une nouvelle instance de User
        $user = new User();

        // Créer le formulaire et gérer la requête
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // Récupère le mot de passe brut depuis le formulaire
        $plainPassword = $form->get('plainPassword')->getData();

        if ($plainPassword) {
            // Hash le mot de passe
            $user->setPassword(
                $passwordHasher->hashPassword($user, $plainPassword)
            );
        } else {
            throw new \Exception('Password cannot be null.');
        }

            // Enregistrement de l'utilisateur
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection après l'enregistrement
            return $this->redirectToRoute('app_login');
        }

        // Affichage du formulaire
        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
