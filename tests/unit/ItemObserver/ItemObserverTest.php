<?php 

namespace ItemObserver;

use Yii;

use app\observer\ItemObserver;

use app\services\ItemService;
use app\services\InvoiceFullEntityService;
use app\models\ItemForm;

use app\tests\fixtures\CustomerFixture;
use app\tests\fixtures\InvoiceFixture;
use app\tests\fixtures\ListItemsFixture;

class ItemObserverTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $observer; 
    
    protected function _before()
    {
      $ItemStorage=Yii::$container->get('app\storage\ItemStorage\ItemInterface');
      $ItemService=new ItemService($ItemStorage);

      $InvoiceStorageExtended=Yii::$container->get('app\storage\InvoiceStorage\InvoiceInterfaceExtended');
      $InvoiceFullEntityService=new InvoiceFullEntityService($InvoiceStorageExtended);

      $this->observer=new ItemObserver($ItemService, $InvoiceFullEntityService);

      $this->tester->haveFixtures([
            'customers' => [
                'class' => CustomerFixture::className(),
                'dataFile' => codecept_data_dir() . 'customer.php'
            ]
        ]); 

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
    public function testItemObserverAddModel()
    {
        $fields=['id' => 0, 'id_product' => 1, 'id_invoice' => 1, 'cost' => 1.2, 'weight' => 1.2];
        $model=new ItemForm($fields);

         $this->observer->AddModel($model);

        $Collection=$this->observer->SlaveService->LoadFullInvoice(1);
        
        $this->assertEquals($Collection['head']['id'], 1);
        $this->assertEquals($Collection['head']['date'], '01 January 2014');
        $this->assertEquals($Collection['head']['customer_name'], 'customer1');
        $this->assertEquals($Collection['head']['sum'], '$3.54');
        $this->assertEquals($Collection['head']['total_weight'], '3.30');
    }

    public function testItemObserverUpdateModel()
    {
       $returnValueModel=$this->observer->MasterService->LoadModelArray(1);

       $fields=['id' => $returnValueModel['id'], 'id_product' => 2, 'id_invoice' => $returnValueModel['id_invoice'], 'cost' => 1.3, 'weight' => 1.3];
       $model=new ItemForm($fields);

       $this->observer->UpdateModel($model);

      $Collection=$this->observer->SlaveService->LoadFullInvoice(1);

      $this->assertEquals($Collection['head']['id'], 1);
      $this->assertEquals($Collection['head']['date'], '01 January 2014');
      $this->assertEquals($Collection['head']['customer_name'], 'customer1');
      $this->assertEquals($Collection['head']['sum'], '$2.79');
      $this->assertEquals($Collection['head']['total_weight'], '2.40'); 
    }

    public function testItemObserverDeleteModel(){
        $this->observer->DeleteModel(1);

        $Collection=$this->observer->SlaveService->LoadFullInvoice(1);

        $this->assertEquals($Collection['head']['id'], 1);
        $this->assertEquals($Collection['head']['date'], '01 January 2014');
        $this->assertEquals($Collection['head']['customer_name'], 'customer1');
        $this->assertEquals($Collection['head']['sum'], '$1.10');
        $this->assertEquals($Collection['head']['total_weight'], '1.10');
    }
}