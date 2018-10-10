<?php


abstract class BasePaquete extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $fecha_inicio;


	
	protected $fecha_fin;


	
	protected $webcam;


	
	protected $scan;


	
	protected $duracion;


	
	protected $precio;


	
	protected $mensual = false;


	
	protected $descripcion;


	
	protected $created_at;

	
	protected $collRel_paquete_cursos;

	
	protected $lastRel_paquete_cursoCriteria = null;

	
	protected $collRel_usuario_paquetes;

	
	protected $lastRel_usuario_paqueteCriteria = null;

	
	protected $collEvaluacion_paquetes;

	
	protected $lastEvaluacion_paqueteCriteria = null;

	
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

	
	public function getFechaInicio($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_inicio === null || $this->fecha_inicio === '') {
			return null;
		} elseif (!is_int($this->fecha_inicio)) {
						$ts = strtotime($this->fecha_inicio);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_inicio] as date/time value: " . var_export($this->fecha_inicio, true));
			}
		} else {
			$ts = $this->fecha_inicio;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFechaFin($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_fin === null || $this->fecha_fin === '') {
			return null;
		} elseif (!is_int($this->fecha_fin)) {
						$ts = strtotime($this->fecha_fin);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_fin] as date/time value: " . var_export($this->fecha_fin, true));
			}
		} else {
			$ts = $this->fecha_fin;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getWebcam()
	{

		return $this->webcam;
	}

	
	public function getScan()
	{

		return $this->scan;
	}

	
	public function getDuracion()
	{

		return $this->duracion;
	}

	
	public function getPrecio()
	{

		return $this->precio;
	}

	
	public function getMensual()
	{

		return $this->mensual;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
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
			$this->modifiedColumns[] = PaquetePeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = PaquetePeer::NOMBRE;
		}

	} 
	
	public function setFechaInicio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_inicio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_inicio !== $ts) {
			$this->fecha_inicio = $ts;
			$this->modifiedColumns[] = PaquetePeer::FECHA_INICIO;
		}

	} 
	
	public function setFechaFin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_fin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_fin !== $ts) {
			$this->fecha_fin = $ts;
			$this->modifiedColumns[] = PaquetePeer::FECHA_FIN;
		}

	} 
	
	public function setWebcam($v)
	{

		if ($this->webcam !== $v) {
			$this->webcam = $v;
			$this->modifiedColumns[] = PaquetePeer::WEBCAM;
		}

	} 
	
	public function setScan($v)
	{

		if ($this->scan !== $v) {
			$this->scan = $v;
			$this->modifiedColumns[] = PaquetePeer::SCAN;
		}

	} 
	
	public function setDuracion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->duracion !== $v) {
			$this->duracion = $v;
			$this->modifiedColumns[] = PaquetePeer::DURACION;
		}

	} 
	
	public function setPrecio($v)
	{

		if ($this->precio !== $v) {
			$this->precio = $v;
			$this->modifiedColumns[] = PaquetePeer::PRECIO;
		}

	} 
	
	public function setMensual($v)
	{

		if ($this->mensual !== $v || $v === false) {
			$this->mensual = $v;
			$this->modifiedColumns[] = PaquetePeer::MENSUAL;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = PaquetePeer::DESCRIPCION;
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
			$this->modifiedColumns[] = PaquetePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 2, null);

			$this->fecha_fin = $rs->getTimestamp($startcol + 3, null);

			$this->webcam = $rs->getBoolean($startcol + 4);

			$this->scan = $rs->getBoolean($startcol + 5);

			$this->duracion = $rs->getString($startcol + 6);

			$this->precio = $rs->getFloat($startcol + 7);

			$this->mensual = $rs->getBoolean($startcol + 8);

			$this->descripcion = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Paquete object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaquetePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PaquetePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PaquetePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaquetePeer::DATABASE_NAME);
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
					$pk = PaquetePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PaquetePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_paquete_cursos !== null) {
				foreach($this->collRel_paquete_cursos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_paquetes !== null) {
				foreach($this->collRel_usuario_paquetes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEvaluacion_paquetes !== null) {
				foreach($this->collEvaluacion_paquetes as $referrerFK) {
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


			if (($retval = PaquetePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_paquete_cursos !== null) {
					foreach($this->collRel_paquete_cursos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_paquetes !== null) {
					foreach($this->collRel_usuario_paquetes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEvaluacion_paquetes !== null) {
					foreach($this->collEvaluacion_paquetes as $referrerFK) {
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
		$pos = PaquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFechaInicio();
				break;
			case 3:
				return $this->getFechaFin();
				break;
			case 4:
				return $this->getWebcam();
				break;
			case 5:
				return $this->getScan();
				break;
			case 6:
				return $this->getDuracion();
				break;
			case 7:
				return $this->getPrecio();
				break;
			case 8:
				return $this->getMensual();
				break;
			case 9:
				return $this->getDescripcion();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaquetePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getFechaInicio(),
			$keys[3] => $this->getFechaFin(),
			$keys[4] => $this->getWebcam(),
			$keys[5] => $this->getScan(),
			$keys[6] => $this->getDuracion(),
			$keys[7] => $this->getPrecio(),
			$keys[8] => $this->getMensual(),
			$keys[9] => $this->getDescripcion(),
			$keys[10] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaquetePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFechaInicio($value);
				break;
			case 3:
				$this->setFechaFin($value);
				break;
			case 4:
				$this->setWebcam($value);
				break;
			case 5:
				$this->setScan($value);
				break;
			case 6:
				$this->setDuracion($value);
				break;
			case 7:
				$this->setPrecio($value);
				break;
			case 8:
				$this->setMensual($value);
				break;
			case 9:
				$this->setDescripcion($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaquetePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFechaInicio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFechaFin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWebcam($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScan($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDuracion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPrecio($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMensual($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDescripcion($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PaquetePeer::DATABASE_NAME);

		if ($this->isColumnModified(PaquetePeer::ID)) $criteria->add(PaquetePeer::ID, $this->id);
		if ($this->isColumnModified(PaquetePeer::NOMBRE)) $criteria->add(PaquetePeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(PaquetePeer::FECHA_INICIO)) $criteria->add(PaquetePeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(PaquetePeer::FECHA_FIN)) $criteria->add(PaquetePeer::FECHA_FIN, $this->fecha_fin);
		if ($this->isColumnModified(PaquetePeer::WEBCAM)) $criteria->add(PaquetePeer::WEBCAM, $this->webcam);
		if ($this->isColumnModified(PaquetePeer::SCAN)) $criteria->add(PaquetePeer::SCAN, $this->scan);
		if ($this->isColumnModified(PaquetePeer::DURACION)) $criteria->add(PaquetePeer::DURACION, $this->duracion);
		if ($this->isColumnModified(PaquetePeer::PRECIO)) $criteria->add(PaquetePeer::PRECIO, $this->precio);
		if ($this->isColumnModified(PaquetePeer::MENSUAL)) $criteria->add(PaquetePeer::MENSUAL, $this->mensual);
		if ($this->isColumnModified(PaquetePeer::DESCRIPCION)) $criteria->add(PaquetePeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(PaquetePeer::CREATED_AT)) $criteria->add(PaquetePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PaquetePeer::DATABASE_NAME);

		$criteria->add(PaquetePeer::ID, $this->id);

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

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaFin($this->fecha_fin);

		$copyObj->setWebcam($this->webcam);

		$copyObj->setScan($this->scan);

		$copyObj->setDuracion($this->duracion);

		$copyObj->setPrecio($this->precio);

		$copyObj->setMensual($this->mensual);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_paquete_cursos() as $relObj) {
				$copyObj->addRel_paquete_curso($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_paquetes() as $relObj) {
				$copyObj->addRel_usuario_paquete($relObj->copy($deepCopy));
			}

			foreach($this->getEvaluacion_paquetes() as $relObj) {
				$copyObj->addEvaluacion_paquete($relObj->copy($deepCopy));
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
			self::$peer = new PaquetePeer();
		}
		return self::$peer;
	}

	
	public function initRel_paquete_cursos()
	{
		if ($this->collRel_paquete_cursos === null) {
			$this->collRel_paquete_cursos = array();
		}
	}

	
	public function getRel_paquete_cursos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_paquete_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_paquete_cursos === null) {
			if ($this->isNew()) {
			   $this->collRel_paquete_cursos = array();
			} else {

				$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->getId());

				Rel_paquete_cursoPeer::addSelectColumns($criteria);
				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->getId());

				Rel_paquete_cursoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_paquete_cursoCriteria) || !$this->lastRel_paquete_cursoCriteria->equals($criteria)) {
					$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_paquete_cursoCriteria = $criteria;
		return $this->collRel_paquete_cursos;
	}

	
	public function countRel_paquete_cursos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_paquete_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->getId());

		return Rel_paquete_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_paquete_curso(Rel_paquete_curso $l)
	{
		$this->collRel_paquete_cursos[] = $l;
		$l->setPaquete($this);
	}


	
	public function getRel_paquete_cursosJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_paquete_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_paquete_cursos === null) {
			if ($this->isNew()) {
				$this->collRel_paquete_cursos = array();
			} else {

				$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->getId());

				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->getId());

			if (!isset($this->lastRel_paquete_cursoCriteria) || !$this->lastRel_paquete_cursoCriteria->equals($criteria)) {
				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_paquete_cursoCriteria = $criteria;

		return $this->collRel_paquete_cursos;
	}

	
	public function initRel_usuario_paquetes()
	{
		if ($this->collRel_usuario_paquetes === null) {
			$this->collRel_usuario_paquetes = array();
		}
	}

	
	public function getRel_usuario_paquetes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_paquetes === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_paquetes = array();
			} else {

				$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->getId());

				Rel_usuario_paquetePeer::addSelectColumns($criteria);
				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->getId());

				Rel_usuario_paquetePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_paqueteCriteria) || !$this->lastRel_usuario_paqueteCriteria->equals($criteria)) {
					$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_paqueteCriteria = $criteria;
		return $this->collRel_usuario_paquetes;
	}

	
	public function countRel_usuario_paquetes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->getId());

		return Rel_usuario_paquetePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_paquete(Rel_usuario_paquete $l)
	{
		$this->collRel_usuario_paquetes[] = $l;
		$l->setPaquete($this);
	}


	
	public function getRel_usuario_paquetesJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_paquetes === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_paquetes = array();
			} else {

				$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->getId());

				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->getId());

			if (!isset($this->lastRel_usuario_paqueteCriteria) || !$this->lastRel_usuario_paqueteCriteria->equals($criteria)) {
				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_paqueteCriteria = $criteria;

		return $this->collRel_usuario_paquetes;
	}

	
	public function initEvaluacion_paquetes()
	{
		if ($this->collEvaluacion_paquetes === null) {
			$this->collEvaluacion_paquetes = array();
		}
	}

	
	public function getEvaluacion_paquetes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvaluacion_paquetes === null) {
			if ($this->isNew()) {
			   $this->collEvaluacion_paquetes = array();
			} else {

				$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->getId());

				Evaluacion_paquetePeer::addSelectColumns($criteria);
				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->getId());

				Evaluacion_paquetePeer::addSelectColumns($criteria);
				if (!isset($this->lastEvaluacion_paqueteCriteria) || !$this->lastEvaluacion_paqueteCriteria->equals($criteria)) {
					$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEvaluacion_paqueteCriteria = $criteria;
		return $this->collEvaluacion_paquetes;
	}

	
	public function countEvaluacion_paquetes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->getId());

		return Evaluacion_paquetePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvaluacion_paquete(Evaluacion_paquete $l)
	{
		$this->collEvaluacion_paquetes[] = $l;
		$l->setPaquete($this);
	}


	
	public function getEvaluacion_paquetesJoinTarea($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEvaluacion_paquetePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvaluacion_paquetes === null) {
			if ($this->isNew()) {
				$this->collEvaluacion_paquetes = array();
			} else {

				$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->getId());

				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelectJoinTarea($criteria, $con);
			}
		} else {
									
			$criteria->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->getId());

			if (!isset($this->lastEvaluacion_paqueteCriteria) || !$this->lastEvaluacion_paqueteCriteria->equals($criteria)) {
				$this->collEvaluacion_paquetes = Evaluacion_paquetePeer::doSelectJoinTarea($criteria, $con);
			}
		}
		$this->lastEvaluacion_paqueteCriteria = $criteria;

		return $this->collEvaluacion_paquetes;
	}

} 