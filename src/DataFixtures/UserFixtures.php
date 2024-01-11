<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'peter@example.com',
            'firstname' => 'Peter',
            'name' => 'Parker',
            'telephone' => '+33612345678',
            'numEtud' => '22203123',
            'roles' => ['ROLE_STUDENT'],
        ]);
        UserFactory::createOne([
            'email' => 'tony@example.com',
            'firstname' => 'Tony',
            'name' => 'Stark',
            'telephone' => '+33601234567',
            'numSiret' => '12345678901234',
            'descriptionEntreprise' => 'Je suis un super héros',
            'tpUser' => 2,
            'roles' => ['ROLE_COMPANY'],
        ]);
        UserFactory::createMany(10);
        UserFactory::createOne([
            'email' => 'homer@studease.com',
            'firstname' => 'Homer',
            'name' => 'Simpson',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);
        UserFactory::createOne([
            'email' => 'lucas@studease.com',
            'firstname' => 'Lucas',
            'name' => 'Debeve',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);
        UserFactory::createOne([
            'email' => 'axel@studease.com',
            'firstname' => 'Axel',
            'name' => 'Coudrot',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);
        UserFactory::createOne([
            'email' => 'paco@studease.com',
            'firstname' => 'Paco',
            'name' => 'Jacquemain',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);
        UserFactory::createOne([
            'email' => 'nathan@studease.com',
            'firstname' => 'Nathan',
            'name' => 'Eullafroy',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);
        UserFactory::createOne([
            'email' => 'justin@studease.com',
            'firstname' => 'Justin',
            'name' => 'Pinguard',
            'numSiret' => 'null',
            'descriptionEntreprise' => 'null',
            'tpUser' => 0,
            'roles' => ['ROLE_ADMIN'],
            'isVerified' => true,
        ]);

        $manager->flush();
    }
}
