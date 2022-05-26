<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Matieres;
use App\Entity\Etudiants;
use App\Form\EtudiantsType;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EtudiantsController extends AbstractController
{   #[Route('/etudiants', name: 'app_etudiants')]
    public function index( EntityManagerInterface $em): Response
    {
        $etudiants = $em->getRepository(Etudiants::class)->findAll();
        return $this->render('etudiants/index.html.twig', [
            'etudiants'=> $etudiants ,
        ]);
    }
    
    #[Route('/etudiants/new',name:'app_new_etudiant')]
    public function new(Request $request ,EntityManagerInterface $em): Response
    {
        $etudiant = new Etudiants();
        $form = $this->createForm(EtudiantsType::class , $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($etudiant);
            $em->flush();
            $this->addFlash('success', 'Etudiant created successfully!');
            return $this->redirectToRoute('app_etudiants');
        }
        return $this->render('etudiants/new.html.twig', [
            'etudiants'=> $etudiant ,
            'form'=>$form->createView(),
        ]);
    }
    
    #[Route('/etudiants/{cin}/edit',name:'app_edit_etudiant')]
    public function edit(Request $request ,EntityManagerInterface $em , Etudiants $etudiant): Response
    {
        $form = $this->createForm(EtudiantsType::class ,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Etudiant update successfully!');
            return $this->redirectToRoute('app_show_etudiant',[
                'cin' =>$etudiant->getCin()
            ]);
        }
        return $this->render('etudiants/edit.html.twig', [
            'form'=>$form->createView(),
            'etudiants'=> $etudiant->getCin() ,
        ]);
    }
    #[Route('/etudiants/{cin}/show',name:'app_show_etudiant')]
    public function show(Etudiants $etudiant , EntityManagerInterface $em  ): Response
    {
        $matiers = $etudiant->getMatiers();
        $note = $etudiant->getNotes();
        return $this->render('etudiants/show.html.twig', [
            'etudiants'=> $etudiant ,
            'matiers'=>$matiers,
            'note'=>$note,
        ]);
    }
    #[Route('/etudiants/{cin}/delete',name:'app_delete_etudiant')]
    public function delete(Etudiants $etudiant ,EntityManagerInterface $em): Response
    {
        $em->remove($etudiant);
        $em->flush();
        $this->addFlash('success', 'etudiant deleted successfully!');
        return $this->redirectToRoute('app_etudiants');
        
    }
    #[Route('/etudiants/search',name:'app_search_etudiant')]
    public function search(Request $request ,EtudiantsRepository $sr  ) : Response
    {
        $keyword = $request->get('keyword');
        $etudiant = $sr->search($keyword);
        return $this->render('etudiants/search.html.twig',
         [
        'etudiants' => $etudiant,
        ]);
        
    }
    #[Route('/etudiants/{cin}/shownote',name:'app_shownote_etudiant')]
    public function shownote(Etudiants $etudiant ,Request $request ,EtudiantsRepository $sr  ) : Response
    {
        $note = $etudiant->getNotes();
        return $this->render('etudiants/shownote.html.twig',
         [
        'etudiants' => $etudiant,
        'note'=> $note
        ]);
        
    }
    
    
}

