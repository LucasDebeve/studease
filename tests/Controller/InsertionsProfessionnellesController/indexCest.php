<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function insertionsProfessionnelles(ControllerTester $I): void
    {
        UserFactory::createOne();
        InsertionProfessionnelleFactory::createOne(['titre' => 'stageTest', 'duree' => 10, 'dateDeb' => new \DateTime('01/01/2001')]);
        InsertionProfessionnelleFactory::createOne(['titre' => 'informatique', 'duree' => 10, 'dateDeb' => new \DateTime('01/01/01')]);
        InsertionProfessionnelleFactory::createOne(['titre' => 'réseaux informatiques', 'duree' => 10, 'dateDeb' => new \DateTime('01/01/01')]);
        $I->amOnPage('/insertions-professionnelles');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Stages et Alternances');
        $I->seeCurrentRouteIs('app_insertions_professionnelles');
    }

    public function tri(ControllerTester $I): void
    {
        $I->amOnPage('/insertions-professionnelles');
        $I->seeCurrentRouteIs('app_insertions_professionnelles');
        $liste = $I->grabMultiple('ul.insertions li a h3.insertion__titre');
        $I->assertEquals(
            ['informatique',
                'réseaux informatiques',
                'stageTest', ], $liste);
    }
}
