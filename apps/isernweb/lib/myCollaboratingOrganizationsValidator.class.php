<?php
 
class myCollaboratingOrganizationsValidator extends sfValidator
{    
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);
    // set defaults
    $this->setParameter('no_organizations_error', 'You must have at least 2 organizations.');
    $this->getParameterHolder()->add($parameters);
    return true;
  }
 
  public function execute(&$value, &$error)
  {
    
    $organizations = $value;
    sfContext::getInstance()->getLogger()->info("[kevin] hellow :: $organizations " ); 

    if (!is_array($organizations) || sizeof($organizations) <2  ) { 
      $error = $this->getParameter('login_error');
      return false;
    } else { 
      return true; 
    }
  }
}
?>