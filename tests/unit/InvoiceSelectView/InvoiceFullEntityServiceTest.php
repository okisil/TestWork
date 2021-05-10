<?php 

namespace InvoiceSelectView;

use Yii;
use app\services\InvoiceFullEntityService;

use app\tests\fixtures\InvoiceFixture;
use app\tests\fixtures\CustomerFixture;
use app\tests\fixtures\ProductFixture;
use app\tests\fixtures\ListItemsFixture;

class InvoiceFullEntityServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;
    
    protected function _before()
    {
        $InvoiceStorageExtended=Yii::$container->get('app\storage\InvoiceStorage\InvoiceInterfaceExtended');
        $this->service=new InvoiceFullEntityService($InvoiceStorageExtended);

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
    public function testLoadFullInvoice()
    {
        $Collection=$this->service->LoadFullInvoice(1);

        $this->assertEquals($Collection['head']['id'], 1);
        $this->assertEquals($Collection['head']['date'], '01 January 2014');
        $this->assertEquals($Collection['head']['customer_name'], 'customer1');
        $this->assertEquals($Collection['head']['sum'], '$0.00');
        $this->assertEquals($Collection['head']['total_weight'], '0');

        $this->assertEquals($Collection['items'][0]['id'], 1);
        $this->assertEquals($Collection['items'][0]['name_product'], 'product1');
        $this->assertEquals($Collection['items'][0]['cost'], 1);
        $this->assertEquals($Collection['items'][0]['weight'], 1);
        $this->assertEquals($Collection['items'][0]['total'], 1);

        $this->assertEquals($Collection['items'][1]['id'], 2);
        $this->assertEquals($Collection['items'][1]['name_product'], 'product2');
        $this->assertEquals($Collection['items'][1]['cost'], 1);
        $this->assertEquals($Collection['items'][1]['weight'], 1.1);
        $this->assertEquals($Collection['items'][1]['total'], 1.1);
    }

    public function testRecountInvoice(){
        $this->service->recountInvoice(1);

        $Collection=$this->service->LoadFullInvoice(1);
        
        $this->assertEquals($Collection['head']['id'], 1);
        $this->assertEquals($Collection['head']['date'], '01 January 2014');
        $this->assertEquals($Collection['head']['customer_name'], 'customer1');
        $this->assertEquals($Collection['head']['sum'], '$2.10');
        $this->assertEquals($Collection['head']['total_weight'], '2.10');
    }

    public function testCountBetweenDate(){
        $count=$this->service->CountBetweenDate('2014-01-01', '2014-01-01');
        $this->assertEquals($count, 2);
    }

    public function testLoadCollectionBetweenDate(){
        $Collection=$this->service->LoadCollectionBetweenDate('2014-01-01', '2014-01-01', 2, 0);
         
        $this->assertEquals($Collection[0]['id'], 1);
        $this->assertEquals($Collection[0]['date'], '2014-01-01');
        $this->assertEquals($Collection[0]['customer_name'], 'customer1');
        $this->assertEquals($Collection[0]['sum'], 0);
        $this->assertEquals($Collection[0]['total_weight'], 0);

        $this->assertEquals($Collection[1]['id'], 2);
        $this->assertEquals($Collection[1]['date'], '2014-01-01');
        $this->assertEquals($Collection[1]['customer_name'], 'customer2');
        $this->assertEquals($Collection[1]['sum'], 0);
        $this->assertEquals($Collection[1]['total_weight'], 0);
    }

    public function testSortCollectionBetweenDate(){
        $Collection=$this->service->SortCollectionBetweenDate('2014-01-01', '2014-01-01', 2, 0);

        $this->assertEquals($Collection[0]->date, '2014-01-01');
        $this->assertEquals(count($Collection[0]->storage), 2); 
    }
}