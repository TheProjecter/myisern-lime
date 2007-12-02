<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/OrganizationBaseTest.php');

class OrganizationTest extends OrganizationBaseTest
{
  public function test_delete_ok() 
  {
     $oldCount = OrganizationPeer::doCount(new Criteria());
     $this->goto_edit();      
     $this->b->click('delete')->
     	isRedirected()->
     	followRedirect()->
        checkResponseElement('body', '/Organizations/')->
        checkResponseElement('body', '!/'. $this->Organizations['o1']['name'] .'/');
     $this->b->test()->is($oldCount-1,OrganizationPeer::doCount(new Criteria()), "Organization count should be one less than $oldCount");        
     echo "org is " .  $this->Organizations['o1']['name'] . "\n";
  }
}

$test = new OrganizationTest();
$test->execute();
