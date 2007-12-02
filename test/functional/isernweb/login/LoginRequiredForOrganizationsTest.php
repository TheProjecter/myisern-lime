<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class LoginRequiredForOrganizationsTest extends sfPropelTest
{
  public function test_login_require_for_organizations() 
  {
  	$b = new sfTestBrowser();   
    $b->initialize();
    $b->get('/organization/list')->
	checkResponseElement('body', '/Login/')->
	checkResponseElement('body', '/Please login/');   
  }
}
$test = new LoginRequiredForOrganizationsTest();
$test->execute();
