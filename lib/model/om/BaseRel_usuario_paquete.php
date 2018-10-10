<?php


abstract class BaseRel_usuario_paquete extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_paquete;


	
	protected $created_at;


	
	protected $score;


	
	protected $presencial = 0;

	
	protected $aUsuario;

	
	protected $aPaquete;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdPaquete()
	{

		return $this->id_paquete;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getScore()
	{

		return $this->score;
	}

	
	public function getPresencial()
	{

		return $this->presencial;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Rel_usuario_paquetePeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdPaquete($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_paquete !== $v) {
			$this->id_paquete = $v;
			$this->modifiedColumns[] = Rel_usuario_paquetePeer::ID_PAQUETE;
		}

		if ($this->aPaquete !== null && $this->aPaquete->getId() !== $v) {
			$this->aPaquete = null;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = Rel_usuario_paquetePeer::CREATED_AT;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = Rel_usuario_paquetePeer::SCORE;
		}

	} 
	
	public function setPresencial($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->presencial !== $v || $v === 0) {
			$this->presencial = $v;
			$this->modifiedColumns[] = Rel_usuario_paquetePeer::PRESENCIAL;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getString($startcol + 0);

			$this->id_paquete = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->score = $rs->getFloat($startcol + 3);

			$this->presencial = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_usuario_paquete object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_paquetePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_usuario_paquetePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(Rel_usuario_paquetePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_usuario_paquetePeer::DATABASE_NAME);
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

			if ($this->aPaquete !== null) {
				if ($this->aPaquete->isModified()) {
					$affectedRows += $this->aPaquete->save($con);
				}
				$this->setPaquete($this->aPaquete);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_usuario_paquetePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_usuario_paquetePeer::doUpdate($this, $con);
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

			if ($this->aPaquete !== null) {
				if (!$this->aPaquete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPaquete->getValidationFailures());
				}
			}


			if (($retval = Rel_usuario_paquetePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_paquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdPaquete();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getScore();
				break;
			case 4:
				return $this->getPresencial();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_paquetePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdPaquete(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getScore(),
			$keys[4] => $this->getPresencial(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_usuario_paquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdPaquete($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setScore($value);
				break;
			case 4:
				$this->setPresencial($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_usuario_paquetePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdPaquete($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setScore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPresencial($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_usuario_paquetePeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_usuario_paquetePeer::ID_USUARIO)) $criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Rel_usuario_paquetePeer::ID_PAQUETE)) $criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id_paquete);
		if ($this->isColumnModified(Rel_usuario_paquetePeer::CREATED_AT)) $criteria->add(Rel_usuario_paquetePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(Rel_usuario_paquetePeer::SCORE)) $criteria->add(Rel_usuario_paquetePeer::SCORE, $this->score);
		if ($this->isColumnModified(Rel_usuario_paquetePeer::PRESENCIAL)) $criteria->add(Rel_usuario_paquetePeer::PRESENCIAL, $this->presencial);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_usuario_paquetePeer::DATABASE_NAME);

		$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id_paquete);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdPaquete();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdPaquete($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setScore($this->score);

		$copyObj->setPresencial($this->presencial);


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdPaquete(NULL); 
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
			self::$peer = new Rel_usuario_paquetePeer();
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

	
	public function setPaquete($v)
	{


		if ($v === null) {
			$this->setIdPaquete(NULL);
		} else {
			$this->setIdPaquete($v->getId());
		}


		$this->aPaquete = $v;
	}


	
	public function getPaquete($con = null)
	{
		if ($this->aPaquete === null && (($this->id_paquete !== "" && $this->id_paquete !== null))) {
						include_once 'lib/model/om/BasePaquetePeer.php';

			$this->aPaquete = PaquetePeer::retrieveByPK($this->id_paquete, $con);

			
		}
		return $this->aPaquete;
	}

} 