<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\InsertionProfessionnelle;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Repository\InsertionProfessionnelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function candidatures(
        #[MapEntity(expr: 'repository.findWithCandidaturesAndCandidats(id)')]
        InsertionProfessionnelle $id, CandidatureRepository $repository): Response
    {
        $user = $this->getUser();

        if ($user !== $id->getCompany()) {
            // return $this->redirectToRoute('app_insertions_professionnelles_id', ['id' => $id->getId()]);
        }

        return $this->render('insertions_professionnelles/candidatures.html.twig', ['insertion' => $id]);
    }

    #[Route('/insertions-professionnelles/{id}/candidater', name: 'app_candidater')]
    #[IsGranted('ROLE_STUDENT')]
    public function candidater(InsertionProfessionnelle $insertion,
        EntityManagerInterface $entityManager,
        Request $request): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $candidature->setInsertionProfessionnelle($insertion);
            $candidature->setCandidat($this->getUser());
            $candidature->setDate(new \DateTime());

            $entityManager->persist($candidature);
            $entityManager->flush();

            $this->addFlash('success', 'Votre candidature a bien été prise en compte.');

            return $this->redirectToRoute('app_insertions_professionnelles_id', ['id' => $insertion->getId()]);
        }

        $candidature = $insertion->getCandidatures()->filter(function ($candidature) {
            return $candidature->getCandidat() === $this->getUser();
        })->first();

        if ($candidature) {
            $this->addFlash('danger', 'Vous avez déjà candidaté à cette insertion professionnelle.');
            return $this->redirectToRoute('app_insertions_professionnelles_id', ['id' => $insertion->getId()]);
        }

        return $this->render('insertions_professionnelles/candidater.html.twig', ['insertion' => $insertion, 'form' => $form]);
    }
}
