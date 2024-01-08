<?php

namespace App\Controller\Admin;

use App\Entity\InsertionProfessionnelle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
}
