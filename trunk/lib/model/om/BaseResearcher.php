<?php


abstract class BaseResearcher extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $organization_id;


	
	protected $name;


	
	protected $email;


	
	protected $picture_link;


	
	protected $bio_statement;


	
	protected $created_at;

	
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

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPictureLink()
	{

		return $this->picture_link;
	}

	
	public function getBioStatement()
	{

		return $this->bio_statement;
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
			$this->modifiedColumns[] = ResearcherPeer::ID;
		}

	} 
	
	public function setOrganizationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_id !== $v) {
			$this->organization_id = $v;
			$this->modifiedColumns[] = ResearcherPeer::ORGANIZATION_ID;
		}

		if ($this->aOrganization !== null && $this->aOrganization->getId() !== $v) {
			$this->aOrganization = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ResearcherPeer::NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = ResearcherPeer::EMAIL;
		}

	} 
	
	public function setPictureLink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->picture_link !== $v) {
			$this->picture_link = $v;
			$this->modifiedColumns[] = ResearcherPeer::PICTURE_LINK;
		}

	} 
	
	public function setBioStatement($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bio_statement !== $v) {
			$this->bio_statement = $v;
			$this->modifiedColumns[] = ResearcherPeer::BIO_STATEMENT;
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
			$this->modifiedColumns[] = ResearcherPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->organization_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->email = $rs->getString($startcol + 3);

			$this->picture_link = $rs->getString($startcol + 4);

			$this->bio_statement = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Researcher object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ResearcherPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ResearcherPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ResearcherPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ResearcherPeer::DATABASE_NAME);
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
					$pk = ResearcherPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ResearcherPeer::doUpdate($this, $con);
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


			if (($retval = ResearcherPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ResearcherPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getEmail();
				break;
			case 4:
				return $this->getPictureLink();
				break;
			case 5:
				return $this->getBioStatement();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ResearcherPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrganizationId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getEmail(),
			$keys[4] => $this->getPictureLink(),
			$keys[5] => $this->getBioStatement(),
			$keys[6] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ResearcherPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setEmail($value);
				break;
			case 4:
				$this->setPictureLink($value);
				break;
			case 5:
				$this->setBioStatement($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ResearcherPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrganizationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPictureLink($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBioStatement($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ResearcherPeer::DATABASE_NAME);

		if ($this->isColumnModified(ResearcherPeer::ID)) $criteria->add(ResearcherPeer::ID, $this->id);
		if ($this->isColumnModified(ResearcherPeer::ORGANIZATION_ID)) $criteria->add(ResearcherPeer::ORGANIZATION_ID, $this->organization_id);
		if ($this->isColumnModified(ResearcherPeer::NAME)) $criteria->add(ResearcherPeer::NAME, $this->name);
		if ($this->isColumnModified(ResearcherPeer::EMAIL)) $criteria->add(ResearcherPeer::EMAIL, $this->email);
		if ($this->isColumnModified(ResearcherPeer::PICTURE_LINK)) $criteria->add(ResearcherPeer::PICTURE_LINK, $this->picture_link);
		if ($this->isColumnModified(ResearcherPeer::BIO_STATEMENT)) $criteria->add(ResearcherPeer::BIO_STATEMENT, $this->bio_statement);
		if ($this->isColumnModified(ResearcherPeer::CREATED_AT)) $criteria->add(ResearcherPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ResearcherPeer::DATABASE_NAME);

		$criteria->add(ResearcherPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setEmail($this->email);

		$copyObj->setPictureLink($this->picture_link);

		$copyObj->setBioStatement($this->bio_statement);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new ResearcherPeer();
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
				include_once 'lib/model/om/BaseOrganizationPeer.php';

		if ($this->aOrganization === null && ($this->organization_id !== null)) {

			$this->aOrganization = OrganizationPeer::retrieveByPK($this->organization_id, $con);

			
		}
		return $this->aOrganization;
	}

} 