<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_list() 
  {
  	 $this->b->get('/collaboration/list')->
    	checkResponseElement('body', '/Collaboration/')->
    	checkResponseElement('body', '/Name/')->
    	checkResponseElement('body', '/' . $this->Collaborations['c1']['name'] . '/')->
    	checkResponseElement('body', '/' . $this->Collaborations['c2']['name'] . '/');        
  }
}

$test = new CollaborationTest();
$test->execute();
