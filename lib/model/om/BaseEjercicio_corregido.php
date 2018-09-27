<?php


abstract class BaseEjercicio_corregido extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_corrector;


	
	protected $id_ejercicio_resuelto;

	
	protected $aUsuario;

	
	protected $aEjercicio_resuelto;

	
	protected $collComentario_cuestions;

	
	protected $lastComentario_cuestionCriteria = null;

	
	protected $collCorreccion_cuestion_practicas;

	
	protected $lastCorreccion_cuestion_practicaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdCorrector()
	{

		return $this->id_corrector;
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
			$this->modifiedColumns[] = Ejercicio_corregidoPeer::ID;
		}

	} 
	
	public function setIdCorrector($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_corrector !== $v) {
			$this->id_corrector = $v;
			$this->modifiedColumns[] = Ejercicio_corregidoPeer::ID_CORRECTOR;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdEjercicioResuelto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_resuelto !== $v) {
			$this->id_ejercicio_resuelto = $v;
			$this->modifiedColumns[] = Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_corrector = $rs->getString($startcol + 1);

			$this->id_ejercicio_resuelto = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ejercicio_corregido object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Ejercicio_corregidoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Ejercicio_corregidoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Ejercicio_corregidoPeer::DATABASE_NAME);
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

			if ($this->aEjercicio_resuelto !== null) {
				if ($this->aEjercicio_resuelto->isModified()) {
					$affectedRows += $this->aEjercicio_resuelto->save($con);
				}
				$this->setEjercicio_resuelto($this->aEjercicio_resuelto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Ejercicio_corregidoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Ejercicio_corregidoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collComentario_cuestions !== null) {
				foreach($this->collComentario_cuestions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCorreccion_cuestion_practicas !== null) {
				foreach($this->collCorreccion_cuestion_practicas as $referrerFK) {
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aEjercicio_resuelto !== null) {
				if (!$this->aEjercicio_resuelto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_resuelto->getValidationFailures());
				}
			}


			if (($retval = Ejercicio_corregidoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collComentario_cuestions !== null) {
					foreach($this->collComentario_cuestions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCorreccion_cuestion_practicas !== null) {
					foreach($this->collCorreccion_cuestion_practicas as $referrerFK) {
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
		$pos = Ejercicio_corregidoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdCorrector();
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
		$keys = Ejercicio_corregidoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCorrector(),
			$keys[2] => $this->getIdEjercicioResuelto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Ejercicio_corregidoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdCorrector($value);
				break;
			case 2:
				$this->setIdEjercicioResuelto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Ejercicio_corregidoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCorrector($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEjercicioResuelto($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Ejercicio_corregidoPeer::DATABASE_NAME);

		if ($this->isColumnModified(Ejercicio_corregidoPeer::ID)) $criteria->add(Ejercicio_corregidoPeer::ID, $this->id);
		if ($this->isColumnModified(Ejercicio_corregidoPeer::ID_CORRECTOR)) $criteria->add(Ejercicio_corregidoPeer::ID_CORRECTOR, $this->id_corrector);
		if ($this->isColumnModified(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO)) $criteria->add(Ejercicio_corregidoPeer::ID_EJERCICIO_RESUELTO, $this->id_ejercicio_resuelto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Ejercicio_corregidoPeer::DATABASE_NAME);

		$criteria->add(Ejercicio_corregidoPeer::ID, $this->id);

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

		$copyObj->setIdCorrector($this->id_corrector);

		$copyObj->setIdEjercicioResuelto($this->id_ejercicio_resuelto);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getComentario_cuestions() as $relObj) {
				$copyObj->addComentario_cuestion($relObj->copy($deepCopy));
			}

			foreach($this->getCorreccion_cuestion_practicas() as $relObj) {
				$copyObj->addCorreccion_cuestion_practica($relObj->copy($deepCopy));
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
			self::$peer = new Ejercicio_corregidoPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdCorrector(NULL);
		} else {
			$this->setIdCorrector($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';

		if ($this->aUsuario === null && (($this->id_corrector !== "" && $this->id_corrector !== null))) {

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_corrector, $con);

			
		}
		return $this->aUsuario;
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
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';

		if ($this->aEjercicio_resuelto === null && (($this->id_ejercicio_resuelto !== "" && $this->id_ejercicio_resuelto !== null))) {

			$this->aEjercicio_resuelto = Ejercicio_resueltoPeer::retrieveByPK($this->id_ejercicio_resuelto, $con);

			
		}
		return $this->aEjercicio_resuelto;
	}

	
	public function initComentario_cuestions()
	{
		if ($this->collComentario_cuestions === null) {
			$this->collComentario_cuestions = array();
		}
	}

	
	public function getComentario_cuestions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComentario_cuestionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComentario_cuestions === null) {
			if ($this->isNew()) {
			   $this->collComentario_cuestions = array();
			} else {

				$criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				Comentario_cuestionPeer::addSelectColumns($criteria);
				$this->collComentario_cuestions = Comentario_cuestionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				Comentario_cuestionPeer::addSelectColumns($criteria);
				if (!isset($this->lastComentario_cuestionCriteria) || !$this->lastComentario_cuestionCriteria->equals($criteria)) {
					$this->collComentario_cuestions = Comentario_cuestionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastComentario_cuestionCriteria = $criteria;
		return $this->collComentario_cuestions;
	}

	
	public function countComentario_cuestions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseComentario_cuestionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

		return Comentario_cuestionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComentario_cuestion(Comentario_cuestion $l)
	{
		$this->collComentario_cuestions[] = $l;
		$l->setEjercicio_corregido($this);
	}


	
	public function getComentario_cuestionsJoinRespuesta_cuestion_corta($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComentario_cuestionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComentario_cuestions === null) {
			if ($this->isNew()) {
				$this->collComentario_cuestions = array();
			} else {

				$criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				$this->collComentario_cuestions = Comentario_cuestionPeer::doSelectJoinRespuesta_cuestion_corta($criteria, $con);
			}
		} else {
									
			$criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

			if (!isset($this->lastComentario_cuestionCriteria) || !$this->lastComentario_cuestionCriteria->equals($criteria)) {
				$this->collComentario_cuestions = Comentario_cuestionPeer::doSelectJoinRespuesta_cuestion_corta($criteria, $con);
			}
		}
		$this->lastComentario_cuestionCriteria = $criteria;

		return $this->collComentario_cuestions;
	}

	
	public function initCorreccion_cuestion_practicas()
	{
		if ($this->collCorreccion_cuestion_practicas === null) {
			$this->collCorreccion_cuestion_practicas = array();
		}
	}

	
	public function getCorreccion_cuestion_practicas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCorreccion_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCorreccion_cuestion_practicas === null) {
			if ($this->isNew()) {
			   $this->collCorreccion_cuestion_practicas = array();
			} else {

				$criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				Correccion_cuestion_practicaPeer::addSelectColumns($criteria);
				$this->collCorreccion_cuestion_practicas = Correccion_cuestion_practicaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				Correccion_cuestion_practicaPeer::addSelectColumns($criteria);
				if (!isset($this->lastCorreccion_cuestion_practicaCriteria) || !$this->lastCorreccion_cuestion_practicaCriteria->equals($criteria)) {
					$this->collCorreccion_cuestion_practicas = Correccion_cuestion_practicaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCorreccion_cuestion_practicaCriteria = $criteria;
		return $this->collCorreccion_cuestion_practicas;
	}

	
	public function countCorreccion_cuestion_practicas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCorreccion_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

		return Correccion_cuestion_practicaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCorreccion_cuestion_practica(Correccion_cuestion_practica $l)
	{
		$this->collCorreccion_cuestion_practicas[] = $l;
		$l->setEjercicio_corregido($this);
	}


	
	public function getCorreccion_cuestion_practicasJoinRespuesta_cuestion_practica($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCorreccion_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCorreccion_cuestion_practicas === null) {
			if ($this->isNew()) {
				$this->collCorreccion_cuestion_practicas = array();
			} else {

				$criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

				$this->collCorreccion_cuestion_practicas = Correccion_cuestion_practicaPeer::doSelectJoinRespuesta_cuestion_practica($criteria, $con);
			}
		} else {
									
			$criteria->add(Correccion_cuestion_practicaPeer::ID_EJERCICIO_CORREGIDO, $this->getId());

			if (!isset($this->lastCorreccion_cuestion_practicaCriteria) || !$this->lastCorreccion_cuestion_practicaCriteria->equals($criteria)) {
				$this->collCorreccion_cuestion_practicas = Correccion_cuestion_practicaPeer::doSelectJoinRespuesta_cuestion_practica($criteria, $con);
			}
		}
		$this->lastCorreccion_cuestion_practicaCriteria = $criteria;

		return $this->collCorreccion_cuestion_practicas;
	}

} 