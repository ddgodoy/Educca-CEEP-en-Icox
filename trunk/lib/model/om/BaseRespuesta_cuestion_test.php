<?php


abstract class BaseRespuesta_cuestion_test extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_cuestion_test;


	
	protected $respuesta;


	
	protected $correcta = 0;

	
	protected $aCuestion_test;

	
	protected $collSeleccion_cuestion_tests;

	
	protected $lastSeleccion_cuestion_testCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdCuestionTest()
	{

		return $this->id_cuestion_test;
	}

	
	public function getRespuesta()
	{

		return $this->respuesta;
	}

	
	public function getCorrecta()
	{

		return $this->correcta;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_testPeer::ID;
		}

	} 
	
	public function setIdCuestionTest($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_cuestion_test !== $v) {
			$this->id_cuestion_test = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_testPeer::ID_CUESTION_TEST;
		}

		if ($this->aCuestion_test !== null && $this->aCuestion_test->getId() !== $v) {
			$this->aCuestion_test = null;
		}

	} 
	
	public function setRespuesta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->respuesta !== $v) {
			$this->respuesta = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_testPeer::RESPUESTA;
		}

	} 
	
	public function setCorrecta($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->correcta !== $v || $v === 0) {
			$this->correcta = $v;
			$this->modifiedColumns[] = Respuesta_cuestion_testPeer::CORRECTA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_cuestion_test = $rs->getString($startcol + 1);

			$this->respuesta = $rs->getString($startcol + 2);

			$this->correcta = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Respuesta_cuestion_test object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Respuesta_cuestion_testPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Respuesta_cuestion_testPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Respuesta_cuestion_testPeer::DATABASE_NAME);
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


												
			if ($this->aCuestion_test !== null) {
				if ($this->aCuestion_test->isModified()) {
					$affectedRows += $this->aCuestion_test->save($con);
				}
				$this->setCuestion_test($this->aCuestion_test);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Respuesta_cuestion_testPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Respuesta_cuestion_testPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSeleccion_cuestion_tests !== null) {
				foreach($this->collSeleccion_cuestion_tests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aCuestion_test !== null) {
				if (!$this->aCuestion_test->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCuestion_test->getValidationFailures());
				}
			}


			if (($retval = Respuesta_cuestion_testPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSeleccion_cuestion_tests !== null) {
					foreach($this->collSeleccion_cuestion_tests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdCuestionTest();
				break;
			case 2:
				return $this->getRespuesta();
				break;
			case 3:
				return $this->getCorrecta();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_testPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCuestionTest(),
			$keys[2] => $this->getRespuesta(),
			$keys[3] => $this->getCorrecta(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Respuesta_cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdCuestionTest($value);
				break;
			case 2:
				$this->setRespuesta($value);
				break;
			case 3:
				$this->setCorrecta($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Respuesta_cuestion_testPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCuestionTest($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRespuesta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCorrecta($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_testPeer::DATABASE_NAME);

		if ($this->isColumnModified(Respuesta_cuestion_testPeer::ID)) $criteria->add(Respuesta_cuestion_testPeer::ID, $this->id);
		if ($this->isColumnModified(Respuesta_cuestion_testPeer::ID_CUESTION_TEST)) $criteria->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $this->id_cuestion_test);
		if ($this->isColumnModified(Respuesta_cuestion_testPeer::RESPUESTA)) $criteria->add(Respuesta_cuestion_testPeer::RESPUESTA, $this->respuesta);
		if ($this->isColumnModified(Respuesta_cuestion_testPeer::CORRECTA)) $criteria->add(Respuesta_cuestion_testPeer::CORRECTA, $this->correcta);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Respuesta_cuestion_testPeer::DATABASE_NAME);

		$criteria->add(Respuesta_cuestion_testPeer::ID, $this->id);

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

		$copyObj->setIdCuestionTest($this->id_cuestion_test);

		$copyObj->setRespuesta($this->respuesta);

		$copyObj->setCorrecta($this->correcta);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSeleccion_cuestion_tests() as $relObj) {
				$copyObj->addSeleccion_cuestion_test($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new Respuesta_cuestion_testPeer();
		}
		return self::$peer;
	}

	
	public function setCuestion_test($v)
	{


		if ($v === null) {
			$this->setIdCuestionTest(NULL);
		} else {
			$this->setIdCuestionTest($v->getId());
		}


		$this->aCuestion_test = $v;
	}


	
	public function getCuestion_test($con = null)
	{
		if ($this->aCuestion_test === null && (($this->id_cuestion_test !== "" && $this->id_cuestion_test !== null))) {
						include_once 'lib/model/om/BaseCuestion_testPeer.php';

			$this->aCuestion_test = Cuestion_testPeer::retrieveByPK($this->id_cuestion_test, $con);

			
		}
		return $this->aCuestion_test;
	}

	
	public function initSeleccion_cuestion_tests()
	{
		if ($this->collSeleccion_cuestion_tests === null) {
			$this->collSeleccion_cuestion_tests = array();
		}
	}

	
	public function getSeleccion_cuestion_tests($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSeleccion_cuestion_tests === null) {
			if ($this->isNew()) {
			   $this->collSeleccion_cuestion_tests = array();
			} else {

				$criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());

				Seleccion_cuestion_testPeer::addSelectColumns($criteria);
				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());

				Seleccion_cuestion_testPeer::addSelectColumns($criteria);
				if (!isset($this->lastSeleccion_cuestion_testCriteria) || !$this->lastSeleccion_cuestion_testCriteria->equals($criteria)) {
					$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSeleccion_cuestion_testCriteria = $criteria;
		return $this->collSeleccion_cuestion_tests;
	}

	
	public function countSeleccion_cuestion_tests($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());

		return Seleccion_cuestion_testPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSeleccion_cuestion_test(Seleccion_cuestion_test $l)
	{
		$this->collSeleccion_cuestion_tests[] = $l;
		$l->setRespuesta_cuestion_test($this);
	}


	
	public function getSeleccion_cuestion_testsJoinEjercicio_resuelto($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSeleccion_cuestion_tests === null) {
			if ($this->isNew()) {
				$this->collSeleccion_cuestion_tests = array();
			} else {

				$criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());

				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());

			if (!isset($this->lastSeleccion_cuestion_testCriteria) || !$this->lastSeleccion_cuestion_testCriteria->equals($criteria)) {
				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastSeleccion_cuestion_testCriteria = $criteria;

		return $this->collSeleccion_cuestion_tests;
	}

} 