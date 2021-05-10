<?php

namespace app\services;

use Yii;

use app\storage\ItemStorage\ItemInterface;
use app\entities\ItemEntity;
use app\models\ItemForm;

use yii\base\Component;
use app\services\event\ItemServiceEvent;

class ItemService extends Component
{

	const EVENT_AFTER_ADD = 'AfterAdd';

	const EVENT_AFTER_DELETE = 'AfterDelete';

	const EVENT_AFTER_UPDATE = 'AfterUpdate';

	private $storage;

	public function __construct(ItemInterface $storage){
			$this->storage=$storage;
	} 

	public function AddModel(ItemForm $model){
		$entity= new ItemEntity();

		$entity->setId_invoice($model->id_invoice);
		$entity->setId_product($model->id_product);
		$entity->setCost($model->cost);
		$entity->setWeight($model->weight);
		$entity->setTotal($model->weight*$model->cost);

		$this->storage->add($entity);
		$this->afterAdd($entity->getId_invoice());		
	}

	public function LoadModelArray($id){
		$entity=$this->storage->findOne($id);

		$id=$entity->getId();
		$id_invoice=$entity->getId_invoice();
		$id_product=$entity->getId_product();
		$cost=$entity->getCost();
		$weight=$entity->getWeight();
		$total=$entity->getTotal();
		
		return compact('id','id_invoice', 'id_product', 'cost', 'weight', 'total');
	}

	public function DeleteModel($id){
		$entity=$this->storage->findOne($id);

		$this->storage->delete($id);
		$this->afterDelete($entity->getId_invoice());
	}

	public function UpdateModel(ItemForm $model){
		$entity = new ItemEntity();

		$entity->setId($model->id);
		$entity->setId_invoice($model->id_invoice);
		$entity->setId_product($model->id_product);
		$entity->setCost($model->cost);
		$entity->setWeight($model->weight);
		$entity->setTotal($model->weight*$model->cost);
		
		$this->storage->save($entity);
		$this->afterUpdate($entity->getId_invoice());		
	}
	
	public function getLastId(){
		return $this->storage->getLastId();
	}

	public function afterAdd($id)
    {
        $event = new ItemServiceEvent();
        $event->id_invoice=$id;
        $this->trigger(self::EVENT_AFTER_ADD, $event);
    }

    public function afterDelete($id)
    {
        $event = new ItemServiceEvent();
        $event->id_invoice=$id;
        $this->trigger(self::EVENT_AFTER_DELETE, $event);
    }

    public function afterUpdate($id)
    {
        $event = new ItemServiceEvent();
        $event->id_invoice=$id;
        $this->trigger(self::EVENT_AFTER_UPDATE, $event);
    }
}