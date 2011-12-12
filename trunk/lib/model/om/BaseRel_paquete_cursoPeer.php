<?php


abstract class BaseRel_paquete_cursoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_paquete_curso';

	
	const CLASS_DEFAULT = 'lib.model.Rel_paquete_curso';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_PAQUETE = 'rel_paquete_curso.ID_PAQUETE';

	
	const ID_CURSO = 'rel_paquete_curso.ID_CURSO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete', 'IdCurso', ),
		BasePeer::TYPE_COLNAME => array (Rel_paquete_cursoPeer::ID_PAQUETE, Rel_paquete_cursoPeer::ID_CURSO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete', 'id_curso', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdPaquete' => 0, 'IdCurso' => 1, ),
		BasePeer::TYPE_COLNAME => array (Rel_paquete_cursoPeer::ID_PAQUETE => 0, Rel_paquete_cursoPeer::ID_CURSO => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('id_paquete' => 0, 'id_curso' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_paquete_cursoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_paquete_cursoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_paquete_cursoPeer::getTableMap();
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
		return str_replace(Rel_paquete_cursoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_paquete_cursoPeer::ID_PAQUETE);

		$criteria->addSelectColumn(Rel_paquete_cursoPeer::ID_CURSO);

	}

	const COUNT = 'COUNT(rel_paquete_curso.ID_PAQUETE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_paquete_curso.ID_PAQUETE)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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
		$objects = Rel_paquete_cursoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_paquete_cursoPeer::populateObjects(Rel_paquete_cursoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_paquete_cursoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_paquete_cursoPeer::getOMClass();
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
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_paquete_cursoPeer::addSelectColumns($c);
		$startcol = (Rel_paquete_cursoPeer::NUM_COLUMNS - Rel_paquete_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PaquetePeer::addSelectColumns($c);

		$c->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_paquete_cursoPeer::getOMClass();

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
										$temp_obj2->addRel_paquete_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_paquete_cursos();
				$obj2->addRel_paquete_curso($obj1); 			}
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

		Rel_paquete_cursoPeer::addSelectColumns($c);
		$startcol = (Rel_paquete_cursoPeer::NUM_COLUMNS - Rel_paquete_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_paquete_cursoPeer::getOMClass();

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
										$temp_obj2->addRel_paquete_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_paquete_cursos();
				$obj2->addRel_paquete_curso($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_paquete_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_paquete_cursoPeer::NUM_COLUMNS - Rel_paquete_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);

		$c->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_paquete_cursoPeer::getOMClass();


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
					$temp_obj2->addRel_paquete_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_paquete_cursos();
				$obj2->addRel_paquete_curso($obj1);
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
					$temp_obj3->addRel_paquete_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_paquete_cursos();
				$obj3->addRel_paquete_curso($obj1);
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
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_paquete_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);

		$rs = Rel_paquete_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_paquete_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_paquete_cursoPeer::NUM_COLUMNS - Rel_paquete_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_paquete_cursoPeer::getOMClass();

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
					$temp_obj2->addRel_paquete_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_paquete_cursos();
				$obj2->addRel_paquete_curso($obj1);
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

		Rel_paquete_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_paquete_cursoPeer::NUM_COLUMNS - Rel_paquete_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaquetePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaquetePeer::NUM_COLUMNS;

		$c->addJoin(Rel_paquete_cursoPeer::ID_PAQUETE, PaquetePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_paquete_cursoPeer::getOMClass();

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
					$temp_obj2->addRel_paquete_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_paquete_cursos();
				$obj2->addRel_paquete_curso($obj1);
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
		return Rel_paquete_cursoPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Rel_paquete_cursoPeer::ID_PAQUETE);
			$selectCriteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $criteria->remove(Rel_paquete_cursoPeer::ID_PAQUETE), $comparison);

			$comparison = $criteria->getComparison(Rel_paquete_cursoPeer::ID_CURSO);
			$selectCriteria->add(Rel_paquete_cursoPeer::ID_CURSO, $criteria->remove(Rel_paquete_cursoPeer::ID_CURSO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_paquete_cursoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_paquete_cursoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_paquete_curso) {

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

			$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $vals[0], Criteria::IN);
			$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Rel_paquete_curso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_paquete_cursoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_paquete_cursoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_paquete_cursoPeer::DATABASE_NAME, Rel_paquete_cursoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_paquete_cursoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_paquete, $id_curso, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $id_paquete);
		$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $id_curso);
		$v = Rel_paquete_cursoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRel_paquete_cursoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_paquete_cursoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_paquete_cursoMapBuilder');
}
