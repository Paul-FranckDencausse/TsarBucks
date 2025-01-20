<?php

namespace App\Controller;

use App\Entity\SaloonMenu;
use App\Form\SaloonMenuType;
use App\Repository\SaloonMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/saloon/menu')]
final class SaloonMenuController extends AbstractController
{
    #[Route(name: 'app_saloon_menu_index', methods: ['GET'])]
    public function index(SaloonMenuRepository $saloonMenuRepository): Response
    {
        return $this->render('saloon_menu/index.html.twig', [
            'saloon_menus' => $saloonMenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_saloon_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saloonMenu = new SaloonMenu();
        $form = $this->createForm(SaloonMenuType::class, $saloonMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion du fichier uploadé
            $mediaFile = $form->get('mediaFile')->getData();
            if ($mediaFile) {
                $newFilename = $mediaFile->getClientOriginalName();
                try {
                    $mediaFile->move(
                        $this->getParameter('media_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gestion des erreurs en cas de problème lors du téléversement
                }

                // Stocke le nom du fichier dans l'entité
                $saloonMenu->setImageFilename($newFilename);
            }

            $entityManager->persist($saloonMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_saloon_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saloon_menu/new.html.twig', [
            'saloon_menu' => $saloonMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_saloon_menu_show', methods: ['GET'])]
    public function show(SaloonMenu $saloonMenu): Response
    {
        return $this->render('saloon_menu/show.html.twig', [
            'saloon_menu' => $saloonMenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_saloon_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SaloonMenu $saloonMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SaloonMenuType::class, $saloonMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion du fichier uploadé
            $mediaFile = $form->get('mediaFile')->getData();
            if ($mediaFile) {
                $newFilename = $mediaFile->getClientOriginalName();
                try {
                    $mediaFile->move(
                        $this->getParameter('media_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gestion des erreurs en cas de problème lors du téléversement
                }

                // Met à jour le nom du fichier dans l'entité
                $saloonMenu->setImageFilename($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_saloon_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saloon_menu/edit.html.twig', [
            'saloon_menu' => $saloonMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_saloon_menu_delete', methods: ['POST'])]
    public function delete(Request $request, SaloonMenu $saloonMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saloonMenu->getId(), $request->get('token'))) {
            $entityManager->remove($saloonMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_saloon_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
