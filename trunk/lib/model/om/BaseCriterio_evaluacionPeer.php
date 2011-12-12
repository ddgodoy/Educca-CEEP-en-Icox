<?php


abstract class BaseCriterio_evaluacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'criterio_evaluacion';

	
	const CLASS_DEFAULT = 'lib.model.Criterio_evaluacion';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'criterio_evaluacion.ID';

	
	const ID_CURSO = 'criterio_evaluacion.ID_CURSO';

	
	const OBLIGATORIO = 'criterio_evaluacion.OBLIGATORIO';

	
	const PESO = 'criterio_evaluacion.PESO';

	
	const DESCRIPCION = 'criterio_evaluacion.DESCRIPCION';

	
	const ID_TAREA = 'criterio_evaluacion.ID_TAREA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdCurso', 'Obligatorio', 'Peso', 'Descripcion', 'IdTarea', ),
		BasePeer::TYPE_COLNAME => array (Criterio_evaluacionPeer::ID, Criterio_evaluacionPeer::ID_CURSO, Criterio_evaluacionPeer::OBLIGATORIO, Criterio_evaluacionPeer::PESO, Criterio_evaluacionPeer::DESCRIPCION, Criterio_evaluacionPeer::ID_TAREA, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_curso', 'obligatorio', 'peso', 'descripcion', 'id_tarea', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdCurso' => 1, 'Obligatorio' => 2, 'Peso' => 3, 'Descripcion' => 4, 'IdTarea' => 5, ),
		BasePeer::TYPE_COLNAME => array (Criterio_evaluacionPeer::ID => 0, Criterio_evaluacionPeer::ID_CURSO => 1, Criterio_evaluacionPeer::OBLIGATORIO => 2, Criterio_evaluacionPeer::PESO => 3, Criterio_evaluacionPeer::DESCRIPCION => 4, Criterio_evaluacionPeer::ID_TAREA => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_curso' => 1, 'obligatorio' => 2, 'peso' => 3, 'descripcion' => 4, 'id_tarea' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Criterio_evaluacionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Criterio_evaluacionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Criterio_evaluacionPeer::getTableMap();
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
		return str_replace(Criterio_evaluacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Criterio_evaluacionPeer::ID);

		$criteria->addSelectColumn(Criterio_evaluacionPeer::ID_CURSO);

		$criteria->addSelectColumn(Criterio_evaluacionPeer::OBLIGATORIO);

		$criteria->addSelectColumn(Criterio_evaluacionPeer::PESO);

		$criteria->addSelectColumn(Criterio_evaluacionPeer::DESCRIPCION);

		$criteria->addSelectColumn(Criterio_evaluacionPeer::ID_TAREA);

	}

	const COUNT = 'COUNT(criterio_evaluacion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT criterio_evaluacion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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
		$objects = Criterio_evaluacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Criterio_evaluacionPeer::populateObjects(Criterio_evaluacionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Criterio_evaluacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Criterio_evaluacionPeer::getOMClass();
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
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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

		Criterio_evaluacionPeer::addSelectColumns($c);
		$startcol = (Criterio_evaluacionPeer::NUM_COLUMNS - Criterio_evaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Criterio_evaluacionPeer::getOMClass();

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
										$temp_obj2->addCriterio_evaluacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCriterio_evaluacions();
				$obj2->addCriterio_evaluacion($obj1); 			}
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

		Criterio_evaluacionPeer::addSelectColumns($c);
		$startcol = (Criterio_evaluacionPeer::NUM_COLUMNS - Criterio_evaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TareaPeer::addSelectColumns($c);

		$c->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Criterio_evaluacionPeer::getOMClass();

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
										$temp_obj2->addCriterio_evaluacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCriterio_evaluacions();
				$obj2->addCriterio_evaluacion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);

		$criteria->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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

		Criterio_evaluacionPeer::addSelectColumns($c);
		$startcol2 = (Criterio_evaluacionPeer::NUM_COLUMNS - Criterio_evaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TareaPeer::NUM_COLUMNS;

		$c->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);

		$c->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Criterio_evaluacionPeer::getOMClass();


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
					$temp_obj2->addCriterio_evaluacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCriterio_evaluacions();
				$obj2->addCriterio_evaluacion($obj1);
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
					$temp_obj3->addCriterio_evaluacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCriterio_evaluacions();
				$obj3->addCriterio_evaluacion($obj1);
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
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Criterio_evaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);

		$rs = Criterio_evaluacionPeer::doSelectRS($criteria, $con);
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

		Criterio_evaluacionPeer::addSelectColumns($c);
		$startcol2 = (Criterio_evaluacionPeer::NUM_COLUMNS - Criterio_evaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TareaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TareaPeer::NUM_COLUMNS;

		$c->addJoin(Criterio_evaluacionPeer::ID_TAREA, TareaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Criterio_evaluacionPeer::getOMClass();

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
					$temp_obj2->addCriterio_evaluacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCriterio_evaluacions();
				$obj2->addCriterio_evaluacion($obj1);
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

		Criterio_evaluacionPeer::addSelectColumns($c);
		$startcol2 = (Criterio_evaluacionPeer::NUM_COLUMNS - Criterio_evaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Criterio_evaluacionPeer::ID_CURSO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Criterio_evaluacionPeer::getOMClass();

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
					$temp_obj2->addCriterio_evaluacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCriterio_evaluacions();
				$obj2->addCriterio_evaluacion($obj1);
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
		return Criterio_evaluacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Criterio_evaluacionPeer::ID); 

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
			$comparison = $criteria->getComparison(Criterio_evaluacionPeer::ID);
			$selectCriteria->add(Criterio_evaluacionPeer::ID, $criteria->remove(Criterio_evaluacionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Criterio_evaluacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Criterio_evaluacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Criterio_evaluacion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Criterio_evaluacionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Criterio_evaluacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Criterio_evaluacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Criterio_evaluacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Criterio_evaluacionPeer::DATABASE_NAME, Criterio_evaluacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Criterio_evaluacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Criterio_evaluacionPeer::DATABASE_NAME);

		$criteria->add(Criterio_evaluacionPeer::ID, $pk);


		$v = Criterio_evaluacionPeer::doSelect($criteria, $con);

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
			$criteria->add(Criterio_evaluacionPeer::ID, $pks, Criteria::IN);
			$objs = Criterio_evaluacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCriterio_evaluacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Criterio_evaluacionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Criterio_evaluacionMapBuilder');
}
