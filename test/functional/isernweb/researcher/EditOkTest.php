<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_edit_ok() 
  {
     $this->goto_edit();      
     $this->b->click('save')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/View Researcher/')->
        checkResponseElement('body', '/'. $this->Researchers['r1']['name'] .'/');          
  }
}

$test = new ResearcherTest();
$test->execute();
