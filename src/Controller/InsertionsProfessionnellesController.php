<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\InsertionProfessionnelle;
use App\Form\CandidatureType;
use App\Form\InsertionProType;
use App\Repository\CandidatureRepository;
use App\Repository\InsertionProfessionnelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class InsertionsProfessionnellesController extends AbstractController
{
    #[Route('/insertions', name: 'app_insertions_professionnelles')]
    public function index(Request $request, InsertionProfessionnelleRepository $repository): Response
    {
        $filters = $request->request->all();
        if ([] == $filters) {
            $filters['intitule'] = '';
            $filters['type_contrat'] = '';
            $filters['duree'] = '';
            $filters['order_by'] = '';
        } else {
            if ('' != $filters['duree']) {
                $temp = intval($filters['duree']);
                $filters['duree'] = "$temp";
            }
        }
        $insertions = $repository->search($filters);

        return $this->render('insertions_professionnelles/index.html.twig', ['insertions' => $insertions, 'filters' => $filters]);
    }

    #[Route('/insertions/create', name: 'app_create_insertions_pro')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $company = $this->getUser();
        $insertion = new InsertionProfessionnelle();
        $form = $this->createForm(InsertionProType::class, $insertion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $insertion = $form->getData();

            $dateDeb = $form->get('dateDeb')->getData();
            $dateFin = $form->get('dateDeb')->getData();

            if ($dateFin && $dateDeb) {
                $duree = $form->get('duree')->getData();
                $insertion->setDuree((int) $duree);
            }

            $entityManager->persist($insertion);
            $entityManager->flush();

            $this->addFlash('success', 'Modification apportée');

            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $insertion->getId()]);
        }

        return $this->render('insertions_professionnelles/create.html.twig', [
            'insertion' => $insertion,
            'current' => $company,
            'form' => $form]);
    }

    #[Route('/insertions/{id}', name: 'app_detail_insertions_professionnelles')]
    public function show(
        int $id,
        InsertionProfessionnelleRepository $repository
    ): Response {
        $insertion = $repository->findWithCompanyAndLocalisation($id);
        if (!$insertion) {
            throw $this->createNotFoundException('Insertion professionnelle non trouvée.');
        }
        $recommandations = $repository->getRecommandationsWithCompany($insertion['id']);

        return $this->render('insertions_professionnelles/show.html.twig', [
            'insertion' => $insertion,
            'recommandations' => $recommandations,
        ]);
    }

    #[Route('/insertions/{id}/candidatures/', name: 'app_candidatures')]
    #[IsGranted('ROLE_COMPANY')]
    public function candidatures(
        #[MapEntity(expr: 'repository.findWithCandidaturesAndCandidats(id)')]
        InsertionProfessionnelle $id, CandidatureRepository $repository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $statut = $request->get('Statut');
        $candidatureId = $request->get('id_candidature');

        if ($statut and $candidatureId) {
            $candidature = $repository->find($candidatureId);
            $candidature->setStatut((int) $statut);
            $entityManager->persist($candidature);
            $entityManager->flush();
        }

        if ($user !== $id->getLocalisation()->getEntreprise()) {
            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $id->getId()]);
        }

        return $this->render('insertions_professionnelles/candidatures.html.twig', ['insertion' => $id]);
    }

    #[Route('/insertions/{id}/candidater', name: 'app_candidater')]
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

            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $insertion->getId()]);
        }

        $candidature = $insertion->getCandidatures()->filter(function ($candidature) {
            return $candidature->getCandidat() === $this->getUser();
        })->first();

        if ($candidature) {
            $this->addFlash('danger', 'Vous avez déjà candidaté à cette insertion professionnelle.');

            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $insertion->getId()]);
        }

        return $this->render('insertions_professionnelles/candidater.html.twig', ['insertion' => $insertion, 'form' => $form]);
    }

    #[Route('/insertions/{id}/update', name: 'app_update_insertions_pro', requirements: ['id' => '\d+'])]
    public function update(Request $request, EntityManagerInterface $entityManager, InsertionProfessionnelle $insertion): Response
    {
        $company = $this->getUser();
        $form = $this->createForm(InsertionProType::class, $insertion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $insertion = $form->getData();

            $dateDeb = $form->get('dateDeb')->getData();
            $dateFin = $form->get('dateDeb')->getData();

            if ($dateFin && $dateDeb) {
                $duree = $form->get('duree')->getData();
                $insertion->setDuree((int) $duree);
            }

            $insertion = $entityManager->getRepository(InsertionProfessionnelle::class)->find($insertion->getId());

            if (!$insertion) {
                throw $this->createNotFoundException('No insertion found for id'.$insertion->getId());
            }

            $entityManager->flush();

            $this->addFlash('success', 'Modification apportée');

            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $insertion->getId()]);
        }

        return $this->render('insertions_professionnelles/update.html.twig', [
            'insertion' => $insertion,
            'form' => $form,
            'current' => $company,
        ]);
    }

    #[Route('/insertions/{id}/delete', name: 'app_delete_insertions_pro', requirements: ['id' => '\d+'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, InsertionProfessionnelle $insertion): Response
    {
        $form = $this->createFormBuilder($insertion)
            ->add('delete', SubmitType::class, ['label' => 'Supprimer'])
            ->add('cancel', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($insertion);
                $entityManager->flush();

                return $this->redirectToRoute('app_insertions_professionnelles');
            }

            return $this->redirectToRoute('app_detail_insertions_professionnelles', ['id' => $insertion->getId()]);
        }

        return $this->render('insertions_professionnelles/delete.html.twig', [
            'insertion' => $insertion,
            'form' => $form->createView(),
        ]);
    }
}
