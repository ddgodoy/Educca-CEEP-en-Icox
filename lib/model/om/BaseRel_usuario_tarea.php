<?php


abstract class BaseRel_usuario_tarea extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_tarea;


	
	protected $id_ejercicio_resuelto;


	
	protected $entregada = 0;


	
	protected $corregida = 0;


	
	protected $fecha_entrega;


	
	protected $tiempo_restante = 0;

	
	protected $aUsuario;

	
	protected $aTarea;

	
	protected $aEjercicio_resuelto;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdTarea()
	{

		return $this->id_tarea;
	}

	
	public function getIdEjercicioResuelto()
	{

		return $this->id_ejercicio_resuelto;
	}

	
	public function getEntregada()
	{

		return $this->entregada;
	}

	
	public function getCorregida()
	{

		return $this->corregida;
	}

	
	public function getFechaEntrega($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_entrega === null || $this->fecha_entrega === '') {
			return null;
		} elseif (!is_int($this->fecha_entrega)) {
						$ts = strtotime($this->fecha_entrega);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_entrega] as date/time value: " . var_export($this->fecha_entrega, true));
			}
		} else {
			$ts = $this->fecha_entrega;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTiempoRestante()
	{

		return $this->tiempo_restante;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdTarea($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tarea !== $v) {
			$this->id_tarea = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::ID_TAREA;
		}

		if ($this->aTarea !== null && $this->aTarea->getId() !== $v) {
			$this->aTarea = null;
		}

	} 
	
	public function setIdEjercicioResuelto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_resuelto !== $v) {
			$this->id_ejercicio_resuelto = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function setEntregada($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entregada !== $v || $v === 0) {
			$this->entregada = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::ENTREGADA;
		}

	} 
	
	public function setCorregida($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->corregida !== $v || $v === 0) {
			$this->corregida = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::CORREGIDA;
		}

	} 
	
	public function setFechaEntrega($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_entrega] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_entrega !== $ts) {
			$this->fecha_entrega = $ts;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::FECHA_ENTREGA;
		}

	} 
	
	public function setTiempoRestante($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tiempo_restante !== $v || $v === 0) {
			$this->tiempo_restante = $v;
			$this->modifiedColumns[] = Rel_usuario_tareaPeer::TIEMPO_RESTANTE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getString($startcol + 0);

			$this->id_tarea = $rs->getString($startcol + 1);

			$this->id_ejercicio_resuelto = $rs->getString($startcol + 2);

			$this->entregada = $rs->getInt($startcol + 3);

			$this->corregida = $rs->getInt($startcol + 4);

			$this->fecha_entrega = $rs->getTimestamp($startcol + 5, null);

			$this->tiempo_restante = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_tarea object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_tareaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_tareaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_tareaPeer::DATABASE_NAME);
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

			if ($this->aTarea !== null) {
				if ($this->aTarea->isModified()) {
					$affectedRows += $this->aTarea->save($con);
				}
				$this->setTarea($this->aTarea);
			}

			if ($this->aEjercicio_resuelto !== null) {
				if ($this->aEjercicio_resuelto->isModified()) {
					$affectedRows += $this->aEjercicio_resuelto->save($con);
				}
				$this->setEjercicio_resuelto($this->aEjercicio_resuelto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_tareaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_tareaPeer::doUpdate($this, $con);
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

			if ($this->aTarea !== null) {
				if (!$this->aTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTarea->getValidationFailures());
				}
			}

			if ($this->aEjercicio_resuelto !== null) {
				if (!$this->aEjercicio_resuelto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_resuelto->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_tareaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_tareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdTarea();
				break;
			case 2:
				return $this->getIdEjercicioResuelto();
				break;
			case 3:
				return $this->getEntregada();
				break;
			case 4:
				return $this->getCorregida();
				break;
			case 5:
				return $this->getFechaEntrega();
				break;
			case 6:
				return $this->getTiempoRestante();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_tareaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdTarea(),
			$keys[2] => $this->getIdEjercicioResuelto(),
			$keys[3] => $this->getEntregada(),
			$keys[4] => $this->getCorregida(),
			$keys[5] => $this->getFechaEntrega(),
			$keys[6] => $this->getTiempoRestante(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_tareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdTarea($value);
				break;
			case 2:
				$this->setIdEjercicioResuelto($value);
				break;
			case 3:
				$this->setEntregada($value);
				break;
			case 4:
				$this->setCorregida($value);
				break;
			case 5:
				$this->setFechaEntrega($value);
				break;
			case 6:
				$this->setTiempoRestante($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_tareaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdTarea($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEjercicioResuelto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEntregada($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCorregida($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFechaEntrega($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTiempoRestante($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_tareaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_tareaPeer::ID_USUARIO)) $criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::ID_TAREA)) $criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->id_tarea);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO)) $criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->id_ejercicio_resuelto);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::ENTREGADA)) $criteria->add(Rel_usuario_tareaPeer::ENTREGADA, $this->entregada);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::CORREGIDA)) $criteria->add(Rel_usuario_tareaPeer::CORREGIDA, $this->corregida);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::FECHA_ENTREGA)) $criteria->add(Rel_usuario_tareaPeer::FECHA_ENTREGA, $this->fecha_entrega);
		if ($this->isColumnModified(Rel_usuario_tareaPeer::TIEMPO_RESTANTE)) $criteria->add(Rel_usuario_tareaPeer::TIEMPO_RESTANTE, $this->tiempo_restante);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_tareaPeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->id_tarea);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdTarea();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdTarea($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdEjercicioResuelto($this->id_ejercicio_resuelto);

		$copyObj->setEntregada($this->entregada);

		$copyObj->setCorregida($this->corregida);

		$copyObj->setFechaEntrega($this->fecha_entrega);

		$copyObj->setTiempoRestante($this->tiempo_restante);


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdTarea(NULL); 
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
			self::$peer = new Rel_usuario_tareaPeer();
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

	
	public function setTarea($v)
	{


		if ($v === null) {
			$this->setIdTarea(NULL);
		} else {
			$this->setIdTarea($v->getId());
		}


		$this->aTarea = $v;
	}


	
	public function getTarea($con = null)
	{
		if ($this->aTarea === null && (($this->id_tarea !== "" && $this->id_tarea !== null))) {
						include_once 'lib/model/om/BaseTareaPeer.php';

			$this->aTarea = TareaPeer::retrieveByPK($this->id_tarea, $con);

			
		}
		return $this->aTarea;
	}

	
	public function setEjercicio_resuelto($v)
	{


		if ($v === null) {
			$this->setIdEjercicioResuelto(NULL);
		} else {
			$this->setIdEjercicioResuelto($v->getId());
		}


		$this->aEjercicio_resuelto = $v;
	}


	
	public function getEjercicio_resuelto($con = null)
	{
		if ($this->aEjercicio_resuelto === null && (($this->id_ejercicio_resuelto !== "" && $this->id_ejercicio_resuelto !== null))) {
						include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';

			$this->aEjercicio_resuelto = Ejercicio_resueltoPeer::retrieveByPK($this->id_ejercicio_resuelto, $con);

			
		}
		return $this->aEjercicio_resuelto;
	}

} 