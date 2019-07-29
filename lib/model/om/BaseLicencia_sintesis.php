<?php


abstract class BaseLicencia_sintesis extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;

	
	protected $id_curso;


	protected $num;


	protected $title;

	
	protected $capitulo;

	
	protected $created_at;

	
	protected $aCurso;


	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}


	public function getIdCurso()
	{

		return $this->id_curso;
	}


	public function getNum()
	{

		return $this->num;
	}


	public function getTitle()
	{

		return $this->title;
	}

	
	public function getCapitulo()
	{

		return $this->capitulo;
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

	
	public function setId($v)
	{		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Licencia_sintesisPeer::ID;
		}

	} 


	public function setIdCurso($v)
	{
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Licencia_sintesisPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 


	public function setNum($v)
	{	
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->num !== $v) {
			$this->num = $v;
			$this->modifiedColumns[] = Licencia_sintesisPeer::NUM;
		}

	} 


	public function setTitle($v)
	{	
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = Licencia_sintesisPeer::TITLE;
		}

	} 
	
	public function setCapitulo($v)
	{		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->capitulo !== $v) {
			$this->capitulo = $v;
			$this->modifiedColumns[] = Licencia_sintesisPeer::CAPITULO;
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
			$this->modifiedColumns[] = Licencia_sintesisPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

    		$this->num = $rs->getString($startcol + 2);

			$this->title = $rs->getString($startcol + 3);

			$this->capitulo = $rs->getString($startcol + 4);			

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Libro object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Licencia_sintesisPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Licencia_sintesisPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(Licencia_sintesisPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Licencia_sintesisPeer::DATABASE_NAME);
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
					$pk = Licencia_sintesisPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Licencia_sintesisPeer::doUpdate($this, $con);
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


												
			if ($this->aMateria !== null) {
				if (!$this->aMateria->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMateria->getValidationFailures());
				}
			}


			if (($retval = Licencia_sintesisPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Licencia_sintesisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdCurso();
				break;
			case 2:
				return $this->getNum();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getCapitulo();
				break;			
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Licencia_sintesisPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCurso(),
			$keys[2] => $this->getNum(),			
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getCapitulo(),			
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Licencia_sintesisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdCurso($value);
				break;			
			case 2:
				$this->setNum($value);
				break;
			case 3:
				$this->setTitle($value);
				break;	
			case 4:
				$this->setCapitulo($value);
				break;			
			case 5:
				$this->setCreatedAt($value);
				break;			
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Licencia_sintesisPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNum($arr[$keys[2]]);		
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCapitulo($arr[$keys[4]]);		
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Licencia_sintesisPeer::DATABASE_NAME);

		if ($this->isColumnModified(Licencia_sintesisPeer::ID)) $criteria->add(Licencia_sintesisPeer::ID, $this->id);
		if ($this->isColumnModified(Licencia_sintesisPeer::ID_CURSO)) $criteria->add(Licencia_sintesisPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Licencia_sintesisPeer::NUM)) $criteria->add(Licencia_sintesisPeer::NUM, $this->num);		
		if ($this->isColumnModified(Licencia_sintesisPeer::TITLE)) $criteria->add(Licencia_sintesisPeer::TITLE, $this->title);
		if ($this->isColumnModified(Licencia_sintesisPeer::CAPITULO)) $criteria->add(Licencia_sintesisPeer::CAPITULO, $this->capitulo);
		if ($this->isColumnModified(Licencia_sintesisPeer::CREATED_AT)) $criteria->add(Licencia_sintesisPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Licencia_sintesisPeer::DATABASE_NAME);

		$criteria->add(Licencia_sintesisPeer::ID, $this->id);

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

		$copyObj->setIdCurso($this->id_curso);

		$copyObj->setNum($this->num);

		$copyObj->setTitle($this->title);

		$copyObj->setCapitulo($this->capitulo);

		$copyObj->setCreatedAt($this->created_at);

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
			self::$peer = new Licencia_sintesisPeer();
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
		if ($this->aCurso === null && (($this->id_curso !== "" && $this->id_curso !== null))) {
						include_once 'lib/model/om/BaseCursoPeer.php';

			$this->aCurso = CursoPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aCurso;
	}
	
	

} 