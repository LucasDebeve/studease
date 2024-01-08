<?php

namespace App\Controller\Admin;

use App\Entity\Localisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocalisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Localisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('adresse'),
            NumberField::new('code_postal'),
            TextField::new('ville'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            CountryField::new('pays'),
        ];
    }
}
