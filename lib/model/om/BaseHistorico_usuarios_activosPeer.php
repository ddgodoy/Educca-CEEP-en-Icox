<?php


abstract class BaseHistorico_usuarios_activosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'historico_usuarios_activos';

	
	const CLASS_DEFAULT = 'lib.model.Historico_usuarios_activos';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'historico_usuarios_activos.ID';

	
	const FECHA = 'historico_usuarios_activos.FECHA';

	
	const ID_USUARIO = 'historico_usuarios_activos.ID_USUARIO';

	
	const NOMBREUSUARIO = 'historico_usuarios_activos.NOMBREUSUARIO';

	
	const DNI = 'historico_usuarios_activos.DNI';

	
	const NOMBRE = 'historico_usuarios_activos.NOMBRE';

	
	const APELLIDOS = 'historico_usuarios_activos.APELLIDOS';

	
	const EMAIL = 'historico_usuarios_activos.EMAIL';

	
	const TELEFONO1 = 'historico_usuarios_activos.TELEFONO1';

	
	const TELEFONO2 = 'historico_usuarios_activos.TELEFONO2';

	
	const DIAS_MATRICULADO = 'historico_usuarios_activos.DIAS_MATRICULADO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Fecha', 'IdUsuario', 'Nombreusuario', 'Dni', 'Nombre', 'Apellidos', 'Email', 'Telefono1', 'Telefono2', 'DiasMatriculado', ),
		BasePeer::TYPE_COLNAME => array (Historico_usuarios_activosPeer::ID, Historico_usuarios_activosPeer::FECHA, Historico_usuarios_activosPeer::ID_USUARIO, Historico_usuarios_activosPeer::NOMBREUSUARIO, Historico_usuarios_activosPeer::DNI, Historico_usuarios_activosPeer::NOMBRE, Historico_usuarios_activosPeer::APELLIDOS, Historico_usuarios_activosPeer::EMAIL, Historico_usuarios_activosPeer::TELEFONO1, Historico_usuarios_activosPeer::TELEFONO2, Historico_usuarios_activosPeer::DIAS_MATRICULADO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'fecha', 'id_usuario', 'nombreusuario', 'dni', 'nombre', 'apellidos', 'email', 'telefono1', 'telefono2', 'dias_matriculado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Fecha' => 1, 'IdUsuario' => 2, 'Nombreusuario' => 3, 'Dni' => 4, 'Nombre' => 5, 'Apellidos' => 6, 'Email' => 7, 'Telefono1' => 8, 'Telefono2' => 9, 'DiasMatriculado' => 10, ),
		BasePeer::TYPE_COLNAME => array (Historico_usuarios_activosPeer::ID => 0, Historico_usuarios_activosPeer::FECHA => 1, Historico_usuarios_activosPeer::ID_USUARIO => 2, Historico_usuarios_activosPeer::NOMBREUSUARIO => 3, Historico_usuarios_activosPeer::DNI => 4, Historico_usuarios_activosPeer::NOMBRE => 5, Historico_usuarios_activosPeer::APELLIDOS => 6, Historico_usuarios_activosPeer::EMAIL => 7, Historico_usuarios_activosPeer::TELEFONO1 => 8, Historico_usuarios_activosPeer::TELEFONO2 => 9, Historico_usuarios_activosPeer::DIAS_MATRICULADO => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'fecha' => 1, 'id_usuario' => 2, 'nombreusuario' => 3, 'dni' => 4, 'nombre' => 5, 'apellidos' => 6, 'email' => 7, 'telefono1' => 8, 'telefono2' => 9, 'dias_matriculado' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Historico_usuarios_activosMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Historico_usuarios_activosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Historico_usuarios_activosPeer::getTableMap();
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
		return str_replace(Historico_usuarios_activosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::ID);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::FECHA);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::ID_USUARIO);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::NOMBREUSUARIO);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::DNI);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::NOMBRE);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::APELLIDOS);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::EMAIL);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::TELEFONO1);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::TELEFONO2);

		$criteria->addSelectColumn(Historico_usuarios_activosPeer::DIAS_MATRICULADO);

	}

	const COUNT = 'COUNT(historico_usuarios_activos.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT historico_usuarios_activos.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Historico_usuarios_activosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Historico_usuarios_activosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Historico_usuarios_activosPeer::doSelectRS($criteria, $con);
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
		$objects = Historico_usuarios_activosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Historico_usuarios_activosPeer::populateObjects(Historico_usuarios_activosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Historico_usuarios_activosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Historico_usuarios_activosPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return Historico_usuarios_activosPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Historico_usuarios_activosPeer::ID); 

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
			$comparison = $criteria->getComparison(Historico_usuarios_activosPeer::ID);
			$selectCriteria->add(Historico_usuarios_activosPeer::ID, $criteria->remove(Historico_usuarios_activosPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Historico_usuarios_activosPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Historico_usuarios_activosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Historico_usuarios_activos) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Historico_usuarios_activosPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Historico_usuarios_activos $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Historico_usuarios_activosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Historico_usuarios_activosPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Historico_usuarios_activosPeer::DATABASE_NAME, Historico_usuarios_activosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Historico_usuarios_activosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Historico_usuarios_activosPeer::DATABASE_NAME);

		$criteria->add(Historico_usuarios_activosPeer::ID, $pk);


		$v = Historico_usuarios_activosPeer::doSelect($criteria, $con);

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
			$criteria->add(Historico_usuarios_activosPeer::ID, $pks, Criteria::IN);
			$objs = Historico_usuarios_activosPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHistorico_usuarios_activosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Historico_usuarios_activosMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Historico_usuarios_activosMapBuilder');
}
