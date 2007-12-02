<?php

$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_create_ok() 
  {
  	$oldCount = CollaborationPeer::doCount(new Criteria());
  	$organizations = OrganizationPeer::doSelect(new Criteria());
  	$organization1_id = $organizations[0]->getId();
    $organization2_id = $organizations[1]->getId();
    
  	$this->b->test()->ok($organization1_id, "Should get organization " .$organization1_id );
    $this->b->test()->ok($organization2_id, "Should get organization " .$organization2_id );  	
    $this->b->get('/collaboration/list')->
    	checkResponseElement('body', '/Collaboration/')->
    	checkResponseElement('body', '/Name/');
    $this->b->click('Create Collaboration')->
        checkResponseElement('body', '/Create Collaboration/');
    $this->b->click('save',array('name' => 'Kenglish','collaboratingOrganizations' => array($organization1_id,$organization2_id ) ) )->
        isRedirected()->
     	followRedirect()->    
        checkResponseElement('body', '/View Collaboration/')->
		checkResponseElement('body', '/Kenglish/');        
    $this->b->test()->is($oldCount+1, CollaborationPeer::doCount(new Criteria()), "Collaboration count should be " . ($oldCount + 1));
  }  
}

$test = new CollaborationTest();
$test->execute();
