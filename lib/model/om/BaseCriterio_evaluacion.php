<?php


abstract class BaseCriterio_evaluacion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_curso;


	
	protected $obligatorio = 1;


	
	protected $peso;


	
	protected $descripcion;


	
	protected $id_tarea;

	
	protected $aUsuario;

	
	protected $aTarea;

	
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

	
	public function getObligatorio()
	{

		return $this->obligatorio;
	}

	
	public function getPeso()
	{

		return $this->peso;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
	}

	
	public function getIdTarea()
	{

		return $this->id_tarea;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::ID;
		}

	} 
	
	public function setIdCurso($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::ID_CURSO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setObligatorio($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->obligatorio !== $v || $v === 1) {
			$this->obligatorio = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::OBLIGATORIO;
		}

	} 
	
	public function setPeso($v)
	{

		if ($this->peso !== $v) {
			$this->peso = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::PESO;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::DESCRIPCION;
		}

	} 
	
	public function setIdTarea($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tarea !== $v) {
			$this->id_tarea = $v;
			$this->modifiedColumns[] = Criterio_evaluacionPeer::ID_TAREA;
		}

		if ($this->aTarea !== null && $this->aTarea->getId() !== $v) {
			$this->aTarea = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_curso = $rs->getString($startcol + 1);

			$this->obligatorio = $rs->getInt($startcol + 2);

			$this->peso = $rs->getFloat($startcol + 3);

			$this->descripcion = $rs->getString($startcol + 4);

			$this->id_tarea = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Criterio_evaluacion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Criterio_evaluacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Criterio_evaluacionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Criterio_evaluacionPeer::DATABASE_NAME);
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

			if ($this->aTarea !== null) {
				if ($this->aTarea->isModified()) {
					$affectedRows += $this->aTarea->save($con);
				}
				$this->setTarea($this->aTarea);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Criterio_evaluacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Criterio_evaluacionPeer::doUpdate($this, $con);
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aTarea !== null) {
				if (!$this->aTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTarea->getValidationFailures());
				}
			}


			if (($retval = Criterio_evaluacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Criterio_evaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getObligatorio();
				break;
			case 3:
				return $this->getPeso();
				break;
			case 4:
				return $this->getDescripcion();
				break;
			case 5:
				return $this->getIdTarea();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Criterio_evaluacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdCurso(),
			$keys[2] => $this->getObligatorio(),
			$keys[3] => $this->getPeso(),
			$keys[4] => $this->getDescripcion(),
			$keys[5] => $this->getIdTarea(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Criterio_evaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setObligatorio($value);
				break;
			case 3:
				$this->setPeso($value);
				break;
			case 4:
				$this->setDescripcion($value);
				break;
			case 5:
				$this->setIdTarea($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Criterio_evaluacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdCurso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setObligatorio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPeso($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescripcion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIdTarea($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Criterio_evaluacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(Criterio_evaluacionPeer::ID)) $criteria->add(Criterio_evaluacionPeer::ID, $this->id);
		if ($this->isColumnModified(Criterio_evaluacionPeer::ID_CURSO)) $criteria->add(Criterio_evaluacionPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Criterio_evaluacionPeer::OBLIGATORIO)) $criteria->add(Criterio_evaluacionPeer::OBLIGATORIO, $this->obligatorio);
		if ($this->isColumnModified(Criterio_evaluacionPeer::PESO)) $criteria->add(Criterio_evaluacionPeer::PESO, $this->peso);
		if ($this->isColumnModified(Criterio_evaluacionPeer::DESCRIPCION)) $criteria->add(Criterio_evaluacionPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(Criterio_evaluacionPeer::ID_TAREA)) $criteria->add(Criterio_evaluacionPeer::ID_TAREA, $this->id_tarea);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Criterio_evaluacionPeer::DATABASE_NAME);

		$criteria->add(Criterio_evaluacionPeer::ID, $this->id);

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

		$copyObj->setObligatorio($this->obligatorio);

		$copyObj->setPeso($this->peso);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setIdTarea($this->id_tarea);


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
			self::$peer = new Criterio_evaluacionPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdCurso(NULL);
		} else {
			$this->setIdCurso($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';

		if ($this->aUsuario === null && (($this->id_curso !== "" && $this->id_curso !== null))) {

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_curso, $con);

			
		}
		return $this->aUsuario;
	}

	
	public function setTarea($v)
	{


		if ($v === null) {
			$this->setIdTarea(NULL);
		} else {
			$this->setIdTarea($v->getId());
		}


		$this->aTarea = $v;
	}


	
	public function getTarea($con = null)
	{
				include_once 'lib/model/om/BaseTareaPeer.php';

		if ($this->aTarea === null && (($this->id_tarea !== "" && $this->id_tarea !== null))) {

			$this->aTarea = TareaPeer::retrieveByPK($this->id_tarea, $con);

			
		}
		return $this->aTarea;
	}

} 