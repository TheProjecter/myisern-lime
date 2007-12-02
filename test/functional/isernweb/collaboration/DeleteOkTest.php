<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_delete_ok() 
  {
  	$oldCount = CollaborationPeer::doCount(new Criteria());
    $this->goto_edit();      
    $this->b->click('delete')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/Collaborations/')->
        checkResponseElement('body', '!/'. $this->Collaborations['c1']['name'] .'/');
    $this->b->test()->is($oldCount-1, CollaborationPeer::doCount(new Criteria()), "Collaboration count should still be one less than $oldCount");                  
  }
}

$test = new CollaborationTest();
$test->execute();
