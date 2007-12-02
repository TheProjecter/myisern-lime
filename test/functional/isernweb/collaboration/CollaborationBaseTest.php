<?php
$app = 'isernweb';
define('SF_APP', 'isernweb');

require(dirname(__FILE__).'/../../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');

class CollaborationBaseTest extends sfPropelTest
{
	
  protected $b;
    
  public function setup() 
  {
     $fixtures_directory = dirname(__FILE__) . '/../../../fixtures';
     // login into the system.
     $this->b = new sfTestBrowser();
     $this->b->initialize();
	 $this->b->get('/')->
        click('Sign In', array('login' =>'isern', 'password' => 'testpassword'))->
           // Check that request is redirected
        followRedirect()        ;
     // Attach test fixtures to this object.        
    $fixture_files = sfFinder::type('file')->name('*.yml')->in($fixtures_directory);
    foreach ($fixture_files as $fixture_file) {
      $data = sfYaml::load($fixture_file); 
      $key = key($data);
      $objectName = $key . "s"; // we want to pluralize it for readability.
      $this->$objectName = $data[$key];
    } 
  }
  public function goto_show() {
    $this->b->get('/collaboration/list')->
    	checkResponseElement('body', '/Collaboration/')->
    	checkResponseElement('body', '/Name/')->
    	checkResponseElement('body', '/' . $this->Collaborations['c1']['name'] . '/')->
    	checkResponseElement('body', '/' . $this->Collaborations['c2']['name'] . '/');
     $this->b->click($this->Collaborations['c1']['name'])->
        checkResponseElement('body', '/View Collaboration/')->     
        checkResponseElement('body', '/' . $this->Collaborations['c1']['name'] . '/'); // should take us to the show screen!.  	
  }
  
  public function goto_edit() {
  	 $this->goto_show();
     $this->b->click('edit')->
        checkResponseElement('body', '/Edit Collaboration/');
     $dom = $this->b->getResponseDom();
//     $this->b->test()->is($dom->getElementsByTagName('input')->item(1)->getAttribute('value'),$this->Collaborations['c1']['name'], 
//        "First field should be researcher name");
  }
  
}
