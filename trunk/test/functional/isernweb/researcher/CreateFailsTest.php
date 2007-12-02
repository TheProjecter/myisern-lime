<?php

$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_create_fails() 
  {
  	$oldCount = ResearcherPeer::doCount(new Criteria());
    $this->b->get('/researcher/list')->
    	checkResponseElement('body', '/Researcher/')->
    	checkResponseElement('body', '/Name/');
    
    $this->b->click('Create Researcher')->
        checkResponseElement('body', '/Create Researcher/');
    $this->b->click('save')->    
        checkResponseElement('body', '/Create Researcher/')->
		checkResponseElement('body', '/The name field cannot be left blank/');   
    $this->b->click('save',array('name' => 'Kenglish'))->    
        checkResponseElement('body', '/Create Researcher/')->
		checkResponseElement('body', '/The organization field cannot be left blank/');        
    $this->b->test()->is($oldCount, ResearcherPeer::doCount(new Criteria()), "Researcher count should still be $oldCount");
  }  
}

$test = new ResearcherTest();
$test->execute();
