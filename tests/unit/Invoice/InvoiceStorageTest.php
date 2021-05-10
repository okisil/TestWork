<?php 

namespace Invoice;

use Yii;

use app\storage\InvoiceStorage\InvoicePlace;
use app\entities\InvoiceEntity;

class InvoiceStorageTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $id;

    private function getValueDB(){
        return $this->storage->findOne($this->id);
    }
    
    protected function _before()
    {
        $this->storage= new InvoicePlace(Yii::$app->db);
    }

    protected function _after()
    {
    }

    // tests
    public function testAddStorage()
    {
       $entity= new InvoiceEntity();
       $entity->setDate('2020-01-01');
       $entity->setId_customer(1);
       $entity->setSum(0);
       $entity->setTotal_weight(0);

       $this->storage->add($entity);
       $this->id=$this->storage->getLastId();

       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getDate(), '2020-01-01');
       $this->assertEquals($returnEntity->getId_customer(), 1);
       $this->assertEquals($returnEntity->getSum(), 0);
       $this->assertEquals($returnEntity->getTotal_weight(), 0);
    }

    public function testUpdateStorage()
    {
       $this->testAddStorage();

       $entity=$this->getValueDB();

       $entity->setDate('2021-01-01');
       $entity->setId_customer(2);
       $entity->setSum(1);
        $entity->setTotal_weight(1);

       $this->storage->save($entity);
       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getDate(), '2021-01-01');
       $this->assertEquals($returnEntity->getId_customer(), 2);
       $this->assertEquals($returnEntity->getSum(), 1);
       $this->assertEquals($returnEntity->getTotal_weight(), 1);
    }

    public function testDeleteStorage(){
        $this->testAddStorage();

        $this->storage->delete($this->id);

        $entity=$this->getValueDB();

        $this->assertNull($entity->getId());
        $this->assertNull($entity->getDate());
        $this->assertNull($entity->getId_customer());
        $this->assertNull($entity->getSum());
        $this->assertNull($entity->getTotal_weight());
    } 
}