<?php

namespace App\DataFixtures;

use App\Factory\CandidatureFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CandidatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        CandidatureFactory::createMany(20);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            InsertionsProfessionnellesFixtures::class,
        ];
    }
}
