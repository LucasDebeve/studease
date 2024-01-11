<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class InsertionsUpdateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        $insertion = InsertionProfessionnelleFactory::createOne(['localisation' => $loca]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/update');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle('Edition du stage/alternance: '.$insertion->getTitre());
        $I->see('Edition du stage/alternance: '.$insertion->getTitre(), 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        InsertionProfessionnelleFactory::createOne(['localisation' => $loca]);
        $I->amOnPage('/insertions/1/update');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToAuthors(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        InsertionProfessionnelleFactory::createOne(['localisation' => $loca]);
        $user = UserFactory::createOne(['tpUser' => 2]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/update');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
