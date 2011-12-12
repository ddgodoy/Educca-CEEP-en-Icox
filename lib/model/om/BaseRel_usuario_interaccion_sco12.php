<?php


abstract class BaseRel_usuario_interaccion_sco12 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ref_interaccion;


	
	protected $index_interaccion;


	
	protected $id_sco12;


	
	protected $id_usuario;


	
	protected $time;


	
	protected $type;


	
	protected $weighting;


	
	protected $student_response;


	
	protected $result;


	
	protected $latency;

	
	protected $aSco12;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRefInteraccion()
	{

		return $this->ref_interaccion;
	}

	
	public function getIndexInteraccion()
	{

		return $this->index_interaccion;
	}

	
	public function getIdSco12()
	{

		return $this->id_sco12;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getTime()
	{

		return $this->time;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getWeighting()
	{

		return $this->weighting;
	}

	
	public function getStudentResponse()
	{

		return $this->student_response;
	}

	
	public function getResult()
	{

		return $this->result;
	}

	
	public function getLatency()
	{

		return $this->latency;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::ID;
		}

	} 
	
	public function setRefInteraccion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ref_interaccion !== $v) {
			$this->ref_interaccion = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::REF_INTERACCION;
		}

	} 
	
	public function setIndexInteraccion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_interaccion !== $v) {
			$this->index_interaccion = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION;
		}

	} 
	
	public function setIdSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco12 !== $v) {
			$this->id_sco12 = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::ID_SCO12;
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
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->time !== $v) {
			$this->time = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::TIME;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::TYPE;
		}

	} 
	
	public function setWeighting($v)
	{

		if ($this->weighting !== $v) {
			$this->weighting = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::WEIGHTING;
		}

	} 
	
	public function setStudentResponse($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->student_response !== $v) {
			$this->student_response = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::STUDENT_RESPONSE;
		}

	} 
	
	public function setResult($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->result !== $v) {
			$this->result = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::RESULT;
		}

	} 
	
	public function setLatency($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->latency !== $v) {
			$this->latency = $v;
			$this->modifiedColumns[] = Rel_usuario_interaccion_sco12Peer::LATENCY;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->ref_interaccion = $rs->getString($startcol + 1);

			$this->index_interaccion = $rs->getString($startcol + 2);

			$this->id_sco12 = $rs->getString($startcol + 3);

			$this->id_usuario = $rs->getString($startcol + 4);

			$this->time = $rs->getString($startcol + 5);

			$this->type = $rs->getString($startcol + 6);

			$this->weighting = $rs->getFloat($startcol + 7);

			$this->student_response = $rs->getString($startcol + 8);

			$this->result = $rs->getString($startcol + 9);

			$this->latency = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_interaccion_sco12 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_interaccion_sco12Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_interaccion_sco12Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_interaccion_sco12Peer::DATABASE_NAME);
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
					$pk = Rel_usuario_interaccion_sco12Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_interaccion_sco12Peer::doUpdate($this, $con);
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


			if (($retval = Rel_usuario_interaccion_sco12Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_interaccion_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRefInteraccion();
				break;
			case 2:
				return $this->getIndexInteraccion();
				break;
			case 3:
				return $this->getIdSco12();
				break;
			case 4:
				return $this->getIdUsuario();
				break;
			case 5:
				return $this->getTime();
				break;
			case 6:
				return $this->getType();
				break;
			case 7:
				return $this->getWeighting();
				break;
			case 8:
				return $this->getStudentResponse();
				break;
			case 9:
				return $this->getResult();
				break;
			case 10:
				return $this->getLatency();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_interaccion_sco12Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRefInteraccion(),
			$keys[2] => $this->getIndexInteraccion(),
			$keys[3] => $this->getIdSco12(),
			$keys[4] => $this->getIdUsuario(),
			$keys[5] => $this->getTime(),
			$keys[6] => $this->getType(),
			$keys[7] => $this->getWeighting(),
			$keys[8] => $this->getStudentResponse(),
			$keys[9] => $this->getResult(),
			$keys[10] => $this->getLatency(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_interaccion_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRefInteraccion($value);
				break;
			case 2:
				$this->setIndexInteraccion($value);
				break;
			case 3:
				$this->setIdSco12($value);
				break;
			case 4:
				$this->setIdUsuario($value);
				break;
			case 5:
				$this->setTime($value);
				break;
			case 6:
				$this->setType($value);
				break;
			case 7:
				$this->setWeighting($value);
				break;
			case 8:
				$this->setStudentResponse($value);
				break;
			case 9:
				$this->setResult($value);
				break;
			case 10:
				$this->setLatency($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_interaccion_sco12Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRefInteraccion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIndexInteraccion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdSco12($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdUsuario($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setWeighting($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStudentResponse($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setResult($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLatency($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_interaccion_sco12Peer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::ID)) $criteria->add(Rel_usuario_interaccion_sco12Peer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::REF_INTERACCION)) $criteria->add(Rel_usuario_interaccion_sco12Peer::REF_INTERACCION, $this->ref_interaccion);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION)) $criteria->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $this->index_interaccion);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::ID_SCO12)) $criteria->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $this->id_sco12);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::ID_USUARIO)) $criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::TIME)) $criteria->add(Rel_usuario_interaccion_sco12Peer::TIME, $this->time);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::TYPE)) $criteria->add(Rel_usuario_interaccion_sco12Peer::TYPE, $this->type);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::WEIGHTING)) $criteria->add(Rel_usuario_interaccion_sco12Peer::WEIGHTING, $this->weighting);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::STUDENT_RESPONSE)) $criteria->add(Rel_usuario_interaccion_sco12Peer::STUDENT_RESPONSE, $this->student_response);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::RESULT)) $criteria->add(Rel_usuario_interaccion_sco12Peer::RESULT, $this->result);
		if ($this->isColumnModified(Rel_usuario_interaccion_sco12Peer::LATENCY)) $criteria->add(Rel_usuario_interaccion_sco12Peer::LATENCY, $this->latency);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_interaccion_sco12Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_interaccion_sco12Peer::ID, $this->id);

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

		$copyObj->setRefInteraccion($this->ref_interaccion);

		$copyObj->setIndexInteraccion($this->index_interaccion);

		$copyObj->setIdSco12($this->id_sco12);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setTime($this->time);

		$copyObj->setType($this->type);

		$copyObj->setWeighting($this->weighting);

		$copyObj->setStudentResponse($this->student_response);

		$copyObj->setResult($this->result);

		$copyObj->setLatency($this->latency);


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
			self::$peer = new Rel_usuario_interaccion_sco12Peer();
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