<?php


abstract class BaseNotificacion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_usuario;


	
	protected $id_curso;


	
	protected $id_tema;


	
	protected $tipo;


	
	protected $titulo;


	
	protected $contenido;


	
	protected $fecha;


	
	protected $created_at;

	
	protected $aUsuario;

	
	protected $aCurso;

	
	protected $aTema;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getIdTema()
	{

		return $this->id_tema;
	}

	
	public function getTipo()
	{

		return $this->tipo;
	}

	
	public function getTitulo()
	{

		return $this->titulo;
	}

	
	public function getContenido()
	{

		return $this->contenido;
	}

	
	public function getFecha($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha === null || $this->fecha === '') {
			return null;
		} elseif (!is_int($this->fecha)) {
						$ts = strtotime($this->fecha);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha] as date/time value: " . var_export($this->fecha, true));
			}
		} else {
			$ts = $this->fecha;
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

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = NotificacionPeer::ID;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = NotificacionPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = NotificacionPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setIdTema($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tema !== $v) {
			$this->id_tema = $v;
			$this->modifiedColumns[] = NotificacionPeer::ID_TEMA;
		}

		if ($this->aTema !== null && $this->aTema->getId() !== $v) {
			$this->aTema = null;
		}

	} 
	
	public function setTipo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tipo !== $v) {
			$this->tipo = $v;
			$this->modifiedColumns[] = NotificacionPeer::TIPO;
		}

	} 
	
	public function setTitulo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->titulo !== $v) {
			$this->titulo = $v;
			$this->modifiedColumns[] = NotificacionPeer::TITULO;
		}

	} 
	
	public function setContenido($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contenido !== $v) {
			$this->contenido = $v;
			$this->modifiedColumns[] = NotificacionPeer::CONTENIDO;
		}

	} 
	
	public function setFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha !== $ts) {
			$this->fecha = $ts;
			$this->modifiedColumns[] = NotificacionPeer::FECHA;
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
			$this->modifiedColumns[] = NotificacionPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_usuario = $rs->getString($startcol + 1);

			$this->id_curso = $rs->getString($startcol + 2);

			$this->id_tema = $rs->getString($startcol + 3);

			$this->tipo = $rs->getString($startcol + 4);

			$this->titulo = $rs->getString($startcol + 5);

			$this->contenido = $rs->getString($startcol + 6);

			$this->fecha = $rs->getTimestamp($startcol + 7, null);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Notificacion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NotificacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(NotificacionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME);
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

			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}

			if ($this->aTema !== null) {
				if ($this->aTema->isModified()) {
					$affectedRows += $this->aTema->save($con);
				}
				$this->setTema($this->aTema);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotificacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotificacionPeer::doUpdate($this, $con);
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

			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}

			if ($this->aTema !== null) {
				if (!$this->aTema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTema->getValidationFailures());
				}
			}


			if (($retval = NotificacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdUsuario();
				break;
			case 2:
				return $this->getIdCurso();
				break;
			case 3:
				return $this->getIdTema();
				break;
			case 4:
				return $this->getTipo();
				break;
			case 5:
				return $this->getTitulo();
				break;
			case 6:
				return $this->getContenido();
				break;
			case 7:
				return $this->getFecha();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotificacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUsuario(),
			$keys[2] => $this->getIdCurso(),
			$keys[3] => $this->getIdTema(),
			$keys[4] => $this->getTipo(),
			$keys[5] => $this->getTitulo(),
			$keys[6] => $this->getContenido(),
			$keys[7] => $this->getFecha(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdUsuario($value);
				break;
			case 2:
				$this->setIdCurso($value);
				break;
			case 3:
				$this->setIdTema($value);
				break;
			case 4:
				$this->setTipo($value);
				break;
			case 5:
				$this->setTitulo($value);
				break;
			case 6:
				$this->setContenido($value);
				break;
			case 7:
				$this->setFecha($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotificacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUsuario($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdCurso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdTema($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTitulo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setContenido($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFecha($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotificacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotificacionPeer::ID)) $criteria->add(NotificacionPeer::ID, $this->id);
		if ($this->isColumnModified(NotificacionPeer::ID_USUARIO)) $criteria->add(NotificacionPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(NotificacionPeer::ID_CURSO)) $criteria->add(NotificacionPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(NotificacionPeer::ID_TEMA)) $criteria->add(NotificacionPeer::ID_TEMA, $this->id_tema);
		if ($this->isColumnModified(NotificacionPeer::TIPO)) $criteria->add(NotificacionPeer::TIPO, $this->tipo);
		if ($this->isColumnModified(NotificacionPeer::TITULO)) $criteria->add(NotificacionPeer::TITULO, $this->titulo);
		if ($this->isColumnModified(NotificacionPeer::CONTENIDO)) $criteria->add(NotificacionPeer::CONTENIDO, $this->contenido);
		if ($this->isColumnModified(NotificacionPeer::FECHA)) $criteria->add(NotificacionPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(NotificacionPeer::CREATED_AT)) $criteria->add(NotificacionPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotificacionPeer::DATABASE_NAME);

		$criteria->add(NotificacionPeer::ID, $this->id);

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

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setIdCurso($this->id_curso);

		$copyObj->setIdTema($this->id_tema);

		$copyObj->setTipo($this->tipo);

		$copyObj->setTitulo($this->titulo);

		$copyObj->setContenido($this->contenido);

		$copyObj->setFecha($this->fecha);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new NotificacionPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdUsuario(NULL);
		} else {
			$this->setIdUsuario($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->id_usuario !== "" && $this->id_usuario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_usuario, $con);

			
		}
		return $this->aUsuario;
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

	
	public function setTema($v)
	{


		if ($v === null) {
			$this->setIdTema(NULL);
		} else {
			$this->setIdTema($v->getId());
		}


		$this->aTema = $v;
	}


	
	public function getTema($con = null)
	{
		if ($this->aTema === null && (($this->id_tema !== "" && $this->id_tema !== null))) {
						include_once 'lib/model/om/BaseTemaPeer.php';

			$this->aTema = TemaPeer::retrieveByPK($this->id_tema, $con);

			
		}
		return $this->aTema;
	}

} 