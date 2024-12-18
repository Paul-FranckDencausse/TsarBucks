<?php

namespace App\Controller;

use App\Entity\Saloons;
use App\Form\SaloonsType;
use App\Repository\SaloonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/saloons')]
final class AdminSaloonsController extends AbstractController
{
    #[Route(name: 'app_admin_saloons_index', methods: ['GET'])]
    public function index(SaloonsRepository $saloonsRepository): Response
    {
        return $this->render('admin_saloons/index.html.twig', [
            'saloons' => $saloonsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_saloons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saloon = new Saloons();
        $form = $this->createForm(SaloonsType::class, $saloon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($saloon);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_saloons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_saloons/new.html.twig', [
            'saloon' => $saloon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_saloons_show', methods: ['GET'])]
    public function show(Saloons $saloon): Response
    {
        return $this->render('admin_saloons/show.html.twig', [
            'saloon' => $saloon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_saloons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Saloons $saloon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SaloonsType::class, $saloon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_saloons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_saloons/edit.html.twig', [
            'saloon' => $saloon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_saloons_delete', methods: ['POST'])]
    public function delete(Request $request, Saloons $saloon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saloon->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($saloon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_saloons_index', [], Response::HTTP_SEE_OTHER);
    }
}
