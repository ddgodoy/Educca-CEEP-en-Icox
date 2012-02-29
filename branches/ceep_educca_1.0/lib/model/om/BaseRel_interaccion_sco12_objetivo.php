<?php


abstract class BaseRel_interaccion_sco12_objetivo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $index_objetivo;


	
	protected $index_interaccion;


	
	protected $id_sco12;


	
	protected $id_usuario;


	
	protected $ref_objetivo;

	
	protected $aSco12;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIndexObjetivo()
	{

		return $this->index_objetivo;
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

	
	public function getRefObjetivo()
	{

		return $this->ref_objetivo;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::ID;
		}

	} 
	
	public function setIndexObjetivo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_objetivo !== $v) {
			$this->index_objetivo = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO;
		}

	} 
	
	public function setIndexInteraccion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_interaccion !== $v) {
			$this->index_interaccion = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION;
		}

	} 
	
	public function setIdSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco12 !== $v) {
			$this->id_sco12 = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::ID_SCO12;
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
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setRefObjetivo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ref_objetivo !== $v) {
			$this->ref_objetivo = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->index_objetivo = $rs->getString($startcol + 1);

			$this->index_interaccion = $rs->getString($startcol + 2);

			$this->id_sco12 = $rs->getString($startcol + 3);

			$this->id_usuario = $rs->getString($startcol + 4);

			$this->ref_objetivo = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_interaccion_sco12_objetivo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_interaccion_sco12_objetivoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);
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
					$pk = Rel_interaccion_sco12_objetivoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_interaccion_sco12_objetivoPeer::doUpdate($this, $con);
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


			if (($retval = Rel_interaccion_sco12_objetivoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_interaccion_sco12_objetivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIndexObjetivo();
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
				return $this->getRefObjetivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_interaccion_sco12_objetivoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIndexObjetivo(),
			$keys[2] => $this->getIndexInteraccion(),
			$keys[3] => $this->getIdSco12(),
			$keys[4] => $this->getIdUsuario(),
			$keys[5] => $this->getRefObjetivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_interaccion_sco12_objetivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIndexObjetivo($value);
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
				$this->setRefObjetivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_interaccion_sco12_objetivoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIndexObjetivo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIndexInteraccion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdSco12($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdUsuario($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRefObjetivo($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::ID)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::ID, $this->id);
		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO, $this->index_objetivo);
		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION, $this->index_interaccion);
		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::ID_SCO12)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $this->id_sco12);
		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO)) $criteria->add(Rel_interaccion_sco12_objetivoPeer::REF_OBJETIVO, $this->ref_objetivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_interaccion_sco12_objetivoPeer::DATABASE_NAME);

		$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID, $this->id);

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

		$copyObj->setIndexObjetivo($this->index_objetivo);

		$copyObj->setIndexInteraccion($this->index_interaccion);

		$copyObj->setIdSco12($this->id_sco12);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setRefObjetivo($this->ref_objetivo);


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
			self::$peer = new Rel_interaccion_sco12_objetivoPeer();
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