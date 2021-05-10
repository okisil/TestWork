<?php 

namespace Item;

use Yii;

use app\storage\ItemStorage\ItemPlace;
use app\entities\ItemEntity;

use app\tests\fixtures\InvoiceFixture;
use app\tests\fixtures\ListItemsFixture;

class ItemStorageTest extends \Codeception\Test\Unit
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
        $this->storage= new ItemPlace(Yii::$app->db);

        $this->tester->haveFixtures([
            'invoices' => [
                'class' => InvoiceFixture::className(),
                'dataFile' => codecept_data_dir() . 'invoice.php'
            ]
        ]);

        $this->tester->haveFixtures([
            'listitems' => [
                'class' => ListItemsFixture::className(),
                'dataFile' => codecept_data_dir() . 'listitems.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testAddStorage()
    {
       $entity= new ItemEntity();
       $entity->setId_invoice(1);
       $entity->setId_product(1);
       $entity->setCost(1.1);
       $entity->setWeight(1.1);
       $entity->setTotal(1.21);


       $this->storage->add($entity);
       $this->id=$this->storage->getLastId();

       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getId_invoice(), 1);
       $this->assertEquals($returnEntity->getId_product(), 1);
       $this->assertEquals($returnEntity->getCost(), 1.1);
       $this->assertEquals($returnEntity->getWeight(), 1.1);
       $this->assertEquals($returnEntity->getTotal(), 1.21);
    }

    public function testUpdateStorage()
    {
       $this->testAddStorage();

       $entity=$this->getValueDB();

       $entity->setId_product(2);
       $entity->setId_invoice(2);
       $entity->setCost(1.2);
       $entity->setWeight(1.3);
       $entity->setTotal(1.56);

       $this->storage->save($entity);
       $returnEntity=$this->getValueDB();

       $this->assertEquals($returnEntity->getId(), $this->id);
       $this->assertEquals($returnEntity->getId_invoice(), 2);
       $this->assertEquals($returnEntity->getId_product(), 2);
       $this->assertEquals($returnEntity->getCost(), 1.2);
       $this->assertEquals($returnEntity->getWeight(), 1.3);
       $this->assertEquals($returnEntity->getTotal(), 1.56);
    }

    public function testDeleteStorage(){
       $this->testAddStorage();

       $this->storage->delete($this->id);

       $entity=$this->getValueDB();

       $this->assertNull($entity->getId());
       $this->assertNull($entity->getId_invoice());
       $this->assertNull($entity->getId_product());
       $this->assertNull($entity->getCost());
       $this->assertNull($entity->getWeight());
       $this->assertNull($entity->getTotal());
    }
}