<?php


abstract class BaseRel_usuario_evento extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_evento;

	
	protected $aUsuario;

	
	protected $aEvento;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdEvento()
	{

		return $this->id_evento;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_eventoPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdEvento($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_evento !== $v) {
			$this->id_evento = $v;
			$this->modifiedColumns[] = Rel_usuario_eventoPeer::ID_EVENTO;
		}

		if ($this->aEvento !== null && $this->aEvento->getId() !== $v) {
			$this->aEvento = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getString($startcol + 0);

			$this->id_evento = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_evento object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_eventoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_eventoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_usuario_eventoPeer::DATABASE_NAME);
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

			if ($this->aEvento !== null) {
				if ($this->aEvento->isModified()) {
					$affectedRows += $this->aEvento->save($con);
				}
				$this->setEvento($this->aEvento);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_eventoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_eventoPeer::doUpdate($this, $con);
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

			if ($this->aEvento !== null) {
				if (!$this->aEvento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvento->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_eventoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_eventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdEvento();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_eventoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdEvento(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_eventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdEvento($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_eventoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEvento($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_eventoPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_eventoPeer::ID_USUARIO)) $criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_eventoPeer::ID_EVENTO)) $criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->id_evento);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_eventoPeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->id_evento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdEvento();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdEvento($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdEvento(NULL); 
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
			self::$peer = new Rel_usuario_eventoPeer();
		}
		return self::$peer;
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

	
	public function setEvento($v)
	{


		if ($v === null) {
			$this->setIdEvento(NULL);
		} else {
			$this->setIdEvento($v->getId());
		}


		$this->aEvento = $v;
	}


	
	public function getEvento($con = null)
	{
		if ($this->aEvento === null && (($this->id_evento !== "" && $this->id_evento !== null))) {
						include_once 'lib/model/om/BaseEventoPeer.php';

			$this->aEvento = EventoPeer::retrieveByPK($this->id_evento, $con);

			
		}
		return $this->aEvento;
	}

} 