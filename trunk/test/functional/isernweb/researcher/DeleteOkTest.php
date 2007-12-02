<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_delete_ok() 
  {
  	$oldCount = ResearcherPeer::doCount(new Criteria());
    $this->goto_edit();      
    $this->b->click('delete')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/Researchers/')->
        checkResponseElement('body', '!/'. $this->Researchers['r1']['name'] .'/');
    $this->b->test()->is($oldCount-1, ResearcherPeer::doCount(new Criteria()), "Researcher count should still be one less than $oldCount");                  
  }
}

$test = new ResearcherTest();
$test->execute();
