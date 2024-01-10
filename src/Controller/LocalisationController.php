<?php

namespace App\Controller;

use App\Entity\Localisation;
use App\Form\LocalisationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LocalisationController extends AbstractController
{
    #[Route('/localisation/create', name: 'app_localisation_delete')]
    #[IsGranted('ROLE_COMPANY')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $localisation = new Localisation();
        $form = $this->createForm(LocalisationType::class, $localisation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $localisation = $form->getData();

            $localisation->setEntreprise($this->getUser());

            $entityManager->persist($localisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_localisation_insertions', ['id' => $localisation->getId()]);
        }

        $this->addFlash('success', 'Localisation créée.');

        return $this->render('localisation/create.html.twig', ['form' => $form]);
    }

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
    #[IsGranted('ROLE_COMPANY')]
    public function update(EntityManagerInterface $entityManager, Localisation $id, Request $request)
    {
        if ($id->getEntreprise() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

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

    #[Route('/localisation/{id}/delete', name: 'app_localisation_delete')]
    #[IsGranted('ROLE_COMPANY')]
    public function delete(Request $request, Localisation $id, EntityManagerInterface $entityManager)
    {
        if ($id->getEntreprise() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createFormBuilder($id)
            ->add('delete', SubmitType::class)
            ->add('cancel', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($id);
                $entityManager->flush();

                $this->addFlash('success', 'Localisation supprimée.');

                return $this->redirectToRoute('app_user_profile');
            } else {
                $this->addFlash('danger', 'Annulation de la supression.');

                return $this->redirectToRoute('app_localisation_insertions', ['id' => $id->getId()]);
            }
        }

        return $this->render('localisation/delete.html.twig', ['localisation' => $id, 'form' => $form]);
    }
}
