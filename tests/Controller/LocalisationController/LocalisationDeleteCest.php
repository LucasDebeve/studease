<?php

namespace App\Tests\Controller\LocalisationController;

use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class LocalisationDeleteCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne(['entreprise' => $user]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/1/delete');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle('Suppression de la localisation');
        $I->see('Suppression de la Localisation suivante', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne();
        $I->amOnPage('/localisation/1/delete');
        $I->seeCurrentUrlEquals('/login');
    }

}
