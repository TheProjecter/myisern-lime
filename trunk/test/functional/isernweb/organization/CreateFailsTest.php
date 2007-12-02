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
        checkResponseElement('body', '/Create Organization/');
    $this->b->test()->is($oldCount,OrganizationPeer::doCount(new Criteria()), "Organization count should still be $oldCount");
  }  
}

$test = new OrganizationTest();
$test->execute();
