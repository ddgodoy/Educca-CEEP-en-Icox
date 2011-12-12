<?php


abstract class BaseTarea extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_curso;


	
	protected $id_ejercicio;


	
	protected $id_autor;


	
	protected $id_evento;


	
	protected $tiempo_disponible = 0;

	
	protected $aCurso;

	
	protected $aEjercicio;

	
	protected $aUsuario;

	
	protected $aEvento;

	
	protected $collRel_usuario_tareas;

	
	protected $lastRel_usuario_tareaCriteria = null;

	
	protected $collEvaluacion_paquetes;

	
	protected $lastEvaluacion_paqueteCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getIdEjercicio()
	{

		return $this->id_ejercicio;
	}

	
	public function getIdAutor()
	{

		return $this->id_autor;
	}

	
	public function getIdEvento()
	{

		return $this->id_evento;
	}

	
	public function getTiempoDisponible()
	{

		return $this->tiempo_disponible;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TareaPeer::ID;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = TareaPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setIdEjercicio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio !== $v) {
			$this->id_ejercicio = $v;
			$this->modifiedColumns[] = TareaPeer::ID_EJERCICIO;
		}

		if ($this->aEjercicio !== null && $this->aEjercicio->getId() !== $v) {
			$this->aEjercicio = null;
		}

	} 
	
	public function setIdAutor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_autor !== $v) {
			$this->id_autor = $v;
			$this->modifiedColumns[] = TareaPeer::ID_AUTOR;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdEvento($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_evento !== $v) {
			$this->id_evento = $v;
			$this->modifiedColumns[] = TareaPeer::ID_EVENTO;
		}

		if ($this->aEvento !== null && $this->aEvento->getId() !== $v) {
			$this->aEvento = null;
		}

	} 
	
	public function setTiempoDisponible($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tiempo_disponible !== $v || $v === 0) {
			$this->tiempo_disponible = $v;
			$this->modifiedColumns[] = TareaPeer::TIEMPO_DISPONIBLE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

			$this->id_ejercicio = $rs->getString($startcol + 2);

			$this->id_autor = $rs->getString($startcol + 3);

			$this->id_evento = $rs->getString($startcol + 4);

			$this->tiempo_disponible = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tarea object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TareaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TareaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TareaPeer::DATABASE_NAME);
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


												
			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}

			if ($this->aEjercicio !== null) {
				if ($this->aEjercicio->isModified()) {
					$affectedRows += $this->aEjercicio->save($con);
				}
				$this->setEjercicio($this->aEjercicio);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aEvento !== null) {
				if ($this->aEvento->isModified()) {
					$affectedRows += $this->aEvento->save($con);
				}
				$this->setEvento($this->aEvento);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TareaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TareaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_usuario_tareas !== null) {
				foreach($this->collRel_usuario_tareas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEvaluacion_paquetes !== null) {
				foreach($this->collEvaluacion_paquetes as $referrerFK) {
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


												
			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}

			if ($this->aEjercicio !== null) {
				if (!$this->aEjercicio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aEvento !== null) {
				if (!$this->aEvento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvento->getValidationFailures());
				}
			}


			if (($retval = TareaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_usuario_tareas !== null) {
					foreach($this->collRel_usuario_tareas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEvaluacion_paquetes !== null) {
					foreach($this->collEvaluacion_paquetes as $referrerFK) {
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
		$pos = TareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdCurso();
				break;
			case 2:
				return $this->getIdEjercicio();
				break;
			case 3:
				return $this->getIdAutor();
				break;
			case 4:
				return $this->getIdEvento();
				break;
			case 5:
				return $this->getTiempoDisponible();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TareaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCurso(),
			$keys[2] => $this->getIdEjercicio(),
			$keys[3] => $this->getIdAutor(),
			$keys[4] => $this->getIdEvento(),
			$keys[5] => $this->getTiempoDisponible(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdCurso($value);
				break;
			case 2:
				$this->setIdEjercicio($value);
				break;
			case 3:
				$this->setIdAutor($value);
				break;
			case 4:
				$this->setIdEvento($value);
				break;
			case 5:
				$this->setTiempoDisponible($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TareaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEjercicio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdAutor($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdEvento($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTiempoDisponible($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TareaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TareaPeer::ID)) $criteria->add(TareaPeer::ID, $this->id);
		if ($this->isColumnModified(TareaPeer::ID_CURSO)) $criteria->add(TareaPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(TareaPeer::ID_EJERCICIO)) $criteria->add(TareaPeer::ID_EJERCICIO, $this->id_ejercicio);
		if ($this->isColumnModified(TareaPeer::ID_AUTOR)) $criteria->add(TareaPeer::ID_AUTOR, $this->id_autor);
		if ($this->isColumnModified(TareaPeer::ID_EVENTO)) $criteria->add(TareaPeer::ID_EVENTO, $this->id_evento);
		if ($this->isColumnModified(TareaPeer::TIEMPO_DISPONIBLE)) $criteria->add(TareaPeer::TIEMPO_DISPONIBLE, $this->tiempo_disponible);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TareaPeer::DATABASE_NAME);

		$criteria->add(TareaPeer::ID, $this->id);

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

		$copyObj->setIdCurso($this->id_curso);

		$copyObj->setIdEjercicio($this->id_ejercicio);

		$copyObj->setIdAutor($this->id_autor);

		$copyObj->setIdEvento($this->id_evento);

		$copyObj->setTiempoDisponible($this->tiempo_disponible);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_usuario_tareas() as $relObj) {
				$copyObj->addRel_usuario_tarea($relObj->copy($deepCopy));
			}

			foreach($this->getEvaluacion_paquetes() as $relObj) {
				$copyObj->addEvaluacion_paquete($relObj->copy($deepCopy));
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
			self::$peer = new TareaPeer();
		}
		return self::$peer;
	}

	
	public function setCurso($v)
	{


		if ($v === null) {
			$this->setIdCurso(NULL);
		} else {
			$this->setIdCurso($v->getId());
		}


		$this->aCurso = $v;
	}


	
	public function getCurso($con = null)
	{
		if ($this->aCurso === null && (($this->id_curso !== "" && $this->id_curso !== null))) {
						include_once 'lib/model/om/BaseCursoPeer.php';

			$this->aCurso = CursoPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aCurso;
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

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdAutor(NULL);
		} else {
			$this->setIdAutor($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->id_autor !== "" && $this->id_autor !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_autor, $con);

			
		}
		return $this->aUsuario;
	}

	
	public function setEvento($v)
	{


		if ($v === null) {
			$this->setIdEvento(NULL);
		} else {
			$this->setIdEvento($v->getId());
		}


		$this->aEvento = $v;
	}


	
	public function getEvento($con = null)
	{
		if ($this->aEvento === null && (($this->id_evento !== "" && $this->id_evento !== null))) {
						include_once 'lib/model/om/BaseEventoPeer.php';

			$this->aEvento = EventoPeer::retrieveByPK($this->id_evento, $con);

			
		}
		return $this->aEvento;
	}

	
	public function initRel_usuario_tareas()
	{
		if ($this->collRel_usuario_tareas === null) {
			$this->collRel_usuario_tareas = array();
		}
	}

	
	public function getRel_usuario_tareas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

				Rel_usuario_tareaPeer::addSelectColumns($criteria);
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

				Rel_usuario_tareaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
					$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;
		return $this->collRel_usuario_tareas;
	}

	
	public function countRel_usuario_tareas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

		return Rel_usuario_tareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_tarea(Rel_usuario_tarea $l)
	{
		$this->collRel_usuario_tareas[] = $l;
		$l->setTarea($this);
	}


	
	public function getRel_usuario_tareasJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}


	
	public function getRel_usuario_tareasJoinEjercicio_resuelto($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}

	
	public function initEvaluacion_paquetes()
	{
		if ($this->collEvaluacion_paquetes === null) {
			$this->collEvaluacion_paquetes = array();
		}
	}

	
	public function getEvaluacion_paquetes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvaluacion_paquetes === null) {
			if ($this->isNew()) {
			   $this->collEvaluacion_paquetes = array();
			} else {

				$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $this->getId());

				Evaluacion_paquetePeer::addSelectColumns($criteria);
				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $this->getId());

				Evaluacion_paquetePeer::addSelectColumns($criteria);
				if (!isset($this->lastEvaluacion_paqueteCriteria) || !$this->lastEvaluacion_paqueteCriteria->equals($criteria)) {
					$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEvaluacion_paqueteCriteria = $criteria;
		return $this->collEvaluacion_paquetes;
	}

	
	public function countEvaluacion_paquetes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $this->getId());

		return Evaluacion_paquetePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvaluacion_paquete(Evaluacion_paquete $l)
	{
		$this->collEvaluacion_paquetes[] = $l;
		$l->setTarea($this);
	}


	
	public function getEvaluacion_paquetesJoinPaquete($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvaluacion_paquetes === null) {
			if ($this->isNew()) {
				$this->collEvaluacion_paquetes = array();
			} else {

				$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $this->getId());

				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelectJoinPaquete($criteria, $con);
			}
		} else {
									
			$criteria->add(Evaluacion_paquetePeer::ID_TAREA, $this->getId());

			if (!isset($this->lastEvaluacion_paqueteCriteria) || !$this->lastEvaluacion_paqueteCriteria->equals($criteria)) {
				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelectJoinPaquete($criteria, $con);
			}
		}
		$this->lastEvaluacion_paqueteCriteria = $criteria;

		return $this->collEvaluacion_paquetes;
	}

} 