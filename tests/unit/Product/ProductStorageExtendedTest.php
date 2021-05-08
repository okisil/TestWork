<?php 

namespace Product;

use Yii;

use app\storage\ProductStorage\ProductPlaceExtended;
use app\tests\fixtures\ProductFixture;

class ProductStorageExtendedTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $storage;
    
    protected function _before()
    {
        $this->storage= new ProductPlaceExtended(Yii::$app->db);

        $this->tester->haveFixtures([
            'products' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testCountStorage(){
        $count=$this->storage->count();
        $this->assertEquals($count['COUNT(*)'], 3);
    }

    public function testFindAllStorage()
    {
       $entities=$this->storage->findAll(3,0);
              
       $this->assertEquals($entities[0]->getId(), 1);
       $this->assertEquals($entities[0]->getName(), 'product1');

       $this->assertEquals($entities[1]->getId(), 2);
       $this->assertEquals($entities[1]->getName(), 'product2');

       $this->assertEquals($entities[2]->getId(), 3);
       $this->assertEquals($entities[2]->getName(), 'product3');
    }
}