<?php


abstract class BaseComentario_cuestion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_ejercicio_corregido;


	
	protected $id_respuesta_cuestion_corta;


	
	protected $comentario;

	
	protected $aEjercicio_corregido;

	
	protected $aRespuesta_cuestion_corta;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdEjercicioCorregido()
	{

		return $this->id_ejercicio_corregido;
	}

	
	public function getIdRespuestaCuestionCorta()
	{

		return $this->id_respuesta_cuestion_corta;
	}

	
	public function getComentario()
	{

		return $this->comentario;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Comentario_cuestionPeer::ID;
		}

	} 
	
	public function setIdEjercicioCorregido($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_ejercicio_corregido !== $v) {
			$this->id_ejercicio_corregido = $v;
			$this->modifiedColumns[] = Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO;
		}

		if ($this->aEjercicio_corregido !== null && $this->aEjercicio_corregido->getId() !== $v) {
			$this->aEjercicio_corregido = null;
		}

	} 
	
	public function setIdRespuestaCuestionCorta($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_respuesta_cuestion_corta !== $v) {
			$this->id_respuesta_cuestion_corta = $v;
			$this->modifiedColumns[] = Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA;
		}

		if ($this->aRespuesta_cuestion_corta !== null && $this->aRespuesta_cuestion_corta->getId() !== $v) {
			$this->aRespuesta_cuestion_corta = null;
		}

	} 
	
	public function setComentario($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comentario !== $v) {
			$this->comentario = $v;
			$this->modifiedColumns[] = Comentario_cuestionPeer::COMENTARIO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->id_ejercicio_corregido = $rs->getString($startcol + 1);

			$this->id_respuesta_cuestion_corta = $rs->getString($startcol + 2);

			$this->comentario = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Comentario_cuestion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Comentario_cuestionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Comentario_cuestionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Comentario_cuestionPeer::DATABASE_NAME);
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


												
			if ($this->aEjercicio_corregido !== null) {
				if ($this->aEjercicio_corregido->isModified()) {
					$affectedRows += $this->aEjercicio_corregido->save($con);
				}
				$this->setEjercicio_corregido($this->aEjercicio_corregido);
			}

			if ($this->aRespuesta_cuestion_corta !== null) {
				if ($this->aRespuesta_cuestion_corta->isModified()) {
					$affectedRows += $this->aRespuesta_cuestion_corta->save($con);
				}
				$this->setRespuesta_cuestion_corta($this->aRespuesta_cuestion_corta);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Comentario_cuestionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Comentario_cuestionPeer::doUpdate($this, $con);
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


												
			if ($this->aEjercicio_corregido !== null) {
				if (!$this->aEjercicio_corregido->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEjercicio_corregido->getValidationFailures());
				}
			}

			if ($this->aRespuesta_cuestion_corta !== null) {
				if (!$this->aRespuesta_cuestion_corta->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRespuesta_cuestion_corta->getValidationFailures());
				}
			}


			if (($retval = Comentario_cuestionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Comentario_cuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdEjercicioCorregido();
				break;
			case 2:
				return $this->getIdRespuestaCuestionCorta();
				break;
			case 3:
				return $this->getComentario();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Comentario_cuestionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdEjercicioCorregido(),
			$keys[2] => $this->getIdRespuestaCuestionCorta(),
			$keys[3] => $this->getComentario(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Comentario_cuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdEjercicioCorregido($value);
				break;
			case 2:
				$this->setIdRespuestaCuestionCorta($value);
				break;
			case 3:
				$this->setComentario($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Comentario_cuestionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdEjercicioCorregido($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdRespuestaCuestionCorta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComentario($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Comentario_cuestionPeer::DATABASE_NAME);

		if ($this->isColumnModified(Comentario_cuestionPeer::ID)) $criteria->add(Comentario_cuestionPeer::ID, $this->id);
		if ($this->isColumnModified(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO)) $criteria->add(Comentario_cuestionPeer::ID_EJERCICIO_CORREGIDO, $this->id_ejercicio_corregido);
		if ($this->isColumnModified(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA)) $criteria->add(Comentario_cuestionPeer::ID_RESPUESTA_CUESTION_CORTA, $this->id_respuesta_cuestion_corta);
		if ($this->isColumnModified(Comentario_cuestionPeer::COMENTARIO)) $criteria->add(Comentario_cuestionPeer::COMENTARIO, $this->comentario);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Comentario_cuestionPeer::DATABASE_NAME);

		$criteria->add(Comentario_cuestionPeer::ID, $this->id);

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

		$copyObj->setIdEjercicioCorregido($this->id_ejercicio_corregido);

		$copyObj->setIdRespuestaCuestionCorta($this->id_respuesta_cuestion_corta);

		$copyObj->setComentario($this->comentario);


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
			self::$peer = new Comentario_cuestionPeer();
		}
		return self::$peer;
	}

	
	public function setEjercicio_corregido($v)
	{


		if ($v === null) {
			$this->setIdEjercicioCorregido(NULL);
		} else {
			$this->setIdEjercicioCorregido($v->getId());
		}


		$this->aEjercicio_corregido = $v;
	}


	
	public function getEjercicio_corregido($con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_corregidoPeer.php';

		if ($this->aEjercicio_corregido === null && (($this->id_ejercicio_corregido !== "" && $this->id_ejercicio_corregido !== null))) {

			$this->aEjercicio_corregido = Ejercicio_corregidoPeer::retrieveByPK($this->id_ejercicio_corregido, $con);

			
		}
		return $this->aEjercicio_corregido;
	}

	
	public function setRespuesta_cuestion_corta($v)
	{


		if ($v === null) {
			$this->setIdRespuestaCuestionCorta(NULL);
		} else {
			$this->setIdRespuestaCuestionCorta($v->getId());
		}


		$this->aRespuesta_cuestion_corta = $v;
	}


	
	public function getRespuesta_cuestion_corta($con = null)
	{
				include_once 'lib/model/om/BaseRespuesta_cuestion_cortaPeer.php';

		if ($this->aRespuesta_cuestion_corta === null && (($this->id_respuesta_cuestion_corta !== "" && $this->id_respuesta_cuestion_corta !== null))) {

			$this->aRespuesta_cuestion_corta = Respuesta_cuestion_cortaPeer::retrieveByPK($this->id_respuesta_cuestion_corta, $con);

			
		}
		return $this->aRespuesta_cuestion_corta;
	}

} 