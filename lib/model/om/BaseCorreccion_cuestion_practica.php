<?php


abstract class BaseCorreccion_cuestion_practica extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio_corregido;


	
	protected $id_respuesta_cuestion_practica;


	
	protected $comentario;

	
	protected $aEjercicio_corregido;

	
	protected $aRespuesta_cuestion_practica;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdEjercicioCorregido()
	{

		return $this->id_ejercicio_corregido;
	}

	
	public function getIdRespuestaCuestionPractica()
	{

		return $this->id_respuesta_cuestion_practica;
	}

	
	public function getComentario()
	{

		return $this->comentario;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Correccion_cuestion_practicaPeer::ID;
		}

	} 
	
	public function setIdEjercicioCorregido($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_corregido !== $v) {
			$this->id_ejercicio_corregido = $v;
			$this->modifiedColumns[] = Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO;
		}

		if ($this->aEjercicio_corregido !== null && $this->aEjercicio_corregido->getId() !== $v) {
			$this->aEjercicio_corregido = null;
		}

	} 
	
	public function setIdRespuestaCuestionPractica($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_respuesta_cuestion_practica !== $v) {
			$this->id_respuesta_cuestion_practica = $v;
			$this->modifiedColumns[] = Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA;
		}

		if ($this->aRespuesta_cuestion_practica !== null && $this->aRespuesta_cuestion_practica->getId() !== $v) {
			$this->aRespuesta_cuestion_practica = null;
		}

	} 
	
	public function setComentario($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comentario !== $v) {
			$this->comentario = $v;
			$this->modifiedColumns[] = Correccion_cuestion_practicaPeer::COMENTARIO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio_corregido = $rs->getString($startcol + 1);

			$this->id_respuesta_cuestion_practica = $rs->getString($startcol + 2);

			$this->comentario = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Correccion_cuestion_practica object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Correccion_cuestion_practicaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Correccion_cuestion_practicaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Correccion_cuestion_practicaPeer::DATABASE_NAME);
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


												
			if ($this->aEjercicio_corregido !== null) {
				if ($this->aEjercicio_corregido->isModified()) {
					$affectedRows += $this->aEjercicio_corregido->save($con);
				}
				$this->setEjercicio_corregido($this->aEjercicio_corregido);
			}

			if ($this->aRespuesta_cuestion_practica !== null) {
				if ($this->aRespuesta_cuestion_practica->isModified()) {
					$affectedRows += $this->aRespuesta_cuestion_practica->save($con);
				}
				$this->setRespuesta_cuestion_practica($this->aRespuesta_cuestion_practica);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Correccion_cuestion_practicaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Correccion_cuestion_practicaPeer::doUpdate($this, $con);
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


												
			if ($this->aEjercicio_corregido !== null) {
				if (!$this->aEjercicio_corregido->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_corregido->getValidationFailures());
				}
			}

			if ($this->aRespuesta_cuestion_practica !== null) {
				if (!$this->aRespuesta_cuestion_practica->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRespuesta_cuestion_practica->getValidationFailures());
				}
			}


			if (($retval = Correccion_cuestion_practicaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Correccion_cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdEjercicioCorregido();
				break;
			case 2:
				return $this->getIdRespuestaCuestionPractica();
				break;
			case 3:
				return $this->getComentario();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Correccion_cuestion_practicaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicioCorregido(),
			$keys[2] => $this->getIdRespuestaCuestionPractica(),
			$keys[3] => $this->getComentario(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Correccion_cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdEjercicioCorregido($value);
				break;
			case 2:
				$this->setIdRespuestaCuestionPractica($value);
				break;
			case 3:
				$this->setComentario($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Correccion_cuestion_practicaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicioCorregido($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdRespuestaCuestionPractica($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComentario($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Correccion_cuestion_practicaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Correccion_cuestion_practicaPeer::ID)) $criteria->add(Correccion_cuestion_practicaPeer::ID, $this->id);
		if ($this->isColumnModified(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO)) $criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->id_ejercicio_corregido);
		if ($this->isColumnModified(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA)) $criteria->add(Correccion_cuestion_practicaPeer::ID_RESPUESTA_CUESTION_PRACTICA, $this->id_respuesta_cuestion_practica);
		if ($this->isColumnModified(Correccion_cuestion_practicaPeer::COMENTARIO)) $criteria->add(Correccion_cuestion_practicaPeer::COMENTARIO, $this->comentario);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Correccion_cuestion_practicaPeer::DATABASE_NAME);

		$criteria->add(Correccion_cuestion_practicaPeer::ID, $this->id);

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

		$copyObj->setIdEjercicioCorregido($this->id_ejercicio_corregido);

		$copyObj->setIdRespuestaCuestionPractica($this->id_respuesta_cuestion_practica);

		$copyObj->setComentario($this->comentario);


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
			self::$peer = new Correccion_cuestion_practicaPeer();
		}
		return self::$peer;
	}

	
	public function setEjercicio_corregido($v)
	{


		if ($v === null) {
			$this->setIdEjercicioCorregido(NULL);
		} else {
			$this->setIdEjercicioCorregido($v->getId());
		}


		$this->aEjercicio_corregido = $v;
	}


	
	public function getEjercicio_corregido($con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_corregidoPeer.php';

		if ($this->aEjercicio_corregido === null && (($this->id_ejercicio_corregido !== "" && $this->id_ejercicio_corregido !== null))) {

			$this->aEjercicio_corregido = Ejercicio_corregidoPeer::retrieveByPK($this->id_ejercicio_corregido, $con);

			
		}
		return $this->aEjercicio_corregido;
	}

	
	public function setRespuesta_cuestion_practica($v)
	{


		if ($v === null) {
			$this->setIdRespuestaCuestionPractica(NULL);
		} else {
			$this->setIdRespuestaCuestionPractica($v->getId());
		}


		$this->aRespuesta_cuestion_practica = $v;
	}


	
	public function getRespuesta_cuestion_practica($con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';

		if ($this->aRespuesta_cuestion_practica === null && (($this->id_respuesta_cuestion_practica !== "" && $this->id_respuesta_cuestion_practica !== null))) {

			$this->aRespuesta_cuestion_practica = Respuesta_cuestion_practicaPeer::retrieveByPK($this->id_respuesta_cuestion_practica, $con);

			
		}
		return $this->aRespuesta_cuestion_practica;
	}

} 