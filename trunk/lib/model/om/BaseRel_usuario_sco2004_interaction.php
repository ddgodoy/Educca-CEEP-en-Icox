<?php


abstract class BaseRel_usuario_sco2004_interaction extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sco2004;


	
	protected $id_usuario;


	
	protected $interaction_index;


	
	protected $interaction_id;


	
	protected $type;


	
	protected $tstamp;


	
	protected $weighting;


	
	protected $learner_response;


	
	protected $result;


	
	protected $latency;


	
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

	
	public function getInteractionIndex()
	{

		return $this->interaction_index;
	}

	
	public function getInteractionId()
	{

		return $this->interaction_id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getTstamp($format = 'Y-m-d H:i:s')
	{

		if ($this->tstamp === null || $this->tstamp === '') {
			return null;
		} elseif (!is_int($this->tstamp)) {
						$ts = strtotime($this->tstamp);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [tstamp] as date/time value: " . var_export($this->tstamp, true));
			}
		} else {
			$ts = $this->tstamp;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getWeighting()
	{

		return $this->weighting;
	}

	
	public function getLearnerResponse()
	{

		return $this->learner_response;
	}

	
	public function getResult()
	{

		return $this->result;
	}

	
	public function getLatency()
	{

		return $this->latency;
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
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::ID;
		}

	} 
	
	public function setIdSco2004($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco2004 !== $v) {
			$this->id_sco2004 = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::ID_SCO2004;
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
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setInteractionIndex($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->interaction_index !== $v) {
			$this->interaction_index = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX;
		}

	} 
	
	public function setInteractionId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->interaction_id !== $v) {
			$this->interaction_id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::INTERACTION_ID;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::TYPE;
		}

	} 
	
	public function setTstamp($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [tstamp] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->tstamp !== $ts) {
			$this->tstamp = $ts;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::TSTAMP;
		}

	} 
	
	public function setWeighting($v)
	{

		if ($this->weighting !== $v) {
			$this->weighting = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::WEIGHTING;
		}

	} 
	
	public function setLearnerResponse($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->learner_response !== $v) {
			$this->learner_response = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::LEARNER_RESPONSE;
		}

	} 
	
	public function setResult($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->result !== $v) {
			$this->result = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::RESULT;
		}

	} 
	
	public function setLatency($v)
	{

		if ($this->latency !== $v) {
			$this->latency = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::LATENCY;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_interactionPeer::DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_sco2004 = $rs->getString($startcol + 1);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->interaction_index = $rs->getInt($startcol + 3);

			$this->interaction_id = $rs->getString($startcol + 4);

			$this->type = $rs->getString($startcol + 5);

			$this->tstamp = $rs->getTimestamp($startcol + 6, null);

			$this->weighting = $rs->getFloat($startcol + 7);

			$this->learner_response = $rs->getString($startcol + 8);

			$this->result = $rs->getString($startcol + 9);

			$this->latency = $rs->getFloat($startcol + 10);

			$this->description = $rs->getString($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_sco2004_interaction object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_sco2004_interactionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_sco2004_interactionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004_interactionPeer::DATABASE_NAME);
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
					$pk = Rel_usuario_sco2004_interactionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_sco2004_interactionPeer::doUpdate($this, $con);
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


			if (($retval = Rel_usuario_sco2004_interactionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_interactionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getInteractionIndex();
				break;
			case 4:
				return $this->getInteractionId();
				break;
			case 5:
				return $this->getType();
				break;
			case 6:
				return $this->getTstamp();
				break;
			case 7:
				return $this->getWeighting();
				break;
			case 8:
				return $this->getLearnerResponse();
				break;
			case 9:
				return $this->getResult();
				break;
			case 10:
				return $this->getLatency();
				break;
			case 11:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_interactionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSco2004(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getInteractionIndex(),
			$keys[4] => $this->getInteractionId(),
			$keys[5] => $this->getType(),
			$keys[6] => $this->getTstamp(),
			$keys[7] => $this->getWeighting(),
			$keys[8] => $this->getLearnerResponse(),
			$keys[9] => $this->getResult(),
			$keys[10] => $this->getLatency(),
			$keys[11] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_interactionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setInteractionIndex($value);
				break;
			case 4:
				$this->setInteractionId($value);
				break;
			case 5:
				$this->setType($value);
				break;
			case 6:
				$this->setTstamp($value);
				break;
			case 7:
				$this->setWeighting($value);
				break;
			case 8:
				$this->setLearnerResponse($value);
				break;
			case 9:
				$this->setResult($value);
				break;
			case 10:
				$this->setLatency($value);
				break;
			case 11:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_interactionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSco2004($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInteractionIndex($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setInteractionId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTstamp($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setWeighting($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLearnerResponse($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setResult($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLatency($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDescription($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_interactionPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::ID)) $criteria->add(Rel_usuario_sco2004_interactionPeer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::ID_SCO2004)) $criteria->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $this->id_sco2004);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::ID_USUARIO)) $criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX)) $criteria->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $this->interaction_index);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::INTERACTION_ID)) $criteria->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_ID, $this->interaction_id);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::TYPE)) $criteria->add(Rel_usuario_sco2004_interactionPeer::TYPE, $this->type);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::TSTAMP)) $criteria->add(Rel_usuario_sco2004_interactionPeer::TSTAMP, $this->tstamp);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::WEIGHTING)) $criteria->add(Rel_usuario_sco2004_interactionPeer::WEIGHTING, $this->weighting);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::LEARNER_RESPONSE)) $criteria->add(Rel_usuario_sco2004_interactionPeer::LEARNER_RESPONSE, $this->learner_response);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::RESULT)) $criteria->add(Rel_usuario_sco2004_interactionPeer::RESULT, $this->result);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::LATENCY)) $criteria->add(Rel_usuario_sco2004_interactionPeer::LATENCY, $this->latency);
		if ($this->isColumnModified(Rel_usuario_sco2004_interactionPeer::DESCRIPTION)) $criteria->add(Rel_usuario_sco2004_interactionPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_interactionPeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004_interactionPeer::ID, $this->id);

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

		$copyObj->setInteractionIndex($this->interaction_index);

		$copyObj->setInteractionId($this->interaction_id);

		$copyObj->setType($this->type);

		$copyObj->setTstamp($this->tstamp);

		$copyObj->setWeighting($this->weighting);

		$copyObj->setLearnerResponse($this->learner_response);

		$copyObj->setResult($this->result);

		$copyObj->setLatency($this->latency);

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
			self::$peer = new Rel_usuario_sco2004_interactionPeer();
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