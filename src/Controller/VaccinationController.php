<?php

namespace App\Controller;

use App\Entity\Vaccination;
use App\Form\VaccinationType;
use App\Repository\VaccinationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vaccination')]
final class VaccinationController extends AbstractController
{
    #[Route(name: 'app_vaccination_index', methods: ['GET'])]
    public function index(VaccinationRepository $vaccinationRepository): Response
    {
        return $this->render('vaccination/index.html.twig', [
            'vaccinations' => $vaccinationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vaccination_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vaccination = new Vaccination();
        $form = $this->createForm(VaccinationType::class, $vaccination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vaccination);
            $entityManager->flush();

            return $this->redirectToRoute('app_vaccination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vaccination/new.html.twig', [
            'vaccination' => $vaccination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vaccination_show', methods: ['GET'])]
    public function show(Vaccination $vaccination): Response
    {
        return $this->render('vaccination/show.html.twig', [
            'vaccination' => $vaccination,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vaccination_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vaccination $vaccination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VaccinationType::class, $vaccination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vaccination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vaccination/edit.html.twig', [
            'vaccination' => $vaccination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vaccination_delete', methods: ['POST'])]
    public function delete(Request $request, Vaccination $vaccination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vaccination->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vaccination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vaccination_index', [], Response::HTTP_SEE_OTHER);
    }
}
