<?php


abstract class BaseMensajePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'mensaje';

	
	const CLASS_DEFAULT = 'lib.model.Mensaje';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'mensaje.ID';

	
	const ID_PROPIETARIO = 'mensaje.ID_PROPIETARIO';

	
	const ID_EMISOR = 'mensaje.ID_EMISOR';

	
	const ID_DESTINATARIO = 'mensaje.ID_DESTINATARIO';

	
	const ID_CURSO = 'mensaje.ID_CURSO';

	
	const LISTA_DESTINATARIOS = 'mensaje.LISTA_DESTINATARIOS';

	
	const ID_ASUNTO = 'mensaje.ID_ASUNTO';

	
	const CONTENIDO = 'mensaje.CONTENIDO';

	
	const CREATED_AT = 'mensaje.CREATED_AT';

	
	const LEIDO = 'mensaje.LEIDO';

	
	const BORRADO = 'mensaje.BORRADO';

	
	const SUPERVISOR = 'mensaje.SUPERVISOR';

	
	const ADJUNTOS = 'mensaje.ADJUNTOS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdPropietario', 'IdEmisor', 'IdDestinatario', 'IdCurso', 'ListaDestinatarios', 'IdAsunto', 'Contenido', 'CreatedAt', 'Leido', 'Borrado', 'Supervisor', 'Adjuntos', ),
		BasePeer::TYPE_COLNAME => array (MensajePeer::ID, MensajePeer::ID_PROPIETARIO, MensajePeer::ID_EMISOR, MensajePeer::ID_DESTINATARIO, MensajePeer::ID_CURSO, MensajePeer::LISTA_DESTINATARIOS, MensajePeer::ID_ASUNTO, MensajePeer::CONTENIDO, MensajePeer::CREATED_AT, MensajePeer::LEIDO, MensajePeer::BORRADO, MensajePeer::SUPERVISOR, MensajePeer::ADJUNTOS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_propietario', 'id_emisor', 'id_destinatario', 'id_curso', 'lista_destinatarios', 'id_asunto', 'contenido', 'created_at', 'leido', 'borrado', 'supervisor', 'adjuntos', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdPropietario' => 1, 'IdEmisor' => 2, 'IdDestinatario' => 3, 'IdCurso' => 4, 'ListaDestinatarios' => 5, 'IdAsunto' => 6, 'Contenido' => 7, 'CreatedAt' => 8, 'Leido' => 9, 'Borrado' => 10, 'Supervisor' => 11, 'Adjuntos' => 12, ),
		BasePeer::TYPE_COLNAME => array (MensajePeer::ID => 0, MensajePeer::ID_PROPIETARIO => 1, MensajePeer::ID_EMISOR => 2, MensajePeer::ID_DESTINATARIO => 3, MensajePeer::ID_CURSO => 4, MensajePeer::LISTA_DESTINATARIOS => 5, MensajePeer::ID_ASUNTO => 6, MensajePeer::CONTENIDO => 7, MensajePeer::CREATED_AT => 8, MensajePeer::LEIDO => 9, MensajePeer::BORRADO => 10, MensajePeer::SUPERVISOR => 11, MensajePeer::ADJUNTOS => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_propietario' => 1, 'id_emisor' => 2, 'id_destinatario' => 3, 'id_curso' => 4, 'lista_destinatarios' => 5, 'id_asunto' => 6, 'contenido' => 7, 'created_at' => 8, 'leido' => 9, 'borrado' => 10, 'supervisor' => 11, 'adjuntos' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MensajeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MensajeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MensajePeer::getTableMap();
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
		return str_replace(MensajePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MensajePeer::ID);

		$criteria->addSelectColumn(MensajePeer::ID_PROPIETARIO);

		$criteria->addSelectColumn(MensajePeer::ID_EMISOR);

		$criteria->addSelectColumn(MensajePeer::ID_DESTINATARIO);

		$criteria->addSelectColumn(MensajePeer::ID_CURSO);

		$criteria->addSelectColumn(MensajePeer::LISTA_DESTINATARIOS);

		$criteria->addSelectColumn(MensajePeer::ID_ASUNTO);

		$criteria->addSelectColumn(MensajePeer::CONTENIDO);

		$criteria->addSelectColumn(MensajePeer::CREATED_AT);

		$criteria->addSelectColumn(MensajePeer::LEIDO);

		$criteria->addSelectColumn(MensajePeer::BORRADO);

		$criteria->addSelectColumn(MensajePeer::SUPERVISOR);

		$criteria->addSelectColumn(MensajePeer::ADJUNTOS);

	}

	const COUNT = 'COUNT(mensaje.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mensaje.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MensajePeer::doSelectRS($criteria, $con);
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
		$objects = MensajePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MensajePeer::populateObjects(MensajePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MensajePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MensajePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUsuarioRelatedByIdPropietario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUsuarioRelatedByIdEmisor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUsuarioRelatedByIdDestinatario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAsunto_mensaje(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUsuarioRelatedByIdPropietario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdPropietario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMensajeRelatedByIdPropietario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensajesRelatedByIdPropietario();
				$obj2->addMensajeRelatedByIdPropietario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUsuarioRelatedByIdEmisor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdEmisor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMensajeRelatedByIdEmisor($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensajesRelatedByIdEmisor();
				$obj2->addMensajeRelatedByIdEmisor($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUsuarioRelatedByIdDestinatario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdDestinatario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMensajeRelatedByIdDestinatario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensajesRelatedByIdDestinatario();
				$obj2->addMensajeRelatedByIdDestinatario($obj1); 			}
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

		MensajePeer::addSelectColumns($c);
		$startcol = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
										$temp_obj2->addMensaje($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensajes();
				$obj2->addMensaje($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAsunto_mensaje(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Asunto_mensajePeer::addSelectColumns($c);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Asunto_mensajePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMensaje($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensajes();
				$obj2->addMensaje($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
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

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CursoPeer::NUM_COLUMNS;

		Asunto_mensajePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + Asunto_mensajePeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdPropietario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMensajeRelatedByIdPropietario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajesRelatedByIdPropietario();
				$obj2->addMensajeRelatedByIdPropietario($obj1);
			}


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuarioRelatedByIdEmisor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensajeRelatedByIdEmisor($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajesRelatedByIdEmisor();
				$obj3->addMensajeRelatedByIdEmisor($obj1);
			}


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsuarioRelatedByIdDestinatario(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMensajeRelatedByIdDestinatario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initMensajesRelatedByIdDestinatario();
				$obj4->addMensajeRelatedByIdDestinatario($obj1);
			}


					
			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCurso(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addMensaje($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initMensajes();
				$obj5->addMensaje($obj1);
			}


					
			$omClass = Asunto_mensajePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addMensaje($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initMensajes();
				$obj6->addMensaje($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUsuarioRelatedByIdPropietario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUsuarioRelatedByIdEmisor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUsuarioRelatedByIdDestinatario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAsunto_mensaje(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MensajePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MensajePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$criteria->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$rs = MensajePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUsuarioRelatedByIdPropietario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		Asunto_mensajePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Asunto_mensajePeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
					$temp_obj2->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajes();
				$obj2->addMensaje($obj1);
			}

			$omClass = Asunto_mensajePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajes();
				$obj3->addMensaje($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuarioRelatedByIdEmisor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		Asunto_mensajePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Asunto_mensajePeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
					$temp_obj2->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajes();
				$obj2->addMensaje($obj1);
			}

			$omClass = Asunto_mensajePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajes();
				$obj3->addMensaje($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuarioRelatedByIdDestinatario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		Asunto_mensajePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + Asunto_mensajePeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
					$temp_obj2->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajes();
				$obj2->addMensaje($obj1);
			}

			$omClass = Asunto_mensajePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajes();
				$obj3->addMensaje($obj1);
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

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsuarioPeer::NUM_COLUMNS;

		Asunto_mensajePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + Asunto_mensajePeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_ASUNTO, Asunto_mensajePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdPropietario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMensajeRelatedByIdPropietario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajesRelatedByIdPropietario();
				$obj2->addMensajeRelatedByIdPropietario($obj1);
			}

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuarioRelatedByIdEmisor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensajeRelatedByIdEmisor($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajesRelatedByIdEmisor();
				$obj3->addMensajeRelatedByIdEmisor($obj1);
			}

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsuarioRelatedByIdDestinatario(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMensajeRelatedByIdDestinatario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMensajesRelatedByIdDestinatario();
				$obj4->addMensajeRelatedByIdDestinatario($obj1);
			}

			$omClass = Asunto_mensajePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getAsunto_mensaje(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initMensajes();
				$obj5->addMensaje($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAsunto_mensaje(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MensajePeer::addSelectColumns($c);
		$startcol2 = (MensajePeer::NUM_COLUMNS - MensajePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(MensajePeer::ID_PROPIETARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_EMISOR, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_DESTINATARIO, UsuarioPeer::ID);

		$c->addJoin(MensajePeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MensajePeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUsuarioRelatedByIdPropietario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMensajeRelatedByIdPropietario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensajesRelatedByIdPropietario();
				$obj2->addMensajeRelatedByIdPropietario($obj1);
			}

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuarioRelatedByIdEmisor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMensajeRelatedByIdEmisor($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMensajesRelatedByIdEmisor();
				$obj3->addMensajeRelatedByIdEmisor($obj1);
			}

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsuarioRelatedByIdDestinatario(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMensajeRelatedByIdDestinatario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMensajesRelatedByIdDestinatario();
				$obj4->addMensajeRelatedByIdDestinatario($obj1);
			}

			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCurso(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addMensaje($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initMensajes();
				$obj5->addMensaje($obj1);
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
		return MensajePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(MensajePeer::ID); 

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
			$comparison = $criteria->getComparison(MensajePeer::ID);
			$selectCriteria->add(MensajePeer::ID, $criteria->remove(MensajePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(MensajePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MensajePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Mensaje) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MensajePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Mensaje $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MensajePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MensajePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MensajePeer::DATABASE_NAME, MensajePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MensajePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MensajePeer::DATABASE_NAME);

		$criteria->add(MensajePeer::ID, $pk);


		$v = MensajePeer::doSelect($criteria, $con);

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
			$criteria->add(MensajePeer::ID, $pks, Criteria::IN);
			$objs = MensajePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseMensajePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/MensajeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MensajeMapBuilder');
}
