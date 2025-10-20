<?php

namespace App\Controller;

use App\Entity\Comportement;
use App\Form\ComportementType;
use App\Repository\ComportementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comportement')]
final class ComportementController extends AbstractController
{
    #[Route(name: 'app_comportement_index', methods: ['GET'])]
    public function index(ComportementRepository $comportementRepository): Response
    {
        return $this->render('comportement/index.html.twig', [
            'comportements' => $comportementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comportement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comportement = new Comportement();
        $form = $this->createForm(ComportementType::class, $comportement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comportement);
            $entityManager->flush();

            return $this->redirectToRoute('app_comportement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comportement/new.html.twig', [
            'comportement' => $comportement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comportement_show', methods: ['GET'])]
    public function show(Comportement $comportement): Response
    {
        return $this->render('comportement/show.html.twig', [
            'comportement' => $comportement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comportement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comportement $comportement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ComportementType::class, $comportement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_comportement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comportement/edit.html.twig', [
            'comportement' => $comportement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comportement_delete', methods: ['POST'])]
    public function delete(Request $request, Comportement $comportement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comportement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($comportement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_comportement_index', [], Response::HTTP_SEE_OTHER);
    }
}
