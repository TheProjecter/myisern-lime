<?php

/**
 * user actions.
 *
 * @package    myisern-lime
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  
  public function executeLogin()
  {
   if ($this->getRequest()->getMethod() != sfRequest::POST)
   {
     // display the form
     $this->getRequest()->setAttribute('referer', $this->getRequest()->getReferer());
   }
   else
   {
//     // handle the form submission
//     $login = $this->getRequestParameter('login');
// 
//     $c = new Criteria();
//     $c->add(UserPeer::LOGIN, $login);
//     $user = UserPeer::doSelectOne($c);
// 
//     // nickname exists?
//     if ($user)
//     {
//     	$this->getUser()->setAuthenticated(true);
     	return $this->redirect('researcher');
     
//     } else {
//     	return sfView::SUCCESS; 
//     }
   }
  }  
  public function executeLogout()
  {
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->clearCredentials();
 
    $this->redirect('@homepage');
  }
  public function handleErrorLogin()
  {
    return sfView::SUCCESS;
  }
}
