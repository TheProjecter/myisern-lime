<?php
define('SF_APP', 'isernweb');
require(dirname(__FILE__).'/../../apps/isernweb/lib/myUser.class.php');
require(dirname(__FILE__).'/../../plugins/sfPropelTestPlugin/bootstrap/propel-unit.php');

    class myUnitTest extends sfPropelTest
    {
      public function test_user()
      {
        $oldCount = UserPeer::doCount(new Criteria()); 
      
        $user = new User();
        $user->setLogin('bobbyjoe');
        $user->setPassword('bobbyjoe');
        $user->save();
        $newCount = UserPeer::doCount(new Criteria()); 
        $this->is($newCount, $oldCount + 1, 'Should add one user');
//        $joe = UserPeer::getByName(UserPeer::LOGIN, 'bobbyjoe');
 //       $this->ok($joe, 'Joe exists!');
      }

      public function test_dataDelete()
      {
          $c = new Criteria();
          $c->add(UserPeer::LOGIN, 'bobbyjoe');
          $joe = UserPeer::doSelectOne($c);
          $joe->delete();
          $joe = UserPeer::doSelectOne($c);
          $this->ok(!$joe, 'Joe no longer exists');
      }
    }

$test = new myUnitTest();
$test->execute();
