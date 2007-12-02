<?php
 
class myLoginValidator extends sfValidator
{    
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);
    // set defaults
    $this->setParameter('login_error', 'Invalid input');
    $var = var_export($parameters, true); 
    sfContext::getInstance()->getLogger()->info("{myLoginValidator} parameters " .  $var ) ;
    foreach ($parameters as $key => $val) {
      sfContext::getInstance()->getLogger()->info("{myLoginValidator} $key => $val ") ;	
    }
    $this->getParameterHolder()->add($parameters);
    return true;
  }
 
  public function execute(&$value, &$error)
  {
    $password_param = $this->getParameter('password');
    sfContext::getInstance()->getLogger()->info("{myLoginValidator} password_param $password_param"  ) ;    
    $password = $this->getContext()->getRequest()->getParameter($password_param);
    $login = $value;
    sfContext::getInstance()->getLogger()->info("{myLoginValidator} validate login:$value, password: $password"  ) ; 
 
    // anonymous is not a real user
    if ($login == 'anonymous')
    {
      $error = $this->getParameter('login_error');
      return false;
    }
 
    $c = new Criteria();
    $c->add(UserPeer::LOGIN, $login);
    $user = UserPeer::doSelectOne($c);
 
    // nickname exists?
    if ($user)
    {
      // password is OK?
      if ($password == $user->getPassword())
      {
        $this->getContext()->getUser()->setAuthenticated(true);
 
        return true;
      }
    }
 
    $error = $this->getParameter('login_error');
    return false;
  }
}
 
?>
