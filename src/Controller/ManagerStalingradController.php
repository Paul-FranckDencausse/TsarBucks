<?php

namespace App\Controller;

use App\Entity\Stalingrad;
use App\Form\StalingradType;
use App\Repository\StalingradRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/manager/stalingrad')]
final class ManagerStalingradController extends AbstractController
{
    #[Route(name: 'app_manager_stalingrad_index', methods: ['GET'])]
    public function index(StalingradRepository $stalingradRepository): Response
    {
        return $this->render('manager_stalingrad/index.html.twig', [
            'stalingrads' => $stalingradRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_manager_stalingrad_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stalingrad = new Stalingrad();
        $form = $this->createForm(StalingradType::class, $stalingrad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stalingrad);
            $entityManager->flush();

            return $this->redirectToRoute('app_manager_stalingrad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('manager_stalingrad/new.html.twig', [
            'stalingrad' => $stalingrad,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_manager_stalingrad_show', methods: ['GET'])]
    public function show(Stalingrad $stalingrad): Response
    {
        return $this->render('manager_stalingrad/show.html.twig', [
            'stalingrad' => $stalingrad,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_manager_stalingrad_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stalingrad $stalingrad, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StalingradType::class, $stalingrad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_manager_stalingrad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('manager_stalingrad/edit.html.twig', [
            'stalingrad' => $stalingrad,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_manager_stalingrad_delete', methods: ['POST'])]
    public function delete(Request $request, Stalingrad $stalingrad, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stalingrad->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($stalingrad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_manager_stalingrad_index', [], Response::HTTP_SEE_OTHER);
    }
}
