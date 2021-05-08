<?php 

namespace Decorate;

use app\DecorateView\DecorateView\DecorateBaseAction;
use app\DecorateView\DecorateView\DecorateEmptyAction;
use app\DecorateView\DecorateView\DecorateAddUpdateDeleteAction;

use app\components\User\UserComponent;

use Yii;

use app\tests\fixtures\UserFixture;

class DecorateTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $_user_tester;

    private $_user_admin;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);

        $this->_user_admin=UserComponent::findIdentity(1);
        $this->_user_tester=UserComponent::findIdentity(2);
    }

    protected function _after()
    {
    }

    // tests
    public function testDecorateEmpty()
    {
        $panel = new DecorateBaseAction();
        $decorate = new DecorateEmptyAction($panel, 'controller');

        $getAdd=$decorate->writeAdd();
        $getAction=$decorate->writeAction(1);

        $this->assertEquals($getAdd, '');
        $this->assertEquals($getAction, '<span class="glyphicon glyphicon-ban-circle"></span>');
    }

    public function testDecorateAddUpdateDeleteTester()
    {
        Yii::$app->user->login($this->_user_tester);

        $panel = new DecorateBaseAction();
        $decorate = new DecorateAddUpdateDeleteAction($panel, 'controller');

        $getAdd=$decorate->writeAdd();
        $getAction=$decorate->writeAction(1);

        $this->assertEquals($getAdd, '');
        $this->assertEquals($getAction, '<span class="glyphicon glyphicon-ban-circle"></span>');

        Yii::$app->user->logout();
    }

    public function testDecorateAddUpdateDeleteAdmin()
    {
        Yii::$app->user->login($this->_user_admin);

        $panel = new DecorateBaseAction();
        $decorate = new DecorateAddUpdateDeleteAction($panel, 'controller');

        $getAdd=$decorate->writeAdd();
        $getAction=$decorate->writeAction(1);

        $ResultGetAdd = '<a id="elAdd" class="btn btn-primary" href="/controller/controller/controller-add">Add</a>';

        
        $ResultGetDelete = '<a href="/controller/controller/controller-delete" data-method="POST" data-params='."'".'{"id":1}'."'".'><span class="glyphicon glyphicon-trash"></span></a>';

        $ResultGetUpdate = '<a href="/controller/controller/controller-update?id=1"><span class="glyphicon glyphicon-pencil"></span></a>';
        
        $DeleteUpdate = $ResultGetDelete.$ResultGetUpdate;

        $this->assertEquals($getAdd, $ResultGetAdd);
        $this->assertEquals($getAction,  $DeleteUpdate);

        Yii::$app->user->logout();
    }
}