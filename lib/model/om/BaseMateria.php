<?php


abstract class BaseMateria extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $informacion;


	
	protected $normativa;


	
	protected $temas_totales;


	
	protected $height;


	
	protected $width;


	
	protected $tipo;


	
	protected $created_at;

	
	protected $collCursos;

	
	protected $lastCursoCriteria = null;

	
	protected $collLibros;

	
	protected $lastLibroCriteria = null;

	
	protected $collTemas;

	
	protected $lastTemaCriteria = null;

	
	protected $collEjercicios;

	
	protected $lastEjercicioCriteria = null;

	
	protected $collSco2004s;

	
	protected $lastSco2004Criteria = null;

	
	protected $collSco12s;

	
	protected $lastSco12Criteria = null;

	
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

	
	public function getInformacion()
	{

		return $this->informacion;
	}

	
	public function getNormativa()
	{

		return $this->normativa;
	}

	
	public function getTemasTotales()
	{

		return $this->temas_totales;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getTipo()
	{

		return $this->tipo;
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
			$this->modifiedColumns[] = MateriaPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = MateriaPeer::NOMBRE;
		}

	} 
	
	public function setInformacion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->informacion !== $v) {
			$this->informacion = $v;
			$this->modifiedColumns[] = MateriaPeer::INFORMACION;
		}

	} 
	
	public function setNormativa($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->normativa !== $v) {
			$this->normativa = $v;
			$this->modifiedColumns[] = MateriaPeer::NORMATIVA;
		}

	} 
	
	public function setTemasTotales($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->temas_totales !== $v) {
			$this->temas_totales = $v;
			$this->modifiedColumns[] = MateriaPeer::TEMAS_TOTALES;
		}

	} 
	
	public function setHeight($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = MateriaPeer::HEIGHT;
		}

	} 
	
	public function setWidth($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = MateriaPeer::WIDTH;
		}

	} 
	
	public function setTipo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tipo !== $v) {
			$this->tipo = $v;
			$this->modifiedColumns[] = MateriaPeer::TIPO;
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
			$this->modifiedColumns[] = MateriaPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->informacion = $rs->getString($startcol + 2);

			$this->normativa = $rs->getString($startcol + 3);

			$this->temas_totales = $rs->getString($startcol + 4);

			$this->height = $rs->getString($startcol + 5);

			$this->width = $rs->getString($startcol + 6);

			$this->tipo = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Materia object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MateriaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MateriaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MateriaPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MateriaPeer::DATABASE_NAME);
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
					$pk = MateriaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MateriaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCursos !== null) {
				foreach($this->collCursos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLibros !== null) {
				foreach($this->collLibros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTemas !== null) {
				foreach($this->collTemas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEjercicios !== null) {
				foreach($this->collEjercicios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSco2004s !== null) {
				foreach($this->collSco2004s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSco12s !== null) {
				foreach($this->collSco12s as $referrerFK) {
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


			if (($retval = MateriaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCursos !== null) {
					foreach($this->collCursos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLibros !== null) {
					foreach($this->collLibros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTemas !== null) {
					foreach($this->collTemas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEjercicios !== null) {
					foreach($this->collEjercicios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSco2004s !== null) {
					foreach($this->collSco2004s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSco12s !== null) {
					foreach($this->collSco12s as $referrerFK) {
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
		$pos = MateriaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getInformacion();
				break;
			case 3:
				return $this->getNormativa();
				break;
			case 4:
				return $this->getTemasTotales();
				break;
			case 5:
				return $this->getHeight();
				break;
			case 6:
				return $this->getWidth();
				break;
			case 7:
				return $this->getTipo();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MateriaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getInformacion(),
			$keys[3] => $this->getNormativa(),
			$keys[4] => $this->getTemasTotales(),
			$keys[5] => $this->getHeight(),
			$keys[6] => $this->getWidth(),
			$keys[7] => $this->getTipo(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MateriaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setInformacion($value);
				break;
			case 3:
				$this->setNormativa($value);
				break;
			case 4:
				$this->setTemasTotales($value);
				break;
			case 5:
				$this->setHeight($value);
				break;
			case 6:
				$this->setWidth($value);
				break;
			case 7:
				$this->setTipo($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MateriaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInformacion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNormativa($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTemasTotales($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHeight($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTipo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MateriaPeer::DATABASE_NAME);

		if ($this->isColumnModified(MateriaPeer::ID)) $criteria->add(MateriaPeer::ID, $this->id);
		if ($this->isColumnModified(MateriaPeer::NOMBRE)) $criteria->add(MateriaPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(MateriaPeer::INFORMACION)) $criteria->add(MateriaPeer::INFORMACION, $this->informacion);
		if ($this->isColumnModified(MateriaPeer::NORMATIVA)) $criteria->add(MateriaPeer::NORMATIVA, $this->normativa);
		if ($this->isColumnModified(MateriaPeer::TEMAS_TOTALES)) $criteria->add(MateriaPeer::TEMAS_TOTALES, $this->temas_totales);
		if ($this->isColumnModified(MateriaPeer::HEIGHT)) $criteria->add(MateriaPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(MateriaPeer::WIDTH)) $criteria->add(MateriaPeer::WIDTH, $this->width);
		if ($this->isColumnModified(MateriaPeer::TIPO)) $criteria->add(MateriaPeer::TIPO, $this->tipo);
		if ($this->isColumnModified(MateriaPeer::CREATED_AT)) $criteria->add(MateriaPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MateriaPeer::DATABASE_NAME);

		$criteria->add(MateriaPeer::ID, $this->id);

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

		$copyObj->setInformacion($this->informacion);

		$copyObj->setNormativa($this->normativa);

		$copyObj->setTemasTotales($this->temas_totales);

		$copyObj->setHeight($this->height);

		$copyObj->setWidth($this->width);

		$copyObj->setTipo($this->tipo);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCursos() as $relObj) {
				$copyObj->addCurso($relObj->copy($deepCopy));
			}

			foreach($this->getLibros() as $relObj) {
				$copyObj->addLibro($relObj->copy($deepCopy));
			}

			foreach($this->getTemas() as $relObj) {
				$copyObj->addTema($relObj->copy($deepCopy));
			}

			foreach($this->getEjercicios() as $relObj) {
				$copyObj->addEjercicio($relObj->copy($deepCopy));
			}

			foreach($this->getSco2004s() as $relObj) {
				$copyObj->addSco2004($relObj->copy($deepCopy));
			}

			foreach($this->getSco12s() as $relObj) {
				$copyObj->addSco12($relObj->copy($deepCopy));
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
			self::$peer = new MateriaPeer();
		}
		return self::$peer;
	}

	
	public function initCursos()
	{
		if ($this->collCursos === null) {
			$this->collCursos = array();
		}
	}

	
	public function getCursos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCursos === null) {
			if ($this->isNew()) {
			   $this->collCursos = array();
			} else {

				$criteria->add(CursoPeer::MATERIA_ID, $this->getId());

				CursoPeer::addSelectColumns($criteria);
				$this->collCursos = CursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CursoPeer::MATERIA_ID, $this->getId());

				CursoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCursoCriteria) || !$this->lastCursoCriteria->equals($criteria)) {
					$this->collCursos = CursoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCursoCriteria = $criteria;
		return $this->collCursos;
	}

	
	public function countCursos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CursoPeer::MATERIA_ID, $this->getId());

		return CursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCurso(Curso $l)
	{
		$this->collCursos[] = $l;
		$l->setMateria($this);
	}

	
	public function initLibros()
	{
		if ($this->collLibros === null) {
			$this->collLibros = array();
		}
	}

	
	public function getLibros($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLibroPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLibros === null) {
			if ($this->isNew()) {
			   $this->collLibros = array();
			} else {

				$criteria->add(LibroPeer::ID_MATERIA, $this->getId());

				LibroPeer::addSelectColumns($criteria);
				$this->collLibros = LibroPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LibroPeer::ID_MATERIA, $this->getId());

				LibroPeer::addSelectColumns($criteria);
				if (!isset($this->lastLibroCriteria) || !$this->lastLibroCriteria->equals($criteria)) {
					$this->collLibros = LibroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLibroCriteria = $criteria;
		return $this->collLibros;
	}

	
	public function countLibros($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLibroPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LibroPeer::ID_MATERIA, $this->getId());

		return LibroPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLibro(Libro $l)
	{
		$this->collLibros[] = $l;
		$l->setMateria($this);
	}

	
	public function initTemas()
	{
		if ($this->collTemas === null) {
			$this->collTemas = array();
		}
	}

	
	public function getTemas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTemas === null) {
			if ($this->isNew()) {
			   $this->collTemas = array();
			} else {

				$criteria->add(TemaPeer::ID_MATERIA, $this->getId());

				TemaPeer::addSelectColumns($criteria);
				$this->collTemas = TemaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TemaPeer::ID_MATERIA, $this->getId());

				TemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastTemaCriteria) || !$this->lastTemaCriteria->equals($criteria)) {
					$this->collTemas = TemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTemaCriteria = $criteria;
		return $this->collTemas;
	}

	
	public function countTemas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TemaPeer::ID_MATERIA, $this->getId());

		return TemaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTema(Tema $l)
	{
		$this->collTemas[] = $l;
		$l->setMateria($this);
	}

	
	public function initEjercicios()
	{
		if ($this->collEjercicios === null) {
			$this->collEjercicios = array();
		}
	}

	
	public function getEjercicios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicios === null) {
			if ($this->isNew()) {
			   $this->collEjercicios = array();
			} else {

				$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

				EjercicioPeer::addSelectColumns($criteria);
				$this->collEjercicios = EjercicioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

				EjercicioPeer::addSelectColumns($criteria);
				if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
					$this->collEjercicios = EjercicioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEjercicioCriteria = $criteria;
		return $this->collEjercicios;
	}

	
	public function countEjercicios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

		return EjercicioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio(Ejercicio $l)
	{
		$this->collEjercicios[] = $l;
		$l->setMateria($this);
	}


	
	public function getEjerciciosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicios === null) {
			if ($this->isNew()) {
				$this->collEjercicios = array();
			} else {

				$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastEjercicioCriteria = $criteria;

		return $this->collEjercicios;
	}


	
	public function getEjerciciosJoinEjercicio_resuelto($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicios === null) {
			if ($this->isNew()) {
				$this->collEjercicios = array();
			} else {

				$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_MATERIA, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastEjercicioCriteria = $criteria;

		return $this->collEjercicios;
	}

	
	public function initSco2004s()
	{
		if ($this->collSco2004s === null) {
			$this->collSco2004s = array();
		}
	}

	
	public function getSco2004s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSco2004s === null) {
			if ($this->isNew()) {
			   $this->collSco2004s = array();
			} else {

				$criteria->add(Sco2004Peer::ID_MATERIA, $this->getId());

				Sco2004Peer::addSelectColumns($criteria);
				$this->collSco2004s = Sco2004Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Sco2004Peer::ID_MATERIA, $this->getId());

				Sco2004Peer::addSelectColumns($criteria);
				if (!isset($this->lastSco2004Criteria) || !$this->lastSco2004Criteria->equals($criteria)) {
					$this->collSco2004s = Sco2004Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSco2004Criteria = $criteria;
		return $this->collSco2004s;
	}

	
	public function countSco2004s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Sco2004Peer::ID_MATERIA, $this->getId());

		return Sco2004Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addSco2004(Sco2004 $l)
	{
		$this->collSco2004s[] = $l;
		$l->setMateria($this);
	}

	
	public function initSco12s()
	{
		if ($this->collSco12s === null) {
			$this->collSco12s = array();
		}
	}

	
	public function getSco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSco12s === null) {
			if ($this->isNew()) {
			   $this->collSco12s = array();
			} else {

				$criteria->add(Sco12Peer::ID_MATERIA, $this->getId());

				Sco12Peer::addSelectColumns($criteria);
				$this->collSco12s = Sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Sco12Peer::ID_MATERIA, $this->getId());

				Sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastSco12Criteria) || !$this->lastSco12Criteria->equals($criteria)) {
					$this->collSco12s = Sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSco12Criteria = $criteria;
		return $this->collSco12s;
	}

	
	public function countSco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Sco12Peer::ID_MATERIA, $this->getId());

		return Sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addSco12(Sco12 $l)
	{
		$this->collSco12s[] = $l;
		$l->setMateria($this);
	}

} 