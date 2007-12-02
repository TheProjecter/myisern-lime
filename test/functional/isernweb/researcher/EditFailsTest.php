<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/ResearcherBaseTest.php');

class ResearcherTest extends ResearcherBaseTest
{
  public function test_edit_requires_name() 
  {
  	
     $this->goto_edit();      
     $this->b->click('save', array('name' => ''))->
        checkResponseElement('body', '/Edit Researcher/')->
        checkResponseElement('body', '/The name field cannot be left blank/');          
     $this->b->click('save', array('organization_id' => ''))->
        checkResponseElement('body', '/Edit Researcher/')->
        checkResponseElement('body', '/The organization field cannot be left blank/');  
  }
}

$test = new ResearcherTest();
$test->execute();
