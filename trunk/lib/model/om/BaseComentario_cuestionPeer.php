<?php


abstract class BaseComentario_cuestionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'comentario_cuestion';

	
	const CLASS_DEFAULT = 'lib.model.Comentario_cuestion';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'comentario_cuestion.ID';

	
	const ID_EJERCICIO_CORREGIDO = 'comentario_cuestion.ID_EJERCICIO_CORREGIDO';

	
	const ID_RESPUESTA_CUESTION_CORTA = 'comentario_cuestion.ID_RESPUESTA_CUESTION_CORTA';

	
	const COMENTARIO = 'comentario_cuestion.COMENTARIO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdEjercicioCorregido', 'IdRespuestaCuestionCorta', 'Comentario', ),
		BasePeer::TYPE_COLNAME => array (Comentario_cuestionPeer::ID, Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Comentario_cuestionPeer::COMENTARIO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_ejercicio_corregido', 'id_respuesta_cuestion_corta', 'comentario', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdEjercicioCorregido' => 1, 'IdRespuestaCuestionCorta' => 2, 'Comentario' => 3, ),
		BasePeer::TYPE_COLNAME => array (Comentario_cuestionPeer::ID => 0, Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO => 1, Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA => 2, Comentario_cuestionPeer::COMENTARIO => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_ejercicio_corregido' => 1, 'id_respuesta_cuestion_corta' => 2, 'comentario' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Comentario_cuestionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Comentario_cuestionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Comentario_cuestionPeer::getTableMap();
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
		return str_replace(Comentario_cuestionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Comentario_cuestionPeer::ID);

		$criteria->addSelectColumn(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO);

		$criteria->addSelectColumn(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA);

		$criteria->addSelectColumn(Comentario_cuestionPeer::COMENTARIO);

	}

	const COUNT = 'COUNT(comentario_cuestion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT comentario_cuestion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
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
		$objects = Comentario_cuestionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Comentario_cuestionPeer::populateObjects(Comentario_cuestionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Comentario_cuestionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Comentario_cuestionPeer::getOMClass();
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
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRespuesta_cuestion_corta(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
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

		Comentario_cuestionPeer::addSelectColumns($c);
		$startcol = (Comentario_cuestionPeer::NUM_COLUMNS - Comentario_cuestionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Ejercicio_corregidoPeer::addSelectColumns($c);

		$c->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Comentario_cuestionPeer::getOMClass();

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
										$temp_obj2->addComentario_cuestion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initComentario_cuestions();
				$obj2->addComentario_cuestion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRespuesta_cuestion_corta(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Comentario_cuestionPeer::addSelectColumns($c);
		$startcol = (Comentario_cuestionPeer::NUM_COLUMNS - Comentario_cuestionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Respuesta_cuestion_cortaPeer::addSelectColumns($c);

		$c->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Comentario_cuestionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Respuesta_cuestion_cortaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRespuesta_cuestion_corta(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addComentario_cuestion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initComentario_cuestions();
				$obj2->addComentario_cuestion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$criteria->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
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

		Comentario_cuestionPeer::addSelectColumns($c);
		$startcol2 = (Comentario_cuestionPeer::NUM_COLUMNS - Comentario_cuestionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Ejercicio_corregidoPeer::NUM_COLUMNS;

		Respuesta_cuestion_cortaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Respuesta_cuestion_cortaPeer::NUM_COLUMNS;

		$c->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$c->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Comentario_cuestionPeer::getOMClass();


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
					$temp_obj2->addComentario_cuestion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initComentario_cuestions();
				$obj2->addComentario_cuestion($obj1);
			}


					
			$omClass = Respuesta_cuestion_cortaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRespuesta_cuestion_corta(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addComentario_cuestion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initComentario_cuestions();
				$obj3->addComentario_cuestion($obj1);
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
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRespuesta_cuestion_corta(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Comentario_cuestionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);

		$rs = Comentario_cuestionPeer::doSelectRS($criteria, $con);
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

		Comentario_cuestionPeer::addSelectColumns($c);
		$startcol2 = (Comentario_cuestionPeer::NUM_COLUMNS - Comentario_cuestionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Respuesta_cuestion_cortaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Respuesta_cuestion_cortaPeer::NUM_COLUMNS;

		$c->addJoin(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, Respuesta_cuestion_cortaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Comentario_cuestionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Respuesta_cuestion_cortaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRespuesta_cuestion_corta(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addComentario_cuestion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initComentario_cuestions();
				$obj2->addComentario_cuestion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRespuesta_cuestion_corta(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Comentario_cuestionPeer::addSelectColumns($c);
		$startcol2 = (Comentario_cuestionPeer::NUM_COLUMNS - Comentario_cuestionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Ejercicio_corregidoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Ejercicio_corregidoPeer::NUM_COLUMNS;

		$c->addJoin(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, Ejercicio_corregidoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Comentario_cuestionPeer::getOMClass();

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
					$temp_obj2->addComentario_cuestion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initComentario_cuestions();
				$obj2->addComentario_cuestion($obj1);
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
		return Comentario_cuestionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Comentario_cuestionPeer::ID); 

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
			$comparison = $criteria->getComparison(Comentario_cuestionPeer::ID);
			$selectCriteria->add(Comentario_cuestionPeer::ID, $criteria->remove(Comentario_cuestionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Comentario_cuestionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Comentario_cuestionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Comentario_cuestion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Comentario_cuestionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Comentario_cuestion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Comentario_cuestionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Comentario_cuestionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Comentario_cuestionPeer::DATABASE_NAME, Comentario_cuestionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Comentario_cuestionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Comentario_cuestionPeer::DATABASE_NAME);

		$criteria->add(Comentario_cuestionPeer::ID, $pk);


		$v = Comentario_cuestionPeer::doSelect($criteria, $con);

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
			$criteria->add(Comentario_cuestionPeer::ID, $pks, Criteria::IN);
			$objs = Comentario_cuestionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseComentario_cuestionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Comentario_cuestionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Comentario_cuestionMapBuilder');
}
