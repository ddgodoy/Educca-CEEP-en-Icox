<?php


abstract class BaseRespuesta_cuestion_practica extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio_resuelto;


	
	protected $id_cuestion_practica;


	
	protected $puntuacion;

	
	protected $aEjercicio_resuelto;

	
	protected $aCuestion_practica;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdEjercicioResuelto()
	{

		return $this->id_ejercicio_resuelto;
	}

	
	public function getIdCuestionPractica()
	{

		return $this->id_cuestion_practica;
	}

	
	public function getPuntuacion()
	{

		return $this->puntuacion;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_practicaPeer::ID;
		}

	} 
	
	public function setIdEjercicioResuelto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_resuelto !== $v) {
			$this->id_ejercicio_resuelto = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function setIdCuestionPractica($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_cuestion_practica !== $v) {
			$this->id_cuestion_practica = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA;
		}

		if ($this->aCuestion_practica !== null && $this->aCuestion_practica->getId() !== $v) {
			$this->aCuestion_practica = null;
		}

	} 
	
	public function setPuntuacion($v)
	{

		if ($this->puntuacion !== $v) {
			$this->puntuacion = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_practicaPeer::PUNTUACION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio_resuelto = $rs->getString($startcol + 1);

			$this->id_cuestion_practica = $rs->getString($startcol + 2);

			$this->puntuacion = $rs->getFloat($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Respuesta_cuestion_practica object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Respuesta_cuestion_practicaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Respuesta_cuestion_practicaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Respuesta_cuestion_practicaPeer::DATABASE_NAME);
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


												
			if ($this->aEjercicio_resuelto !== null) {
				if ($this->aEjercicio_resuelto->isModified()) {
					$affectedRows += $this->aEjercicio_resuelto->save($con);
				}
				$this->setEjercicio_resuelto($this->aEjercicio_resuelto);
			}

			if ($this->aCuestion_practica !== null) {
				if ($this->aCuestion_practica->isModified()) {
					$affectedRows += $this->aCuestion_practica->save($con);
				}
				$this->setCuestion_practica($this->aCuestion_practica);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Respuesta_cuestion_practicaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Respuesta_cuestion_practicaPeer::doUpdate($this, $con);
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


												
			if ($this->aEjercicio_resuelto !== null) {
				if (!$this->aEjercicio_resuelto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_resuelto->getValidationFailures());
				}
			}

			if ($this->aCuestion_practica !== null) {
				if (!$this->aCuestion_practica->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCuestion_practica->getValidationFailures());
				}
			}


			if (($retval = Respuesta_cuestion_practicaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdEjercicioResuelto();
				break;
			case 2:
				return $this->getIdCuestionPractica();
				break;
			case 3:
				return $this->getPuntuacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_practicaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicioResuelto(),
			$keys[2] => $this->getIdCuestionPractica(),
			$keys[3] => $this->getPuntuacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdEjercicioResuelto($value);
				break;
			case 2:
				$this->setIdCuestionPractica($value);
				break;
			case 3:
				$this->setPuntuacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_practicaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicioResuelto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdCuestionPractica($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPuntuacion($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_practicaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Respuesta_cuestion_practicaPeer::ID)) $criteria->add(Respuesta_cuestion_practicaPeer::ID, $this->id);
		if ($this->isColumnModified(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO)) $criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->id_ejercicio_resuelto);
		if ($this->isColumnModified(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA)) $criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->id_cuestion_practica);
		if ($this->isColumnModified(Respuesta_cuestion_practicaPeer::PUNTUACION)) $criteria->add(Respuesta_cuestion_practicaPeer::PUNTUACION, $this->puntuacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_practicaPeer::DATABASE_NAME);

		$criteria->add(Respuesta_cuestion_practicaPeer::ID, $this->id);

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

		$copyObj->setIdEjercicioResuelto($this->id_ejercicio_resuelto);

		$copyObj->setIdCuestionPractica($this->id_cuestion_practica);

		$copyObj->setPuntuacion($this->puntuacion);


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
			self::$peer = new Respuesta_cuestion_practicaPeer();
		}
		return self::$peer;
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

	
	public function setCuestion_practica($v)
	{


		if ($v === null) {
			$this->setIdCuestionPractica(NULL);
		} else {
			$this->setIdCuestionPractica($v->getId());
		}


		$this->aCuestion_practica = $v;
	}


	
	public function getCuestion_practica($con = null)
	{
		if ($this->aCuestion_practica === null && (($this->id_cuestion_practica !== "" && $this->id_cuestion_practica !== null))) {
						include_once 'lib/model/om/BaseCuestion_practicaPeer.php';

			$this->aCuestion_practica = Cuestion_practicaPeer::retrieveByPK($this->id_cuestion_practica, $con);

			
		}
		return $this->aCuestion_practica;
	}

} 