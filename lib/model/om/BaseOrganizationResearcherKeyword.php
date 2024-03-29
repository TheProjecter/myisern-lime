<?php


abstract class BaseOrganizationResearcherKeyword extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $organization_id;


	
	protected $keyword;

	
	protected $aOrganization;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getOrganizationId()
	{

		return $this->organization_id;
	}

	
	public function getKeyword()
	{

		return $this->keyword;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OrganizationResearcherKeywordPeer::ID;
		}

	} 
	
	public function setOrganizationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_id !== $v) {
			$this->organization_id = $v;
			$this->modifiedColumns[] = OrganizationResearcherKeywordPeer::ORGANIZATION_ID;
		}

		if ($this->aOrganization !== null && $this->aOrganization->getId() !== $v) {
			$this->aOrganization = null;
		}

	} 
	
	public function setKeyword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->keyword !== $v) {
			$this->keyword = $v;
			$this->modifiedColumns[] = OrganizationResearcherKeywordPeer::KEYWORD;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->organization_id = $rs->getInt($startcol + 1);

			$this->keyword = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OrganizationResearcherKeyword object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrganizationResearcherKeywordPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrganizationResearcherKeywordPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OrganizationResearcherKeywordPeer::DATABASE_NAME);
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


												
			if ($this->aOrganization !== null) {
				if ($this->aOrganization->isModified()) {
					$affectedRows += $this->aOrganization->save($con);
				}
				$this->setOrganization($this->aOrganization);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OrganizationResearcherKeywordPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OrganizationResearcherKeywordPeer::doUpdate($this, $con);
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


												
			if ($this->aOrganization !== null) {
				if (!$this->aOrganization->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrganization->getValidationFailures());
				}
			}


			if (($retval = OrganizationResearcherKeywordPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrganizationResearcherKeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getOrganizationId();
				break;
			case 2:
				return $this->getKeyword();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrganizationResearcherKeywordPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrganizationId(),
			$keys[2] => $this->getKeyword(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrganizationResearcherKeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setOrganizationId($value);
				break;
			case 2:
				$this->setKeyword($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrganizationResearcherKeywordPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrganizationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKeyword($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrganizationResearcherKeywordPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrganizationResearcherKeywordPeer::ID)) $criteria->add(OrganizationResearcherKeywordPeer::ID, $this->id);
		if ($this->isColumnModified(OrganizationResearcherKeywordPeer::ORGANIZATION_ID)) $criteria->add(OrganizationResearcherKeywordPeer::ORGANIZATION_ID, $this->organization_id);
		if ($this->isColumnModified(OrganizationResearcherKeywordPeer::KEYWORD)) $criteria->add(OrganizationResearcherKeywordPeer::KEYWORD, $this->keyword);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrganizationResearcherKeywordPeer::DATABASE_NAME);

		$criteria->add(OrganizationResearcherKeywordPeer::ID, $this->id);

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

		$copyObj->setOrganizationId($this->organization_id);

		$copyObj->setKeyword($this->keyword);


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
			self::$peer = new OrganizationResearcherKeywordPeer();
		}
		return self::$peer;
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