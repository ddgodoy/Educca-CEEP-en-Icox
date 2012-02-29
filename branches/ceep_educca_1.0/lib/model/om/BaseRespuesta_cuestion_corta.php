<?php


abstract class BaseRespuesta_cuestion_corta extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio_resuelto;


	
	protected $id_cuestion_corta;


	
	protected $respuesta;


	
	protected $comentario;


	
	protected $puntuacion;

	
	protected $aEjercicio_resuelto;

	
	protected $aCuestion_corta;

	
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

	
	public function getIdCuestionCorta()
	{

		return $this->id_cuestion_corta;
	}

	
	public function getRespuesta()
	{

		return $this->respuesta;
	}

	
	public function getComentario()
	{

		return $this->comentario;
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
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::ID;
		}

	} 
	
	public function setIdEjercicioResuelto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_resuelto !== $v) {
			$this->id_ejercicio_resuelto = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function setIdCuestionCorta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_cuestion_corta !== $v) {
			$this->id_cuestion_corta = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA;
		}

		if ($this->aCuestion_corta !== null && $this->aCuestion_corta->getId() !== $v) {
			$this->aCuestion_corta = null;
		}

	} 
	
	public function setRespuesta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->respuesta !== $v) {
			$this->respuesta = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::RESPUESTA;
		}

	} 
	
	public function setComentario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comentario !== $v) {
			$this->comentario = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::COMENTARIO;
		}

	} 
	
	public function setPuntuacion($v)
	{

		if ($this->puntuacion !== $v) {
			$this->puntuacion = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_cortaPeer::PUNTUACION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio_resuelto = $rs->getString($startcol + 1);

			$this->id_cuestion_corta = $rs->getString($startcol + 2);

			$this->respuesta = $rs->getString($startcol + 3);

			$this->comentario = $rs->getString($startcol + 4);

			$this->puntuacion = $rs->getFloat($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Respuesta_cuestion_corta object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Respuesta_cuestion_cortaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Respuesta_cuestion_cortaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Respuesta_cuestion_cortaPeer::DATABASE_NAME);
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

			if ($this->aCuestion_corta !== null) {
				if ($this->aCuestion_corta->isModified()) {
					$affectedRows += $this->aCuestion_corta->save($con);
				}
				$this->setCuestion_corta($this->aCuestion_corta);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Respuesta_cuestion_cortaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Respuesta_cuestion_cortaPeer::doUpdate($this, $con);
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

			if ($this->aCuestion_corta !== null) {
				if (!$this->aCuestion_corta->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCuestion_corta->getValidationFailures());
				}
			}


			if (($retval = Respuesta_cuestion_cortaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_cortaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIdCuestionCorta();
				break;
			case 3:
				return $this->getRespuesta();
				break;
			case 4:
				return $this->getComentario();
				break;
			case 5:
				return $this->getPuntuacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_cortaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicioResuelto(),
			$keys[2] => $this->getIdCuestionCorta(),
			$keys[3] => $this->getRespuesta(),
			$keys[4] => $this->getComentario(),
			$keys[5] => $this->getPuntuacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_cortaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIdCuestionCorta($value);
				break;
			case 3:
				$this->setRespuesta($value);
				break;
			case 4:
				$this->setComentario($value);
				break;
			case 5:
				$this->setPuntuacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_cortaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicioResuelto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdCuestionCorta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRespuesta($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setComentario($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPuntuacion($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_cortaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::ID)) $criteria->add(Respuesta_cuestion_cortaPeer::ID, $this->id);
		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO)) $criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->id_ejercicio_resuelto);
		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA)) $criteria->add(Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA, $this->id_cuestion_corta);
		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::RESPUESTA)) $criteria->add(Respuesta_cuestion_cortaPeer::RESPUESTA, $this->respuesta);
		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::COMENTARIO)) $criteria->add(Respuesta_cuestion_cortaPeer::COMENTARIO, $this->comentario);
		if ($this->isColumnModified(Respuesta_cuestion_cortaPeer::PUNTUACION)) $criteria->add(Respuesta_cuestion_cortaPeer::PUNTUACION, $this->puntuacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_cortaPeer::DATABASE_NAME);

		$criteria->add(Respuesta_cuestion_cortaPeer::ID, $this->id);

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

		$copyObj->setIdCuestionCorta($this->id_cuestion_corta);

		$copyObj->setRespuesta($this->respuesta);

		$copyObj->setComentario($this->comentario);

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
			self::$peer = new Respuesta_cuestion_cortaPeer();
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

	
	public function setCuestion_corta($v)
	{


		if ($v === null) {
			$this->setIdCuestionCorta(NULL);
		} else {
			$this->setIdCuestionCorta($v->getId());
		}


		$this->aCuestion_corta = $v;
	}


	
	public function getCuestion_corta($con = null)
	{
		if ($this->aCuestion_corta === null && (($this->id_cuestion_corta !== "" && $this->id_cuestion_corta !== null))) {
						include_once 'lib/model/om/BaseCuestion_cortaPeer.php';

			$this->aCuestion_corta = Cuestion_cortaPeer::retrieveByPK($this->id_cuestion_corta, $con);

			
		}
		return $this->aCuestion_corta;
	}

} 