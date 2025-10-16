<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aliment')]
final class AlimentController extends AbstractController
{
    #[Route(name: 'app_aliment_index', methods: ['GET'])]
    public function index(AlimentRepository $alimentRepository): Response
    {
        return $this->render('aliment/index.html.twig', [
            'aliments' => $alimentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_aliment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aliment = new Aliment();
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aliment);
            $entityManager->flush();

            return $this->redirectToRoute('app_aliment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment/new.html.twig', [
            'aliment' => $aliment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aliment_show', methods: ['GET'])]
    public function show(Aliment $aliment): Response
    {
        return $this->render('aliment/show.html.twig', [
            'aliment' => $aliment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_aliment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_aliment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment/edit.html.twig', [
            'aliment' => $aliment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aliment_delete', methods: ['POST'])]
    public function delete(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aliment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($aliment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_aliment_index', [], Response::HTTP_SEE_OTHER);
    }
}
