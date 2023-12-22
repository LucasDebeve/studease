<?php

namespace App\DataFixtures;

use App\Factory\InsertionProfessionnelleFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InsertionsProfessionnellesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $formationNames = json_decode(file_get_contents(__DIR__.'/Data/insertions.json'), true)['stages'];
        foreach ($formationNames as $formationName) {
            InsertionProfessionnelleFactory::createOne(
                [
                    'titre' => $formationName['titre'],
                ]
            );
        }
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
