<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_delete_ok() 
  {
     $this->goto_edit();      
     $this->b->click('delete')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/Organizations/')->
        checkResponseElement('body', '!/'. $this->Organizations['o1']['name'] .'/');          
  }
}

$test = new OrganizationTest();
$test->execute();
