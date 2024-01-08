<?php

namespace App\DataFixtures;

use App\Factory\FormationFactory;
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
            $typePro = rand(1, 2);
            if (1 == $typePro) {
                $duree = rand(1, 26) * 5 + 2;
                if ($duree < 44) {
                    $revenu = 0;
                } else {
                    $revenu = rand(0, 15) + 30;
                }
            } else {
                $duree = rand(1, 6) * 132;
                $revenu = rand(0, 21) + 42;
            }
            InsertionProfessionnelleFactory::createOne(
                [
                    'typePro' => $typePro,
                    'titre' => $formationName['titre'],
                    'revenus' => $revenu,
                    'duree' => $duree,
                ]
            );
        }
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            LocalisationFixtures::class,
        ];
    }
}
