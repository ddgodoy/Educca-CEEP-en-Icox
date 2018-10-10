<?php


abstract class BaseCuestion_practica extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio;


	
	protected $contenido_latex;


	
	protected $puntuacion;

	
	protected $aEjercicio;

	
	protected $collRespuesta_cuestion_practicas;

	
	protected $lastRespuesta_cuestion_practicaCriteria = null;

	
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

	
	public function getContenidoLatex()
	{

		return $this->contenido_latex;
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
			$this->modifiedColumns[] = Cuestion_practicaPeer::ID;
		}

	} 
	
	public function setIdEjercicio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio !== $v) {
			$this->id_ejercicio = $v;
			$this->modifiedColumns[] = Cuestion_practicaPeer::ID_EJERCICIO;
		}

		if ($this->aEjercicio !== null && $this->aEjercicio->getId() !== $v) {
			$this->aEjercicio = null;
		}

	} 
	
	public function setContenidoLatex($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contenido_latex !== $v) {
			$this->contenido_latex = $v;
			$this->modifiedColumns[] = Cuestion_practicaPeer::CONTENIDO_LATEX;
		}

	} 
	
	public function setPuntuacion($v)
	{

		if ($this->puntuacion !== $v) {
			$this->puntuacion = $v;
			$this->modifiedColumns[] = Cuestion_practicaPeer::PUNTUACION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio = $rs->getString($startcol + 1);

			$this->contenido_latex = $rs->getString($startcol + 2);

			$this->puntuacion = $rs->getFloat($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cuestion_practica object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Cuestion_practicaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Cuestion_practicaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Cuestion_practicaPeer::DATABASE_NAME);
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
					$pk = Cuestion_practicaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Cuestion_practicaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRespuesta_cuestion_practicas !== null) {
				foreach($this->collRespuesta_cuestion_practicas as $referrerFK) {
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


			if (($retval = Cuestion_practicaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRespuesta_cuestion_practicas !== null) {
					foreach($this->collRespuesta_cuestion_practicas as $referrerFK) {
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
		$pos = Cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContenidoLatex();
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
		$keys = Cuestion_practicaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicio(),
			$keys[2] => $this->getContenidoLatex(),
			$keys[3] => $this->getPuntuacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Cuestion_practicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContenidoLatex($value);
				break;
			case 3:
				$this->setPuntuacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Cuestion_practicaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContenidoLatex($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPuntuacion($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Cuestion_practicaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Cuestion_practicaPeer::ID)) $criteria->add(Cuestion_practicaPeer::ID, $this->id);
		if ($this->isColumnModified(Cuestion_practicaPeer::ID_EJERCICIO)) $criteria->add(Cuestion_practicaPeer::ID_EJERCICIO, $this->id_ejercicio);
		if ($this->isColumnModified(Cuestion_practicaPeer::CONTENIDO_LATEX)) $criteria->add(Cuestion_practicaPeer::CONTENIDO_LATEX, $this->contenido_latex);
		if ($this->isColumnModified(Cuestion_practicaPeer::PUNTUACION)) $criteria->add(Cuestion_practicaPeer::PUNTUACION, $this->puntuacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Cuestion_practicaPeer::DATABASE_NAME);

		$criteria->add(Cuestion_practicaPeer::ID, $this->id);

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

		$copyObj->setContenidoLatex($this->contenido_latex);

		$copyObj->setPuntuacion($this->puntuacion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRespuesta_cuestion_practicas() as $relObj) {
				$copyObj->addRespuesta_cuestion_practica($relObj->copy($deepCopy));
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
			self::$peer = new Cuestion_practicaPeer();
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

	
	public function initRespuesta_cuestion_practicas()
	{
		if ($this->collRespuesta_cuestion_practicas === null) {
			$this->collRespuesta_cuestion_practicas = array();
		}
	}

	
	public function getRespuesta_cuestion_practicas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_practicas === null) {
			if ($this->isNew()) {
			   $this->collRespuesta_cuestion_practicas = array();
			} else {

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());

				Respuesta_cuestion_practicaPeer::addSelectColumns($criteria);
				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());

				Respuesta_cuestion_practicaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRespuesta_cuestion_practicaCriteria) || !$this->lastRespuesta_cuestion_practicaCriteria->equals($criteria)) {
					$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRespuesta_cuestion_practicaCriteria = $criteria;
		return $this->collRespuesta_cuestion_practicas;
	}

	
	public function countRespuesta_cuestion_practicas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());

		return Respuesta_cuestion_practicaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRespuesta_cuestion_practica(Respuesta_cuestion_practica $l)
	{
		$this->collRespuesta_cuestion_practicas[] = $l;
		$l->setCuestion_practica($this);
	}


	
	public function getRespuesta_cuestion_practicasJoinEjercicio_resuelto($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_practicas === null) {
			if ($this->isNew()) {
				$this->collRespuesta_cuestion_practicas = array();
			} else {

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());

				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());

			if (!isset($this->lastRespuesta_cuestion_practicaCriteria) || !$this->lastRespuesta_cuestion_practicaCriteria->equals($criteria)) {
				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastRespuesta_cuestion_practicaCriteria = $criteria;

		return $this->collRespuesta_cuestion_practicas;
	}

} 