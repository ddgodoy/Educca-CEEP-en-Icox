<?php


abstract class BaseMensaje extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_propietario;


	
	protected $id_emisor;


	
	protected $id_destinatario;


	
	protected $id_curso;


	
	protected $lista_destinatarios;


	
	protected $id_asunto;


	
	protected $contenido;


	
	protected $created_at;


	
	protected $leido = 0;


	
	protected $borrado = 0;


	
	protected $supervisor = 0;


	
	protected $adjuntos = 0;

	
	protected $aUsuarioRelatedByIdPropietario;

	
	protected $aUsuarioRelatedByIdEmisor;

	
	protected $aUsuarioRelatedByIdDestinatario;

	
	protected $aCurso;

	
	protected $aAsunto_mensaje;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdPropietario()
	{

		return $this->id_propietario;
	}

	
	public function getIdEmisor()
	{

		return $this->id_emisor;
	}

	
	public function getIdDestinatario()
	{

		return $this->id_destinatario;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getListaDestinatarios()
	{

		return $this->lista_destinatarios;
	}

	
	public function getIdAsunto()
	{

		return $this->id_asunto;
	}

	
	public function getContenido()
	{

		return $this->contenido;
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

	
	public function getLeido()
	{

		return $this->leido;
	}

	
	public function getBorrado()
	{

		return $this->borrado;
	}

	
	public function getSupervisor()
	{

		return $this->supervisor;
	}

	
	public function getAdjuntos()
	{

		return $this->adjuntos;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MensajePeer::ID;
		}

	} 
	
	public function setIdPropietario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_propietario !== $v) {
			$this->id_propietario = $v;
			$this->modifiedColumns[] = MensajePeer::ID_PROPIETARIO;
		}

		if ($this->aUsuarioRelatedByIdPropietario !== null && $this->aUsuarioRelatedByIdPropietario->getId() !== $v) {
			$this->aUsuarioRelatedByIdPropietario = null;
		}

	} 
	
	public function setIdEmisor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_emisor !== $v) {
			$this->id_emisor = $v;
			$this->modifiedColumns[] = MensajePeer::ID_EMISOR;
		}

		if ($this->aUsuarioRelatedByIdEmisor !== null && $this->aUsuarioRelatedByIdEmisor->getId() !== $v) {
			$this->aUsuarioRelatedByIdEmisor = null;
		}

	} 
	
	public function setIdDestinatario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_destinatario !== $v) {
			$this->id_destinatario = $v;
			$this->modifiedColumns[] = MensajePeer::ID_DESTINATARIO;
		}

		if ($this->aUsuarioRelatedByIdDestinatario !== null && $this->aUsuarioRelatedByIdDestinatario->getId() !== $v) {
			$this->aUsuarioRelatedByIdDestinatario = null;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = MensajePeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setListaDestinatarios($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lista_destinatarios !== $v) {
			$this->lista_destinatarios = $v;
			$this->modifiedColumns[] = MensajePeer::LISTA_DESTINATARIOS;
		}

	} 
	
	public function setIdAsunto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_asunto !== $v) {
			$this->id_asunto = $v;
			$this->modifiedColumns[] = MensajePeer::ID_ASUNTO;
		}

		if ($this->aAsunto_mensaje !== null && $this->aAsunto_mensaje->getId() !== $v) {
			$this->aAsunto_mensaje = null;
		}

	} 
	
	public function setContenido($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contenido !== $v) {
			$this->contenido = $v;
			$this->modifiedColumns[] = MensajePeer::CONTENIDO;
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
			$this->modifiedColumns[] = MensajePeer::CREATED_AT;
		}

	} 
	
	public function setLeido($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->leido !== $v || $v === 0) {
			$this->leido = $v;
			$this->modifiedColumns[] = MensajePeer::LEIDO;
		}

	} 
	
	public function setBorrado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->borrado !== $v || $v === 0) {
			$this->borrado = $v;
			$this->modifiedColumns[] = MensajePeer::BORRADO;
		}

	} 
	
	public function setSupervisor($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->supervisor !== $v || $v === 0) {
			$this->supervisor = $v;
			$this->modifiedColumns[] = MensajePeer::SUPERVISOR;
		}

	} 
	
	public function setAdjuntos($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->adjuntos !== $v || $v === 0) {
			$this->adjuntos = $v;
			$this->modifiedColumns[] = MensajePeer::ADJUNTOS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_propietario = $rs->getString($startcol + 1);

			$this->id_emisor = $rs->getString($startcol + 2);

			$this->id_destinatario = $rs->getString($startcol + 3);

			$this->id_curso = $rs->getString($startcol + 4);

			$this->lista_destinatarios = $rs->getString($startcol + 5);

			$this->id_asunto = $rs->getString($startcol + 6);

			$this->contenido = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->leido = $rs->getInt($startcol + 9);

			$this->borrado = $rs->getInt($startcol + 10);

			$this->supervisor = $rs->getInt($startcol + 11);

			$this->adjuntos = $rs->getInt($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Mensaje object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MensajePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MensajePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MensajePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MensajePeer::DATABASE_NAME);
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


												
			if ($this->aUsuarioRelatedByIdPropietario !== null) {
				if ($this->aUsuarioRelatedByIdPropietario->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdPropietario->save($con);
				}
				$this->setUsuarioRelatedByIdPropietario($this->aUsuarioRelatedByIdPropietario);
			}

			if ($this->aUsuarioRelatedByIdEmisor !== null) {
				if ($this->aUsuarioRelatedByIdEmisor->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdEmisor->save($con);
				}
				$this->setUsuarioRelatedByIdEmisor($this->aUsuarioRelatedByIdEmisor);
			}

			if ($this->aUsuarioRelatedByIdDestinatario !== null) {
				if ($this->aUsuarioRelatedByIdDestinatario->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdDestinatario->save($con);
				}
				$this->setUsuarioRelatedByIdDestinatario($this->aUsuarioRelatedByIdDestinatario);
			}

			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}

			if ($this->aAsunto_mensaje !== null) {
				if ($this->aAsunto_mensaje->isModified()) {
					$affectedRows += $this->aAsunto_mensaje->save($con);
				}
				$this->setAsunto_mensaje($this->aAsunto_mensaje);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MensajePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MensajePeer::doUpdate($this, $con);
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


												
			if ($this->aUsuarioRelatedByIdPropietario !== null) {
				if (!$this->aUsuarioRelatedByIdPropietario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdPropietario->getValidationFailures());
				}
			}

			if ($this->aUsuarioRelatedByIdEmisor !== null) {
				if (!$this->aUsuarioRelatedByIdEmisor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdEmisor->getValidationFailures());
				}
			}

			if ($this->aUsuarioRelatedByIdDestinatario !== null) {
				if (!$this->aUsuarioRelatedByIdDestinatario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdDestinatario->getValidationFailures());
				}
			}

			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}

			if ($this->aAsunto_mensaje !== null) {
				if (!$this->aAsunto_mensaje->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAsunto_mensaje->getValidationFailures());
				}
			}


			if (($retval = MensajePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdPropietario();
				break;
			case 2:
				return $this->getIdEmisor();
				break;
			case 3:
				return $this->getIdDestinatario();
				break;
			case 4:
				return $this->getIdCurso();
				break;
			case 5:
				return $this->getListaDestinatarios();
				break;
			case 6:
				return $this->getIdAsunto();
				break;
			case 7:
				return $this->getContenido();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getLeido();
				break;
			case 10:
				return $this->getBorrado();
				break;
			case 11:
				return $this->getSupervisor();
				break;
			case 12:
				return $this->getAdjuntos();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MensajePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdPropietario(),
			$keys[2] => $this->getIdEmisor(),
			$keys[3] => $this->getIdDestinatario(),
			$keys[4] => $this->getIdCurso(),
			$keys[5] => $this->getListaDestinatarios(),
			$keys[6] => $this->getIdAsunto(),
			$keys[7] => $this->getContenido(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getLeido(),
			$keys[10] => $this->getBorrado(),
			$keys[11] => $this->getSupervisor(),
			$keys[12] => $this->getAdjuntos(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MensajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdPropietario($value);
				break;
			case 2:
				$this->setIdEmisor($value);
				break;
			case 3:
				$this->setIdDestinatario($value);
				break;
			case 4:
				$this->setIdCurso($value);
				break;
			case 5:
				$this->setListaDestinatarios($value);
				break;
			case 6:
				$this->setIdAsunto($value);
				break;
			case 7:
				$this->setContenido($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setLeido($value);
				break;
			case 10:
				$this->setBorrado($value);
				break;
			case 11:
				$this->setSupervisor($value);
				break;
			case 12:
				$this->setAdjuntos($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MensajePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdPropietario($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEmisor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdDestinatario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdCurso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setListaDestinatarios($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIdAsunto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setContenido($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLeido($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBorrado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSupervisor($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setAdjuntos($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MensajePeer::DATABASE_NAME);

		if ($this->isColumnModified(MensajePeer::ID)) $criteria->add(MensajePeer::ID, $this->id);
		if ($this->isColumnModified(MensajePeer::ID_PROPIETARIO)) $criteria->add(MensajePeer::ID_PROPIETARIO, $this->id_propietario);
		if ($this->isColumnModified(MensajePeer::ID_EMISOR)) $criteria->add(MensajePeer::ID_EMISOR, $this->id_emisor);
		if ($this->isColumnModified(MensajePeer::ID_DESTINATARIO)) $criteria->add(MensajePeer::ID_DESTINATARIO, $this->id_destinatario);
		if ($this->isColumnModified(MensajePeer::ID_CURSO)) $criteria->add(MensajePeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(MensajePeer::LISTA_DESTINATARIOS)) $criteria->add(MensajePeer::LISTA_DESTINATARIOS, $this->lista_destinatarios);
		if ($this->isColumnModified(MensajePeer::ID_ASUNTO)) $criteria->add(MensajePeer::ID_ASUNTO, $this->id_asunto);
		if ($this->isColumnModified(MensajePeer::CONTENIDO)) $criteria->add(MensajePeer::CONTENIDO, $this->contenido);
		if ($this->isColumnModified(MensajePeer::CREATED_AT)) $criteria->add(MensajePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MensajePeer::LEIDO)) $criteria->add(MensajePeer::LEIDO, $this->leido);
		if ($this->isColumnModified(MensajePeer::BORRADO)) $criteria->add(MensajePeer::BORRADO, $this->borrado);
		if ($this->isColumnModified(MensajePeer::SUPERVISOR)) $criteria->add(MensajePeer::SUPERVISOR, $this->supervisor);
		if ($this->isColumnModified(MensajePeer::ADJUNTOS)) $criteria->add(MensajePeer::ADJUNTOS, $this->adjuntos);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MensajePeer::DATABASE_NAME);

		$criteria->add(MensajePeer::ID, $this->id);

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

		$copyObj->setIdPropietario($this->id_propietario);

		$copyObj->setIdEmisor($this->id_emisor);

		$copyObj->setIdDestinatario($this->id_destinatario);

		$copyObj->setIdCurso($this->id_curso);

		$copyObj->setListaDestinatarios($this->lista_destinatarios);

		$copyObj->setIdAsunto($this->id_asunto);

		$copyObj->setContenido($this->contenido);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLeido($this->leido);

		$copyObj->setBorrado($this->borrado);

		$copyObj->setSupervisor($this->supervisor);

		$copyObj->setAdjuntos($this->adjuntos);


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
			self::$peer = new MensajePeer();
		}
		return self::$peer;
	}

	
	public function setUsuarioRelatedByIdPropietario($v)
	{


		if ($v === null) {
			$this->setIdPropietario(NULL);
		} else {
			$this->setIdPropietario($v->getId());
		}


		$this->aUsuarioRelatedByIdPropietario = $v;
	}


	
	public function getUsuarioRelatedByIdPropietario($con = null)
	{
		if ($this->aUsuarioRelatedByIdPropietario === null && (($this->id_propietario !== "" && $this->id_propietario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdPropietario = UsuarioPeer::retrieveByPK($this->id_propietario, $con);

			
		}
		return $this->aUsuarioRelatedByIdPropietario;
	}

	
	public function setUsuarioRelatedByIdEmisor($v)
	{


		if ($v === null) {
			$this->setIdEmisor(NULL);
		} else {
			$this->setIdEmisor($v->getId());
		}


		$this->aUsuarioRelatedByIdEmisor = $v;
	}


	
	public function getUsuarioRelatedByIdEmisor($con = null)
	{
		if ($this->aUsuarioRelatedByIdEmisor === null && (($this->id_emisor !== "" && $this->id_emisor !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdEmisor = UsuarioPeer::retrieveByPK($this->id_emisor, $con);

			
		}
		return $this->aUsuarioRelatedByIdEmisor;
	}

	
	public function setUsuarioRelatedByIdDestinatario($v)
	{


		if ($v === null) {
			$this->setIdDestinatario(NULL);
		} else {
			$this->setIdDestinatario($v->getId());
		}


		$this->aUsuarioRelatedByIdDestinatario = $v;
	}


	
	public function getUsuarioRelatedByIdDestinatario($con = null)
	{
		if ($this->aUsuarioRelatedByIdDestinatario === null && (($this->id_destinatario !== "" && $this->id_destinatario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdDestinatario = UsuarioPeer::retrieveByPK($this->id_destinatario, $con);

			
		}
		return $this->aUsuarioRelatedByIdDestinatario;
	}

	
	public function setCurso($v)
	{


		if ($v === null) {
			$this->setIdCurso(NULL);
		} else {
			$this->setIdCurso($v->getId());
		}


		$this->aCurso = $v;
	}


	
	public function getCurso($con = null)
	{
		if ($this->aCurso === null && (($this->id_curso !== "" && $this->id_curso !== null))) {
						include_once 'lib/model/om/BaseCursoPeer.php';

			$this->aCurso = CursoPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aCurso;
	}

	
	public function setAsunto_mensaje($v)
	{


		if ($v === null) {
			$this->setIdAsunto(NULL);
		} else {
			$this->setIdAsunto($v->getId());
		}


		$this->aAsunto_mensaje = $v;
	}


	
	public function getAsunto_mensaje($con = null)
	{
		if ($this->aAsunto_mensaje === null && (($this->id_asunto !== "" && $this->id_asunto !== null))) {
						include_once 'lib/model/om/BaseAsunto_mensajePeer.php';

			$this->aAsunto_mensaje = Asunto_mensajePeer::retrieveByPK($this->id_asunto, $con);

			
		}
		return $this->aAsunto_mensaje;
	}

} 