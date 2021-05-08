<?php 
namespace tests\unit\Customer;

use Yii;

use app\storage\CustomerStorage\CustomerPlace;
use app\entities\CustomerEntity;

class CustomerStorageTest extends \Codeception\Test\Unit
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
        $this->storage= new CustomerPlace(Yii::$app->db);
    }

    protected function _after()
    {
    }

    public function testAddStorage()
    {
       $entity= new CustomerEntity();
       $entity->setName('testCustomer');
       $entity->setStatus(1);
       $entity->setAddress('testAddress');

       $this->storage->add($entity);
       $this->id=$this->storage->getLastId();

       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getName(), 'testCustomer');
       $this->assertEquals($returnEntity->getStatus(), 1);
       $this->assertEquals($returnEntity->getAddress(), 'testAddress');
    }

    public function testUpdateStorage()
    {
       $this->testAddStorage();

       $entity=$this->getValueDB();

       $entity->setName('testUpdateProduct');
       $entity->setStatus(0);
       $entity->setAddress('testUpdateAddress');

       $this->storage->save($entity);
       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getName(), 'testUpdateProduct');
       $this->assertEquals($returnEntity->getStatus(), 0);
       $this->assertEquals($returnEntity->getAddress(), 'testUpdateAddress');
    }

    public function testDeleteStorage(){
        $this->testAddStorage();

        $this->storage->delete($this->id);

        $entity=$this->getValueDB();

        $this->assertNull($entity->getId());
        $this->assertNull($entity->getName());
        $this->assertNull($entity->getStatus());
        $this->assertNull($entity->getAddress());
    } 

}