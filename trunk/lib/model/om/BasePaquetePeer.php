<?php


abstract class BasePaquetePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'paquete';

	
	const CLASS_DEFAULT = 'lib.model.Paquete';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'paquete.ID';

	
	const NOMBRE = 'paquete.NOMBRE';

	
	const FECHA_INICIO = 'paquete.FECHA_INICIO';

	
	const FECHA_FIN = 'paquete.FECHA_FIN';

	
	const WEBCAM = 'paquete.WEBCAM';

	
	const SCAN = 'paquete.SCAN';

	
	const DURACION = 'paquete.DURACION';

	
	const PRECIO = 'paquete.PRECIO';

	
	const MENSUAL = 'paquete.MENSUAL';

	
	const DESCRIPCION = 'paquete.DESCRIPCION';

	
	const CREATED_AT = 'paquete.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Nombre', 'FechaInicio', 'FechaFin', 'Webcam', 'Scan', 'Duracion', 'Precio', 'Mensual', 'Descripcion', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (PaquetePeer::ID, PaquetePeer::NOMBRE, PaquetePeer::FECHA_INICIO, PaquetePeer::FECHA_FIN, PaquetePeer::WEBCAM, PaquetePeer::SCAN, PaquetePeer::DURACION, PaquetePeer::PRECIO, PaquetePeer::MENSUAL, PaquetePeer::DESCRIPCION, PaquetePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'nombre', 'fecha_inicio', 'fecha_fin', 'webcam', 'scan', 'duracion', 'precio', 'mensual', 'descripcion', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Nombre' => 1, 'FechaInicio' => 2, 'FechaFin' => 3, 'Webcam' => 4, 'Scan' => 5, 'Duracion' => 6, 'Precio' => 7, 'Mensual' => 8, 'Descripcion' => 9, 'CreatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (PaquetePeer::ID => 0, PaquetePeer::NOMBRE => 1, PaquetePeer::FECHA_INICIO => 2, PaquetePeer::FECHA_FIN => 3, PaquetePeer::WEBCAM => 4, PaquetePeer::SCAN => 5, PaquetePeer::DURACION => 6, PaquetePeer::PRECIO => 7, PaquetePeer::MENSUAL => 8, PaquetePeer::DESCRIPCION => 9, PaquetePeer::CREATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'nombre' => 1, 'fecha_inicio' => 2, 'fecha_fin' => 3, 'webcam' => 4, 'scan' => 5, 'duracion' => 6, 'precio' => 7, 'mensual' => 8, 'descripcion' => 9, 'created_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PaqueteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PaqueteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PaquetePeer::getTableMap();
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
		return str_replace(PaquetePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PaquetePeer::ID);

		$criteria->addSelectColumn(PaquetePeer::NOMBRE);

		$criteria->addSelectColumn(PaquetePeer::FECHA_INICIO);

		$criteria->addSelectColumn(PaquetePeer::FECHA_FIN);

		$criteria->addSelectColumn(PaquetePeer::WEBCAM);

		$criteria->addSelectColumn(PaquetePeer::SCAN);

		$criteria->addSelectColumn(PaquetePeer::DURACION);

		$criteria->addSelectColumn(PaquetePeer::PRECIO);

		$criteria->addSelectColumn(PaquetePeer::MENSUAL);

		$criteria->addSelectColumn(PaquetePeer::DESCRIPCION);

		$criteria->addSelectColumn(PaquetePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(paquete.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT paquete.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PaquetePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PaquetePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PaquetePeer::doSelectRS($criteria, $con);
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
		$objects = PaquetePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PaquetePeer::populateObjects(PaquetePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PaquetePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PaquetePeer::getOMClass();
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
		return PaquetePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PaquetePeer::ID); 

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
			$comparison = $criteria->getComparison(PaquetePeer::ID);
			$selectCriteria->add(PaquetePeer::ID, $criteria->remove(PaquetePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PaquetePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PaquetePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Paquete) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PaquetePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Paquete $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PaquetePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PaquetePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PaquetePeer::DATABASE_NAME, PaquetePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PaquetePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PaquetePeer::DATABASE_NAME);

		$criteria->add(PaquetePeer::ID, $pk);


		$v = PaquetePeer::doSelect($criteria, $con);

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
			$criteria->add(PaquetePeer::ID, $pks, Criteria::IN);
			$objs = PaquetePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePaquetePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PaqueteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PaqueteMapBuilder');
}
