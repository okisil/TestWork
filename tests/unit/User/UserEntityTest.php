<?php 

namespace tests\unit\User;

use app\entities\UserEntity;

class UserEntityTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testUserEntity()
    {
        $newUser= new UserEntity();

        $newUser->setId(1);
        $newUser->setName('Oleg');
        $newUser->setLogin('kisiloleg1980@ukr.net');
        $newUser->setHash('a1a2a3a5a6');

        $this->assertEquals($newUser->getId(), 1);
        $this->assertEquals($newUser->getName(), 'Oleg');
        $this->assertEquals($newUser->getLogin(), 'kisiloleg1980@ukr.net');
        $this->assertEquals($newUser->getHash(), 'a1a2a3a5a6');
    }
}