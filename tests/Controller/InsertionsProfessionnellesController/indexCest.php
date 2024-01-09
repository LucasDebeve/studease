<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function insertionsProfessionnelles(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2]);
        $user = UserFactory::createOne([
            'email' => 'peter@example.com',
            'firstname' => 'Peter',
            'name' => 'Parker',
            'telephone' => '+33612345678',
            'numEtud' => '22203123',
            'roles' => ['ROLE_STUDENT'],
        ]);
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
