<?php


abstract class BaseMensaje_chatPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'mensaje_chat';

	
	const CLASS_DEFAULT = 'lib.model.Mensaje_chat';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'mensaje_chat.ID';

	
	const ID_USUARIO = 'mensaje_chat.ID_USUARIO';

	
	const ID_CURSO = 'mensaje_chat.ID_CURSO';

	
	const MSG = 'mensaje_chat.MSG';

	
	const TIME = 'mensaje_chat.TIME';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdUsuario', 'IdCurso', 'Msg', 'Time', ),
		BasePeer::TYPE_COLNAME => array (Mensaje_chatPeer::ID, Mensaje_chatPeer::ID_USUARIO, Mensaje_chatPeer::ID_CURSO, Mensaje_chatPeer::MSG, Mensaje_chatPeer::TIME, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_usuario', 'id_curso', 'msg', 'time', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdUsuario' => 1, 'IdCurso' => 2, 'Msg' => 3, 'Time' => 4, ),
		BasePeer::TYPE_COLNAME => array (Mensaje_chatPeer::ID => 0, Mensaje_chatPeer::ID_USUARIO => 1, Mensaje_chatPeer::ID_CURSO => 2, Mensaje_chatPeer::MSG => 3, Mensaje_chatPeer::TIME => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_usuario' => 1, 'id_curso' => 2, 'msg' => 3, 'time' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Mensaje_chatMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Mensaje_chatMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Mensaje_chatPeer::getTableMap();
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
		return str_replace(Mensaje_chatPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Mensaje_chatPeer::ID);

		$criteria->addSelectColumn(Mensaje_chatPeer::ID_USUARIO);

		$criteria->addSelectColumn(Mensaje_chatPeer::ID_CURSO);

		$criteria->addSelectColumn(Mensaje_chatPeer::MSG);

		$criteria->addSelectColumn(Mensaje_chatPeer::TIME);

	}

	const COUNT = 'COUNT(mensaje_chat.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mensaje_chat.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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
		$objects = Mensaje_chatPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Mensaje_chatPeer::populateObjects(Mensaje_chatPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Mensaje_chatPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Mensaje_chatPeer::getOMClass();
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
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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

		Mensaje_chatPeer::addSelectColumns($c);
		$startcol = (Mensaje_chatPeer::NUM_COLUMNS - Mensaje_chatPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Mensaje_chatPeer::getOMClass();

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
										$temp_obj2->addMensaje_chat($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensaje_chats();
				$obj2->addMensaje_chat($obj1); 			}
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

		Mensaje_chatPeer::addSelectColumns($c);
		$startcol = (Mensaje_chatPeer::NUM_COLUMNS - Mensaje_chatPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CursoPeer::addSelectColumns($c);

		$c->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Mensaje_chatPeer::getOMClass();

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
										$temp_obj2->addMensaje_chat($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMensaje_chats();
				$obj2->addMensaje_chat($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);

		$criteria->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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

		Mensaje_chatPeer::addSelectColumns($c);
		$startcol2 = (Mensaje_chatPeer::NUM_COLUMNS - Mensaje_chatPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		CursoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);

		$c->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Mensaje_chatPeer::getOMClass();


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
					$temp_obj2->addMensaje_chat($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMensaje_chats();
				$obj2->addMensaje_chat($obj1);
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
					$temp_obj3->addMensaje_chat($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initMensaje_chats();
				$obj3->addMensaje_chat($obj1);
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
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Mensaje_chatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);

		$rs = Mensaje_chatPeer::doSelectRS($criteria, $con);
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

		Mensaje_chatPeer::addSelectColumns($c);
		$startcol2 = (Mensaje_chatPeer::NUM_COLUMNS - Mensaje_chatPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CursoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CursoPeer::NUM_COLUMNS;

		$c->addJoin(Mensaje_chatPeer::ID_CURSO, CursoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Mensaje_chatPeer::getOMClass();

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
					$temp_obj2->addMensaje_chat($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensaje_chats();
				$obj2->addMensaje_chat($obj1);
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

		Mensaje_chatPeer::addSelectColumns($c);
		$startcol2 = (Mensaje_chatPeer::NUM_COLUMNS - Mensaje_chatPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(Mensaje_chatPeer::ID_USUARIO, UsuarioPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Mensaje_chatPeer::getOMClass();

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
					$temp_obj2->addMensaje_chat($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMensaje_chats();
				$obj2->addMensaje_chat($obj1);
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
		return Mensaje_chatPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(Mensaje_chatPeer::ID); 

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
			$comparison = $criteria->getComparison(Mensaje_chatPeer::ID);
			$selectCriteria->add(Mensaje_chatPeer::ID, $criteria->remove(Mensaje_chatPeer::ID), $comparison);

			$comparison = $criteria->getComparison(Mensaje_chatPeer::ID_USUARIO);
			$selectCriteria->add(Mensaje_chatPeer::ID_USUARIO, $criteria->remove(Mensaje_chatPeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(Mensaje_chatPeer::ID_CURSO);
			$selectCriteria->add(Mensaje_chatPeer::ID_CURSO, $criteria->remove(Mensaje_chatPeer::ID_CURSO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(Mensaje_chatPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Mensaje_chatPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Mensaje_chat) {

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
				$vals[2][] = $value[2];
			}

			$criteria->add(Mensaje_chatPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(Mensaje_chatPeer::ID_USUARIO, $vals[1], Criteria::IN);
			$criteria->add(Mensaje_chatPeer::ID_CURSO, $vals[2], Criteria::IN);
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

	
	public static function doValidate(Mensaje_chat $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Mensaje_chatPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Mensaje_chatPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Mensaje_chatPeer::DATABASE_NAME, Mensaje_chatPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Mensaje_chatPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $id_usuario, $id_curso, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Mensaje_chatPeer::ID, $id);
		$criteria->add(Mensaje_chatPeer::ID_USUARIO, $id_usuario);
		$criteria->add(Mensaje_chatPeer::ID_CURSO, $id_curso);
		$v = Mensaje_chatPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseMensaje_chatPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Mensaje_chatMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Mensaje_chatMapBuilder');
}
