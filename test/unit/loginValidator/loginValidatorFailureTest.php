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
  public function test_validator_failures()
  {
    $values =  array('invalid', 'testbad');
    $this->diag('myLoginValidator()');
    foreach ( $values as $value ) 
    {
      $this->setup();
      $this->request->setParameter('login', $value);
      $this->request->setParameter('password', $value);
      $retval = $this->manager->execute();
      $this->is($retval, false, "validator should return false for $value ");
      $this->ok(sizeof($this->request->getErrors()) > 0, "errors should not be an empty array");      
      $this->request->removeError('login');
    } 
  }
}

$test = new myLoginValidatorTest();
$test->execute();
