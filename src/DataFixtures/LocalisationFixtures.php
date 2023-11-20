<?php

namespace App\DataFixtures;

use App\Factory\LocalisationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocalisationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LocalisationFactory::createMany(10);
    }
}
