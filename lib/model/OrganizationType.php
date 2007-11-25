<?php

/**
 * Subclass for representing a row from the 'isern_organization_types' table.
 *
 * 
 *
 * @package lib.model
 */ 
class OrganizationType extends BaseOrganizationType
{
  public function __toString()
  {
    return $this->getName();
  }

}
