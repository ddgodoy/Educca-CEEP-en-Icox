<?php


abstract class BaseRol extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $created_at;

	
	protected $collRel_usuario_rol_cursos;

	
	protected $lastRel_usuario_rol_cursoCriteria = null;

	
	protected $collRel_conectado_chats;

	
	protected $lastRel_conectado_chatCriteria = null;

	
	protected $collUsuarios_onlines;

	
	protected $lastUsuarios_onlineCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RolPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = RolPeer::NOMBRE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = RolPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rol object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RolPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RolPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RolPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RolPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_usuario_rol_cursos !== null) {
				foreach($this->collRel_usuario_rol_cursos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_conectado_chats !== null) {
				foreach($this->collRel_conectado_chats as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarios_onlines !== null) {
				foreach($this->collUsuarios_onlines as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = RolPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_usuario_rol_cursos !== null) {
					foreach($this->collRel_usuario_rol_cursos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_conectado_chats !== null) {
					foreach($this->collRel_conectado_chats as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarios_onlines !== null) {
					foreach($this->collUsuarios_onlines as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		if ($this->isColumnModified(RolPeer::ID)) $criteria->add(RolPeer::ID, $this->id);
		if ($this->isColumnModified(RolPeer::NOMBRE)) $criteria->add(RolPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(RolPeer::CREATED_AT)) $criteria->add(RolPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		$criteria->add(RolPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombre($this->nombre);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_usuario_rol_cursos() as $relObj) {
				$copyObj->addRel_usuario_rol_curso($relObj->copy($deepCopy));
			}

			foreach($this->getRel_conectado_chats() as $relObj) {
				$copyObj->addRel_conectado_chat($relObj->copy($deepCopy));
			}

			foreach($this->getUsuarios_onlines() as $relObj) {
				$copyObj->addUsuarios_online($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RolPeer();
		}
		return self::$peer;
	}

	
	public function initRel_usuario_rol_cursos()
	{
		if ($this->collRel_usuario_rol_cursos === null) {
			$this->collRel_usuario_rol_cursos = array();
		}
	}

	
	public function getRel_usuario_rol_cursos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

				Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

				Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
					$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;
		return $this->collRel_usuario_rol_cursos;
	}

	
	public function countRel_usuario_rol_cursos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

		return Rel_usuario_rol_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_rol_curso(Rel_usuario_rol_curso $l)
	{
		$this->collRel_usuario_rol_cursos[] = $l;
		$l->setRol($this);
	}


	
	public function getRel_usuario_rol_cursosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
	}


	
	public function getRel_usuario_rol_cursosJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
	}

	
	public function initRel_conectado_chats()
	{
		if ($this->collRel_conectado_chats === null) {
			$this->collRel_conectado_chats = array();
		}
	}

	
	public function getRel_conectado_chats($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
			   $this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

				Rel_conectado_chatPeer::addSelectColumns($criteria);
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

				Rel_conectado_chatPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
					$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;
		return $this->collRel_conectado_chats;
	}

	
	public function countRel_conectado_chats($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

		return Rel_conectado_chatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_conectado_chat(Rel_conectado_chat $l)
	{
		$this->collRel_conectado_chats[] = $l;
		$l->setRol($this);
	}


	
	public function getRel_conectado_chatsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
				$this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;

		return $this->collRel_conectado_chats;
	}


	
	public function getRel_conectado_chatsJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
				$this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;

		return $this->collRel_conectado_chats;
	}

	
	public function initUsuarios_onlines()
	{
		if ($this->collUsuarios_onlines === null) {
			$this->collUsuarios_onlines = array();
		}
	}

	
	public function getUsuarios_onlines($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
			   $this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

				Usuarios_onlinePeer::addSelectColumns($criteria);
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

				Usuarios_onlinePeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
					$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;
		return $this->collUsuarios_onlines;
	}

	
	public function countUsuarios_onlines($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

		return Usuarios_onlinePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuarios_online(Usuarios_online $l)
	{
		$this->collUsuarios_onlines[] = $l;
		$l->setRol($this);
	}


	
	public function getUsuarios_onlinesJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
				$this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;

		return $this->collUsuarios_onlines;
	}


	
	public function getUsuarios_onlinesJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
				$this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_ROL, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;

		return $this->collUsuarios_onlines;
	}

} 