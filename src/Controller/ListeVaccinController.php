<?php

namespace App\Controller;

use App\Entity\ListeVaccin;
use App\Form\ListeVaccinType;
use App\Repository\ListeVaccinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/liste/vaccin')]
final class ListeVaccinController extends AbstractController
{
    #[Route(name: 'app_liste_vaccin_index', methods: ['GET'])]
    public function index(ListeVaccinRepository $listeVaccinRepository): Response
    {
        return $this->render('liste_vaccin/index.html.twig', [
            'liste_vaccins' => $listeVaccinRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liste_vaccin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listeVaccin = new ListeVaccin();
        $form = $this->createForm(ListeVaccinType::class, $listeVaccin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listeVaccin);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_vaccin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_vaccin/new.html.twig', [
            'liste_vaccin' => $listeVaccin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_vaccin_show', methods: ['GET'])]
    public function show(ListeVaccin $listeVaccin): Response
    {
        return $this->render('liste_vaccin/show.html.twig', [
            'liste_vaccin' => $listeVaccin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_vaccin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListeVaccin $listeVaccin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeVaccinType::class, $listeVaccin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_vaccin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_vaccin/edit.html.twig', [
            'liste_vaccin' => $listeVaccin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_vaccin_delete', methods: ['POST'])]
    public function delete(Request $request, ListeVaccin $listeVaccin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeVaccin->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($listeVaccin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_vaccin_index', [], Response::HTTP_SEE_OTHER);
    }
}
