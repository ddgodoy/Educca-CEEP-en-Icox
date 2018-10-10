<?php


abstract class BaseRel_interaccion_sco12_respuesta extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $index_respuesta;


	
	protected $index_interaccion;


	
	protected $id_sco12;


	
	protected $id_usuario;


	
	protected $pattern;

	
	protected $aSco12;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIndexRespuesta()
	{

		return $this->index_respuesta;
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

	
	public function getPattern()
	{

		return $this->pattern;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::ID;
		}

	} 
	
	public function setIndexRespuesta($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_respuesta !== $v) {
			$this->index_respuesta = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::INDEX_RESPUESTA;
		}

	} 
	
	public function setIndexInteraccion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->index_interaccion !== $v) {
			$this->index_interaccion = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::INDEX_INTERACCION;
		}

	} 
	
	public function setIdSco12($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_sco12 !== $v) {
			$this->id_sco12 = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::ID_SCO12;
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
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setPattern($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pattern !== $v) {
			$this->pattern = $v;
			$this->modifiedColumns[] = Rel_interaccion_sco12_respuestaPeer::PATTERN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->index_respuesta = $rs->getString($startcol + 1);

			$this->index_interaccion = $rs->getString($startcol + 2);

			$this->id_sco12 = $rs->getString($startcol + 3);

			$this->id_usuario = $rs->getString($startcol + 4);

			$this->pattern = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_interaccion_sco12_respuesta object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_interaccion_sco12_respuestaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_interaccion_sco12_respuestaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_interaccion_sco12_respuestaPeer::DATABASE_NAME);
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
					$pk = Rel_interaccion_sco12_respuestaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Rel_interaccion_sco12_respuestaPeer::doUpdate($this, $con);
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


			if (($retval = Rel_interaccion_sco12_respuestaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_interaccion_sco12_respuestaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIndexRespuesta();
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
				return $this->getPattern();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_interaccion_sco12_respuestaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIndexRespuesta(),
			$keys[2] => $this->getIndexInteraccion(),
			$keys[3] => $this->getIdSco12(),
			$keys[4] => $this->getIdUsuario(),
			$keys[5] => $this->getPattern(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_interaccion_sco12_respuestaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIndexRespuesta($value);
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
				$this->setPattern($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_interaccion_sco12_respuestaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIndexRespuesta($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIndexInteraccion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdSco12($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIdUsuario($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPattern($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_interaccion_sco12_respuestaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::ID)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::ID, $this->id);
		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::INDEX_RESPUESTA)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::INDEX_RESPUESTA, $this->index_respuesta);
		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::INDEX_INTERACCION)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::INDEX_INTERACCION, $this->index_interaccion);
		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::ID_SCO12)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $this->id_sco12);
		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_interaccion_sco12_respuestaPeer::PATTERN)) $criteria->add(Rel_interaccion_sco12_respuestaPeer::PATTERN, $this->pattern);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_interaccion_sco12_respuestaPeer::DATABASE_NAME);

		$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID, $this->id);

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

		$copyObj->setIndexRespuesta($this->index_respuesta);

		$copyObj->setIndexInteraccion($this->index_interaccion);

		$copyObj->setIdSco12($this->id_sco12);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setPattern($this->pattern);


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
			self::$peer = new Rel_interaccion_sco12_respuestaPeer();
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