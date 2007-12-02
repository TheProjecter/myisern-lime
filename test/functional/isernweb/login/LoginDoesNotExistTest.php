<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class LoginTest extends sfPropelTest
{
  public function test_login_does_not_exist() 
  {
   $b = new sfTestBrowser();   
   $b->initialize();
   $b->get('/')->
    click('Sign In', array('login' =>'isern', 'password' => 'isern2008xxx'))->
    checkResponseElement('body', '/This account does not exist/');
  }
}
$test = new LoginTest();
$test->execute();
