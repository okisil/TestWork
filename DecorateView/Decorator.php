<?php 

namespace app\DecorateView;

class Decorator implements Paint
{
    
    protected $component;

    private $_nameController;

    public function __construct(Paint $component, $nameController)
    {
        $this->component = $component;
        $this->_nameController=$nameController;
    }

    function getNameController(){
    	return $this->_nameController;
    }

    public function writeAction(int $id): string
    {
        return $this->component->writeAction($id);
    }

    public function writeAdd(): string
    {
        return $this->component->writeAdd();
    }
}