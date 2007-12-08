<?php
// auto-generated by sfPropelCrud
// date: 2007/11/24 12:45:00
?>
<?php

/**
 * organization actions.
 *
 * @package    myisern-lime
 * @subpackage organization
 * @author     Kevin English
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class organizationActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('organization', 'list');
  }

  public function executeList()
  {
    $this->organizations = OrganizationPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->organization = OrganizationPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->organization);
  }

  public function executeCreate()
  {
    $this->organization = new Organization();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->organization = OrganizationPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->organization);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $organization = new Organization();
    }
    else
    {
      $organization = OrganizationPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($organization);
    }

    $organization->setId($this->getRequestParameter('id'));
    $organization->setOrganizationTypeId($this->getRequestParameter('organization_type_id') ? $this->getRequestParameter('organization_type_id') : null);
    $organization->setName($this->getRequestParameter('name'));
    $organization->setCountry($this->getRequestParameter('country'));
    $organization->setHomePage($this->getRequestParameter('home_page'));
    $organization->setResearchKeywords($this->getRequestParameter('research_keywords'));
    $organization->setResearchDescription($this->getRequestParameter('research_description'));

    $organization->save();

    return $this->redirect('organization/show?id='.$organization->getId());
  }

  public function executeDelete()
  {
    $organization = OrganizationPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($organization);

    $organization->delete();

    return $this->redirect('organization/list');
  }
  public function handleErrorUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {  
      $this->forward('organization', 'create'); 
    }
    else 
    {
      $this->forward('organization', 'edit');
    }
  }  
}
