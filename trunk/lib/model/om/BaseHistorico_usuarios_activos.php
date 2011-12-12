<?php


abstract class BaseHistorico_usuarios_activos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $fecha;


	
	protected $id_usuario;


	
	protected $nombreusuario;


	
	protected $dni;


	
	protected $nombre;


	
	protected $apellidos;


	
	protected $email;


	
	protected $telefono1;


	
	protected $telefono2;


	
	protected $dias_matriculado;

	
	protected $collHistorico_cursos_usuarios_activoss;

	
	protected $lastHistorico_cursos_usuarios_activosCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getFecha($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha === null || $this->fecha === '') {
			return null;
		} elseif (!is_int($this->fecha)) {
						$ts = strtotime($this->fecha);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha] as date/time value: " . var_export($this->fecha, true));
			}
		} else {
			$ts = $this->fecha;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getNombreusuario()
	{

		return $this->nombreusuario;
	}

	
	public function getDni()
	{

		return $this->dni;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getApellidos()
	{

		return $this->apellidos;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getTelefono1()
	{

		return $this->telefono1;
	}

	
	public function getTelefono2()
	{

		return $this->telefono2;
	}

	
	public function getDiasMatriculado()
	{

		return $this->dias_matriculado;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::ID;
		}

	} 
	
	public function setFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha !== $ts) {
			$this->fecha = $ts;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::FECHA;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::ID_USUARIO;
		}

	} 
	
	public function setNombreusuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombreusuario !== $v) {
			$this->nombreusuario = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::NOMBREUSUARIO;
		}

	} 
	
	public function setDni($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dni !== $v) {
			$this->dni = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::DNI;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::NOMBRE;
		}

	} 
	
	public function setApellidos($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->apellidos !== $v) {
			$this->apellidos = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::APELLIDOS;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::EMAIL;
		}

	} 
	
	public function setTelefono1($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telefono1 !== $v) {
			$this->telefono1 = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::TELEFONO1;
		}

	} 
	
	public function setTelefono2($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telefono2 !== $v) {
			$this->telefono2 = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::TELEFONO2;
		}

	} 
	
	public function setDiasMatriculado($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dias_matriculado !== $v) {
			$this->dias_matriculado = $v;
			$this->modifiedColumns[] = Historico_usuarios_activosPeer::DIAS_MATRICULADO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->fecha = $rs->getTimestamp($startcol + 1, null);

			$this->id_usuario = $rs->getString($startcol + 2);

			$this->nombreusuario = $rs->getString($startcol + 3);

			$this->dni = $rs->getString($startcol + 4);

			$this->nombre = $rs->getString($startcol + 5);

			$this->apellidos = $rs->getString($startcol + 6);

			$this->email = $rs->getString($startcol + 7);

			$this->telefono1 = $rs->getString($startcol + 8);

			$this->telefono2 = $rs->getString($startcol + 9);

			$this->dias_matriculado = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Historico_usuarios_activos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Historico_usuarios_activosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Historico_usuarios_activosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(Historico_usuarios_activosPeer::DATABASE_NAME);
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
					$pk = Historico_usuarios_activosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Historico_usuarios_activosPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHistorico_cursos_usuarios_activoss !== null) {
				foreach($this->collHistorico_cursos_usuarios_activoss as $referrerFK) {
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


			if (($retval = Historico_usuarios_activosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHistorico_cursos_usuarios_activoss !== null) {
					foreach($this->collHistorico_cursos_usuarios_activoss as $referrerFK) {
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
		$pos = Historico_usuarios_activosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFecha();
				break;
			case 2:
				return $this->getIdUsuario();
				break;
			case 3:
				return $this->getNombreusuario();
				break;
			case 4:
				return $this->getDni();
				break;
			case 5:
				return $this->getNombre();
				break;
			case 6:
				return $this->getApellidos();
				break;
			case 7:
				return $this->getEmail();
				break;
			case 8:
				return $this->getTelefono1();
				break;
			case 9:
				return $this->getTelefono2();
				break;
			case 10:
				return $this->getDiasMatriculado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Historico_usuarios_activosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFecha(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getNombreusuario(),
			$keys[4] => $this->getDni(),
			$keys[5] => $this->getNombre(),
			$keys[6] => $this->getApellidos(),
			$keys[7] => $this->getEmail(),
			$keys[8] => $this->getTelefono1(),
			$keys[9] => $this->getTelefono2(),
			$keys[10] => $this->getDiasMatriculado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Historico_usuarios_activosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFecha($value);
				break;
			case 2:
				$this->setIdUsuario($value);
				break;
			case 3:
				$this->setNombreusuario($value);
				break;
			case 4:
				$this->setDni($value);
				break;
			case 5:
				$this->setNombre($value);
				break;
			case 6:
				$this->setApellidos($value);
				break;
			case 7:
				$this->setEmail($value);
				break;
			case 8:
				$this->setTelefono1($value);
				break;
			case 9:
				$this->setTelefono2($value);
				break;
			case 10:
				$this->setDiasMatriculado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Historico_usuarios_activosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFecha($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombreusuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDni($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNombre($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setApellidos($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTelefono1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTelefono2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDiasMatriculado($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Historico_usuarios_activosPeer::DATABASE_NAME);

		if ($this->isColumnModified(Historico_usuarios_activosPeer::ID)) $criteria->add(Historico_usuarios_activosPeer::ID, $this->id);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::FECHA)) $criteria->add(Historico_usuarios_activosPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::ID_USUARIO)) $criteria->add(Historico_usuarios_activosPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::NOMBREUSUARIO)) $criteria->add(Historico_usuarios_activosPeer::NOMBREUSUARIO, $this->nombreusuario);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::DNI)) $criteria->add(Historico_usuarios_activosPeer::DNI, $this->dni);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::NOMBRE)) $criteria->add(Historico_usuarios_activosPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::APELLIDOS)) $criteria->add(Historico_usuarios_activosPeer::APELLIDOS, $this->apellidos);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::EMAIL)) $criteria->add(Historico_usuarios_activosPeer::EMAIL, $this->email);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::TELEFONO1)) $criteria->add(Historico_usuarios_activosPeer::TELEFONO1, $this->telefono1);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::TELEFONO2)) $criteria->add(Historico_usuarios_activosPeer::TELEFONO2, $this->telefono2);
		if ($this->isColumnModified(Historico_usuarios_activosPeer::DIAS_MATRICULADO)) $criteria->add(Historico_usuarios_activosPeer::DIAS_MATRICULADO, $this->dias_matriculado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Historico_usuarios_activosPeer::DATABASE_NAME);

		$criteria->add(Historico_usuarios_activosPeer::ID, $this->id);

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

		$copyObj->setFecha($this->fecha);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setNombreusuario($this->nombreusuario);

		$copyObj->setDni($this->dni);

		$copyObj->setNombre($this->nombre);

		$copyObj->setApellidos($this->apellidos);

		$copyObj->setEmail($this->email);

		$copyObj->setTelefono1($this->telefono1);

		$copyObj->setTelefono2($this->telefono2);

		$copyObj->setDiasMatriculado($this->dias_matriculado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHistorico_cursos_usuarios_activoss() as $relObj) {
				$copyObj->addHistorico_cursos_usuarios_activos($relObj->copy($deepCopy));
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
			self::$peer = new Historico_usuarios_activosPeer();
		}
		return self::$peer;
	}

	
	public function initHistorico_cursos_usuarios_activoss()
	{
		if ($this->collHistorico_cursos_usuarios_activoss === null) {
			$this->collHistorico_cursos_usuarios_activoss = array();
		}
	}

	
	public function getHistorico_cursos_usuarios_activoss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHistorico_cursos_usuarios_activosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistorico_cursos_usuarios_activoss === null) {
			if ($this->isNew()) {
			   $this->collHistorico_cursos_usuarios_activoss = array();
			} else {

				$criteria->add(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, $this->getId());

				Historico_cursos_usuarios_activosPeer::addSelectColumns($criteria);
				$this->collHistorico_cursos_usuarios_activoss = Historico_cursos_usuarios_activosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, $this->getId());

				Historico_cursos_usuarios_activosPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistorico_cursos_usuarios_activosCriteria) || !$this->lastHistorico_cursos_usuarios_activosCriteria->equals($criteria)) {
					$this->collHistorico_cursos_usuarios_activoss = Historico_cursos_usuarios_activosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistorico_cursos_usuarios_activosCriteria = $criteria;
		return $this->collHistorico_cursos_usuarios_activoss;
	}

	
	public function countHistorico_cursos_usuarios_activoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHistorico_cursos_usuarios_activosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS, $this->getId());

		return Historico_cursos_usuarios_activosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHistorico_cursos_usuarios_activos(Historico_cursos_usuarios_activos $l)
	{
		$this->collHistorico_cursos_usuarios_activoss[] = $l;
		$l->setHistorico_usuarios_activos($this);
	}

} 