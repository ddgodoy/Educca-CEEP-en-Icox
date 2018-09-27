<?php


abstract class BaseRel_usuario_sco12 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sco12;


	
	protected $id_usuario;


	
	protected $lesson_location;


	
	protected $credit;


	
	protected $lesson_status;


	
	protected $entry;


	
	protected $score_raw;


	
	protected $score_max;


	
	protected $score_min;


	
	protected $total_time;


	
	protected $lesson_mode;


	
	protected $exitvalue;


	
	protected $session_time;


	
	protected $suspend_data;


	
	protected $comments;


	
	protected $comments_from_lms;


	
	protected $preference_audio;


	
	protected $preference_language;


	
	protected $preference_speed;


	
	protected $preference_text;

	
	protected $aSco12;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdSco12()
	{

		return $this->id_sco12;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getLessonLocation()
	{

		return $this->lesson_location;
	}

	
	public function getCredit()
	{

		return $this->credit;
	}

	
	public function getLessonStatus()
	{

		return $this->lesson_status;
	}

	
	public function getEntry()
	{

		return $this->entry;
	}

	
	public function getScoreRaw()
	{

		return $this->score_raw;
	}

	
	public function getScoreMax()
	{

		return $this->score_max;
	}

	
	public function getScoreMin()
	{

		return $this->score_min;
	}

	
	public function getTotalTime()
	{

		return $this->total_time;
	}

	
	public function getLessonMode()
	{

		return $this->lesson_mode;
	}

	
	public function getExitvalue()
	{

		return $this->exitvalue;
	}

	
	public function getSessionTime()
	{

		return $this->session_time;
	}

	
	public function getSuspendData()
	{

		return $this->suspend_data;
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getCommentsFromLms()
	{

		return $this->comments_from_lms;
	}

	
	public function getPreferenceAudio()
	{

		return $this->preference_audio;
	}

	
	public function getPreferenceLanguage()
	{

		return $this->preference_language;
	}

	
	public function getPreferenceSpeed()
	{

		return $this->preference_speed;
	}

	
	public function getPreferenceText()
	{

		return $this->preference_text;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::ID;
		}

	} 
	
	public function setIdSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco12 !== $v) {
			$this->id_sco12 = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::ID_SCO12;
		}

		if ($this->aSco12 !== null && $this->aSco12->getId() !== $v) {
			$this->aSco12 = null;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setLessonLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lesson_location !== $v) {
			$this->lesson_location = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::LESSON_LOCATION;
		}

	} 
	
	public function setCredit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credit !== $v) {
			$this->credit = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::CREDIT;
		}

	} 
	
	public function setLessonStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lesson_status !== $v) {
			$this->lesson_status = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::LESSON_STATUS;
		}

	} 
	
	public function setEntry($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry !== $v) {
			$this->entry = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::ENTRY;
		}

	} 
	
	public function setScoreRaw($v)
	{

		if ($this->score_raw !== $v) {
			$this->score_raw = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::SCORE_RAW;
		}

	} 
	
	public function setScoreMax($v)
	{

		if ($this->score_max !== $v) {
			$this->score_max = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::SCORE_MAX;
		}

	} 
	
	public function setScoreMin($v)
	{

		if ($this->score_min !== $v) {
			$this->score_min = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::SCORE_MIN;
		}

	} 
	
	public function setTotalTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->total_time !== $v) {
			$this->total_time = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::TOTAL_TIME;
		}

	} 
	
	public function setLessonMode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lesson_mode !== $v) {
			$this->lesson_mode = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::LESSON_MODE;
		}

	} 
	
	public function setExitvalue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->exitvalue !== $v) {
			$this->exitvalue = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::EXITVALUE;
		}

	} 
	
	public function setSessionTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_time !== $v) {
			$this->session_time = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::SESSION_TIME;
		}

	} 
	
	public function setSuspendData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->suspend_data !== $v) {
			$this->suspend_data = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::SUSPEND_DATA;
		}

	} 
	
	public function setComments($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::COMMENTS;
		}

	} 
	
	public function setCommentsFromLms($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments_from_lms !== $v) {
			$this->comments_from_lms = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::COMMENTS_FROM_LMS;
		}

	} 
	
	public function setPreferenceAudio($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->preference_audio !== $v) {
			$this->preference_audio = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::PREFERENCE_AUDIO;
		}

	} 
	
	public function setPreferenceLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->preference_language !== $v) {
			$this->preference_language = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE;
		}

	} 
	
	public function setPreferenceSpeed($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->preference_speed !== $v) {
			$this->preference_speed = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::PREFERENCE_SPEED;
		}

	} 
	
	public function setPreferenceText($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->preference_text !== $v) {
			$this->preference_text = $v;
			$this->modifiedColumns[] = Rel_usuario_sco12Peer::PREFERENCE_TEXT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_sco12 = $rs->getString($startcol + 1);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->lesson_location = $rs->getString($startcol + 3);

			$this->credit = $rs->getString($startcol + 4);

			$this->lesson_status = $rs->getString($startcol + 5);

			$this->entry = $rs->getString($startcol + 6);

			$this->score_raw = $rs->getFloat($startcol + 7);

			$this->score_max = $rs->getFloat($startcol + 8);

			$this->score_min = $rs->getFloat($startcol + 9);

			$this->total_time = $rs->getString($startcol + 10);

			$this->lesson_mode = $rs->getString($startcol + 11);

			$this->exitvalue = $rs->getString($startcol + 12);

			$this->session_time = $rs->getString($startcol + 13);

			$this->suspend_data = $rs->getString($startcol + 14);

			$this->comments = $rs->getString($startcol + 15);

			$this->comments_from_lms = $rs->getString($startcol + 16);

			$this->preference_audio = $rs->getInt($startcol + 17);

			$this->preference_language = $rs->getString($startcol + 18);

			$this->preference_speed = $rs->getInt($startcol + 19);

			$this->preference_text = $rs->getInt($startcol + 20);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_sco12 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_sco12Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_sco12Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco12Peer::DATABASE_NAME);
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


												
			if ($this->aSco12 !== null) {
				if ($this->aSco12->isModified()) {
					$affectedRows += $this->aSco12->save($con);
				}
				$this->setSco12($this->aSco12);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_sco12Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_sco12Peer::doUpdate($this, $con);
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


												
			if ($this->aSco12 !== null) {
				if (!$this->aSco12->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSco12->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_sco12Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdSco12();
				break;
			case 2:
				return $this->getIdUsuario();
				break;
			case 3:
				return $this->getLessonLocation();
				break;
			case 4:
				return $this->getCredit();
				break;
			case 5:
				return $this->getLessonStatus();
				break;
			case 6:
				return $this->getEntry();
				break;
			case 7:
				return $this->getScoreRaw();
				break;
			case 8:
				return $this->getScoreMax();
				break;
			case 9:
				return $this->getScoreMin();
				break;
			case 10:
				return $this->getTotalTime();
				break;
			case 11:
				return $this->getLessonMode();
				break;
			case 12:
				return $this->getExitvalue();
				break;
			case 13:
				return $this->getSessionTime();
				break;
			case 14:
				return $this->getSuspendData();
				break;
			case 15:
				return $this->getComments();
				break;
			case 16:
				return $this->getCommentsFromLms();
				break;
			case 17:
				return $this->getPreferenceAudio();
				break;
			case 18:
				return $this->getPreferenceLanguage();
				break;
			case 19:
				return $this->getPreferenceSpeed();
				break;
			case 20:
				return $this->getPreferenceText();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco12Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSco12(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getLessonLocation(),
			$keys[4] => $this->getCredit(),
			$keys[5] => $this->getLessonStatus(),
			$keys[6] => $this->getEntry(),
			$keys[7] => $this->getScoreRaw(),
			$keys[8] => $this->getScoreMax(),
			$keys[9] => $this->getScoreMin(),
			$keys[10] => $this->getTotalTime(),
			$keys[11] => $this->getLessonMode(),
			$keys[12] => $this->getExitvalue(),
			$keys[13] => $this->getSessionTime(),
			$keys[14] => $this->getSuspendData(),
			$keys[15] => $this->getComments(),
			$keys[16] => $this->getCommentsFromLms(),
			$keys[17] => $this->getPreferenceAudio(),
			$keys[18] => $this->getPreferenceLanguage(),
			$keys[19] => $this->getPreferenceSpeed(),
			$keys[20] => $this->getPreferenceText(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdSco12($value);
				break;
			case 2:
				$this->setIdUsuario($value);
				break;
			case 3:
				$this->setLessonLocation($value);
				break;
			case 4:
				$this->setCredit($value);
				break;
			case 5:
				$this->setLessonStatus($value);
				break;
			case 6:
				$this->setEntry($value);
				break;
			case 7:
				$this->setScoreRaw($value);
				break;
			case 8:
				$this->setScoreMax($value);
				break;
			case 9:
				$this->setScoreMin($value);
				break;
			case 10:
				$this->setTotalTime($value);
				break;
			case 11:
				$this->setLessonMode($value);
				break;
			case 12:
				$this->setExitvalue($value);
				break;
			case 13:
				$this->setSessionTime($value);
				break;
			case 14:
				$this->setSuspendData($value);
				break;
			case 15:
				$this->setComments($value);
				break;
			case 16:
				$this->setCommentsFromLms($value);
				break;
			case 17:
				$this->setPreferenceAudio($value);
				break;
			case 18:
				$this->setPreferenceLanguage($value);
				break;
			case 19:
				$this->setPreferenceSpeed($value);
				break;
			case 20:
				$this->setPreferenceText($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco12Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSco12($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLessonLocation($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCredit($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLessonStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntry($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setScoreRaw($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setScoreMax($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setScoreMin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTotalTime($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLessonMode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setExitvalue($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSessionTime($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSuspendData($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setComments($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCommentsFromLms($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setPreferenceAudio($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setPreferenceLanguage($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setPreferenceSpeed($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setPreferenceText($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco12Peer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_sco12Peer::ID)) $criteria->add(Rel_usuario_sco12Peer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::ID_SCO12)) $criteria->add(Rel_usuario_sco12Peer::ID_SCO12, $this->id_sco12);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::ID_USUARIO)) $criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::LESSON_LOCATION)) $criteria->add(Rel_usuario_sco12Peer::LESSON_LOCATION, $this->lesson_location);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::CREDIT)) $criteria->add(Rel_usuario_sco12Peer::CREDIT, $this->credit);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::LESSON_STATUS)) $criteria->add(Rel_usuario_sco12Peer::LESSON_STATUS, $this->lesson_status);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::ENTRY)) $criteria->add(Rel_usuario_sco12Peer::ENTRY, $this->entry);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::SCORE_RAW)) $criteria->add(Rel_usuario_sco12Peer::SCORE_RAW, $this->score_raw);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::SCORE_MAX)) $criteria->add(Rel_usuario_sco12Peer::SCORE_MAX, $this->score_max);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::SCORE_MIN)) $criteria->add(Rel_usuario_sco12Peer::SCORE_MIN, $this->score_min);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::TOTAL_TIME)) $criteria->add(Rel_usuario_sco12Peer::TOTAL_TIME, $this->total_time);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::LESSON_MODE)) $criteria->add(Rel_usuario_sco12Peer::LESSON_MODE, $this->lesson_mode);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::EXITVALUE)) $criteria->add(Rel_usuario_sco12Peer::EXITVALUE, $this->exitvalue);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::SESSION_TIME)) $criteria->add(Rel_usuario_sco12Peer::SESSION_TIME, $this->session_time);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::SUSPEND_DATA)) $criteria->add(Rel_usuario_sco12Peer::SUSPEND_DATA, $this->suspend_data);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::COMMENTS)) $criteria->add(Rel_usuario_sco12Peer::COMMENTS, $this->comments);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::COMMENTS_FROM_LMS)) $criteria->add(Rel_usuario_sco12Peer::COMMENTS_FROM_LMS, $this->comments_from_lms);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::PREFERENCE_AUDIO)) $criteria->add(Rel_usuario_sco12Peer::PREFERENCE_AUDIO, $this->preference_audio);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE)) $criteria->add(Rel_usuario_sco12Peer::PREFERENCE_LANGUAGE, $this->preference_language);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::PREFERENCE_SPEED)) $criteria->add(Rel_usuario_sco12Peer::PREFERENCE_SPEED, $this->preference_speed);
		if ($this->isColumnModified(Rel_usuario_sco12Peer::PREFERENCE_TEXT)) $criteria->add(Rel_usuario_sco12Peer::PREFERENCE_TEXT, $this->preference_text);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco12Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco12Peer::ID, $this->id);

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

		$copyObj->setIdSco12($this->id_sco12);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setLessonLocation($this->lesson_location);

		$copyObj->setCredit($this->credit);

		$copyObj->setLessonStatus($this->lesson_status);

		$copyObj->setEntry($this->entry);

		$copyObj->setScoreRaw($this->score_raw);

		$copyObj->setScoreMax($this->score_max);

		$copyObj->setScoreMin($this->score_min);

		$copyObj->setTotalTime($this->total_time);

		$copyObj->setLessonMode($this->lesson_mode);

		$copyObj->setExitvalue($this->exitvalue);

		$copyObj->setSessionTime($this->session_time);

		$copyObj->setSuspendData($this->suspend_data);

		$copyObj->setComments($this->comments);

		$copyObj->setCommentsFromLms($this->comments_from_lms);

		$copyObj->setPreferenceAudio($this->preference_audio);

		$copyObj->setPreferenceLanguage($this->preference_language);

		$copyObj->setPreferenceSpeed($this->preference_speed);

		$copyObj->setPreferenceText($this->preference_text);


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
			self::$peer = new Rel_usuario_sco12Peer();
		}
		return self::$peer;
	}

	
	public function setSco12($v)
	{


		if ($v === null) {
			$this->setIdSco12(NULL);
		} else {
			$this->setIdSco12($v->getId());
		}


		$this->aSco12 = $v;
	}


	
	public function getSco12($con = null)
	{
		if ($this->aSco12 === null && (($this->id_sco12 !== "" && $this->id_sco12 !== null))) {
						include_once 'lib/model/om/BaseSco12Peer.php';

			$this->aSco12 = Sco12Peer::retrieveByPK($this->id_sco12, $con);

			
		}
		return $this->aSco12;
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