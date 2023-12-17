<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\EntrepriseCandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
    #[Route('/candidature/{id}/update', name: 'app_candidature_update', requirements: ['id' => '\d+'])]
    public function updateStatut(Request $request, EntityManagerInterface $entityManager, Candidature $candidature): Response
    {
        $form = $this->createForm(EntrepriseCandidatureType::class, $candidature);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }

        return $this->render('entreprise/modifier_candidature.html.twig', [
            'form' => $form->createView(),
            'candidature' => $candidature,
        ]);
    }
}
