<?php
// auto-generated by sfPropelCrud
// date: 2007/11/24 12:45:12
?>
<?php

/**
 * user login actions.
 *
 * @package    myisern-lime
 * @subpackage user
 * @author     Kevin English
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
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
