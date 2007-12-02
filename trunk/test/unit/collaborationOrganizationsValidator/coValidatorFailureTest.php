<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__) .'/coBaseTest.php');

class COTest extends COBaseTest
{

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

$test = new COTest();
$test->execute();
