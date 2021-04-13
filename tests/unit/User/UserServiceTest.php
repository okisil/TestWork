<?php 

namespace tests\unit\User;

use Yii;

use app\tests\fixtures\UserFixture;
use app\services\UserService;

class UserServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);

        $UserStorage=Yii::$container->get('app\storage\UserStorage\UserInterface');
        $this->service=new UserService($UserStorage);
    }

    protected function _after()
    {

    }

    // tests
    public function testLoadModelIdArrayTest()
    {
        $Model=$this->service->LoadModelIdArray(1);
        
        $this->assertEquals($Model['id'], 1);
        $this->assertEquals($Model['name'], 'Oleg');
        $this->assertEquals($Model['login'], 'kisiloleg1980@ukr.net');
    }

    public function testLoadModelIdArrayFailTest()
    {
        $Model=$this->service->LoadModelIdArray(0);
        
        $this->assertEquals($Model, null);
    }

    public function testGetRoleTest(){
        $RoleAdmin=$this->service->getUserRole(1);
        $RoleTester=$this->service->getUserRole(2);

        $this->assertEquals($RoleAdmin, 'admin');
        $this->assertEquals($RoleTester, 'tester');
    }
}