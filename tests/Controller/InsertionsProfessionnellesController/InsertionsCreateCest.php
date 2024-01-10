<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class InsertionsCreateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/create');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/insertions/create');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToCompanies(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/create');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
