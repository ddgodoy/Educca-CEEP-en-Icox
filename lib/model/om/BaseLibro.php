<?php


abstract class BaseLibro extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $autor;


	
	protected $editorial;


	
	protected $anio_publicacion;


	
	protected $isbn;


	
	protected $id_materia;


	
	protected $created_at;

	
	protected $aMateria;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getAutor()
	{

		return $this->autor;
	}

	
	public function getEditorial()
	{

		return $this->editorial;
	}

	
	public function getAnioPublicacion()
	{

		return $this->anio_publicacion;
	}

	
	public function getIsbn()
	{

		return $this->isbn;
	}

	
	public function getIdMateria()
	{

		return $this->id_materia;
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
			$this->modifiedColumns[] = LibroPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = LibroPeer::NOMBRE;
		}

	} 
	
	public function setAutor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->autor !== $v) {
			$this->autor = $v;
			$this->modifiedColumns[] = LibroPeer::AUTOR;
		}

	} 
	
	public function setEditorial($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->editorial !== $v) {
			$this->editorial = $v;
			$this->modifiedColumns[] = LibroPeer::EDITORIAL;
		}

	} 
	
	public function setAnioPublicacion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->anio_publicacion !== $v) {
			$this->anio_publicacion = $v;
			$this->modifiedColumns[] = LibroPeer::ANIO_PUBLICACION;
		}

	} 
	
	public function setIsbn($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->isbn !== $v) {
			$this->isbn = $v;
			$this->modifiedColumns[] = LibroPeer::ISBN;
		}

	} 
	
	public function setIdMateria($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_materia !== $v) {
			$this->id_materia = $v;
			$this->modifiedColumns[] = LibroPeer::ID_MATERIA;
		}

		if ($this->aMateria !== null && $this->aMateria->getId() !== $v) {
			$this->aMateria = null;
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
			$this->modifiedColumns[] = LibroPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->autor = $rs->getString($startcol + 2);

			$this->editorial = $rs->getString($startcol + 3);

			$this->anio_publicacion = $rs->getString($startcol + 4);

			$this->isbn = $rs->getString($startcol + 5);

			$this->id_materia = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
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
			$con = Propel::getConnection(LibroPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LibroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(LibroPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LibroPeer::DATABASE_NAME);
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


												
			if ($this->aMateria !== null) {
				if ($this->aMateria->isModified()) {
					$affectedRows += $this->aMateria->save($con);
				}
				$this->setMateria($this->aMateria);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LibroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += LibroPeer::doUpdate($this, $con);
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


			if (($retval = LibroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LibroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getAutor();
				break;
			case 3:
				return $this->getEditorial();
				break;
			case 4:
				return $this->getAnioPublicacion();
				break;
			case 5:
				return $this->getIsbn();
				break;
			case 6:
				return $this->getIdMateria();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LibroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getAutor(),
			$keys[3] => $this->getEditorial(),
			$keys[4] => $this->getAnioPublicacion(),
			$keys[5] => $this->getIsbn(),
			$keys[6] => $this->getIdMateria(),
			$keys[7] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LibroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setAutor($value);
				break;
			case 3:
				$this->setEditorial($value);
				break;
			case 4:
				$this->setAnioPublicacion($value);
				break;
			case 5:
				$this->setIsbn($value);
				break;
			case 6:
				$this->setIdMateria($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LibroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAutor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEditorial($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAnioPublicacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsbn($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIdMateria($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LibroPeer::DATABASE_NAME);

		if ($this->isColumnModified(LibroPeer::ID)) $criteria->add(LibroPeer::ID, $this->id);
		if ($this->isColumnModified(LibroPeer::NOMBRE)) $criteria->add(LibroPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(LibroPeer::AUTOR)) $criteria->add(LibroPeer::AUTOR, $this->autor);
		if ($this->isColumnModified(LibroPeer::EDITORIAL)) $criteria->add(LibroPeer::EDITORIAL, $this->editorial);
		if ($this->isColumnModified(LibroPeer::ANIO_PUBLICACION)) $criteria->add(LibroPeer::ANIO_PUBLICACION, $this->anio_publicacion);
		if ($this->isColumnModified(LibroPeer::ISBN)) $criteria->add(LibroPeer::ISBN, $this->isbn);
		if ($this->isColumnModified(LibroPeer::ID_MATERIA)) $criteria->add(LibroPeer::ID_MATERIA, $this->id_materia);
		if ($this->isColumnModified(LibroPeer::CREATED_AT)) $criteria->add(LibroPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LibroPeer::DATABASE_NAME);

		$criteria->add(LibroPeer::ID, $this->id);

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

		$copyObj->setNombre($this->nombre);

		$copyObj->setAutor($this->autor);

		$copyObj->setEditorial($this->editorial);

		$copyObj->setAnioPublicacion($this->anio_publicacion);

		$copyObj->setIsbn($this->isbn);

		$copyObj->setIdMateria($this->id_materia);

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
			self::$peer = new LibroPeer();
		}
		return self::$peer;
	}

	
	public function setMateria($v)
	{


		if ($v === null) {
			$this->setIdMateria(NULL);
		} else {
			$this->setIdMateria($v->getId());
		}


		$this->aMateria = $v;
	}


	
	public function getMateria($con = null)
	{
		if ($this->aMateria === null && (($this->id_materia !== "" && $this->id_materia !== null))) {
						include_once 'lib/model/om/BaseMateriaPeer.php';

			$this->aMateria = MateriaPeer::retrieveByPK($this->id_materia, $con);

			
		}
		return $this->aMateria;
	}

} 