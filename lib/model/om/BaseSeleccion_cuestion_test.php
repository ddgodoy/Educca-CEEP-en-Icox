<?php


abstract class BaseSeleccion_cuestion_test extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_respuesta_cuestion_test;


	
	protected $id_ejercicio_resuelto;

	
	protected $aRespuesta_cuestion_test;

	
	protected $aEjercicio_resuelto;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdRespuestaCuestionTest()
	{

		return $this->id_respuesta_cuestion_test;
	}

	
	public function getIdEjercicioResuelto()
	{

		return $this->id_ejercicio_resuelto;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Seleccion_cuestion_testPeer::ID;
		}

	} 
	
	public function setIdRespuestaCuestionTest($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_respuesta_cuestion_test !== $v) {
			$this->id_respuesta_cuestion_test = $v;
			$this->modifiedColumns[] = Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST;
		}

		if ($this->aRespuesta_cuestion_test !== null && $this->aRespuesta_cuestion_test->getId() !== $v) {
			$this->aRespuesta_cuestion_test = null;
		}

	} 
	
	public function setIdEjercicioResuelto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_resuelto !== $v) {
			$this->id_ejercicio_resuelto = $v;
			$this->modifiedColumns[] = Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_respuesta_cuestion_test = $rs->getString($startcol + 1);

			$this->id_ejercicio_resuelto = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Seleccion_cuestion_test object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Seleccion_cuestion_testPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Seleccion_cuestion_testPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Seleccion_cuestion_testPeer::DATABASE_NAME);
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


												
			if ($this->aRespuesta_cuestion_test !== null) {
				if ($this->aRespuesta_cuestion_test->isModified()) {
					$affectedRows += $this->aRespuesta_cuestion_test->save($con);
				}
				$this->setRespuesta_cuestion_test($this->aRespuesta_cuestion_test);
			}

			if ($this->aEjercicio_resuelto !== null) {
				if ($this->aEjercicio_resuelto->isModified()) {
					$affectedRows += $this->aEjercicio_resuelto->save($con);
				}
				$this->setEjercicio_resuelto($this->aEjercicio_resuelto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Seleccion_cuestion_testPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Seleccion_cuestion_testPeer::doUpdate($this, $con);
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


												
			if ($this->aRespuesta_cuestion_test !== null) {
				if (!$this->aRespuesta_cuestion_test->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRespuesta_cuestion_test->getValidationFailures());
				}
			}

			if ($this->aEjercicio_resuelto !== null) {
				if (!$this->aEjercicio_resuelto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_resuelto->getValidationFailures());
				}
			}


			if (($retval = Seleccion_cuestion_testPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Seleccion_cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdRespuestaCuestionTest();
				break;
			case 2:
				return $this->getIdEjercicioResuelto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Seleccion_cuestion_testPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdRespuestaCuestionTest(),
			$keys[2] => $this->getIdEjercicioResuelto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Seleccion_cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdRespuestaCuestionTest($value);
				break;
			case 2:
				$this->setIdEjercicioResuelto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Seleccion_cuestion_testPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdRespuestaCuestionTest($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEjercicioResuelto($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Seleccion_cuestion_testPeer::DATABASE_NAME);

		if ($this->isColumnModified(Seleccion_cuestion_testPeer::ID)) $criteria->add(Seleccion_cuestion_testPeer::ID, $this->id);
		if ($this->isColumnModified(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST)) $criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->id_respuesta_cuestion_test);
		if ($this->isColumnModified(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO)) $criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->id_ejercicio_resuelto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Seleccion_cuestion_testPeer::DATABASE_NAME);

		$criteria->add(Seleccion_cuestion_testPeer::ID, $this->id);

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

		$copyObj->setIdRespuestaCuestionTest($this->id_respuesta_cuestion_test);

		$copyObj->setIdEjercicioResuelto($this->id_ejercicio_resuelto);


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
			self::$peer = new Seleccion_cuestion_testPeer();
		}
		return self::$peer;
	}

	
	public function setRespuesta_cuestion_test($v)
	{


		if ($v === null) {
			$this->setIdRespuestaCuestionTest(NULL);
		} else {
			$this->setIdRespuestaCuestionTest($v->getId());
		}


		$this->aRespuesta_cuestion_test = $v;
	}


	
	public function getRespuesta_cuestion_test($con = null)
	{
		if ($this->aRespuesta_cuestion_test === null && (($this->id_respuesta_cuestion_test !== "" && $this->id_respuesta_cuestion_test !== null))) {
						include_once 'lib/model/om/BaseRespuesta_cuestion_testPeer.php';

			$this->aRespuesta_cuestion_test = Respuesta_cuestion_testPeer::retrieveByPK($this->id_respuesta_cuestion_test, $con);

			
		}
		return $this->aRespuesta_cuestion_test;
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