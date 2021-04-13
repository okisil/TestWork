<?php 
namespace tests\unit\User;

use Yii;

use app\models\AuthForm;
use app\components\User\UserComponent;

use app\tests\fixtures\UserFixture;

class UserAuthTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    //private $storage;

    private $id;
    
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

    public function testSignUpTest(){
        $model=new AuthForm([
            'login' => 'test@ukr.net',
            'password' => 'test']);
        $this->assertTrue($model->validate());
    }

    public function testSignUpLoginFail(){
        $model=new AuthForm([
            'login' => 'test1@ukr.net',
            'password' => 'test']);
        $this->assertFalse($model->validate());
    }

    public function testSignUpPasswordFail(){
        $model=new AuthForm([
            'login' => 'test@ukr.net',
            'password' => 'test1']);
        $this->assertFalse($model->validate());
    }

}