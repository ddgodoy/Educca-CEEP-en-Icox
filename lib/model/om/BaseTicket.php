<?php

abstract class BaseTicket extends BaseObject  implements Persistent {
	
	protected static $peer;
	
	protected $id;
	
	protected $id_alumno;
	
	protected $codigo;
	protected $asunto;
	protected $mensaje;
	protected $estado;
	protected $autor;
	protected $origen;
	protected $abierto;
	protected $actualizado;
	protected $cerrado;
	
	protected $aUsuarioRelatedByIdAlumno;
	
	protected $alreadyInSave = false;
	
	protected $alreadyInValidation = false;
	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdAlumno()
	{

		return $this->id_alumno;
	}
	
	public function getCodigo() { return $this->codigo; }
	public function getAsunto() { return $this->asunto; }
	public function getMensaje() { return $this->mensaje; }
	public function getEstado() { return $this->estado; }
	public function getAutor() { return $this->autor; }
	public function getOrigen() { return $this->origen; }

	public function getAbierto($format = 'Y-m-d H:i:s')
	{
		if ($this->abierto === null || $this->abierto === '') {
			return null;
		} elseif (!is_int($this->abierto)) {
						$ts = strtotime($this->abierto);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [abierto] as date/time value: " . var_export($this->abierto, true));
			}
		} else {
			$ts = $this->abierto;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}
	
