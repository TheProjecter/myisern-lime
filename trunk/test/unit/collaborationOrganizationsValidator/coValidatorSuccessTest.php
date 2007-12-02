<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__) .'/coBaseTest.php');

class COTest extends COBaseTest
{

  public function test_validator_success()
  {
  	
    // we must have at least 2 collaborating organizations.
  	$collaboratingOrganizations = array('val1','val2'); 
 
    $this->request->setParameter('collaboratingOrganizations', $collaboratingOrganizations);
    $retval = $this->manager->execute();
    $this->is($retval, true, "validator should return true");
    $this->is($this->request->getErrors(), Array(), "errors should be an empty array");
  }
}

$test = new COTest();
$test->execute();
