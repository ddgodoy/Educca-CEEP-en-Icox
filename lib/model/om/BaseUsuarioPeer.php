<?php


abstract class BaseUsuarioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'usuario';

	
	const CLASS_DEFAULT = 'lib.model.Usuario';

	
	const NUM_COLUMNS = 30;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'usuario.ID';

	
	const CONFIRMADO = 'usuario.CONFIRMADO';

	
	const BORRADO = 'usuario.BORRADO';

	
	const NOMBREUSUARIO = 'usuario.NOMBREUSUARIO';

	
	const SHA1_PASSWORD = 'usuario.SHA1_PASSWORD';

	
	const SALT = 'usuario.SALT';

	
	const DNI = 'usuario.DNI';

	
	const NOMBRE = 'usuario.NOMBRE';

	
	const APELLIDOS = 'usuario.APELLIDOS';

	
	const EMAIL = 'usuario.EMAIL';

	
	const EMAILSTOP = 'usuario.EMAILSTOP';

	
	const TELEFONO1 = 'usuario.TELEFONO1';

	
	const TELEFONO2 = 'usuario.TELEFONO2';

	
	const INSTITUCION = 'usuario.INSTITUCION';

	
	const DEPARTAMENTO = 'usuario.DEPARTAMENTO';

	
	const DIRECCION = 'usuario.DIRECCION';

	
	const CP = 'usuario.CP';

	
	const CIUDAD = 'usuario.CIUDAD';

	
	const PAIS_ID = 'usuario.PAIS_ID';

	
	const ULTIMOACCESO = 'usuario.ULTIMOACCESO';

	
	const ULTIMAIP = 'usuario.ULTIMAIP';

	
	const SECRETO = 'usuario.SECRETO';

	
	const CONECTADO = 'usuario.CONECTADO';

	
	const FOTO = 'usuario.FOTO';

	
	const MOROSO = 'usuario.MOROSO';

	
	const NUMCONEXION = 'usuario.NUMCONEXION';

	
	const MAT_ONLINE = 'usuario.MAT_ONLINE';

	
	const MAT_IP = 'usuario.MAT_IP';

	
	const PRESENCIAL = 'usuario.PRESENCIAL';
        
        
        const INSPECTOR = 'usuario.INSPECTOR';

	
	const CREATED_AT = 'usuario.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Confirmado', 'Borrado', 'Nombreusuario', 'Sha1Password', 'Salt', 'Dni', 'Nombre', 'Apellidos', 'Email', 'Emailstop', 'Telefono1', 'Telefono2', 'Institucion', 'Departamento', 'Direccion', 'Cp', 'Ciudad', 'PaisId', 'Ultimoacceso', 'Ultimaip', 'Secreto', 'Conectado', 'Foto', 'Moroso', 'Numconexion', 'MatOnline', 'MatIp', 'Presencial', 'Inspector', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (UsuarioPeer::ID, UsuarioPeer::CONFIRMADO, UsuarioPeer::BORRADO, UsuarioPeer::NOMBREUSUARIO, UsuarioPeer::SHA1_PASSWORD, UsuarioPeer::SALT, UsuarioPeer::DNI, UsuarioPeer::NOMBRE, UsuarioPeer::APELLIDOS, UsuarioPeer::EMAIL, UsuarioPeer::EMAILSTOP, UsuarioPeer::TELEFONO1, UsuarioPeer::TELEFONO2, UsuarioPeer::INSTITUCION, UsuarioPeer::DEPARTAMENTO, UsuarioPeer::DIRECCION, UsuarioPeer::CP, UsuarioPeer::CIUDAD, UsuarioPeer::PAIS_ID, UsuarioPeer::ULTIMOACCESO, UsuarioPeer::ULTIMAIP, UsuarioPeer::SECRETO, UsuarioPeer::CONECTADO, UsuarioPeer::FOTO, UsuarioPeer::MOROSO, UsuarioPeer::NUMCONEXION, UsuarioPeer::MAT_ONLINE, UsuarioPeer::MAT_IP, UsuarioPeer::PRESENCIAL, UsuarioPeer::INSPECTOR, UsuarioPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'confirmado', 'borrado', 'nombreusuario', 'sha1_password', 'salt', 'dni', 'nombre', 'apellidos', 'email', 'emailstop', 'telefono1', 'telefono2', 'institucion', 'departamento', 'direccion', 'cp', 'ciudad', 'pais_id', 'ultimoacceso', 'ultimaip', 'secreto', 'conectado', 'foto', 'moroso', 'numconexion', 'mat_online', 'mat_ip', 'presencial', 'inspector', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Confirmado' => 1, 'Borrado' => 2, 'Nombreusuario' => 3, 'Sha1Password' => 4, 'Salt' => 5, 'Dni' => 6, 'Nombre' => 7, 'Apellidos' => 8, 'Email' => 9, 'Emailstop' => 10, 'Telefono1' => 11, 'Telefono2' => 12, 'Institucion' => 13, 'Departamento' => 14, 'Direccion' => 15, 'Cp' => 16, 'Ciudad' => 17, 'PaisId' => 18, 'Ultimoacceso' => 19, 'Ultimaip' => 20, 'Secreto' => 21, 'Conectado' => 22, 'Foto' => 23, 'Moroso' => 24, 'Numconexion' => 25, 'MatOnline' => 26, 'MatIp' => 27, 'Presencial' => 28, 'Inspector' => 30, 'CreatedAt' => 29, ),
		BasePeer::TYPE_COLNAME => array (UsuarioPeer::ID => 0, UsuarioPeer::CONFIRMADO => 1, UsuarioPeer::BORRADO => 2, UsuarioPeer::NOMBREUSUARIO => 3, UsuarioPeer::SHA1_PASSWORD => 4, UsuarioPeer::SALT => 5, UsuarioPeer::DNI => 6, UsuarioPeer::NOMBRE => 7, UsuarioPeer::APELLIDOS => 8, UsuarioPeer::EMAIL => 9, UsuarioPeer::EMAILSTOP => 10, UsuarioPeer::TELEFONO1 => 11, UsuarioPeer::TELEFONO2 => 12, UsuarioPeer::INSTITUCION => 13, UsuarioPeer::DEPARTAMENTO => 14, UsuarioPeer::DIRECCION => 15, UsuarioPeer::CP => 16, UsuarioPeer::CIUDAD => 17, UsuarioPeer::PAIS_ID => 18, UsuarioPeer::ULTIMOACCESO => 19, UsuarioPeer::ULTIMAIP => 20, UsuarioPeer::SECRETO => 21, UsuarioPeer::CONECTADO => 22, UsuarioPeer::FOTO => 23, UsuarioPeer::MOROSO => 24, UsuarioPeer::NUMCONEXION => 25, UsuarioPeer::MAT_ONLINE => 26, UsuarioPeer::MAT_IP => 27, UsuarioPeer::PRESENCIAL => 28, UsuarioPeer::INSPECTOR => 30, UsuarioPeer::CREATED_AT => 29, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'confirmado' => 1, 'borrado' => 2, 'nombreusuario' => 3, 'sha1_password' => 4, 'salt' => 5, 'dni' => 6, 'nombre' => 7, 'apellidos' => 8, 'email' => 9, 'emailstop' => 10, 'telefono1' => 11, 'telefono2' => 12, 'institucion' => 13, 'departamento' => 14, 'direccion' => 15, 'cp' => 16, 'ciudad' => 17, 'pais_id' => 18, 'ultimoacceso' => 19, 'ultimaip' => 20, 'secreto' => 21, 'conectado' => 22, 'foto' => 23, 'moroso' => 24, 'numconexion' => 25, 'mat_online' => 26, 'mat_ip' => 27, 'presencial' => 28, 'inspector' => 30, 'created_at' => 29, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UsuarioMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UsuarioMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UsuarioPeer::getTableMap();
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
		return str_replace(UsuarioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UsuarioPeer::ID);

		$criteria->addSelectColumn(UsuarioPeer::CONFIRMADO);

		$criteria->addSelectColumn(UsuarioPeer::BORRADO);

		$criteria->addSelectColumn(UsuarioPeer::NOMBREUSUARIO);

		$criteria->addSelectColumn(UsuarioPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(UsuarioPeer::SALT);

		$criteria->addSelectColumn(UsuarioPeer::DNI);

		$criteria->addSelectColumn(UsuarioPeer::NOMBRE);

		$criteria->addSelectColumn(UsuarioPeer::APELLIDOS);

		$criteria->addSelectColumn(UsuarioPeer::EMAIL);

		$criteria->addSelectColumn(UsuarioPeer::EMAILSTOP);

		$criteria->addSelectColumn(UsuarioPeer::TELEFONO1);

		$criteria->addSelectColumn(UsuarioPeer::TELEFONO2);

		$criteria->addSelectColumn(UsuarioPeer::INSTITUCION);

		$criteria->addSelectColumn(UsuarioPeer::DEPARTAMENTO);

		$criteria->addSelectColumn(UsuarioPeer::DIRECCION);

		$criteria->addSelectColumn(UsuarioPeer::CP);

		$criteria->addSelectColumn(UsuarioPeer::CIUDAD);

		$criteria->addSelectColumn(UsuarioPeer::PAIS_ID);

		$criteria->addSelectColumn(UsuarioPeer::ULTIMOACCESO);

		$criteria->addSelectColumn(UsuarioPeer::ULTIMAIP);

		$criteria->addSelectColumn(UsuarioPeer::SECRETO);

		$criteria->addSelectColumn(UsuarioPeer::CONECTADO);

		$criteria->addSelectColumn(UsuarioPeer::FOTO);

		$criteria->addSelectColumn(UsuarioPeer::MOROSO);

		$criteria->addSelectColumn(UsuarioPeer::NUMCONEXION);

		$criteria->addSelectColumn(UsuarioPeer::MAT_ONLINE);

		$criteria->addSelectColumn(UsuarioPeer::MAT_IP);

		$criteria->addSelectColumn(UsuarioPeer::PRESENCIAL);
                
                $criteria->addSelectColumn(UsuarioPeer::INSPECTOR);

		$criteria->addSelectColumn(UsuarioPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(usuario.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT usuario.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
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
		$objects = UsuarioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UsuarioPeer::populateObjects(UsuarioPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UsuarioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UsuarioPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPais(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UsuarioPeer::PAIS_ID, PaisPeer::ID);

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPais(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPeer::addSelectColumns($c);
		$startcol = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PaisPeer::addSelectColumns($c);

		$c->addJoin(UsuarioPeer::PAIS_ID, PaisPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PaisPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPais(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsuarios();
				$obj2->addUsuario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UsuarioPeer::PAIS_ID, PaisPeer::ID);

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
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

		UsuarioPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PaisPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PaisPeer::NUM_COLUMNS;

		$c->addJoin(UsuarioPeer::PAIS_ID, PaisPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PaisPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPais(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios();
				$obj2->addUsuario($obj1);
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
		return UsuarioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UsuarioPeer::ID); 

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
			$comparison = $criteria->getComparison(UsuarioPeer::ID);
			$selectCriteria->add(UsuarioPeer::ID, $criteria->remove(UsuarioPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UsuarioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Usuario) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsuarioPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Usuario $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsuarioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsuarioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UsuarioPeer::DATABASE_NAME, UsuarioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsuarioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::ID, $pk);


		$v = UsuarioPeer::doSelect($criteria, $con);

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
			$criteria->add(UsuarioPeer::ID, $pks, Criteria::IN);
			$objs = UsuarioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUsuarioPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/UsuarioMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UsuarioMapBuilder');
}
