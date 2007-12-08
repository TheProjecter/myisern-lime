<?php


abstract class BaseOrganization extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $organization_type_id;


	
	protected $name;


	
	protected $country;


	
	protected $home_page;


	
	protected $research_keywords;


	
	protected $research_description;


	
	protected $created_at;

	
	protected $aOrganizationType;

	
	protected $collResearchers;

	
	protected $lastResearcherCriteria = null;

	
	protected $collCollaboratingOrganizations;

	
	protected $lastCollaboratingOrganizationCriteria = null;

	
	protected $collOrganizationResearcherKeywords;

	
	protected $lastOrganizationResearcherKeywordCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getOrganizationTypeId()
	{

		return $this->organization_type_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getCountry()
	{

		return $this->country;
	}

	
	public function getHomePage()
	{

		return $this->home_page;
	}

	
	public function getResearchKeywords()
	{

		return $this->research_keywords;
	}

	
	public function getResearchDescription()
	{

		return $this->research_description;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OrganizationPeer::ID;
		}

	} 
	
	public function setOrganizationTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_type_id !== $v) {
			$this->organization_type_id = $v;
			$this->modifiedColumns[] = OrganizationPeer::ORGANIZATION_TYPE_ID;
		}

		if ($this->aOrganizationType !== null && $this->aOrganizationType->getId() !== $v) {
			$this->aOrganizationType = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OrganizationPeer::NAME;
		}

	} 
	
	public function setCountry($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = OrganizationPeer::COUNTRY;
		}

	} 
	
	public function setHomePage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->home_page !== $v) {
			$this->home_page = $v;
			$this->modifiedColumns[] = OrganizationPeer::HOME_PAGE;
		}

	} 
	
	public function setResearchKeywords($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->research_keywords !== $v) {
			$this->research_keywords = $v;
			$this->modifiedColumns[] = OrganizationPeer::RESEARCH_KEYWORDS;
		}

	} 
	
	public function setResearchDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->research_description !== $v) {
			$this->research_description = $v;
			$this->modifiedColumns[] = OrganizationPeer::RESEARCH_DESCRIPTION;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OrganizationPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->organization_type_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->country = $rs->getString($startcol + 3);

			$this->home_page = $rs->getString($startcol + 4);

			$this->research_keywords = $rs->getString($startcol + 5);

			$this->research_description = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Organization object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrganizationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrganizationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OrganizationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrganizationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aOrganizationType !== null) {
				if ($this->aOrganizationType->isModified()) {
					$affectedRows += $this->aOrganizationType->save($con);
				}
				$this->setOrganizationType($this->aOrganizationType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OrganizationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OrganizationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collResearchers !== null) {
				foreach($this->collResearchers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollaboratingOrganizations !== null) {
				foreach($this->collCollaboratingOrganizations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrganizationResearcherKeywords !== null) {
				foreach($this->collOrganizationResearcherKeywords as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aOrganizationType !== null) {
				if (!$this->aOrganizationType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrganizationType->getValidationFailures());
				}
			}


			if (($retval = OrganizationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collResearchers !== null) {
					foreach($this->collResearchers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollaboratingOrganizations !== null) {
					foreach($this->collCollaboratingOrganizations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrganizationResearcherKeywords !== null) {
					foreach($this->collOrganizationResearcherKeywords as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getOrganizationTypeId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getCountry();
				break;
			case 4:
				return $this->getHomePage();
				break;
			case 5:
				return $this->getResearchKeywords();
				break;
			case 6:
				return $this->getResearchDescription();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrganizationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrganizationTypeId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getCountry(),
			$keys[4] => $this->getHomePage(),
			$keys[5] => $this->getResearchKeywords(),
			$keys[6] => $this->getResearchDescription(),
			$keys[7] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setOrganizationTypeId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setCountry($value);
				break;
			case 4:
				$this->setHomePage($value);
				break;
			case 5:
				$this->setResearchKeywords($value);
				break;
			case 6:
				$this->setResearchDescription($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrganizationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrganizationTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCountry($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHomePage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setResearchKeywords($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setResearchDescription($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrganizationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrganizationPeer::ID)) $criteria->add(OrganizationPeer::ID, $this->id);
		if ($this->isColumnModified(OrganizationPeer::ORGANIZATION_TYPE_ID)) $criteria->add(OrganizationPeer::ORGANIZATION_TYPE_ID, $this->organization_type_id);
		if ($this->isColumnModified(OrganizationPeer::NAME)) $criteria->add(OrganizationPeer::NAME, $this->name);
		if ($this->isColumnModified(OrganizationPeer::COUNTRY)) $criteria->add(OrganizationPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(OrganizationPeer::HOME_PAGE)) $criteria->add(OrganizationPeer::HOME_PAGE, $this->home_page);
		if ($this->isColumnModified(OrganizationPeer::RESEARCH_KEYWORDS)) $criteria->add(OrganizationPeer::RESEARCH_KEYWORDS, $this->research_keywords);
		if ($this->isColumnModified(OrganizationPeer::RESEARCH_DESCRIPTION)) $criteria->add(OrganizationPeer::RESEARCH_DESCRIPTION, $this->research_description);
		if ($this->isColumnModified(OrganizationPeer::CREATED_AT)) $criteria->add(OrganizationPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrganizationPeer::DATABASE_NAME);

		$criteria->add(OrganizationPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOrganizationTypeId($this->organization_type_id);

		$copyObj->setName($this->name);

		$copyObj->setCountry($this->country);

		$copyObj->setHomePage($this->home_page);

		$copyObj->setResearchKeywords($this->research_keywords);

		$copyObj->setResearchDescription($this->research_description);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getResearchers() as $relObj) {
				$copyObj->addResearcher($relObj->copy($deepCopy));
			}

			foreach($this->getCollaboratingOrganizations() as $relObj) {
				$copyObj->addCollaboratingOrganization($relObj->copy($deepCopy));
			}

			foreach($this->getOrganizationResearcherKeywords() as $relObj) {
				$copyObj->addOrganizationResearcherKeyword($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OrganizationPeer();
		}
		return self::$peer;
	}

	
	public function setOrganizationType($v)
	{


		if ($v === null) {
			$this->setOrganizationTypeId(NULL);
		} else {
			$this->setOrganizationTypeId($v->getId());
		}


		$this->aOrganizationType = $v;
	}


	
	public function getOrganizationType($con = null)
	{
		if ($this->aOrganizationType === null && ($this->organization_type_id !== null)) {
						include_once 'lib/model/om/BaseOrganizationTypePeer.php';

			$this->aOrganizationType = OrganizationTypePeer::retrieveByPK($this->organization_type_id, $con);

			
		}
		return $this->aOrganizationType;
	}

	
	public function initResearchers()
	{
		if ($this->collResearchers === null) {
			$this->collResearchers = array();
		}
	}

	
	public function getResearchers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseResearcherPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collResearchers === null) {
			if ($this->isNew()) {
			   $this->collResearchers = array();
			} else {

				$criteria->add(ResearcherPeer::ORGANIZATION_ID, $this->getId());

				ResearcherPeer::addSelectColumns($criteria);
				$this->collResearchers = ResearcherPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ResearcherPeer::ORGANIZATION_ID, $this->getId());

				ResearcherPeer::addSelectColumns($criteria);
				if (!isset($this->lastResearcherCriteria) || !$this->lastResearcherCriteria->equals($criteria)) {
					$this->collResearchers = ResearcherPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastResearcherCriteria = $criteria;
		return $this->collResearchers;
	}

	
	public function countResearchers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseResearcherPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ResearcherPeer::ORGANIZATION_ID, $this->getId());

		return ResearcherPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addResearcher(Researcher $l)
	{
		$this->collResearchers[] = $l;
		$l->setOrganization($this);
	}

	
	public function initCollaboratingOrganizations()
	{
		if ($this->collCollaboratingOrganizations === null) {
			$this->collCollaboratingOrganizations = array();
		}
	}

	
	public function getCollaboratingOrganizations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCollaboratingOrganizationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollaboratingOrganizations === null) {
			if ($this->isNew()) {
			   $this->collCollaboratingOrganizations = array();
			} else {

				$criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->getId());

				CollaboratingOrganizationPeer::addSelectColumns($criteria);
				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->getId());

				CollaboratingOrganizationPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollaboratingOrganizationCriteria) || !$this->lastCollaboratingOrganizationCriteria->equals($criteria)) {
					$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollaboratingOrganizationCriteria = $criteria;
		return $this->collCollaboratingOrganizations;
	}

	
	public function countCollaboratingOrganizations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCollaboratingOrganizationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->getId());

		return CollaboratingOrganizationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCollaboratingOrganization(CollaboratingOrganization $l)
	{
		$this->collCollaboratingOrganizations[] = $l;
		$l->setOrganization($this);
	}


	
	public function getCollaboratingOrganizationsJoinCollaboration($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCollaboratingOrganizationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollaboratingOrganizations === null) {
			if ($this->isNew()) {
				$this->collCollaboratingOrganizations = array();
			} else {

				$criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->getId());

				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelectJoinCollaboration($criteria, $con);
			}
		} else {
									
			$criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->getId());

			if (!isset($this->lastCollaboratingOrganizationCriteria) || !$this->lastCollaboratingOrganizationCriteria->equals($criteria)) {
				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelectJoinCollaboration($criteria, $con);
			}
		}
		$this->lastCollaboratingOrganizationCriteria = $criteria;

		return $this->collCollaboratingOrganizations;
	}

	
	public function initOrganizationResearcherKeywords()
	{
		if ($this->collOrganizationResearcherKeywords === null) {
			$this->collOrganizationResearcherKeywords = array();
		}
	}

	
	public function getOrganizationResearcherKeywords($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOrganizationResearcherKeywordPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrganizationResearcherKeywords === null) {
			if ($this->isNew()) {
			   $this->collOrganizationResearcherKeywords = array();
			} else {

				$criteria->add(OrganizationResearcherKeywordPeer::ORGANIZATION_ID, $this->getId());

				OrganizationResearcherKeywordPeer::addSelectColumns($criteria);
				$this->collOrganizationResearcherKeywords = OrganizationResearcherKeywordPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrganizationResearcherKeywordPeer::ORGANIZATION_ID, $this->getId());

				OrganizationResearcherKeywordPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrganizationResearcherKeywordCriteria) || !$this->lastOrganizationResearcherKeywordCriteria->equals($criteria)) {
					$this->collOrganizationResearcherKeywords = OrganizationResearcherKeywordPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrganizationResearcherKeywordCriteria = $criteria;
		return $this->collOrganizationResearcherKeywords;
	}

	
	public function countOrganizationResearcherKeywords($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOrganizationResearcherKeywordPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrganizationResearcherKeywordPeer::ORGANIZATION_ID, $this->getId());

		return OrganizationResearcherKeywordPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrganizationResearcherKeyword(OrganizationResearcherKeyword $l)
	{
		$this->collOrganizationResearcherKeywords[] = $l;
		$l->setOrganization($this);
	}

} 