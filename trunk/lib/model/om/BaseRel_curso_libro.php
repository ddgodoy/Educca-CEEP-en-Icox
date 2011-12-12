<?php


abstract class BaseRel_curso_libro extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_curso;


	
	protected $id_libro;

	
	protected $aCurso;

	
	protected $aLibro;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getIdLibro()
	{

		return $this->id_libro;
	}

	
	public function setIdCurso($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Rel_curso_libroPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setIdLibro($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_libro !== $v) {
			$this->id_libro = $v;
			$this->modifiedColumns[] = Rel_curso_libroPeer::ID_LIBRO;
		}

		if ($this->aLibro !== null && $this->aLibro->getId() !== $v) {
			$this->aLibro = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_curso = $rs->getString($startcol + 0);

			$this->id_libro = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_curso_libro object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_curso_libroPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_curso_libroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_curso_libroPeer::DATABASE_NAME);
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


												
			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}

			if ($this->aLibro !== null) {
				if ($this->aLibro->isModified()) {
					$affectedRows += $this->aLibro->save($con);
				}
				$this->setLibro($this->aLibro);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_curso_libroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_curso_libroPeer::doUpdate($this, $con);
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


												
			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}

			if ($this->aLibro !== null) {
				if (!$this->aLibro->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLibro->getValidationFailures());
				}
			}


			if (($retval = Rel_curso_libroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_curso_libroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdCurso();
				break;
			case 1:
				return $this->getIdLibro();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_curso_libroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdCurso(),
			$keys[1] => $this->getIdLibro(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_curso_libroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdCurso($value);
				break;
			case 1:
				$this->setIdLibro($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_curso_libroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdCurso($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdLibro($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_curso_libroPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_curso_libroPeer::ID_CURSO)) $criteria->add(Rel_curso_libroPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Rel_curso_libroPeer::ID_LIBRO)) $criteria->add(Rel_curso_libroPeer::ID_LIBRO, $this->id_libro);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_curso_libroPeer::DATABASE_NAME);

		$criteria->add(Rel_curso_libroPeer::ID_CURSO, $this->id_curso);
		$criteria->add(Rel_curso_libroPeer::ID_LIBRO, $this->id_libro);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdCurso();

		$pks[1] = $this->getIdLibro();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdCurso($keys[0]);

		$this->setIdLibro($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setIdCurso(NULL); 
		$copyObj->setIdLibro(NULL); 
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
			self::$peer = new Rel_curso_libroPeer();
		}
		return self::$peer;
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
				include_once 'lib/model/om/BaseCursoPeer.php';

		if ($this->aCurso === null && (($this->id_curso !== "" && $this->id_curso !== null))) {

			$this->aCurso = CursoPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aCurso;
	}

	
	public function setLibro($v)
	{


		if ($v === null) {
			$this->setIdLibro(NULL);
		} else {
			$this->setIdLibro($v->getId());
		}


		$this->aLibro = $v;
	}


	
	public function getLibro($con = null)
	{
				include_once 'lib/model/om/BaseLibroPeer.php';

		if ($this->aLibro === null && (($this->id_libro !== "" && $this->id_libro !== null))) {

			$this->aLibro = LibroPeer::retrieveByPK($this->id_libro, $con);

			
		}
		return $this->aLibro;
	}

} 