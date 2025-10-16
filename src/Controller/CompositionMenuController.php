<?php

namespace App\Controller;

use App\Entity\CompositionMenu;
use App\Form\CompositionMenuType;
use App\Repository\CompositionMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/composition/menu')]
final class CompositionMenuController extends AbstractController
{
    #[Route(name: 'app_composition_menu_index', methods: ['GET'])]
    public function index(CompositionMenuRepository $compositionMenuRepository): Response
    {
        return $this->render('composition_menu/index.html.twig', [
            'composition_menus' => $compositionMenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_composition_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compositionMenu = new CompositionMenu();
        $form = $this->createForm(CompositionMenuType::class, $compositionMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compositionMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_composition_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('composition_menu/new.html.twig', [
            'composition_menu' => $compositionMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composition_menu_show', methods: ['GET'])]
    public function show(CompositionMenu $compositionMenu): Response
    {
        return $this->render('composition_menu/show.html.twig', [
            'composition_menu' => $compositionMenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_composition_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompositionMenu $compositionMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompositionMenuType::class, $compositionMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_composition_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('composition_menu/edit.html.twig', [
            'composition_menu' => $compositionMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composition_menu_delete', methods: ['POST'])]
    public function delete(Request $request, CompositionMenu $compositionMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compositionMenu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($compositionMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_composition_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
