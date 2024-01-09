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
        $user = UserFactory::createOne(['email' => 'root@example.com',
            'name' => 'Parker',
            'firstname' => 'Peter',
            'roles' => ['ROLE_COMPANY'],
            'isVerified' => true]);
        InsertionProfessionnelleFactory::createOne();
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/update');
        $I->seeResponseCodeIs(HttpCode::OK);
    }
}