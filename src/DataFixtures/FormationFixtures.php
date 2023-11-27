<?php

namespace App\DataFixtures;

use App\Factory\EcoleFactory;
use App\Factory\FormationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formationNames = json_decode(file_get_contents(__DIR__.'/data/Formation.json'));
        foreach ($formationNames as $formationName) {
            FormationFactory::createOne(
                [
                    'nom' => $formationName->nom,
                ]
            );
        }
    }
}
