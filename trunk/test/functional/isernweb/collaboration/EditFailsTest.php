<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/CollaborationBaseTest.php');

class CollaborationTest extends CollaborationBaseTest
{
  public function test_edit_requires_name() 
  {
  	
     $this->goto_edit();      
     $this->b->click('save', array('name' => ''))->
        checkResponseElement('body', '/Edit Collaboration/')->
        checkResponseElement('body', '/The name field cannot be left blank/');
       // TODO: need to test blank years. 
//     $this->b->click('save', array('name'=>'hello','collaboratingOrganizations' => array('12')))->
//        checkResponseElement('body', '/Edit Collaboration/')->
//        checkResponseElement('body', '/Collaboration must contain at least two organizations/');
              
//     $this->b->click('save')->
//        checkResponseElement('body', '/Edit Collaboration/')->
//        checkResponseElement('body', '/The organization field cannot be left blank/');  
  }
}

$test = new CollaborationTest();
$test->execute();
