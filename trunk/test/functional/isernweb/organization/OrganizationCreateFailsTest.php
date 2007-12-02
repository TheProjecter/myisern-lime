<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_create_fails() 
  {
  	
  	$oldCount = OrganizationPeer::doCount(new Criteria());
  
    $this->b->get('/organization/list')->
    	checkResponseElement('body', '/Organization/')->
    	checkResponseElement('body', '/Name/');
    $this->b->click('Create Organization')->
        checkResponseElement('body', '/Create\/Edit Organization/');
  }  
}

$test = new OrganizationTest();
$test->execute();
