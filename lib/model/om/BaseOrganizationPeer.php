<?php


abstract class BaseOrganizationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'isern_organizations';

	
	const CLASS_DEFAULT = 'lib.model.Organization';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'isern_organizations.ID';

	
	const ORGANIZATION_TYPE_ID = 'isern_organizations.ORGANIZATION_TYPE_ID';

	
	const NAME = 'isern_organizations.NAME';

	
	const COUNTRY = 'isern_organizations.COUNTRY';

	
	const HOME_PAGE = 'isern_organizations.HOME_PAGE';

	
	const RESEARCH_KEYWORDS = 'isern_organizations.RESEARCH_KEYWORDS';

	
	const RESEARCH_DESCRIPTION = 'isern_organizations.RESEARCH_DESCRIPTION';

	
	const CREATED_AT = 'isern_organizations.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'OrganizationTypeId', 'Name', 'Country', 'HomePage', 'ResearchKeywords', 'ResearchDescription', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OrganizationPeer::ID, OrganizationPeer::ORGANIZATION_TYPE_ID, OrganizationPeer::NAME, OrganizationPeer::COUNTRY, OrganizationPeer::HOME_PAGE, OrganizationPeer::RESEARCH_KEYWORDS, OrganizationPeer::RESEARCH_DESCRIPTION, OrganizationPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'organization_type_id', 'name', 'country', 'home_page', 'research_keywords', 'research_description', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'OrganizationTypeId' => 1, 'Name' => 2, 'Country' => 3, 'HomePage' => 4, 'ResearchKeywords' => 5, 'ResearchDescription' => 6, 'CreatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (OrganizationPeer::ID => 0, OrganizationPeer::ORGANIZATION_TYPE_ID => 1, OrganizationPeer::NAME => 2, OrganizationPeer::COUNTRY => 3, OrganizationPeer::HOME_PAGE => 4, OrganizationPeer::RESEARCH_KEYWORDS => 5, OrganizationPeer::RESEARCH_DESCRIPTION => 6, OrganizationPeer::CREATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'organization_type_id' => 1, 'name' => 2, 'country' => 3, 'home_page' => 4, 'research_keywords' => 5, 'research_description' => 6, 'created_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OrganizationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OrganizationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OrganizationPeer::getTableMap();
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
		return str_replace(OrganizationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OrganizationPeer::ID);

		$criteria->addSelectColumn(OrganizationPeer::ORGANIZATION_TYPE_ID);

		$criteria->addSelectColumn(OrganizationPeer::NAME);

		$criteria->addSelectColumn(OrganizationPeer::COUNTRY);

		$criteria->addSelectColumn(OrganizationPeer::HOME_PAGE);

		$criteria->addSelectColumn(OrganizationPeer::RESEARCH_KEYWORDS);

		$criteria->addSelectColumn(OrganizationPeer::RESEARCH_DESCRIPTION);

		$criteria->addSelectColumn(OrganizationPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(isern_organizations.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT isern_organizations.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrganizationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrganizationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OrganizationPeer::doSelectRS($criteria, $con);
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
		$objects = OrganizationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OrganizationPeer::populateObjects(OrganizationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OrganizationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OrganizationPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOrganizationType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrganizationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrganizationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrganizationPeer::ORGANIZATION_TYPE_ID, OrganizationTypePeer::ID);

		$rs = OrganizationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOrganizationType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrganizationPeer::addSelectColumns($c);
		$startcol = (OrganizationPeer::NUM_COLUMNS - OrganizationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrganizationTypePeer::addSelectColumns($c);

		$c->addJoin(OrganizationPeer::ORGANIZATION_TYPE_ID, OrganizationTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrganizationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrganizationTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOrganizationType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrganization($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrganizations();
				$obj2->addOrganization($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrganizationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrganizationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrganizationPeer::ORGANIZATION_TYPE_ID, OrganizationTypePeer::ID);

		$rs = OrganizationPeer::doSelectRS($criteria, $con);
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

		OrganizationPeer::addSelectColumns($c);
		$startcol2 = (OrganizationPeer::NUM_COLUMNS - OrganizationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrganizationTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrganizationTypePeer::NUM_COLUMNS;

		$c->addJoin(OrganizationPeer::ORGANIZATION_TYPE_ID, OrganizationTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OrganizationTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrganizationType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrganization($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOrganizations();
				$obj2->addOrganization($obj1);
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
		return OrganizationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OrganizationPeer::ID); 

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
			$comparison = $criteria->getComparison(OrganizationPeer::ID);
			$selectCriteria->add(OrganizationPeer::ID, $criteria->remove(OrganizationPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OrganizationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OrganizationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Organization) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OrganizationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Organization $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OrganizationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OrganizationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OrganizationPeer::DATABASE_NAME, OrganizationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OrganizationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OrganizationPeer::DATABASE_NAME);

		$criteria->add(OrganizationPeer::ID, $pk);


		$v = OrganizationPeer::doSelect($criteria, $con);

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
			$criteria->add(OrganizationPeer::ID, $pks, Criteria::IN);
			$objs = OrganizationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOrganizationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OrganizationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OrganizationMapBuilder');
}
