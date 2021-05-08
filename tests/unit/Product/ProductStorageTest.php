<?php 
namespace tests\unit\Product;

use Yii;

use app\storage\ProductStorage\ProductPlace;
use app\entities\ProductEntity;

class ProductStorageTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $storage;

    private $id;

    private function getValueDB(){
        return $this->storage->findOne($this->id);
    }
    
    protected function _before()
    {
        $this->storage= new ProductPlace(Yii::$app->db);
    }

    protected function _after()
    {
    }

    public function testAddStorage()
    {
       $entity= new ProductEntity();
       $entity->setName('testProduct');

       $this->storage->add($entity);
       $this->id=$this->storage->getLastId();

       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getName(), 'testProduct');
    }

    public function testUpdateStorage()
    {
       $this->testAddStorage();

       $entity=$this->getValueDB();

       $entity->setName('testUpdateProduct');

       $this->storage->save($entity);
       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getName(), 'testUpdateProduct');
    }

    public function testDeleteStorage(){
        $this->testAddStorage();

        $this->storage->delete($this->id);

        $entity=$this->getValueDB();

        $this->assertNull($entity->getId());
        $this->assertNull($entity->getName());
    } 
}