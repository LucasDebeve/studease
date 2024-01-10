<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class DeleteCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
        LocalisationFactory::createOne();
        InsertionProfessionnelleFactory::createOne();
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/delete');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
        LocalisationFactory::createOne();
        InsertionProfessionnelleFactory::createOne();
        $I->amOnPage('/insertions/1/delete');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToAuthors(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2, 'isVerified' => true]);
        LocalisationFactory::createOne();
        InsertionProfessionnelleFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/delete');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
