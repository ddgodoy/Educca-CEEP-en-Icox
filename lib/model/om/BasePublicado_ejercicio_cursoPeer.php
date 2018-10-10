<?php


abstract class BasePublicado_ejercicio_cursoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'publicado_ejercicio_curso';

	
	const CLASS_DEFAULT = 'lib.model.Publicado_ejercicio_curso';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'publicado_ejercicio_curso.ID';

	
	const ID_EJERCICIO = 'publicado_ejercicio_curso.ID_EJERCICIO';

	
	const ID_CURSO = 'publicado_ejercicio_curso.ID_CURSO';

	
	const SOLUCION = 'publicado_ejercicio_curso.SOLUCION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdEjercicio', 'IdCurso', 'Solucion', ),
		BasePeer::TYPE_COLNAME => array (Publicado_ejercicio_cursoPeer::ID, Publicado_ejercicio_cursoPeer::ID_EJERCICIO, Publicado_ejercicio_cursoPeer::ID_CURSO, Publicado_ejercicio_cursoPeer::SOLUCION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_ejercicio', 'id_curso', 'solucion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdEjercicio' => 1, 'IdCurso' => 2, 'Solucion' => 3, ),
		BasePeer::TYPE_COLNAME => array (Publicado_ejercicio_cursoPeer::ID => 0, Publicado_ejercicio_cursoPeer::ID_EJERCICIO => 1, Publicado_ejercicio_cursoPeer::ID_CURSO => 2, Publicado_ejercicio_cursoPeer::SOLUCION => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_ejercicio' => 1, 'id_curso' => 2, 'solucion' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Publicado_ejercicio_cursoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Publicado_ejercicio_cursoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Publicado_ejercicio_cursoPeer::getTableMap();
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
		return str_replace(Publicado_ejercicio_cursoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::ID);

		$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::ID_EJERCICIO);

		$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::ID_CURSO);

		$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::SOLUCION);

	}

	const COUNT = 'COUNT(publicado_ejercicio_curso.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT publicado_ejercicio_curso.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
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
		$objects = Publicado_ejercicio_cursoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Publicado_ejercicio_cursoPeer::populateObjects(Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Publicado_ejercicio_cursoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Publicado_ejercicio_cursoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCurso(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Publicado_ejercicio_cursoPeer::addSelectColumns($c);
		$startcol = (Publicado_ejercicio_cursoPeer::NUM_COLUMNS - Publicado_ejercicio_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EjercicioPeer::addSelectColumns($c);

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Publicado_ejercicio_cursoPeer::getOMClass();

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
										$temp_obj2->addPublicado_ejercicio_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPublicado_ejercicio_cursos();
				$obj2->addPublicado_ejercicio_curso($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCurso(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Publicado_ejercicio_cursoPeer::addSelectColumns($c);
		$startcol = (Publicado_ejercicio_cursoPeer::NUM_COLUMNS - Publicado_ejercicio_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Publicado_ejercicio_cursoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CursoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCurso(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPublicado_ejercicio_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPublicado_ejercicio_cursos();
				$obj2->addPublicado_ejercicio_curso($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
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

		Publicado_ejercicio_cursoPeer::addSelectColumns($c);
		$startcol2 = (Publicado_ejercicio_cursoPeer::NUM_COLUMNS - Publicado_ejercicio_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EjercicioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EjercicioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Publicado_ejercicio_cursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EjercicioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEjercicio(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPublicado_ejercicio_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPublicado_ejercicio_cursos();
				$obj2->addPublicado_ejercicio_curso($obj1);
			}


					
			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCurso(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPublicado_ejercicio_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPublicado_ejercicio_cursos();
				$obj3->addPublicado_ejercicio_curso($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCurso(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Publicado_ejercicio_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Publicado_ejercicio_cursoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Publicado_ejercicio_cursoPeer::addSelectColumns($c);
		$startcol2 = (Publicado_ejercicio_cursoPeer::NUM_COLUMNS - Publicado_ejercicio_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Publicado_ejercicio_cursoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCurso(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPublicado_ejercicio_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPublicado_ejercicio_cursos();
				$obj2->addPublicado_ejercicio_curso($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCurso(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Publicado_ejercicio_cursoPeer::addSelectColumns($c);
		$startcol2 = (Publicado_ejercicio_cursoPeer::NUM_COLUMNS - Publicado_ejercicio_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EjercicioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EjercicioPeer::NUM_COLUMNS;

		$c->addJoin(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, EjercicioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Publicado_ejercicio_cursoPeer::getOMClass();

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
					$temp_obj2->addPublicado_ejercicio_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPublicado_ejercicio_cursos();
				$obj2->addPublicado_ejercicio_curso($obj1);
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
		return Publicado_ejercicio_cursoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Publicado_ejercicio_cursoPeer::ID); 

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
			$comparison = $criteria->getComparison(Publicado_ejercicio_cursoPeer::ID);
			$selectCriteria->add(Publicado_ejercicio_cursoPeer::ID, $criteria->remove(Publicado_ejercicio_cursoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Publicado_ejercicio_cursoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Publicado_ejercicio_cursoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Publicado_ejercicio_curso) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Publicado_ejercicio_cursoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Publicado_ejercicio_curso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Publicado_ejercicio_cursoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Publicado_ejercicio_cursoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Publicado_ejercicio_cursoPeer::DATABASE_NAME, Publicado_ejercicio_cursoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Publicado_ejercicio_cursoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Publicado_ejercicio_cursoPeer::DATABASE_NAME);

		$criteria->add(Publicado_ejercicio_cursoPeer::ID, $pk);


		$v = Publicado_ejercicio_cursoPeer::doSelect($criteria, $con);

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
			$criteria->add(Publicado_ejercicio_cursoPeer::ID, $pks, Criteria::IN);
			$objs = Publicado_ejercicio_cursoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePublicado_ejercicio_cursoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Publicado_ejercicio_cursoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Publicado_ejercicio_cursoMapBuilder');
}
