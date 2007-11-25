<?php
// auto-generated by sfPropelCrud
// date: 2007/11/24 12:47:36
?>
<?php

/**
 * organization_type actions.
 *
 * @package    myisern-lime
 * @subpackage organization_type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class organization_typeActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('organization_type', 'list');
  }

  public function executeList()
  {
    $this->organization_types = OrganizationTypePeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->organization_type = OrganizationTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->organization_type);
  }

  public function executeCreate()
  {
    $this->organization_type = new OrganizationType();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->organization_type = OrganizationTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->organization_type);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $organization_type = new OrganizationType();
    }
    else
    {
      $organization_type = OrganizationTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($organization_type);
    }

    $organization_type->setId($this->getRequestParameter('id'));
    $organization_type->setName($this->getRequestParameter('name'));

    $organization_type->save();

    return $this->redirect('organization_type/show?id='.$organization_type->getId());
  }

  public function executeDelete()
  {
    $organization_type = OrganizationTypePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($organization_type);

    $organization_type->delete();

    return $this->redirect('organization_type/list');
  }
}
