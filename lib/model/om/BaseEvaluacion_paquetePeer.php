<?php


abstract class BaseEvaluacion_paquetePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'evaluacion_paquete';

	
	const CLASS_DEFAULT = 'lib.model.Evaluacion_paquete';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_PAQUETE = 'evaluacion_paquete.ID_PAQUETE';

	
	const ID_TAREA = 'evaluacion_paquete.ID_TAREA';

	
	const PESO = 'evaluacion_paquete.PESO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete', 'IdTarea', 'Peso', ),
		BasePeer::TYPE_COLNAME => array (Evaluacion_paquetePeer::ID_PAQUETE, Evaluacion_paquetePeer::ID_TAREA, Evaluacion_paquetePeer::PESO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete', 'id_tarea', 'peso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete' => 0, 'IdTarea' => 1, 'Peso' => 2, ),
		BasePeer::TYPE_COLNAME => array (Evaluacion_paquetePeer::ID_PAQUETE => 0, Evaluacion_paquetePeer::ID_TAREA => 1, Evaluacion_paquetePeer::PESO => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete' => 0, 'id_tarea' => 1, 'peso' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Evaluacion_paqueteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Evaluacion_paqueteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Evaluacion_paquetePeer::getTableMap();
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
		return str_replace(Evaluacion_paquetePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Evaluacion_paquetePeer::ID_PAQUETE);

		$criteria->addSelectColumn(Evaluacion_paquetePeer::ID_TAREA);

		$criteria->addSelectColumn(Evaluacion_paquetePeer::PESO);

	}

	const COUNT = 'COUNT(evaluacion_paquete.ID_PAQUETE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT evaluacion_paquete.ID_PAQUETE)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
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
		$objects = Evaluacion_paquetePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Evaluacion_paquetePeer::populateObjects(Evaluacion_paquetePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Evaluacion_paquetePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Evaluacion_paquetePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPaquete(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTarea(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPaquete(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evaluacion_paquetePeer::addSelectColumns($c);
		$startcol = (Evaluacion_paquetePeer::NUM_COLUMNS - Evaluacion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PaquetePeer::addSelectColumns($c);

		$c->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evaluacion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PaquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPaquete(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEvaluacion_paquete($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvaluacion_paquetes();
				$obj2->addEvaluacion_paquete($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTarea(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evaluacion_paquetePeer::addSelectColumns($c);
		$startcol = (Evaluacion_paquetePeer::NUM_COLUMNS - Evaluacion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TareaPeer::addSelectColumns($c);

		$c->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evaluacion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TareaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTarea(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEvaluacion_paquete($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvaluacion_paquetes();
				$obj2->addEvaluacion_paquete($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$criteria->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
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

		Evaluacion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evaluacion_paquetePeer::NUM_COLUMNS - Evaluacion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		TareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TareaPeer::NUM_COLUMNS;

		$c->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$c->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evaluacion_paquetePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PaquetePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPaquete(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEvaluacion_paquete($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEvaluacion_paquetes();
				$obj2->addEvaluacion_paquete($obj1);
			}


					
			$omClass = TareaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTarea(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEvaluacion_paquete($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEvaluacion_paquetes();
				$obj3->addEvaluacion_paquete($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPaquete(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTarea(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evaluacion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Evaluacion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPaquete(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evaluacion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evaluacion_paquetePeer::NUM_COLUMNS - Evaluacion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TareaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TareaPeer::NUM_COLUMNS;

		$c->addJoin(Evaluacion_paquetePeer::ID_TAREA, TareaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evaluacion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TareaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTarea(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEvaluacion_paquete($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvaluacion_paquetes();
				$obj2->addEvaluacion_paquete($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTarea(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evaluacion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evaluacion_paquetePeer::NUM_COLUMNS - Evaluacion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		$c->addJoin(Evaluacion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evaluacion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PaquetePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPaquete(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEvaluacion_paquete($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvaluacion_paquetes();
				$obj2->addEvaluacion_paquete($obj1);
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
		return Evaluacion_paquetePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(Evaluacion_paquetePeer::ID_PAQUETE);
			$selectCriteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $criteria->remove(Evaluacion_paquetePeer::ID_PAQUETE), $comparison);

			$comparison = $criteria->getComparison(Evaluacion_paquetePeer::ID_TAREA);
			$selectCriteria->add(Evaluacion_paquetePeer::ID_TAREA, $criteria->remove(Evaluacion_paquetePeer::ID_TAREA), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Evaluacion_paquetePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Evaluacion_paquetePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Evaluacion_paquete) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $vals[0], Criteria::IN);
			$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Evaluacion_paquete $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Evaluacion_paquetePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Evaluacion_paquetePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Evaluacion_paquetePeer::DATABASE_NAME, Evaluacion_paquetePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Evaluacion_paquetePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_paquete, $id_tarea, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $id_paquete);
		$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $id_tarea);
		$v = Evaluacion_paquetePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEvaluacion_paquetePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Evaluacion_paqueteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Evaluacion_paqueteMapBuilder');
}
