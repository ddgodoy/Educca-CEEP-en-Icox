<?php


abstract class BaseRel_paquete_curso extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_paquete;


	
	protected $id_curso;

	
	protected $aPaquete;

	
	protected $aCurso;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdPaquete()
	{

		return $this->id_paquete;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function setIdPaquete($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_paquete !== $v) {
			$this->id_paquete = $v;
			$this->modifiedColumns[] = Rel_paquete_cursoPeer::ID_PAQUETE;
		}

		if ($this->aPaquete !== null && $this->aPaquete->getId() !== $v) {
			$this->aPaquete = null;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Rel_paquete_cursoPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_paquete = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_paquete_curso object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_paquete_cursoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_paquete_cursoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_paquete_cursoPeer::DATABASE_NAME);
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


												
			if ($this->aPaquete !== null) {
				if ($this->aPaquete->isModified()) {
					$affectedRows += $this->aPaquete->save($con);
				}
				$this->setPaquete($this->aPaquete);
			}

			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_paquete_cursoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_paquete_cursoPeer::doUpdate($this, $con);
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


												
			if ($this->aPaquete !== null) {
				if (!$this->aPaquete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPaquete->getValidationFailures());
				}
			}

			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}


			if (($retval = Rel_paquete_cursoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_paquete_cursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdPaquete();
				break;
			case 1:
				return $this->getIdCurso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_paquete_cursoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdPaquete(),
			$keys[1] => $this->getIdCurso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_paquete_cursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdPaquete($value);
				break;
			case 1:
				$this->setIdCurso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_paquete_cursoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdPaquete($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_paquete_cursoPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_paquete_cursoPeer::ID_PAQUETE)) $criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->id_paquete);
		if ($this->isColumnModified(Rel_paquete_cursoPeer::ID_CURSO)) $criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->id_curso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_paquete_cursoPeer::DATABASE_NAME);

		$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->id_paquete);
		$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->id_curso);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdPaquete();

		$pks[1] = $this->getIdCurso();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdPaquete($keys[0]);

		$this->setIdCurso($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setIdPaquete(NULL); 
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
			self::$peer = new Rel_paquete_cursoPeer();
		}
		return self::$peer;
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