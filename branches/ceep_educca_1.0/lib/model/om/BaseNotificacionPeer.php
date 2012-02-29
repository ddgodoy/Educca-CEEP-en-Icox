<?php


abstract class BaseNotificacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'notificacion';

	
	const CLASS_DEFAULT = 'lib.model.Notificacion';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'notificacion.ID';

	
	const ID_USUARIO = 'notificacion.ID_USUARIO';

	
	const ID_CURSO = 'notificacion.ID_CURSO';

	
	const ID_TEMA = 'notificacion.ID_TEMA';

	
	const TIPO = 'notificacion.TIPO';

	
	const TITULO = 'notificacion.TITULO';

	
	const CONTENIDO = 'notificacion.CONTENIDO';

	
	const FECHA = 'notificacion.FECHA';

	
	const CREATED_AT = 'notificacion.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdUsuario', 'IdCurso', 'IdTema', 'Tipo', 'Titulo', 'Contenido', 'Fecha', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (NotificacionPeer::ID, NotificacionPeer::ID_USUARIO, NotificacionPeer::ID_CURSO, NotificacionPeer::ID_TEMA, NotificacionPeer::TIPO, NotificacionPeer::TITULO, NotificacionPeer::CONTENIDO, NotificacionPeer::FECHA, NotificacionPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_usuario', 'id_curso', 'id_tema', 'tipo', 'titulo', 'contenido', 'fecha', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdUsuario' => 1, 'IdCurso' => 2, 'IdTema' => 3, 'Tipo' => 4, 'Titulo' => 5, 'Contenido' => 6, 'Fecha' => 7, 'CreatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (NotificacionPeer::ID => 0, NotificacionPeer::ID_USUARIO => 1, NotificacionPeer::ID_CURSO => 2, NotificacionPeer::ID_TEMA => 3, NotificacionPeer::TIPO => 4, NotificacionPeer::TITULO => 5, NotificacionPeer::CONTENIDO => 6, NotificacionPeer::FECHA => 7, NotificacionPeer::CREATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_usuario' => 1, 'id_curso' => 2, 'id_tema' => 3, 'tipo' => 4, 'titulo' => 5, 'contenido' => 6, 'fecha' => 7, 'created_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/NotificacionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.NotificacionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = NotificacionPeer::getTableMap();
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
		return str_replace(NotificacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(NotificacionPeer::ID);

		$criteria->addSelectColumn(NotificacionPeer::ID_USUARIO);

		$criteria->addSelectColumn(NotificacionPeer::ID_CURSO);

		$criteria->addSelectColumn(NotificacionPeer::ID_TEMA);

		$criteria->addSelectColumn(NotificacionPeer::TIPO);

		$criteria->addSelectColumn(NotificacionPeer::TITULO);

		$criteria->addSelectColumn(NotificacionPeer::CONTENIDO);

		$criteria->addSelectColumn(NotificacionPeer::FECHA);

		$criteria->addSelectColumn(NotificacionPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(notificacion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT notificacion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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
		$objects = NotificacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return NotificacionPeer::populateObjects(NotificacionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			NotificacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = NotificacionPeer::getOMClass();
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
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTema(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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

		NotificacionPeer::addSelectColumns($c);
		$startcol = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

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
										$temp_obj2->addNotificacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1); 			}
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

		NotificacionPeer::addSelectColumns($c);
		$startcol = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

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
										$temp_obj2->addNotificacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTema(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotificacionPeer::addSelectColumns($c);
		$startcol = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TemaPeer::addSelectColumns($c);

		$c->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TemaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTema(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addNotificacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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

		NotificacionPeer::addSelectColumns($c);
		$startcol2 = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		TemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TemaPeer::NUM_COLUMNS;

		$c->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();


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
					$temp_obj2->addNotificacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1);
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
					$temp_obj3->addNotificacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initNotificacions();
				$obj3->addNotificacion($obj1);
			}


					
			$omClass = TemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTema(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNotificacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initNotificacions();
				$obj4->addNotificacion($obj1);
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
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTema(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotificacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotificacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$rs = NotificacionPeer::doSelectRS($criteria, $con);
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

		NotificacionPeer::addSelectColumns($c);
		$startcol2 = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		TemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TemaPeer::NUM_COLUMNS;

		$c->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

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
					$temp_obj2->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1);
			}

			$omClass = TemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTema(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotificacions();
				$obj3->addNotificacion($obj1);
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

		NotificacionPeer::addSelectColumns($c);
		$startcol2 = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TemaPeer::NUM_COLUMNS;

		$c->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(NotificacionPeer::ID_TEMA, TemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

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
					$temp_obj2->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1);
			}

			$omClass = TemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTema(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotificacions();
				$obj3->addNotificacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTema(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotificacionPeer::addSelectColumns($c);
		$startcol2 = (NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(NotificacionPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(NotificacionPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotificacionPeer::getOMClass();

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
					$temp_obj2->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotificacions();
				$obj2->addNotificacion($obj1);
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
					$temp_obj3->addNotificacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotificacions();
				$obj3->addNotificacion($obj1);
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
		return NotificacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(NotificacionPeer::ID); 

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
			$comparison = $criteria->getComparison(NotificacionPeer::ID);
			$selectCriteria->add(NotificacionPeer::ID, $criteria->remove(NotificacionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(NotificacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Notificacion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(NotificacionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Notificacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(NotificacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(NotificacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(NotificacionPeer::DATABASE_NAME, NotificacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = NotificacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(NotificacionPeer::DATABASE_NAME);

		$criteria->add(NotificacionPeer::ID, $pk);


		$v = NotificacionPeer::doSelect($criteria, $con);

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
			$criteria->add(NotificacionPeer::ID, $pks, Criteria::IN);
			$objs = NotificacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseNotificacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/NotificacionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.NotificacionMapBuilder');
}
