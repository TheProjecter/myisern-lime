<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myUser.class.php');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myLoginValidator.class.php');
require(dirname(__FILE__).'/../../plugins/sfPropelTestPlugin/bootstrap/propel-unit.php');

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
    $this->request->setParameter('password', 'isern2008');
    $retval = $this->manager->execute();
    $this->is($retval, true, "validator should return true");
    $this->is($this->request->getErrors(), Array(), "errors should be an empty array");
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
  public function test_validator_bad_password()
  {
    $this->request->setParameter('login', 'isern');
    $this->request->setParameter('password', 'isern2008xxx');
    $retval = $this->manager->execute();
    $this->is($retval, false, "validator should return true");
    $this->ok(sizeof($this->request->getErrors()) > 0, "errors should not be an empty array");
  }  
}

$test = new myLoginValidatorTest();
$test->execute();
