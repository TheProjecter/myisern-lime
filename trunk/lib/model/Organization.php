<?php

/**
 * Subclass for representing a row from the 'isern_organizations' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Organization extends BaseOrganization
{
  public function __toString()
  {
    return $this->getName();
  }
}
