<?php

namespace App\Controller;

use App\Entity\CarnetDeSante;
use App\Form\CarnetDeSanteType;
use App\Repository\CarnetDeSanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/carnet/de/sante')]
final class CarnetDeSanteController extends AbstractController
{
    #[Route(name: 'app_carnet_de_sante_index', methods: ['GET'])]
    public function index(CarnetDeSanteRepository $carnetDeSanteRepository): Response
    {
        return $this->render('carnet_de_sante/index.html.twig', [
            'carnet_de_santes' => $carnetDeSanteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_carnet_de_sante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carnetDeSante = new CarnetDeSante();
        $form = $this->createForm(CarnetDeSanteType::class, $carnetDeSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carnetDeSante);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_de_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carnet_de_sante/new.html.twig', [
            'carnet_de_sante' => $carnetDeSante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carnet_de_sante_show', methods: ['GET'])]
    public function show(CarnetDeSante $carnetDeSante): Response
    {
        return $this->render('carnet_de_sante/show.html.twig', [
            'carnet_de_sante' => $carnetDeSante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carnet_de_sante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarnetDeSante $carnetDeSante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarnetDeSanteType::class, $carnetDeSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_de_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carnet_de_sante/edit.html.twig', [
            'carnet_de_sante' => $carnetDeSante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carnet_de_sante_delete', methods: ['POST'])]
    public function delete(Request $request, CarnetDeSante $carnetDeSante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carnetDeSante->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($carnetDeSante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carnet_de_sante_index', [], Response::HTTP_SEE_OTHER);
    }
}
