<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_edit_ok() 
  {
     $this->goto_edit();      
     $this->b->click('save')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/View Collaboration/')->
        checkResponseElement('body', '/'. $this->Collaborations['c1']['name'] .'/');          
  }
}

$test = new CollaborationTest();
$test->execute();
