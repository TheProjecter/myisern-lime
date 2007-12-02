<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_edit_requires_name() 
  {
  	
     $this->goto_edit();      
     $this->b->click('save', array('name' => ''))->
        checkResponseElement('body', '/Edit Organization/')->
        checkResponseElement('body', '/The name field cannot be left blank/');          
      
  }
}

$test = new OrganizationTest();
$test->execute();
