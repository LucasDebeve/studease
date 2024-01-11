<?php

namespace App\Tests\Controller\LocalisationController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class LocalisationCreateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/create');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle("Création d'une localisation");
        $I->see('Créer une localisation', 'h1');
    }


    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/localisation/create');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToCompanies(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/create');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
