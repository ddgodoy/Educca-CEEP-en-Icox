<?php


abstract class BaseRel_curso_tema extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_curso;


	
	protected $id_tema;


	
	protected $fecha_completado;

	
	protected $aCurso;

	
	protected $aTema;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdCurso()
	{

		return $this->id_curso;
	}

	
	public function getIdTema()
	{

		return $this->id_tema;
	}

	
	public function getFechaCompletado($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_completado === null || $this->fecha_completado === '') {
			return null;
		} elseif (!is_int($this->fecha_completado)) {
						$ts = strtotime($this->fecha_completado);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_completado] as date/time value: " . var_export($this->fecha_completado, true));
			}
		} else {
			$ts = $this->fecha_completado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setIdCurso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_curso !== $v) {
			$this->id_curso = $v;
			$this->modifiedColumns[] = Rel_curso_temaPeer::ID_CURSO;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
		}

	} 
	
	public function setIdTema($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_tema !== $v) {
			$this->id_tema = $v;
			$this->modifiedColumns[] = Rel_curso_temaPeer::ID_TEMA;
		}

		if ($this->aTema !== null && $this->aTema->getId() !== $v) {
			$this->aTema = null;
		}

	} 
	
	public function setFechaCompletado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_completado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_completado !== $ts) {
			$this->fecha_completado = $ts;
			$this->modifiedColumns[] = Rel_curso_temaPeer::FECHA_COMPLETADO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_curso = $rs->getString($startcol + 0);

			$this->id_tema = $rs->getString($startcol + 1);

			$this->fecha_completado = $rs->getTimestamp($startcol + 2, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rel_curso_tema object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Rel_curso_temaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Rel_curso_temaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Rel_curso_temaPeer::DATABASE_NAME);
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

			if ($this->aTema !== null) {
				if ($this->aTema->isModified()) {
					$affectedRows += $this->aTema->save($con);
				}
				$this->setTema($this->aTema);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Rel_curso_temaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Rel_curso_temaPeer::doUpdate($this, $con);
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

			if ($this->aTema !== null) {
				if (!$this->aTema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTema->getValidationFailures());
				}
			}


			if (($retval = Rel_curso_temaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_curso_temaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdCurso();
				break;
			case 1:
				return $this->getIdTema();
				break;
			case 2:
				return $this->getFechaCompletado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_curso_temaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdCurso(),
			$keys[1] => $this->getIdTema(),
			$keys[2] => $this->getFechaCompletado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Rel_curso_temaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdCurso($value);
				break;
			case 1:
				$this->setIdTema($value);
				break;
			case 2:
				$this->setFechaCompletado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Rel_curso_temaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdCurso($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdTema($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFechaCompletado($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Rel_curso_temaPeer::DATABASE_NAME);

		if ($this->isColumnModified(Rel_curso_temaPeer::ID_CURSO)) $criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->id_curso);
		if ($this->isColumnModified(Rel_curso_temaPeer::ID_TEMA)) $criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->id_tema);
		if ($this->isColumnModified(Rel_curso_temaPeer::FECHA_COMPLETADO)) $criteria->add(Rel_curso_temaPeer::FECHA_COMPLETADO, $this->fecha_completado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Rel_curso_temaPeer::DATABASE_NAME);

		$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->id_curso);
		$criteria->add(Rel_curso_temaPeer::ID_TEMA, $this->id_tema);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdCurso();

		$pks[1] = $this->getIdTema();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdCurso($keys[0]);

		$this->setIdTema($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFechaCompletado($this->fecha_completado);


		$copyObj->setNew(true);

		$copyObj->setIdCurso(NULL); 
		$copyObj->setIdTema(NULL); 
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
			self::$peer = new Rel_curso_temaPeer();
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

	
	public function setTema($v)
	{


		if ($v === null) {
			$this->setIdTema(NULL);
		} else {
			$this->setIdTema($v->getId());
		}


		$this->aTema = $v;
	}


	
	public function getTema($con = null)
	{
		if ($this->aTema === null && (($this->id_tema !== "" && $this->id_tema !== null))) {
						include_once 'lib/model/om/BaseTemaPeer.php';

			$this->aTema = TemaPeer::retrieveByPK($this->id_tema, $con);

			
		}
		return $this->aTema;
	}

} 