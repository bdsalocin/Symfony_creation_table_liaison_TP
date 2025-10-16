<?php

namespace App\Controller;

use App\Entity\Ordre;
use App\Form\OrdreType;
use App\Repository\OrdreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ordre')]
final class OrdreController extends AbstractController
{
    #[Route(name: 'app_ordre_index', methods: ['GET'])]
    public function index(OrdreRepository $ordreRepository): Response
    {
        return $this->render('ordre/index.html.twig', [
            'ordres' => $ordreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ordre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ordre = new Ordre();
        $form = $this->createForm(OrdreType::class, $ordre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ordre);
            $entityManager->flush();

            return $this->redirectToRoute('app_ordre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordre/new.html.twig', [
            'ordre' => $ordre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordre_show', methods: ['GET'])]
    public function show(Ordre $ordre): Response
    {
        return $this->render('ordre/show.html.twig', [
            'ordre' => $ordre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ordre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ordre $ordre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrdreType::class, $ordre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ordre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordre/edit.html.twig', [
            'ordre' => $ordre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordre_delete', methods: ['POST'])]
    public function delete(Request $request, Ordre $ordre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ordre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ordre_index', [], Response::HTTP_SEE_OTHER);
    }
}
