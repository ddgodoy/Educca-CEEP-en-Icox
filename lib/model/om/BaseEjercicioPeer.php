<?php


abstract class BaseEjercicioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ejercicio';

	
	const CLASS_DEFAULT = 'lib.model.Ejercicio';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ejercicio.ID';

	
	const ID_AUTOR = 'ejercicio.ID_AUTOR';

	
	const ID_MATERIA = 'ejercicio.ID_MATERIA';

	
	const NOMBRE_AUTOR = 'ejercicio.NOMBRE_AUTOR';

	
	const TIPO = 'ejercicio.TIPO';

	
	const TITULO = 'ejercicio.TITULO';

	
	const TEST_MULTIPLE = 'ejercicio.TEST_MULTIPLE';

	
	const TEST_RESTA = 'ejercicio.TEST_RESTA';

	
	const NUMERO_RESPUESTAS = 'ejercicio.NUMERO_RESPUESTAS';

	
	const PUBLICADO = 'ejercicio.PUBLICADO';

	
	const SOLUCION = 'ejercicio.SOLUCION';

	
	const EXPRESIONES_MATEMATICAS = 'ejercicio.EXPRESIONES_MATEMATICAS';

	
	const NUMERO_HOJAS = 'ejercicio.NUMERO_HOJAS';

	
	const ID_SOLUCION = 'ejercicio.ID_SOLUCION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdAutor', 'IdMateria', 'NombreAutor', 'Tipo', 'Titulo', 'TestMultiple', 'TestResta', 'NumeroRespuestas', 'Publicado', 'Solucion', 'ExpresionesMatematicas', 'NumeroHojas', 'IdSolucion', ),
		BasePeer::TYPE_COLNAME => array (EjercicioPeer::ID, EjercicioPeer::ID_AUTOR, EjercicioPeer::ID_MATERIA, EjercicioPeer::NOMBRE_AUTOR, EjercicioPeer::TIPO, EjercicioPeer::TITULO, EjercicioPeer::TEST_MULTIPLE, EjercicioPeer::TEST_RESTA, EjercicioPeer::NUMERO_RESPUESTAS, EjercicioPeer::PUBLICADO, EjercicioPeer::SOLUCION, EjercicioPeer::EXPRESIONES_MATEMATICAS, EjercicioPeer::NUMERO_HOJAS, EjercicioPeer::ID_SOLUCION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_autor', 'id_materia', 'nombre_autor', 'tipo', 'titulo', 'test_multiple', 'test_resta', 'numero_respuestas', 'publicado', 'solucion', 'expresiones_matematicas', 'numero_hojas', 'id_solucion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdAutor' => 1, 'IdMateria' => 2, 'NombreAutor' => 3, 'Tipo' => 4, 'Titulo' => 5, 'TestMultiple' => 6, 'TestResta' => 7, 'NumeroRespuestas' => 8, 'Publicado' => 9, 'Solucion' => 10, 'ExpresionesMatematicas' => 11, 'NumeroHojas' => 12, 'IdSolucion' => 13, ),
		BasePeer::TYPE_COLNAME => array (EjercicioPeer::ID => 0, EjercicioPeer::ID_AUTOR => 1, EjercicioPeer::ID_MATERIA => 2, EjercicioPeer::NOMBRE_AUTOR => 3, EjercicioPeer::TIPO => 4, EjercicioPeer::TITULO => 5, EjercicioPeer::TEST_MULTIPLE => 6, EjercicioPeer::TEST_RESTA => 7, EjercicioPeer::NUMERO_RESPUESTAS => 8, EjercicioPeer::PUBLICADO => 9, EjercicioPeer::SOLUCION => 10, EjercicioPeer::EXPRESIONES_MATEMATICAS => 11, EjercicioPeer::NUMERO_HOJAS => 12, EjercicioPeer::ID_SOLUCION => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_autor' => 1, 'id_materia' => 2, 'nombre_autor' => 3, 'tipo' => 4, 'titulo' => 5, 'test_multiple' => 6, 'test_resta' => 7, 'numero_respuestas' => 8, 'publicado' => 9, 'solucion' => 10, 'expresiones_matematicas' => 11, 'numero_hojas' => 12, 'id_solucion' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EjercicioMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EjercicioMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EjercicioPeer::getTableMap();
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
		return str_replace(EjercicioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EjercicioPeer::ID);

		$criteria->addSelectColumn(EjercicioPeer::ID_AUTOR);

		$criteria->addSelectColumn(EjercicioPeer::ID_MATERIA);

		$criteria->addSelectColumn(EjercicioPeer::NOMBRE_AUTOR);

		$criteria->addSelectColumn(EjercicioPeer::TIPO);

		$criteria->addSelectColumn(EjercicioPeer::TITULO);

		$criteria->addSelectColumn(EjercicioPeer::TEST_MULTIPLE);

		$criteria->addSelectColumn(EjercicioPeer::TEST_RESTA);

		$criteria->addSelectColumn(EjercicioPeer::NUMERO_RESPUESTAS);

		$criteria->addSelectColumn(EjercicioPeer::PUBLICADO);

		$criteria->addSelectColumn(EjercicioPeer::SOLUCION);

		$criteria->addSelectColumn(EjercicioPeer::EXPRESIONES_MATEMATICAS);

		$criteria->addSelectColumn(EjercicioPeer::NUMERO_HOJAS);

		$criteria->addSelectColumn(EjercicioPeer::ID_SOLUCION);

	}

	const COUNT = 'COUNT(ejercicio.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ejercicio.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
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
		$objects = EjercicioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EjercicioPeer::populateObjects(EjercicioPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EjercicioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EjercicioPeer::getOMClass();
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
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinMateria(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEjercicio_resuelto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
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

		EjercicioPeer::addSelectColumns($c);
		$startcol = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

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
										$temp_obj2->addEjercicio($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinMateria(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EjercicioPeer::addSelectColumns($c);
		$startcol = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MateriaPeer::addSelectColumns($c);

		$c->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MateriaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMateria(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEjercicio_resuelto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EjercicioPeer::addSelectColumns($c);
		$startcol = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Ejercicio_resueltoPeer::addSelectColumns($c);

		$c->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Ejercicio_resueltoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEjercicio($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$criteria->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$criteria->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
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

		EjercicioPeer::addSelectColumns($c);
		$startcol2 = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		MateriaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MateriaPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$c->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$c->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();


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
					$temp_obj2->addEjercicio($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1);
			}


					
			$omClass = MateriaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getMateria(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicios();
				$obj3->addEjercicio($obj1);
			}


					
			$omClass = Ejercicio_resueltoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEjercicio($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEjercicios();
				$obj4->addEjercicio($obj1);
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
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$criteria->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptMateria(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$criteria->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEjercicio_resuelto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EjercicioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EjercicioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$criteria->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$rs = EjercicioPeer::doSelectRS($criteria, $con);
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

		EjercicioPeer::addSelectColumns($c);
		$startcol2 = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MateriaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MateriaPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);

		$c->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MateriaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMateria(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1);
			}

			$omClass = Ejercicio_resueltoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicios();
				$obj3->addEjercicio($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptMateria(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EjercicioPeer::addSelectColumns($c);
		$startcol2 = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$c->addJoin(EjercicioPeer::ID_SOLUCION, Ejercicio_resueltoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

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
					$temp_obj2->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1);
			}

			$omClass = Ejercicio_resueltoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEjercicio_resuelto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicios();
				$obj3->addEjercicio($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEjercicio_resuelto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EjercicioPeer::addSelectColumns($c);
		$startcol2 = (EjercicioPeer::NUM_COLUMNS - EjercicioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		MateriaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MateriaPeer::NUM_COLUMNS;

		$c->addJoin(EjercicioPeer::ID_AUTOR, UsuarioPeer::ID);

		$c->addJoin(EjercicioPeer::ID_MATERIA, MateriaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EjercicioPeer::getOMClass();

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
					$temp_obj2->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEjercicios();
				$obj2->addEjercicio($obj1);
			}

			$omClass = MateriaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getMateria(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEjercicio($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEjercicios();
				$obj3->addEjercicio($obj1);
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
		return EjercicioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EjercicioPeer::ID); 

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
			$comparison = $criteria->getComparison(EjercicioPeer::ID);
			$selectCriteria->add(EjercicioPeer::ID, $criteria->remove(EjercicioPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EjercicioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EjercicioPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Ejercicio) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EjercicioPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Ejercicio $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EjercicioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EjercicioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EjercicioPeer::DATABASE_NAME, EjercicioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EjercicioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EjercicioPeer::DATABASE_NAME);

		$criteria->add(EjercicioPeer::ID, $pk);


		$v = EjercicioPeer::doSelect($criteria, $con);

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
			$criteria->add(EjercicioPeer::ID, $pks, Criteria::IN);
			$objs = EjercicioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEjercicioPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EjercicioMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EjercicioMapBuilder');
}
