<?php


abstract class BaseEvalucion_paquetePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'evalucion_paquete';

	
	const CLASS_DEFAULT = 'lib.model.Evalucion_paquete';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_PAQUETE = 'evalucion_paquete.ID_PAQUETE';

	
	const ID_EJERCICIO = 'evalucion_paquete.ID_EJERCICIO';

	
	const PESO = 'evalucion_paquete.PESO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete', 'IdEjercicio', 'Peso', ),
		BasePeer::TYPE_COLNAME => array (Evalucion_paquetePeer::ID_PAQUETE, Evalucion_paquetePeer::ID_EJERCICIO, Evalucion_paquetePeer::PESO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete', 'id_ejercicio', 'peso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete' => 0, 'IdEjercicio' => 1, 'Peso' => 2, ),
		BasePeer::TYPE_COLNAME => array (Evalucion_paquetePeer::ID_PAQUETE => 0, Evalucion_paquetePeer::ID_EJERCICIO => 1, Evalucion_paquetePeer::PESO => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete' => 0, 'id_ejercicio' => 1, 'peso' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Evalucion_paqueteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Evalucion_paqueteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Evalucion_paquetePeer::getTableMap();
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
		return str_replace(Evalucion_paquetePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Evalucion_paquetePeer::ID_PAQUETE);

		$criteria->addSelectColumn(Evalucion_paquetePeer::ID_EJERCICIO);

		$criteria->addSelectColumn(Evalucion_paquetePeer::PESO);

	}

	const COUNT = 'COUNT(evalucion_paquete.ID_PAQUETE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT evalucion_paquete.ID_PAQUETE)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
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
		$objects = Evalucion_paquetePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Evalucion_paquetePeer::populateObjects(Evalucion_paquetePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Evalucion_paquetePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Evalucion_paquetePeer::getOMClass();
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
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
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

		Evalucion_paquetePeer::addSelectColumns($c);
		$startcol = (Evalucion_paquetePeer::NUM_COLUMNS - Evalucion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PaquetePeer::addSelectColumns($c);

		$c->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evalucion_paquetePeer::getOMClass();

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
										$temp_obj2->addEvalucion_paquete($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvalucion_paquetes();
				$obj2->addEvalucion_paquete($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evalucion_paquetePeer::addSelectColumns($c);
		$startcol = (Evalucion_paquetePeer::NUM_COLUMNS - Evalucion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EjercicioPeer::addSelectColumns($c);

		$c->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evalucion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EjercicioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEjercicio(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEvalucion_paquete($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvalucion_paquetes();
				$obj2->addEvalucion_paquete($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$criteria->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
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

		Evalucion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evalucion_paquetePeer::NUM_COLUMNS - Evalucion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		EjercicioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EjercicioPeer::NUM_COLUMNS;

		$c->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$c->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evalucion_paquetePeer::getOMClass();


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
					$temp_obj2->addEvalucion_paquete($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEvalucion_paquetes();
				$obj2->addEvalucion_paquete($obj1);
			}


					
			$omClass = EjercicioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEjercicio(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEvalucion_paquete($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEvalucion_paquetes();
				$obj3->addEvalucion_paquete($obj1);
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
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Evalucion_paquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Evalucion_paquetePeer::doSelectRS($criteria, $con);
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

		Evalucion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evalucion_paquetePeer::NUM_COLUMNS - Evalucion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EjercicioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EjercicioPeer::NUM_COLUMNS;

		$c->addJoin(Evalucion_paquetePeer::ID_EJERCICIO, EjercicioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evalucion_paquetePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EjercicioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEjercicio(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEvalucion_paquete($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvalucion_paquetes();
				$obj2->addEvalucion_paquete($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Evalucion_paquetePeer::addSelectColumns($c);
		$startcol2 = (Evalucion_paquetePeer::NUM_COLUMNS - Evalucion_paquetePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		$c->addJoin(Evalucion_paquetePeer::ID_PAQUETE, PaquetePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Evalucion_paquetePeer::getOMClass();

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
					$temp_obj2->addEvalucion_paquete($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvalucion_paquetes();
				$obj2->addEvalucion_paquete($obj1);
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
		return Evalucion_paquetePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Evalucion_paquetePeer::ID_PAQUETE);
			$selectCriteria->add(Evalucion_paquetePeer::ID_PAQUETE, $criteria->remove(Evalucion_paquetePeer::ID_PAQUETE), $comparison);

			$comparison = $criteria->getComparison(Evalucion_paquetePeer::ID_EJERCICIO);
			$selectCriteria->add(Evalucion_paquetePeer::ID_EJERCICIO, $criteria->remove(Evalucion_paquetePeer::ID_EJERCICIO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Evalucion_paquetePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Evalucion_paquetePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Evalucion_paquete) {

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

			$criteria->add(Evalucion_paquetePeer::ID_PAQUETE, $vals[0], Criteria::IN);
			$criteria->add(Evalucion_paquetePeer::ID_EJERCICIO, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Evalucion_paquete $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Evalucion_paquetePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Evalucion_paquetePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Evalucion_paquetePeer::DATABASE_NAME, Evalucion_paquetePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Evalucion_paquetePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_paquete, $id_ejercicio, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Evalucion_paquetePeer::ID_PAQUETE, $id_paquete);
		$criteria->add(Evalucion_paquetePeer::ID_EJERCICIO, $id_ejercicio);
		$v = Evalucion_paquetePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEvalucion_paquetePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Evalucion_paqueteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Evalucion_paqueteMapBuilder');
}
