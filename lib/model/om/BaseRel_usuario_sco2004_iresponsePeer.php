<?php


abstract class BaseRel_usuario_sco2004_iresponsePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_sco2004_iresponse';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_sco2004_iresponse';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'rel_usuario_sco2004_iresponse.ID';

	
	const ID_SCO2004 = 'rel_usuario_sco2004_iresponse.ID_SCO2004';

	
	const ID_USUARIO = 'rel_usuario_sco2004_iresponse.ID_USUARIO';

	
	const INTERACTION_INDEX = 'rel_usuario_sco2004_iresponse.INTERACTION_INDEX';

	
	const RESPONSE_INDEX = 'rel_usuario_sco2004_iresponse.RESPONSE_INDEX';

	
	const PATTERN = 'rel_usuario_sco2004_iresponse.PATTERN';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdSco2004', 'IdUsuario', 'InteractionIndex', 'ResponseIndex', 'Pattern', ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004_iresponsePeer::ID, Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX, Rel_usuario_sco2004_iresponsePeer::RESPONSE_INDEX, Rel_usuario_sco2004_iresponsePeer::PATTERN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_sco2004', 'id_usuario', 'interaction_index', 'response_index', 'pattern', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdSco2004' => 1, 'IdUsuario' => 2, 'InteractionIndex' => 3, 'ResponseIndex' => 4, 'Pattern' => 5, ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004_iresponsePeer::ID => 0, Rel_usuario_sco2004_iresponsePeer::ID_SCO2004 => 1, Rel_usuario_sco2004_iresponsePeer::ID_USUARIO => 2, Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX => 3, Rel_usuario_sco2004_iresponsePeer::RESPONSE_INDEX => 4, Rel_usuario_sco2004_iresponsePeer::PATTERN => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_sco2004' => 1, 'id_usuario' => 2, 'interaction_index' => 3, 'response_index' => 4, 'pattern' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_sco2004_iresponseMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_sco2004_iresponseMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_sco2004_iresponsePeer::getTableMap();
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
		return str_replace(Rel_usuario_sco2004_iresponsePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::ID);

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004);

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX);

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::RESPONSE_INDEX);

		$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::PATTERN);

	}

	const COUNT = 'COUNT(rel_usuario_sco2004_iresponse.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_sco2004_iresponse.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_sco2004_iresponsePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_sco2004_iresponsePeer::populateObjects(Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_sco2004_iresponsePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_sco2004_iresponsePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSco2004(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSco2004(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_usuario_sco2004_iresponsePeer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004_iresponsePeer::NUM_COLUMNS - Rel_usuario_sco2004_iresponsePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Sco2004Peer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_iresponsePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Sco2004Peer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSco2004(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRel_usuario_sco2004_iresponse($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004_iresponses();
				$obj2->addRel_usuario_sco2004_iresponse($obj1); 			}
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

		Rel_usuario_sco2004_iresponsePeer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004_iresponsePeer::NUM_COLUMNS - Rel_usuario_sco2004_iresponsePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_iresponsePeer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco2004_iresponse($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004_iresponses();
				$obj2->addRel_usuario_sco2004_iresponse($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004_iresponsePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_iresponsePeer::NUM_COLUMNS - Rel_usuario_sco2004_iresponsePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_iresponsePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = Sco2004Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSco2004(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRel_usuario_sco2004_iresponse($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_iresponses();
				$obj2->addRel_usuario_sco2004_iresponse($obj1);
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
					$temp_obj3->addRel_usuario_sco2004_iresponse($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_sco2004_iresponses();
				$obj3->addRel_usuario_sco2004_iresponse($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSco2004(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_iresponsePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004_iresponsePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSco2004(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Rel_usuario_sco2004_iresponsePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_iresponsePeer::NUM_COLUMNS - Rel_usuario_sco2004_iresponsePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_iresponsePeer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco2004_iresponse($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_iresponses();
				$obj2->addRel_usuario_sco2004_iresponse($obj1);
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

		Rel_usuario_sco2004_iresponsePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_iresponsePeer::NUM_COLUMNS - Rel_usuario_sco2004_iresponsePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, Sco2004Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_iresponsePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Sco2004Peer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSco2004(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRel_usuario_sco2004_iresponse($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_iresponses();
				$obj2->addRel_usuario_sco2004_iresponse($obj1);
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
		return Rel_usuario_sco2004_iresponsePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Rel_usuario_sco2004_iresponsePeer::ID); 

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
			$comparison = $criteria->getComparison(Rel_usuario_sco2004_iresponsePeer::ID);
			$selectCriteria->add(Rel_usuario_sco2004_iresponsePeer::ID, $criteria->remove(Rel_usuario_sco2004_iresponsePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_sco2004_iresponsePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004_iresponsePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_sco2004_iresponse) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_sco2004_iresponse $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_sco2004_iresponsePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_sco2004_iresponsePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_sco2004_iresponsePeer::DATABASE_NAME, Rel_usuario_sco2004_iresponsePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_sco2004_iresponsePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Rel_usuario_sco2004_iresponsePeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID, $pk);


		$v = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);

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
			$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID, $pks, Criteria::IN);
			$objs = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_sco2004_iresponsePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_sco2004_iresponseMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_sco2004_iresponseMapBuilder');
}
