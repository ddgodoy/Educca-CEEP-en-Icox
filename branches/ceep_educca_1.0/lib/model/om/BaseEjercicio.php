<?php


abstract class BaseEjercicio extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_autor;


	
	protected $id_materia;


	
	protected $nombre_autor;


	
	protected $tipo;


	
	protected $titulo;


	
	protected $test_multiple = 0;


	
	protected $test_resta = 0;


	
	protected $numero_respuestas;


	
	protected $publicado = 0;


	
	protected $solucion = 0;


	
	protected $expresiones_matematicas = 0;


	
	protected $numero_hojas;


	
	protected $id_solucion;

	
	protected $aUsuario;

	
	protected $aMateria;

	
	protected $aEjercicio_resuelto;

	
	protected $collPublicado_ejercicio_cursos;

	
	protected $lastPublicado_ejercicio_cursoCriteria = null;

	
	protected $collCuestion_cortas;

	
	protected $lastCuestion_cortaCriteria = null;

	
	protected $collCuestion_tests;

	
	protected $lastCuestion_testCriteria = null;

	
	protected $collCuestion_practicas;

	
	protected $lastCuestion_practicaCriteria = null;

	
	protected $collEjercicio_resueltos;

	
	protected $lastEjercicio_resueltoCriteria = null;

	
	protected $collTareas;

	
	protected $lastTareaCriteria = null;

	
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

	
	public function getIdMateria()
	{

		return $this->id_materia;
	}

	
	public function getNombreAutor()
	{

		return $this->nombre_autor;
	}

	
	public function getTipo()
	{

		return $this->tipo;
	}

	
	public function getTitulo()
	{

		return $this->titulo;
	}

	
	public function getTestMultiple()
	{

		return $this->test_multiple;
	}

	
	public function getTestResta()
	{

		return $this->test_resta;
	}

	
	public function getNumeroRespuestas()
	{

		return $this->numero_respuestas;
	}

	
	public function getPublicado()
	{

		return $this->publicado;
	}

	
	public function getSolucion()
	{

		return $this->solucion;
	}

	
	public function getExpresionesMatematicas()
	{

		return $this->expresiones_matematicas;
	}

	
	public function getNumeroHojas()
	{

		return $this->numero_hojas;
	}

	
	public function getIdSolucion()
	{

		return $this->id_solucion;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EjercicioPeer::ID;
		}

	} 
	
	public function setIdAutor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_autor !== $v) {
			$this->id_autor = $v;
			$this->modifiedColumns[] = EjercicioPeer::ID_AUTOR;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdMateria($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_materia !== $v) {
			$this->id_materia = $v;
			$this->modifiedColumns[] = EjercicioPeer::ID_MATERIA;
		}

		if ($this->aMateria !== null && $this->aMateria->getId() !== $v) {
			$this->aMateria = null;
		}

	} 
	
	public function setNombreAutor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_autor !== $v) {
			$this->nombre_autor = $v;
			$this->modifiedColumns[] = EjercicioPeer::NOMBRE_AUTOR;
		}

	} 
	
	public function setTipo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tipo !== $v) {
			$this->tipo = $v;
			$this->modifiedColumns[] = EjercicioPeer::TIPO;
		}

	} 
	
	public function setTitulo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->titulo !== $v) {
			$this->titulo = $v;
			$this->modifiedColumns[] = EjercicioPeer::TITULO;
		}

	} 
	
	public function setTestMultiple($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->test_multiple !== $v || $v === 0) {
			$this->test_multiple = $v;
			$this->modifiedColumns[] = EjercicioPeer::TEST_MULTIPLE;
		}

	} 
	
	public function setTestResta($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->test_resta !== $v || $v === 0) {
			$this->test_resta = $v;
			$this->modifiedColumns[] = EjercicioPeer::TEST_RESTA;
		}

	} 
	
	public function setNumeroRespuestas($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->numero_respuestas !== $v) {
			$this->numero_respuestas = $v;
			$this->modifiedColumns[] = EjercicioPeer::NUMERO_RESPUESTAS;
		}

	} 
	
	public function setPublicado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->publicado !== $v || $v === 0) {
			$this->publicado = $v;
			$this->modifiedColumns[] = EjercicioPeer::PUBLICADO;
		}

	} 
	
	public function setSolucion($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->solucion !== $v || $v === 0) {
			$this->solucion = $v;
			$this->modifiedColumns[] = EjercicioPeer::SOLUCION;
		}

	} 
	
	public function setExpresionesMatematicas($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->expresiones_matematicas !== $v || $v === 0) {
			$this->expresiones_matematicas = $v;
			$this->modifiedColumns[] = EjercicioPeer::EXPRESIONES_MATEMATICAS;
		}

	} 
	
	public function setNumeroHojas($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->numero_hojas !== $v) {
			$this->numero_hojas = $v;
			$this->modifiedColumns[] = EjercicioPeer::NUMERO_HOJAS;
		}

	} 
	
	public function setIdSolucion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_solucion !== $v) {
			$this->id_solucion = $v;
			$this->modifiedColumns[] = EjercicioPeer::ID_SOLUCION;
		}

		if ($this->aEjercicio_resuelto !== null && $this->aEjercicio_resuelto->getId() !== $v) {
			$this->aEjercicio_resuelto = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_autor = $rs->getString($startcol + 1);

			$this->id_materia = $rs->getString($startcol + 2);

			$this->nombre_autor = $rs->getString($startcol + 3);

			$this->tipo = $rs->getString($startcol + 4);

			$this->titulo = $rs->getString($startcol + 5);

			$this->test_multiple = $rs->getInt($startcol + 6);

			$this->test_resta = $rs->getInt($startcol + 7);

			$this->numero_respuestas = $rs->getInt($startcol + 8);

			$this->publicado = $rs->getInt($startcol + 9);

			$this->solucion = $rs->getInt($startcol + 10);

			$this->expresiones_matematicas = $rs->getInt($startcol + 11);

			$this->numero_hojas = $rs->getInt($startcol + 12);

			$this->id_solucion = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ejercicio object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EjercicioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EjercicioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(EjercicioPeer::DATABASE_NAME);
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


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aMateria !== null) {
				if ($this->aMateria->isModified()) {
					$affectedRows += $this->aMateria->save($con);
				}
				$this->setMateria($this->aMateria);
			}

			if ($this->aEjercicio_resuelto !== null) {
				if ($this->aEjercicio_resuelto->isModified()) {
					$affectedRows += $this->aEjercicio_resuelto->save($con);
				}
				$this->setEjercicio_resuelto($this->aEjercicio_resuelto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EjercicioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EjercicioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPublicado_ejercicio_cursos !== null) {
				foreach($this->collPublicado_ejercicio_cursos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCuestion_cortas !== null) {
				foreach($this->collCuestion_cortas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCuestion_tests !== null) {
				foreach($this->collCuestion_tests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCuestion_practicas !== null) {
				foreach($this->collCuestion_practicas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEjercicio_resueltos !== null) {
				foreach($this->collEjercicio_resueltos as $referrerFK) {
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aMateria !== null) {
				if (!$this->aMateria->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMateria->getValidationFailures());
				}
			}

			if ($this->aEjercicio_resuelto !== null) {
				if (!$this->aEjercicio_resuelto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_resuelto->getValidationFailures());
				}
			}


			if (($retval = EjercicioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPublicado_ejercicio_cursos !== null) {
					foreach($this->collPublicado_ejercicio_cursos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCuestion_cortas !== null) {
					foreach($this->collCuestion_cortas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCuestion_tests !== null) {
					foreach($this->collCuestion_tests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCuestion_practicas !== null) {
					foreach($this->collCuestion_practicas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEjercicio_resueltos !== null) {
					foreach($this->collEjercicio_resueltos as $referrerFK) {
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
		$pos = EjercicioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIdMateria();
				break;
			case 3:
				return $this->getNombreAutor();
				break;
			case 4:
				return $this->getTipo();
				break;
			case 5:
				return $this->getTitulo();
				break;
			case 6:
				return $this->getTestMultiple();
				break;
			case 7:
				return $this->getTestResta();
				break;
			case 8:
				return $this->getNumeroRespuestas();
				break;
			case 9:
				return $this->getPublicado();
				break;
			case 10:
				return $this->getSolucion();
				break;
			case 11:
				return $this->getExpresionesMatematicas();
				break;
			case 12:
				return $this->getNumeroHojas();
				break;
			case 13:
				return $this->getIdSolucion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EjercicioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAutor(),
			$keys[2] => $this->getIdMateria(),
			$keys[3] => $this->getNombreAutor(),
			$keys[4] => $this->getTipo(),
			$keys[5] => $this->getTitulo(),
			$keys[6] => $this->getTestMultiple(),
			$keys[7] => $this->getTestResta(),
			$keys[8] => $this->getNumeroRespuestas(),
			$keys[9] => $this->getPublicado(),
			$keys[10] => $this->getSolucion(),
			$keys[11] => $this->getExpresionesMatematicas(),
			$keys[12] => $this->getNumeroHojas(),
			$keys[13] => $this->getIdSolucion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EjercicioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIdMateria($value);
				break;
			case 3:
				$this->setNombreAutor($value);
				break;
			case 4:
				$this->setTipo($value);
				break;
			case 5:
				$this->setTitulo($value);
				break;
			case 6:
				$this->setTestMultiple($value);
				break;
			case 7:
				$this->setTestResta($value);
				break;
			case 8:
				$this->setNumeroRespuestas($value);
				break;
			case 9:
				$this->setPublicado($value);
				break;
			case 10:
				$this->setSolucion($value);
				break;
			case 11:
				$this->setExpresionesMatematicas($value);
				break;
			case 12:
				$this->setNumeroHojas($value);
				break;
			case 13:
				$this->setIdSolucion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EjercicioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAutor($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdMateria($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombreAutor($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTitulo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTestMultiple($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTestResta($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNumeroRespuestas($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPublicado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSolucion($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setExpresionesMatematicas($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setNumeroHojas($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIdSolucion($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EjercicioPeer::DATABASE_NAME);

		if ($this->isColumnModified(EjercicioPeer::ID)) $criteria->add(EjercicioPeer::ID, $this->id);
		if ($this->isColumnModified(EjercicioPeer::ID_AUTOR)) $criteria->add(EjercicioPeer::ID_AUTOR, $this->id_autor);
		if ($this->isColumnModified(EjercicioPeer::ID_MATERIA)) $criteria->add(EjercicioPeer::ID_MATERIA, $this->id_materia);
		if ($this->isColumnModified(EjercicioPeer::NOMBRE_AUTOR)) $criteria->add(EjercicioPeer::NOMBRE_AUTOR, $this->nombre_autor);
		if ($this->isColumnModified(EjercicioPeer::TIPO)) $criteria->add(EjercicioPeer::TIPO, $this->tipo);
		if ($this->isColumnModified(EjercicioPeer::TITULO)) $criteria->add(EjercicioPeer::TITULO, $this->titulo);
		if ($this->isColumnModified(EjercicioPeer::TEST_MULTIPLE)) $criteria->add(EjercicioPeer::TEST_MULTIPLE, $this->test_multiple);
		if ($this->isColumnModified(EjercicioPeer::TEST_RESTA)) $criteria->add(EjercicioPeer::TEST_RESTA, $this->test_resta);
		if ($this->isColumnModified(EjercicioPeer::NUMERO_RESPUESTAS)) $criteria->add(EjercicioPeer::NUMERO_RESPUESTAS, $this->numero_respuestas);
		if ($this->isColumnModified(EjercicioPeer::PUBLICADO)) $criteria->add(EjercicioPeer::PUBLICADO, $this->publicado);
		if ($this->isColumnModified(EjercicioPeer::SOLUCION)) $criteria->add(EjercicioPeer::SOLUCION, $this->solucion);
		if ($this->isColumnModified(EjercicioPeer::EXPRESIONES_MATEMATICAS)) $criteria->add(EjercicioPeer::EXPRESIONES_MATEMATICAS, $this->expresiones_matematicas);
		if ($this->isColumnModified(EjercicioPeer::NUMERO_HOJAS)) $criteria->add(EjercicioPeer::NUMERO_HOJAS, $this->numero_hojas);
		if ($this->isColumnModified(EjercicioPeer::ID_SOLUCION)) $criteria->add(EjercicioPeer::ID_SOLUCION, $this->id_solucion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EjercicioPeer::DATABASE_NAME);

		$criteria->add(EjercicioPeer::ID, $this->id);

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

		$copyObj->setIdMateria($this->id_materia);

		$copyObj->setNombreAutor($this->nombre_autor);

		$copyObj->setTipo($this->tipo);

		$copyObj->setTitulo($this->titulo);

		$copyObj->setTestMultiple($this->test_multiple);

		$copyObj->setTestResta($this->test_resta);

		$copyObj->setNumeroRespuestas($this->numero_respuestas);

		$copyObj->setPublicado($this->publicado);

		$copyObj->setSolucion($this->solucion);

		$copyObj->setExpresionesMatematicas($this->expresiones_matematicas);

		$copyObj->setNumeroHojas($this->numero_hojas);

		$copyObj->setIdSolucion($this->id_solucion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPublicado_ejercicio_cursos() as $relObj) {
				$copyObj->addPublicado_ejercicio_curso($relObj->copy($deepCopy));
			}

			foreach($this->getCuestion_cortas() as $relObj) {
				$copyObj->addCuestion_corta($relObj->copy($deepCopy));
			}

			foreach($this->getCuestion_tests() as $relObj) {
				$copyObj->addCuestion_test($relObj->copy($deepCopy));
			}

			foreach($this->getCuestion_practicas() as $relObj) {
				$copyObj->addCuestion_practica($relObj->copy($deepCopy));
			}

			foreach($this->getEjercicio_resueltos() as $relObj) {
				$copyObj->addEjercicio_resuelto($relObj->copy($deepCopy));
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
			self::$peer = new EjercicioPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdAutor(NULL);
		} else {
			$this->setIdAutor($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->id_autor !== "" && $this->id_autor !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_autor, $con);

			
		}
		return $this->aUsuario;
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

	
	public function setEjercicio_resuelto($v)
	{


		if ($v === null) {
			$this->setIdSolucion(NULL);
		} else {
			$this->setIdSolucion($v->getId());
		}


		$this->aEjercicio_resuelto = $v;
	}


	
	public function getEjercicio_resuelto($con = null)
	{
		if ($this->aEjercicio_resuelto === null && (($this->id_solucion !== "" && $this->id_solucion !== null))) {
						include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';

			$this->aEjercicio_resuelto = Ejercicio_resueltoPeer::retrieveByPK($this->id_solucion, $con);

			
		}
		return $this->aEjercicio_resuelto;
	}

	
	public function initPublicado_ejercicio_cursos()
	{
		if ($this->collPublicado_ejercicio_cursos === null) {
			$this->collPublicado_ejercicio_cursos = array();
		}
	}

	
	public function getPublicado_ejercicio_cursos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePublicado_ejercicio_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPublicado_ejercicio_cursos === null) {
			if ($this->isNew()) {
			   $this->collPublicado_ejercicio_cursos = array();
			} else {

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->getId());

				Publicado_ejercicio_cursoPeer::addSelectColumns($criteria);
				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->getId());

				Publicado_ejercicio_cursoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPublicado_ejercicio_cursoCriteria) || !$this->lastPublicado_ejercicio_cursoCriteria->equals($criteria)) {
					$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPublicado_ejercicio_cursoCriteria = $criteria;
		return $this->collPublicado_ejercicio_cursos;
	}

	
	public function countPublicado_ejercicio_cursos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePublicado_ejercicio_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->getId());

		return Publicado_ejercicio_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPublicado_ejercicio_curso(Publicado_ejercicio_curso $l)
	{
		$this->collPublicado_ejercicio_cursos[] = $l;
		$l->setEjercicio($this);
	}


	
	public function getPublicado_ejercicio_cursosJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePublicado_ejercicio_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPublicado_ejercicio_cursos === null) {
			if ($this->isNew()) {
				$this->collPublicado_ejercicio_cursos = array();
			} else {

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->getId());

				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastPublicado_ejercicio_cursoCriteria) || !$this->lastPublicado_ejercicio_cursoCriteria->equals($criteria)) {
				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastPublicado_ejercicio_cursoCriteria = $criteria;

		return $this->collPublicado_ejercicio_cursos;
	}

	
	public function initCuestion_cortas()
	{
		if ($this->collCuestion_cortas === null) {
			$this->collCuestion_cortas = array();
		}
	}

	
	public function getCuestion_cortas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_cortaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCuestion_cortas === null) {
			if ($this->isNew()) {
			   $this->collCuestion_cortas = array();
			} else {

				$criteria->add(Cuestion_cortaPeer::ID_EJERCICIO, $this->getId());

				Cuestion_cortaPeer::addSelectColumns($criteria);
				$this->collCuestion_cortas = Cuestion_cortaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Cuestion_cortaPeer::ID_EJERCICIO, $this->getId());

				Cuestion_cortaPeer::addSelectColumns($criteria);
				if (!isset($this->lastCuestion_cortaCriteria) || !$this->lastCuestion_cortaCriteria->equals($criteria)) {
					$this->collCuestion_cortas = Cuestion_cortaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCuestion_cortaCriteria = $criteria;
		return $this->collCuestion_cortas;
	}

	
	public function countCuestion_cortas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_cortaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Cuestion_cortaPeer::ID_EJERCICIO, $this->getId());

		return Cuestion_cortaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCuestion_corta(Cuestion_corta $l)
	{
		$this->collCuestion_cortas[] = $l;
		$l->setEjercicio($this);
	}

	
	public function initCuestion_tests()
	{
		if ($this->collCuestion_tests === null) {
			$this->collCuestion_tests = array();
		}
	}

	
	public function getCuestion_tests($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCuestion_tests === null) {
			if ($this->isNew()) {
			   $this->collCuestion_tests = array();
			} else {

				$criteria->add(Cuestion_testPeer::ID_EJERCICIO, $this->getId());

				Cuestion_testPeer::addSelectColumns($criteria);
				$this->collCuestion_tests = Cuestion_testPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Cuestion_testPeer::ID_EJERCICIO, $this->getId());

				Cuestion_testPeer::addSelectColumns($criteria);
				if (!isset($this->lastCuestion_testCriteria) || !$this->lastCuestion_testCriteria->equals($criteria)) {
					$this->collCuestion_tests = Cuestion_testPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCuestion_testCriteria = $criteria;
		return $this->collCuestion_tests;
	}

	
	public function countCuestion_tests($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_testPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Cuestion_testPeer::ID_EJERCICIO, $this->getId());

		return Cuestion_testPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCuestion_test(Cuestion_test $l)
	{
		$this->collCuestion_tests[] = $l;
		$l->setEjercicio($this);
	}

	
	public function initCuestion_practicas()
	{
		if ($this->collCuestion_practicas === null) {
			$this->collCuestion_practicas = array();
		}
	}

	
	public function getCuestion_practicas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCuestion_practicas === null) {
			if ($this->isNew()) {
			   $this->collCuestion_practicas = array();
			} else {

				$criteria->add(Cuestion_practicaPeer::ID_EJERCICIO, $this->getId());

				Cuestion_practicaPeer::addSelectColumns($criteria);
				$this->collCuestion_practicas = Cuestion_practicaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Cuestion_practicaPeer::ID_EJERCICIO, $this->getId());

				Cuestion_practicaPeer::addSelectColumns($criteria);
				if (!isset($this->lastCuestion_practicaCriteria) || !$this->lastCuestion_practicaCriteria->equals($criteria)) {
					$this->collCuestion_practicas = Cuestion_practicaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCuestion_practicaCriteria = $criteria;
		return $this->collCuestion_practicas;
	}

	
	public function countCuestion_practicas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCuestion_practicaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Cuestion_practicaPeer::ID_EJERCICIO, $this->getId());

		return Cuestion_practicaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCuestion_practica(Cuestion_practica $l)
	{
		$this->collCuestion_practicas[] = $l;
		$l->setEjercicio($this);
	}

	
	public function initEjercicio_resueltos()
	{
		if ($this->collEjercicio_resueltos === null) {
			$this->collEjercicio_resueltos = array();
		}
	}

	
	public function getEjercicio_resueltos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltos === null) {
			if ($this->isNew()) {
			   $this->collEjercicio_resueltos = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEjercicio_resueltoCriteria) || !$this->lastEjercicio_resueltoCriteria->equals($criteria)) {
					$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEjercicio_resueltoCriteria = $criteria;
		return $this->collEjercicio_resueltos;
	}

	
	public function countEjercicio_resueltos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

		return Ejercicio_resueltoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio_resuelto(Ejercicio_resuelto $l)
	{
		$this->collEjercicio_resueltos[] = $l;
		$l->setEjercicio($this);
	}


	
	public function getEjercicio_resueltosJoinUsuarioRelatedByIdAutor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltos === null) {
			if ($this->isNew()) {
				$this->collEjercicio_resueltos = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

				$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelectJoinUsuarioRelatedByIdAutor($criteria, $con);
			}
		} else {
									
			$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastEjercicio_resueltoCriteria) || !$this->lastEjercicio_resueltoCriteria->equals($criteria)) {
				$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelectJoinUsuarioRelatedByIdAutor($criteria, $con);
			}
		}
		$this->lastEjercicio_resueltoCriteria = $criteria;

		return $this->collEjercicio_resueltos;
	}


	
	public function getEjercicio_resueltosJoinUsuarioRelatedByIdCorrector($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltos === null) {
			if ($this->isNew()) {
				$this->collEjercicio_resueltos = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

				$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelectJoinUsuarioRelatedByIdCorrector($criteria, $con);
			}
		} else {
									
			$criteria->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastEjercicio_resueltoCriteria) || !$this->lastEjercicio_resueltoCriteria->equals($criteria)) {
				$this->collEjercicio_resueltos = Ejercicio_resueltoPeer::doSelectJoinUsuarioRelatedByIdCorrector($criteria, $con);
			}
		}
		$this->lastEjercicio_resueltoCriteria = $criteria;

		return $this->collEjercicio_resueltos;
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

				$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

				TareaPeer::addSelectColumns($criteria);
				$this->collTareas = TareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

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

		$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

		return TareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTarea(Tarea $l)
	{
		$this->collTareas[] = $l;
		$l->setEjercicio($this);
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

				$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinCurso($criteria, $con);
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

				$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
	}


	
	public function getTareasJoinEvento($criteria = null, $con = null)
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

				$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_EJERCICIO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
	}

} 