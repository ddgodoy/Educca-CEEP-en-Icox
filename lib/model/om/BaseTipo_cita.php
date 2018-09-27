<?php


abstract class BaseTipo_cita extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $descripcion;


	
	protected $clase;


	
	protected $created_at;

	
	protected $collEventos;

	
	protected $lastEventoCriteria = null;

	
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

	
	public function getClase()
	{

		return $this->clase;
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
			$this->modifiedColumns[] = Tipo_citaPeer::ID;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = Tipo_citaPeer::DESCRIPCION;
		}

	} 
	
	public function setClase($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->clase !== $v) {
			$this->clase = $v;
			$this->modifiedColumns[] = Tipo_citaPeer::CLASE;
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
			$this->modifiedColumns[] = Tipo_citaPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->descripcion = $rs->getString($startcol + 1);

			$this->clase = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tipo_cita object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Tipo_citaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Tipo_citaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(Tipo_citaPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Tipo_citaPeer::DATABASE_NAME);
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
					$pk = Tipo_citaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Tipo_citaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventos !== null) {
				foreach($this->collEventos as $referrerFK) {
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


			if (($retval = Tipo_citaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventos !== null) {
					foreach($this->collEventos as $referrerFK) {
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
		$pos = Tipo_citaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getClase();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Tipo_citaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescripcion(),
			$keys[2] => $this->getClase(),
			$keys[3] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Tipo_citaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setClase($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Tipo_citaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClase($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Tipo_citaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Tipo_citaPeer::ID)) $criteria->add(Tipo_citaPeer::ID, $this->id);
		if ($this->isColumnModified(Tipo_citaPeer::DESCRIPCION)) $criteria->add(Tipo_citaPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(Tipo_citaPeer::CLASE)) $criteria->add(Tipo_citaPeer::CLASE, $this->clase);
		if ($this->isColumnModified(Tipo_citaPeer::CREATED_AT)) $criteria->add(Tipo_citaPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Tipo_citaPeer::DATABASE_NAME);

		$criteria->add(Tipo_citaPeer::ID, $this->id);

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

		$copyObj->setClase($this->clase);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventos() as $relObj) {
				$copyObj->addEvento($relObj->copy($deepCopy));
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
			self::$peer = new Tipo_citaPeer();
		}
		return self::$peer;
	}

	
	public function initEventos()
	{
		if ($this->collEventos === null) {
			$this->collEventos = array();
		}
	}

	
	public function getEventos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
			   $this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

				EventoPeer::addSelectColumns($criteria);
				$this->collEventos = EventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

				EventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
					$this->collEventos = EventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventoCriteria = $criteria;
		return $this->collEventos;
	}

	
	public function countEventos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

		return EventoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvento(Evento $l)
	{
		$this->collEventos[] = $l;
		$l->setTipo_cita($this);
	}


	
	public function getEventosJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
				$this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

				$this->collEventos = EventoPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

			if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
				$this->collEventos = EventoPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastEventoCriteria = $criteria;

		return $this->collEventos;
	}


	
	public function getEventosJoinTipo_evento($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
				$this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

				$this->collEventos = EventoPeer::doSelectJoinTipo_evento($criteria, $con);
			}
		} else {
									
			$criteria->add(EventoPeer::ID_TIPO_CITA, $this->getId());

			if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
				$this->collEventos = EventoPeer::doSelectJoinTipo_evento($criteria, $con);
			}
		}
		$this->lastEventoCriteria = $criteria;

		return $this->collEventos;
	}

} 