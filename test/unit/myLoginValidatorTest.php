<?php

define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myUser.class.php');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myLoginValidator.class.php');
require(dirname(__FILE__).'/../../plugins/sfPropelTestPlugin/bootstrap/propel-unit.php');

    class myUnitTest extends sfPropelTest
    {

      public function test_validator_success()
      {
        $context = sfContext::getInstance();
        $request = $context->getRequest();
        $manager = new sfValidatorManager();
        $manager->initialize($context);
        $validator = new myLoginValidator();
        $validator->initialize($context);

        $manager->registerName('myvalidator', false);
        $manager->registerValidator('myvalidator', $validator);
 
        $request->setParameter('login', 'isern');
        $request->setParameter('password', 'isern2008');
        $retval = $manager->execute();
        $this->is($retval, true, "validator should return true");
        $this->is($request->getErrors(), Array(), "errors should be an empty array");
        $request->removeError('myvalidator');
      }


      public function test_validator_failures()
      {
        $context = sfContext::getInstance();
        $request = $context->getRequest();
        $manager = new sfValidatorManager();
        $manager->initialize($context);
        $validator = new myLoginValidator();
        $validator->initialize($context);

//        $values =  array('invalid');
        $values =  array('invalid', 'testbad');
        $this->diag('myLoginValidator()');
        foreach ( $values as $value ) { 
          $manager->registerName('login', true);
          $manager->registerValidator('login', $validator);
          $request->setParameter('login', $value);
          $request->setParameter('password', $value);
          $retval = $manager->execute();
          $this->is($retval, false, "validator should return false for $value ");
          $request->removeError('myLoginValidator');
        } 
#        print_r($request->getErrors()); 
##        $this->is($request->getErrors(), Array());
#        $request->removeError('myvalidator');
      }
      

    }

$test = new myUnitTest();
$test->execute();
