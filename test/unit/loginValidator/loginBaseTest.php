<?php

define('SF_APP', 'isernweb');

require(dirname(__FILE__).'/../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class LoginBaseTest extends sfPropelTest
{
  public function setup() {
    $context = sfContext::getInstance();
    $this->request = $context->getRequest();
    $this->manager = new sfValidatorManager();
    $this->manager->initialize($context);
    $validator = new myLoginValidator();
    $validator->initialize($context, array('password' => 'password'));
    $this->manager->registerName('login', false);
    $this->manager->registerValidator('login', $validator);
  }
  public function teardown() {
    $this->request->removeError('login');
  }
  public function test_validator_bad_password()
  {
    $this->request->setParameter('login', 'isern');
    $this->request->setParameter('password', 'isern2008xxx');
    $retval = $this->manager->execute();
    $this->is($retval, false, "validator should return true");
    $this->ok(sizeof($this->request->getErrors()) > 0, "errors should not be an empty array");
  }  
}
