<?php


abstract class BasePais extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $isonum;


	
	protected $iso2;


	
	protected $iso3;


	
	protected $nombre;

	
	protected $collUsuarios;

	
	protected $lastUsuarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIsonum()
	{

		return $this->isonum;
	}

	
	public function getIso2()
	{

		return $this->iso2;
	}

	
	public function getIso3()
	{

		return $this->iso3;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PaisPeer::ID;
		}

	} 
	
	public function setIsonum($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->isonum !== $v) {
			$this->isonum = $v;
			$this->modifiedColumns[] = PaisPeer::ISONUM;
		}

	} 
	
	public function setIso2($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso2 !== $v) {
			$this->iso2 = $v;
			$this->modifiedColumns[] = PaisPeer::ISO2;
		}

	} 
	
	public function setIso3($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso3 !== $v) {
			$this->iso3 = $v;
			$this->modifiedColumns[] = PaisPeer::ISO3;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = PaisPeer::NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->isonum = $rs->getInt($startcol + 1);

			$this->iso2 = $rs->getString($startcol + 2);

			$this->iso3 = $rs->getString($startcol + 3);

			$this->nombre = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Pais object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaisPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PaisPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PaisPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PaisPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PaisPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collUsuarios !== null) {
				foreach($this->collUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = PaisPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUsuarios !== null) {
					foreach($this->collUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIsonum();
				break;
			case 2:
				return $this->getIso2();
				break;
			case 3:
				return $this->getIso3();
				break;
			case 4:
				return $this->getNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaisPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIsonum(),
			$keys[2] => $this->getIso2(),
			$keys[3] => $this->getIso3(),
			$keys[4] => $this->getNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIsonum($value);
				break;
			case 2:
				$this->setIso2($value);
				break;
			case 3:
				$this->setIso3($value);
				break;
			case 4:
				$this->setNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaisPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIsonum($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIso2($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIso3($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNombre($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PaisPeer::DATABASE_NAME);

		if ($this->isColumnModified(PaisPeer::ID)) $criteria->add(PaisPeer::ID, $this->id);
		if ($this->isColumnModified(PaisPeer::ISONUM)) $criteria->add(PaisPeer::ISONUM, $this->isonum);
		if ($this->isColumnModified(PaisPeer::ISO2)) $criteria->add(PaisPeer::ISO2, $this->iso2);
		if ($this->isColumnModified(PaisPeer::ISO3)) $criteria->add(PaisPeer::ISO3, $this->iso3);
		if ($this->isColumnModified(PaisPeer::NOMBRE)) $criteria->add(PaisPeer::NOMBRE, $this->nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PaisPeer::DATABASE_NAME);

		$criteria->add(PaisPeer::ID, $this->id);

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

		$copyObj->setIsonum($this->isonum);

		$copyObj->setIso2($this->iso2);

		$copyObj->setIso3($this->iso3);

		$copyObj->setNombre($this->nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getUsuarios() as $relObj) {
				$copyObj->addUsuario($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new PaisPeer();
		}
		return self::$peer;
	}

	
	public function initUsuarios()
	{
		if ($this->collUsuarios === null) {
			$this->collUsuarios = array();
		}
	}

	
	public function getUsuarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios === null) {
			if ($this->isNew()) {
			   $this->collUsuarios = array();
			} else {

				$criteria->add(UsuarioPeer::PAIS_ID, $this->getId());

				UsuarioPeer::addSelectColumns($criteria);
				$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPeer::PAIS_ID, $this->getId());

				UsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioCriteria) || !$this->lastUsuarioCriteria->equals($criteria)) {
					$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioCriteria = $criteria;
		return $this->collUsuarios;
	}

	
	public function countUsuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UsuarioPeer::PAIS_ID, $this->getId());

		return UsuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuario(Usuario $l)
	{
		$this->collUsuarios[] = $l;
		$l->setPais($this);
	}

} 