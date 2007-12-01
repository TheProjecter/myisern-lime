<?php
// auto-generated by sfPropelCrud
// date: 2007/11/25 00:34:09
?>
<?php

/**
 * collaboration actions.
 *
 * @package    myisern-lime
 * @subpackage collaboration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class collaborationActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('collaboration', 'list');
  }

  public function executeList()
  {
    $this->collaborations = CollaborationPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->collaboration = CollaborationPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->collaboration);
  }

  public function executeCreate()
  {
    $this->collaboration = new Collaboration();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->collaboration = CollaborationPeer::retrieveByPk($this->getRequestParameter('id'));
    $organizations = OrganizationPeer::doSelect(new Criteria());
    $options = array();
    foreach ($organizations as $org)
    {
      $options[$org->getId()] = $org->getName();
    }
    asort($options);
    $this->options = $options;
    
    $this->forward404Unless($this->collaboration);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $collaboration = new Collaboration();
    }
    else
    {
      $collaboration = CollaborationPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($collaboration);
    }

    $collaboration->setId($this->getRequestParameter('id'));
    $collaboration->setName($this->getRequestParameter('name'));
    $collaboration->setDescription($this->getRequestParameter('description'));
// From an action
    
//    $this->logMessage("dude, ", PEAR_LOG_ERR);
       $this->logMessage("[kevin] $this->getRequestParameter('collaboratingOrganizations') " . $this->getRequestParameter('collaboratingOrganizations'));
    foreach ($this->getRequestParameter('collaboratingOrganizations') as $orgId ) {
       $this->logMessage("[kevin] orgid = $orgId ");    	
   	
    }
//    
    $collaboration->save();

    return $this->redirect('collaboration/show?id='.$collaboration->getId());
  }

  public function executeDelete()
  {
    $collaboration = CollaborationPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($collaboration);

    $collaboration->delete();

    return $this->redirect('collaboration/list');
  }
}