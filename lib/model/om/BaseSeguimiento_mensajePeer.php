<?php


abstract class BaseSeguimiento_mensajePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'seguimiento_mensaje';

	
	const CLASS_DEFAULT = 'lib.model.Seguimiento_mensaje';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_PROFESOR = 'seguimiento_mensaje.ID_PROFESOR';

	
	const ID_PREGUNTA = 'seguimiento_mensaje.ID_PREGUNTA';

	
	const FECHA_RESPUESTA = 'seguimiento_mensaje.FECHA_RESPUESTA';

	
	const CREATED_AT = 'seguimiento_mensaje.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdProfesor', 'IdPregunta', 'FechaRespuesta', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (Seguimiento_mensajePeer::ID_PROFESOR, Seguimiento_mensajePeer::ID_PREGUNTA, Seguimiento_mensajePeer::FECHA_RESPUESTA, Seguimiento_mensajePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id_profesor', 'id_pregunta', 'fecha_respuesta', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdProfesor' => 0, 'IdPregunta' => 1, 'FechaRespuesta' => 2, 'CreatedAt' => 3, ),
		BasePeer::TYPE_COLNAME => array (Seguimiento_mensajePeer::ID_PROFESOR => 0, Seguimiento_mensajePeer::ID_PREGUNTA => 1, Seguimiento_mensajePeer::FECHA_RESPUESTA => 2, Seguimiento_mensajePeer::CREATED_AT => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id_profesor' => 0, 'id_pregunta' => 1, 'fecha_respuesta' => 2, 'created_at' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Seguimiento_mensajeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Seguimiento_mensajeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Seguimiento_mensajePeer::getTableMap();
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
		return str_replace(Seguimiento_mensajePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Seguimiento_mensajePeer::ID_PROFESOR);

		$criteria->addSelectColumn(Seguimiento_mensajePeer::ID_PREGUNTA);

		$criteria->addSelectColumn(Seguimiento_mensajePeer::FECHA_RESPUESTA);

		$criteria->addSelectColumn(Seguimiento_mensajePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(seguimiento_mensaje.ID_PREGUNTA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT seguimiento_mensaje.ID_PREGUNTA)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Seguimiento_mensajePeer::doSelectRS($criteria, $con);
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
		$objects = Seguimiento_mensajePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Seguimiento_mensajePeer::populateObjects(Seguimiento_mensajePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Seguimiento_mensajePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Seguimiento_mensajePeer::getOMClass();
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
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Seguimiento_mensajePeer::ID_PROFESOR, UsuarioPeer::ID);

		$rs = Seguimiento_mensajePeer::doSelectRS($criteria, $con);
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

		Seguimiento_mensajePeer::addSelectColumns($c);
		$startcol = (Seguimiento_mensajePeer::NUM_COLUMNS - Seguimiento_mensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Seguimiento_mensajePeer::ID_PROFESOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Seguimiento_mensajePeer::getOMClass();

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
										$temp_obj2->addSeguimiento_mensaje($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSeguimiento_mensajes();
				$obj2->addSeguimiento_mensaje($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Seguimiento_mensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Seguimiento_mensajePeer::ID_PROFESOR, UsuarioPeer::ID);

		$rs = Seguimiento_mensajePeer::doSelectRS($criteria, $con);
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

		Seguimiento_mensajePeer::addSelectColumns($c);
		$startcol2 = (Seguimiento_mensajePeer::NUM_COLUMNS - Seguimiento_mensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Seguimiento_mensajePeer::ID_PROFESOR, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Seguimiento_mensajePeer::getOMClass();


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
					$temp_obj2->addSeguimiento_mensaje($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSeguimiento_mensajes();
				$obj2->addSeguimiento_mensaje($obj1);
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
		return Seguimiento_mensajePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Seguimiento_mensajePeer::ID_PREGUNTA);
			$selectCriteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, $criteria->remove(Seguimiento_mensajePeer::ID_PREGUNTA), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Seguimiento_mensajePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Seguimiento_mensajePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Seguimiento_mensaje) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Seguimiento_mensaje $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Seguimiento_mensajePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Seguimiento_mensajePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Seguimiento_mensajePeer::DATABASE_NAME, Seguimiento_mensajePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Seguimiento_mensajePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Seguimiento_mensajePeer::DATABASE_NAME);

		$criteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, $pk);


		$v = Seguimiento_mensajePeer::doSelect($criteria, $con);

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
			$criteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, $pks, Criteria::IN);
			$objs = Seguimiento_mensajePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSeguimiento_mensajePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Seguimiento_mensajeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Seguimiento_mensajeMapBuilder');
}
