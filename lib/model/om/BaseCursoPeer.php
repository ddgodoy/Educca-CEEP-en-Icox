<?php


abstract class BaseCursoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'curso';

	
	const CLASS_DEFAULT = 'lib.model.Curso';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'curso.ID';

	
	const NOMBRE = 'curso.NOMBRE';

	
	const INFORMACION_EXTENDIDA = 'curso.INFORMACION_EXTENDIDA';

	
	const FECHA_INICIO = 'curso.FECHA_INICIO';

	
	const FECHA_FIN = 'curso.FECHA_FIN';

	
	const SCAN = 'curso.SCAN';

	
	const DURACION = 'curso.DURACION';

	
	const PRECIO = 'curso.PRECIO';

	
	const MENSUAL = 'curso.MENSUAL';

	
	const MATERIA_ID = 'curso.MATERIA_ID';

	
	const MENU_INFO = 'curso.MENU_INFO';

	
	const MENU_BIBLIO = 'curso.MENU_BIBLIO';

	
	const MENU_TEMARIO = 'curso.MENU_TEMARIO';

	
	const MENU_SEGUIMIENTO = 'curso.MENU_SEGUIMIENTO';

	
	const MENU_EVENTOS = 'curso.MENU_EVENTOS';

	
	const MENU_CHAT = 'curso.MENU_CHAT';

	
	const MENU_FORO = 'curso.MENU_FORO';

	
	const MENU_EJERCICIOS = 'curso.MENU_EJERCICIOS';

	
	const MENU_PLANIFICACION_ALUMNOS = 'curso.MENU_PLANIFICACION_ALUMNOS';

	
	const MENU_BIBLIOTECA_ARCHIVOS = 'curso.MENU_BIBLIOTECA_ARCHIVOS';

	
	const CREATED_AT = 'curso.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Nombre', 'InformacionExtendida', 'FechaInicio', 'FechaFin', 'Scan', 'Duracion', 'Precio', 'Mensual', 'MateriaId', 'MenuInfo', 'MenuBiblio', 'MenuTemario', 'MenuSeguimiento', 'MenuEventos', 'MenuChat', 'MenuForo', 'MenuEjercicios', 'MenuPlanificacionAlumnos', 'MenuBibliotecaArchivos', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (CursoPeer::ID, CursoPeer::NOMBRE, CursoPeer::INFORMACION_EXTENDIDA, CursoPeer::FECHA_INICIO, CursoPeer::FECHA_FIN, CursoPeer::SCAN, CursoPeer::DURACION, CursoPeer::PRECIO, CursoPeer::MENSUAL, CursoPeer::MATERIA_ID, CursoPeer::MENU_INFO, CursoPeer::MENU_BIBLIO, CursoPeer::MENU_TEMARIO, CursoPeer::MENU_SEGUIMIENTO, CursoPeer::MENU_EVENTOS, CursoPeer::MENU_CHAT, CursoPeer::MENU_FORO, CursoPeer::MENU_EJERCICIOS, CursoPeer::MENU_PLANIFICACION_ALUMNOS, CursoPeer::MENU_BIBLIOTECA_ARCHIVOS, CursoPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'nombre', 'informacion_extendida', 'fecha_inicio', 'fecha_fin', 'scan', 'duracion', 'precio', 'mensual', 'materia_id', 'menu_info', 'menu_biblio', 'menu_temario', 'menu_seguimiento', 'menu_eventos', 'menu_chat', 'menu_foro', 'menu_ejercicios', 'menu_planificacion_alumnos', 'menu_biblioteca_archivos', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Nombre' => 1, 'InformacionExtendida' => 2, 'FechaInicio' => 3, 'FechaFin' => 4, 'Scan' => 5, 'Duracion' => 6, 'Precio' => 7, 'Mensual' => 8, 'MateriaId' => 9, 'MenuInfo' => 10, 'MenuBiblio' => 11, 'MenuTemario' => 12, 'MenuSeguimiento' => 13, 'MenuEventos' => 14, 'MenuChat' => 15, 'MenuForo' => 16, 'MenuEjercicios' => 17, 'MenuPlanificacionAlumnos' => 18, 'MenuBibliotecaArchivos' => 19, 'CreatedAt' => 20, ),
		BasePeer::TYPE_COLNAME => array (CursoPeer::ID => 0, CursoPeer::NOMBRE => 1, CursoPeer::INFORMACION_EXTENDIDA => 2, CursoPeer::FECHA_INICIO => 3, CursoPeer::FECHA_FIN => 4, CursoPeer::SCAN => 5, CursoPeer::DURACION => 6, CursoPeer::PRECIO => 7, CursoPeer::MENSUAL => 8, CursoPeer::MATERIA_ID => 9, CursoPeer::MENU_INFO => 10, CursoPeer::MENU_BIBLIO => 11, CursoPeer::MENU_TEMARIO => 12, CursoPeer::MENU_SEGUIMIENTO => 13, CursoPeer::MENU_EVENTOS => 14, CursoPeer::MENU_CHAT => 15, CursoPeer::MENU_FORO => 16, CursoPeer::MENU_EJERCICIOS => 17, CursoPeer::MENU_PLANIFICACION_ALUMNOS => 18, CursoPeer::MENU_BIBLIOTECA_ARCHIVOS => 19, CursoPeer::CREATED_AT => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'nombre' => 1, 'informacion_extendida' => 2, 'fecha_inicio' => 3, 'fecha_fin' => 4, 'scan' => 5, 'duracion' => 6, 'precio' => 7, 'mensual' => 8, 'materia_id' => 9, 'menu_info' => 10, 'menu_biblio' => 11, 'menu_temario' => 12, 'menu_seguimiento' => 13, 'menu_eventos' => 14, 'menu_chat' => 15, 'menu_foro' => 16, 'menu_ejercicios' => 17, 'menu_planificacion_alumnos' => 18, 'menu_biblioteca_archivos' => 19, 'created_at' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/CursoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.CursoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CursoPeer::getTableMap();
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
		return str_replace(CursoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CursoPeer::ID);

		$criteria->addSelectColumn(CursoPeer::NOMBRE);

		$criteria->addSelectColumn(CursoPeer::INFORMACION_EXTENDIDA);

		$criteria->addSelectColumn(CursoPeer::FECHA_INICIO);

		$criteria->addSelectColumn(CursoPeer::FECHA_FIN);

		$criteria->addSelectColumn(CursoPeer::SCAN);

		$criteria->addSelectColumn(CursoPeer::DURACION);

		$criteria->addSelectColumn(CursoPeer::PRECIO);

		$criteria->addSelectColumn(CursoPeer::MENSUAL);

		$criteria->addSelectColumn(CursoPeer::MATERIA_ID);

		$criteria->addSelectColumn(CursoPeer::MENU_INFO);

		$criteria->addSelectColumn(CursoPeer::MENU_BIBLIO);

		$criteria->addSelectColumn(CursoPeer::MENU_TEMARIO);

		$criteria->addSelectColumn(CursoPeer::MENU_SEGUIMIENTO);

		$criteria->addSelectColumn(CursoPeer::MENU_EVENTOS);

		$criteria->addSelectColumn(CursoPeer::MENU_CHAT);

		$criteria->addSelectColumn(CursoPeer::MENU_FORO);

		$criteria->addSelectColumn(CursoPeer::MENU_EJERCICIOS);

		$criteria->addSelectColumn(CursoPeer::MENU_PLANIFICACION_ALUMNOS);

		$criteria->addSelectColumn(CursoPeer::MENU_BIBLIOTECA_ARCHIVOS);

		$criteria->addSelectColumn(CursoPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(curso.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT curso.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CursoPeer::doSelectRS($criteria, $con);
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
		$objects = CursoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CursoPeer::populateObjects(CursoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CursoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CursoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinMateria(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CursoPeer::MATERIA_ID, MateriaPeer::ID);

		$rs = CursoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinMateria(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CursoPeer::addSelectColumns($c);
		$startcol = (CursoPeer::NUM_COLUMNS - CursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MateriaPeer::addSelectColumns($c);

		$c->addJoin(CursoPeer::MATERIA_ID, MateriaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CursoPeer::getOMClass();

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
										$temp_obj2->addCurso($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCursos();
				$obj2->addCurso($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CursoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CursoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CursoPeer::MATERIA_ID, MateriaPeer::ID);

		$rs = CursoPeer::doSelectRS($criteria, $con);
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

		CursoPeer::addSelectColumns($c);
		$startcol2 = (CursoPeer::NUM_COLUMNS - CursoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MateriaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MateriaPeer::NUM_COLUMNS;

		$c->addJoin(CursoPeer::MATERIA_ID, MateriaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CursoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = MateriaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMateria(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCurso($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCursos();
				$obj2->addCurso($obj1);
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
		return CursoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(CursoPeer::ID); 

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
			$comparison = $criteria->getComparison(CursoPeer::ID);
			$selectCriteria->add(CursoPeer::ID, $criteria->remove(CursoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CursoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CursoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Curso) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CursoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Curso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CursoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CursoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CursoPeer::DATABASE_NAME, CursoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CursoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CursoPeer::DATABASE_NAME);

		$criteria->add(CursoPeer::ID, $pk);


		$v = CursoPeer::doSelect($criteria, $con);

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
			$criteria->add(CursoPeer::ID, $pks, Criteria::IN);
			$objs = CursoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCursoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/CursoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.CursoMapBuilder');
}
