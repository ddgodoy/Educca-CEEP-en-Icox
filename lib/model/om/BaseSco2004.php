<?php


abstract class BaseSco2004 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ref_sco2004;


	
	protected $id_materia;


	
	protected $title;


	
	protected $file;


	
	protected $completion_treshold;


	
	protected $credit;


	
	protected $launch_data;


	
	protected $max_time_allowed;


	
	protected $mode;


	
	protected $time_limit_action;


	
	protected $scaled_passing_score;

	
	protected $aMateria;

	
	protected $collRel_usuario_sco2004s;

	
	protected $lastRel_usuario_sco2004Criteria = null;

	
	protected $collRel_usuario_sco2004_learnercs;

	
	protected $lastRel_usuario_sco2004_learnercCriteria = null;

	
	protected $collRel_usuario_sco2004_lmscs;

	
	protected $lastRel_usuario_sco2004_lmscCriteria = null;

	
	protected $collRel_usuario_sco2004_interactions;

	
	protected $lastRel_usuario_sco2004_interactionCriteria = null;

	
	protected $collRel_usuario_sco2004_iobjectives;

	
	protected $lastRel_usuario_sco2004_iobjectiveCriteria = null;

	
	protected $collRel_usuario_sco2004_iresponses;

	
	protected $lastRel_usuario_sco2004_iresponseCriteria = null;

	
	protected $collRel_usuario_sco2004_objectives;

	
	protected $lastRel_usuario_sco2004_objectiveCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRefSco2004()
	{

		return $this->ref_sco2004;
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

	
	public function getCompletionTreshold()
	{

		return $this->completion_treshold;
	}

	
	public function getCredit()
	{

		return $this->credit;
	}

	
	public function getLaunchData()
	{

		return $this->launch_data;
	}

	
	public function getMaxTimeAllowed()
	{

		return $this->max_time_allowed;
	}

	
	public function getMode()
	{

		return $this->mode;
	}

	
	public function getTimeLimitAction()
	{

		return $this->time_limit_action;
	}

	
	public function getScaledPassingScore()
	{

		return $this->scaled_passing_score;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Sco2004Peer::ID;
		}

	} 
	
	public function setRefSco2004($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ref_sco2004 !== $v) {
			$this->ref_sco2004 = $v;
			$this->modifiedColumns[] = Sco2004Peer::REF_SCO2004;
		}

	} 
	
	public function setIdMateria($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_materia !== $v) {
			$this->id_materia = $v;
			$this->modifiedColumns[] = Sco2004Peer::ID_MATERIA;
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
			$this->modifiedColumns[] = Sco2004Peer::TITLE;
		}

	} 
	
	public function setFile($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file !== $v) {
			$this->file = $v;
			$this->modifiedColumns[] = Sco2004Peer::FILE;
		}

	} 
	
	public function setCompletionTreshold($v)
	{

		if ($this->completion_treshold !== $v) {
			$this->completion_treshold = $v;
			$this->modifiedColumns[] = Sco2004Peer::COMPLETION_TRESHOLD;
		}

	} 
	
	public function setCredit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credit !== $v) {
			$this->credit = $v;
			$this->modifiedColumns[] = Sco2004Peer::CREDIT;
		}

	} 
	
	public function setLaunchData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->launch_data !== $v) {
			$this->launch_data = $v;
			$this->modifiedColumns[] = Sco2004Peer::LAUNCH_DATA;
		}

	} 
	
	public function setMaxTimeAllowed($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->max_time_allowed !== $v) {
			$this->max_time_allowed = $v;
			$this->modifiedColumns[] = Sco2004Peer::MAX_TIME_ALLOWED;
		}

	} 
	
	public function setMode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mode !== $v) {
			$this->mode = $v;
			$this->modifiedColumns[] = Sco2004Peer::MODE;
		}

	} 
	
	public function setTimeLimitAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->time_limit_action !== $v) {
			$this->time_limit_action = $v;
			$this->modifiedColumns[] = Sco2004Peer::TIME_LIMIT_ACTION;
		}

	} 
	
	public function setScaledPassingScore($v)
	{

		if ($this->scaled_passing_score !== $v) {
			$this->scaled_passing_score = $v;
			$this->modifiedColumns[] = Sco2004Peer::SCALED_PASSING_SCORE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->ref_sco2004 = $rs->getString($startcol + 1);

			$this->id_materia = $rs->getString($startcol + 2);

			$this->title = $rs->getString($startcol + 3);

			$this->file = $rs->getString($startcol + 4);

			$this->completion_treshold = $rs->getFloat($startcol + 5);

			$this->credit = $rs->getString($startcol + 6);

			$this->launch_data = $rs->getString($startcol + 7);

			$this->max_time_allowed = $rs->getInt($startcol + 8);

			$this->mode = $rs->getString($startcol + 9);

			$this->time_limit_action = $rs->getString($startcol + 10);

			$this->scaled_passing_score = $rs->getFloat($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sco2004 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Sco2004Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Sco2004Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Sco2004Peer::DATABASE_NAME);
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
					$pk = Sco2004Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Sco2004Peer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_usuario_sco2004s !== null) {
				foreach($this->collRel_usuario_sco2004s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_learnercs !== null) {
				foreach($this->collRel_usuario_sco2004_learnercs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_lmscs !== null) {
				foreach($this->collRel_usuario_sco2004_lmscs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_interactions !== null) {
				foreach($this->collRel_usuario_sco2004_interactions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_iobjectives !== null) {
				foreach($this->collRel_usuario_sco2004_iobjectives as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_iresponses !== null) {
				foreach($this->collRel_usuario_sco2004_iresponses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_objectives !== null) {
				foreach($this->collRel_usuario_sco2004_objectives as $referrerFK) {
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


			if (($retval = Sco2004Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_usuario_sco2004s !== null) {
					foreach($this->collRel_usuario_sco2004s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_learnercs !== null) {
					foreach($this->collRel_usuario_sco2004_learnercs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_lmscs !== null) {
					foreach($this->collRel_usuario_sco2004_lmscs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_interactions !== null) {
					foreach($this->collRel_usuario_sco2004_interactions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_iobjectives !== null) {
					foreach($this->collRel_usuario_sco2004_iobjectives as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_iresponses !== null) {
					foreach($this->collRel_usuario_sco2004_iresponses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_objectives !== null) {
					foreach($this->collRel_usuario_sco2004_objectives as $referrerFK) {
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
		$pos = Sco2004Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRefSco2004();
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
				return $this->getCompletionTreshold();
				break;
			case 6:
				return $this->getCredit();
				break;
			case 7:
				return $this->getLaunchData();
				break;
			case 8:
				return $this->getMaxTimeAllowed();
				break;
			case 9:
				return $this->getMode();
				break;
			case 10:
				return $this->getTimeLimitAction();
				break;
			case 11:
				return $this->getScaledPassingScore();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Sco2004Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRefSco2004(),
			$keys[2] => $this->getIdMateria(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getFile(),
			$keys[5] => $this->getCompletionTreshold(),
			$keys[6] => $this->getCredit(),
			$keys[7] => $this->getLaunchData(),
			$keys[8] => $this->getMaxTimeAllowed(),
			$keys[9] => $this->getMode(),
			$keys[10] => $this->getTimeLimitAction(),
			$keys[11] => $this->getScaledPassingScore(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Sco2004Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRefSco2004($value);
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
				$this->setCompletionTreshold($value);
				break;
			case 6:
				$this->setCredit($value);
				break;
			case 7:
				$this->setLaunchData($value);
				break;
			case 8:
				$this->setMaxTimeAllowed($value);
				break;
			case 9:
				$this->setMode($value);
				break;
			case 10:
				$this->setTimeLimitAction($value);
				break;
			case 11:
				$this->setScaledPassingScore($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Sco2004Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRefSco2004($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdMateria($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFile($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCompletionTreshold($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCredit($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLaunchData($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMaxTimeAllowed($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMode($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTimeLimitAction($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setScaledPassingScore($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Sco2004Peer::DATABASE_NAME);

		if ($this->isColumnModified(Sco2004Peer::ID)) $criteria->add(Sco2004Peer::ID, $this->id);
		if ($this->isColumnModified(Sco2004Peer::REF_SCO2004)) $criteria->add(Sco2004Peer::REF_SCO2004, $this->ref_sco2004);
		if ($this->isColumnModified(Sco2004Peer::ID_MATERIA)) $criteria->add(Sco2004Peer::ID_MATERIA, $this->id_materia);
		if ($this->isColumnModified(Sco2004Peer::TITLE)) $criteria->add(Sco2004Peer::TITLE, $this->title);
		if ($this->isColumnModified(Sco2004Peer::FILE)) $criteria->add(Sco2004Peer::FILE, $this->file);
		if ($this->isColumnModified(Sco2004Peer::COMPLETION_TRESHOLD)) $criteria->add(Sco2004Peer::COMPLETION_TRESHOLD, $this->completion_treshold);
		if ($this->isColumnModified(Sco2004Peer::CREDIT)) $criteria->add(Sco2004Peer::CREDIT, $this->credit);
		if ($this->isColumnModified(Sco2004Peer::LAUNCH_DATA)) $criteria->add(Sco2004Peer::LAUNCH_DATA, $this->launch_data);
		if ($this->isColumnModified(Sco2004Peer::MAX_TIME_ALLOWED)) $criteria->add(Sco2004Peer::MAX_TIME_ALLOWED, $this->max_time_allowed);
		if ($this->isColumnModified(Sco2004Peer::MODE)) $criteria->add(Sco2004Peer::MODE, $this->mode);
		if ($this->isColumnModified(Sco2004Peer::TIME_LIMIT_ACTION)) $criteria->add(Sco2004Peer::TIME_LIMIT_ACTION, $this->time_limit_action);
		if ($this->isColumnModified(Sco2004Peer::SCALED_PASSING_SCORE)) $criteria->add(Sco2004Peer::SCALED_PASSING_SCORE, $this->scaled_passing_score);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Sco2004Peer::DATABASE_NAME);

		$criteria->add(Sco2004Peer::ID, $this->id);

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

		$copyObj->setRefSco2004($this->ref_sco2004);

		$copyObj->setIdMateria($this->id_materia);

		$copyObj->setTitle($this->title);

		$copyObj->setFile($this->file);

		$copyObj->setCompletionTreshold($this->completion_treshold);

		$copyObj->setCredit($this->credit);

		$copyObj->setLaunchData($this->launch_data);

		$copyObj->setMaxTimeAllowed($this->max_time_allowed);

		$copyObj->setMode($this->mode);

		$copyObj->setTimeLimitAction($this->time_limit_action);

		$copyObj->setScaledPassingScore($this->scaled_passing_score);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_usuario_sco2004s() as $relObj) {
				$copyObj->addRel_usuario_sco2004($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_learnercs() as $relObj) {
				$copyObj->addRel_usuario_sco2004_learnerc($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_lmscs() as $relObj) {
				$copyObj->addRel_usuario_sco2004_lmsc($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_interactions() as $relObj) {
				$copyObj->addRel_usuario_sco2004_interaction($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_iobjectives() as $relObj) {
				$copyObj->addRel_usuario_sco2004_iobjective($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_iresponses() as $relObj) {
				$copyObj->addRel_usuario_sco2004_iresponse($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_objectives() as $relObj) {
				$copyObj->addRel_usuario_sco2004_objective($relObj->copy($deepCopy));
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
			self::$peer = new Sco2004Peer();
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

	
	public function initRel_usuario_sco2004s()
	{
		if ($this->collRel_usuario_sco2004s === null) {
			$this->collRel_usuario_sco2004s = array();
		}
	}

	
	public function getRel_usuario_sco2004s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004s = array();
			} else {

				$criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004Peer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004Criteria) || !$this->lastRel_usuario_sco2004Criteria->equals($criteria)) {
					$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004Criteria = $criteria;
		return $this->collRel_usuario_sco2004s;
	}

	
	public function countRel_usuario_sco2004s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004(Rel_usuario_sco2004 $l)
	{
		$this->collRel_usuario_sco2004s[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004sJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004s = array();
			} else {

				$criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004Criteria) || !$this->lastRel_usuario_sco2004Criteria->equals($criteria)) {
				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004Criteria = $criteria;

		return $this->collRel_usuario_sco2004s;
	}

	
	public function initRel_usuario_sco2004_learnercs()
	{
		if ($this->collRel_usuario_sco2004_learnercs === null) {
			$this->collRel_usuario_sco2004_learnercs = array();
		}
	}

	
	public function getRel_usuario_sco2004_learnercs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_learnercs === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_learnercs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_learnercPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_learnercPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_learnercCriteria) || !$this->lastRel_usuario_sco2004_learnercCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_learnercCriteria = $criteria;
		return $this->collRel_usuario_sco2004_learnercs;
	}

	
	public function countRel_usuario_sco2004_learnercs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_learnercPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_learnerc(Rel_usuario_sco2004_learnerc $l)
	{
		$this->collRel_usuario_sco2004_learnercs[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_learnercsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_learnercs === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_learnercs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_learnercCriteria) || !$this->lastRel_usuario_sco2004_learnercCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_learnercCriteria = $criteria;

		return $this->collRel_usuario_sco2004_learnercs;
	}

	
	public function initRel_usuario_sco2004_lmscs()
	{
		if ($this->collRel_usuario_sco2004_lmscs === null) {
			$this->collRel_usuario_sco2004_lmscs = array();
		}
	}

	
	public function getRel_usuario_sco2004_lmscs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_lmscs === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_lmscs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_lmscPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_lmscPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_lmscCriteria) || !$this->lastRel_usuario_sco2004_lmscCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_lmscCriteria = $criteria;
		return $this->collRel_usuario_sco2004_lmscs;
	}

	
	public function countRel_usuario_sco2004_lmscs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_lmscPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_lmsc(Rel_usuario_sco2004_lmsc $l)
	{
		$this->collRel_usuario_sco2004_lmscs[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_lmscsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_lmscs === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_lmscs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_lmscCriteria) || !$this->lastRel_usuario_sco2004_lmscCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_lmscCriteria = $criteria;

		return $this->collRel_usuario_sco2004_lmscs;
	}

	
	public function initRel_usuario_sco2004_interactions()
	{
		if ($this->collRel_usuario_sco2004_interactions === null) {
			$this->collRel_usuario_sco2004_interactions = array();
		}
	}

	
	public function getRel_usuario_sco2004_interactions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_interactions === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_interactions = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_interactionPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_interactionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_interactionCriteria) || !$this->lastRel_usuario_sco2004_interactionCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_interactionCriteria = $criteria;
		return $this->collRel_usuario_sco2004_interactions;
	}

	
	public function countRel_usuario_sco2004_interactions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_interactionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_interaction(Rel_usuario_sco2004_interaction $l)
	{
		$this->collRel_usuario_sco2004_interactions[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_interactionsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_interactions === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_interactions = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_interactionCriteria) || !$this->lastRel_usuario_sco2004_interactionCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_interactionCriteria = $criteria;

		return $this->collRel_usuario_sco2004_interactions;
	}

	
	public function initRel_usuario_sco2004_iobjectives()
	{
		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			$this->collRel_usuario_sco2004_iobjectives = array();
		}
	}

	
	public function getRel_usuario_sco2004_iobjectives($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_iobjectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_iobjectivePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_iobjectivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_iobjectiveCriteria) || !$this->lastRel_usuario_sco2004_iobjectiveCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_iobjectiveCriteria = $criteria;
		return $this->collRel_usuario_sco2004_iobjectives;
	}

	
	public function countRel_usuario_sco2004_iobjectives($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_iobjectivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_iobjective(Rel_usuario_sco2004_iobjective $l)
	{
		$this->collRel_usuario_sco2004_iobjectives[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_iobjectivesJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_iobjectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_iobjectiveCriteria) || !$this->lastRel_usuario_sco2004_iobjectiveCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_iobjectiveCriteria = $criteria;

		return $this->collRel_usuario_sco2004_iobjectives;
	}

	
	public function initRel_usuario_sco2004_iresponses()
	{
		if ($this->collRel_usuario_sco2004_iresponses === null) {
			$this->collRel_usuario_sco2004_iresponses = array();
		}
	}

	
	public function getRel_usuario_sco2004_iresponses($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iresponses === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_iresponses = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_iresponsePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_iresponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_iresponseCriteria) || !$this->lastRel_usuario_sco2004_iresponseCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_iresponseCriteria = $criteria;
		return $this->collRel_usuario_sco2004_iresponses;
	}

	
	public function countRel_usuario_sco2004_iresponses($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_iresponsePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_iresponse(Rel_usuario_sco2004_iresponse $l)
	{
		$this->collRel_usuario_sco2004_iresponses[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_iresponsesJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iresponses === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_iresponses = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_iresponseCriteria) || !$this->lastRel_usuario_sco2004_iresponseCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_iresponseCriteria = $criteria;

		return $this->collRel_usuario_sco2004_iresponses;
	}

	
	public function initRel_usuario_sco2004_objectives()
	{
		if ($this->collRel_usuario_sco2004_objectives === null) {
			$this->collRel_usuario_sco2004_objectives = array();
		}
	}

	
	public function getRel_usuario_sco2004_objectives($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_objectives === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_objectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_objectivePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->getId());

				Rel_usuario_sco2004_objectivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_objectiveCriteria) || !$this->lastRel_usuario_sco2004_objectiveCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_objectiveCriteria = $criteria;
		return $this->collRel_usuario_sco2004_objectives;
	}

	
	public function countRel_usuario_sco2004_objectives($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->getId());

		return Rel_usuario_sco2004_objectivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_objective(Rel_usuario_sco2004_objective $l)
	{
		$this->collRel_usuario_sco2004_objectives[] = $l;
		$l->setSco2004($this);
	}


	
	public function getRel_usuario_sco2004_objectivesJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_objectives === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_objectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->getId());

				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_objectiveCriteria) || !$this->lastRel_usuario_sco2004_objectiveCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_objectiveCriteria = $criteria;

		return $this->collRel_usuario_sco2004_objectives;
	}

} 