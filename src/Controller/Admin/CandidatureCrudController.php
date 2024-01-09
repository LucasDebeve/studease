<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use App\Repository\InsertionProfessionnelleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Orm\EntityRepositoryInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CandidatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('candidat', 'Candidat')
                ->setFormTypeOptions(['choice_label' => function ($candidat) {
                    return $candidat->getFirstname().' '.$candidat->getName();
                }])
                ->formatValue(
                    function ($value, $entity) {
                        return $entity->getCandidat()->getFirstname().' '.$entity->getCandidat()->getName();
                    }
                )
                ->setColumns(6),
            AssociationField::new('insertion_professionnelle')
                ->setFormTypeOptions(['choice_label' => 'titre'])
                ->formatValue(
                    function ($value, $entity) {
                        return $entity->getInsertionProfessionnelle()->getTitre();
                    }
                )
                ->setColumns(6),
            TextareaField::new('motivation')
                ->hideOnIndex()
                ->setColumns(12),
            DateTimeField::new('date')
                ->hideWhenCreating()
                ->formatValue(
                    function ($value, $entity) {
                        return $entity->getDate()->format('d/m/Y H:i');
                    }
                )
                ->setColumns(6),
            ChoiceField::new('statut')
                ->setChoices([
                    'En attente' => 0,
                    'Acceptée' => 1,
                    'Refusée' => 2,
                ])
                ->renderAsBadges([
                    0 => 'warning',
                    1 => 'success',
                    2 => 'danger',
                ])
                ->setColumns(6),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setDate(new \DateTime('now'));
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(
                EntityFilter::new('candidat')
                    ->setFormTypeOption('value_type_options.query_builder', function (UserRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.roles LIKE :role')
                            ->setParameter('role', '%ROLE_STUDENT%')
                            ->orderBy('u.name', 'ASC')
                            ->addOrderBy('u.firstname', 'ASC');
                    })
                ->setFormTypeOption('value_type_options.choice_label', function ($candidat) {
                    return $candidat->getFirstname().' '.$candidat->getName();
                })
            )
            ->add(EntityFilter::new('insertion_professionnelle')
                ->setFormTypeOption('value_type_options.query_builder', function (InsertionProfessionnelleRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.titre', 'ASC');
                })
                ->setFormTypeOption('value_type_options.choice_label', function ($insertion) {
                    return $insertion->getId().' - '.$insertion->getTitre();
                }))
            ->add('date')
            ->add(ChoiceFilter::new('statut')
                ->canSelectMultiple(true)
                ->setChoices([
                    'En attente' => 0,
                    'Acceptée' => 1,
                    'Refusée' => 2,
                ]));
    }
}
