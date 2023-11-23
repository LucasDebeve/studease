<?php

namespace App\Controller;

use App\Repository\InsertionProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InsertionProfessionnelle;

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
}
