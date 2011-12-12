<?php


abstract class BaseMensaje_chat extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_usuario;


	
	protected $id_curso;


	
	protected $msg;


	
	protected $time;

	
	protected $aUsuario;

	
	protected $aCurso;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getMsg()
	{

		return $this->msg;
	}

	
	public function getTime()
	{

		return $this->time;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Mensaje_chatPeer::ID;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Mensaje_chatPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Mensaje_chatPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setMsg($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->msg !== $v) {
			$this->msg = $v;
			$this->modifiedColumns[] = Mensaje_chatPeer::MSG;
		}

	} 
	
	public function setTime($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->time !== $v) {
			$this->time = $v;
			$this->modifiedColumns[] = Mensaje_chatPeer::TIME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_usuario = $rs->getString($startcol + 1);

			$this->id_curso = $rs->getString($startcol + 2);

			$this->msg = $rs->getString($startcol + 3);

			$this->time = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Mensaje_chat object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Mensaje_chatPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Mensaje_chatPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Mensaje_chatPeer::DATABASE_NAME);
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

			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Mensaje_chatPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Mensaje_chatPeer::doUpdate($this, $con);
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

			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}


			if (($retval = Mensaje_chatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Mensaje_chatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdUsuario();
				break;
			case 2:
				return $this->getIdCurso();
				break;
			case 3:
				return $this->getMsg();
				break;
			case 4:
				return $this->getTime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Mensaje_chatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUsuario(),
			$keys[2] => $this->getIdCurso(),
			$keys[3] => $this->getMsg(),
			$keys[4] => $this->getTime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Mensaje_chatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdUsuario($value);
				break;
			case 2:
				$this->setIdCurso($value);
				break;
			case 3:
				$this->setMsg($value);
				break;
			case 4:
				$this->setTime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Mensaje_chatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUsuario($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdCurso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMsg($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTime($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Mensaje_chatPeer::DATABASE_NAME);

		if ($this->isColumnModified(Mensaje_chatPeer::ID)) $criteria->add(Mensaje_chatPeer::ID, $this->id);
		if ($this->isColumnModified(Mensaje_chatPeer::ID_USUARIO)) $criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Mensaje_chatPeer::ID_CURSO)) $criteria->add(Mensaje_chatPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Mensaje_chatPeer::MSG)) $criteria->add(Mensaje_chatPeer::MSG, $this->msg);
		if ($this->isColumnModified(Mensaje_chatPeer::TIME)) $criteria->add(Mensaje_chatPeer::TIME, $this->time);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Mensaje_chatPeer::DATABASE_NAME);

		$criteria->add(Mensaje_chatPeer::ID, $this->id);
		$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->id_curso);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getIdUsuario();

		$pks[2] = $this->getIdCurso();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setIdUsuario($keys[1]);

		$this->setIdCurso($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMsg($this->msg);

		$copyObj->setTime($this->time);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdCurso(NULL); 
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
			self::$peer = new Mensaje_chatPeer();
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

	
	public function setCurso($v)
	{


		if ($v === null) {
			$this->setIdCurso(NULL);
		} else {
			$this->setIdCurso($v->getId());
		}


		$this->aCurso = $v;
	}


	
	public function getCurso($con = null)
	{
		if ($this->aCurso === null && (($this->id_curso !== "" && $this->id_curso !== null))) {
						include_once 'lib/model/om/BaseCursoPeer.php';

			$this->aCurso = CursoPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aCurso;
	}

} 