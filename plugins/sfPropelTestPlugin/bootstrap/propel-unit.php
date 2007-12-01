<?php
/*
 * This file is part of the sfPropelTestPlugin package.
 * (c) 2007 Rob Rosenbaum <rob@robrosenbaum.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 /*
  * The contents of this file came mostly from the following page:
  * http://www.symfony-project.com/snippets/snippet/215
  */
if (!@constant('SF_APP')) {
  die ('Constant "SF_APP" must be defined in your test script.'."\n");
}

if (!@constant('SF_ENVIRONMENT')) { // Only load constants in not done before (group tests)
  define('SF_ENVIRONMENT', 'test');
  define('SF_DEBUG', TRUE);
  define('SF_ROOT_DIR', realpath(dirname(__FILE__).'/../../..'));
  $_test_dir = SF_ROOT_DIR.'/test';

  // symfony directories
  include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

  require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');
  require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
  require_once(dirname(__FILE__).'/../lib/sfPropelTest.php');

  sfCore::initSimpleAutoload(array(SF_ROOT_DIR.'/lib/model' // DB model classes
                            ,$sf_symfony_lib_dir // Symfony itself
                            ,SF_ROOT_DIR.'/lib' // Location class to be tested
                            ,SF_ROOT_DIR.'/apps/theApp/lib' // Location myapp application
                            ,SF_ROOT_DIR.'/plugins')); // Location plugins

  set_include_path($sf_symfony_lib_dir . '/vendor' . PATH_SEPARATOR . SF_ROOT_DIR . PATH_SEPARATOR . get_include_path());

  sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
  sfContext::getInstance();
  Propel::setConfiguration(sfPropelDatabase::getConfiguration());
  Propel::initialize();
}
