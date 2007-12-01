<?php
/*
 * This file is part of the sfPropelTestPlugin package.
 * (c) 2007 Rob Rosenbaum <rob@robrosenbaum.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfPropelTest extends lime_test
{
  protected $testDataDir;

  public function __construct()
  {
    $this->sfPropelData = new sfPropelData();
    $this->testDataDir = SF_ROOT_DIR . '/test/fixtures';

    if (!is_readable($this->testDataDir)) {
      throw new RuntimeException('Could not read directory '.$this->testDataDir);
    }

    parent::__construct();
  }

  public function execute()
  {
    $reflection = new ReflectionClass(get_class($this));

    $this->diag($reflection);
    foreach ($reflection->getMethods() as $method) {
      if ($method->isPublic() && 0 === strpos($method->getName(), 'test_')) {

        $this->loadData();
        $this->setup();

        try {
          $method->invoke($this);
        } catch (Exception $e) {
          $this->output->red_bar('Uncaught exception: '.$e->getMessage());
          return false;
        }

        $this->teardown();
      }
    }
  }

  public function loadData()
  {
    $this->sfPropelData->setDeleteCurrentData(true);
    $this->sfPropelData->loadData($this->testDataDir);
  }

  /*
   * These are for child classes to override
   */
  public function setup()
  {
  }

  public function teardown()
  {
  }
}

