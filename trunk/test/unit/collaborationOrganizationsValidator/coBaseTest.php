<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../../plugins/sfModelTestPlugin/bootstrap/model-unit.php');
//require(dirname(__FILE__).'/../../../apps/isernweb/lib/myUser.class.php');
//require(dirname(__FILE__).'/../../../apps/isernweb/lib/myCollaboratingOrganizationsValidator.class.php');


class COBaseTest extends sfPropelTest
{
  public function setup() {
    $context = sfContext::getInstance();
    $this->request = $context->getRequest();
    $this->manager = new sfValidatorManager();
    $this->manager->initialize($context);
    $validator = new myCollaboratingOrganizationsValidator();
    $validator->initialize($context);
    $this->manager->registerName('collaboratingOrganizations', false);
    $this->manager->registerValidator('collaboratingOrganizations', $validator);
  }
  public function teardown() {
    $this->request->removeError('collaboratingOrganizations');
  }

}
	
$test = new COBaseTest();
$test->execute();
