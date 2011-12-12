<?php


abstract class BaseRel_interaccion_sco12_objetivoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_interaccion_sco12_objetivo';

	
	const CLASS_DEFAULT = 'lib.model.Rel_interaccion_sco12_objetivo';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'rel_interaccion_sco12_objetivo.ID';

	
	const INDEX_OBJETIVO = 'rel_interaccion_sco12_objetivo.INDEX_OBJETIVO';

	
	const INDEX_INTERACCION = 'rel_interaccion_sco12_objetivo.INDEX_INTERACCION';

	
	const ID_SCO12 = 'rel_interaccion_sco12_objetivo.ID_SCO12';

	
	const ID_USUARIO = 'rel_interaccion_sco12_objetivo.ID_USUARIO';

	
	const REF_OBJETIVO = 'rel_interaccion_sco12_objetivo.REF_OBJETIVO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IndexObjetivo', 'IndexInteraccion', 'IdSco12', 'IdUsuario', 'RefObjetivo', ),
		BasePeer::TYPE_COLNAME => array (Rel_interaccion_sco12_objetivoPeer::ID, Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO, Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION, Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'index_objetivo', 'index_interaccion', 'id_sco12', 'id_usuario', 'ref_objetivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IndexObjetivo' => 1, 'IndexInteraccion' => 2, 'IdSco12' => 3, 'IdUsuario' => 4, 'RefObjetivo' => 5, ),
		BasePeer::TYPE_COLNAME => array (Rel_interaccion_sco12_objetivoPeer::ID => 0, Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO => 1, Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION => 2, Rel_interaccion_sco12_objetivoPeer::ID_SCO12 => 3, Rel_interaccion_sco12_objetivoPeer::ID_USUARIO => 4, Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'index_objetivo' => 1, 'index_interaccion' => 2, 'id_sco12' => 3, 'id_usuario' => 4, 'ref_objetivo' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_interaccion_sco12_objetivoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_interaccion_sco12_objetivoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_interaccion_sco12_objetivoPeer::getTableMap();
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
		return str_replace(Rel_interaccion_sco12_objetivoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::ID);

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO);

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION);

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::ID_SCO12);

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO);

	}

	const COUNT = 'COUNT(rel_interaccion_sco12_objetivo.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_interaccion_sco12_objetivo.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
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
		$objects = Rel_interaccion_sco12_objetivoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_interaccion_sco12_objetivoPeer::populateObjects(Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_interaccion_sco12_objetivoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_interaccion_sco12_objetivoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSco12(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSco12(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_interaccion_sco12_objetivoPeer::addSelectColumns($c);
		$startcol = (Rel_interaccion_sco12_objetivoPeer::NUM_COLUMNS - Rel_interaccion_sco12_objetivoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Sco12Peer::addSelectColumns($c);

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_interaccion_sco12_objetivoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Sco12Peer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSco12(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRel_interaccion_sco12_objetivo($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_interaccion_sco12_objetivos();
				$obj2->addRel_interaccion_sco12_objetivo($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_interaccion_sco12_objetivoPeer::addSelectColumns($c);
		$startcol = (Rel_interaccion_sco12_objetivoPeer::NUM_COLUMNS - Rel_interaccion_sco12_objetivoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_interaccion_sco12_objetivoPeer::getOMClass();

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
										$temp_obj2->addRel_interaccion_sco12_objetivo($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_interaccion_sco12_objetivos();
				$obj2->addRel_interaccion_sco12_objetivo($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
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

		Rel_interaccion_sco12_objetivoPeer::addSelectColumns($c);
		$startcol2 = (Rel_interaccion_sco12_objetivoPeer::NUM_COLUMNS - Rel_interaccion_sco12_objetivoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco12Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco12Peer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_interaccion_sco12_objetivoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = Sco12Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSco12(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRel_interaccion_sco12_objetivo($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_interaccion_sco12_objetivos();
				$obj2->addRel_interaccion_sco12_objetivo($obj1);
			}


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuario(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRel_interaccion_sco12_objetivo($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_interaccion_sco12_objetivos();
				$obj3->addRel_interaccion_sco12_objetivo($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSco12(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_interaccion_sco12_objetivoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);

		$rs = Rel_interaccion_sco12_objetivoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSco12(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_interaccion_sco12_objetivoPeer::addSelectColumns($c);
		$startcol2 = (Rel_interaccion_sco12_objetivoPeer::NUM_COLUMNS - Rel_interaccion_sco12_objetivoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_interaccion_sco12_objetivoPeer::getOMClass();

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
					$temp_obj2->addRel_interaccion_sco12_objetivo($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_interaccion_sco12_objetivos();
				$obj2->addRel_interaccion_sco12_objetivo($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_interaccion_sco12_objetivoPeer::addSelectColumns($c);
		$startcol2 = (Rel_interaccion_sco12_objetivoPeer::NUM_COLUMNS - Rel_interaccion_sco12_objetivoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco12Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco12Peer::NUM_COLUMNS;

		$c->addJoin(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, Sco12Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_interaccion_sco12_objetivoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Sco12Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSco12(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRel_interaccion_sco12_objetivo($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_interaccion_sco12_objetivos();
				$obj2->addRel_interaccion_sco12_objetivo($obj1);
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
		return Rel_interaccion_sco12_objetivoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Rel_interaccion_sco12_objetivoPeer::ID); 

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
			$comparison = $criteria->getComparison(Rel_interaccion_sco12_objetivoPeer::ID);
			$selectCriteria->add(Rel_interaccion_sco12_objetivoPeer::ID, $criteria->remove(Rel_interaccion_sco12_objetivoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_interaccion_sco12_objetivoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_interaccion_sco12_objetivo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Rel_interaccion_sco12_objetivo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_interaccion_sco12_objetivoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME, Rel_interaccion_sco12_objetivoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_interaccion_sco12_objetivoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);

		$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID, $pk);


		$v = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);

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
			$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID, $pks, Criteria::IN);
			$objs = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRel_interaccion_sco12_objetivoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_interaccion_sco12_objetivoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_interaccion_sco12_objetivoMapBuilder');
}
