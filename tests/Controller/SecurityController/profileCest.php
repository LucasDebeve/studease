<?php

namespace App\Tests\Controller\SecurityController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class profileCest
{
    public function redirectionToProfile(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/profile');
        $I->seeCurrentUrlEquals('/profile/'.$user->getId());
    }
    public function profileAccessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/profile');
        $I->seeCurrentUrlEquals('/login');
    }
}
