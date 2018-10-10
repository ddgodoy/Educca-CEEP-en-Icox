<?php


abstract class BaseEjercicio_resueltoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ejercicio_resuelto';

	
	const CLASS_DEFAULT = 'lib.model.Ejercicio_resuelto';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ejercicio_resuelto.ID';

	
	const ID_AUTOR = 'ejercicio_resuelto.ID_AUTOR';

	
	const ID_EJERCICIO = 'ejercicio_resuelto.ID_EJERCICIO';

	
	const ID_CORRECTOR = 'ejercicio_resuelto.ID_CORRECTOR';

	
	const FECHA_CORRECCION = 'ejercicio_resuelto.FECHA_CORRECCION';

	
	const SCORE = 'ejercicio_resuelto.SCORE';

	
	const ACIERTOS = 'ejercicio_resuelto.ACIERTOS';

	
	const FALLOS = 'ejercicio_resuelto.FALLOS';

	
	const BLANCOS = 'ejercicio_resuelto.BLANCOS';

	
	const TIEMPO = 'ejercicio_resuelto.TIEMPO';

	
	const REPOSITORIO = 'ejercicio_resuelto.REPOSITORIO';

	
	const ID_CURSO = 'ejercicio_resuelto.ID_CURSO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdAutor', 'IdEjercicio', 'IdCorrector', 'FechaCorreccion', 'Score', 'Aciertos', 'Fallos', 'Blancos', 'Tiempo', 'Repositorio', 'IdCurso', ),
		BasePeer::TYPE_COLNAME => array (Ejercicio_resueltoPeer::ID, Ejercicio_resueltoPeer::ID_AUTOR, Ejercicio_resueltoPeer::ID_EJERCICIO, Ejercicio_resueltoPeer::ID_CORRECTOR, Ejercicio_resueltoPeer::FECHA_CORRECCION, Ejercicio_resueltoPeer::SCORE, Ejercicio_resueltoPeer::ACIERTOS, Ejercicio_resueltoPeer::FALLOS, Ejercicio_resueltoPeer::BLANCOS, Ejercicio_resueltoPeer::TIEMPO, Ejercicio_resueltoPeer::REPOSITORIO, Ejercicio_resueltoPeer::ID_CURSO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_autor', 'id_ejercicio', 'id_corrector', 'fecha_correccion', 'score', 'aciertos', 'fallos', 'blancos', 'tiempo', 'repositorio', 'id_curso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdAutor' => 1, 'IdEjercicio' => 2, 'IdCorrector' => 3, 'FechaCorreccion' => 4, 'Score' => 5, 'Aciertos' => 6, 'Fallos' => 7, 'Blancos' => 8, 'Tiempo' => 9, 'Repositorio' => 10, 'IdCurso' => 11, ),
		BasePeer::TYPE_COLNAME => array (Ejercicio_resueltoPeer::ID => 0, Ejercicio_resueltoPeer::ID_AUTOR => 1, Ejercicio_resueltoPeer::ID_EJERCICIO => 2, Ejercicio_resueltoPeer::ID_CORRECTOR => 3, Ejercicio_resueltoPeer::FECHA_CORRECCION => 4, Ejercicio_resueltoPeer::SCORE => 5, Ejercicio_resueltoPeer::ACIERTOS => 6, Ejercicio_resueltoPeer::FALLOS => 7, Ejercicio_resueltoPeer::BLANCOS => 8, Ejercicio_resueltoPeer::TIEMPO => 9, Ejercicio_resueltoPeer::REPOSITORIO => 10, Ejercicio_resueltoPeer::ID_CURSO => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_autor' => 1, 'id_ejercicio' => 2, 'id_corrector' => 3, 'fecha_correccion' => 4, 'score' => 5, 'aciertos' => 6, 'fallos' => 7, 'blancos' => 8, 'tiempo' => 9, 'repositorio' => 10, 'id_curso' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Ejercicio_resueltoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Ejercicio_resueltoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Ejercicio_resueltoPeer::getTableMap();
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
		return str_replace(Ejercicio_resueltoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ID);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ID_AUTOR);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ID_EJERCICIO);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ID_CORRECTOR);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::FECHA_CORRECCION);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::SCORE);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ACIERTOS);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::FALLOS);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::BLANCOS);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::TIEMPO);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::REPOSITORIO);

		$criteria->addSelectColumn(Ejercicio_resueltoPeer::ID_CURSO);

	}

	const COUNT = 'COUNT(ejercicio_resuelto.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ejercicio_resuelto.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
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
		$objects = Ejercicio_resueltoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Ejercicio_resueltoPeer::populateObjects(Ejercicio_resueltoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Ejercicio_resueltoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Ejercicio_resueltoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUsuarioRelatedByIdAutor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUsuarioRelatedByIdCorrector(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUsuarioRelatedByIdAutor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdAutor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio_resueltoRelatedByIdAutor($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicio_resueltosRelatedByIdAutor();
				$obj2->addEjercicio_resueltoRelatedByIdAutor($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EjercicioPeer::addSelectColumns($c);

		$c->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

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
										$temp_obj2->addEjercicio_resuelto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicio_resueltos();
				$obj2->addEjercicio_resuelto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUsuarioRelatedByIdCorrector(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdCorrector(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio_resueltoRelatedByIdCorrector($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicio_resueltosRelatedByIdCorrector();
				$obj2->addEjercicio_resueltoRelatedByIdCorrector($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
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

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		EjercicioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EjercicioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);

		$c->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$c->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdAutor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio_resueltoRelatedByIdAutor($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_resueltosRelatedByIdAutor();
				$obj2->addEjercicio_resueltoRelatedByIdAutor($obj1);
			}


					
			$omClass = EjercicioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEjercicio(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio_resuelto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicio_resueltos();
				$obj3->addEjercicio_resuelto($obj1);
			}


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsuarioRelatedByIdCorrector(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEjercicio_resueltoRelatedByIdCorrector($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEjercicio_resueltosRelatedByIdCorrector();
				$obj4->addEjercicio_resueltoRelatedByIdCorrector($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUsuarioRelatedByIdAutor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEjercicio(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUsuarioRelatedByIdCorrector(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Ejercicio_resueltoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);

		$rs = Ejercicio_resueltoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUsuarioRelatedByIdAutor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EjercicioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EjercicioPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

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
					$temp_obj2->addEjercicio_resuelto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_resueltos();
				$obj2->addEjercicio_resuelto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEjercicio(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_resueltoPeer::ID_AUTOR, UsuarioPeer::ID);

		$c->addJoin(Ejercicio_resueltoPeer::ID_CORRECTOR, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdAutor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio_resueltoRelatedByIdAutor($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_resueltosRelatedByIdAutor();
				$obj2->addEjercicio_resueltoRelatedByIdAutor($obj1);
			}

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuarioRelatedByIdCorrector(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio_resueltoRelatedByIdCorrector($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicio_resueltosRelatedByIdCorrector();
				$obj3->addEjercicio_resueltoRelatedByIdCorrector($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuarioRelatedByIdCorrector(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol2 = (Ejercicio_resueltoPeer::NUM_COLUMNS - Ejercicio_resueltoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EjercicioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EjercicioPeer::NUM_COLUMNS;

		$c->addJoin(Ejercicio_resueltoPeer::ID_EJERCICIO, EjercicioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Ejercicio_resueltoPeer::getOMClass();

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
					$temp_obj2->addEjercicio_resuelto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicio_resueltos();
				$obj2->addEjercicio_resuelto($obj1);
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
		return Ejercicio_resueltoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Ejercicio_resueltoPeer::ID); 

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
			$comparison = $criteria->getComparison(Ejercicio_resueltoPeer::ID);
			$selectCriteria->add(Ejercicio_resueltoPeer::ID, $criteria->remove(Ejercicio_resueltoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Ejercicio_resueltoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Ejercicio_resueltoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Ejercicio_resuelto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Ejercicio_resueltoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Ejercicio_resuelto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Ejercicio_resueltoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Ejercicio_resueltoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Ejercicio_resueltoPeer::DATABASE_NAME, Ejercicio_resueltoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Ejercicio_resueltoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Ejercicio_resueltoPeer::DATABASE_NAME);

		$criteria->add(Ejercicio_resueltoPeer::ID, $pk);


		$v = Ejercicio_resueltoPeer::doSelect($criteria, $con);

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
			$criteria->add(Ejercicio_resueltoPeer::ID, $pks, Criteria::IN);
			$objs = Ejercicio_resueltoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEjercicio_resueltoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Ejercicio_resueltoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Ejercicio_resueltoMapBuilder');
}
