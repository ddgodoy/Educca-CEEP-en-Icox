<?php


abstract class BaseMateriaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'materia';

	
	const CLASS_DEFAULT = 'lib.model.Materia';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'materia.ID';

	
	const NOMBRE = 'materia.NOMBRE';

	
	const INFORMACION = 'materia.INFORMACION';

	
	const NORMATIVA = 'materia.NORMATIVA';

	
	const TEMAS_TOTALES = 'materia.TEMAS_TOTALES';

	
	const HEIGHT = 'materia.HEIGHT';

	
	const WIDTH = 'materia.WIDTH';

	
	const TIPO = 'materia.TIPO';

	
	const CREATED_AT = 'materia.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Nombre', 'Informacion', 'Normativa', 'TemasTotales', 'Height', 'Width', 'Tipo', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (MateriaPeer::ID, MateriaPeer::NOMBRE, MateriaPeer::INFORMACION, MateriaPeer::NORMATIVA, MateriaPeer::TEMAS_TOTALES, MateriaPeer::HEIGHT, MateriaPeer::WIDTH, MateriaPeer::TIPO, MateriaPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'nombre', 'informacion', 'normativa', 'temas_totales', 'height', 'width', 'tipo', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Nombre' => 1, 'Informacion' => 2, 'Normativa' => 3, 'TemasTotales' => 4, 'Height' => 5, 'Width' => 6, 'Tipo' => 7, 'CreatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (MateriaPeer::ID => 0, MateriaPeer::NOMBRE => 1, MateriaPeer::INFORMACION => 2, MateriaPeer::NORMATIVA => 3, MateriaPeer::TEMAS_TOTALES => 4, MateriaPeer::HEIGHT => 5, MateriaPeer::WIDTH => 6, MateriaPeer::TIPO => 7, MateriaPeer::CREATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'nombre' => 1, 'informacion' => 2, 'normativa' => 3, 'temas_totales' => 4, 'height' => 5, 'width' => 6, 'tipo' => 7, 'created_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MateriaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MateriaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MateriaPeer::getTableMap();
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
		return str_replace(MateriaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MateriaPeer::ID);

		$criteria->addSelectColumn(MateriaPeer::NOMBRE);

		$criteria->addSelectColumn(MateriaPeer::INFORMACION);

		$criteria->addSelectColumn(MateriaPeer::NORMATIVA);

		$criteria->addSelectColumn(MateriaPeer::TEMAS_TOTALES);

		$criteria->addSelectColumn(MateriaPeer::HEIGHT);

		$criteria->addSelectColumn(MateriaPeer::WIDTH);

		$criteria->addSelectColumn(MateriaPeer::TIPO);

		$criteria->addSelectColumn(MateriaPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(materia.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT materia.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MateriaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MateriaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MateriaPeer::doSelectRS($criteria, $con);
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
		$objects = MateriaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MateriaPeer::populateObjects(MateriaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MateriaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MateriaPeer::getOMClass();
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
		return MateriaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(MateriaPeer::ID); 

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
			$comparison = $criteria->getComparison(MateriaPeer::ID);
			$selectCriteria->add(MateriaPeer::ID, $criteria->remove(MateriaPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(MateriaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MateriaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Materia) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MateriaPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Materia $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MateriaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MateriaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MateriaPeer::DATABASE_NAME, MateriaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MateriaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MateriaPeer::DATABASE_NAME);

		$criteria->add(MateriaPeer::ID, $pk);


		$v = MateriaPeer::doSelect($criteria, $con);

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
			$criteria->add(MateriaPeer::ID, $pks, Criteria::IN);
			$objs = MateriaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseMateriaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/MateriaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MateriaMapBuilder');
}
