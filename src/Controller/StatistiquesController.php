<?php

namespace App\Controller;

use App\Repository\InsertionProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiquesController extends AbstractController
{
    #[Route('/stats', name: 'app_stats')]
    public function index(InsertionProfessionnelleRepository $insertions_repo): Response
    {
        // Nombre de propositions et candidatures par type d'insertion
        $insertions = $insertions_repo->general_stats();
        // Nombre d'entreprise et d'étudiant
        return $this->render('statistiques/index.html.twig', [
            'insertions_stats' => $insertions,
        ]);
    }
}
