<?php


abstract class BaseResearcherPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'isern_researchers';

	
	const CLASS_DEFAULT = 'lib.model.Researcher';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'isern_researchers.ID';

	
	const ORGANIZATION_ID = 'isern_researchers.ORGANIZATION_ID';

	
	const NAME = 'isern_researchers.NAME';

	
	const EMAIL = 'isern_researchers.EMAIL';

	
	const PICTURE_LINK = 'isern_researchers.PICTURE_LINK';

	
	const BIO_STATEMENT = 'isern_researchers.BIO_STATEMENT';

	
	const CREATED_AT = 'isern_researchers.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'OrganizationId', 'Name', 'Email', 'PictureLink', 'BioStatement', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (ResearcherPeer::ID, ResearcherPeer::ORGANIZATION_ID, ResearcherPeer::NAME, ResearcherPeer::EMAIL, ResearcherPeer::PICTURE_LINK, ResearcherPeer::BIO_STATEMENT, ResearcherPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'organization_id', 'name', 'email', 'picture_link', 'bio_statement', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'OrganizationId' => 1, 'Name' => 2, 'Email' => 3, 'PictureLink' => 4, 'BioStatement' => 5, 'CreatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (ResearcherPeer::ID => 0, ResearcherPeer::ORGANIZATION_ID => 1, ResearcherPeer::NAME => 2, ResearcherPeer::EMAIL => 3, ResearcherPeer::PICTURE_LINK => 4, ResearcherPeer::BIO_STATEMENT => 5, ResearcherPeer::CREATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'organization_id' => 1, 'name' => 2, 'email' => 3, 'picture_link' => 4, 'bio_statement' => 5, 'created_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ResearcherMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ResearcherMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ResearcherPeer::getTableMap();
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
		return str_replace(ResearcherPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ResearcherPeer::ID);

		$criteria->addSelectColumn(ResearcherPeer::ORGANIZATION_ID);

		$criteria->addSelectColumn(ResearcherPeer::NAME);

		$criteria->addSelectColumn(ResearcherPeer::EMAIL);

		$criteria->addSelectColumn(ResearcherPeer::PICTURE_LINK);

		$criteria->addSelectColumn(ResearcherPeer::BIO_STATEMENT);

		$criteria->addSelectColumn(ResearcherPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(isern_researchers.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT isern_researchers.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResearcherPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResearcherPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ResearcherPeer::doSelectRS($criteria, $con);
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
		$objects = ResearcherPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ResearcherPeer::populateObjects(ResearcherPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ResearcherPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ResearcherPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResearcherPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResearcherPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ResearcherPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = ResearcherPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ResearcherPeer::addSelectColumns($c);
		$startcol = (ResearcherPeer::NUM_COLUMNS - ResearcherPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrganizationPeer::addSelectColumns($c);

		$c->addJoin(ResearcherPeer::ORGANIZATION_ID, OrganizationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ResearcherPeer::getOMClass();

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
										$temp_obj2->addResearcher($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initResearchers();
				$obj2->addResearcher($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResearcherPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResearcherPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ResearcherPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = ResearcherPeer::doSelectRS($criteria, $con);
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

		ResearcherPeer::addSelectColumns($c);
		$startcol2 = (ResearcherPeer::NUM_COLUMNS - ResearcherPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrganizationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrganizationPeer::NUM_COLUMNS;

		$c->addJoin(ResearcherPeer::ORGANIZATION_ID, OrganizationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ResearcherPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addResearcher($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initResearchers();
				$obj2->addResearcher($obj1);
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
		return ResearcherPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ResearcherPeer::ID); 

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
			$comparison = $criteria->getComparison(ResearcherPeer::ID);
			$selectCriteria->add(ResearcherPeer::ID, $criteria->remove(ResearcherPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ResearcherPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ResearcherPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Researcher) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ResearcherPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Researcher $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ResearcherPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ResearcherPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ResearcherPeer::DATABASE_NAME, ResearcherPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ResearcherPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ResearcherPeer::DATABASE_NAME);

		$criteria->add(ResearcherPeer::ID, $pk);


		$v = ResearcherPeer::doSelect($criteria, $con);

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
			$criteria->add(ResearcherPeer::ID, $pks, Criteria::IN);
			$objs = ResearcherPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseResearcherPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ResearcherMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ResearcherMapBuilder');
}
