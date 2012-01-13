<?php


abstract class BaseUsuarios_onlinePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'usuarios_online';

	
	const CLASS_DEFAULT = 'lib.model.Usuarios_online';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'usuarios_online.ID_USUARIO';

	
	const ID_CURSO = 'usuarios_online.ID_CURSO';

	
	const ID_ROL = 'usuarios_online.ID_ROL';

	
	const TIEMPO = 'usuarios_online.TIEMPO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdCurso', 'IdRol', 'Tiempo', ),
		BasePeer::TYPE_COLNAME => array (Usuarios_onlinePeer::ID_USUARIO, Usuarios_onlinePeer::ID_CURSO, Usuarios_onlinePeer::ID_ROL, Usuarios_onlinePeer::TIEMPO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_curso', 'id_rol', 'tiempo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdCurso' => 1, 'IdRol' => 2, 'Tiempo' => 3, ),
		BasePeer::TYPE_COLNAME => array (Usuarios_onlinePeer::ID_USUARIO => 0, Usuarios_onlinePeer::ID_CURSO => 1, Usuarios_onlinePeer::ID_ROL => 2, Usuarios_onlinePeer::TIEMPO => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_curso' => 1, 'id_rol' => 2, 'tiempo' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Usuarios_onlineMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Usuarios_onlineMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Usuarios_onlinePeer::getTableMap();
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
		return str_replace(Usuarios_onlinePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Usuarios_onlinePeer::ID_USUARIO);

		$criteria->addSelectColumn(Usuarios_onlinePeer::ID_CURSO);

		$criteria->addSelectColumn(Usuarios_onlinePeer::ID_ROL);

		$criteria->addSelectColumn(Usuarios_onlinePeer::TIEMPO);

	}

	const COUNT = 'COUNT(usuarios_online.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT usuarios_online.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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
		$objects = Usuarios_onlinePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Usuarios_onlinePeer::populateObjects(Usuarios_onlinePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Usuarios_onlinePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Usuarios_onlinePeer::getOMClass();
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
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRol(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

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
										$temp_obj2->addUsuarios_online($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1); 			}
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

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

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
										$temp_obj2->addUsuarios_online($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRol(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RolPeer::addSelectColumns($c);

		$c->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RolPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRol(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUsuarios_online($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol2 = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		RolPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RolPeer::NUM_COLUMNS;

		$c->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();


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
					$temp_obj2->addUsuarios_online($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1);
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
					$temp_obj3->addUsuarios_online($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initUsuarios_onlines();
				$obj3->addUsuarios_online($obj1);
			}


					
			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRol(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addUsuarios_online($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initUsuarios_onlines();
				$obj4->addUsuarios_online($obj1);
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
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRol(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Usuarios_onlinePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$rs = Usuarios_onlinePeer::doSelectRS($criteria, $con);
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

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol2 = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		RolPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolPeer::NUM_COLUMNS;

		$c->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

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
					$temp_obj2->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1);
			}

			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRol(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initUsuarios_onlines();
				$obj3->addUsuarios_online($obj1);
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

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol2 = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		RolPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolPeer::NUM_COLUMNS;

		$c->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Usuarios_onlinePeer::ID_ROL, RolPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

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
					$temp_obj2->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1);
			}

			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRol(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initUsuarios_onlines();
				$obj3->addUsuarios_online($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRol(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Usuarios_onlinePeer::addSelectColumns($c);
		$startcol2 = (Usuarios_onlinePeer::NUM_COLUMNS - Usuarios_onlinePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Usuarios_onlinePeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Usuarios_onlinePeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Usuarios_onlinePeer::getOMClass();

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
					$temp_obj2->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios_onlines();
				$obj2->addUsuarios_online($obj1);
			}

			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCurso(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUsuarios_online($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initUsuarios_onlines();
				$obj3->addUsuarios_online($obj1);
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
		return Usuarios_onlinePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Usuarios_onlinePeer::ID_USUARIO);
			$selectCriteria->add(Usuarios_onlinePeer::ID_USUARIO, $criteria->remove(Usuarios_onlinePeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(Usuarios_onlinePeer::ID_CURSO);
			$selectCriteria->add(Usuarios_onlinePeer::ID_CURSO, $criteria->remove(Usuarios_onlinePeer::ID_CURSO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Usuarios_onlinePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Usuarios_onlinePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Usuarios_online) {

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

			$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $vals[0], Criteria::IN);
			$criteria->add(Usuarios_onlinePeer::ID_CURSO, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Usuarios_online $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Usuarios_onlinePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Usuarios_onlinePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Usuarios_onlinePeer::DATABASE_NAME, Usuarios_onlinePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Usuarios_onlinePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_usuario, $id_curso, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $id_usuario);
		$criteria->add(Usuarios_onlinePeer::ID_CURSO, $id_curso);
		$v = Usuarios_onlinePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseUsuarios_onlinePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Usuarios_onlineMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Usuarios_onlineMapBuilder');
}