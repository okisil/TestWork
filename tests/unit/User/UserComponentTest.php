<?php 
namespace tests\unit\User;

use Yii;

use app\tests\fixtures\UserFixture;
use app\components\User\UserComponent;

class UserComponentTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $component;
    
    protected function _before()
    {
      $this->tester->haveFixtures([
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    public function testComponentFindIdentityTest(){
        $UserComponent=UserComponent::findIdentity(2);

        $this->assertEquals($UserComponent->getId(), 2);
        $this->assertEquals($UserComponent->getUsername(), 'test');
        $this->assertEquals($UserComponent->getLogin(), 'test@ukr.net');
    }

    public function testComponentGetRoleTest(){
        $UserComponentTester=UserComponent::findIdentity(2);
        $UserComponentAdmin=UserComponent::findIdentity(1);

        $this->assertEquals($UserComponentTester->getRole(), 'tester');
        $this->assertEquals($UserComponentAdmin->getRole(), 'admin');
    }

    
}