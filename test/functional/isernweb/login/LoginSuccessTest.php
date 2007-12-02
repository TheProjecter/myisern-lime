<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class LoginTest extends sfPropelTest
{
  public function test_login_success() 
  {  
    $b = new sfTestBrowser();   
    $b->initialize();
    $b->get('/')->
        click('Sign In', array('login' =>'isern', 'password' => 'testpassword'))->
        isRedirected()->   // Check that request is redirected
        followRedirect()->
        checkResponseElement('body', '/You are logged in/');
    $b->get('/organization/list')->
	    checkResponseElement('body', '/Organizations/')->
	    checkResponseElement('body', '/Name/');   

    $b->get('/collaboration/list')->
    	checkResponseElement('body', '/Collaborations/')->
    	checkResponseElement('body', '/Name/');           
  }  
}
$test = new LoginTest();
$test->execute();