	public function getActualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->actualizado === null || $this->actualizado === '') {
			return null;
		} elseif (!is_int($this->actualizado)) {
						$ts = strtotime($this->actualizado);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [actualizado] as date/time value: " . var_export($this->actualizado, true));
			}
		} else {
			$ts = $this->actualizado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}
	
	public function getCerrado($format = 'Y-m-d H:i:s')
	{
		if ($this->cerrado === null || $this->cerrado === '') {
			return null;
		} elseif (!is_int($this->cerrado)) {
						$ts = strtotime($this->cerrado);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [cerrado] as date/time value: " . var_export($this->cerrado, true));
			}
		} else {
			$ts = $this->cerrado;
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
			$this->modifiedColumns[] = TicketPeer::ID;
		}

	} 
	
	public function setIdAlumno($v)
	{
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_alumno !== $v) {
			$this->id_alumno = $v;
			$this->modifiedColumns[] = TicketPeer::ID_ALUMNO;
		}

		if ($this->aUsuarioRelatedByIdAlumno !== null && $this->aUsuarioRelatedByIdAlumno->getId() !== $v) {
			$this->aUsuarioRelatedByIdAlumno = null;
		}
	} 
	
	public function setCodigo($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}
		if ($this->codigo !== $v) {
			$this->codigo = $v;
			$this->modifiedColumns[] = TicketPeer::CODIGO;
		}
	}
	public function setAsunto($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}
		if ($this->asunto !== $v) {
			$this->asunto = $v;
			$this->modifiedColumns[] = TicketPeer::ASUNTO;
		}
	}
	public function setMensaje($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}
		if ($this->mensaje !== $v) {
			$this->mensaje = $v;
			$this->modifiedColumns[] = TicketPeer::MENSAJE;
		}
	}
	public function setEstado($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}
		if ($this->estado !== $v) {
			$this->estado = $v;
			$this->modifiedColumns[] = TicketPeer::ESTADO;
		}
	}
	public function setAutor($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}
		if ($this->autor !== $v) {
			$this->autor = $v;
			$this->modifiedColumns[] = TicketPeer::AUTOR;
		}
	}
	public function setOrigen($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}
		if ($this->origen !== $v) {
			$this->origen = $v;
			$this->modifiedColumns[] = TicketPeer::ORIGEN;
		}
	}
	public function setAbierto($v)
	{
		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) {throw new PropelException("Unable to parse date/time value for [abierto] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->abierto !== $ts) {
			$this->abierto = $ts;
			$this->modifiedColumns[] = TicketPeer::ABIERTO;
		}
	}
	public function setActualizado($v)
	{
		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) {throw new PropelException("Unable to parse date/time value for [actualizado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->actualizado !== $ts) {
			$this->actualizado = $ts;
			$this->modifiedColumns[] = TicketPeer::ACTUALIZADO;
		}
	}
	public function setCerrado($v)
	{
		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) {throw new PropelException("Unable to parse date/time value for [cerrado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->cerrado !== $ts) {
			$this->cerrado = $ts;
			$this->modifiedColumns[] = TicketPeer::CERRADO;
		}
	}
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_alumno = $rs->getString($startcol + 1);

			$this->codigo = $rs->getString($startcol + 2);
			$this->asunto = $rs->getString($startcol + 3);
			$this->mensaje = $rs->getString($startcol + 4);
			$this->estado = $rs->getString($startcol + 5);
			$this->autor = $rs->getString($startcol + 6);
			$this->origen = $rs->getString($startcol + 7);
			$this->abierto = $rs->getTimestamp($startcol + 8, null);
			$this->actualizado = $rs->getTimestamp($startcol + 9, null);
			$this->cerrado = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ticket object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TicketPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TicketPeer::ABIERTO))
    {
      $this->setAbierto(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketPeer::DATABASE_NAME);
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

			if ($this->aUsuarioRelatedByIdAlumno !== null) {
				if ($this->aUsuarioRelatedByIdAlumno->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdAlumno->save($con);
				}
				$this->setUsuarioRelatedByIdAlumno($this->aUsuarioRelatedByIdAlumno);
			}

			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TicketPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TicketPeer::doUpdate($this, $con);
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

			if ($this->aUsuarioRelatedByIdAlumno !== null) {
				if (!$this->aUsuarioRelatedByIdAlumno->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdAlumno->getValidationFailures());
				}
			}

			if (($retval = TicketPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdAlumno();
				break;
			case 2:
				return $this->getCodigo();
				break;
			case 3:
				return $this->getAsunto();
				break;
			case 4:
				return $this->getMensaje();
				break;
			case 5:
				return $this->getEstado();
				break;
			case 6:
				return $this->getAutor();
				break;
			case 7:
				return $this->getOrigen();
				break;
			case 8:
				return $this->getAbierto();
				break;
			case 9:
				return $this->getActualizado();
				break;
			case 10:
				return $this->getCerrado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TicketPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAlumno(),
			$keys[2] => $this->getCodigo(),
			$keys[3] => $this->getAsunto(),
			$keys[4] => $this->getMensaje(),
			$keys[5] => $this->getEstado(),
			$keys[6] => $this->getAutor(),
			$keys[7] => $this->getOrigen(),
			$keys[8] => $this->getAbierto(),
			$keys[9] => $this->getActualizado(),
			$keys[10] => $this->getCerrado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdAlumno($value);
				break;
			case 2:
				$this->setCodigo($value);
				break;
			case 3:
				$this->setAsunto($value);
				break;
			case 4:
				$this->setMensaje($value);
				break;
			case 5:
				$this->setEstado($value);
				break;
			case 6:
				$this->setAutor($value);
				break;
			case 7:
				$this->setOrigen($value);
				break;
			case 8:
				$this->setAbierto($value);
				break;
			case 9:
				$this->setActualizado($value);
				break;
			case 10:
				$this->setCerrado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TicketPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAlumno($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCodigo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAsunto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMensaje($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEstado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAutor($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOrigen($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAbierto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setActualizado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCerrado($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TicketPeer::DATABASE_NAME);

		if ($this->isColumnModified(TicketPeer::ID)) $criteria->add(TicketPeer::ID, $this->id);
		if ($this->isColumnModified(TicketPeer::ID_ALUMNO)) $criteria->add(TicketPeer::ID_ALUMNO, $this->id_alumno);

		if ($this->isColumnModified(TicketPeer::CODIGO)) $criteria->add(TicketPeer::CODIGO, $this->codigo);
		if ($this->isColumnModified(TicketPeer::ASUNTO)) $criteria->add(TicketPeer::ASUNTO, $this->asunto);
		if ($this->isColumnModified(TicketPeer::MENSAJE)) $criteria->add(TicketPeer::MENSAJE, $this->mensaje);
		if ($this->isColumnModified(TicketPeer::ESTADO)) $criteria->add(TicketPeer::ESTADO, $this->estado);
		if ($this->isColumnModified(TicketPeer::AUTOR)) $criteria->add(TicketPeer::AUTOR, $this->autor);
		if ($this->isColumnModified(TicketPeer::ORIGEN)) $criteria->add(TicketPeer::ORIGEN, $this->origen);
		if ($this->isColumnModified(TicketPeer::ABIERTO)) $criteria->add(TicketPeer::ABIERTO, $this->abierto);
		if ($this->isColumnModified(TicketPeer::ACTUALIZADO)) $criteria->add(TicketPeer::ACTUALIZADO, $this->actualizado);
		if ($this->isColumnModified(TicketPeer::CERRADO)) $criteria->add(TicketPeer::CERRADO, $this->cerrado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TicketPeer::DATABASE_NAME);

		$criteria->add(TicketPeer::ID, $this->id);

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

		$copyObj->setIdAlumno($this->id_alumno);

		$copyObj->setCodigo($this->codigo);
		$copyObj->setAsunto($this->asunto);
		$copyObj->setMensaje($this->mensaje);
		$copyObj->setEstado($this->estado);
		$copyObj->setAutor($this->autor);
		$copyObj->setOrigen($this->origen);
		$copyObj->setAbierto($this->abierto);
		$copyObj->setActualizado($this->actualizado);
		$copyObj->setCerrado($this->cerrado);

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
			self::$peer = new TicketPeer();
		}
		return self::$peer;
	}

	
	public function setUsuarioRelatedByIdAlumno($v)
	{


		if ($v === null) {
			$this->setIdAlumno(NULL);
		} else {
			$this->setIdAlumno($v->getId());
		}


		$this->aUsuarioRelatedByIdAlumno = $v;
	}


	
	public function getUsuarioRelatedByIdAlumno($con = null)
	{
		if ($this->aUsuarioRelatedByIdAlumno === null && (($this->id_alumno !== "" && $this->id_alumno !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdAlumno = UsuarioPeer::retrieveByPK($this->id_alumno, $con);

			
		}
		return $this->aUsuarioRelatedByIdAlumno;
	}

} // end class