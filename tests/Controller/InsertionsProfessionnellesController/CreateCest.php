<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class CreateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
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
}
