<?php


abstract class BaseRel_usuario_objetivo_sco12 extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ref_objetivo;


	
	protected $index_objetivo;


	
	protected $id_sco12;


	
	protected $id_usuario;


	
	protected $score_raw;


	
	protected $score_max;


	
	protected $score_min;


	
	protected $status;

	
	protected $aSco12;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRefObjetivo()
	{

		return $this->ref_objetivo;
	}

	
	public function getIndexObjetivo()
	{

		return $this->index_objetivo;
	}

	
	public function getIdSco12()
	{

		return $this->id_sco12;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
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

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::ID;
		}

	} 
	
	public function setRefObjetivo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ref_objetivo !== $v) {
			$this->ref_objetivo = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::REF_OBJETIVO;
		}

	} 
	
	public function setIndexObjetivo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_objetivo !== $v) {
			$this->index_objetivo = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO;
		}

	} 
	
	public function setIdSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco12 !== $v) {
			$this->id_sco12 = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::ID_SCO12;
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
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setScoreRaw($v)
	{

		if ($this->score_raw !== $v) {
			$this->score_raw = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::SCORE_RAW;
		}

	} 
	
	public function setScoreMax($v)
	{

		if ($this->score_max !== $v) {
			$this->score_max = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::SCORE_MAX;
		}

	} 
	
	public function setScoreMin($v)
	{

		if ($this->score_min !== $v) {
			$this->score_min = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::SCORE_MIN;
		}

	} 
	
	public function setStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = Rel_usuario_objetivo_sco12Peer::STATUS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->ref_objetivo = $rs->getString($startcol + 1);

			$this->index_objetivo = $rs->getString($startcol + 2);

			$this->id_sco12 = $rs->getString($startcol + 3);

			$this->id_usuario = $rs->getString($startcol + 4);

			$this->score_raw = $rs->getFloat($startcol + 5);

			$this->score_max = $rs->getFloat($startcol + 6);

			$this->score_min = $rs->getFloat($startcol + 7);

			$this->status = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_objetivo_sco12 object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_objetivo_sco12Peer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_objetivo_sco12Peer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_objetivo_sco12Peer::DATABASE_NAME);
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
					$pk = Rel_usuario_objetivo_sco12Peer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_objetivo_sco12Peer::doUpdate($this, $con);
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


			if (($retval = Rel_usuario_objetivo_sco12Peer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_objetivo_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRefObjetivo();
				break;
			case 2:
				return $this->getIndexObjetivo();
				break;
			case 3:
				return $this->getIdSco12();
				break;
			case 4:
				return $this->getIdUsuario();
				break;
			case 5:
				return $this->getScoreRaw();
				break;
			case 6:
				return $this->getScoreMax();
				break;
			case 7:
				return $this->getScoreMin();
				break;
			case 8:
				return $this->getStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_objetivo_sco12Peer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRefObjetivo(),
			$keys[2] => $this->getIndexObjetivo(),
			$keys[3] => $this->getIdSco12(),
			$keys[4] => $this->getIdUsuario(),
			$keys[5] => $this->getScoreRaw(),
			$keys[6] => $this->getScoreMax(),
			$keys[7] => $this->getScoreMin(),
			$keys[8] => $this->getStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_objetivo_sco12Peer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRefObjetivo($value);
				break;
			case 2:
				$this->setIndexObjetivo($value);
				break;
			case 3:
				$this->setIdSco12($value);
				break;
			case 4:
				$this->setIdUsuario($value);
				break;
			case 5:
				$this->setScoreRaw($value);
				break;
			case 6:
				$this->setScoreMax($value);
				break;
			case 7:
				$this->setScoreMin($value);
				break;
			case 8:
				$this->setStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_objetivo_sco12Peer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRefObjetivo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIndexObjetivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdSco12($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdUsuario($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScoreRaw($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setScoreMax($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setScoreMin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStatus($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_objetivo_sco12Peer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::ID)) $criteria->add(Rel_usuario_objetivo_sco12Peer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::REF_OBJETIVO)) $criteria->add(Rel_usuario_objetivo_sco12Peer::REF_OBJETIVO, $this->ref_objetivo);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO)) $criteria->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $this->index_objetivo);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::ID_SCO12)) $criteria->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $this->id_sco12);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::ID_USUARIO)) $criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::SCORE_RAW)) $criteria->add(Rel_usuario_objetivo_sco12Peer::SCORE_RAW, $this->score_raw);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::SCORE_MAX)) $criteria->add(Rel_usuario_objetivo_sco12Peer::SCORE_MAX, $this->score_max);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::SCORE_MIN)) $criteria->add(Rel_usuario_objetivo_sco12Peer::SCORE_MIN, $this->score_min);
		if ($this->isColumnModified(Rel_usuario_objetivo_sco12Peer::STATUS)) $criteria->add(Rel_usuario_objetivo_sco12Peer::STATUS, $this->status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_objetivo_sco12Peer::DATABASE_NAME);

		$criteria->add(Rel_usuario_objetivo_sco12Peer::ID, $this->id);

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

		$copyObj->setRefObjetivo($this->ref_objetivo);

		$copyObj->setIndexObjetivo($this->index_objetivo);

		$copyObj->setIdSco12($this->id_sco12);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setScoreRaw($this->score_raw);

		$copyObj->setScoreMax($this->score_max);

		$copyObj->setScoreMin($this->score_min);

		$copyObj->setStatus($this->status);


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
			self::$peer = new Rel_usuario_objetivo_sco12Peer();
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