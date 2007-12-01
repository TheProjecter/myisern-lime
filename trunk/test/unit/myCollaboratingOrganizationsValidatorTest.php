<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myUser.class.php');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myCollaboratingOrganizationsValidator.class.php');
require(dirname(__FILE__).'/../../plugins/sfPropelTestPlugin/bootstrap/propel-unit.php');

class myCollaboratingOrganizationsValidatorTest extends sfPropelTest
{
  public function setup() {
    $context = sfContext::getInstance();
    $this->request = $context->getRequest();
    $this->manager = new sfValidatorManager();
    $this->manager->initialize($context);
    $validator = new myCollaboratingOrganizationsValidator();
    $validator->initialize($context);
    $this->manager->registerName('collaboratingOrganizations', false);
    $this->manager->registerValidator('collaboratingOrganizations', $validator);
  }
  public function teardown() {
    $this->request->removeError('collaboratingOrganizations');
  }
  public function test_validator_success()
  {
  	
    // we must have at least 2 collaborating organizations.
  	$collaboratingOrganizations = array('val1','val2'); 
 
    $this->request->setParameter('collaboratingOrganizations', $collaboratingOrganizations);
    $retval = $this->manager->execute();
    $this->is($retval, true, "validator should return true");
    $this->is($this->request->getErrors(), Array(), "errors should be an empty array");
  }
  
  public function test_validator_failure()
  {
  	
    // we must have at least 2 collaborating organizations.  	
  	$collaboratingOrganizations = array('val1'); 
 
    $this->request->setParameter('collaboratingOrganizations', $collaboratingOrganizations);
    $retval = $this->manager->execute();
    $this->is($retval, false, "validator should return false");
    $this->ok(sizeof($this->request->getErrors()) > 0 ,  "errors should not be an empty array");
  }  

}

$test = new myCollaboratingOrganizationsValidatorTest();
$test->execute();
