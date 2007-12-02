<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_list() 
  {
  	 $this->b->get('/researcher/list')->
    	checkResponseElement('body', '/Researcher/')->
    	checkResponseElement('body', '/Name/')->
    	checkResponseElement('body', '/' . $this->Researchers['r1']['name'] . '/')->
    	checkResponseElement('body', '/' . $this->Researchers['r2']['name'] . '/');        
  }
}

$test = new ResearcherTest();
$test->execute();
