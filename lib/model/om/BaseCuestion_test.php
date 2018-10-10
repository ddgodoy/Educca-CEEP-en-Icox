<?php


abstract class BaseCuestion_test extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio;


	
	protected $pregunta;


	
	protected $numero_respuestas_correctas = 0;


	
	protected $numero_respuestas_incorrectas = 0;

	
	protected $aEjercicio;

	
	protected $collRespuesta_cuestion_tests;

	
	protected $lastRespuesta_cuestion_testCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdEjercicio()
	{

		return $this->id_ejercicio;
	}

	
	public function getPregunta()
	{

		return $this->pregunta;
	}

	
	public function getNumeroRespuestasCorrectas()
	{

		return $this->numero_respuestas_correctas;
	}

	
	public function getNumeroRespuestasIncorrectas()
	{

		return $this->numero_respuestas_incorrectas;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Cuestion_testPeer::ID;
		}

	} 
	
	public function setIdEjercicio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio !== $v) {
			$this->id_ejercicio = $v;
			$this->modifiedColumns[] = Cuestion_testPeer::ID_EJERCICIO;
		}

		if ($this->aEjercicio !== null && $this->aEjercicio->getId() !== $v) {
			$this->aEjercicio = null;
		}

	} 
	
	public function setPregunta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pregunta !== $v) {
			$this->pregunta = $v;
			$this->modifiedColumns[] = Cuestion_testPeer::PREGUNTA;
		}

	} 
	
	public function setNumeroRespuestasCorrectas($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->numero_respuestas_correctas !== $v || $v === 0) {
			$this->numero_respuestas_correctas = $v;
			$this->modifiedColumns[] = Cuestion_testPeer::NUMERO_RESPUESTAS_CORRECTAS;
		}

	} 
	
	public function setNumeroRespuestasIncorrectas($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->numero_respuestas_incorrectas !== $v || $v === 0) {
			$this->numero_respuestas_incorrectas = $v;
			$this->modifiedColumns[] = Cuestion_testPeer::NUMERO_RESPUESTAS_INCORRECTAS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio = $rs->getString($startcol + 1);

			$this->pregunta = $rs->getString($startcol + 2);

			$this->numero_respuestas_correctas = $rs->getInt($startcol + 3);

			$this->numero_respuestas_incorrectas = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cuestion_test object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Cuestion_testPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Cuestion_testPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Cuestion_testPeer::DATABASE_NAME);
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


												
			if ($this->aEjercicio !== null) {
				if ($this->aEjercicio->isModified()) {
					$affectedRows += $this->aEjercicio->save($con);
				}
				$this->setEjercicio($this->aEjercicio);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Cuestion_testPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Cuestion_testPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRespuesta_cuestion_tests !== null) {
				foreach($this->collRespuesta_cuestion_tests as $referrerFK) {
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


												
			if ($this->aEjercicio !== null) {
				if (!$this->aEjercicio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio->getValidationFailures());
				}
			}


			if (($retval = Cuestion_testPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRespuesta_cuestion_tests !== null) {
					foreach($this->collRespuesta_cuestion_tests as $referrerFK) {
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
		$pos = Cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdEjercicio();
				break;
			case 2:
				return $this->getPregunta();
				break;
			case 3:
				return $this->getNumeroRespuestasCorrectas();
				break;
			case 4:
				return $this->getNumeroRespuestasIncorrectas();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Cuestion_testPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicio(),
			$keys[2] => $this->getPregunta(),
			$keys[3] => $this->getNumeroRespuestasCorrectas(),
			$keys[4] => $this->getNumeroRespuestasIncorrectas(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Cuestion_testPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdEjercicio($value);
				break;
			case 2:
				$this->setPregunta($value);
				break;
			case 3:
				$this->setNumeroRespuestasCorrectas($value);
				break;
			case 4:
				$this->setNumeroRespuestasIncorrectas($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Cuestion_testPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPregunta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNumeroRespuestasCorrectas($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNumeroRespuestasIncorrectas($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Cuestion_testPeer::DATABASE_NAME);

		if ($this->isColumnModified(Cuestion_testPeer::ID)) $criteria->add(Cuestion_testPeer::ID, $this->id);
		if ($this->isColumnModified(Cuestion_testPeer::ID_EJERCICIO)) $criteria->add(Cuestion_testPeer::ID_EJERCICIO, $this->id_ejercicio);
		if ($this->isColumnModified(Cuestion_testPeer::PREGUNTA)) $criteria->add(Cuestion_testPeer::PREGUNTA, $this->pregunta);
		if ($this->isColumnModified(Cuestion_testPeer::NUMERO_RESPUESTAS_CORRECTAS)) $criteria->add(Cuestion_testPeer::NUMERO_RESPUESTAS_CORRECTAS, $this->numero_respuestas_correctas);
		if ($this->isColumnModified(Cuestion_testPeer::NUMERO_RESPUESTAS_INCORRECTAS)) $criteria->add(Cuestion_testPeer::NUMERO_RESPUESTAS_INCORRECTAS, $this->numero_respuestas_incorrectas);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Cuestion_testPeer::DATABASE_NAME);

		$criteria->add(Cuestion_testPeer::ID, $this->id);

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

		$copyObj->setIdEjercicio($this->id_ejercicio);

		$copyObj->setPregunta($this->pregunta);

		$copyObj->setNumeroRespuestasCorrectas($this->numero_respuestas_correctas);

		$copyObj->setNumeroRespuestasIncorrectas($this->numero_respuestas_incorrectas);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRespuesta_cuestion_tests() as $relObj) {
				$copyObj->addRespuesta_cuestion_test($relObj->copy($deepCopy));
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
			self::$peer = new Cuestion_testPeer();
		}
		return self::$peer;
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
		if ($this->aEjercicio === null && (($this->id_ejercicio !== "" && $this->id_ejercicio !== null))) {
						include_once 'lib/model/om/BaseEjercicioPeer.php';

			$this->aEjercicio = EjercicioPeer::retrieveByPK($this->id_ejercicio, $con);

			
		}
		return $this->aEjercicio;
	}

	
	public function initRespuesta_cuestion_tests()
	{
		if ($this->collRespuesta_cuestion_tests === null) {
			$this->collRespuesta_cuestion_tests = array();
		}
	}

	
	public function getRespuesta_cuestion_tests($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_tests === null) {
			if ($this->isNew()) {
			   $this->collRespuesta_cuestion_tests = array();
			} else {

				$criteria->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $this->getId());

				Respuesta_cuestion_testPeer::addSelectColumns($criteria);
				$this->collRespuesta_cuestion_tests = Respuesta_cuestion_testPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $this->getId());

				Respuesta_cuestion_testPeer::addSelectColumns($criteria);
				if (!isset($this->lastRespuesta_cuestion_testCriteria) || !$this->lastRespuesta_cuestion_testCriteria->equals($criteria)) {
					$this->collRespuesta_cuestion_tests = Respuesta_cuestion_testPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRespuesta_cuestion_testCriteria = $criteria;
		return $this->collRespuesta_cuestion_tests;
	}

	
	public function countRespuesta_cuestion_tests($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $this->getId());

		return Respuesta_cuestion_testPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRespuesta_cuestion_test(Respuesta_cuestion_test $l)
	{
		$this->collRespuesta_cuestion_tests[] = $l;
		$l->setCuestion_test($this);
	}

} 