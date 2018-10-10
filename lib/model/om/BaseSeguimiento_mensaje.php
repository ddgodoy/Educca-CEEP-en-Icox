<?php


abstract class BaseSeguimiento_mensaje extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_profesor;


	
	protected $id_pregunta;


	
	protected $fecha_respuesta;


	
	protected $created_at;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdProfesor()
	{

		return $this->id_profesor;
	}

	
	public function getIdPregunta()
	{

		return $this->id_pregunta;
	}

	
	public function getFechaRespuesta($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_respuesta === null || $this->fecha_respuesta === '') {
			return null;
		} elseif (!is_int($this->fecha_respuesta)) {
						$ts = strtotime($this->fecha_respuesta);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_respuesta] as date/time value: " . var_export($this->fecha_respuesta, true));
			}
		} else {
			$ts = $this->fecha_respuesta;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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

	
	public function setIdProfesor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_profesor !== $v) {
			$this->id_profesor = $v;
			$this->modifiedColumns[] = Seguimiento_mensajePeer::ID_PROFESOR;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdPregunta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_pregunta !== $v) {
			$this->id_pregunta = $v;
			$this->modifiedColumns[] = Seguimiento_mensajePeer::ID_PREGUNTA;
		}

	} 
	
	public function setFechaRespuesta($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_respuesta] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_respuesta !== $ts) {
			$this->fecha_respuesta = $ts;
			$this->modifiedColumns[] = Seguimiento_mensajePeer::FECHA_RESPUESTA;
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
			$this->modifiedColumns[] = Seguimiento_mensajePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_profesor = $rs->getString($startcol + 0);

			$this->id_pregunta = $rs->getString($startcol + 1);

			$this->fecha_respuesta = $rs->getTimestamp($startcol + 2, null);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Seguimiento_mensaje object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Seguimiento_mensajePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Seguimiento_mensajePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(Seguimiento_mensajePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Seguimiento_mensajePeer::DATABASE_NAME);
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


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Seguimiento_mensajePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Seguimiento_mensajePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = Seguimiento_mensajePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Seguimiento_mensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdProfesor();
				break;
			case 1:
				return $this->getIdPregunta();
				break;
			case 2:
				return $this->getFechaRespuesta();
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
		$keys = Seguimiento_mensajePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdProfesor(),
			$keys[1] => $this->getIdPregunta(),
			$keys[2] => $this->getFechaRespuesta(),
			$keys[3] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Seguimiento_mensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdProfesor($value);
				break;
			case 1:
				$this->setIdPregunta($value);
				break;
			case 2:
				$this->setFechaRespuesta($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Seguimiento_mensajePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdProfesor($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdPregunta($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFechaRespuesta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Seguimiento_mensajePeer::DATABASE_NAME);

		if ($this->isColumnModified(Seguimiento_mensajePeer::ID_PROFESOR)) $criteria->add(Seguimiento_mensajePeer::ID_PROFESOR, $this->id_profesor);
		if ($this->isColumnModified(Seguimiento_mensajePeer::ID_PREGUNTA)) $criteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, $this->id_pregunta);
		if ($this->isColumnModified(Seguimiento_mensajePeer::FECHA_RESPUESTA)) $criteria->add(Seguimiento_mensajePeer::FECHA_RESPUESTA, $this->fecha_respuesta);
		if ($this->isColumnModified(Seguimiento_mensajePeer::CREATED_AT)) $criteria->add(Seguimiento_mensajePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Seguimiento_mensajePeer::DATABASE_NAME);

		$criteria->add(Seguimiento_mensajePeer::ID_PREGUNTA, $this->id_pregunta);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdPregunta();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdPregunta($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdProfesor($this->id_profesor);

		$copyObj->setFechaRespuesta($this->fecha_respuesta);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setIdPregunta(NULL); 
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
			self::$peer = new Seguimiento_mensajePeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdProfesor(NULL);
		} else {
			$this->setIdProfesor($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->id_profesor !== "" && $this->id_profesor !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_profesor, $con);

			
		}
		return $this->aUsuario;
	}

} 