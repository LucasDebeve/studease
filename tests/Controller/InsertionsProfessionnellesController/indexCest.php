<?php


namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Tests\Support\ControllerTester;


class IndexCest
{
    public function insertionsProfessionnelles(ControllerTester $I): void
    {
        // création des données pour test via la Forge à ajouter plus tard

        // affichage de la page

        $I->amOnPage('/insertions-professionnelles');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Stages et Alternances disponible');
        $I->see('Stages et Alternances disponible', 'h1');
        $I->seeCurrentRouteIs('app_insertions_professionnelles');

        // test pour la vérification des liens de chaques éléments de la liste

        // $I->click('');
        // $I->seeResponseCodeIs(200);
        // $I->seeCurrentRouteIs(app_detail_insertions_professionnelles);
    }

    public function search(ControllerTester $I): void
    {
        // création des données pour test via la Forge à ajouter plus tard

        // tests pour les détails des stages
    }
}
