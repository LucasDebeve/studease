<?php


namespace App\Tests\Controller\LocalisationController;

use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class LocalisationUpdateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne(['entreprise' => $user]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/1/update');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle('Edition de la localisation');
        $I->see('Editer la localisation', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne();
        $I->amOnPage('/localisation/1/update');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToAuthors(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        LocalisationFactory::createOne(['entreprise' => $user]);
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/1/update');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
