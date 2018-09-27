<?php


abstract class BaseEvento extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_curso;


	
	protected $privado = 0;


	
	protected $fecha_inicio;


	
	protected $fecha_fin;


	
	protected $id_tipo_evento;


	
	protected $id_tipo_cita;


	
	protected $recurrente;


	
	protected $titulo;


	
	protected $descripcion;


	
	protected $created_at;

	
	protected $aCurso;

	
	protected $aTipo_evento;

	
	protected $aTipo_cita;

	
	protected $collRel_usuario_eventos;

	
	protected $lastRel_usuario_eventoCriteria = null;

	
	protected $collTareas;

	
	protected $lastTareaCriteria = null;

	
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

	
	public function getPrivado()
	{

		return $this->privado;
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

	
	public function getIdTipoEvento()
	{

		return $this->id_tipo_evento;
	}

	
	public function getIdTipoCita()
	{

		return $this->id_tipo_cita;
	}

	
	public function getRecurrente()
	{

		return $this->recurrente;
	}

	
	public function getTitulo()
	{

		return $this->titulo;
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
			$this->modifiedColumns[] = EventoPeer::ID;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = EventoPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setPrivado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->privado !== $v || $v === 0) {
			$this->privado = $v;
			$this->modifiedColumns[] = EventoPeer::PRIVADO;
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
			$this->modifiedColumns[] = EventoPeer::FECHA_INICIO;
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
			$this->modifiedColumns[] = EventoPeer::FECHA_FIN;
		}

	} 
	
	public function setIdTipoEvento($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tipo_evento !== $v) {
			$this->id_tipo_evento = $v;
			$this->modifiedColumns[] = EventoPeer::ID_TIPO_EVENTO;
		}

		if ($this->aTipo_evento !== null && $this->aTipo_evento->getId() !== $v) {
			$this->aTipo_evento = null;
		}

	} 
	
	public function setIdTipoCita($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tipo_cita !== $v) {
			$this->id_tipo_cita = $v;
			$this->modifiedColumns[] = EventoPeer::ID_TIPO_CITA;
		}

		if ($this->aTipo_cita !== null && $this->aTipo_cita->getId() !== $v) {
			$this->aTipo_cita = null;
		}

	} 
	
	public function setRecurrente($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->recurrente !== $v) {
			$this->recurrente = $v;
			$this->modifiedColumns[] = EventoPeer::RECURRENTE;
		}

	} 
	
	public function setTitulo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->titulo !== $v) {
			$this->titulo = $v;
			$this->modifiedColumns[] = EventoPeer::TITULO;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = EventoPeer::DESCRIPCION;
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
			$this->modifiedColumns[] = EventoPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

			$this->privado = $rs->getInt($startcol + 2);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 3, null);

			$this->fecha_fin = $rs->getTimestamp($startcol + 4, null);

			$this->id_tipo_evento = $rs->getString($startcol + 5);

			$this->id_tipo_cita = $rs->getString($startcol + 6);

			$this->recurrente = $rs->getString($startcol + 7);

			$this->titulo = $rs->getString($startcol + 8);

			$this->descripcion = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Evento object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventoPeer::DATABASE_NAME);
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

			if ($this->aTipo_evento !== null) {
				if ($this->aTipo_evento->isModified()) {
					$affectedRows += $this->aTipo_evento->save($con);
				}
				$this->setTipo_evento($this->aTipo_evento);
			}

			if ($this->aTipo_cita !== null) {
				if ($this->aTipo_cita->isModified()) {
					$affectedRows += $this->aTipo_cita->save($con);
				}
				$this->setTipo_cita($this->aTipo_cita);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRel_usuario_eventos !== null) {
				foreach($this->collRel_usuario_eventos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTareas !== null) {
				foreach($this->collTareas as $referrerFK) {
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


												
			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}

			if ($this->aTipo_evento !== null) {
				if (!$this->aTipo_evento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipo_evento->getValidationFailures());
				}
			}

			if ($this->aTipo_cita !== null) {
				if (!$this->aTipo_cita->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipo_cita->getValidationFailures());
				}
			}


			if (($retval = EventoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRel_usuario_eventos !== null) {
					foreach($this->collRel_usuario_eventos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTareas !== null) {
					foreach($this->collTareas as $referrerFK) {
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
		$pos = EventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPrivado();
				break;
			case 3:
				return $this->getFechaInicio();
				break;
			case 4:
				return $this->getFechaFin();
				break;
			case 5:
				return $this->getIdTipoEvento();
				break;
			case 6:
				return $this->getIdTipoCita();
				break;
			case 7:
				return $this->getRecurrente();
				break;
			case 8:
				return $this->getTitulo();
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
		$keys = EventoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCurso(),
			$keys[2] => $this->getPrivado(),
			$keys[3] => $this->getFechaInicio(),
			$keys[4] => $this->getFechaFin(),
			$keys[5] => $this->getIdTipoEvento(),
			$keys[6] => $this->getIdTipoCita(),
			$keys[7] => $this->getRecurrente(),
			$keys[8] => $this->getTitulo(),
			$keys[9] => $this->getDescripcion(),
			$keys[10] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPrivado($value);
				break;
			case 3:
				$this->setFechaInicio($value);
				break;
			case 4:
				$this->setFechaFin($value);
				break;
			case 5:
				$this->setIdTipoEvento($value);
				break;
			case 6:
				$this->setIdTipoCita($value);
				break;
			case 7:
				$this->setRecurrente($value);
				break;
			case 8:
				$this->setTitulo($value);
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
		$keys = EventoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPrivado($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFechaInicio($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFechaFin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIdTipoEvento($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIdTipoCita($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRecurrente($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTitulo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDescripcion($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventoPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventoPeer::ID)) $criteria->add(EventoPeer::ID, $this->id);
		if ($this->isColumnModified(EventoPeer::ID_CURSO)) $criteria->add(EventoPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(EventoPeer::PRIVADO)) $criteria->add(EventoPeer::PRIVADO, $this->privado);
		if ($this->isColumnModified(EventoPeer::FECHA_INICIO)) $criteria->add(EventoPeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(EventoPeer::FECHA_FIN)) $criteria->add(EventoPeer::FECHA_FIN, $this->fecha_fin);
		if ($this->isColumnModified(EventoPeer::ID_TIPO_EVENTO)) $criteria->add(EventoPeer::ID_TIPO_EVENTO, $this->id_tipo_evento);
		if ($this->isColumnModified(EventoPeer::ID_TIPO_CITA)) $criteria->add(EventoPeer::ID_TIPO_CITA, $this->id_tipo_cita);
		if ($this->isColumnModified(EventoPeer::RECURRENTE)) $criteria->add(EventoPeer::RECURRENTE, $this->recurrente);
		if ($this->isColumnModified(EventoPeer::TITULO)) $criteria->add(EventoPeer::TITULO, $this->titulo);
		if ($this->isColumnModified(EventoPeer::DESCRIPCION)) $criteria->add(EventoPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(EventoPeer::CREATED_AT)) $criteria->add(EventoPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventoPeer::DATABASE_NAME);

		$criteria->add(EventoPeer::ID, $this->id);

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

		$copyObj->setPrivado($this->privado);

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaFin($this->fecha_fin);

		$copyObj->setIdTipoEvento($this->id_tipo_evento);

		$copyObj->setIdTipoCita($this->id_tipo_cita);

		$copyObj->setRecurrente($this->recurrente);

		$copyObj->setTitulo($this->titulo);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRel_usuario_eventos() as $relObj) {
				$copyObj->addRel_usuario_evento($relObj->copy($deepCopy));
			}

			foreach($this->getTareas() as $relObj) {
				$copyObj->addTarea($relObj->copy($deepCopy));
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
			self::$peer = new EventoPeer();
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

	
	public function setTipo_evento($v)
	{


		if ($v === null) {
			$this->setIdTipoEvento(NULL);
		} else {
			$this->setIdTipoEvento($v->getId());
		}


		$this->aTipo_evento = $v;
	}


	
	public function getTipo_evento($con = null)
	{
		if ($this->aTipo_evento === null && (($this->id_tipo_evento !== "" && $this->id_tipo_evento !== null))) {
						include_once 'lib/model/om/BaseTipo_eventoPeer.php';

			$this->aTipo_evento = Tipo_eventoPeer::retrieveByPK($this->id_tipo_evento, $con);

			
		}
		return $this->aTipo_evento;
	}

	
	public function setTipo_cita($v)
	{


		if ($v === null) {
			$this->setIdTipoCita(NULL);
		} else {
			$this->setIdTipoCita($v->getId());
		}


		$this->aTipo_cita = $v;
	}


	
	public function getTipo_cita($con = null)
	{
		if ($this->aTipo_cita === null && (($this->id_tipo_cita !== "" && $this->id_tipo_cita !== null))) {
						include_once 'lib/model/om/BaseTipo_citaPeer.php';

			$this->aTipo_cita = Tipo_citaPeer::retrieveByPK($this->id_tipo_cita, $con);

			
		}
		return $this->aTipo_cita;
	}

	
	public function initRel_usuario_eventos()
	{
		if ($this->collRel_usuario_eventos === null) {
			$this->collRel_usuario_eventos = array();
		}
	}

	
	public function getRel_usuario_eventos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_eventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_eventos === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_eventos = array();
			} else {

				$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());

				Rel_usuario_eventoPeer::addSelectColumns($criteria);
				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());

				Rel_usuario_eventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_eventoCriteria) || !$this->lastRel_usuario_eventoCriteria->equals($criteria)) {
					$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_eventoCriteria = $criteria;
		return $this->collRel_usuario_eventos;
	}

	
	public function countRel_usuario_eventos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_eventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());

		return Rel_usuario_eventoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_evento(Rel_usuario_evento $l)
	{
		$this->collRel_usuario_eventos[] = $l;
		$l->setEvento($this);
	}


	
	public function getRel_usuario_eventosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_eventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_eventos === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_eventos = array();
			} else {

				$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());

				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());

			if (!isset($this->lastRel_usuario_eventoCriteria) || !$this->lastRel_usuario_eventoCriteria->equals($criteria)) {
				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_eventoCriteria = $criteria;

		return $this->collRel_usuario_eventos;
	}

	
	public function initTareas()
	{
		if ($this->collTareas === null) {
			$this->collTareas = array();
		}
	}

	
	public function getTareas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTareas === null) {
			if ($this->isNew()) {
			   $this->collTareas = array();
			} else {

				$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

				TareaPeer::addSelectColumns($criteria);
				$this->collTareas = TareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

				TareaPeer::addSelectColumns($criteria);
				if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
					$this->collTareas = TareaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTareaCriteria = $criteria;
		return $this->collTareas;
	}

	
	public function countTareas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

		return TareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTarea(Tarea $l)
	{
		$this->collTareas[] = $l;
		$l->setEvento($this);
	}


	
	public function getTareasJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTareas === null) {
			if ($this->isNew()) {
				$this->collTareas = array();
			} else {

				$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
	}


	
	public function getTareasJoinEjercicio($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTareas === null) {
			if ($this->isNew()) {
				$this->collTareas = array();
			} else {

				$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinEjercicio($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
	}


	
	public function getTareasJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTareas === null) {
			if ($this->isNew()) {
				$this->collTareas = array();
			} else {

				$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EVENTO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
	}

} 