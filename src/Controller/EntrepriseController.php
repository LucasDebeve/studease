<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\EntrepriseCandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{


    #[Route('/candidatures/{id}/statut', name: 'app_candidature_statut')]
    public function updateStatut(EntityManagerInterface $entityManager, Request $request, Candidature $candidature): Response
    {
        $form = $this->createForm(EntrepriseCandidatureType::class, ['Statut' => $candidature->getStatut()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nouveauStatut = $form->get('Statut')->getData();

            $candidature->setStatut($nouveauStatut);
            $entityManager->flush();

            return $this->redirectToRoute('app_candidature_list');
        }

        return $this->render('entreprise/modifier_candidature.html.twig', [
            'form' => $form->createView(),
            'candidature' => $candidature,
        ]);
    }
}
