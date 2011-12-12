<?php


abstract class BaseSco12 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ref_sco12;


	
	protected $id_materia;


	
	protected $title;


	
	protected $file;


	
	protected $credit;


	
	protected $launch_data;


	
	protected $mastery_score;


	
	protected $max_time_allowed;


	
	protected $time_limit_action;

	
	protected $aMateria;

	
	protected $collRel_usuario_sco12s;

	
	protected $lastRel_usuario_sco12Criteria = null;

	
	protected $collRel_usuario_objetivo_sco12s;

	
	protected $lastRel_usuario_objetivo_sco12Criteria = null;

	
	protected $collRel_usuario_interaccion_sco12s;

	
	protected $lastRel_usuario_interaccion_sco12Criteria = null;

	
	protected $collRel_interaccion_sco12_objetivos;

	
	protected $lastRel_interaccion_sco12_objetivoCriteria = null;

	
	protected $collRel_interaccion_sco12_respuestas;

	
	protected $lastRel_interaccion_sco12_respuestaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRefSco12()
	{

		return $this->ref_sco12;
	}

	
	public function getIdMateria()
	{

		return $this->id_materia;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getFile()
	{

		return $this->file;
	}

	
	public function getCredit()
	{

		return $this->credit;
	}

	
	public function getLaunchData()
	{

		return $this->launch_data;
	}

	
	public function getMasteryScore()
	{

		return $this->mastery_score;
	}

	
	public function getMaxTimeAllowed()
	{

		return $this->max_time_allowed;
	}

	
	public function getTimeLimitAction()
	{

		return $this->time_limit_action;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Sco12Peer::ID;
		}

	} 
	
	public function setRefSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ref_sco12 !== $v) {
			$this->ref_sco12 = $v;
			$this->modifiedColumns[] = Sco12Peer::REF_SCO12;
		}

	} 
	
	public function setIdMateria($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_materia !== $v) {
			$this->id_materia = $v;
			$this->modifiedColumns[] = Sco12Peer::ID_MATERIA;
		}

		if ($this->aMateria !== null && $this->aMateria->getId() !== $v) {
			$this->aMateria = null;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = Sco12Peer::TITLE;
		}

	} 
	
	public function setFile($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file !== $v) {
			$this->file = $v;
			$this->modifiedColumns[] = Sco12Peer::FILE;
		}

	} 
	
	public function setCredit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credit !== $v) {
			$this->credit = $v;
			$this->modifiedColumns[] = Sco12Peer::CREDIT;
		}

	} 
	
	public function setLaunchData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->launch_data !== $v) {
			$this->launch_data = $v;
			$this->modifiedColumns[] = Sco12Peer::LAUNCH_DATA;
		}

	} 
	
	public function setMasteryScore($v)
	{

		if ($this->mastery_score !== $v) {
			$this->mastery_score = $v;
			$this->modifiedColumns[] = Sco12Peer::MASTERY_SCORE;
		}

	} 
	
	public function setMaxTimeAllowed($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->max_time_allowed !== $v) {
			$this->max_time_allowed = $v;
			$this->modifiedColumns[] = Sco12Peer::MAX_TIME_ALLOWED;
		}

	} 
	
	public function setTimeLimitAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->time_limit_action !== $v) {
			$this->time_limit_action = $v;
			$this->modifiedColumns[] = Sco12Peer::TIME_LIMIT_ACTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->ref_sco12 = $rs->getString($startcol + 1);

			$this->id_materia = $rs->getString($startcol + 2);

			$this->title = $rs->getString($startcol + 3);

			$this->file = $rs->getString($startcol + 4);

			$this->credit = $rs->getString($startcol + 5);

			$this->launch_data = $rs->getString($startcol + 6);

			$this->mastery_score = $rs->getFloat($startcol + 7);

			$this->max_time_allowed = $rs->getString($startcol + 8);

			$this->time_limit_action = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sco12 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Sco12Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Sco12Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Sco12Peer::DATABASE_NAME);
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
					$pk = Sco12Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Sco12Peer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_usuario_sco12s !== null) {
				foreach($this->collRel_usuario_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_objetivo_sco12s !== null) {
				foreach($this->collRel_usuario_objetivo_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_interaccion_sco12s !== null) {
				foreach($this->collRel_usuario_interaccion_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_interaccion_sco12_objetivos !== null) {
				foreach($this->collRel_interaccion_sco12_objetivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_interaccion_sco12_respuestas !== null) {
				foreach($this->collRel_interaccion_sco12_respuestas as $referrerFK) {
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


			if (($retval = Sco12Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_usuario_sco12s !== null) {
					foreach($this->collRel_usuario_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_objetivo_sco12s !== null) {
					foreach($this->collRel_usuario_objetivo_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_interaccion_sco12s !== null) {
					foreach($this->collRel_usuario_interaccion_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_interaccion_sco12_objetivos !== null) {
					foreach($this->collRel_interaccion_sco12_objetivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_interaccion_sco12_respuestas !== null) {
					foreach($this->collRel_interaccion_sco12_respuestas as $referrerFK) {
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
		$pos = Sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRefSco12();
				break;
			case 2:
				return $this->getIdMateria();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getFile();
				break;
			case 5:
				return $this->getCredit();
				break;
			case 6:
				return $this->getLaunchData();
				break;
			case 7:
				return $this->getMasteryScore();
				break;
			case 8:
				return $this->getMaxTimeAllowed();
				break;
			case 9:
				return $this->getTimeLimitAction();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Sco12Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRefSco12(),
			$keys[2] => $this->getIdMateria(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getFile(),
			$keys[5] => $this->getCredit(),
			$keys[6] => $this->getLaunchData(),
			$keys[7] => $this->getMasteryScore(),
			$keys[8] => $this->getMaxTimeAllowed(),
			$keys[9] => $this->getTimeLimitAction(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRefSco12($value);
				break;
			case 2:
				$this->setIdMateria($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setFile($value);
				break;
			case 5:
				$this->setCredit($value);
				break;
			case 6:
				$this->setLaunchData($value);
				break;
			case 7:
				$this->setMasteryScore($value);
				break;
			case 8:
				$this->setMaxTimeAllowed($value);
				break;
			case 9:
				$this->setTimeLimitAction($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Sco12Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRefSco12($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdMateria($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFile($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCredit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLaunchData($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMasteryScore($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMaxTimeAllowed($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTimeLimitAction($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Sco12Peer::DATABASE_NAME);

		if ($this->isColumnModified(Sco12Peer::ID)) $criteria->add(Sco12Peer::ID, $this->id);
		if ($this->isColumnModified(Sco12Peer::REF_SCO12)) $criteria->add(Sco12Peer::REF_SCO12, $this->ref_sco12);
		if ($this->isColumnModified(Sco12Peer::ID_MATERIA)) $criteria->add(Sco12Peer::ID_MATERIA, $this->id_materia);
		if ($this->isColumnModified(Sco12Peer::TITLE)) $criteria->add(Sco12Peer::TITLE, $this->title);
		if ($this->isColumnModified(Sco12Peer::FILE)) $criteria->add(Sco12Peer::FILE, $this->file);
		if ($this->isColumnModified(Sco12Peer::CREDIT)) $criteria->add(Sco12Peer::CREDIT, $this->credit);
		if ($this->isColumnModified(Sco12Peer::LAUNCH_DATA)) $criteria->add(Sco12Peer::LAUNCH_DATA, $this->launch_data);
		if ($this->isColumnModified(Sco12Peer::MASTERY_SCORE)) $criteria->add(Sco12Peer::MASTERY_SCORE, $this->mastery_score);
		if ($this->isColumnModified(Sco12Peer::MAX_TIME_ALLOWED)) $criteria->add(Sco12Peer::MAX_TIME_ALLOWED, $this->max_time_allowed);
		if ($this->isColumnModified(Sco12Peer::TIME_LIMIT_ACTION)) $criteria->add(Sco12Peer::TIME_LIMIT_ACTION, $this->time_limit_action);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Sco12Peer::DATABASE_NAME);

		$criteria->add(Sco12Peer::ID, $this->id);

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

		$copyObj->setRefSco12($this->ref_sco12);

		$copyObj->setIdMateria($this->id_materia);

		$copyObj->setTitle($this->title);

		$copyObj->setFile($this->file);

		$copyObj->setCredit($this->credit);

		$copyObj->setLaunchData($this->launch_data);

		$copyObj->setMasteryScore($this->mastery_score);

		$copyObj->setMaxTimeAllowed($this->max_time_allowed);

		$copyObj->setTimeLimitAction($this->time_limit_action);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_usuario_sco12s() as $relObj) {
				$copyObj->addRel_usuario_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_objetivo_sco12s() as $relObj) {
				$copyObj->addRel_usuario_objetivo_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_interaccion_sco12s() as $relObj) {
				$copyObj->addRel_usuario_interaccion_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_interaccion_sco12_objetivos() as $relObj) {
				$copyObj->addRel_interaccion_sco12_objetivo($relObj->copy($deepCopy));
			}

			foreach($this->getRel_interaccion_sco12_respuestas() as $relObj) {
				$copyObj->addRel_interaccion_sco12_respuesta($relObj->copy($deepCopy));
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
			self::$peer = new Sco12Peer();
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

	
	public function initRel_usuario_sco12s()
	{
		if ($this->collRel_usuario_sco12s === null) {
			$this->collRel_usuario_sco12s = array();
		}
	}

	
	public function getRel_usuario_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco12Criteria) || !$this->lastRel_usuario_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco12Criteria = $criteria;
		return $this->collRel_usuario_sco12s;
	}

	
	public function countRel_usuario_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());

		return Rel_usuario_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco12(Rel_usuario_sco12 $l)
	{
		$this->collRel_usuario_sco12s[] = $l;
		$l->setSco12($this);
	}


	
	public function getRel_usuario_sco12sJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());

				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());

			if (!isset($this->lastRel_usuario_sco12Criteria) || !$this->lastRel_usuario_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco12Criteria = $criteria;

		return $this->collRel_usuario_sco12s;
	}

	
	public function initRel_usuario_objetivo_sco12s()
	{
		if ($this->collRel_usuario_objetivo_sco12s === null) {
			$this->collRel_usuario_objetivo_sco12s = array();
		}
	}

	
	public function getRel_usuario_objetivo_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_objetivo_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_objetivo_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_objetivo_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_objetivo_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_objetivo_sco12Criteria) || !$this->lastRel_usuario_objetivo_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_objetivo_sco12Criteria = $criteria;
		return $this->collRel_usuario_objetivo_sco12s;
	}

	
	public function countRel_usuario_objetivo_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->getId());

		return Rel_usuario_objetivo_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_objetivo_sco12(Rel_usuario_objetivo_sco12 $l)
	{
		$this->collRel_usuario_objetivo_sco12s[] = $l;
		$l->setSco12($this);
	}


	
	public function getRel_usuario_objetivo_sco12sJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_objetivo_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_objetivo_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->getId());

				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->getId());

			if (!isset($this->lastRel_usuario_objetivo_sco12Criteria) || !$this->lastRel_usuario_objetivo_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_objetivo_sco12Criteria = $criteria;

		return $this->collRel_usuario_objetivo_sco12s;
	}

	
	public function initRel_usuario_interaccion_sco12s()
	{
		if ($this->collRel_usuario_interaccion_sco12s === null) {
			$this->collRel_usuario_interaccion_sco12s = array();
		}
	}

	
	public function getRel_usuario_interaccion_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_interaccion_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_interaccion_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_interaccion_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->getId());

				Rel_usuario_interaccion_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_interaccion_sco12Criteria) || !$this->lastRel_usuario_interaccion_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_interaccion_sco12Criteria = $criteria;
		return $this->collRel_usuario_interaccion_sco12s;
	}

	
	public function countRel_usuario_interaccion_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->getId());

		return Rel_usuario_interaccion_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_interaccion_sco12(Rel_usuario_interaccion_sco12 $l)
	{
		$this->collRel_usuario_interaccion_sco12s[] = $l;
		$l->setSco12($this);
	}


	
	public function getRel_usuario_interaccion_sco12sJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_interaccion_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_interaccion_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->getId());

				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->getId());

			if (!isset($this->lastRel_usuario_interaccion_sco12Criteria) || !$this->lastRel_usuario_interaccion_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_interaccion_sco12Criteria = $criteria;

		return $this->collRel_usuario_interaccion_sco12s;
	}

	
	public function initRel_interaccion_sco12_objetivos()
	{
		if ($this->collRel_interaccion_sco12_objetivos === null) {
			$this->collRel_interaccion_sco12_objetivos = array();
		}
	}

	
	public function getRel_interaccion_sco12_objetivos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_objetivos === null) {
			if ($this->isNew()) {
			   $this->collRel_interaccion_sco12_objetivos = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->getId());

				Rel_interaccion_sco12_objetivoPeer::addSelectColumns($criteria);
				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->getId());

				Rel_interaccion_sco12_objetivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_interaccion_sco12_objetivoCriteria) || !$this->lastRel_interaccion_sco12_objetivoCriteria->equals($criteria)) {
					$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_interaccion_sco12_objetivoCriteria = $criteria;
		return $this->collRel_interaccion_sco12_objetivos;
	}

	
	public function countRel_interaccion_sco12_objetivos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->getId());

		return Rel_interaccion_sco12_objetivoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_interaccion_sco12_objetivo(Rel_interaccion_sco12_objetivo $l)
	{
		$this->collRel_interaccion_sco12_objetivos[] = $l;
		$l->setSco12($this);
	}


	
	public function getRel_interaccion_sco12_objetivosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_objetivos === null) {
			if ($this->isNew()) {
				$this->collRel_interaccion_sco12_objetivos = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->getId());

				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->getId());

			if (!isset($this->lastRel_interaccion_sco12_objetivoCriteria) || !$this->lastRel_interaccion_sco12_objetivoCriteria->equals($criteria)) {
				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_interaccion_sco12_objetivoCriteria = $criteria;

		return $this->collRel_interaccion_sco12_objetivos;
	}

	
	public function initRel_interaccion_sco12_respuestas()
	{
		if ($this->collRel_interaccion_sco12_respuestas === null) {
			$this->collRel_interaccion_sco12_respuestas = array();
		}
	}

	
	public function getRel_interaccion_sco12_respuestas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_respuestas === null) {
			if ($this->isNew()) {
			   $this->collRel_interaccion_sco12_respuestas = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->getId());

				Rel_interaccion_sco12_respuestaPeer::addSelectColumns($criteria);
				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->getId());

				Rel_interaccion_sco12_respuestaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_interaccion_sco12_respuestaCriteria) || !$this->lastRel_interaccion_sco12_respuestaCriteria->equals($criteria)) {
					$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_interaccion_sco12_respuestaCriteria = $criteria;
		return $this->collRel_interaccion_sco12_respuestas;
	}

	
	public function countRel_interaccion_sco12_respuestas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->getId());

		return Rel_interaccion_sco12_respuestaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_interaccion_sco12_respuesta(Rel_interaccion_sco12_respuesta $l)
	{
		$this->collRel_interaccion_sco12_respuestas[] = $l;
		$l->setSco12($this);
	}


	
	public function getRel_interaccion_sco12_respuestasJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_respuestas === null) {
			if ($this->isNew()) {
				$this->collRel_interaccion_sco12_respuestas = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->getId());

				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->getId());

			if (!isset($this->lastRel_interaccion_sco12_respuestaCriteria) || !$this->lastRel_interaccion_sco12_respuestaCriteria->equals($criteria)) {
				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_interaccion_sco12_respuestaCriteria = $criteria;

		return $this->collRel_interaccion_sco12_respuestas;
	}

} 