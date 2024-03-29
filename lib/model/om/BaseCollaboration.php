<?php


abstract class BaseCollaboration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;

	
	protected $collCollaborationYears;

	
	protected $lastCollaborationYearCriteria = null;

	
	protected $collCollaboratingOrganizations;

	
	protected $lastCollaboratingOrganizationCriteria = null;

	
	protected $collCollaborationOutcomeTypes;

	
	protected $lastCollaborationOutcomeTypeCriteria = null;

	
	protected $collCollaborationTypes;

	
	protected $lastCollaborationTypeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CollaborationPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CollaborationPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = CollaborationPeer::DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Collaboration object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CollaborationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CollaborationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CollaborationPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CollaborationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CollaborationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCollaborationYears !== null) {
				foreach($this->collCollaborationYears as $referrerFK) {
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

			if ($this->collCollaborationOutcomeTypes !== null) {
				foreach($this->collCollaborationOutcomeTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollaborationTypes !== null) {
				foreach($this->collCollaborationTypes as $referrerFK) {
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


			if (($retval = CollaborationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCollaborationYears !== null) {
					foreach($this->collCollaborationYears as $referrerFK) {
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

				if ($this->collCollaborationOutcomeTypes !== null) {
					foreach($this->collCollaborationOutcomeTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollaborationTypes !== null) {
					foreach($this->collCollaborationTypes as $referrerFK) {
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
		$pos = CollaborationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CollaborationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CollaborationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CollaborationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CollaborationPeer::DATABASE_NAME);

		if ($this->isColumnModified(CollaborationPeer::ID)) $criteria->add(CollaborationPeer::ID, $this->id);
		if ($this->isColumnModified(CollaborationPeer::NAME)) $criteria->add(CollaborationPeer::NAME, $this->name);
		if ($this->isColumnModified(CollaborationPeer::DESCRIPTION)) $criteria->add(CollaborationPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CollaborationPeer::DATABASE_NAME);

		$criteria->add(CollaborationPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCollaborationYears() as $relObj) {
				$copyObj->addCollaborationYear($relObj->copy($deepCopy));
			}

			foreach($this->getCollaboratingOrganizations() as $relObj) {
				$copyObj->addCollaboratingOrganization($relObj->copy($deepCopy));
			}

			foreach($this->getCollaborationOutcomeTypes() as $relObj) {
				$copyObj->addCollaborationOutcomeType($relObj->copy($deepCopy));
			}

			foreach($this->getCollaborationTypes() as $relObj) {
				$copyObj->addCollaborationType($relObj->copy($deepCopy));
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
			self::$peer = new CollaborationPeer();
		}
		return self::$peer;
	}

	
	public function initCollaborationYears()
	{
		if ($this->collCollaborationYears === null) {
			$this->collCollaborationYears = array();
		}
	}

	
	public function getCollaborationYears($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationYearPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollaborationYears === null) {
			if ($this->isNew()) {
			   $this->collCollaborationYears = array();
			} else {

				$criteria->add(CollaborationYearPeer::COLLABORATION_ID, $this->getId());

				CollaborationYearPeer::addSelectColumns($criteria);
				$this->collCollaborationYears = CollaborationYearPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CollaborationYearPeer::COLLABORATION_ID, $this->getId());

				CollaborationYearPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollaborationYearCriteria) || !$this->lastCollaborationYearCriteria->equals($criteria)) {
					$this->collCollaborationYears = CollaborationYearPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollaborationYearCriteria = $criteria;
		return $this->collCollaborationYears;
	}

	
	public function countCollaborationYears($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationYearPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollaborationYearPeer::COLLABORATION_ID, $this->getId());

		return CollaborationYearPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCollaborationYear(CollaborationYear $l)
	{
		$this->collCollaborationYears[] = $l;
		$l->setCollaboration($this);
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

				$criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->getId());

				CollaboratingOrganizationPeer::addSelectColumns($criteria);
				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->getId());

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

		$criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->getId());

		return CollaboratingOrganizationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCollaboratingOrganization(CollaboratingOrganization $l)
	{
		$this->collCollaboratingOrganizations[] = $l;
		$l->setCollaboration($this);
	}


	
	public function getCollaboratingOrganizationsJoinOrganization($criteria = null, $con = null)
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

				$criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->getId());

				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelectJoinOrganization($criteria, $con);
			}
		} else {
									
			$criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->getId());

			if (!isset($this->lastCollaboratingOrganizationCriteria) || !$this->lastCollaboratingOrganizationCriteria->equals($criteria)) {
				$this->collCollaboratingOrganizations = CollaboratingOrganizationPeer::doSelectJoinOrganization($criteria, $con);
			}
		}
		$this->lastCollaboratingOrganizationCriteria = $criteria;

		return $this->collCollaboratingOrganizations;
	}

	
	public function initCollaborationOutcomeTypes()
	{
		if ($this->collCollaborationOutcomeTypes === null) {
			$this->collCollaborationOutcomeTypes = array();
		}
	}

	
	public function getCollaborationOutcomeTypes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationOutcomeTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollaborationOutcomeTypes === null) {
			if ($this->isNew()) {
			   $this->collCollaborationOutcomeTypes = array();
			} else {

				$criteria->add(CollaborationOutcomeTypePeer::COLLABORATION_ID, $this->getId());

				CollaborationOutcomeTypePeer::addSelectColumns($criteria);
				$this->collCollaborationOutcomeTypes = CollaborationOutcomeTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CollaborationOutcomeTypePeer::COLLABORATION_ID, $this->getId());

				CollaborationOutcomeTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastCollaborationOutcomeTypeCriteria) || !$this->lastCollaborationOutcomeTypeCriteria->equals($criteria)) {
					$this->collCollaborationOutcomeTypes = CollaborationOutcomeTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollaborationOutcomeTypeCriteria = $criteria;
		return $this->collCollaborationOutcomeTypes;
	}

	
	public function countCollaborationOutcomeTypes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationOutcomeTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollaborationOutcomeTypePeer::COLLABORATION_ID, $this->getId());

		return CollaborationOutcomeTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCollaborationOutcomeType(CollaborationOutcomeType $l)
	{
		$this->collCollaborationOutcomeTypes[] = $l;
		$l->setCollaboration($this);
	}

	
	public function initCollaborationTypes()
	{
		if ($this->collCollaborationTypes === null) {
			$this->collCollaborationTypes = array();
		}
	}

	
	public function getCollaborationTypes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollaborationTypes === null) {
			if ($this->isNew()) {
			   $this->collCollaborationTypes = array();
			} else {

				$criteria->add(CollaborationTypePeer::COLLABORATION_ID, $this->getId());

				CollaborationTypePeer::addSelectColumns($criteria);
				$this->collCollaborationTypes = CollaborationTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CollaborationTypePeer::COLLABORATION_ID, $this->getId());

				CollaborationTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastCollaborationTypeCriteria) || !$this->lastCollaborationTypeCriteria->equals($criteria)) {
					$this->collCollaborationTypes = CollaborationTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollaborationTypeCriteria = $criteria;
		return $this->collCollaborationTypes;
	}

	
	public function countCollaborationTypes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCollaborationTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollaborationTypePeer::COLLABORATION_ID, $this->getId());

		return CollaborationTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCollaborationType(CollaborationType $l)
	{
		$this->collCollaborationTypes[] = $l;
		$l->setCollaboration($this);
	}

} 