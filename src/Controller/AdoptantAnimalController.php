<?php

namespace App\Controller;

use App\Entity\AdoptantAnimal;
use App\Form\AdoptantAnimalType;
use App\Repository\AdoptantAnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adoptant/animal')]
final class AdoptantAnimalController extends AbstractController
{
    #[Route(name: 'app_adoptant_animal_index', methods: ['GET'])]
    public function index(AdoptantAnimalRepository $adoptantAnimalRepository): Response
    {
        return $this->render('adoptant_animal/index.html.twig', [
            'adoptant_animals' => $adoptantAnimalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adoptant_animal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adoptantAnimal = new AdoptantAnimal();
        $form = $this->createForm(AdoptantAnimalType::class, $adoptantAnimal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adoptantAnimal);
            $entityManager->flush();

            return $this->redirectToRoute('app_adoptant_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adoptant_animal/new.html.twig', [
            'adoptant_animal' => $adoptantAnimal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adoptant_animal_show', methods: ['GET'])]
    public function show(AdoptantAnimal $adoptantAnimal): Response
    {
        return $this->render('adoptant_animal/show.html.twig', [
            'adoptant_animal' => $adoptantAnimal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adoptant_animal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdoptantAnimal $adoptantAnimal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdoptantAnimalType::class, $adoptantAnimal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adoptant_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adoptant_animal/edit.html.twig', [
            'adoptant_animal' => $adoptantAnimal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adoptant_animal_delete', methods: ['POST'])]
    public function delete(Request $request, AdoptantAnimal $adoptantAnimal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adoptantAnimal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($adoptantAnimal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adoptant_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
