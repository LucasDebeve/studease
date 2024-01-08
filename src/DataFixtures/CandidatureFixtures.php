<?php

namespace App\DataFixtures;

use App\Factory\CandidatureFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CandidatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        CandidatureFactory::createOne(['candidat' => UserFactory::random(['id' => 1])]);
        CandidatureFactory::createMany(20);
    }

    public function getDependencies(): array
    {
        return [
            InsertionsProfessionnellesFixtures::class,
        ];
    }
}
