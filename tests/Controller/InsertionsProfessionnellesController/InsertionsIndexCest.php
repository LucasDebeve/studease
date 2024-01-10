<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\DataFixtures\LocalisationFixtures;
use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class InsertionsIndexCest
{
    public function insertionsProfessionnelles(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne(['entreprise' => $user]);
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        InsertionProfessionnelleFactory::createMany(3);
        $I->amOnPage('/insertions');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Stages et Alternances');
        $I->seeCurrentRouteIs('app_insertions_professionnelles');
        $liste = $I->grabMultiple('div div div a');
        $I->assertEquals(3, count($liste));
    }
}
