<?php 

namespace Customer;

use Yii;

use app\services\CustomerService;
use app\storage\CustomerStorage\CustomerInterface;
use app\models\CustomerForm;


class CustomerServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;

    private $id;
    
    protected function _before()
    {
        $CustomerStorage=Yii::$container->get('app\storage\CustomerStorage\CustomerInterfaceExtended');
        $this->service=new CustomerService($CustomerStorage);
    }

    protected function _after()
    {
    }

    private function getValueService(){
        return $this->service->LoadModelArray($this->id);
    }

    public function testAddServiceModel()
    {   
        $fields=['id' => 0, 'name' => 'testName', 'status' => 0, 'address' => 'testAddress'];
        $model=new CustomerForm($fields);

        $this->service->AddModel($model);
        $this->id=$this->service->getLastId();

        $returnValueModel=$this->getValueService();
        
        $this->assertEquals($returnValueModel['id'], $this->id);
        $this->assertEquals($returnValueModel['name'], 'testName');
        $this->assertEquals($returnValueModel['status'], 0);
        $this->assertEquals($returnValueModel['address'], 'testAddress');
    }

    public function testUpdateServiceModel()
    {
       $this->testAddServiceModel();

       $returnValueModel=$this->getValueService();

       $fields=['id' => $returnValueModel['id'], 'name' => 'testUpdateName', 'status' => 1, 'address' => 'testUpdateAddress'];
       $model=new CustomerForm($fields);

       $this->service->UpdateModel($model);

       $returnValueModel=$this->getValueService();

       $this->assertEquals($returnValueModel['id'], $this->id);
       $this->assertEquals($returnValueModel['name'], 'testUpdateName');
       $this->assertEquals($returnValueModel['status'], 1);
       $this->assertEquals($returnValueModel['address'], 'testUpdateAddress');
    }

    public function testDeleteServiceModel(){
        $this->testAddServiceModel();

        $this->service->DeleteModel($this->id);

        $returnValueModel=$this->getValueService();

        $this->assertNull($returnValueModel['id']);
        $this->assertNull($returnValueModel['name']);
        $this->assertNull($returnValueModel['status']);
        $this->assertNull($returnValueModel['address']);
    }
}