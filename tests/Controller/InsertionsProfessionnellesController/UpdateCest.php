<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class UpdateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
        InsertionProfessionnelleFactory::createOne();
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/update');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
        InsertionProfessionnelleFactory::createOne();
        $I->amOnPage('/insertions/1/update');
        $I->seeCurrentUrlEquals('/login');
    }

}
