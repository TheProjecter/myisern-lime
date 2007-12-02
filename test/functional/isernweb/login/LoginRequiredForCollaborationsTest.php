<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class LoginTest extends sfPropelTest
{
  public function test_login_require_for_collaborations() 
  {  
    $b = new sfTestBrowser();   
    $b->initialize();
    $b->get('/collaboration/list')->
    	checkResponseElement('body', '/Login/')->
	    checkResponseElement('body', '/Please login/');   
  }
}
$test = new LoginTest();
$test->execute();
