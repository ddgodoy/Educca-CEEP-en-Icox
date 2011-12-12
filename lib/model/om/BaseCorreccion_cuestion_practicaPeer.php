<?php


abstract class BaseCorreccion_cuestion_practicaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'correccion_cuestion_practica';

	
	const CLASS_DEFAULT = 'lib.model.Correccion_cuestion_practica';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'correccion_cuestion_practica.ID';

	
	const ID_EJERCICIO_CORREGIDO = 'correccion_cuestion_practica.ID_EJERCICIO_CORREGIDO';

	
	const ID_RESPUESTA_CUESTION_PRACTICA = 'correccion_cuestion_practica.ID_RESPUESTA_CUESTION_PRACTICA';

	
	const COMENTARIO = 'correccion_cuestion_practica.COMENTARIO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdEjercicioCorregido', 'IdRespuestaCuestionPractica', 'Comentario', ),
		BasePeer::TYPE_COLNAME => array (Correccion_cuestion_practicaPeer::ID, Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Correccion_cuestion_practicaPeer::COMENTARIO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_ejercicio_corregido', 'id_respuesta_cuestion_practica', 'comentario', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdEjercicioCorregido' => 1, 'IdRespuestaCuestionPractica' => 2, 'Comentario' => 3, ),
		BasePeer::TYPE_COLNAME => array (Correccion_cuestion_practicaPeer::ID => 0, Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO => 1, Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA => 2, Correccion_cuestion_practicaPeer::COMENTARIO => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_ejercicio_corregido' => 1, 'id_respuesta_cuestion_practica' => 2, 'comentario' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Correccion_cuestion_practicaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Correccion_cuestion_practicaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Correccion_cuestion_practicaPeer::getTableMap();
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
		return str_replace(Correccion_cuestion_practicaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::ID);

		$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO);

		$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA);

		$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COMENTARIO);

	}

	const COUNT = 'COUNT(correccion_cuestion_practica.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT correccion_cuestion_practica.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
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
		$objects = Correccion_cuestion_practicaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Correccion_cuestion_practicaPeer::populateObjects(Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Correccion_cuestion_practicaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Correccion_cuestion_practicaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEjercicio_corregido(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRespuesta_cuestion_practica(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEjercicio_corregido(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Correccion_cuestion_practicaPeer::addSelectColumns($c);
		$startcol = (Correccion_cuestion_practicaPeer::NUM_COLUMNS - Correccion_cuestion_practicaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Ejercicio_corregidoPeer::addSelectColumns($c);

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Correccion_cuestion_practicaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Ejercicio_corregidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEjercicio_corregido(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCorreccion_cuestion_practica($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCorreccion_cuestion_practicas();
				$obj2->addCorreccion_cuestion_practica($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRespuesta_cuestion_practica(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Correccion_cuestion_practicaPeer::addSelectColumns($c);
		$startcol = (Correccion_cuestion_practicaPeer::NUM_COLUMNS - Correccion_cuestion_practicaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Respuesta_cuestion_practicaPeer::addSelectColumns($c);

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Correccion_cuestion_practicaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Respuesta_cuestion_practicaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRespuesta_cuestion_practica(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCorreccion_cuestion_practica($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCorreccion_cuestion_practicas();
				$obj2->addCorreccion_cuestion_practica($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
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

		Correccion_cuestion_practicaPeer::addSelectColumns($c);
		$startcol2 = (Correccion_cuestion_practicaPeer::NUM_COLUMNS - Correccion_cuestion_practicaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Ejercicio_corregidoPeer::NUM_COLUMNS;

		Respuesta_cuestion_practicaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Respuesta_cuestion_practicaPeer::NUM_COLUMNS;

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Correccion_cuestion_practicaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = Ejercicio_corregidoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEjercicio_corregido(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCorreccion_cuestion_practica($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCorreccion_cuestion_practicas();
				$obj2->addCorreccion_cuestion_practica($obj1);
			}


					
			$omClass = Respuesta_cuestion_practicaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRespuesta_cuestion_practica(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCorreccion_cuestion_practica($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCorreccion_cuestion_practicas();
				$obj3->addCorreccion_cuestion_practica($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEjercicio_corregido(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRespuesta_cuestion_practica(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Correccion_cuestion_practicaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$rs = Correccion_cuestion_practicaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEjercicio_corregido(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Correccion_cuestion_practicaPeer::addSelectColumns($c);
		$startcol2 = (Correccion_cuestion_practicaPeer::NUM_COLUMNS - Correccion_cuestion_practicaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Respuesta_cuestion_practicaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Respuesta_cuestion_practicaPeer::NUM_COLUMNS;

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, Respuesta_cuestion_practicaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Correccion_cuestion_practicaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Respuesta_cuestion_practicaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRespuesta_cuestion_practica(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCorreccion_cuestion_practica($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCorreccion_cuestion_practicas();
				$obj2->addCorreccion_cuestion_practica($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRespuesta_cuestion_practica(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Correccion_cuestion_practicaPeer::addSelectColumns($c);
		$startcol2 = (Correccion_cuestion_practicaPeer::NUM_COLUMNS - Correccion_cuestion_practicaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Ejercicio_corregidoPeer::NUM_COLUMNS;

		$c->addJoin(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Correccion_cuestion_practicaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Ejercicio_corregidoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEjercicio_corregido(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCorreccion_cuestion_practica($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCorreccion_cuestion_practicas();
				$obj2->addCorreccion_cuestion_practica($obj1);
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
		return Correccion_cuestion_practicaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Correccion_cuestion_practicaPeer::ID); 

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
			$comparison = $criteria->getComparison(Correccion_cuestion_practicaPeer::ID);
			$selectCriteria->add(Correccion_cuestion_practicaPeer::ID, $criteria->remove(Correccion_cuestion_practicaPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Correccion_cuestion_practicaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Correccion_cuestion_practicaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Correccion_cuestion_practica) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Correccion_cuestion_practicaPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Correccion_cuestion_practica $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Correccion_cuestion_practicaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Correccion_cuestion_practicaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Correccion_cuestion_practicaPeer::DATABASE_NAME, Correccion_cuestion_practicaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Correccion_cuestion_practicaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Correccion_cuestion_practicaPeer::DATABASE_NAME);

		$criteria->add(Correccion_cuestion_practicaPeer::ID, $pk);


		$v = Correccion_cuestion_practicaPeer::doSelect($criteria, $con);

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
			$criteria->add(Correccion_cuestion_practicaPeer::ID, $pks, Criteria::IN);
			$objs = Correccion_cuestion_practicaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCorreccion_cuestion_practicaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Correccion_cuestion_practicaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Correccion_cuestion_practicaMapBuilder');
}
