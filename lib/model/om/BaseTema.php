<?php


abstract class BaseTema extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $fichero;


	
	protected $numero_tema;


	
	protected $id_materia;


	
	protected $created_at;

	
	protected $aMateria;

	
	protected $collRel_curso_temas;

	
	protected $lastRel_curso_temaCriteria = null;

	
	protected $collRel_usuario_temas;

	
	protected $lastRel_usuario_temaCriteria = null;

	
	protected $collNotificacions;

	
	protected $lastNotificacionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getFichero()
	{

		return $this->fichero;
	}

	
	public function getNumeroTema()
	{

		return $this->numero_tema;
	}

	
	public function getIdMateria()
	{

		return $this->id_materia;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TemaPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = TemaPeer::NOMBRE;
		}

	} 
	
	public function setFichero($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fichero !== $v) {
			$this->fichero = $v;
			$this->modifiedColumns[] = TemaPeer::FICHERO;
		}

	} 
	
	public function setNumeroTema($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->numero_tema !== $v) {
			$this->numero_tema = $v;
			$this->modifiedColumns[] = TemaPeer::NUMERO_TEMA;
		}

	} 
	
	public function setIdMateria($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_materia !== $v) {
			$this->id_materia = $v;
			$this->modifiedColumns[] = TemaPeer::ID_MATERIA;
		}

		if ($this->aMateria !== null && $this->aMateria->getId() !== $v) {
			$this->aMateria = null;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = TemaPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->fichero = $rs->getString($startcol + 2);

			$this->numero_tema = $rs->getInt($startcol + 3);

			$this->id_materia = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tema object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TemaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TemaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TemaPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TemaPeer::DATABASE_NAME);
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


												
			if ($this->aMateria !== null) {
				if ($this->aMateria->isModified()) {
					$affectedRows += $this->aMateria->save($con);
				}
				$this->setMateria($this->aMateria);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TemaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TemaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_curso_temas !== null) {
				foreach($this->collRel_curso_temas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_temas !== null) {
				foreach($this->collRel_usuario_temas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach($this->collNotificacions as $referrerFK) {
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


												
			if ($this->aMateria !== null) {
				if (!$this->aMateria->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMateria->getValidationFailures());
				}
			}


			if (($retval = TemaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_curso_temas !== null) {
					foreach($this->collRel_curso_temas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_temas !== null) {
					foreach($this->collRel_usuario_temas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach($this->collNotificacions as $referrerFK) {
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
		$pos = TemaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getFichero();
				break;
			case 3:
				return $this->getNumeroTema();
				break;
			case 4:
				return $this->getIdMateria();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getFichero(),
			$keys[3] => $this->getNumeroTema(),
			$keys[4] => $this->getIdMateria(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TemaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setFichero($value);
				break;
			case 3:
				$this->setNumeroTema($value);
				break;
			case 4:
				$this->setIdMateria($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFichero($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNumeroTema($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdMateria($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TemaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TemaPeer::ID)) $criteria->add(TemaPeer::ID, $this->id);
		if ($this->isColumnModified(TemaPeer::NOMBRE)) $criteria->add(TemaPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(TemaPeer::FICHERO)) $criteria->add(TemaPeer::FICHERO, $this->fichero);
		if ($this->isColumnModified(TemaPeer::NUMERO_TEMA)) $criteria->add(TemaPeer::NUMERO_TEMA, $this->numero_tema);
		if ($this->isColumnModified(TemaPeer::ID_MATERIA)) $criteria->add(TemaPeer::ID_MATERIA, $this->id_materia);
		if ($this->isColumnModified(TemaPeer::CREATED_AT)) $criteria->add(TemaPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TemaPeer::DATABASE_NAME);

		$criteria->add(TemaPeer::ID, $this->id);

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

		$copyObj->setNombre($this->nombre);

		$copyObj->setFichero($this->fichero);

		$copyObj->setNumeroTema($this->numero_tema);

		$copyObj->setIdMateria($this->id_materia);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_curso_temas() as $relObj) {
				$copyObj->addRel_curso_tema($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_temas() as $relObj) {
				$copyObj->addRel_usuario_tema($relObj->copy($deepCopy));
			}

			foreach($this->getNotificacions() as $relObj) {
				$copyObj->addNotificacion($relObj->copy($deepCopy));
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
			self::$peer = new TemaPeer();
		}
		return self::$peer;
	}

	
	public function setMateria($v)
	{


		if ($v === null) {
			$this->setIdMateria(NULL);
		} else {
			$this->setIdMateria($v->getId());
		}


		$this->aMateria = $v;
	}


	
	public function getMateria($con = null)
	{
		if ($this->aMateria === null && (($this->id_materia !== "" && $this->id_materia !== null))) {
						include_once 'lib/model/om/BaseMateriaPeer.php';

			$this->aMateria = MateriaPeer::retrieveByPK($this->id_materia, $con);

			
		}
		return $this->aMateria;
	}

	
	public function initRel_curso_temas()
	{
		if ($this->collRel_curso_temas === null) {
			$this->collRel_curso_temas = array();
		}
	}

	
	public function getRel_curso_temas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_curso_temas === null) {
			if ($this->isNew()) {
			   $this->collRel_curso_temas = array();
			} else {

				$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->getId());

				Rel_curso_temaPeer::addSelectColumns($criteria);
				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->getId());

				Rel_curso_temaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_curso_temaCriteria) || !$this->lastRel_curso_temaCriteria->equals($criteria)) {
					$this->collRel_curso_temas = Rel_curso_temaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_curso_temaCriteria = $criteria;
		return $this->collRel_curso_temas;
	}

	
	public function countRel_curso_temas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->getId());

		return Rel_curso_temaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_curso_tema(Rel_curso_tema $l)
	{
		$this->collRel_curso_temas[] = $l;
		$l->setTema($this);
	}


	
	public function getRel_curso_temasJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_curso_temas === null) {
			if ($this->isNew()) {
				$this->collRel_curso_temas = array();
			} else {

				$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->getId());

				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->getId());

			if (!isset($this->lastRel_curso_temaCriteria) || !$this->lastRel_curso_temaCriteria->equals($criteria)) {
				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_curso_temaCriteria = $criteria;

		return $this->collRel_curso_temas;
	}

	
	public function initRel_usuario_temas()
	{
		if ($this->collRel_usuario_temas === null) {
			$this->collRel_usuario_temas = array();
		}
	}

	
	public function getRel_usuario_temas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_temas === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_temas = array();
			} else {

				$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->getId());

				Rel_usuario_temaPeer::addSelectColumns($criteria);
				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->getId());

				Rel_usuario_temaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_temaCriteria) || !$this->lastRel_usuario_temaCriteria->equals($criteria)) {
					$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_temaCriteria = $criteria;
		return $this->collRel_usuario_temas;
	}

	
	public function countRel_usuario_temas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->getId());

		return Rel_usuario_temaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_tema(Rel_usuario_tema $l)
	{
		$this->collRel_usuario_temas[] = $l;
		$l->setTema($this);
	}


	
	public function getRel_usuario_temasJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_temas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_temas = array();
			} else {

				$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->getId());

				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_temaPeer::ID_TEMA, $this->getId());

			if (!isset($this->lastRel_usuario_temaCriteria) || !$this->lastRel_usuario_temaCriteria->equals($criteria)) {
				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_temaCriteria = $criteria;

		return $this->collRel_usuario_temas;
	}

	
	public function initNotificacions()
	{
		if ($this->collNotificacions === null) {
			$this->collNotificacions = array();
		}
	}

	
	public function getNotificacions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	
	public function countNotificacions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

		return NotificacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotificacion(Notificacion $l)
	{
		$this->collNotificacions[] = $l;
		$l->setTema($this);
	}


	
	public function getNotificacionsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}


	
	public function getNotificacionsJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_TEMA, $this->getId());

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}

} 