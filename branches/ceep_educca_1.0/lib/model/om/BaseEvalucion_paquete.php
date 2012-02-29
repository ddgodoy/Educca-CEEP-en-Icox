<?php


abstract class BaseEvalucion_paquete extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_paquete;


	
	protected $id_ejercicio;


	
	protected $peso;

	
	protected $aPaquete;

	
	protected $aEjercicio;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdPaquete()
	{

		return $this->id_paquete;
	}

	
	public function getIdEjercicio()
	{

		return $this->id_ejercicio;
	}

	
	public function getPeso()
	{

		return $this->peso;
	}

	
	public function setIdPaquete($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_paquete !== $v) {
			$this->id_paquete = $v;
			$this->modifiedColumns[] = Evalucion_paquetePeer::ID_PAQUETE;
		}

		if ($this->aPaquete !== null && $this->aPaquete->getId() !== $v) {
			$this->aPaquete = null;
		}

	} 
	
	public function setIdEjercicio($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio !== $v) {
			$this->id_ejercicio = $v;
			$this->modifiedColumns[] = Evalucion_paquetePeer::ID_EJERCICIO;
		}

		if ($this->aEjercicio !== null && $this->aEjercicio->getId() !== $v) {
			$this->aEjercicio = null;
		}

	} 
	
	public function setPeso($v)
	{

		if ($this->peso !== $v) {
			$this->peso = $v;
			$this->modifiedColumns[] = Evalucion_paquetePeer::PESO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_paquete = $rs->getString($startcol + 0);

			$this->id_ejercicio = $rs->getString($startcol + 1);

			$this->peso = $rs->getFloat($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Evalucion_paquete object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Evalucion_paquetePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Evalucion_paquetePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Evalucion_paquetePeer::DATABASE_NAME);
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


												
			if ($this->aPaquete !== null) {
				if ($this->aPaquete->isModified()) {
					$affectedRows += $this->aPaquete->save($con);
				}
				$this->setPaquete($this->aPaquete);
			}

			if ($this->aEjercicio !== null) {
				if ($this->aEjercicio->isModified()) {
					$affectedRows += $this->aEjercicio->save($con);
				}
				$this->setEjercicio($this->aEjercicio);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Evalucion_paquetePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Evalucion_paquetePeer::doUpdate($this, $con);
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


												
			if ($this->aPaquete !== null) {
				if (!$this->aPaquete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPaquete->getValidationFailures());
				}
			}

			if ($this->aEjercicio !== null) {
				if (!$this->aEjercicio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio->getValidationFailures());
				}
			}


			if (($retval = Evalucion_paquetePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Evalucion_paquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdPaquete();
				break;
			case 1:
				return $this->getIdEjercicio();
				break;
			case 2:
				return $this->getPeso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Evalucion_paquetePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdPaquete(),
			$keys[1] => $this->getIdEjercicio(),
			$keys[2] => $this->getPeso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Evalucion_paquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdPaquete($value);
				break;
			case 1:
				$this->setIdEjercicio($value);
				break;
			case 2:
				$this->setPeso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Evalucion_paquetePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdPaquete($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPeso($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Evalucion_paquetePeer::DATABASE_NAME);

		if ($this->isColumnModified(Evalucion_paquetePeer::ID_PAQUETE)) $criteria->add(Evalucion_paquetePeer::ID_PAQUETE, $this->id_paquete);
		if ($this->isColumnModified(Evalucion_paquetePeer::ID_EJERCICIO)) $criteria->add(Evalucion_paquetePeer::ID_EJERCICIO, $this->id_ejercicio);
		if ($this->isColumnModified(Evalucion_paquetePeer::PESO)) $criteria->add(Evalucion_paquetePeer::PESO, $this->peso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Evalucion_paquetePeer::DATABASE_NAME);

		$criteria->add(Evalucion_paquetePeer::ID_PAQUETE, $this->id_paquete);
		$criteria->add(Evalucion_paquetePeer::ID_EJERCICIO, $this->id_ejercicio);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdPaquete();

		$pks[1] = $this->getIdEjercicio();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdPaquete($keys[0]);

		$this->setIdEjercicio($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPeso($this->peso);


		$copyObj->setNew(true);

		$copyObj->setIdPaquete(NULL); 
		$copyObj->setIdEjercicio(NULL); 
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
			self::$peer = new Evalucion_paquetePeer();
		}
		return self::$peer;
	}

	
	public function setPaquete($v)
	{


		if ($v === null) {
			$this->setIdPaquete(NULL);
		} else {
			$this->setIdPaquete($v->getId());
		}


		$this->aPaquete = $v;
	}


	
	public function getPaquete($con = null)
	{
				include_once 'lib/model/om/BasePaquetePeer.php';

		if ($this->aPaquete === null && (($this->id_paquete !== "" && $this->id_paquete !== null))) {

			$this->aPaquete = PaquetePeer::retrieveByPK($this->id_paquete, $con);

			
		}
		return $this->aPaquete;
	}

	
	public function setEjercicio($v)
	{


		if ($v === null) {
			$this->setIdEjercicio(NULL);
		} else {
			$this->setIdEjercicio($v->getId());
		}


		$this->aEjercicio = $v;
	}


	
	public function getEjercicio($con = null)
	{
				include_once 'lib/model/om/BaseEjercicioPeer.php';

		if ($this->aEjercicio === null && (($this->id_ejercicio !== "" && $this->id_ejercicio !== null))) {

			$this->aEjercicio = EjercicioPeer::retrieveByPK($this->id_ejercicio, $con);

			
		}
		return $this->aEjercicio;
	}

} 