<?php

namespace App\Controller;

use App\Entity\InsertionProfessionnelle;
use App\Repository\InsertionProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsertionsProfessionnellesController extends AbstractController
{
    #[Route('/insertions-professionnelles', name: 'app_insertions_professionnelles')]
    public function index(Request $request, InsertionProfessionnelleRepository $repository): Response
    {
        $intitule = $request->request->get('intitule', '');
        $type_contrat = $request->request->get('type_contrat', '');
        $date_debut_avant = $request->request->get('date_debut_avant', '');
        $date_debut_apres = $request->request->get('date_debut_apres', '');
        $duree = $request->request->get('duree', '');
        $localisation = $request->request->get('localisation', '');
        $insertions = $repository->search($intitule, $type_contrat, $date_debut_avant, $date_debut_apres, $duree, $localisation);

        return $this->render('insertions_professionnelles/index.html.twig', ['insertions' => $insertions, 'intitule' => '' == $intitule ? 'Intitulé' : $intitule, 'localisation' => '' == $localisation ? 'Localisation' : $localisation, 'date' => $date_debut_apres, 'type' => $type_contrat]);
    }

    #[Route('/insertions-professionnelles/{id}', name: 'app_insertions_professionnelles_id')]
    public function show(InsertionProfessionnelle $insertion): Response
    {
        return $this->render('insertions_professionnelles/show.html.twig', ['insertion' => $insertion]);
    }
}
