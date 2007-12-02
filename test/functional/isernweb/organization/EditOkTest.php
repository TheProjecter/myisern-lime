<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_edit_ok() 
  {
     $this->goto_edit();      
     $this->b->click('save')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/View Organization/')->
        checkResponseElement('body', '/'. $this->Organizations['o1']['name'] .'/');          
  }
}

$test = new OrganizationTest();
$test->execute();
