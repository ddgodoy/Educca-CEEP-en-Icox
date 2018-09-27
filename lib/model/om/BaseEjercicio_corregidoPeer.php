<?php


abstract class BaseEjercicio_corregidoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ejercicio_corregido';

	
	const CLASS_DEFAULT = 'lib.model.Ejercicio_corregido';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ejercicio_corregido.ID';

	
	const ID_CORRECTOR = 'ejercicio_corregido.ID_CORRECTOR';

	
	const ID_EJERCICIO_RESUELTO = 'ejercicio_corregido.ID_EJERCICIO_RESUELTO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdCorrector', 'IdEjercicioResuelto', ),
		BasePeer::TYPE_COLNAME => array (Ejercicio_corregidoPeer::ID, Ejercicio_corregidoPeer::ID_CORRECTOR, Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_corrector', 'id_ejercicio_resuelto', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdCorrector' => 1, 'IdEjercicioResuelto' => 2, ),
		BasePeer::TYPE_COLNAME => array (Ejercicio_corregidoPeer::ID => 0, Ejercicio_corregidoPeer::ID_CORRECTOR => 1, Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_corrector' => 1, 'id_ejercicio_resuelto' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Ejercicio_corregidoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Ejercicio_corregidoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Ejercicio_corregidoPeer::getTableMap();
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
		return str_replace(Ejercicio_corregidoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Ejercicio_corregidoPeer::ID);

		$criteria->addSelectColumn(Ejercicio_corregidoPeer::ID_CORRECTOR);

		$criteria->addSelectColumn(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO);

	}

	const COUNT = 'COUNT(ejercicio_corregido.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ejercicio_corregido.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
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
		$objects = Ejercicio_corregidoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Ejercicio_corregidoPeer::populateObjects(Ejercicio_corregidoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Ejercicio_corregidoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Ejercicio_corregidoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEjercicio_resuelto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol = (Ejercicio_corregidoPeer::NUM_COLUMNS - Ejercicio_corregidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_corregidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio_corregido($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicio_corregidos();
				$obj2->addEjercicio_corregido($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEjercicio_resuelto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol = (Ejercicio_corregidoPeer::NUM_COLUMNS - Ejercicio_corregidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Ejercicio_resueltoPeer::addSelectColumns($c);

		$c->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_corregidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Ejercicio_resueltoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio_corregido($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicio_corregidos();
				$obj2->addEjercicio_corregido($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
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

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_corregidoPeer::NUM_COLUMNS - Ejercicio_corregidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$c->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_corregidoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio_corregido($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_corregidos();
				$obj2->addEjercicio_corregido($obj1);
			}


					
			$omClass = Ejercicio_resueltoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio_corregido($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicio_corregidos();
				$obj3->addEjercicio_corregido($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEjercicio_resuelto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_corregidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = Ejercicio_corregidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_corregidoPeer::NUM_COLUMNS - Ejercicio_corregidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_corregidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Ejercicio_resueltoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio_corregido($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_corregidos();
				$obj2->addEjercicio_corregido($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEjercicio_resuelto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_corregidoPeer::NUM_COLUMNS - Ejercicio_corregidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_corregidoPeer::ID_CORRECTOR, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_corregidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio_corregido($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_corregidos();
				$obj2->addEjercicio_corregido($obj1);
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
		return Ejercicio_corregidoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Ejercicio_corregidoPeer::ID); 

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
			$comparison = $criteria->getComparison(Ejercicio_corregidoPeer::ID);
			$selectCriteria->add(Ejercicio_corregidoPeer::ID, $criteria->remove(Ejercicio_corregidoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Ejercicio_corregidoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Ejercicio_corregidoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Ejercicio_corregido) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Ejercicio_corregidoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Ejercicio_corregido $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Ejercicio_corregidoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Ejercicio_corregidoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Ejercicio_corregidoPeer::DATABASE_NAME, Ejercicio_corregidoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Ejercicio_corregidoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Ejercicio_corregidoPeer::DATABASE_NAME);

		$criteria->add(Ejercicio_corregidoPeer::ID, $pk);


		$v = Ejercicio_corregidoPeer::doSelect($criteria, $con);

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
			$criteria->add(Ejercicio_corregidoPeer::ID, $pks, Criteria::IN);
			$objs = Ejercicio_corregidoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEjercicio_corregidoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Ejercicio_corregidoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Ejercicio_corregidoMapBuilder');
}
