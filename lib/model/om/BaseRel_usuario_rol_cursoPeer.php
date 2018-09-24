<?php


abstract class BaseRel_usuario_rol_cursoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'rel_usuario_rol_curso';

	
	const CLASS_DEFAULT = 'lib.model.Rel_usuario_rol_curso';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	const ID_USUARIO = 'rel_usuario_rol_curso.ID_USUARIO';

	
	const ID_ROL = 'rel_usuario_rol_curso.ID_ROL';

	
	const ID_CURSO = 'rel_usuario_rol_curso.ID_CURSO';

	
	const CAL_DIAS_ANTES = 'rel_usuario_rol_curso.CAL_DIAS_ANTES';

	
	const CAL_DIAS_DESPUES = 'rel_usuario_rol_curso.CAL_DIAS_DESPUES';

	
	const CREATED_AT = 'rel_usuario_rol_curso.CREATED_AT';

	
	const PRESENCIAL = 'rel_usuario_rol_curso.PRESENCIAL';
	

	const TRIPARTITA = 'rel_usuario_rol_curso.TRIPARTITA';

	
	const FECHA_PRIMER_CONEX = 'rel_usuario_rol_curso.FECHA_PRIMER_CONEX';

	
	const FECHA_ULTIMA_CONEX = 'rel_usuario_rol_curso.FECHA_ULTIMA_CONEX';

	
	private static $phpNameMap = null;


	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdRol', 'IdCurso', 'CalDiasAntes', 'CalDiasDespues', 'CreatedAt', 'Presencial', 'Tripartita', 'FechaPrimerConex', 'FechaUltimaConex',),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_rol_cursoPeer::ID_USUARIO, Rel_usuario_rol_cursoPeer::ID_ROL, Rel_usuario_rol_cursoPeer::ID_CURSO, Rel_usuario_rol_cursoPeer::CAL_DIAS_ANTES, Rel_usuario_rol_cursoPeer::CAL_DIAS_DESPUES, Rel_usuario_rol_cursoPeer::CREATED_AT, Rel_usuario_rol_cursoPeer::PRESENCIAL, Rel_usuario_rol_cursoPeer::TRIPARTITA, Rel_usuario_rol_cursoPeer::FECHA_PRIMER_CONEX, Rel_usuario_rol_cursoPeer::FECHA_ULTIMA_CONEX, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_rol', 'id_curso', 'cal_dias_antes', 'cal_dias_despues', 'created_at', 'presencial', 'tripartita',  
			'fecha_primer_conex', 'fecha_ultima_conex', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6,7,8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdRol' => 1, 'IdCurso' => 2, 'CalDiasAntes' => 3, 'CalDiasDespues' => 4, 'CreatedAt' => 5, 'Presencial' => 6, 'Tripartita' => 7, 'FechaPrimerConex' => 8, 'FechaUltimaConex' => 9,),
		BasePeer::TYPE_COLNAME => array (Rel_usuario_rol_cursoPeer::ID_USUARIO => 0, Rel_usuario_rol_cursoPeer::ID_ROL => 1, Rel_usuario_rol_cursoPeer::ID_CURSO => 2, Rel_usuario_rol_cursoPeer::CAL_DIAS_ANTES => 3, Rel_usuario_rol_cursoPeer::CAL_DIAS_DESPUES => 4, Rel_usuario_rol_cursoPeer::CREATED_AT => 5, Rel_usuario_rol_cursoPeer::PRESENCIAL => 6, Rel_usuario_rol_cursoPeer::TRIPARTITA  => 7, Rel_usuario_rol_cursoPeer::FECHA_PRIMER_CONEX  => 8, Rel_usuario_rol_cursoPeer::FECHA_ULTIMA_CONEX  => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_rol' => 1, 'id_curso' => 2, 'cal_dias_antes' => 3, 'cal_dias_despues' => 4, 'created_at' => 5, 'presencial' => 6, 'tripartita' => 7, 'fecha_primer_conex' => 8, 'fecha_ultima_conex' => 9,),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6,7,8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Rel_usuario_rol_cursoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Rel_usuario_rol_cursoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Rel_usuario_rol_cursoPeer::getTableMap();
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
		return str_replace(Rel_usuario_rol_cursoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::ID_ROL);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::ID_CURSO);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::CAL_DIAS_ANTES);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::CAL_DIAS_DESPUES);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::CREATED_AT);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::PRESENCIAL);

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::TRIPARTITA );

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::FECHA_PRIMER_CONEX );

		$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::FECHA_ULTIMA_CONEX );

	}

	const COUNT = 'COUNT(rel_usuario_rol_curso.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT rel_usuario_rol_curso.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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
		$objects = Rel_usuario_rol_cursoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Rel_usuario_rol_cursoPeer::populateObjects(Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Rel_usuario_rol_cursoPeer::getOMClass();
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_rol_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1); 			}
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RolPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_rol_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1); 			}
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

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
										$temp_obj2->addRel_usuario_rol_curso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		RolPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();


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
					$temp_obj2->addRel_usuario_rol_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1);
			}


					
			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRol(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRel_usuario_rol_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_rol_cursos();
				$obj3->addRel_usuario_rol_curso($obj1);
			}


					
			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCurso(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRel_usuario_rol_curso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRel_usuario_rol_cursos();
				$obj4->addRel_usuario_rol_curso($obj1);
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Rel_usuario_rol_cursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$rs = Rel_usuario_rol_cursoPeer::doSelectRS($criteria, $con);
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RolPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RolPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRol(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1);
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
					$temp_obj3->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_rol_cursos();
				$obj3->addRel_usuario_rol_curso($obj1);
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

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
					$temp_obj2->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1);
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
					$temp_obj3->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_rol_cursos();
				$obj3->addRel_usuario_rol_curso($obj1);
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

		Rel_usuario_rol_cursoPeer::addSelectColumns($c);
		$startcol2 = (Rel_usuario_rol_cursoPeer::NUM_COLUMNS - Rel_usuario_rol_cursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		RolPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolPeer::NUM_COLUMNS;

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Rel_usuario_rol_cursoPeer::getOMClass();

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
					$temp_obj2->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRel_usuario_rol_cursos();
				$obj2->addRel_usuario_rol_curso($obj1);
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
					$temp_obj3->addRel_usuario_rol_curso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRel_usuario_rol_cursos();
				$obj3->addRel_usuario_rol_curso($obj1);
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
		return Rel_usuario_rol_cursoPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(Rel_usuario_rol_cursoPeer::ID_USUARIO);
			$selectCriteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $criteria->remove(Rel_usuario_rol_cursoPeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(Rel_usuario_rol_cursoPeer::ID_CURSO);
			$selectCriteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $criteria->remove(Rel_usuario_rol_cursoPeer::ID_CURSO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Rel_usuario_rol_cursoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Rel_usuario_rol_cursoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Rel_usuario_rol_curso) {

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

			$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $vals[0], Criteria::IN);
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Rel_usuario_rol_curso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Rel_usuario_rol_cursoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Rel_usuario_rol_cursoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Rel_usuario_rol_cursoPeer::DATABASE_NAME, Rel_usuario_rol_cursoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Rel_usuario_rol_cursoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
		$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
		$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $id_curso);
		$v = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRel_usuario_rol_cursoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Rel_usuario_rol_cursoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Rel_usuario_rol_cursoMapBuilder');
}
