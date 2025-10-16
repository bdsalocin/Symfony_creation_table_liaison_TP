<?php

namespace App\Controller;

use App\Entity\Allee;
use App\Form\AlleeType;
use App\Repository\AlleeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/allee')]
final class AlleeController extends AbstractController
{
    #[Route(name: 'app_allee_index', methods: ['GET'])]
    public function index(AlleeRepository $alleeRepository): Response
    {
        return $this->render('allee/index.html.twig', [
            'allees' => $alleeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_allee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $allee = new Allee();
        $form = $this->createForm(AlleeType::class, $allee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($allee);
            $entityManager->flush();

            return $this->redirectToRoute('app_allee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('allee/new.html.twig', [
            'allee' => $allee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_allee_show', methods: ['GET'])]
    public function show(Allee $allee): Response
    {
        return $this->render('allee/show.html.twig', [
            'allee' => $allee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_allee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Allee $allee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlleeType::class, $allee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_allee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('allee/edit.html.twig', [
            'allee' => $allee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_allee_delete', methods: ['POST'])]
    public function delete(Request $request, Allee $allee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allee->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($allee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_allee_index', [], Response::HTTP_SEE_OTHER);
    }
}
