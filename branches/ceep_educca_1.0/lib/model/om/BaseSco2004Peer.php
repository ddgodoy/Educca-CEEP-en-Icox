<?php


abstract class BaseSco2004Peer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sco2004';

	
	const CLASS_DEFAULT = 'lib.model.Sco2004';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sco2004.ID';

	
	const REF_SCO2004 = 'sco2004.REF_SCO2004';

	
	const ID_MATERIA = 'sco2004.ID_MATERIA';

	
	const TITLE = 'sco2004.TITLE';

	
	const FILE = 'sco2004.FILE';

	
	const COMPLETION_TRESHOLD = 'sco2004.COMPLETION_TRESHOLD';

	
	const CREDIT = 'sco2004.CREDIT';

	
	const LAUNCH_DATA = 'sco2004.LAUNCH_DATA';

	
	const MAX_TIME_ALLOWED = 'sco2004.MAX_TIME_ALLOWED';

	
	const MODE = 'sco2004.MODE';

	
	const TIME_LIMIT_ACTION = 'sco2004.TIME_LIMIT_ACTION';

	
	const SCALED_PASSING_SCORE = 'sco2004.SCALED_PASSING_SCORE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RefSco2004', 'IdMateria', 'Title', 'File', 'CompletionTreshold', 'Credit', 'LaunchData', 'MaxTimeAllowed', 'Mode', 'TimeLimitAction', 'ScaledPassingScore', ),
		BasePeer::TYPE_COLNAME => array (Sco2004Peer::ID, Sco2004Peer::REF_SCO2004, Sco2004Peer::ID_MATERIA, Sco2004Peer::TITLE, Sco2004Peer::FILE, Sco2004Peer::COMPLETION_TRESHOLD, Sco2004Peer::CREDIT, Sco2004Peer::LAUNCH_DATA, Sco2004Peer::MAX_TIME_ALLOWED, Sco2004Peer::MODE, Sco2004Peer::TIME_LIMIT_ACTION, Sco2004Peer::SCALED_PASSING_SCORE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'ref_sco2004', 'id_materia', 'title', 'file', 'completion_treshold', 'credit', 'launch_data', 'max_time_allowed', 'mode', 'time_limit_action', 'scaled_passing_score', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RefSco2004' => 1, 'IdMateria' => 2, 'Title' => 3, 'File' => 4, 'CompletionTreshold' => 5, 'Credit' => 6, 'LaunchData' => 7, 'MaxTimeAllowed' => 8, 'Mode' => 9, 'TimeLimitAction' => 10, 'ScaledPassingScore' => 11, ),
		BasePeer::TYPE_COLNAME => array (Sco2004Peer::ID => 0, Sco2004Peer::REF_SCO2004 => 1, Sco2004Peer::ID_MATERIA => 2, Sco2004Peer::TITLE => 3, Sco2004Peer::FILE => 4, Sco2004Peer::COMPLETION_TRESHOLD => 5, Sco2004Peer::CREDIT => 6, Sco2004Peer::LAUNCH_DATA => 7, Sco2004Peer::MAX_TIME_ALLOWED => 8, Sco2004Peer::MODE => 9, Sco2004Peer::TIME_LIMIT_ACTION => 10, Sco2004Peer::SCALED_PASSING_SCORE => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'ref_sco2004' => 1, 'id_materia' => 2, 'title' => 3, 'file' => 4, 'completion_treshold' => 5, 'credit' => 6, 'launch_data' => 7, 'max_time_allowed' => 8, 'mode' => 9, 'time_limit_action' => 10, 'scaled_passing_score' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Sco2004MapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Sco2004MapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Sco2004Peer::getTableMap();
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
		return str_replace(Sco2004Peer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Sco2004Peer::ID);

		$criteria->addSelectColumn(Sco2004Peer::REF_SCO2004);

		$criteria->addSelectColumn(Sco2004Peer::ID_MATERIA);

		$criteria->addSelectColumn(Sco2004Peer::TITLE);

		$criteria->addSelectColumn(Sco2004Peer::FILE);

		$criteria->addSelectColumn(Sco2004Peer::COMPLETION_TRESHOLD);

		$criteria->addSelectColumn(Sco2004Peer::CREDIT);

		$criteria->addSelectColumn(Sco2004Peer::LAUNCH_DATA);

		$criteria->addSelectColumn(Sco2004Peer::MAX_TIME_ALLOWED);

		$criteria->addSelectColumn(Sco2004Peer::MODE);

		$criteria->addSelectColumn(Sco2004Peer::TIME_LIMIT_ACTION);

		$criteria->addSelectColumn(Sco2004Peer::SCALED_PASSING_SCORE);

	}

	const COUNT = 'COUNT(sco2004.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sco2004.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Sco2004Peer::doSelectRS($criteria, $con);
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
		$objects = Sco2004Peer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Sco2004Peer::populateObjects(Sco2004Peer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Sco2004Peer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Sco2004Peer::getOMClass();
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
			$criteria->addSelectColumn(Sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Sco2004Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = Sco2004Peer::doSelectRS($criteria, $con);
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

		Sco2004Peer::addSelectColumns($c);
		$startcol = (Sco2004Peer::NUM_COLUMNS - Sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MateriaPeer::addSelectColumns($c);

		$c->addJoin(Sco2004Peer::ID_MATERIA, MateriaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Sco2004Peer::getOMClass();

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
										$temp_obj2->addSco2004($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSco2004s();
				$obj2->addSco2004($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Sco2004Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = Sco2004Peer::doSelectRS($criteria, $con);
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

		Sco2004Peer::addSelectColumns($c);
		$startcol2 = (Sco2004Peer::NUM_COLUMNS - Sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MateriaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MateriaPeer::NUM_COLUMNS;

		$c->addJoin(Sco2004Peer::ID_MATERIA, MateriaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Sco2004Peer::getOMClass();


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
					$temp_obj2->addSco2004($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSco2004s();
				$obj2->addSco2004($obj1);
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
		return Sco2004Peer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Sco2004Peer::ID); 

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
			$comparison = $criteria->getComparison(Sco2004Peer::ID);
			$selectCriteria->add(Sco2004Peer::ID, $criteria->remove(Sco2004Peer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Sco2004Peer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Sco2004Peer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Sco2004) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Sco2004Peer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Sco2004 $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Sco2004Peer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Sco2004Peer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Sco2004Peer::DATABASE_NAME, Sco2004Peer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Sco2004Peer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Sco2004Peer::DATABASE_NAME);

		$criteria->add(Sco2004Peer::ID, $pk);


		$v = Sco2004Peer::doSelect($criteria, $con);

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
			$criteria->add(Sco2004Peer::ID, $pks, Criteria::IN);
			$objs = Sco2004Peer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSco2004Peer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Sco2004MapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Sco2004MapBuilder');
}
