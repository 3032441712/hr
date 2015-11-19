<?php

require(dirname(dirname(__DIR__)).'/autoload.php');

class AuthTest extends PHPUnit_Framework_TestCase
{
    private $_auth = null;
    
    public function setUp()
    {
        $this->_auth = new backend\models\Auth();
    }

    public function testRules()
    {
        $rules = [
            ['name', 'required'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['name', 'string', 'min' => 3, 'max' => 64],
            ['name', 'validatePermission'],

            ['description', 'string', 'min' => 1, 'max' => 400],
        ];

        $this->assertEquals($rules, $this->_auth->rules());
    }

    public function testHasUsersByRole()
    {
        $this->assertEquals(1, $this->_auth->hasUsersByRole('admin'));
    }

    public function testHasRolesByPermission()
    {
        $this->assertEquals(1, $this->_auth->hasRolesByPermission('admin'));
    }
}