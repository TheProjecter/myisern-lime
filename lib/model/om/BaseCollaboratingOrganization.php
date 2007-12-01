<?php


abstract class BaseCollaboratingOrganization extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $collaboration_id;


	
	protected $organization_id;

	
	protected $aCollaboration;

	
	protected $aOrganization;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCollaborationId()
	{

		return $this->collaboration_id;
	}

	
	public function getOrganizationId()
	{

		return $this->organization_id;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CollaboratingOrganizationPeer::ID;
		}

	} 
	
	public function setCollaborationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->collaboration_id !== $v) {
			$this->collaboration_id = $v;
			$this->modifiedColumns[] = CollaboratingOrganizationPeer::COLLABORATION_ID;
		}

		if ($this->aCollaboration !== null && $this->aCollaboration->getId() !== $v) {
			$this->aCollaboration = null;
		}

	} 
	
	public function setOrganizationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_id !== $v) {
			$this->organization_id = $v;
			$this->modifiedColumns[] = CollaboratingOrganizationPeer::ORGANIZATION_ID;
		}

		if ($this->aOrganization !== null && $this->aOrganization->getId() !== $v) {
			$this->aOrganization = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->collaboration_id = $rs->getInt($startcol + 1);

			$this->organization_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CollaboratingOrganization object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CollaboratingOrganizationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CollaboratingOrganizationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CollaboratingOrganizationPeer::DATABASE_NAME);
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


												
			if ($this->aCollaboration !== null) {
				if ($this->aCollaboration->isModified()) {
					$affectedRows += $this->aCollaboration->save($con);
				}
				$this->setCollaboration($this->aCollaboration);
			}

			if ($this->aOrganization !== null) {
				if ($this->aOrganization->isModified()) {
					$affectedRows += $this->aOrganization->save($con);
				}
				$this->setOrganization($this->aOrganization);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CollaboratingOrganizationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CollaboratingOrganizationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aCollaboration !== null) {
				if (!$this->aCollaboration->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCollaboration->getValidationFailures());
				}
			}

			if ($this->aOrganization !== null) {
				if (!$this->aOrganization->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrganization->getValidationFailures());
				}
			}


			if (($retval = CollaboratingOrganizationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CollaboratingOrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCollaborationId();
				break;
			case 2:
				return $this->getOrganizationId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CollaboratingOrganizationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCollaborationId(),
			$keys[2] => $this->getOrganizationId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CollaboratingOrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCollaborationId($value);
				break;
			case 2:
				$this->setOrganizationId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CollaboratingOrganizationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCollaborationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOrganizationId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CollaboratingOrganizationPeer::DATABASE_NAME);

		if ($this->isColumnModified(CollaboratingOrganizationPeer::ID)) $criteria->add(CollaboratingOrganizationPeer::ID, $this->id);
		if ($this->isColumnModified(CollaboratingOrganizationPeer::COLLABORATION_ID)) $criteria->add(CollaboratingOrganizationPeer::COLLABORATION_ID, $this->collaboration_id);
		if ($this->isColumnModified(CollaboratingOrganizationPeer::ORGANIZATION_ID)) $criteria->add(CollaboratingOrganizationPeer::ORGANIZATION_ID, $this->organization_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CollaboratingOrganizationPeer::DATABASE_NAME);

		$criteria->add(CollaboratingOrganizationPeer::ID, $this->id);

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

		$copyObj->setCollaborationId($this->collaboration_id);

		$copyObj->setOrganizationId($this->organization_id);


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
			self::$peer = new CollaboratingOrganizationPeer();
		}
		return self::$peer;
	}

	
	public function setCollaboration($v)
	{


		if ($v === null) {
			$this->setCollaborationId(NULL);
		} else {
			$this->setCollaborationId($v->getId());
		}


		$this->aCollaboration = $v;
	}


	
	public function getCollaboration($con = null)
	{
		if ($this->aCollaboration === null && ($this->collaboration_id !== null)) {
						include_once 'lib/model/om/BaseCollaborationPeer.php';

			$this->aCollaboration = CollaborationPeer::retrieveByPK($this->collaboration_id, $con);

			
		}
		return $this->aCollaboration;
	}

	
	public function setOrganization($v)
	{


		if ($v === null) {
			$this->setOrganizationId(NULL);
		} else {
			$this->setOrganizationId($v->getId());
		}


		$this->aOrganization = $v;
	}


	
	public function getOrganization($con = null)
	{
		if ($this->aOrganization === null && ($this->organization_id !== null)) {
						include_once 'lib/model/om/BaseOrganizationPeer.php';

			$this->aOrganization = OrganizationPeer::retrieveByPK($this->organization_id, $con);

			
		}
		return $this->aOrganization;
	}

} 