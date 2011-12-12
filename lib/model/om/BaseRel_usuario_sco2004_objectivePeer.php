<?php


abstract class BaseRel_usuario_sco2004_objectivePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_sco2004_objective';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_sco2004_objective';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'rel_usuario_sco2004_objective.ID';

	
	const ID_SCO2004 = 'rel_usuario_sco2004_objective.ID_SCO2004';

	
	const ID_USUARIO = 'rel_usuario_sco2004_objective.ID_USUARIO';

	
	const OBJECTIVE_INDEX = 'rel_usuario_sco2004_objective.OBJECTIVE_INDEX';

	
	const OBJECTIVE_ID = 'rel_usuario_sco2004_objective.OBJECTIVE_ID';

	
	const SCORE_SCALED = 'rel_usuario_sco2004_objective.SCORE_SCALED';

	
	const SCORE_RAW = 'rel_usuario_sco2004_objective.SCORE_RAW';

	
	const SCORE_MIN = 'rel_usuario_sco2004_objective.SCORE_MIN';

	
	const SCORE_MAX = 'rel_usuario_sco2004_objective.SCORE_MAX';

	
	const SUCCESS_STATUS = 'rel_usuario_sco2004_objective.SUCCESS_STATUS';

	
	const COMPLETION_STATUS = 'rel_usuario_sco2004_objective.COMPLETION_STATUS';

	
	const PROGRESS_MEASURE = 'rel_usuario_sco2004_objective.PROGRESS_MEASURE';

	
	const DESCRIPTION = 'rel_usuario_sco2004_objective.DESCRIPTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdSco2004', 'IdUsuario', 'ObjectiveIndex', 'ObjectiveId', 'ScoreScaled', 'ScoreRaw', 'ScoreMin', 'ScoreMax', 'SuccessStatus', 'CompletionStatus', 'ProgressMeasure', 'Description', ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004_objectivePeer::ID, Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Rel_usuario_sco2004_objectivePeer::ID_USUARIO, Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID, Rel_usuario_sco2004_objectivePeer::SCORE_SCALED, Rel_usuario_sco2004_objectivePeer::SCORE_RAW, Rel_usuario_sco2004_objectivePeer::SCORE_MIN, Rel_usuario_sco2004_objectivePeer::SCORE_MAX, Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS, Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS, Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE, Rel_usuario_sco2004_objectivePeer::DESCRIPTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_sco2004', 'id_usuario', 'objective_index', 'objective_id', 'score_scaled', 'score_raw', 'score_min', 'score_max', 'success_status', 'completion_status', 'progress_measure', 'description', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdSco2004' => 1, 'IdUsuario' => 2, 'ObjectiveIndex' => 3, 'ObjectiveId' => 4, 'ScoreScaled' => 5, 'ScoreRaw' => 6, 'ScoreMin' => 7, 'ScoreMax' => 8, 'SuccessStatus' => 9, 'CompletionStatus' => 10, 'ProgressMeasure' => 11, 'Description' => 12, ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004_objectivePeer::ID => 0, Rel_usuario_sco2004_objectivePeer::ID_SCO2004 => 1, Rel_usuario_sco2004_objectivePeer::ID_USUARIO => 2, Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX => 3, Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID => 4, Rel_usuario_sco2004_objectivePeer::SCORE_SCALED => 5, Rel_usuario_sco2004_objectivePeer::SCORE_RAW => 6, Rel_usuario_sco2004_objectivePeer::SCORE_MIN => 7, Rel_usuario_sco2004_objectivePeer::SCORE_MAX => 8, Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS => 9, Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS => 10, Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE => 11, Rel_usuario_sco2004_objectivePeer::DESCRIPTION => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_sco2004' => 1, 'id_usuario' => 2, 'objective_index' => 3, 'objective_id' => 4, 'score_scaled' => 5, 'score_raw' => 6, 'score_min' => 7, 'score_max' => 8, 'success_status' => 9, 'completion_status' => 10, 'progress_measure' => 11, 'description' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_sco2004_objectiveMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_sco2004_objectiveMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_sco2004_objectivePeer::getTableMap();
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
		return str_replace(Rel_usuario_sco2004_objectivePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::ID);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::ID_SCO2004);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::SCORE_SCALED);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::SCORE_RAW);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::SCORE_MIN);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::SCORE_MAX);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE);

		$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::DESCRIPTION);

	}

	const COUNT = 'COUNT(rel_usuario_sco2004_objective.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_sco2004_objective.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_sco2004_objectivePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_sco2004_objectivePeer::populateObjects(Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_sco2004_objectivePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_sco2004_objectivePeer::getOMClass();
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004_objectivePeer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004_objectivePeer::NUM_COLUMNS - Rel_usuario_sco2004_objectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Sco2004Peer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_objectivePeer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco2004_objective($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004_objectives();
				$obj2->addRel_usuario_sco2004_objective($obj1); 			}
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

		Rel_usuario_sco2004_objectivePeer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004_objectivePeer::NUM_COLUMNS - Rel_usuario_sco2004_objectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_objectivePeer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco2004_objective($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004_objectives();
				$obj2->addRel_usuario_sco2004_objective($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004_objectivePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_objectivePeer::NUM_COLUMNS - Rel_usuario_sco2004_objectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_objectivePeer::getOMClass();


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
					$temp_obj2->addRel_usuario_sco2004_objective($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_objectives();
				$obj2->addRel_usuario_sco2004_objective($obj1);
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
					$temp_obj3->addRel_usuario_sco2004_objective($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_sco2004_objectives();
				$obj3->addRel_usuario_sco2004_objective($obj1);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004_objectivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004_objectivePeer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004_objectivePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_objectivePeer::NUM_COLUMNS - Rel_usuario_sco2004_objectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_objectivePeer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco2004_objective($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_objectives();
				$obj2->addRel_usuario_sco2004_objective($obj1);
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

		Rel_usuario_sco2004_objectivePeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004_objectivePeer::NUM_COLUMNS - Rel_usuario_sco2004_objectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, Sco2004Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004_objectivePeer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco2004_objective($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004_objectives();
				$obj2->addRel_usuario_sco2004_objective($obj1);
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
		return Rel_usuario_sco2004_objectivePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Rel_usuario_sco2004_objectivePeer::ID); 

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
			$comparison = $criteria->getComparison(Rel_usuario_sco2004_objectivePeer::ID);
			$selectCriteria->add(Rel_usuario_sco2004_objectivePeer::ID, $criteria->remove(Rel_usuario_sco2004_objectivePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_sco2004_objectivePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_sco2004_objective) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Rel_usuario_sco2004_objectivePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_sco2004_objective $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_sco2004_objectivePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME, Rel_usuario_sco2004_objectivePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_sco2004_objectivePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004_objectivePeer::ID, $pk);


		$v = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);

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
			$criteria->add(Rel_usuario_sco2004_objectivePeer::ID, $pks, Criteria::IN);
			$objs = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_sco2004_objectivePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_sco2004_objectiveMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_sco2004_objectiveMapBuilder');
}
