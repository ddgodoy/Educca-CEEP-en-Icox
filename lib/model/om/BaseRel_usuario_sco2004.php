<?php


abstract class BaseRel_usuario_sco2004 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sco2004;


	
	protected $id_usuario;


	
	protected $completion_status;


	
	protected $entry;


	
	protected $exit;


	
	protected $audio_level;


	
	protected $language;


	
	protected $delivery_speed;


	
	protected $audio_captioning;


	
	protected $location;


	
	protected $mode;


	
	protected $progress_measure;


	
	protected $score_scaled;


	
	protected $score_raw;


	
	protected $score_min;


	
	protected $score_max;


	
	protected $session_time;


	
	protected $success_status;


	
	protected $suspend_data;


	
	protected $total_time;

	
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

	
	public function getCompletionStatus()
	{

		return $this->completion_status;
	}

	
	public function getEntry()
	{

		return $this->entry;
	}

	
	public function getExit()
	{

		return $this->exit;
	}

	
	public function getAudioLevel()
	{

		return $this->audio_level;
	}

	
	public function getLanguage()
	{

		return $this->language;
	}

	
	public function getDeliverySpeed()
	{

		return $this->delivery_speed;
	}

	
	public function getAudioCaptioning()
	{

		return $this->audio_captioning;
	}

	
	public function getLocation()
	{

		return $this->location;
	}

	
	public function getMode()
	{

		return $this->mode;
	}

	
	public function getProgressMeasure()
	{

		return $this->progress_measure;
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

	
	public function getSessionTime()
	{

		return $this->session_time;
	}

	
	public function getSuccessStatus()
	{

		return $this->success_status;
	}

	
	public function getSuspendData()
	{

		return $this->suspend_data;
	}

	
	public function getTotalTime()
	{

		return $this->total_time;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::ID;
		}

	} 
	
	public function setIdSco2004($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco2004 !== $v) {
			$this->id_sco2004 = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::ID_SCO2004;
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
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setCompletionStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->completion_status !== $v) {
			$this->completion_status = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::COMPLETION_STATUS;
		}

	} 
	
	public function setEntry($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry !== $v) {
			$this->entry = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::ENTRY;
		}

	} 
	
	public function setExit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->exit !== $v) {
			$this->exit = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::EXIT;
		}

	} 
	
	public function setAudioLevel($v)
	{

		if ($this->audio_level !== $v) {
			$this->audio_level = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::AUDIO_LEVEL;
		}

	} 
	
	public function setLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::LANGUAGE;
		}

	} 
	
	public function setDeliverySpeed($v)
	{

		if ($this->delivery_speed !== $v) {
			$this->delivery_speed = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::DELIVERY_SPEED;
		}

	} 
	
	public function setAudioCaptioning($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->audio_captioning !== $v) {
			$this->audio_captioning = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::AUDIO_CAPTIONING;
		}

	} 
	
	public function setLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::LOCATION;
		}

	} 
	
	public function setMode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mode !== $v) {
			$this->mode = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::MODE;
		}

	} 
	
	public function setProgressMeasure($v)
	{

		if ($this->progress_measure !== $v) {
			$this->progress_measure = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::PROGRESS_MEASURE;
		}

	} 
	
	public function setScoreScaled($v)
	{

		if ($this->score_scaled !== $v) {
			$this->score_scaled = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SCORE_SCALED;
		}

	} 
	
	public function setScoreRaw($v)
	{

		if ($this->score_raw !== $v) {
			$this->score_raw = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SCORE_RAW;
		}

	} 
	
	public function setScoreMin($v)
	{

		if ($this->score_min !== $v) {
			$this->score_min = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SCORE_MIN;
		}

	} 
	
	public function setScoreMax($v)
	{

		if ($this->score_max !== $v) {
			$this->score_max = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SCORE_MAX;
		}

	} 
	
	public function setSessionTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_time !== $v) {
			$this->session_time = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SESSION_TIME;
		}

	} 
	
	public function setSuccessStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->success_status !== $v) {
			$this->success_status = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SUCCESS_STATUS;
		}

	} 
	
	public function setSuspendData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->suspend_data !== $v) {
			$this->suspend_data = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::SUSPEND_DATA;
		}

	} 
	
	public function setTotalTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->total_time !== $v) {
			$this->total_time = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004Peer::TOTAL_TIME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_sco2004 = $rs->getString($startcol + 1);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->completion_status = $rs->getString($startcol + 3);

			$this->entry = $rs->getString($startcol + 4);

			$this->exit = $rs->getString($startcol + 5);

			$this->audio_level = $rs->getFloat($startcol + 6);

			$this->language = $rs->getString($startcol + 7);

			$this->delivery_speed = $rs->getFloat($startcol + 8);

			$this->audio_captioning = $rs->getString($startcol + 9);

			$this->location = $rs->getString($startcol + 10);

			$this->mode = $rs->getString($startcol + 11);

			$this->progress_measure = $rs->getFloat($startcol + 12);

			$this->score_scaled = $rs->getFloat($startcol + 13);

			$this->score_raw = $rs->getFloat($startcol + 14);

			$this->score_min = $rs->getFloat($startcol + 15);

			$this->score_max = $rs->getFloat($startcol + 16);

			$this->session_time = $rs->getString($startcol + 17);

			$this->success_status = $rs->getString($startcol + 18);

			$this->suspend_data = $rs->getString($startcol + 19);

			$this->total_time = $rs->getString($startcol + 20);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_sco2004 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_sco2004Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_sco2004Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004Peer::DATABASE_NAME);
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
					$pk = Rel_usuario_sco2004Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_sco2004Peer::doUpdate($this, $con);
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


			if (($retval = Rel_usuario_sco2004Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCompletionStatus();
				break;
			case 4:
				return $this->getEntry();
				break;
			case 5:
				return $this->getExit();
				break;
			case 6:
				return $this->getAudioLevel();
				break;
			case 7:
				return $this->getLanguage();
				break;
			case 8:
				return $this->getDeliverySpeed();
				break;
			case 9:
				return $this->getAudioCaptioning();
				break;
			case 10:
				return $this->getLocation();
				break;
			case 11:
				return $this->getMode();
				break;
			case 12:
				return $this->getProgressMeasure();
				break;
			case 13:
				return $this->getScoreScaled();
				break;
			case 14:
				return $this->getScoreRaw();
				break;
			case 15:
				return $this->getScoreMin();
				break;
			case 16:
				return $this->getScoreMax();
				break;
			case 17:
				return $this->getSessionTime();
				break;
			case 18:
				return $this->getSuccessStatus();
				break;
			case 19:
				return $this->getSuspendData();
				break;
			case 20:
				return $this->getTotalTime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSco2004(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getCompletionStatus(),
			$keys[4] => $this->getEntry(),
			$keys[5] => $this->getExit(),
			$keys[6] => $this->getAudioLevel(),
			$keys[7] => $this->getLanguage(),
			$keys[8] => $this->getDeliverySpeed(),
			$keys[9] => $this->getAudioCaptioning(),
			$keys[10] => $this->getLocation(),
			$keys[11] => $this->getMode(),
			$keys[12] => $this->getProgressMeasure(),
			$keys[13] => $this->getScoreScaled(),
			$keys[14] => $this->getScoreRaw(),
			$keys[15] => $this->getScoreMin(),
			$keys[16] => $this->getScoreMax(),
			$keys[17] => $this->getSessionTime(),
			$keys[18] => $this->getSuccessStatus(),
			$keys[19] => $this->getSuspendData(),
			$keys[20] => $this->getTotalTime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCompletionStatus($value);
				break;
			case 4:
				$this->setEntry($value);
				break;
			case 5:
				$this->setExit($value);
				break;
			case 6:
				$this->setAudioLevel($value);
				break;
			case 7:
				$this->setLanguage($value);
				break;
			case 8:
				$this->setDeliverySpeed($value);
				break;
			case 9:
				$this->setAudioCaptioning($value);
				break;
			case 10:
				$this->setLocation($value);
				break;
			case 11:
				$this->setMode($value);
				break;
			case 12:
				$this->setProgressMeasure($value);
				break;
			case 13:
				$this->setScoreScaled($value);
				break;
			case 14:
				$this->setScoreRaw($value);
				break;
			case 15:
				$this->setScoreMin($value);
				break;
			case 16:
				$this->setScoreMax($value);
				break;
			case 17:
				$this->setSessionTime($value);
				break;
			case 18:
				$this->setSuccessStatus($value);
				break;
			case 19:
				$this->setSuspendData($value);
				break;
			case 20:
				$this->setTotalTime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSco2004($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCompletionStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEntry($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setExit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAudioLevel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLanguage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDeliverySpeed($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAudioCaptioning($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLocation($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setProgressMeasure($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setScoreScaled($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setScoreRaw($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setScoreMin($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setScoreMax($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setSessionTime($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSuccessStatus($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setSuspendData($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setTotalTime($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004Peer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_sco2004Peer::ID)) $criteria->add(Rel_usuario_sco2004Peer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::ID_SCO2004)) $criteria->add(Rel_usuario_sco2004Peer::ID_SCO2004, $this->id_sco2004);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::ID_USUARIO)) $criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::COMPLETION_STATUS)) $criteria->add(Rel_usuario_sco2004Peer::COMPLETION_STATUS, $this->completion_status);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::ENTRY)) $criteria->add(Rel_usuario_sco2004Peer::ENTRY, $this->entry);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::EXIT)) $criteria->add(Rel_usuario_sco2004Peer::EXIT, $this->exit);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::AUDIO_LEVEL)) $criteria->add(Rel_usuario_sco2004Peer::AUDIO_LEVEL, $this->audio_level);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::LANGUAGE)) $criteria->add(Rel_usuario_sco2004Peer::LANGUAGE, $this->language);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::DELIVERY_SPEED)) $criteria->add(Rel_usuario_sco2004Peer::DELIVERY_SPEED, $this->delivery_speed);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::AUDIO_CAPTIONING)) $criteria->add(Rel_usuario_sco2004Peer::AUDIO_CAPTIONING, $this->audio_captioning);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::LOCATION)) $criteria->add(Rel_usuario_sco2004Peer::LOCATION, $this->location);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::MODE)) $criteria->add(Rel_usuario_sco2004Peer::MODE, $this->mode);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::PROGRESS_MEASURE)) $criteria->add(Rel_usuario_sco2004Peer::PROGRESS_MEASURE, $this->progress_measure);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SCORE_SCALED)) $criteria->add(Rel_usuario_sco2004Peer::SCORE_SCALED, $this->score_scaled);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SCORE_RAW)) $criteria->add(Rel_usuario_sco2004Peer::SCORE_RAW, $this->score_raw);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SCORE_MIN)) $criteria->add(Rel_usuario_sco2004Peer::SCORE_MIN, $this->score_min);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SCORE_MAX)) $criteria->add(Rel_usuario_sco2004Peer::SCORE_MAX, $this->score_max);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SESSION_TIME)) $criteria->add(Rel_usuario_sco2004Peer::SESSION_TIME, $this->session_time);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SUCCESS_STATUS)) $criteria->add(Rel_usuario_sco2004Peer::SUCCESS_STATUS, $this->success_status);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::SUSPEND_DATA)) $criteria->add(Rel_usuario_sco2004Peer::SUSPEND_DATA, $this->suspend_data);
		if ($this->isColumnModified(Rel_usuario_sco2004Peer::TOTAL_TIME)) $criteria->add(Rel_usuario_sco2004Peer::TOTAL_TIME, $this->total_time);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004Peer::ID, $this->id);

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

		$copyObj->setCompletionStatus($this->completion_status);

		$copyObj->setEntry($this->entry);

		$copyObj->setExit($this->exit);

		$copyObj->setAudioLevel($this->audio_level);

		$copyObj->setLanguage($this->language);

		$copyObj->setDeliverySpeed($this->delivery_speed);

		$copyObj->setAudioCaptioning($this->audio_captioning);

		$copyObj->setLocation($this->location);

		$copyObj->setMode($this->mode);

		$copyObj->setProgressMeasure($this->progress_measure);

		$copyObj->setScoreScaled($this->score_scaled);

		$copyObj->setScoreRaw($this->score_raw);

		$copyObj->setScoreMin($this->score_min);

		$copyObj->setScoreMax($this->score_max);

		$copyObj->setSessionTime($this->session_time);

		$copyObj->setSuccessStatus($this->success_status);

		$copyObj->setSuspendData($this->suspend_data);

		$copyObj->setTotalTime($this->total_time);


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
			self::$peer = new Rel_usuario_sco2004Peer();
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