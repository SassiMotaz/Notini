<?php

namespace App\Controller;

use App\Entity\Matieres;
use App\Form\MatieresType;
use App\Repository\MatieresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/matieres')]
class MatieresController extends AbstractController
{
    #[Route('/', name: 'app_matieres_index', methods: ['GET'])]
    public function index(MatieresRepository $matieresRepository): Response
    {
        return $this->render('matieres/index.html.twig', [
            'matieres' => $matieresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_matieres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MatieresRepository $matieresRepository): Response
    {
        $matiere = new Matieres();
        $form = $this->createForm(MatieresType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matieresRepository->add($matiere);
            return $this->redirectToRoute('app_matieres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matieres/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matieres_show', methods: ['GET'])]
    public function show(Matieres $matiere): Response
    {
        return $this->render('matieres/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_matieres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matieres $matiere, MatieresRepository $matieresRepository): Response
    {
        $form = $this->createForm(MatieresType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matieresRepository->add($matiere);
            return $this->redirectToRoute('app_matieres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matieres/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matieres_delete', methods: ['POST'])]
    public function delete(Request $request, Matieres $matiere, MatieresRepository $matieresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $matieresRepository->remove($matiere);
        }

        return $this->redirectToRoute('app_matieres_index', [], Response::HTTP_SEE_OTHER);
    }
}
