<?php 

namespace Product;

use Yii;

use app\services\ProductService;
//use app\storage\ProductStorage\ProductInterface;
use app\storage\ProductStorage\ProductInterfaceExtended;

use app\models\ProductForm;


class ProductServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $service;

    private $id;
    
    protected function _before()
    {
        $ProductStorageExtended=Yii::$container->get('app\storage\ProductStorage\ProductInterfaceExtended');
        $this->service=new ProductService($ProductStorageExtended);
    }

    protected function _after()
    {
    }

    private function getValueService(){
        return $this->service->LoadModelArray($this->id);
    }

    public function testAddServiceModel()
    {   
        $fields=['id' => 0, 'name' => 'testName'];
        $model=new ProductForm($fields);

        $this->service->AddModel($model);
        $this->id=$this->service->getLastId();

        $returnValueModel=$this->getValueService();
        
        $this->assertEquals($returnValueModel['id'], $this->id);
        $this->assertEquals($returnValueModel['name'], 'testName');
    }

    public function testUpdateServiceModel()
    {
       $this->testAddServiceModel();

       $returnValueModel=$this->getValueService();

       $fields=['id' => $returnValueModel['id'], 'name' => 'testUpdateName'];
       $model=new ProductForm($fields);

       $this->service->UpdateModel($model);

       $returnValueModel=$this->getValueService();

       $this->assertEquals($returnValueModel['id'], $this->id);
       $this->assertEquals($returnValueModel['name'], 'testUpdateName');
    }

    public function testDeleteServiceModel(){
        $this->testAddServiceModel();

        $this->service->DeleteModel($this->id);

        $returnValueModel=$this->getValueService();

        $this->assertNull($returnValueModel['id']);
        $this->assertNull($returnValueModel['name']);
    }
}