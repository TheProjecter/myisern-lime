<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_list() 
  {
  	 $this->b->get('/organization/list')->
    	checkResponseElement('body', '/Organization/')->
    	checkResponseElement('body', '/Name/')->
    	checkResponseElement('body', '/' . $this->Organizations['o1']['name'] . '/')->
    	checkResponseElement('body', '/' . $this->Organizations['o2']['name'] . '/');        
  }
}

$test = new OrganizationTest();
$test->execute();
