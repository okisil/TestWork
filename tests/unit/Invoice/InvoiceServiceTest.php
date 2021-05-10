<?php 

namespace Invoice;

use Yii;

use app\services\InvoiceService;
use app\storage\InvoiceStorage\InvoiceInterface;
use app\models\InvoiceForm;

class InvoiceServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;

    private $id;
    
    protected function _before()
    {
        $InvoiceStorage=Yii::$container->get('app\storage\InvoiceStorage\InvoiceInterface');
        $this->service=new InvoiceService($InvoiceStorage);
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
        $fields=['id' => null, 'date' => '1-1-2020', 'id_customer' => 1];
        $model=new InvoiceForm($fields);

        $this->service->AddModel($model);
        $this->id=$this->service->getLastId();

        $returnValueModel=$this->getValueService();

        $this->assertEquals($returnValueModel['id'], $this->id);
        $this->assertEquals($returnValueModel['date'], '1-1-2020');
        $this->assertEquals($returnValueModel['id_customer'], 1);
    }

    public function testUpdateServiceModel()
    {
       $this->testAddServiceModel();

       $returnValueModelIn=$this->getValueService();

       $fields=['id' => $returnValueModelIn['id'], 'date' => '2-1-2020', 'id_customer' => 2];
       $model=new InvoiceForm($fields);

       $this->service->UpdateModel($model);

       $returnValueModelOut=$this->getValueService();

       $this->assertEquals($returnValueModelOut['id'], $this->id);
       $this->assertEquals($returnValueModelOut['date'], '2-1-2020');
       $this->assertEquals($returnValueModelOut['id_customer'], 2);
       $this->assertSame($returnValueModelIn['sum'], $returnValueModelOut['sum']);
       $this->assertSame($returnValueModelIn['total_weight'], $returnValueModelOut['total_weight']);
    }

    public function testDeleteServiceModel(){
        $this->testAddServiceModel();

        $this->service->DeleteModel($this->id);

        $returnValueModel=$this->getValueService();

        $this->assertNull($returnValueModel['id']);
        $this->assertNull($returnValueModel['date']);
        $this->assertNull($returnValueModel['id_customer']);
    }
}