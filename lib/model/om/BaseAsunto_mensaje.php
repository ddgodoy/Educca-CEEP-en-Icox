<?php


abstract class BaseAsunto_mensaje extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $descripcion;


	
	protected $nombre;

	
	protected $collMensajes;

	
	protected $lastMensajeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Asunto_mensajePeer::ID;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = Asunto_mensajePeer::DESCRIPCION;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = Asunto_mensajePeer::NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->descripcion = $rs->getString($startcol + 1);

			$this->nombre = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Asunto_mensaje object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Asunto_mensajePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Asunto_mensajePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Asunto_mensajePeer::DATABASE_NAME);
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
					$pk = Asunto_mensajePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Asunto_mensajePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collMensajes !== null) {
				foreach($this->collMensajes as $referrerFK) {
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


			if (($retval = Asunto_mensajePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMensajes !== null) {
					foreach($this->collMensajes as $referrerFK) {
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
		$pos = Asunto_mensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDescripcion();
				break;
			case 2:
				return $this->getNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Asunto_mensajePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescripcion(),
			$keys[2] => $this->getNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Asunto_mensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDescripcion($value);
				break;
			case 2:
				$this->setNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Asunto_mensajePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombre($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Asunto_mensajePeer::DATABASE_NAME);

		if ($this->isColumnModified(Asunto_mensajePeer::ID)) $criteria->add(Asunto_mensajePeer::ID, $this->id);
		if ($this->isColumnModified(Asunto_mensajePeer::DESCRIPCION)) $criteria->add(Asunto_mensajePeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(Asunto_mensajePeer::NOMBRE)) $criteria->add(Asunto_mensajePeer::NOMBRE, $this->nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Asunto_mensajePeer::DATABASE_NAME);

		$criteria->add(Asunto_mensajePeer::ID, $this->id);

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

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setNombre($this->nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getMensajes() as $relObj) {
				$copyObj->addMensaje($relObj->copy($deepCopy));
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
			self::$peer = new Asunto_mensajePeer();
		}
		return self::$peer;
	}

	
	public function initMensajes()
	{
		if ($this->collMensajes === null) {
			$this->collMensajes = array();
		}
	}

	
	public function getMensajes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
			   $this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				$this->collMensajes = MensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
					$this->collMensajes = MensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensajeCriteria = $criteria;
		return $this->collMensajes;
	}

	
	public function countMensajes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

		return MensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensaje(Mensaje $l)
	{
		$this->collMensajes[] = $l;
		$l->setAsunto_mensaje($this);
	}


	
	public function getMensajesJoinUsuarioRelatedByIdPropietario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdPropietario($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdPropietario($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinUsuarioRelatedByIdEmisor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdEmisor($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdEmisor($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinUsuarioRelatedByIdDestinatario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdDestinatario($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdDestinatario($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_ASUNTO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}

} 