<?php 
namespace tests\unit\User;

use Yii;

use app\tests\fixtures\UserFixture;
use app\storage\UserStorage\UserPlace;
use app\storage\UserStorage\NotFoundException;

class UserStorageTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $storage;
    
    protected function _before()
    {
      $this->tester->haveFixtures([
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);

      $this->storage= new UserPlace(Yii::$app->db);
    }

    protected function _after()
    {
    }

    public function testFindUserbyIdTest(){
        $entity=$this->storage->findOne(1);
        
        $this->assertEquals($entity->getId(), 1);
        $this->assertEquals($entity->getName(), 'Oleg');
        $this->assertEquals($entity->getLogin(), 'kisiloleg1980@ukr.net');
    }

    public function testFindUserbyLoginTest(){
        $entity=$this->storage->findLogin('test@ukr.net');

        $this->assertEquals($entity->getId(), 2);
        $this->assertEquals($entity->getName(), 'test');
        $this->assertEquals($entity->getLogin(), 'test@ukr.net');
    }

    public function testFindUserbyIdFailTest(){
        $this->expectException(NotFoundException::class); 

        $entity=$this->storage->findOne(0);   
    }

    public function testFindUserbyLoginFailTest(){
        $this->expectException(NotFoundException::class);
        
        $entity=$this->storage->findLogin('test1@ukr.net');   
    }

    
}