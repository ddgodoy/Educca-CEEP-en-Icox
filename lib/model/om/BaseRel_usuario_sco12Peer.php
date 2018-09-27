<?php


abstract class BaseRel_usuario_sco12Peer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_sco12';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_sco12';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'rel_usuario_sco12.ID';

	
	const ID_SCO12 = 'rel_usuario_sco12.ID_SCO12';

	
	const ID_USUARIO = 'rel_usuario_sco12.ID_USUARIO';

	
	const LESSON_LOCATION = 'rel_usuario_sco12.LESSON_LOCATION';

	
	const CREDIT = 'rel_usuario_sco12.CREDIT';

	
	const LESSON_STATUS = 'rel_usuario_sco12.LESSON_STATUS';

	
	const ENTRY = 'rel_usuario_sco12.ENTRY';

	
	const SCORE_RAW = 'rel_usuario_sco12.SCORE_RAW';

	
	const SCORE_MAX = 'rel_usuario_sco12.SCORE_MAX';

	
	const SCORE_MIN = 'rel_usuario_sco12.SCORE_MIN';

	
	const TOTAL_TIME = 'rel_usuario_sco12.TOTAL_TIME';

	
	const LESSON_MODE = 'rel_usuario_sco12.LESSON_MODE';

	
	const EXITVALUE = 'rel_usuario_sco12.EXITVALUE';

	
	const SESSION_TIME = 'rel_usuario_sco12.SESSION_TIME';

	
	const SUSPEND_DATA = 'rel_usuario_sco12.SUSPEND_DATA';

	
	const COMMENTS = 'rel_usuario_sco12.COMMENTS';

	
	const COMMENTS_FROM_LMS = 'rel_usuario_sco12.COMMENTS_FROM_LMS';

	
	const PREFERENCE_AUDIO = 'rel_usuario_sco12.PREFERENCE_AUDIO';

	
	const PREFERENCE_LANGUAGE = 'rel_usuario_sco12.PREFERENCE_LANGUAGE';

	
	const PREFERENCE_SPEED = 'rel_usuario_sco12.PREFERENCE_SPEED';

	
	const PREFERENCE_TEXT = 'rel_usuario_sco12.PREFERENCE_TEXT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdSco12', 'IdUsuario', 'LessonLocation', 'Credit', 'LessonStatus', 'Entry', 'ScoreRaw', 'ScoreMax', 'ScoreMin', 'TotalTime', 'LessonMode', 'Exitvalue', 'SessionTime', 'SuspendData', 'Comments', 'CommentsFromLms', 'PreferenceAudio', 'PreferenceLanguage', 'PreferenceSpeed', 'PreferenceText', ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12, Rel_usuario_sco12Peer::ID_USUARIO, Rel_usuario_sco12Peer::LESSON_LOCATION, Rel_usuario_sco12Peer::CREDIT, Rel_usuario_sco12Peer::LESSON_STATUS, Rel_usuario_sco12Peer::ENTRY, Rel_usuario_sco12Peer::SCORE_RAW, Rel_usuario_sco12Peer::SCORE_MAX, Rel_usuario_sco12Peer::SCORE_MIN, Rel_usuario_sco12Peer::TOTAL_TIME, Rel_usuario_sco12Peer::LESSON_MODE, Rel_usuario_sco12Peer::EXITVALUE, Rel_usuario_sco12Peer::SESSION_TIME, Rel_usuario_sco12Peer::SUSPEND_DATA, Rel_usuario_sco12Peer::COMMENTS, Rel_usuario_sco12Peer::COMMENTS_FROM_LMS, Rel_usuario_sco12Peer::PREFERENCE_AUDIO, Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE, Rel_usuario_sco12Peer::PREFERENCE_SPEED, Rel_usuario_sco12Peer::PREFERENCE_TEXT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_sco12', 'id_usuario', 'lesson_location', 'credit', 'lesson_status', 'entry', 'score_raw', 'score_max', 'score_min', 'total_time', 'lesson_mode', 'exitvalue', 'session_time', 'suspend_data', 'comments', 'comments_from_lms', 'preference_audio', 'preference_language', 'preference_speed', 'preference_text', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdSco12' => 1, 'IdUsuario' => 2, 'LessonLocation' => 3, 'Credit' => 4, 'LessonStatus' => 5, 'Entry' => 6, 'ScoreRaw' => 7, 'ScoreMax' => 8, 'ScoreMin' => 9, 'TotalTime' => 10, 'LessonMode' => 11, 'Exitvalue' => 12, 'SessionTime' => 13, 'SuspendData' => 14, 'Comments' => 15, 'CommentsFromLms' => 16, 'PreferenceAudio' => 17, 'PreferenceLanguage' => 18, 'PreferenceSpeed' => 19, 'PreferenceText' => 20, ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_sco12Peer::ID => 0, Rel_usuario_sco12Peer::ID_SCO12 => 1, Rel_usuario_sco12Peer::ID_USUARIO => 2, Rel_usuario_sco12Peer::LESSON_LOCATION => 3, Rel_usuario_sco12Peer::CREDIT => 4, Rel_usuario_sco12Peer::LESSON_STATUS => 5, Rel_usuario_sco12Peer::ENTRY => 6, Rel_usuario_sco12Peer::SCORE_RAW => 7, Rel_usuario_sco12Peer::SCORE_MAX => 8, Rel_usuario_sco12Peer::SCORE_MIN => 9, Rel_usuario_sco12Peer::TOTAL_TIME => 10, Rel_usuario_sco12Peer::LESSON_MODE => 11, Rel_usuario_sco12Peer::EXITVALUE => 12, Rel_usuario_sco12Peer::SESSION_TIME => 13, Rel_usuario_sco12Peer::SUSPEND_DATA => 14, Rel_usuario_sco12Peer::COMMENTS => 15, Rel_usuario_sco12Peer::COMMENTS_FROM_LMS => 16, Rel_usuario_sco12Peer::PREFERENCE_AUDIO => 17, Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE => 18, Rel_usuario_sco12Peer::PREFERENCE_SPEED => 19, Rel_usuario_sco12Peer::PREFERENCE_TEXT => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_sco12' => 1, 'id_usuario' => 2, 'lesson_location' => 3, 'credit' => 4, 'lesson_status' => 5, 'entry' => 6, 'score_raw' => 7, 'score_max' => 8, 'score_min' => 9, 'total_time' => 10, 'lesson_mode' => 11, 'exitvalue' => 12, 'session_time' => 13, 'suspend_data' => 14, 'comments' => 15, 'comments_from_lms' => 16, 'preference_audio' => 17, 'preference_language' => 18, 'preference_speed' => 19, 'preference_text' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_sco12MapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_sco12MapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_sco12Peer::getTableMap();
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
		return str_replace(Rel_usuario_sco12Peer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::ID);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::ID_SCO12);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::LESSON_LOCATION);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::CREDIT);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::LESSON_STATUS);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::ENTRY);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::SCORE_RAW);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::SCORE_MAX);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::SCORE_MIN);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::TOTAL_TIME);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::LESSON_MODE);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::EXITVALUE);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::SESSION_TIME);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::SUSPEND_DATA);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::COMMENTS);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::COMMENTS_FROM_LMS);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::PREFERENCE_AUDIO);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::PREFERENCE_SPEED);

		$criteria->addSelectColumn(Rel_usuario_sco12Peer::PREFERENCE_TEXT);

	}

	const COUNT = 'COUNT(rel_usuario_sco12.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_sco12.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_sco12Peer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_sco12Peer::populateObjects(Rel_usuario_sco12Peer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_sco12Peer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_sco12Peer::getOMClass();
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
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco12Peer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco12Peer::NUM_COLUMNS - Rel_usuario_sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Sco12Peer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco12Peer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco12($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco12s();
				$obj2->addRel_usuario_sco12($obj1); 			}
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

		Rel_usuario_sco12Peer::addSelectColumns($c);
		$startcol = (Rel_usuario_sco12Peer::NUM_COLUMNS - Rel_usuario_sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco12Peer::getOMClass();

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
										$temp_obj2->addRel_usuario_sco12($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_sco12s();
				$obj2->addRel_usuario_sco12($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco12Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco12Peer::NUM_COLUMNS - Rel_usuario_sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco12Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco12Peer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);

		$c->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco12Peer::getOMClass();


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
					$temp_obj2->addRel_usuario_sco12($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco12s();
				$obj2->addRel_usuario_sco12($obj1);
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
					$temp_obj3->addRel_usuario_sco12($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_sco12s();
				$obj3->addRel_usuario_sco12($obj1);
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
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_sco12Peer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);

		$rs = Rel_usuario_sco12Peer::doSelectRS($criteria, $con);
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

		Rel_usuario_sco12Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco12Peer::NUM_COLUMNS - Rel_usuario_sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco12Peer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco12Peer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco12($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco12s();
				$obj2->addRel_usuario_sco12($obj1);
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

		Rel_usuario_sco12Peer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_sco12Peer::NUM_COLUMNS - Rel_usuario_sco12Peer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Sco12Peer::addSelectColumns($c);
		$startcol3 = $startcol2 + Sco12Peer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_sco12Peer::ID_SCO12, Sco12Peer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_sco12Peer::getOMClass();

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
					$temp_obj2->addRel_usuario_sco12($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_sco12s();
				$obj2->addRel_usuario_sco12($obj1);
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
		return Rel_usuario_sco12Peer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Rel_usuario_sco12Peer::ID); 

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
			$comparison = $criteria->getComparison(Rel_usuario_sco12Peer::ID);
			$selectCriteria->add(Rel_usuario_sco12Peer::ID, $criteria->remove(Rel_usuario_sco12Peer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_sco12Peer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco12Peer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_sco12) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Rel_usuario_sco12Peer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_sco12 $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_sco12Peer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_sco12Peer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_sco12Peer::DATABASE_NAME, Rel_usuario_sco12Peer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_sco12Peer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Rel_usuario_sco12Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco12Peer::ID, $pk);


		$v = Rel_usuario_sco12Peer::doSelect($criteria, $con);

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
			$criteria->add(Rel_usuario_sco12Peer::ID, $pks, Criteria::IN);
			$objs = Rel_usuario_sco12Peer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_sco12Peer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_sco12MapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_sco12MapBuilder');
}
