<?php


abstract class BaseRel_usuario_sco2004Peer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_sco2004';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_sco2004';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'rel_usuario_sco2004.ID';

	
	const ID_SCO2004 = 'rel_usuario_sco2004.ID_SCO2004';

	
	const ID_USUARIO = 'rel_usuario_sco2004.ID_USUARIO';

	
	const COMPLETION_STATUS = 'rel_usuario_sco2004.COMPLETION_STATUS';

	
	const ENTRY = 'rel_usuario_sco2004.ENTRY';

	
	const EXIT = 'rel_usuario_sco2004.EXIT';

	
	const AUDIO_LEVEL = 'rel_usuario_sco2004.AUDIO_LEVEL';

	
	const LANGUAGE = 'rel_usuario_sco2004.LANGUAGE';

	
	const DELIVERY_SPEED = 'rel_usuario_sco2004.DELIVERY_SPEED';

	
	const AUDIO_CAPTIONING = 'rel_usuario_sco2004.AUDIO_CAPTIONING';

	
	const LOCATION = 'rel_usuario_sco2004.LOCATION';

	
	const MODE = 'rel_usuario_sco2004.MODE';

	
	const PROGRESS_MEASURE = 'rel_usuario_sco2004.PROGRESS_MEASURE';

	
	const SCORE_SCALED = 'rel_usuario_sco2004.SCORE_SCALED';

	
	const SCORE_RAW = 'rel_usuario_sco2004.SCORE_RAW';

	
	const SCORE_MIN = 'rel_usuario_sco2004.SCORE_MIN';

	
	const SCORE_MAX = 'rel_usuario_sco2004.SCORE_MAX';

	
	const SESSION_TIME = 'rel_usuario_sco2004.SESSION_TIME';

	
	const SUCCESS_STATUS = 'rel_usuario_sco2004.SUCCESS_STATUS';

	
	const SUSPEND_DATA = 'rel_usuario_sco2004.SUSPEND_DATA';

	
	const TOTAL_TIME = 'rel_usuario_sco2004.TOTAL_TIME';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdSco2004', 'IdUsuario', 'CompletionStatus', 'Entry', 'Exit', 'AudioLevel', 'Language', 'DeliverySpeed', 'AudioCaptioning', 'Location', 'Mode', 'ProgressMeasure', 'ScoreScaled', 'ScoreRaw', 'ScoreMin', 'ScoreMax', 'SessionTime', 'SuccessStatus', 'SuspendData', 'TotalTime', ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004Peer::ID, Rel_usuario_sco2004Peer::ID_SCO2004, Rel_usuario_sco2004Peer::ID_USUARIO, Rel_usuario_sco2004Peer::COMPLETION_STATUS, Rel_usuario_sco2004Peer::ENTRY, Rel_usuario_sco2004Peer::EXIT, Rel_usuario_sco2004Peer::AUDIO_LEVEL, Rel_usuario_sco2004Peer::LANGUAGE, Rel_usuario_sco2004Peer::DELIVERY_SPEED, Rel_usuario_sco2004Peer::AUDIO_CAPTIONING, Rel_usuario_sco2004Peer::LOCATION, Rel_usuario_sco2004Peer::MODE, Rel_usuario_sco2004Peer::PROGRESS_MEASURE, Rel_usuario_sco2004Peer::SCORE_SCALED, Rel_usuario_sco2004Peer::SCORE_RAW, Rel_usuario_sco2004Peer::SCORE_MIN, Rel_usuario_sco2004Peer::SCORE_MAX, Rel_usuario_sco2004Peer::SESSION_TIME, Rel_usuario_sco2004Peer::SUCCESS_STATUS, Rel_usuario_sco2004Peer::SUSPEND_DATA, Rel_usuario_sco2004Peer::TOTAL_TIME, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_sco2004', 'id_usuario', 'completion_status', 'entry', 'exit', 'audio_level', 'language', 'delivery_speed', 'audio_captioning', 'location', 'mode', 'progress_measure', 'score_scaled', 'score_raw', 'score_min', 'score_max', 'session_time', 'success_status', 'suspend_data', 'total_time', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdSco2004' => 1, 'IdUsuario' => 2, 'CompletionStatus' => 3, 'Entry' => 4, 'Exit' => 5, 'AudioLevel' => 6, 'Language' => 7, 'DeliverySpeed' => 8, 'AudioCaptioning' => 9, 'Location' => 10, 'Mode' => 11, 'ProgressMeasure' => 12, 'ScoreScaled' => 13, 'ScoreRaw' => 14, 'ScoreMin' => 15, 'ScoreMax' => 16, 'SessionTime' => 17, 'SuccessStatus' => 18, 'SuspendData' => 19, 'TotalTime' => 20, ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco2004Peer::ID => 0, Rel_usuario_sco2004Peer::ID_SCO2004 => 1, Rel_usuario_sco2004Peer::ID_USUARIO => 2, Rel_usuario_sco2004Peer::COMPLETION_STATUS => 3, Rel_usuario_sco2004Peer::ENTRY => 4, Rel_usuario_sco2004Peer::EXIT => 5, Rel_usuario_sco2004Peer::AUDIO_LEVEL => 6, Rel_usuario_sco2004Peer::LANGUAGE => 7, Rel_usuario_sco2004Peer::DELIVERY_SPEED => 8, Rel_usuario_sco2004Peer::AUDIO_CAPTIONING => 9, Rel_usuario_sco2004Peer::LOCATION => 10, Rel_usuario_sco2004Peer::MODE => 11, Rel_usuario_sco2004Peer::PROGRESS_MEASURE => 12, Rel_usuario_sco2004Peer::SCORE_SCALED => 13, Rel_usuario_sco2004Peer::SCORE_RAW => 14, Rel_usuario_sco2004Peer::SCORE_MIN => 15, Rel_usuario_sco2004Peer::SCORE_MAX => 16, Rel_usuario_sco2004Peer::SESSION_TIME => 17, Rel_usuario_sco2004Peer::SUCCESS_STATUS => 18, Rel_usuario_sco2004Peer::SUSPEND_DATA => 19, Rel_usuario_sco2004Peer::TOTAL_TIME => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_sco2004' => 1, 'id_usuario' => 2, 'completion_status' => 3, 'entry' => 4, 'exit' => 5, 'audio_level' => 6, 'language' => 7, 'delivery_speed' => 8, 'audio_captioning' => 9, 'location' => 10, 'mode' => 11, 'progress_measure' => 12, 'score_scaled' => 13, 'score_raw' => 14, 'score_min' => 15, 'score_max' => 16, 'session_time' => 17, 'success_status' => 18, 'suspend_data' => 19, 'total_time' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_sco2004MapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_sco2004MapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_sco2004Peer::getTableMap();
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
		return str_replace(Rel_usuario_sco2004Peer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::ID);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::ID_SCO2004);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COMPLETION_STATUS);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::ENTRY);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::EXIT);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::AUDIO_LEVEL);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::LANGUAGE);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::DELIVERY_SPEED);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::AUDIO_CAPTIONING);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::LOCATION);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::MODE);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::PROGRESS_MEASURE);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SCORE_SCALED);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SCORE_RAW);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SCORE_MIN);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SCORE_MAX);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SESSION_TIME);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SUCCESS_STATUS);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::SUSPEND_DATA);

		$criteria->addSelectColumn(Rel_usuario_sco2004Peer::TOTAL_TIME);

	}

	const COUNT = 'COUNT(rel_usuario_sco2004.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_sco2004.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_sco2004Peer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_sco2004Peer::populateObjects(Rel_usuario_sco2004Peer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_sco2004Peer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_sco2004Peer::getOMClass();
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
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004Peer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004Peer::NUM_COLUMNS - Rel_usuario_sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Sco2004Peer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004Peer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco2004($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004s();
				$obj2->addRel_usuario_sco2004($obj1); 			}
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

		Rel_usuario_sco2004Peer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco2004Peer::NUM_COLUMNS - Rel_usuario_sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004Peer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco2004($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco2004s();
				$obj2->addRel_usuario_sco2004($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004Peer::NUM_COLUMNS - Rel_usuario_sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);

		$c->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004Peer::getOMClass();


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
					$temp_obj2->addRel_usuario_sco2004($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004s();
				$obj2->addRel_usuario_sco2004($obj1);
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
					$temp_obj3->addRel_usuario_sco2004($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_sco2004s();
				$obj3->addRel_usuario_sco2004($obj1);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco2004Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);

		$rs = Rel_usuario_sco2004Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco2004Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004Peer::NUM_COLUMNS - Rel_usuario_sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004Peer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004Peer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco2004($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004s();
				$obj2->addRel_usuario_sco2004($obj1);
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

		Rel_usuario_sco2004Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco2004Peer::NUM_COLUMNS - Rel_usuario_sco2004Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco2004Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco2004Peer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco2004Peer::ID_SCO2004, Sco2004Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco2004Peer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco2004($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco2004s();
				$obj2->addRel_usuario_sco2004($obj1);
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
		return Rel_usuario_sco2004Peer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Rel_usuario_sco2004Peer::ID); 

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
			$comparison = $criteria->getComparison(Rel_usuario_sco2004Peer::ID);
			$selectCriteria->add(Rel_usuario_sco2004Peer::ID, $criteria->remove(Rel_usuario_sco2004Peer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_sco2004Peer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004Peer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_sco2004) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Rel_usuario_sco2004Peer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_sco2004 $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_sco2004Peer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_sco2004Peer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_sco2004Peer::DATABASE_NAME, Rel_usuario_sco2004Peer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_sco2004Peer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Rel_usuario_sco2004Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004Peer::ID, $pk);


		$v = Rel_usuario_sco2004Peer::doSelect($criteria, $con);

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
			$criteria->add(Rel_usuario_sco2004Peer::ID, $pks, Criteria::IN);
			$objs = Rel_usuario_sco2004Peer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_sco2004Peer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_sco2004MapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_sco2004MapBuilder');
}
