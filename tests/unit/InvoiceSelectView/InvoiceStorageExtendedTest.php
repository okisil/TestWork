<?php 

namespace InvoiceSelectView;

use app\storage\InvoiceStorage\InvoicePlaceExtended;
use Yii;

use app\tests\fixtures\InvoiceFixture;
use app\tests\fixtures\CustomerFixture;
use app\tests\fixtures\ProductFixture;
use app\tests\fixtures\ListItemsFixture;

class InvoiceStorageExtendedTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->storage= new InvoicePlaceExtended(Yii::$app->db);

        $this->tester->haveFixtures([
            'invoices' => [
                'class' => InvoiceFixture::className(),
                'dataFile' => codecept_data_dir() . 'invoice.php'
            ]
        ]);

        $this->tester->haveFixtures([
            'customers' => [
                'class' => CustomerFixture::className(),
                'dataFile' => codecept_data_dir() . 'customer.php'
            ]
        ]);

        $this->tester->haveFixtures([
            'products' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product.php'
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
    public function testFindFullEntity()
    {
        $entity=$this->storage->findFullEntity(1);

        $MainHead=$entity->getMainHead();

        $this->assertEquals($MainHead->getId(), 1);
        $this->assertEquals($MainHead->getDate(), '2014-01-01');
        $this->assertEquals($MainHead->getCustomer_name(), 'customer1');
        $this->assertEquals($MainHead->getSum(), 0);
        $this->assertEquals($MainHead->getTotal_weight(), 0);

        $DataInvoice=$entity->getDataInvoice();

        $this->assertEquals($DataInvoice[0]->getId(), 1);
        $this->assertEquals($DataInvoice[0]->getName_product(), 'product1');
        $this->assertEquals($DataInvoice[0]->getCost(), 1);
        $this->assertEquals($DataInvoice[0]->getWeight(), 1);
        $this->assertEquals($DataInvoice[0]->getTotal(), 1);

        $this->assertEquals($DataInvoice[1]->getId(), 2);
        $this->assertEquals($DataInvoice[1]->getName_product(), 'product2');
        $this->assertEquals($DataInvoice[1]->getCost(), 1);
        $this->assertEquals($DataInvoice[1]->getWeight(), 1.1);
        $this->assertEquals($DataInvoice[1]->getTotal(), 1.1);
    }

    public function testFindDate(){
        $entites=$this->storage->findDate('2014-01-01');

        $this->assertEquals($entites[0]->getMainHead()->getId(), 1);
        $this->assertEquals($entites[0]->getMainHead()->getDate(), '2014-01-01');
        $this->assertEquals($entites[0]->getMainHead()->getCustomer_name(), 'customer1');
        $this->assertEquals($entites[0]->getMainHead()->getSum(), 0);
        $this->assertEquals($entites[0]->getMainHead()->getTotal_weight(), 0);

        $this->assertEquals($entites[1]->getMainHead()->getId(), 2);
        $this->assertEquals($entites[1]->getMainHead()->getDate(), '2014-01-01');
        $this->assertEquals($entites[1]->getMainHead()->getCustomer_name(), 'customer2');
        $this->assertEquals($entites[1]->getMainHead()->getSum(), 0);
        $this->assertEquals($entites[1]->getMainHead()->getTotal_weight(), 0);
    }

    public function testFindBetweenDate(){
        $entites=$this->storage->findBetweenDate('2014-01-01', '2014-01-01', 2, 0, [1]);
    
        $this->assertEquals($entites[0]->getMainHead()->getId(), 1);
        $this->assertEquals($entites[0]->getMainHead()->getDate(), '2014-01-01');
        $this->assertEquals($entites[0]->getMainHead()->getCustomer_name(), 'customer1');
        $this->assertEquals($entites[0]->getMainHead()->getSum(), 0);
        $this->assertEquals($entites[0]->getMainHead()->getTotal_weight(), 0);
    }


    public function testCountBetweenDate(){
        $count=$this->storage->CountBetweenDate('2014-01-01', '2014-01-01', [1, 2]);
        $this->assertEquals($count['COUNT(*)'], 2);
        
    }
}