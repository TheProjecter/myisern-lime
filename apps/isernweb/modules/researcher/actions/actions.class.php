<?php
// auto-generated by sfPropelCrud
// date: 2007/11/24 12:45:12
?>
<?php

/**
 * researcher actions.
 *
 * @package    myisern-lime
 * @subpackage researcher
 * @author     Kevin English
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class researcherActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('researcher', 'list');
  }

  public function executeList()
  {
    $this->researchers = ResearcherPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->researcher = ResearcherPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->researcher);
  }

  public function executeCreate()
  {
    $this->researcher = new Researcher();
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
  	
    if (!$this->researcher) { 
      $this->researcher = ResearcherPeer::retrieveByPk($this->getRequestParameter('id'));
    } 
    $this->forward404Unless($this->researcher);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $this->researcher = new Researcher();
    }
    else
    {
    	
      $this->researcher = ResearcherPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->researcher);
    }
    $this->logMessage("[kevin] id =  " . $this->getRequestParameter('id'));
    $this->researcher->setId($this->getRequestParameter('id'));
    $this->researcher->setOrganizationId($this->getRequestParameter('organization_id') ? $this->getRequestParameter('organization_id') : null);
    $this->researcher->setName($this->getRequestParameter('name'));
    $this->researcher->setEmail($this->getRequestParameter('email'));
    $this->researcher->setPictureLink($this->getRequestParameter('picture_link'));
    $this->researcher->setBioStatement($this->getRequestParameter('bio_statement'));

    $this->researcher->save();

    return $this->redirect('researcher/show?id='.$this->researcher->getId());
  }

  public function executeDelete()
  {
    $researcher = ResearcherPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($researcher);

    $researcher->delete();

    return $this->redirect('researcher/list');
  }
  public function handleErrorUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {  
      $this->forward('researcher', 'create'); 
    }
    else 
    {
      $this->forward('researcher', 'edit');
    }
  }
}
