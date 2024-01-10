<?php

namespace App\DataFixtures;

use App\Factory\LocalisationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LocalisationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $localisations = json_decode(file_get_contents(__DIR__.'/Data/Localisation.json'));
        foreach ($localisations as $localisation) {
            LocalisationFactory::createOne(
                [
                    'adresse' => $localisation->adresse,
                    'code_postal' => $localisation->code_postal,
                    'latitude' => $localisation->latitude,
                    'longitude' => $localisation->longitude,
                    'ville' => $localisation->ville,
                    'pays' => $localisation->pays,
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
