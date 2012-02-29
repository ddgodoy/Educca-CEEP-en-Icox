<?php


abstract class BasePreferencia_usuario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $usuario_id;


	
	protected $cal_dias_antes;


	
	protected $cal_dias_despues;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUsuarioId()
	{

		return $this->usuario_id;
	}

	
	public function getCalDiasAntes()
	{

		return $this->cal_dias_antes;
	}

	
	public function getCalDiasDespues()
	{

		return $this->cal_dias_despues;
	}

	
	public function setUsuarioId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usuario_id !== $v) {
			$this->usuario_id = $v;
			$this->modifiedColumns[] = Preferencia_usuarioPeer::USUARIO_ID;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setCalDiasAntes($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cal_dias_antes !== $v) {
			$this->cal_dias_antes = $v;
			$this->modifiedColumns[] = Preferencia_usuarioPeer::CAL_DIAS_ANTES;
		}

	} 
	
	public function setCalDiasDespues($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cal_dias_despues !== $v) {
			$this->cal_dias_despues = $v;
			$this->modifiedColumns[] = Preferencia_usuarioPeer::CAL_DIAS_DESPUES;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->usuario_id = $rs->getString($startcol + 0);

			$this->cal_dias_antes = $rs->getString($startcol + 1);

			$this->cal_dias_despues = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Preferencia_usuario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Preferencia_usuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Preferencia_usuarioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Preferencia_usuarioPeer::DATABASE_NAME);
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


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Preferencia_usuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Preferencia_usuarioPeer::doUpdate($this, $con);
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = Preferencia_usuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Preferencia_usuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUsuarioId();
				break;
			case 1:
				return $this->getCalDiasAntes();
				break;
			case 2:
				return $this->getCalDiasDespues();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Preferencia_usuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsuarioId(),
			$keys[1] => $this->getCalDiasAntes(),
			$keys[2] => $this->getCalDiasDespues(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Preferencia_usuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUsuarioId($value);
				break;
			case 1:
				$this->setCalDiasAntes($value);
				break;
			case 2:
				$this->setCalDiasDespues($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Preferencia_usuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsuarioId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCalDiasAntes($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCalDiasDespues($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Preferencia_usuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(Preferencia_usuarioPeer::USUARIO_ID)) $criteria->add(Preferencia_usuarioPeer::USUARIO_ID, $this->usuario_id);
		if ($this->isColumnModified(Preferencia_usuarioPeer::CAL_DIAS_ANTES)) $criteria->add(Preferencia_usuarioPeer::CAL_DIAS_ANTES, $this->cal_dias_antes);
		if ($this->isColumnModified(Preferencia_usuarioPeer::CAL_DIAS_DESPUES)) $criteria->add(Preferencia_usuarioPeer::CAL_DIAS_DESPUES, $this->cal_dias_despues);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Preferencia_usuarioPeer::DATABASE_NAME);

		$criteria->add(Preferencia_usuarioPeer::USUARIO_ID, $this->usuario_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUsuarioId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUsuarioId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCalDiasAntes($this->cal_dias_antes);

		$copyObj->setCalDiasDespues($this->cal_dias_despues);


		$copyObj->setNew(true);

		$copyObj->setUsuarioId(NULL); 
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
			self::$peer = new Preferencia_usuarioPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setUsuarioId(NULL);
		} else {
			$this->setUsuarioId($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->usuario_id !== "" && $this->usuario_id !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->usuario_id, $con);

			
		}
		return $this->aUsuario;
	}

} 