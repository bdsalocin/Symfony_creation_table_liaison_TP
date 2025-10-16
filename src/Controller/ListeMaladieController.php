<?php

namespace App\Controller;

use App\Entity\ListeMaladie;
use App\Form\ListeMaladieType;
use App\Repository\ListeMaladieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/liste/maladie')]
final class ListeMaladieController extends AbstractController
{
    #[Route(name: 'app_liste_maladie_index', methods: ['GET'])]
    public function index(ListeMaladieRepository $listeMaladieRepository): Response
    {
        return $this->render('liste_maladie/index.html.twig', [
            'liste_maladies' => $listeMaladieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liste_maladie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listeMaladie = new ListeMaladie();
        $form = $this->createForm(ListeMaladieType::class, $listeMaladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listeMaladie);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_maladie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_maladie/new.html.twig', [
            'liste_maladie' => $listeMaladie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_maladie_show', methods: ['GET'])]
    public function show(ListeMaladie $listeMaladie): Response
    {
        return $this->render('liste_maladie/show.html.twig', [
            'liste_maladie' => $listeMaladie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_maladie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListeMaladie $listeMaladie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeMaladieType::class, $listeMaladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_maladie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_maladie/edit.html.twig', [
            'liste_maladie' => $listeMaladie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_maladie_delete', methods: ['POST'])]
    public function delete(Request $request, ListeMaladie $listeMaladie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeMaladie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($listeMaladie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_maladie_index', [], Response::HTTP_SEE_OTHER);
    }
}
