<?php


abstract class BaseHistorico_cursos_usuarios_activos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_historico_usuarios_activos;


	
	protected $id_curso;


	
	protected $nombre;


	
	protected $fecha_inicio;


	
	protected $fecha_fin;


	
	protected $duracion;


	
	protected $precio;

	
	protected $aHistorico_usuarios_activos;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdHistoricoUsuariosActivos()
	{

		return $this->id_historico_usuarios_activos;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
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

	
	public function getDuracion()
	{

		return $this->duracion;
	}

	
	public function getPrecio()
	{

		return $this->precio;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::ID;
		}

	} 
	
	public function setIdHistoricoUsuariosActivos($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_historico_usuarios_activos !== $v) {
			$this->id_historico_usuarios_activos = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS;
		}

		if ($this->aHistorico_usuarios_activos !== null && $this->aHistorico_usuarios_activos->getId() !== $v) {
			$this->aHistorico_usuarios_activos = null;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::ID_CURSO;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::NOMBRE;
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
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::FECHA_INICIO;
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
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::FECHA_FIN;
		}

	} 
	
	public function setDuracion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->duracion !== $v) {
			$this->duracion = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::DURACION;
		}

	} 
	
	public function setPrecio($v)
	{

		if ($this->precio !== $v) {
			$this->precio = $v;
			$this->modifiedColumns[] = Historico_cursos_usuarios_activosPeer::PRECIO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_historico_usuarios_activos = $rs->getString($startcol + 1);

			$this->id_curso = $rs->getString($startcol + 2);

			$this->nombre = $rs->getString($startcol + 3);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 4, null);

			$this->fecha_fin = $rs->getTimestamp($startcol + 5, null);

			$this->duracion = $rs->getString($startcol + 6);

			$this->precio = $rs->getFloat($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Historico_cursos_usuarios_activos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Historico_cursos_usuarios_activosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);
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


												
			if ($this->aHistorico_usuarios_activos !== null) {
				if ($this->aHistorico_usuarios_activos->isModified()) {
					$affectedRows += $this->aHistorico_usuarios_activos->save($con);
				}
				$this->setHistorico_usuarios_activos($this->aHistorico_usuarios_activos);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Historico_cursos_usuarios_activosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Historico_cursos_usuarios_activosPeer::doUpdate($this, $con);
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


												
			if ($this->aHistorico_usuarios_activos !== null) {
				if (!$this->aHistorico_usuarios_activos->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHistorico_usuarios_activos->getValidationFailures());
				}
			}


			if (($retval = Historico_cursos_usuarios_activosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Historico_cursos_usuarios_activosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdHistoricoUsuariosActivos();
				break;
			case 2:
				return $this->getIdCurso();
				break;
			case 3:
				return $this->getNombre();
				break;
			case 4:
				return $this->getFechaInicio();
				break;
			case 5:
				return $this->getFechaFin();
				break;
			case 6:
				return $this->getDuracion();
				break;
			case 7:
				return $this->getPrecio();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Historico_cursos_usuarios_activosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdHistoricoUsuariosActivos(),
			$keys[2] => $this->getIdCurso(),
			$keys[3] => $this->getNombre(),
			$keys[4] => $this->getFechaInicio(),
			$keys[5] => $this->getFechaFin(),
			$keys[6] => $this->getDuracion(),
			$keys[7] => $this->getPrecio(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Historico_cursos_usuarios_activosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdHistoricoUsuariosActivos($value);
				break;
			case 2:
				$this->setIdCurso($value);
				break;
			case 3:
				$this->setNombre($value);
				break;
			case 4:
				$this->setFechaInicio($value);
				break;
			case 5:
				$this->setFechaFin($value);
				break;
			case 6:
				$this->setDuracion($value);
				break;
			case 7:
				$this->setPrecio($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Historico_cursos_usuarios_activosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdHistoricoUsuariosActivos($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdCurso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombre($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFechaInicio($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFechaFin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDuracion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPrecio($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);

		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::ID)) $criteria->add(Historico_cursos_usuarios_activosPeer::ID, $this->id);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS)) $criteria->add(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, $this->id_historico_usuarios_activos);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::ID_CURSO)) $criteria->add(Historico_cursos_usuarios_activosPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::NOMBRE)) $criteria->add(Historico_cursos_usuarios_activosPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::FECHA_INICIO)) $criteria->add(Historico_cursos_usuarios_activosPeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::FECHA_FIN)) $criteria->add(Historico_cursos_usuarios_activosPeer::FECHA_FIN, $this->fecha_fin);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::DURACION)) $criteria->add(Historico_cursos_usuarios_activosPeer::DURACION, $this->duracion);
		if ($this->isColumnModified(Historico_cursos_usuarios_activosPeer::PRECIO)) $criteria->add(Historico_cursos_usuarios_activosPeer::PRECIO, $this->precio);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Historico_cursos_usuarios_activosPeer::DATABASE_NAME);

		$criteria->add(Historico_cursos_usuarios_activosPeer::ID, $this->id);

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

		$copyObj->setIdHistoricoUsuariosActivos($this->id_historico_usuarios_activos);

		$copyObj->setIdCurso($this->id_curso);

		$copyObj->setNombre($this->nombre);

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaFin($this->fecha_fin);

		$copyObj->setDuracion($this->duracion);

		$copyObj->setPrecio($this->precio);


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
			self::$peer = new Historico_cursos_usuarios_activosPeer();
		}
		return self::$peer;
	}

	
	public function setHistorico_usuarios_activos($v)
	{


		if ($v === null) {
			$this->setIdHistoricoUsuariosActivos(NULL);
		} else {
			$this->setIdHistoricoUsuariosActivos($v->getId());
		}


		$this->aHistorico_usuarios_activos = $v;
	}


	
	public function getHistorico_usuarios_activos($con = null)
	{
		if ($this->aHistorico_usuarios_activos === null && (($this->id_historico_usuarios_activos !== "" && $this->id_historico_usuarios_activos !== null))) {
						include_once 'lib/model/om/BaseHistorico_usuarios_activosPeer.php';

			$this->aHistorico_usuarios_activos = Historico_usuarios_activosPeer::retrieveByPK($this->id_historico_usuarios_activos, $con);

			
		}
		return $this->aHistorico_usuarios_activos;
	}

} 