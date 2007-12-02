<?php

$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_create_fails() 
  {
  	$oldCount = CollaborationPeer::doCount(new Criteria());
  	$organizations = OrganizationPeer::doSelect(new Criteria());
  	$organization1_id = $organizations[0]->getId();
  	$this->b->test()->ok($organization1_id, "Should get organization " .$organization1_id );
    $this->b->get('/collaboration/list')->
    	checkResponseElement('body', '/Collaboration/')->
    	checkResponseElement('body', '/Name/');
    $this->b->click('Create Collaboration')->
        checkResponseElement('body', '/Create Collaboration/');
    $this->b->click('save',array('name' => 'Collabor 101','collaboratingOrganizations' => array($organization1_id) ) )->
        checkResponseElement('body', '/Create Collaboration/')->
		checkResponseElement('body', '/Collaboration must contain at least two organizations/');        
    $this->b->test()->is($oldCount, CollaborationPeer::doCount(new Criteria()), "Collaboration count should still be $oldCount"); 	
  }  
}

$test = new CollaborationTest();
$test->execute();
