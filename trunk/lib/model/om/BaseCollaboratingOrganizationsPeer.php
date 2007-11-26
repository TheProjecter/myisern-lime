<?php


abstract class BaseCollaboratingOrganizationsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'isern_collaborating_organizations';

	
	const CLASS_DEFAULT = 'lib.model.CollaboratingOrganizations';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'isern_collaborating_organizations.ID';

	
	const COLLABORATION_ID = 'isern_collaborating_organizations.COLLABORATION_ID';

	
	const ORGANIZATION_ID = 'isern_collaborating_organizations.ORGANIZATION_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CollaborationId', 'OrganizationId', ),
		BasePeer::TYPE_COLNAME => array (CollaboratingOrganizationsPeer::ID, CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaboratingOrganizationsPeer::ORGANIZATION_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'collaboration_id', 'organization_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CollaborationId' => 1, 'OrganizationId' => 2, ),
		BasePeer::TYPE_COLNAME => array (CollaboratingOrganizationsPeer::ID => 0, CollaboratingOrganizationsPeer::COLLABORATION_ID => 1, CollaboratingOrganizationsPeer::ORGANIZATION_ID => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'collaboration_id' => 1, 'organization_id' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/CollaboratingOrganizationsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.CollaboratingOrganizationsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CollaboratingOrganizationsPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(CollaboratingOrganizationsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CollaboratingOrganizationsPeer::ID);

		$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COLLABORATION_ID);

		$criteria->addSelectColumn(CollaboratingOrganizationsPeer::ORGANIZATION_ID);

	}

	const COUNT = 'COUNT(isern_collaborating_organizations.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT isern_collaborating_organizations.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CollaboratingOrganizationsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CollaboratingOrganizationsPeer::populateObjects(CollaboratingOrganizationsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CollaboratingOrganizationsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CollaboratingOrganizationsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCollaboration(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCollaboration(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CollaboratingOrganizationsPeer::addSelectColumns($c);
		$startcol = (CollaboratingOrganizationsPeer::NUM_COLUMNS - CollaboratingOrganizationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CollaborationPeer::addSelectColumns($c);

		$c->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CollaboratingOrganizationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CollaborationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCollaboration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCollaboratingOrganizations($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCollaboratingOrganizationss();
				$obj2->addCollaboratingOrganizations($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CollaboratingOrganizationsPeer::addSelectColumns($c);
		$startcol = (CollaboratingOrganizationsPeer::NUM_COLUMNS - CollaboratingOrganizationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrganizationPeer::addSelectColumns($c);

		$c->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CollaboratingOrganizationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrganizationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCollaboratingOrganizations($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCollaboratingOrganizationss();
				$obj2->addCollaboratingOrganizations($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);

		$criteria->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CollaboratingOrganizationsPeer::addSelectColumns($c);
		$startcol2 = (CollaboratingOrganizationsPeer::NUM_COLUMNS - CollaboratingOrganizationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CollaborationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CollaborationPeer::NUM_COLUMNS;

		OrganizationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OrganizationPeer::NUM_COLUMNS;

		$c->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);

		$c->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CollaboratingOrganizationsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CollaborationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCollaboration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCollaboratingOrganizations($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCollaboratingOrganizationss();
				$obj2->addCollaboratingOrganizations($obj1);
			}


					
			$omClass = OrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOrganization(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCollaboratingOrganizations($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCollaboratingOrganizationss();
				$obj3->addCollaboratingOrganizations($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptCollaboration(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CollaboratingOrganizationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);

		$rs = CollaboratingOrganizationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptCollaboration(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CollaboratingOrganizationsPeer::addSelectColumns($c);
		$startcol2 = (CollaboratingOrganizationsPeer::NUM_COLUMNS - CollaboratingOrganizationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrganizationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrganizationPeer::NUM_COLUMNS;

		$c->addJoin(CollaboratingOrganizationsPeer::ORGANIZATION_ID, OrganizationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CollaboratingOrganizationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCollaboratingOrganizations($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCollaboratingOrganizationss();
				$obj2->addCollaboratingOrganizations($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CollaboratingOrganizationsPeer::addSelectColumns($c);
		$startcol2 = (CollaboratingOrganizationsPeer::NUM_COLUMNS - CollaboratingOrganizationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CollaborationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CollaborationPeer::NUM_COLUMNS;

		$c->addJoin(CollaboratingOrganizationsPeer::COLLABORATION_ID, CollaborationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CollaboratingOrganizationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CollaborationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCollaboration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCollaboratingOrganizations($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCollaboratingOrganizationss();
				$obj2->addCollaboratingOrganizations($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return CollaboratingOrganizationsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(CollaboratingOrganizationsPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CollaboratingOrganizationsPeer::ID);
			$selectCriteria->add(CollaboratingOrganizationsPeer::ID, $criteria->remove(CollaboratingOrganizationsPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(CollaboratingOrganizationsPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(CollaboratingOrganizationsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CollaboratingOrganizations) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CollaboratingOrganizationsPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(CollaboratingOrganizations $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CollaboratingOrganizationsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CollaboratingOrganizationsPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(CollaboratingOrganizationsPeer::DATABASE_NAME, CollaboratingOrganizationsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CollaboratingOrganizationsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(CollaboratingOrganizationsPeer::DATABASE_NAME);

		$criteria->add(CollaboratingOrganizationsPeer::ID, $pk);


		$v = CollaboratingOrganizationsPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(CollaboratingOrganizationsPeer::ID, $pks, Criteria::IN);
			$objs = CollaboratingOrganizationsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCollaboratingOrganizationsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/CollaboratingOrganizationsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.CollaboratingOrganizationsMapBuilder');
}
