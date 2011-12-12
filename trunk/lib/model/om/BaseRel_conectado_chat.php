<?php


abstract class BaseRel_conectado_chat extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_curso;


	
	protected $id_rol;


	
	protected $tiempo;

	
	protected $aUsuario;

	
	protected $aCurso;

	
	protected $aRol;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getIdRol()
	{

		return $this->id_rol;
	}

	
	public function getTiempo()
	{

		return $this->tiempo;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_conectado_chatPeer::ID_USUARIO;
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
			$this->modifiedColumns[] = Rel_conectado_chatPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = Rel_conectado_chatPeer::ID_ROL;
		}

		if ($this->aRol !== null && $this->aRol->getId() !== $v) {
			$this->aRol = null;
		}

	} 
	
	public function setTiempo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tiempo !== $v) {
			$this->tiempo = $v;
			$this->modifiedColumns[] = Rel_conectado_chatPeer::TIEMPO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

			$this->id_rol = $rs->getString($startcol + 2);

			$this->tiempo = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_conectado_chat object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_conectado_chatPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_conectado_chatPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_conectado_chatPeer::DATABASE_NAME);
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

			if ($this->aRol !== null) {
				if ($this->aRol->isModified()) {
					$affectedRows += $this->aRol->save($con);
				}
				$this->setRol($this->aRol);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_conectado_chatPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_conectado_chatPeer::doUpdate($this, $con);
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

			if ($this->aRol !== null) {
				if (!$this->aRol->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRol->getValidationFailures());
				}
			}


			if (($retval = Rel_conectado_chatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_conectado_chatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdCurso();
				break;
			case 2:
				return $this->getIdRol();
				break;
			case 3:
				return $this->getTiempo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_conectado_chatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdCurso(),
			$keys[2] => $this->getIdRol(),
			$keys[3] => $this->getTiempo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_conectado_chatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdCurso($value);
				break;
			case 2:
				$this->setIdRol($value);
				break;
			case 3:
				$this->setTiempo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_conectado_chatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdRol($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTiempo($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_conectado_chatPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_conectado_chatPeer::ID_USUARIO)) $criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_conectado_chatPeer::ID_CURSO)) $criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Rel_conectado_chatPeer::ID_ROL)) $criteria->add(Rel_conectado_chatPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(Rel_conectado_chatPeer::TIEMPO)) $criteria->add(Rel_conectado_chatPeer::TIEMPO, $this->tiempo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_conectado_chatPeer::DATABASE_NAME);

		$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->id_curso);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdCurso();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdCurso($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdRol($this->id_rol);

		$copyObj->setTiempo($this->tiempo);


		$copyObj->setNew(true);

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
			self::$peer = new Rel_conectado_chatPeer();
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

	
	public function setRol($v)
	{


		if ($v === null) {
			$this->setIdRol(NULL);
		} else {
			$this->setIdRol($v->getId());
		}


		$this->aRol = $v;
	}


	
	public function getRol($con = null)
	{
		if ($this->aRol === null && (($this->id_rol !== "" && $this->id_rol !== null))) {
						include_once 'lib/model/om/BaseRolPeer.php';

			$this->aRol = RolPeer::retrieveByPK($this->id_rol, $con);

			
		}
		return $this->aRol;
	}

} 