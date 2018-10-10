<?php


abstract class BaseRel_usuario_tareaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_tarea';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_tarea';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'rel_usuario_tarea.ID_USUARIO';

	
	const ID_TAREA = 'rel_usuario_tarea.ID_TAREA';

	
	const ID_EJERCICIO_RESUELTO = 'rel_usuario_tarea.ID_EJERCICIO_RESUELTO';

	
	const ENTREGADA = 'rel_usuario_tarea.ENTREGADA';

	
	const CORREGIDA = 'rel_usuario_tarea.CORREGIDA';

	
	const FECHA_ENTREGA = 'rel_usuario_tarea.FECHA_ENTREGA';

	
	const TIEMPO_RESTANTE = 'rel_usuario_tarea.TIEMPO_RESTANTE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdTarea', 'IdEjercicioResuelto', 'Entregada', 'Corregida', 'FechaEntrega', 'TiempoRestante', ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_tareaPeer::ID_USUARIO, Rel_usuario_tareaPeer::ID_TAREA, Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Rel_usuario_tareaPeer::ENTREGADA, Rel_usuario_tareaPeer::CORREGIDA, Rel_usuario_tareaPeer::FECHA_ENTREGA, Rel_usuario_tareaPeer::TIEMPO_RESTANTE, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_tarea', 'id_ejercicio_resuelto', 'entregada', 'corregida', 'fecha_entrega', 'tiempo_restante', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdTarea' => 1, 'IdEjercicioResuelto' => 2, 'Entregada' => 3, 'Corregida' => 4, 'FechaEntrega' => 5, 'TiempoRestante' => 6, ),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_tareaPeer::ID_USUARIO => 0, Rel_usuario_tareaPeer::ID_TAREA => 1, Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO => 2, Rel_usuario_tareaPeer::ENTREGADA => 3, Rel_usuario_tareaPeer::CORREGIDA => 4, Rel_usuario_tareaPeer::FECHA_ENTREGA => 5, Rel_usuario_tareaPeer::TIEMPO_RESTANTE => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_tarea' => 1, 'id_ejercicio_resuelto' => 2, 'entregada' => 3, 'corregida' => 4, 'fecha_entrega' => 5, 'tiempo_restante' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_tareaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_tareaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_tareaPeer::getTableMap();
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
		return str_replace(Rel_usuario_tareaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::ID_TAREA);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::ENTREGADA);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::CORREGIDA);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::FECHA_ENTREGA);

		$criteria->addSelectColumn(Rel_usuario_tareaPeer::TIEMPO_RESTANTE);

	}

	const COUNT = 'COUNT(rel_usuario_tarea.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_tarea.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_tareaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_tareaPeer::populateObjects(Rel_usuario_tareaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_tareaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_tareaPeer::getOMClass();
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_tarea($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1); 			}
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TareaPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_tarea($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1); 			}
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Ejercicio_resueltoPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_tarea($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TareaPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();


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
					$temp_obj2->addRel_usuario_tarea($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1);
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
					$temp_obj3->addRel_usuario_tarea($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_tareas();
				$obj3->addRel_usuario_tarea($obj1);
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
					$temp_obj4->addRel_usuario_tarea($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRel_usuario_tareas();
				$obj4->addRel_usuario_tarea($obj1);
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_tareaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$rs = Rel_usuario_tareaPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TareaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TareaPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);

		$c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
					$temp_obj2->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1);
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
					$temp_obj3->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_tareas();
				$obj3->addRel_usuario_tarea($obj1);
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		Ejercicio_resueltoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Ejercicio_resueltoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
					$temp_obj2->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1);
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
					$temp_obj3->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_tareas();
				$obj3->addRel_usuario_tarea($obj1);
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

		Rel_usuario_tareaPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_tareaPeer::NUM_COLUMNS - Rel_usuario_tareaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TareaPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_tareaPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_tareaPeer::getOMClass();

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
					$temp_obj2->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_tareas();
				$obj2->addRel_usuario_tarea($obj1);
			}

			$omClass = TareaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTarea(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRel_usuario_tarea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_tareas();
				$obj3->addRel_usuario_tarea($obj1);
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
		return Rel_usuario_tareaPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Rel_usuario_tareaPeer::ID_USUARIO);
			$selectCriteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $criteria->remove(Rel_usuario_tareaPeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(Rel_usuario_tareaPeer::ID_TAREA);
			$selectCriteria->add(Rel_usuario_tareaPeer::ID_TAREA, $criteria->remove(Rel_usuario_tareaPeer::ID_TAREA), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_tareaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_tareaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_tarea) {

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

			$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $vals[0], Criteria::IN);
			$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_tarea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_tareaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_tareaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_tareaPeer::DATABASE_NAME, Rel_usuario_tareaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_tareaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_usuario, $id_tarea, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
		$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
		$v = Rel_usuario_tareaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_tareaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_tareaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_tareaMapBuilder');
}
