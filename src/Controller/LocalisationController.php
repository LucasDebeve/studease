<?php

namespace App\Controller;

use App\Entity\Localisation;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LocalisationController extends AbstractController
{
    #[Route('/localisation/{id}', name: 'app_localisation_insertions')]
    #[IsGranted('IS_AUTHENTICATED')]
    public function index(
        #[MapEntity(expr: 'repository.findWithInsertions(id)')]
        Localisation $localisation): Response
    {
        /*if ($localisation->getEntreprise() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette page');
        }*/
        return $this->render('localisation/index.html.twig', [
            'localisation' => $localisation,
        ]);
    }
}
