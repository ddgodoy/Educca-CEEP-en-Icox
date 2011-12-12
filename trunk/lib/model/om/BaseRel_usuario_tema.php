<?php


abstract class BaseRel_usuario_tema extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_tema;


	
	protected $tiempo;


	
	protected $estado;


	
	protected $fecha_inicio;


	
	protected $fecha_completado;

	
	protected $aUsuario;

	
	protected $aTema;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdTema()
	{

		return $this->id_tema;
	}

	
	public function getTiempo()
	{

		return $this->tiempo;
	}

	
	public function getEstado()
	{

		return $this->estado;
	}

	
	public function getFechaInicio($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_inicio === null || $this->fecha_inicio === '') {
			return null;
		} elseif (!is_int($this->fecha_inicio)) {
						$ts = strtotime($this->fecha_inicio);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_inicio] as date/time value: " . var_export($this->fecha_inicio, true));
			}
		} else {
			$ts = $this->fecha_inicio;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFechaCompletado($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_completado === null || $this->fecha_completado === '') {
			return null;
		} elseif (!is_int($this->fecha_completado)) {
						$ts = strtotime($this->fecha_completado);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_completado] as date/time value: " . var_export($this->fecha_completado, true));
			}
		} else {
			$ts = $this->fecha_completado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdTema($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tema !== $v) {
			$this->id_tema = $v;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::ID_TEMA;
		}

		if ($this->aTema !== null && $this->aTema->getId() !== $v) {
			$this->aTema = null;
		}

	} 
	
	public function setTiempo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tiempo !== $v) {
			$this->tiempo = $v;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::TIEMPO;
		}

	} 
	
	public function setEstado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->estado !== $v) {
			$this->estado = $v;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::ESTADO;
		}

	} 
	
	public function setFechaInicio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_inicio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_inicio !== $ts) {
			$this->fecha_inicio = $ts;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::FECHA_INICIO;
		}

	} 
	
	public function setFechaCompletado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_completado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_completado !== $ts) {
			$this->fecha_completado = $ts;
			$this->modifiedColumns[] = Rel_usuario_temaPeer::FECHA_COMPLETADO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getString($startcol + 0);

			$this->id_tema = $rs->getString($startcol + 1);

			$this->tiempo = $rs->getString($startcol + 2);

			$this->estado = $rs->getInt($startcol + 3);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 4, null);

			$this->fecha_completado = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_tema object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_temaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_temaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_temaPeer::DATABASE_NAME);
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

			if ($this->aTema !== null) {
				if ($this->aTema->isModified()) {
					$affectedRows += $this->aTema->save($con);
				}
				$this->setTema($this->aTema);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_temaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_temaPeer::doUpdate($this, $con);
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

			if ($this->aTema !== null) {
				if (!$this->aTema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTema->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_temaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_temaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdTema();
				break;
			case 2:
				return $this->getTiempo();
				break;
			case 3:
				return $this->getEstado();
				break;
			case 4:
				return $this->getFechaInicio();
				break;
			case 5:
				return $this->getFechaCompletado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_temaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdTema(),
			$keys[2] => $this->getTiempo(),
			$keys[3] => $this->getEstado(),
			$keys[4] => $this->getFechaInicio(),
			$keys[5] => $this->getFechaCompletado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_temaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdTema($value);
				break;
			case 2:
				$this->setTiempo($value);
				break;
			case 3:
				$this->setEstado($value);
				break;
			case 4:
				$this->setFechaInicio($value);
				break;
			case 5:
				$this->setFechaCompletado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_temaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdTema($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTiempo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEstado($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFechaInicio($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFechaCompletado($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_temaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_temaPeer::ID_USUARIO)) $criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_temaPeer::ID_TEMA)) $criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->id_tema);
		if ($this->isColumnModified(Rel_usuario_temaPeer::TIEMPO)) $criteria->add(Rel_usuario_temaPeer::TIEMPO, $this->tiempo);
		if ($this->isColumnModified(Rel_usuario_temaPeer::ESTADO)) $criteria->add(Rel_usuario_temaPeer::ESTADO, $this->estado);
		if ($this->isColumnModified(Rel_usuario_temaPeer::FECHA_INICIO)) $criteria->add(Rel_usuario_temaPeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(Rel_usuario_temaPeer::FECHA_COMPLETADO)) $criteria->add(Rel_usuario_temaPeer::FECHA_COMPLETADO, $this->fecha_completado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_temaPeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->id_tema);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdTema();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdTema($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTiempo($this->tiempo);

		$copyObj->setEstado($this->estado);

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaCompletado($this->fecha_completado);


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdTema(NULL); 
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
			self::$peer = new Rel_usuario_temaPeer();
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