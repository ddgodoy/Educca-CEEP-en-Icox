<?php


abstract class BaseSco12Peer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sco12';

	
	const CLASS_DEFAULT = 'lib.model.Sco12';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sco12.ID';

	
	const REF_SCO12 = 'sco12.REF_SCO12';

	
	const ID_MATERIA = 'sco12.ID_MATERIA';

	
	const TITLE = 'sco12.TITLE';

	
	const FILE = 'sco12.FILE';

	
	const CREDIT = 'sco12.CREDIT';

	
	const LAUNCH_DATA = 'sco12.LAUNCH_DATA';

	
	const MASTERY_SCORE = 'sco12.MASTERY_SCORE';

	
	const MAX_TIME_ALLOWED = 'sco12.MAX_TIME_ALLOWED';

	
	const TIME_LIMIT_ACTION = 'sco12.TIME_LIMIT_ACTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RefSco12', 'IdMateria', 'Title', 'File', 'Credit', 'LaunchData', 'MasteryScore', 'MaxTimeAllowed', 'TimeLimitAction', ),
		BasePeer::TYPE_COLNAME => array (Sco12Peer::ID, Sco12Peer::REF_SCO12, Sco12Peer::ID_MATERIA, Sco12Peer::TITLE, Sco12Peer::FILE, Sco12Peer::CREDIT, Sco12Peer::LAUNCH_DATA, Sco12Peer::MASTERY_SCORE, Sco12Peer::MAX_TIME_ALLOWED, Sco12Peer::TIME_LIMIT_ACTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'ref_sco12', 'id_materia', 'title', 'file', 'credit', 'launch_data', 'mastery_score', 'max_time_allowed', 'time_limit_action', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RefSco12' => 1, 'IdMateria' => 2, 'Title' => 3, 'File' => 4, 'Credit' => 5, 'LaunchData' => 6, 'MasteryScore' => 7, 'MaxTimeAllowed' => 8, 'TimeLimitAction' => 9, ),
		BasePeer::TYPE_COLNAME => array (Sco12Peer::ID => 0, Sco12Peer::REF_SCO12 => 1, Sco12Peer::ID_MATERIA => 2, Sco12Peer::TITLE => 3, Sco12Peer::FILE => 4, Sco12Peer::CREDIT => 5, Sco12Peer::LAUNCH_DATA => 6, Sco12Peer::MASTERY_SCORE => 7, Sco12Peer::MAX_TIME_ALLOWED => 8, Sco12Peer::TIME_LIMIT_ACTION => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'ref_sco12' => 1, 'id_materia' => 2, 'title' => 3, 'file' => 4, 'credit' => 5, 'launch_data' => 6, 'mastery_score' => 7, 'max_time_allowed' => 8, 'time_limit_action' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Sco12MapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Sco12MapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Sco12Peer::getTableMap();
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
		return str_replace(Sco12Peer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Sco12Peer::ID);

		$criteria->addSelectColumn(Sco12Peer::REF_SCO12);

		$criteria->addSelectColumn(Sco12Peer::ID_MATERIA);

		$criteria->addSelectColumn(Sco12Peer::TITLE);

		$criteria->addSelectColumn(Sco12Peer::FILE);

		$criteria->addSelectColumn(Sco12Peer::CREDIT);

		$criteria->addSelectColumn(Sco12Peer::LAUNCH_DATA);

		$criteria->addSelectColumn(Sco12Peer::MASTERY_SCORE);

		$criteria->addSelectColumn(Sco12Peer::MAX_TIME_ALLOWED);

		$criteria->addSelectColumn(Sco12Peer::TIME_LIMIT_ACTION);

	}

	const COUNT = 'COUNT(sco12.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sco12.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Sco12Peer::doSelectRS($criteria, $con);
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
		$objects = Sco12Peer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Sco12Peer::populateObjects(Sco12Peer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Sco12Peer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Sco12Peer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinMateria(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Sco12Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = Sco12Peer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinMateria(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Sco12Peer::addSelectColumns($c);
		$startcol = (Sco12Peer::NUM_COLUMNS - Sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MateriaPeer::addSelectColumns($c);

		$c->addJoin(Sco12Peer::ID_MATERIA, MateriaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Sco12Peer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MateriaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMateria(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSco12($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSco12s();
				$obj2->addSco12($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Sco12Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = Sco12Peer::doSelectRS($criteria, $con);
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

		Sco12Peer::addSelectColumns($c);
		$startcol2 = (Sco12Peer::NUM_COLUMNS - Sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MateriaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MateriaPeer::NUM_COLUMNS;

		$c->addJoin(Sco12Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Sco12Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = MateriaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMateria(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSco12($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSco12s();
				$obj2->addSco12($obj1);
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
		return Sco12Peer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Sco12Peer::ID); 

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
			$comparison = $criteria->getComparison(Sco12Peer::ID);
			$selectCriteria->add(Sco12Peer::ID, $criteria->remove(Sco12Peer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Sco12Peer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Sco12Peer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Sco12) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Sco12Peer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Sco12 $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Sco12Peer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Sco12Peer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Sco12Peer::DATABASE_NAME, Sco12Peer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Sco12Peer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Sco12Peer::DATABASE_NAME);

		$criteria->add(Sco12Peer::ID, $pk);


		$v = Sco12Peer::doSelect($criteria, $con);

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
			$criteria->add(Sco12Peer::ID, $pks, Criteria::IN);
			$objs = Sco12Peer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSco12Peer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Sco12MapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Sco12MapBuilder');
}
