<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/loginBaseTest.php');

class myLoginValidatorTest extends sfPropelTest
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
  public function test_validator_success()
  {
    $this->request->setParameter('login', 'isern');
    $this->request->setParameter('password', 'testpassword');
    $retval = $this->manager->execute();
    $this->is($retval, true, "validator should return true");
    $this->is($this->request->getErrors(), Array(), "errors should be an empty array");
  }
}

$test = new myLoginValidatorTest();
$test->execute();
