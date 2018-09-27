<?php


abstract class BaseRel_usuario_sco2004_iobjective extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sco2004;


	
	protected $id_usuario;


	
	protected $interaction_index;


	
	protected $objective_index;


	
	protected $objective_id;

	
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

	
	public function getObjectiveIndex()
	{

		return $this->objective_index;
	}

	
	public function getObjectiveId()
	{

		return $this->objective_id;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::ID;
		}

	} 
	
	public function setIdSco2004($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco2004 !== $v) {
			$this->id_sco2004 = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004;
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
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO;
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
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX;
		}

	} 
	
	public function setObjectiveIndex($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->objective_index !== $v) {
			$this->objective_index = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_INDEX;
		}

	} 
	
	public function setObjectiveId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->objective_id !== $v) {
			$this->objective_id = $v;
			$this->modifiedColumns[] = Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_sco2004 = $rs->getString($startcol + 1);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->interaction_index = $rs->getInt($startcol + 3);

			$this->objective_index = $rs->getInt($startcol + 4);

			$this->objective_id = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_sco2004_iobjective object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_sco2004_iobjectivePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_sco2004_iobjectivePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_sco2004_iobjectivePeer::DATABASE_NAME);
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
					$pk = Rel_usuario_sco2004_iobjectivePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_sco2004_iobjectivePeer::doUpdate($this, $con);
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


			if (($retval = Rel_usuario_sco2004_iobjectivePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_iobjectivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getObjectiveIndex();
				break;
			case 5:
				return $this->getObjectiveId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_iobjectivePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSco2004(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getInteractionIndex(),
			$keys[4] => $this->getObjectiveIndex(),
			$keys[5] => $this->getObjectiveId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_sco2004_iobjectivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setObjectiveIndex($value);
				break;
			case 5:
				$this->setObjectiveId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_sco2004_iobjectivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSco2004($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInteractionIndex($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjectiveIndex($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObjectiveId($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_iobjectivePeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::ID)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID, $this->id);
		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $this->id_sco2004);
		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX, $this->interaction_index);
		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_INDEX)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_INDEX, $this->objective_index);
		if ($this->isColumnModified(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_ID)) $criteria->add(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_ID, $this->objective_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_sco2004_iobjectivePeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID, $this->id);

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

		$copyObj->setObjectiveIndex($this->objective_index);

		$copyObj->setObjectiveId($this->objective_id);


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
			self::$peer = new Rel_usuario_sco2004_iobjectivePeer();
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