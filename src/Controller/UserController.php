<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $sort = $request->query->get('sort', 'id'); // Par défaut, trier par 'id'
        $order = $request->query->get('order', 'asc'); // Par défaut, trier en ordre croissant
    
        $users = $userRepository->findAllSorted($sort, $order);
    
        return $this->render('user/index.html.twig', [
            'users' => $users,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET', 'POST'])]
public function show(Request $request, User $user, EntityManagerInterface $entityManager): Response
{$form = $this->createFormBuilder($user)
    ->add('roles', ChoiceType::class, [
        'choices' => [
            'Super Admin' => 'ROLE_SUPER_ADMIN',
            'Salon Manager  Stalingrad' => 'ROLE_MANAGER_STALINGRAD',
            'Salon Manager Catherine' => 'ROLE_MANAGER_CATHERINE',
            'Salon Manager URSS' => 'ROLE_MANAGER_URSS',
            'Salon Manager Ivan' => 'ROLE_MANAGER_IVAN',
            'Salon Manager  Anastasia' => 'ROLE_MANAGER_ANASTASIA',
            'Salon Manager Raspoutine' => 'ROLE_MANAGER_RASPOUTINE',
        ],
        'expanded' => true, // Affiche comme des cases à cocher
        'multiple' => true, // Permet de sélectionner plusieurs rôles
    ])
    ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Les rôles ont été mis à jour avec succès.');
        return $this->redirectToRoute('app_user_show', ['id' => $user->getId()]);
    }

    return $this->render('user/show.html.twig', [
        'user' => $user,
        'form' => $form->createView(), // Transmettre le formulaire à la vue
    ]);
}


    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($user)
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                    'Admin' => 'ROLE_ADMIN',
                    'Manager Stalingrad' => 'ROLE_MANAGER_STALINGRAD',
                    'Manager Catherine' => 'ROLE_MANAGER_CATHERINE',
                    'Manager URSS' => 'ROLE_MANAGER_URSS',
                    'Manager Ivan' => 'ROLE_MANAGER_IVAN',
                    'Manager Anastasia' => 'ROLE_MANAGER_ANASTASIA',
                    'Manager Raspoutine' => 'ROLE_MANAGER_RASPOUTINE',

                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

  
}
