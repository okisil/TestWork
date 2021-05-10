<?php 

namespace Item;

use Yii;

use app\services\ItemService;
use app\models\ItemForm;

use app\tests\fixtures\InvoiceFixture;
use app\tests\fixtures\ListItemsFixture;

class ItemServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;

    private $id;
    
    protected function _before()
    {
        $ItemStorage=Yii::$container->get('app\storage\ItemStorage\ItemInterface');
        $this->service=new ItemService($ItemStorage);

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

    private function getValueService(){
        return $this->service->LoadModelArray($this->id);
    }

    // tests
    public function testAddServiceModel()
    {
        $fields=['id' => 0, 'id_product' => 1, 'id_invoice' => 1, 'cost' => 1.2, 'weight' => 1.2];
        $model=new ItemForm($fields);

        $this->service->AddModel($model);
        $this->id=$this->service->getLastId();

        $returnValueModel=$this->getValueService();

        $this->assertEquals($returnValueModel['id'], $this->id);
        $this->assertEquals($returnValueModel['id_product'], 1);
        $this->assertEquals($returnValueModel['id_invoice'], 1);
        $this->assertEquals($returnValueModel['cost'], 1.2);
        $this->assertEquals($returnValueModel['weight'], 1.2);
        $this->assertEquals($returnValueModel['total'], 1.44);
    }

    public function testUpdateServiceModel()
    {
       $this->testAddServiceModel();

       $returnValueModel=$this->getValueService();

       $fields=['id' => $returnValueModel['id'], 'id_product' => 2, 'id_invoice' => $returnValueModel['id_invoice'], 'cost' => 1.3, 'weight' => 1.3];
       $model=new ItemForm($fields);

       $this->service->UpdateModel($model);

       $returnValueModel=$this->getValueService();

       $this->assertEquals($returnValueModel['id'], $this->id);
       $this->assertEquals($returnValueModel['id_product'], 2);
       $this->assertEquals($returnValueModel['cost'], 1.3);
       $this->assertEquals($returnValueModel['weight'], 1.3);
       $this->assertEquals($returnValueModel['total'], 1.69);
    }

    public function testDeleteServiceModel(){
        $this->testAddServiceModel();

        $this->service->DeleteModel($this->id);

        $returnValueModel=$this->getValueService();

        $this->assertNull($returnValueModel['id']);
        $this->assertNull($returnValueModel['id_product']);
        $this->assertNull($returnValueModel['id_invoice']);
        $this->assertNull($returnValueModel['cost']);
        $this->assertNull($returnValueModel['weight']);
        $this->assertNull($returnValueModel['total']);
    }
}