<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_create_ok() 
  {
  	
  	$oldCount = OrganizationPeer::doCount(new Criteria());
  
    $this->b->get('/organization/list')->
    	checkResponseElement('body', '/Organization/')->
    	checkResponseElement('body', '/Name/');
    $this->b->click('Create Organization')->
        checkResponseElement('body', '/Create Organization/');
    $this->b->click('save',array('name' => 'my new org'))->
        isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/View Organization/') ;
    $this->b->test()->is($oldCount+1,OrganizationPeer::doCount(new Criteria()), "Organization count should still be " . ($oldCount+1));
  }  
}

$test = new OrganizationTest();
$test->execute();
