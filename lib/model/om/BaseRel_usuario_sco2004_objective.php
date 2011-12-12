<?php


abstract class BaseRel_usuario_sco2004_objective extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sco2004;


	
	protected $id_usuario;


	
	protected $objective_index;


	
	protected $objective_id;


	
	protected $score_scaled;


	
	protected $score_raw;


	
	protected $score_min;


	
	protected $score_max;


	
	protected $success_status;


	
	protected $completion_status;


	
	protected $progress_measure;


	
	protected $description;

	
	protected $aSco2004;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdSco2004()
	{

		return $this->id_sco2004;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getObjectiveIndex()
	{

		return $this->objective_index;
	}

	
	public function getObjectiveId()
	{

		return $this->objective_id;
	}

	
	public function getScoreScaled()
	{

		return $this->score_scaled;
	}

	
	public function getScoreRaw()
	{

		return $this->score_raw;
	}

	
	public function getScoreMin()
	{

		return $this->score_min;
	}

	
	public function getScoreMax()
	{

		return $this->score_max;
	}

	
	public function getSuccessStatus()
	{

		return $this->success_status;
	}

	
	public function getCompletionStatus()
	{

		return $this->completion_status;
	}

	
	public function getProgressMeasure()
	{

		return $this->progress_measure;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::ID;
		}

	} 
	
	public function setIdSco2004($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco2004 !== $v) {
			$this->id_sco2004 = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::ID_SCO2004;
		}

		if ($this->aSco2004 !== null && $this->aSco2004->getId() !== $v) {
			$this->aSco2004 = null;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setObjectiveIndex($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->objective_index !== $v) {
			$this->objective_index = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX;
		}

	} 
	
	public function setObjectiveId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->objective_id !== $v) {
			$this->objective_id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID;
		}

	} 
	
	public function setScoreScaled($v)
	{

		if ($this->score_scaled !== $v) {
			$this->score_scaled = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::SCORE_SCALED;
		}

	} 
	
	public function setScoreRaw($v)
	{

		if ($this->score_raw !== $v) {
			$this->score_raw = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::SCORE_RAW;
		}

	} 
	
	public function setScoreMin($v)
	{

		if ($this->score_min !== $v) {
			$this->score_min = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::SCORE_MIN;
		}

	} 
	
	public function setScoreMax($v)
	{

		if ($this->score_max !== $v) {
			$this->score_max = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::SCORE_MAX;
		}

	} 
	
	public function setSuccessStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->success_status !== $v) {
			$this->success_status = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS;
		}

	} 
	
	public function setCompletionStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->completion_status !== $v) {
			$this->completion_status = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS;
		}

	} 
	
	public function setProgressMeasure($v)
	{

		if ($this->progress_measure !== $v) {
			$this->progress_measure = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_objectivePeer::DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_sco2004 = $rs->getString($startcol + 1);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->objective_index = $rs->getInt($startcol + 3);

			$this->objective_id = $rs->getString($startcol + 4);

			$this->score_scaled = $rs->getFloat($startcol + 5);

			$this->score_raw = $rs->getFloat($startcol + 6);

			$this->score_min = $rs->getFloat($startcol + 7);

			$this->score_max = $rs->getFloat($startcol + 8);

			$this->success_status = $rs->getString($startcol + 9);

			$this->completion_status = $rs->getString($startcol + 10);

			$this->progress_measure = $rs->getFloat($startcol + 11);

			$this->description = $rs->getString($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_sco2004_objective object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_sco2004_objectivePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);
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


												
			if ($this->aSco2004 !== null) {
				if ($this->aSco2004->isModified()) {
					$affectedRows += $this->aSco2004->save($con);
				}
				$this->setSco2004($this->aSco2004);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_sco2004_objectivePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_sco2004_objectivePeer::doUpdate($this, $con);
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


												
			if ($this->aSco2004 !== null) {
				if (!$this->aSco2004->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSco2004->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_sco2004_objectivePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_objectivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdSco2004();
				break;
			case 2:
				return $this->getIdUsuario();
				break;
			case 3:
				return $this->getObjectiveIndex();
				break;
			case 4:
				return $this->getObjectiveId();
				break;
			case 5:
				return $this->getScoreScaled();
				break;
			case 6:
				return $this->getScoreRaw();
				break;
			case 7:
				return $this->getScoreMin();
				break;
			case 8:
				return $this->getScoreMax();
				break;
			case 9:
				return $this->getSuccessStatus();
				break;
			case 10:
				return $this->getCompletionStatus();
				break;
			case 11:
				return $this->getProgressMeasure();
				break;
			case 12:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_objectivePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSco2004(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getObjectiveIndex(),
			$keys[4] => $this->getObjectiveId(),
			$keys[5] => $this->getScoreScaled(),
			$keys[6] => $this->getScoreRaw(),
			$keys[7] => $this->getScoreMin(),
			$keys[8] => $this->getScoreMax(),
			$keys[9] => $this->getSuccessStatus(),
			$keys[10] => $this->getCompletionStatus(),
			$keys[11] => $this->getProgressMeasure(),
			$keys[12] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_objectivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdSco2004($value);
				break;
			case 2:
				$this->setIdUsuario($value);
				break;
			case 3:
				$this->setObjectiveIndex($value);
				break;
			case 4:
				$this->setObjectiveId($value);
				break;
			case 5:
				$this->setScoreScaled($value);
				break;
			case 6:
				$this->setScoreRaw($value);
				break;
			case 7:
				$this->setScoreMin($value);
				break;
			case 8:
				$this->setScoreMax($value);
				break;
			case 9:
				$this->setSuccessStatus($value);
				break;
			case 10:
				$this->setCompletionStatus($value);
				break;
			case 11:
				$this->setProgressMeasure($value);
				break;
			case 12:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_objectivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSco2004($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectiveIndex($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjectiveId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScoreScaled($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setScoreRaw($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setScoreMin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setScoreMax($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSuccessStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCompletionStatus($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setProgressMeasure($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDescription($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::ID)) $criteria->add(Rel_usuario_sco2004_objectivePeer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::ID_SCO2004)) $criteria->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $this->id_sco2004);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::ID_USUARIO)) $criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX)) $criteria->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $this->objective_index);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID)) $criteria->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_ID, $this->objective_id);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::SCORE_SCALED)) $criteria->add(Rel_usuario_sco2004_objectivePeer::SCORE_SCALED, $this->score_scaled);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::SCORE_RAW)) $criteria->add(Rel_usuario_sco2004_objectivePeer::SCORE_RAW, $this->score_raw);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::SCORE_MIN)) $criteria->add(Rel_usuario_sco2004_objectivePeer::SCORE_MIN, $this->score_min);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::SCORE_MAX)) $criteria->add(Rel_usuario_sco2004_objectivePeer::SCORE_MAX, $this->score_max);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS)) $criteria->add(Rel_usuario_sco2004_objectivePeer::SUCCESS_STATUS, $this->success_status);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS)) $criteria->add(Rel_usuario_sco2004_objectivePeer::COMPLETION_STATUS, $this->completion_status);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE)) $criteria->add(Rel_usuario_sco2004_objectivePeer::PROGRESS_MEASURE, $this->progress_measure);
		if ($this->isColumnModified(Rel_usuario_sco2004_objectivePeer::DESCRIPTION)) $criteria->add(Rel_usuario_sco2004_objectivePeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_objectivePeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004_objectivePeer::ID, $this->id);

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

		$copyObj->setIdSco2004($this->id_sco2004);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setObjectiveIndex($this->objective_index);

		$copyObj->setObjectiveId($this->objective_id);

		$copyObj->setScoreScaled($this->score_scaled);

		$copyObj->setScoreRaw($this->score_raw);

		$copyObj->setScoreMin($this->score_min);

		$copyObj->setScoreMax($this->score_max);

		$copyObj->setSuccessStatus($this->success_status);

		$copyObj->setCompletionStatus($this->completion_status);

		$copyObj->setProgressMeasure($this->progress_measure);

		$copyObj->setDescription($this->description);


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
			self::$peer = new Rel_usuario_sco2004_objectivePeer();
		}
		return self::$peer;
	}

	
	public function setSco2004($v)
	{


		if ($v === null) {
			$this->setIdSco2004(NULL);
		} else {
			$this->setIdSco2004($v->getId());
		}


		$this->aSco2004 = $v;
	}


	
	public function getSco2004($con = null)
	{
		if ($this->aSco2004 === null && (($this->id_sco2004 !== "" && $this->id_sco2004 !== null))) {
						include_once 'lib/model/om/BaseSco2004Peer.php';

			$this->aSco2004 = Sco2004Peer::retrieveByPK($this->id_sco2004, $con);

			
		}
		return $this->aSco2004;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdUsuario(NULL);
		} else {
			$this->setIdUsuario($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->id_usuario !== "" && $this->id_usuario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_usuario, $con);

			
		}
		return $this->aUsuario;
	}

} 