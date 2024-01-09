<?php

namespace App\DataFixtures;

use App\Factory\EcoleFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $schoolNames = json_decode(file_get_contents(__DIR__.'/Data/Ecole.json'));
        foreach ($schoolNames as $schoolName) {
            EcoleFactory::createOne(
                [
                    'nom' => $schoolName->nom,
                ]
            );
        }
    }
}
