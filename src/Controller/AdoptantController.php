<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Form\AdoptantType;
use App\Repository\AdoptantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adoptant')]
final class AdoptantController extends AbstractController
{
    #[Route(name: 'app_adoptant_index', methods: ['GET'])]
    public function index(AdoptantRepository $adoptantRepository): Response
    {
        return $this->render('adoptant/index.html.twig', [
            'adoptants' => $adoptantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adoptant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adoptant = new Adoptant();
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adoptant);
            $entityManager->flush();

            return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adoptant/new.html.twig', [
            'adoptant' => $adoptant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adoptant_show', methods: ['GET'])]
    public function show(Adoptant $adoptant): Response
    {
        return $this->render('adoptant/show.html.twig', [
            'adoptant' => $adoptant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adoptant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adoptant $adoptant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adoptant/edit.html.twig', [
            'adoptant' => $adoptant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adoptant_delete', methods: ['POST'])]
    public function delete(Request $request, Adoptant $adoptant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adoptant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($adoptant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
    }
}
