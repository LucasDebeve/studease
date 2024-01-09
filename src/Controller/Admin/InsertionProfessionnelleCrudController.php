<?php

namespace App\Controller\Admin;

use App\Entity\InsertionProfessionnelle;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;

class InsertionProfessionnelleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InsertionProfessionnelle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextareaField::new('descInsPro', 'Description')->hideOnIndex(),
            AssociationField::new('company', 'Entreprise')
                ->setQueryBuilder(
                    fn ($queryBuilder) => $queryBuilder->andWhere('entity.tpUser = 2')->orderBy('entity.name', 'ASC')
                )
                ->setFormTypeOptions(['choice_label' => 'name'])
                ->FormatValue(function ($value) {
                    return $value->getName();
                }),
            ChoiceField::new('typePro', 'Type de contrat')
                ->setChoices([
                    'Stage' => 1,
                    'Alternance' => 2,
                ]),
            DateField::new('dateDeb', 'Date de début'),
            DateField::new('dateFin', 'Date de fin'),
            NumberField::new('revenus', 'Rémunération')->hideOnIndex(),
            BooleanField::new('teletravail', 'En télétravail')->hideOnIndex(),
            IntegerField::new('duree', 'Durée')->hideOnIndex(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('titre')
            ->add(EntityFilter::new('company')
                ->setFormTypeOption('value_type_options.query_builder',
                    function (UserRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.roles LIKE :role')
                            ->setParameter('role', '%ROLE_COMPANY%')
                            ->orderBy('u.name', 'ASC');
                    }
                )
                ->setFormTypeOption('value_type_options.choice_label', 'name')
            )
            ->add(ChoiceFilter::new('typePro')
                ->setChoices([
                    'Stage' => 1,
                    'Alternance' => 2,
                ]))
            ->add('dateDeb')
            ->add('dateFin')
            ->add(NumericFilter::new('revenus'))
            ->add(BooleanFilter::new('teletravail'))
            ->add('duree');
    }
}
