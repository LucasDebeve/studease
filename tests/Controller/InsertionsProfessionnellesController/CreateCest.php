<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class CreateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['email' => 'root@example.com',
            'name' => 'Parker',
            'firstname' => 'Peter',
            'roles' => ['ROLE_COMPANY'],
            'isVerified' => true]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/create');
        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
