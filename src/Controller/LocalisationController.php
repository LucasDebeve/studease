<?php

namespace App\Controller;

use App\Entity\Localisation;
use App\Form\LocalisationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('localisation/index.html.twig', [
            'localisation' => $localisation,
        ]);
    }

    #[Route('/localisation/{id}/update', name: 'app_localisation_update')]
    public function update(EntityManagerInterface $entityManager, Localisation $id, Request $request)
    {
        $form = $this->createForm(LocalisationType::class, $id);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $localisation = $form->getData();

            $entityManager->flush();

            return $this->redirectToRoute('app_localisation_insertions', ['id' => $localisation->getId()]);
        }

        $this->addFlash('success', 'Localisation modifiée.');

        return $this->render('localisation/update.html.twig', ['localisation' => $id, 'form' => $form]);
    }
}
