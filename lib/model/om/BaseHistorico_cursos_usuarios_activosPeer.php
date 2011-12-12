<?php


abstract class BaseHistorico_cursos_usuarios_activosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'historico_cursos_usuarios_activos';

	
	const CLASS_DEFAULT = 'lib.model.Historico_cursos_usuarios_activos';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'historico_cursos_usuarios_activos.ID';

	
	const ID_HISTORICO_USUARIOS_ACTIVOS = 'historico_cursos_usuarios_activos.ID_HISTORICO_USUARIOS_ACTIVOS';

	
	const ID_CURSO = 'historico_cursos_usuarios_activos.ID_CURSO';

	
	const NOMBRE = 'historico_cursos_usuarios_activos.NOMBRE';

	
	const FECHA_INICIO = 'historico_cursos_usuarios_activos.FECHA_INICIO';

	
	const FECHA_FIN = 'historico_cursos_usuarios_activos.FECHA_FIN';

	
	const DURACION = 'historico_cursos_usuarios_activos.DURACION';

	
	const PRECIO = 'historico_cursos_usuarios_activos.PRECIO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdHistoricoUsuariosActivos', 'IdCurso', 'Nombre', 'FechaInicio', 'FechaFin', 'Duracion', 'Precio', ),
		BasePeer::TYPE_COLNAME => array (Historico_cursos_usuarios_activosPeer::ID, Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, Historico_cursos_usuarios_activosPeer::ID_CURSO, Historico_cursos_usuarios_activosPeer::NOMBRE, Historico_cursos_usuarios_activosPeer::FECHA_INICIO, Historico_cursos_usuarios_activosPeer::FECHA_FIN, Historico_cursos_usuarios_activosPeer::DURACION, Historico_cursos_usuarios_activosPeer::PRECIO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_historico_usuarios_activos', 'id_curso', 'nombre', 'fecha_inicio', 'fecha_fin', 'duracion', 'precio', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdHistoricoUsuariosActivos' => 1, 'IdCurso' => 2, 'Nombre' => 3, 'FechaInicio' => 4, 'FechaFin' => 5, 'Duracion' => 6, 'Precio' => 7, ),
		BasePeer::TYPE_COLNAME => array (Historico_cursos_usuarios_activosPeer::ID => 0, Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS => 1, Historico_cursos_usuarios_activosPeer::ID_CURSO => 2, Historico_cursos_usuarios_activosPeer::NOMBRE => 3, Historico_cursos_usuarios_activosPeer::FECHA_INICIO => 4, Historico_cursos_usuarios_activosPeer::FECHA_FIN => 5, Historico_cursos_usuarios_activosPeer::DURACION => 6, Historico_cursos_usuarios_activosPeer::PRECIO => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_historico_usuarios_activos' => 1, 'id_curso' => 2, 'nombre' => 3, 'fecha_inicio' => 4, 'fecha_fin' => 5, 'duracion' => 6, 'precio' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Historico_cursos_usuarios_activosMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Historico_cursos_usuarios_activosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Historico_cursos_usuarios_activosPeer::getTableMap();
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
		return str_replace(Historico_cursos_usuarios_activosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::ID);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::ID_CURSO);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::NOMBRE);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::FECHA_INICIO);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::FECHA_FIN);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::DURACION);

		$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::PRECIO);

	}

	const COUNT = 'COUNT(historico_cursos_usuarios_activos.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT historico_cursos_usuarios_activos.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Historico_cursos_usuarios_activosPeer::doSelectRS($criteria, $con);
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
		$objects = Historico_cursos_usuarios_activosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Historico_cursos_usuarios_activosPeer::populateObjects(Historico_cursos_usuarios_activosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Historico_cursos_usuarios_activosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Historico_cursos_usuarios_activosPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinHistorico_usuarios_activos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, Historico_usuarios_activosPeer::ID);

		$rs = Historico_cursos_usuarios_activosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinHistorico_usuarios_activos(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Historico_cursos_usuarios_activosPeer::addSelectColumns($c);
		$startcol = (Historico_cursos_usuarios_activosPeer::NUM_COLUMNS - Historico_cursos_usuarios_activosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		Historico_usuarios_activosPeer::addSelectColumns($c);

		$c->addJoin(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, Historico_usuarios_activosPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Historico_cursos_usuarios_activosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = Historico_usuarios_activosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getHistorico_usuarios_activos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHistorico_cursos_usuarios_activos($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHistorico_cursos_usuarios_activoss();
				$obj2->addHistorico_cursos_usuarios_activos($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Historico_cursos_usuarios_activosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, Historico_usuarios_activosPeer::ID);

		$rs = Historico_cursos_usuarios_activosPeer::doSelectRS($criteria, $con);
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

		Historico_cursos_usuarios_activosPeer::addSelectColumns($c);
		$startcol2 = (Historico_cursos_usuarios_activosPeer::NUM_COLUMNS - Historico_cursos_usuarios_activosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		Historico_usuarios_activosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + Historico_usuarios_activosPeer::NUM_COLUMNS;

		$c->addJoin(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, Historico_usuarios_activosPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Historico_cursos_usuarios_activosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = Historico_usuarios_activosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getHistorico_usuarios_activos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHistorico_cursos_usuarios_activos($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHistorico_cursos_usuarios_activoss();
				$obj2->addHistorico_cursos_usuarios_activos($obj1);
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
		return Historico_cursos_usuarios_activosPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Historico_cursos_usuarios_activosPeer::ID); 

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
			$comparison = $criteria->getComparison(Historico_cursos_usuarios_activosPeer::ID);
			$selectCriteria->add(Historico_cursos_usuarios_activosPeer::ID, $criteria->remove(Historico_cursos_usuarios_activosPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Historico_cursos_usuarios_activosPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Historico_cursos_usuarios_activos) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Historico_cursos_usuarios_activosPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Historico_cursos_usuarios_activos $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Historico_cursos_usuarios_activosPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Historico_cursos_usuarios_activosPeer::DATABASE_NAME, Historico_cursos_usuarios_activosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Historico_cursos_usuarios_activosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);

		$criteria->add(Historico_cursos_usuarios_activosPeer::ID, $pk);


		$v = Historico_cursos_usuarios_activosPeer::doSelect($criteria, $con);

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
			$criteria->add(Historico_cursos_usuarios_activosPeer::ID, $pks, Criteria::IN);
			$objs = Historico_cursos_usuarios_activosPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHistorico_cursos_usuarios_activosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Historico_cursos_usuarios_activosMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Historico_cursos_usuarios_activosMapBuilder');
}
