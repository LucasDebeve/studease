<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function insertionsProfessionnelles(ControllerTester $I): void
    {
        InsertionProfessionnelleFactory::createOne(['titre' => 'stageTest', 'duree' => 10, 'dateDeb' => '01/01/01']);
        $I->amOnPage('/insertions-professionnelles');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Stages et Alternances disponible');
        $I->see('Stages et Alternances disponible', 'h1');
        $I->seeCurrentRouteIs('app_insertions_professionnelles');

        // test pour la vérification des liens des éléments de la liste

        $I->click('<h3>StageTest</h3> Durée : 10 semaines, Début : 01/01/01');
        $I->seeResponseCodeIs(200);
        $I->seeCurrentRouteIs('app_details_insertions_professionnelles');
    }


    public function tri(ControllerTester $I): void
    {
        InsertionProfessionnelleFactory::createOne(['titre' => 'stageTest', 'duree' => 10, 'dateDeb' => '01/01/01']);
        InsertionProfessionnelleFactory::createOne(['titre' => 'dev Web', 'duree' => 10, 'dateDeb' => '01/01/01']);
        InsertionProfessionnelleFactory::createOne(['titre' => 'alternance', 'duree' => 10, 'dateDeb' => '01/01/01']);
        $I->amOnPage('/insertions-professionnelles');
        $liste = $I->grabMultiple('ul.insertions_professionnelles a');
        $I->assertEquals(['<h3>alternance</h3> Durée : 10 semaines, Début : 01/01/01',
            '<h3>dev Web</h3> Durée : 10 semaines, Début : 01/01/01',
            '<h3>StageTest</h3> Durée : 10 semaines, Début : 01/01/01'], $liste);
    }

    public function search(ControllerTester $I): void
    {
        InsertionProfessionnelleFactory::createOne(['titre' => 'stageTest', 'duree' => 10, 'dateDeb' => '01/01/01']);
        InsertionProfessionnelleFactory::createOne(['titre' => 'informatique', 'duree' => 10, 'dateDeb' => '01/01/01']);
        InsertionProfessionnelleFactory::createOne(['titre' => 'réseaux informatiques', 'duree' => 10, 'dateDeb' => '01/01/01']);
        $I->amOnPage('/insertions-professionnelles?search=informatique');
        $liste = $I->grabMultiple('ul.insertions_professionnelles a');
        $I->assertEquals(['<h3>informatique</h3> Durée : 10 semaines, Début : 01/01/01',
            '<h3>réseaux informatiques</h3> Durée : 10 semaines, Début : 01/01/01'], $liste);
    }
}
