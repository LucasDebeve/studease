<?php

namespace App\Controller\Admin;

use App\Entity\Ecole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EcoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ecole::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('adresse'),
            NumberField::new('cp'),
            TextField::new('ville'),
            CountryField::new('pays'),
        ];
    }
}
