<?php

namespace App\DataFixtures;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InsertionsProfessionnellesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        InsertionProfessionnelleFactory::createOne(['company' => UserFactory::random(['id' => 2])]);
        InsertionProfessionnelleFactory::createMany(50);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
