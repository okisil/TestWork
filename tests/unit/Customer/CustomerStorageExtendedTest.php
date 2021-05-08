<?php 

namespace Customer;

use Yii;

use app\storage\CustomerStorage\CustomerPlaceExtended;
use app\tests\fixtures\CustomerFixture;

class CustomerStorageExtendedTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $storage;
    
    protected function _before()
    {
        $this->storage= new CustomerPlaceExtended(Yii::$app->db);

        $this->tester->haveFixtures([
            'customers' => [
                'class' => CustomerFixture::className(),
                'dataFile' => codecept_data_dir() . 'customer.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    public function testCountStorage(){
        $count=$this->storage->count();
        $this->assertEquals($count['COUNT(*)'], 2);
    }

    public function testFindAllStorage()
    {
       $entities=$this->storage->findAll(2,0);
              
       $this->assertEquals($entities[0]->getId(), 1);
       $this->assertEquals($entities[0]->getName(), 'customer1');

       $this->assertEquals($entities[1]->getId(), 2);
       $this->assertEquals($entities[1]->getName(), 'customer2');
    }
}