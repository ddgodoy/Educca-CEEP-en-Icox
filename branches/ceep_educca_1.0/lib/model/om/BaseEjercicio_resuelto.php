<?php


abstract class BaseEjercicio_resuelto extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_autor;


	
	protected $id_ejercicio;


	
	protected $id_corrector;


	
	protected $fecha_correccion;


	
	protected $score = 0;


	
	protected $aciertos = 0;


	
	protected $fallos = 0;


	
	protected $blancos = 0;


	
	protected $tiempo = 0;


	
	protected $repositorio = 0;


	
	protected $id_curso;

	
	protected $aUsuarioRelatedByIdAutor;

	
	protected $aEjercicio;

	
	protected $aUsuarioRelatedByIdCorrector;

	
	protected $collEjercicios;

	
	protected $lastEjercicioCriteria = null;

	
	protected $collRespuesta_cuestion_cortas;

	
	protected $lastRespuesta_cuestion_cortaCriteria = null;

	
	protected $collRespuesta_cuestion_practicas;

	
	protected $lastRespuesta_cuestion_practicaCriteria = null;

	
	protected $collSeleccion_cuestion_tests;

	
	protected $lastSeleccion_cuestion_testCriteria = null;

	
	protected $collRel_usuario_tareas;

	
	protected $lastRel_usuario_tareaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdAutor()
	{

		return $this->id_autor;
	}

	
	public function getIdEjercicio()
	{

		return $this->id_ejercicio;
	}

	
	public function getIdCorrector()
	{

		return $this->id_corrector;
	}

	
	public function getFechaCorreccion($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_correccion === null || $this->fecha_correccion === '') {
			return null;
		} elseif (!is_int($this->fecha_correccion)) {
						$ts = strtotime($this->fecha_correccion);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_correccion] as date/time value: " . var_export($this->fecha_correccion, true));
			}
		} else {
			$ts = $this->fecha_correccion;
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

	
	public function getAciertos()
	{

		return $this->aciertos;
	}

	
	public function getFallos()
	{

		return $this->fallos;
	}

	
	public function getBlancos()
	{

		return $this->blancos;
	}

	
	public function getTiempo()
	{

		return $this->tiempo;
	}

	
	public function getRepositorio()
	{

		return $this->repositorio;
	}

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ID;
		}

	} 
	
	public function setIdAutor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_autor !== $v) {
			$this->id_autor = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ID_AUTOR;
		}

		if ($this->aUsuarioRelatedByIdAutor !== null && $this->aUsuarioRelatedByIdAutor->getId() !== $v) {
			$this->aUsuarioRelatedByIdAutor = null;
		}

	} 
	
	public function setIdEjercicio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio !== $v) {
			$this->id_ejercicio = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ID_EJERCICIO;
		}

		if ($this->aEjercicio !== null && $this->aEjercicio->getId() !== $v) {
			$this->aEjercicio = null;
		}

	} 
	
	public function setIdCorrector($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_corrector !== $v) {
			$this->id_corrector = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ID_CORRECTOR;
		}

		if ($this->aUsuarioRelatedByIdCorrector !== null && $this->aUsuarioRelatedByIdCorrector->getId() !== $v) {
			$this->aUsuarioRelatedByIdCorrector = null;
		}

	} 
	
	public function setFechaCorreccion($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_correccion] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_correccion !== $ts) {
			$this->fecha_correccion = $ts;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::FECHA_CORRECCION;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v || $v === 0) {
			$this->score = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::SCORE;
		}

	} 
	
	public function setAciertos($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->aciertos !== $v || $v === 0) {
			$this->aciertos = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ACIERTOS;
		}

	} 
	
	public function setFallos($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fallos !== $v || $v === 0) {
			$this->fallos = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::FALLOS;
		}

	} 
	
	public function setBlancos($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->blancos !== $v || $v === 0) {
			$this->blancos = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::BLANCOS;
		}

	} 
	
	public function setTiempo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tiempo !== $v || $v === 0) {
			$this->tiempo = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::TIEMPO;
		}

	} 
	
	public function setRepositorio($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->repositorio !== $v || $v === 0) {
			$this->repositorio = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::REPOSITORIO;
		}

	} 
	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Ejercicio_resueltoPeer::ID_CURSO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_autor = $rs->getString($startcol + 1);

			$this->id_ejercicio = $rs->getString($startcol + 2);

			$this->id_corrector = $rs->getString($startcol + 3);

			$this->fecha_correccion = $rs->getTimestamp($startcol + 4, null);

			$this->score = $rs->getFloat($startcol + 5);

			$this->aciertos = $rs->getInt($startcol + 6);

			$this->fallos = $rs->getInt($startcol + 7);

			$this->blancos = $rs->getInt($startcol + 8);

			$this->tiempo = $rs->getInt($startcol + 9);

			$this->repositorio = $rs->getInt($startcol + 10);

			$this->id_curso = $rs->getString($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ejercicio_resuelto object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Ejercicio_resueltoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Ejercicio_resueltoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Ejercicio_resueltoPeer::DATABASE_NAME);
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


												
			if ($this->aUsuarioRelatedByIdAutor !== null) {
				if ($this->aUsuarioRelatedByIdAutor->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdAutor->save($con);
				}
				$this->setUsuarioRelatedByIdAutor($this->aUsuarioRelatedByIdAutor);
			}

			if ($this->aEjercicio !== null) {
				if ($this->aEjercicio->isModified()) {
					$affectedRows += $this->aEjercicio->save($con);
				}
				$this->setEjercicio($this->aEjercicio);
			}

			if ($this->aUsuarioRelatedByIdCorrector !== null) {
				if ($this->aUsuarioRelatedByIdCorrector->isModified()) {
					$affectedRows += $this->aUsuarioRelatedByIdCorrector->save($con);
				}
				$this->setUsuarioRelatedByIdCorrector($this->aUsuarioRelatedByIdCorrector);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Ejercicio_resueltoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Ejercicio_resueltoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEjercicios !== null) {
				foreach($this->collEjercicios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRespuesta_cuestion_cortas !== null) {
				foreach($this->collRespuesta_cuestion_cortas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRespuesta_cuestion_practicas !== null) {
				foreach($this->collRespuesta_cuestion_practicas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSeleccion_cuestion_tests !== null) {
				foreach($this->collSeleccion_cuestion_tests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_tareas !== null) {
				foreach($this->collRel_usuario_tareas as $referrerFK) {
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


												
			if ($this->aUsuarioRelatedByIdAutor !== null) {
				if (!$this->aUsuarioRelatedByIdAutor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdAutor->getValidationFailures());
				}
			}

			if ($this->aEjercicio !== null) {
				if (!$this->aEjercicio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio->getValidationFailures());
				}
			}

			if ($this->aUsuarioRelatedByIdCorrector !== null) {
				if (!$this->aUsuarioRelatedByIdCorrector->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuarioRelatedByIdCorrector->getValidationFailures());
				}
			}


			if (($retval = Ejercicio_resueltoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEjercicios !== null) {
					foreach($this->collEjercicios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRespuesta_cuestion_cortas !== null) {
					foreach($this->collRespuesta_cuestion_cortas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRespuesta_cuestion_practicas !== null) {
					foreach($this->collRespuesta_cuestion_practicas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSeleccion_cuestion_tests !== null) {
					foreach($this->collSeleccion_cuestion_tests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_tareas !== null) {
					foreach($this->collRel_usuario_tareas as $referrerFK) {
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
		$pos = Ejercicio_resueltoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdAutor();
				break;
			case 2:
				return $this->getIdEjercicio();
				break;
			case 3:
				return $this->getIdCorrector();
				break;
			case 4:
				return $this->getFechaCorreccion();
				break;
			case 5:
				return $this->getScore();
				break;
			case 6:
				return $this->getAciertos();
				break;
			case 7:
				return $this->getFallos();
				break;
			case 8:
				return $this->getBlancos();
				break;
			case 9:
				return $this->getTiempo();
				break;
			case 10:
				return $this->getRepositorio();
				break;
			case 11:
				return $this->getIdCurso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Ejercicio_resueltoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAutor(),
			$keys[2] => $this->getIdEjercicio(),
			$keys[3] => $this->getIdCorrector(),
			$keys[4] => $this->getFechaCorreccion(),
			$keys[5] => $this->getScore(),
			$keys[6] => $this->getAciertos(),
			$keys[7] => $this->getFallos(),
			$keys[8] => $this->getBlancos(),
			$keys[9] => $this->getTiempo(),
			$keys[10] => $this->getRepositorio(),
			$keys[11] => $this->getIdCurso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Ejercicio_resueltoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdAutor($value);
				break;
			case 2:
				$this->setIdEjercicio($value);
				break;
			case 3:
				$this->setIdCorrector($value);
				break;
			case 4:
				$this->setFechaCorreccion($value);
				break;
			case 5:
				$this->setScore($value);
				break;
			case 6:
				$this->setAciertos($value);
				break;
			case 7:
				$this->setFallos($value);
				break;
			case 8:
				$this->setBlancos($value);
				break;
			case 9:
				$this->setTiempo($value);
				break;
			case 10:
				$this->setRepositorio($value);
				break;
			case 11:
				$this->setIdCurso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Ejercicio_resueltoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAutor($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdEjercicio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdCorrector($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFechaCorreccion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScore($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAciertos($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFallos($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBlancos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTiempo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRepositorio($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIdCurso($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Ejercicio_resueltoPeer::DATABASE_NAME);

		if ($this->isColumnModified(Ejercicio_resueltoPeer::ID)) $criteria->add(Ejercicio_resueltoPeer::ID, $this->id);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::ID_AUTOR)) $criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id_autor);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::ID_EJERCICIO)) $criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->id_ejercicio);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::ID_CORRECTOR)) $criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->id_corrector);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::FECHA_CORRECCION)) $criteria->add(Ejercicio_resueltoPeer::FECHA_CORRECCION, $this->fecha_correccion);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::SCORE)) $criteria->add(Ejercicio_resueltoPeer::SCORE, $this->score);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::ACIERTOS)) $criteria->add(Ejercicio_resueltoPeer::ACIERTOS, $this->aciertos);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::FALLOS)) $criteria->add(Ejercicio_resueltoPeer::FALLOS, $this->fallos);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::BLANCOS)) $criteria->add(Ejercicio_resueltoPeer::BLANCOS, $this->blancos);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::TIEMPO)) $criteria->add(Ejercicio_resueltoPeer::TIEMPO, $this->tiempo);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::REPOSITORIO)) $criteria->add(Ejercicio_resueltoPeer::REPOSITORIO, $this->repositorio);
		if ($this->isColumnModified(Ejercicio_resueltoPeer::ID_CURSO)) $criteria->add(Ejercicio_resueltoPeer::ID_CURSO, $this->id_curso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Ejercicio_resueltoPeer::DATABASE_NAME);

		$criteria->add(Ejercicio_resueltoPeer::ID, $this->id);

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

		$copyObj->setIdAutor($this->id_autor);

		$copyObj->setIdEjercicio($this->id_ejercicio);

		$copyObj->setIdCorrector($this->id_corrector);

		$copyObj->setFechaCorreccion($this->fecha_correccion);

		$copyObj->setScore($this->score);

		$copyObj->setAciertos($this->aciertos);

		$copyObj->setFallos($this->fallos);

		$copyObj->setBlancos($this->blancos);

		$copyObj->setTiempo($this->tiempo);

		$copyObj->setRepositorio($this->repositorio);

		$copyObj->setIdCurso($this->id_curso);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEjercicios() as $relObj) {
				$copyObj->addEjercicio($relObj->copy($deepCopy));
			}

			foreach($this->getRespuesta_cuestion_cortas() as $relObj) {
				$copyObj->addRespuesta_cuestion_corta($relObj->copy($deepCopy));
			}

			foreach($this->getRespuesta_cuestion_practicas() as $relObj) {
				$copyObj->addRespuesta_cuestion_practica($relObj->copy($deepCopy));
			}

			foreach($this->getSeleccion_cuestion_tests() as $relObj) {
				$copyObj->addSeleccion_cuestion_test($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_tareas() as $relObj) {
				$copyObj->addRel_usuario_tarea($relObj->copy($deepCopy));
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
			self::$peer = new Ejercicio_resueltoPeer();
		}
		return self::$peer;
	}

	
	public function setUsuarioRelatedByIdAutor($v)
	{


		if ($v === null) {
			$this->setIdAutor(NULL);
		} else {
			$this->setIdAutor($v->getId());
		}


		$this->aUsuarioRelatedByIdAutor = $v;
	}


	
	public function getUsuarioRelatedByIdAutor($con = null)
	{
		if ($this->aUsuarioRelatedByIdAutor === null && (($this->id_autor !== "" && $this->id_autor !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdAutor = UsuarioPeer::retrieveByPK($this->id_autor, $con);

			
		}
		return $this->aUsuarioRelatedByIdAutor;
	}

	
	public function setEjercicio($v)
	{


		if ($v === null) {
			$this->setIdEjercicio(NULL);
		} else {
			$this->setIdEjercicio($v->getId());
		}


		$this->aEjercicio = $v;
	}


	
	public function getEjercicio($con = null)
	{
		if ($this->aEjercicio === null && (($this->id_ejercicio !== "" && $this->id_ejercicio !== null))) {
						include_once 'lib/model/om/BaseEjercicioPeer.php';

			$this->aEjercicio = EjercicioPeer::retrieveByPK($this->id_ejercicio, $con);

			
		}
		return $this->aEjercicio;
	}

	
	public function setUsuarioRelatedByIdCorrector($v)
	{


		if ($v === null) {
			$this->setIdCorrector(NULL);
		} else {
			$this->setIdCorrector($v->getId());
		}


		$this->aUsuarioRelatedByIdCorrector = $v;
	}


	
	public function getUsuarioRelatedByIdCorrector($con = null)
	{
		if ($this->aUsuarioRelatedByIdCorrector === null && (($this->id_corrector !== "" && $this->id_corrector !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuarioRelatedByIdCorrector = UsuarioPeer::retrieveByPK($this->id_corrector, $con);

			
		}
		return $this->aUsuarioRelatedByIdCorrector;
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

				$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

				EjercicioPeer::addSelectColumns($criteria);
				$this->collEjercicios = EjercicioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

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

		$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

		return EjercicioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio(Ejercicio $l)
	{
		$this->collEjercicios[] = $l;
		$l->setEjercicio_resuelto($this);
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

				$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastEjercicioCriteria = $criteria;

		return $this->collEjercicios;
	}


	
	public function getEjerciciosJoinMateria($criteria = null, $con = null)
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

				$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinMateria($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_SOLUCION, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinMateria($criteria, $con);
			}
		}
		$this->lastEjercicioCriteria = $criteria;

		return $this->collEjercicios;
	}

	
	public function initRespuesta_cuestion_cortas()
	{
		if ($this->collRespuesta_cuestion_cortas === null) {
			$this->collRespuesta_cuestion_cortas = array();
		}
	}

	
	public function getRespuesta_cuestion_cortas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_cortaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_cortas === null) {
			if ($this->isNew()) {
			   $this->collRespuesta_cuestion_cortas = array();
			} else {

				$criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Respuesta_cuestion_cortaPeer::addSelectColumns($criteria);
				$this->collRespuesta_cuestion_cortas = Respuesta_cuestion_cortaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Respuesta_cuestion_cortaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRespuesta_cuestion_cortaCriteria) || !$this->lastRespuesta_cuestion_cortaCriteria->equals($criteria)) {
					$this->collRespuesta_cuestion_cortas = Respuesta_cuestion_cortaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRespuesta_cuestion_cortaCriteria = $criteria;
		return $this->collRespuesta_cuestion_cortas;
	}

	
	public function countRespuesta_cuestion_cortas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_cortaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

		return Respuesta_cuestion_cortaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRespuesta_cuestion_corta(Respuesta_cuestion_corta $l)
	{
		$this->collRespuesta_cuestion_cortas[] = $l;
		$l->setEjercicio_resuelto($this);
	}


	
	public function getRespuesta_cuestion_cortasJoinCuestion_corta($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_cortaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_cortas === null) {
			if ($this->isNew()) {
				$this->collRespuesta_cuestion_cortas = array();
			} else {

				$criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				$this->collRespuesta_cuestion_cortas = Respuesta_cuestion_cortaPeer::doSelectJoinCuestion_corta($criteria, $con);
			}
		} else {
									
			$criteria->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

			if (!isset($this->lastRespuesta_cuestion_cortaCriteria) || !$this->lastRespuesta_cuestion_cortaCriteria->equals($criteria)) {
				$this->collRespuesta_cuestion_cortas = Respuesta_cuestion_cortaPeer::doSelectJoinCuestion_corta($criteria, $con);
			}
		}
		$this->lastRespuesta_cuestion_cortaCriteria = $criteria;

		return $this->collRespuesta_cuestion_cortas;
	}

	
	public function initRespuesta_cuestion_practicas()
	{
		if ($this->collRespuesta_cuestion_practicas === null) {
			$this->collRespuesta_cuestion_practicas = array();
		}
	}

	
	public function getRespuesta_cuestion_practicas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_practicas === null) {
			if ($this->isNew()) {
			   $this->collRespuesta_cuestion_practicas = array();
			} else {

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Respuesta_cuestion_practicaPeer::addSelectColumns($criteria);
				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Respuesta_cuestion_practicaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRespuesta_cuestion_practicaCriteria) || !$this->lastRespuesta_cuestion_practicaCriteria->equals($criteria)) {
					$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRespuesta_cuestion_practicaCriteria = $criteria;
		return $this->collRespuesta_cuestion_practicas;
	}

	
	public function countRespuesta_cuestion_practicas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

		return Respuesta_cuestion_practicaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRespuesta_cuestion_practica(Respuesta_cuestion_practica $l)
	{
		$this->collRespuesta_cuestion_practicas[] = $l;
		$l->setEjercicio_resuelto($this);
	}


	
	public function getRespuesta_cuestion_practicasJoinCuestion_practica($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRespuesta_cuestion_practicas === null) {
			if ($this->isNew()) {
				$this->collRespuesta_cuestion_practicas = array();
			} else {

				$criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelectJoinCuestion_practica($criteria, $con);
			}
		} else {
									
			$criteria->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

			if (!isset($this->lastRespuesta_cuestion_practicaCriteria) || !$this->lastRespuesta_cuestion_practicaCriteria->equals($criteria)) {
				$this->collRespuesta_cuestion_practicas = Respuesta_cuestion_practicaPeer::doSelectJoinCuestion_practica($criteria, $con);
			}
		}
		$this->lastRespuesta_cuestion_practicaCriteria = $criteria;

		return $this->collRespuesta_cuestion_practicas;
	}

	
	public function initSeleccion_cuestion_tests()
	{
		if ($this->collSeleccion_cuestion_tests === null) {
			$this->collSeleccion_cuestion_tests = array();
		}
	}

	
	public function getSeleccion_cuestion_tests($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSeleccion_cuestion_tests === null) {
			if ($this->isNew()) {
			   $this->collSeleccion_cuestion_tests = array();
			} else {

				$criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Seleccion_cuestion_testPeer::addSelectColumns($criteria);
				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Seleccion_cuestion_testPeer::addSelectColumns($criteria);
				if (!isset($this->lastSeleccion_cuestion_testCriteria) || !$this->lastSeleccion_cuestion_testCriteria->equals($criteria)) {
					$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSeleccion_cuestion_testCriteria = $criteria;
		return $this->collSeleccion_cuestion_tests;
	}

	
	public function countSeleccion_cuestion_tests($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->getId());

		return Seleccion_cuestion_testPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSeleccion_cuestion_test(Seleccion_cuestion_test $l)
	{
		$this->collSeleccion_cuestion_tests[] = $l;
		$l->setEjercicio_resuelto($this);
	}


	
	public function getSeleccion_cuestion_testsJoinRespuesta_cuestion_test($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSeleccion_cuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSeleccion_cuestion_tests === null) {
			if ($this->isNew()) {
				$this->collSeleccion_cuestion_tests = array();
			} else {

				$criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelectJoinRespuesta_cuestion_test($criteria, $con);
			}
		} else {
									
			$criteria->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $this->getId());

			if (!isset($this->lastSeleccion_cuestion_testCriteria) || !$this->lastSeleccion_cuestion_testCriteria->equals($criteria)) {
				$this->collSeleccion_cuestion_tests = Seleccion_cuestion_testPeer::doSelectJoinRespuesta_cuestion_test($criteria, $con);
			}
		}
		$this->lastSeleccion_cuestion_testCriteria = $criteria;

		return $this->collSeleccion_cuestion_tests;
	}

	
	public function initRel_usuario_tareas()
	{
		if ($this->collRel_usuario_tareas === null) {
			$this->collRel_usuario_tareas = array();
		}
	}

	
	public function getRel_usuario_tareas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Rel_usuario_tareaPeer::addSelectColumns($criteria);
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				Rel_usuario_tareaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
					$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;
		return $this->collRel_usuario_tareas;
	}

	
	public function countRel_usuario_tareas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

		return Rel_usuario_tareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_tarea(Rel_usuario_tarea $l)
	{
		$this->collRel_usuario_tareas[] = $l;
		$l->setEjercicio_resuelto($this);
	}


	
	public function getRel_usuario_tareasJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}


	
	public function getRel_usuario_tareasJoinTarea($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_tareaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_tareas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_tareas = array();
			} else {

				$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinTarea($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinTarea($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}

} 