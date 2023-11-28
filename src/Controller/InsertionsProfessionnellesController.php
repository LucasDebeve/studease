<?php

namespace App\Controller;

use App\Entity\InsertionProfessionnelle;
use App\Repository\CandidatureRepository;
use App\Repository\InsertionProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class InsertionsProfessionnellesController extends AbstractController
{
    #[Route('/insertions-professionnelles', name: 'app_insertions_professionnelles')]
    public function index(InsertionProfessionnelleRepository $repository): Response
    {
        $insertions = $repository->search();

        return $this->render('insertions_professionnelles/index.html.twig', ['insertions' => $insertions]);
    }

    #[Route('/insertions-professionnelles/{id}', name: 'app_insertions_professionnelles_id')]
    public function show(InsertionProfessionnelle $insertion): Response
    {
        return $this->render('insertions_professionnelles/show.html.twig', ['insertion' => $insertion]);
    }

    #[Route('/insertions-professionnelles/{id}/candidatures/', name: 'app_candidatures')]
    #[IsGranted('ROLE_COMPANY')]
    public function candidatures(InsertionProfessionnelle $id, CandidatureRepository $repository): Response
    {
        $user = $this->getUser();

        if ($user !== $id->getCompany()) {
            //return $this->redirectToRoute('app_insertions_professionnelles_id', ['id' => $id->getId()]);
        }

        $candidature = $repository->findWithCandidatByInsertion($id);
        return $this->render('insertions_professionnelles/candidatures.html.twig', ['insertion' => $id, 'candidatures' => $candidature]);
    }
}
