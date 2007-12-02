<?php

$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_create_ok() 
  {
  	$oldCount = ResearcherPeer::doCount(new Criteria());
  	$organizations = OrganizationPeer::doSelect(new Criteria());
  	$organization = $organizations[0];
  	$this->b->test()->ok($organization->getId(), "Should get organization " .$organization->getId() );
    $this->b->get('/researcher/list')->
    	checkResponseElement('body', '/Researcher/')->
    	checkResponseElement('body', '/Name/');
    $this->b->click('Create Researcher')->
        checkResponseElement('body', '/Create Researcher/');
    $this->b->click('save',array('name' => 'Kenglish','organization_id' => $organization->getId() ))->
        isRedirected()->
     	followRedirect()->    
        checkResponseElement('body', '/View Researcher/')->
		checkResponseElement('body', '/Kenglish/');        
    $this->b->test()->is($oldCount+1, ResearcherPeer::doCount(new Criteria()), "Researcher count should still be $oldCount");
  }  
}

$test = new ResearcherTest();
$test->execute();
