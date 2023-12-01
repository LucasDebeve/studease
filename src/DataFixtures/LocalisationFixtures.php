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
        LocalisationFactory::createMany(10);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
