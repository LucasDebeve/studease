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
}
