<?php


abstract class BaseUsuario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $confirmado = 0;


	
	protected $borrado = 0;


	
	protected $nombreusuario;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $dni;


	
	protected $nombre;


	
	protected $apellidos;


	
	protected $email;


	
	protected $emailstop = 0;


	
	protected $telefono1;


	
	protected $telefono2;


	
	protected $institucion;


	
	protected $departamento;


	
	protected $direccion;


	
	protected $cp;


	
	protected $ciudad;


	
	protected $pais_id;


	
	protected $ultimoacceso;


	
	protected $ultimaip;


	
	protected $secreto;


	
	protected $conectado;


	
	protected $foto = 0;


	
	protected $moroso = 0;


	
	protected $numconexion;


	
	protected $mat_online;


	
	protected $mat_ip;


	
	protected $presencial;


	
	protected $created_at;

	
	protected $aPais;

	
	protected $collsfSimpleForumPosts;

	
	protected $lastsfSimpleForumPostCriteria = null;

	
	protected $collPreferencia_usuarios;

	
	protected $lastPreferencia_usuarioCriteria = null;

	
	protected $collRel_usuario_rol_cursos;

	
	protected $lastRel_usuario_rol_cursoCriteria = null;

	
	protected $collRel_usuario_paquetes;

	
	protected $lastRel_usuario_paqueteCriteria = null;

	
	protected $collRel_usuario_temas;

	
	protected $lastRel_usuario_temaCriteria = null;

	
	protected $collMensajesRelatedByIdPropietario;

	
	protected $lastMensajeRelatedByIdPropietarioCriteria = null;

	
	protected $collMensajesRelatedByIdEmisor;

	
	protected $lastMensajeRelatedByIdEmisorCriteria = null;

	
	protected $collMensajesRelatedByIdDestinatario;

	
	protected $lastMensajeRelatedByIdDestinatarioCriteria = null;

	
	protected $collSeguimiento_mensajes;

	
	protected $lastSeguimiento_mensajeCriteria = null;

	
	protected $collNotificacions;

	
	protected $lastNotificacionCriteria = null;

	
	protected $collMensaje_chats;

	
	protected $lastMensaje_chatCriteria = null;

	
	protected $collRel_conectado_chats;

	
	protected $lastRel_conectado_chatCriteria = null;

	
	protected $collRel_usuario_eventos;

	
	protected $lastRel_usuario_eventoCriteria = null;

	
	protected $collEjercicios;

	
	protected $lastEjercicioCriteria = null;

	
	protected $collEjercicio_resueltosRelatedByIdAutor;

	
	protected $lastEjercicio_resueltoRelatedByIdAutorCriteria = null;

	
	protected $collEjercicio_resueltosRelatedByIdCorrector;

	
	protected $lastEjercicio_resueltoRelatedByIdCorrectorCriteria = null;

	
	protected $collTareas;

	
	protected $lastTareaCriteria = null;

	
	protected $collRel_usuario_tareas;

	
	protected $lastRel_usuario_tareaCriteria = null;

	
	protected $collCalificacioness;

	
	protected $lastCalificacionesCriteria = null;

	
	protected $collUsuarios_onlines;

	
	protected $lastUsuarios_onlineCriteria = null;

	
	protected $collRel_usuario_sco2004s;

	
	protected $lastRel_usuario_sco2004Criteria = null;

	
	protected $collRel_usuario_sco2004_learnercs;

	
	protected $lastRel_usuario_sco2004_learnercCriteria = null;

	
	protected $collRel_usuario_sco2004_lmscs;

	
	protected $lastRel_usuario_sco2004_lmscCriteria = null;

	
	protected $collRel_usuario_sco2004_interactions;

	
	protected $lastRel_usuario_sco2004_interactionCriteria = null;

	
	protected $collRel_usuario_sco2004_iobjectives;

	
	protected $lastRel_usuario_sco2004_iobjectiveCriteria = null;

	
	protected $collRel_usuario_sco2004_iresponses;

	
	protected $lastRel_usuario_sco2004_iresponseCriteria = null;

	
	protected $collRel_usuario_sco2004_objectives;

	
	protected $lastRel_usuario_sco2004_objectiveCriteria = null;

	
	protected $collRel_usuario_sco12s;

	
	protected $lastRel_usuario_sco12Criteria = null;

	
	protected $collRel_usuario_objetivo_sco12s;

	
	protected $lastRel_usuario_objetivo_sco12Criteria = null;

	
	protected $collRel_usuario_interaccion_sco12s;

	
	protected $lastRel_usuario_interaccion_sco12Criteria = null;

	
	protected $collRel_interaccion_sco12_objetivos;

	
	protected $lastRel_interaccion_sco12_objetivoCriteria = null;

	
	protected $collRel_interaccion_sco12_respuestas;

	
	protected $lastRel_interaccion_sco12_respuestaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getConfirmado()
	{

		return $this->confirmado;
	}

	
	public function getBorrado()
	{

		return $this->borrado;
	}

	
	public function getNombreusuario()
	{

		return $this->nombreusuario;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
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

	
	public function getEmailstop()
	{

		return $this->emailstop;
	}

	
	public function getTelefono1()
	{

		return $this->telefono1;
	}

	
	public function getTelefono2()
	{

		return $this->telefono2;
	}

	
	public function getInstitucion()
	{

		return $this->institucion;
	}

	
	public function getDepartamento()
	{

		return $this->departamento;
	}

	
	public function getDireccion()
	{

		return $this->direccion;
	}

	
	public function getCp()
	{

		return $this->cp;
	}

	
	public function getCiudad()
	{

		return $this->ciudad;
	}

	
	public function getPaisId()
	{

		return $this->pais_id;
	}

	
	public function getUltimoacceso($format = 'Y-m-d H:i:s')
	{

		if ($this->ultimoacceso === null || $this->ultimoacceso === '') {
			return null;
		} elseif (!is_int($this->ultimoacceso)) {
						$ts = strtotime($this->ultimoacceso);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ultimoacceso] as date/time value: " . var_export($this->ultimoacceso, true));
			}
		} else {
			$ts = $this->ultimoacceso;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUltimaip()
	{

		return $this->ultimaip;
	}

	
	public function getSecreto()
	{

		return $this->secreto;
	}

	
	public function getConectado()
	{

		return $this->conectado;
	}

	
	public function getFoto()
	{

		return $this->foto;
	}

	
	public function getMoroso()
	{

		return $this->moroso;
	}

	
	public function getNumconexion()
	{

		return $this->numconexion;
	}

	
	public function getMatOnline()
	{

		return $this->mat_online;
	}

	
	public function getMatIp()
	{

		return $this->mat_ip;
	}

	
	public function getPresencial()
	{

		return $this->presencial;
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
			$this->modifiedColumns[] = UsuarioPeer::ID;
		}

	} 
	
	public function setConfirmado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->confirmado !== $v || $v === 0) {
			$this->confirmado = $v;
			$this->modifiedColumns[] = UsuarioPeer::CONFIRMADO;
		}

	} 
	
	public function setBorrado($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->borrado !== $v || $v === 0) {
			$this->borrado = $v;
			$this->modifiedColumns[] = UsuarioPeer::BORRADO;
		}

	} 
	
	public function setNombreusuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombreusuario !== $v) {
			$this->nombreusuario = $v;
			$this->modifiedColumns[] = UsuarioPeer::NOMBREUSUARIO;
		}

	} 
	
	public function setSha1Password($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UsuarioPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UsuarioPeer::SALT;
		}

	} 
	
	public function setDni($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dni !== $v) {
			$this->dni = $v;
			$this->modifiedColumns[] = UsuarioPeer::DNI;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = UsuarioPeer::NOMBRE;
		}

	} 
	
	public function setApellidos($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->apellidos !== $v) {
			$this->apellidos = $v;
			$this->modifiedColumns[] = UsuarioPeer::APELLIDOS;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UsuarioPeer::EMAIL;
		}

	} 
	
	public function setEmailstop($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->emailstop !== $v || $v === 0) {
			$this->emailstop = $v;
			$this->modifiedColumns[] = UsuarioPeer::EMAILSTOP;
		}

	} 
	
	public function setTelefono1($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telefono1 !== $v) {
			$this->telefono1 = $v;
			$this->modifiedColumns[] = UsuarioPeer::TELEFONO1;
		}

	} 
	
	public function setTelefono2($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telefono2 !== $v) {
			$this->telefono2 = $v;
			$this->modifiedColumns[] = UsuarioPeer::TELEFONO2;
		}

	} 
	
	public function setInstitucion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->institucion !== $v) {
			$this->institucion = $v;
			$this->modifiedColumns[] = UsuarioPeer::INSTITUCION;
		}

	} 
	
	public function setDepartamento($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->departamento !== $v) {
			$this->departamento = $v;
			$this->modifiedColumns[] = UsuarioPeer::DEPARTAMENTO;
		}

	} 
	
	public function setDireccion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->direccion !== $v) {
			$this->direccion = $v;
			$this->modifiedColumns[] = UsuarioPeer::DIRECCION;
		}

	} 
	
	public function setCp($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cp !== $v) {
			$this->cp = $v;
			$this->modifiedColumns[] = UsuarioPeer::CP;
		}

	} 
	
	public function setCiudad($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ciudad !== $v) {
			$this->ciudad = $v;
			$this->modifiedColumns[] = UsuarioPeer::CIUDAD;
		}

	} 
	
	public function setPaisId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pais_id !== $v) {
			$this->pais_id = $v;
			$this->modifiedColumns[] = UsuarioPeer::PAIS_ID;
		}

		if ($this->aPais !== null && $this->aPais->getId() !== $v) {
			$this->aPais = null;
		}

	} 
	
	public function setUltimoacceso($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ultimoacceso] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ultimoacceso !== $ts) {
			$this->ultimoacceso = $ts;
			$this->modifiedColumns[] = UsuarioPeer::ULTIMOACCESO;
		}

	} 
	
	public function setUltimaip($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ultimaip !== $v) {
			$this->ultimaip = $v;
			$this->modifiedColumns[] = UsuarioPeer::ULTIMAIP;
		}

	} 
	
	public function setSecreto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secreto !== $v) {
			$this->secreto = $v;
			$this->modifiedColumns[] = UsuarioPeer::SECRETO;
		}

	} 
	
	public function setConectado($v)
	{

		if ($this->conectado !== $v) {
			$this->conectado = $v;
			$this->modifiedColumns[] = UsuarioPeer::CONECTADO;
		}

	} 
	
	public function setFoto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->foto !== $v || $v === 0) {
			$this->foto = $v;
			$this->modifiedColumns[] = UsuarioPeer::FOTO;
		}

	} 
	
	public function setMoroso($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->moroso !== $v || $v === 0) {
			$this->moroso = $v;
			$this->modifiedColumns[] = UsuarioPeer::MOROSO;
		}

	} 
	
	public function setNumconexion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->numconexion !== $v) {
			$this->numconexion = $v;
			$this->modifiedColumns[] = UsuarioPeer::NUMCONEXION;
		}

	} 
	
	public function setMatOnline($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mat_online !== $v) {
			$this->mat_online = $v;
			$this->modifiedColumns[] = UsuarioPeer::MAT_ONLINE;
		}

	} 
	
	public function setMatIp($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mat_ip !== $v) {
			$this->mat_ip = $v;
			$this->modifiedColumns[] = UsuarioPeer::MAT_IP;
		}

	} 
	
	public function setPresencial($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->presencial !== $v) {
			$this->presencial = $v;
			$this->modifiedColumns[] = UsuarioPeer::PRESENCIAL;
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
			$this->modifiedColumns[] = UsuarioPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->confirmado = $rs->getInt($startcol + 1);

			$this->borrado = $rs->getInt($startcol + 2);

			$this->nombreusuario = $rs->getString($startcol + 3);

			$this->sha1_password = $rs->getString($startcol + 4);

			$this->salt = $rs->getString($startcol + 5);

			$this->dni = $rs->getString($startcol + 6);

			$this->nombre = $rs->getString($startcol + 7);

			$this->apellidos = $rs->getString($startcol + 8);

			$this->email = $rs->getString($startcol + 9);

			$this->emailstop = $rs->getInt($startcol + 10);

			$this->telefono1 = $rs->getString($startcol + 11);

			$this->telefono2 = $rs->getString($startcol + 12);

			$this->institucion = $rs->getString($startcol + 13);

			$this->departamento = $rs->getString($startcol + 14);

			$this->direccion = $rs->getString($startcol + 15);

			$this->cp = $rs->getString($startcol + 16);

			$this->ciudad = $rs->getString($startcol + 17);

			$this->pais_id = $rs->getString($startcol + 18);

			$this->ultimoacceso = $rs->getTimestamp($startcol + 19, null);

			$this->ultimaip = $rs->getString($startcol + 20);

			$this->secreto = $rs->getString($startcol + 21);

			$this->conectado = $rs->getBoolean($startcol + 22);

			$this->foto = $rs->getInt($startcol + 23);

			$this->moroso = $rs->getInt($startcol + 24);

			$this->numconexion = $rs->getString($startcol + 25);

			$this->mat_online = $rs->getInt($startcol + 26);

			$this->mat_ip = $rs->getString($startcol + 27);

			$this->presencial = $rs->getInt($startcol + 28);

			$this->created_at = $rs->getTimestamp($startcol + 29, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 30; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UsuarioPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
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


												
			if ($this->aPais !== null) {
				if ($this->aPais->isModified()) {
					$affectedRows += $this->aPais->save($con);
				}
				$this->setPais($this->aPais);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumPosts !== null) {
				foreach($this->collsfSimpleForumPosts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPreferencia_usuarios !== null) {
				foreach($this->collPreferencia_usuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_rol_cursos !== null) {
				foreach($this->collRel_usuario_rol_cursos as $referrerFK) {
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

			if ($this->collRel_usuario_temas !== null) {
				foreach($this->collRel_usuario_temas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMensajesRelatedByIdPropietario !== null) {
				foreach($this->collMensajesRelatedByIdPropietario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMensajesRelatedByIdEmisor !== null) {
				foreach($this->collMensajesRelatedByIdEmisor as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMensajesRelatedByIdDestinatario !== null) {
				foreach($this->collMensajesRelatedByIdDestinatario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSeguimiento_mensajes !== null) {
				foreach($this->collSeguimiento_mensajes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach($this->collNotificacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMensaje_chats !== null) {
				foreach($this->collMensaje_chats as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_conectado_chats !== null) {
				foreach($this->collRel_conectado_chats as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_eventos !== null) {
				foreach($this->collRel_usuario_eventos as $referrerFK) {
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

			if ($this->collEjercicio_resueltosRelatedByIdAutor !== null) {
				foreach($this->collEjercicio_resueltosRelatedByIdAutor as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEjercicio_resueltosRelatedByIdCorrector !== null) {
				foreach($this->collEjercicio_resueltosRelatedByIdCorrector as $referrerFK) {
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

			if ($this->collRel_usuario_tareas !== null) {
				foreach($this->collRel_usuario_tareas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCalificacioness !== null) {
				foreach($this->collCalificacioness as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarios_onlines !== null) {
				foreach($this->collUsuarios_onlines as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004s !== null) {
				foreach($this->collRel_usuario_sco2004s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_learnercs !== null) {
				foreach($this->collRel_usuario_sco2004_learnercs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_lmscs !== null) {
				foreach($this->collRel_usuario_sco2004_lmscs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_interactions !== null) {
				foreach($this->collRel_usuario_sco2004_interactions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_iobjectives !== null) {
				foreach($this->collRel_usuario_sco2004_iobjectives as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_iresponses !== null) {
				foreach($this->collRel_usuario_sco2004_iresponses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco2004_objectives !== null) {
				foreach($this->collRel_usuario_sco2004_objectives as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_sco12s !== null) {
				foreach($this->collRel_usuario_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_objetivo_sco12s !== null) {
				foreach($this->collRel_usuario_objetivo_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_usuario_interaccion_sco12s !== null) {
				foreach($this->collRel_usuario_interaccion_sco12s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_interaccion_sco12_objetivos !== null) {
				foreach($this->collRel_interaccion_sco12_objetivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_interaccion_sco12_respuestas !== null) {
				foreach($this->collRel_interaccion_sco12_respuestas as $referrerFK) {
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


												
			if ($this->aPais !== null) {
				if (!$this->aPais->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPais->getValidationFailures());
				}
			}


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumPosts !== null) {
					foreach($this->collsfSimpleForumPosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPreferencia_usuarios !== null) {
					foreach($this->collPreferencia_usuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_rol_cursos !== null) {
					foreach($this->collRel_usuario_rol_cursos as $referrerFK) {
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

				if ($this->collRel_usuario_temas !== null) {
					foreach($this->collRel_usuario_temas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMensajesRelatedByIdPropietario !== null) {
					foreach($this->collMensajesRelatedByIdPropietario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMensajesRelatedByIdEmisor !== null) {
					foreach($this->collMensajesRelatedByIdEmisor as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMensajesRelatedByIdDestinatario !== null) {
					foreach($this->collMensajesRelatedByIdDestinatario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSeguimiento_mensajes !== null) {
					foreach($this->collSeguimiento_mensajes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach($this->collNotificacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMensaje_chats !== null) {
					foreach($this->collMensaje_chats as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_conectado_chats !== null) {
					foreach($this->collRel_conectado_chats as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_eventos !== null) {
					foreach($this->collRel_usuario_eventos as $referrerFK) {
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

				if ($this->collEjercicio_resueltosRelatedByIdAutor !== null) {
					foreach($this->collEjercicio_resueltosRelatedByIdAutor as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEjercicio_resueltosRelatedByIdCorrector !== null) {
					foreach($this->collEjercicio_resueltosRelatedByIdCorrector as $referrerFK) {
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

				if ($this->collRel_usuario_tareas !== null) {
					foreach($this->collRel_usuario_tareas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCalificacioness !== null) {
					foreach($this->collCalificacioness as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarios_onlines !== null) {
					foreach($this->collUsuarios_onlines as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004s !== null) {
					foreach($this->collRel_usuario_sco2004s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_learnercs !== null) {
					foreach($this->collRel_usuario_sco2004_learnercs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_lmscs !== null) {
					foreach($this->collRel_usuario_sco2004_lmscs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_interactions !== null) {
					foreach($this->collRel_usuario_sco2004_interactions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_iobjectives !== null) {
					foreach($this->collRel_usuario_sco2004_iobjectives as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_iresponses !== null) {
					foreach($this->collRel_usuario_sco2004_iresponses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco2004_objectives !== null) {
					foreach($this->collRel_usuario_sco2004_objectives as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_sco12s !== null) {
					foreach($this->collRel_usuario_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_objetivo_sco12s !== null) {
					foreach($this->collRel_usuario_objetivo_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_usuario_interaccion_sco12s !== null) {
					foreach($this->collRel_usuario_interaccion_sco12s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_interaccion_sco12_objetivos !== null) {
					foreach($this->collRel_interaccion_sco12_objetivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_interaccion_sco12_respuestas !== null) {
					foreach($this->collRel_interaccion_sco12_respuestas as $referrerFK) {
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getConfirmado();
				break;
			case 2:
				return $this->getBorrado();
				break;
			case 3:
				return $this->getNombreusuario();
				break;
			case 4:
				return $this->getSha1Password();
				break;
			case 5:
				return $this->getSalt();
				break;
			case 6:
				return $this->getDni();
				break;
			case 7:
				return $this->getNombre();
				break;
			case 8:
				return $this->getApellidos();
				break;
			case 9:
				return $this->getEmail();
				break;
			case 10:
				return $this->getEmailstop();
				break;
			case 11:
				return $this->getTelefono1();
				break;
			case 12:
				return $this->getTelefono2();
				break;
			case 13:
				return $this->getInstitucion();
				break;
			case 14:
				return $this->getDepartamento();
				break;
			case 15:
				return $this->getDireccion();
				break;
			case 16:
				return $this->getCp();
				break;
			case 17:
				return $this->getCiudad();
				break;
			case 18:
				return $this->getPaisId();
				break;
			case 19:
				return $this->getUltimoacceso();
				break;
			case 20:
				return $this->getUltimaip();
				break;
			case 21:
				return $this->getSecreto();
				break;
			case 22:
				return $this->getConectado();
				break;
			case 23:
				return $this->getFoto();
				break;
			case 24:
				return $this->getMoroso();
				break;
			case 25:
				return $this->getNumconexion();
				break;
			case 26:
				return $this->getMatOnline();
				break;
			case 27:
				return $this->getMatIp();
				break;
			case 28:
				return $this->getPresencial();
				break;
			case 29:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getConfirmado(),
			$keys[2] => $this->getBorrado(),
			$keys[3] => $this->getNombreusuario(),
			$keys[4] => $this->getSha1Password(),
			$keys[5] => $this->getSalt(),
			$keys[6] => $this->getDni(),
			$keys[7] => $this->getNombre(),
			$keys[8] => $this->getApellidos(),
			$keys[9] => $this->getEmail(),
			$keys[10] => $this->getEmailstop(),
			$keys[11] => $this->getTelefono1(),
			$keys[12] => $this->getTelefono2(),
			$keys[13] => $this->getInstitucion(),
			$keys[14] => $this->getDepartamento(),
			$keys[15] => $this->getDireccion(),
			$keys[16] => $this->getCp(),
			$keys[17] => $this->getCiudad(),
			$keys[18] => $this->getPaisId(),
			$keys[19] => $this->getUltimoacceso(),
			$keys[20] => $this->getUltimaip(),
			$keys[21] => $this->getSecreto(),
			$keys[22] => $this->getConectado(),
			$keys[23] => $this->getFoto(),
			$keys[24] => $this->getMoroso(),
			$keys[25] => $this->getNumconexion(),
			$keys[26] => $this->getMatOnline(),
			$keys[27] => $this->getMatIp(),
			$keys[28] => $this->getPresencial(),
			$keys[29] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setConfirmado($value);
				break;
			case 2:
				$this->setBorrado($value);
				break;
			case 3:
				$this->setNombreusuario($value);
				break;
			case 4:
				$this->setSha1Password($value);
				break;
			case 5:
				$this->setSalt($value);
				break;
			case 6:
				$this->setDni($value);
				break;
			case 7:
				$this->setNombre($value);
				break;
			case 8:
				$this->setApellidos($value);
				break;
			case 9:
				$this->setEmail($value);
				break;
			case 10:
				$this->setEmailstop($value);
				break;
			case 11:
				$this->setTelefono1($value);
				break;
			case 12:
				$this->setTelefono2($value);
				break;
			case 13:
				$this->setInstitucion($value);
				break;
			case 14:
				$this->setDepartamento($value);
				break;
			case 15:
				$this->setDireccion($value);
				break;
			case 16:
				$this->setCp($value);
				break;
			case 17:
				$this->setCiudad($value);
				break;
			case 18:
				$this->setPaisId($value);
				break;
			case 19:
				$this->setUltimoacceso($value);
				break;
			case 20:
				$this->setUltimaip($value);
				break;
			case 21:
				$this->setSecreto($value);
				break;
			case 22:
				$this->setConectado($value);
				break;
			case 23:
				$this->setFoto($value);
				break;
			case 24:
				$this->setMoroso($value);
				break;
			case 25:
				$this->setNumconexion($value);
				break;
			case 26:
				$this->setMatOnline($value);
				break;
			case 27:
				$this->setMatIp($value);
				break;
			case 28:
				$this->setPresencial($value);
				break;
			case 29:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConfirmado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBorrado($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombreusuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSha1Password($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDni($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNombre($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setApellidos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEmail($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEmailstop($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTelefono1($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTelefono2($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setInstitucion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDepartamento($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDireccion($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCp($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCiudad($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setPaisId($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUltimoacceso($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setUltimaip($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setSecreto($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setConectado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setFoto($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setMoroso($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setNumconexion($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setMatOnline($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setMatIp($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setPresencial($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCreatedAt($arr[$keys[29]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::ID)) $criteria->add(UsuarioPeer::ID, $this->id);
		if ($this->isColumnModified(UsuarioPeer::CONFIRMADO)) $criteria->add(UsuarioPeer::CONFIRMADO, $this->confirmado);
		if ($this->isColumnModified(UsuarioPeer::BORRADO)) $criteria->add(UsuarioPeer::BORRADO, $this->borrado);
		if ($this->isColumnModified(UsuarioPeer::NOMBREUSUARIO)) $criteria->add(UsuarioPeer::NOMBREUSUARIO, $this->nombreusuario);
		if ($this->isColumnModified(UsuarioPeer::SHA1_PASSWORD)) $criteria->add(UsuarioPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UsuarioPeer::SALT)) $criteria->add(UsuarioPeer::SALT, $this->salt);
		if ($this->isColumnModified(UsuarioPeer::DNI)) $criteria->add(UsuarioPeer::DNI, $this->dni);
		if ($this->isColumnModified(UsuarioPeer::NOMBRE)) $criteria->add(UsuarioPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(UsuarioPeer::APELLIDOS)) $criteria->add(UsuarioPeer::APELLIDOS, $this->apellidos);
		if ($this->isColumnModified(UsuarioPeer::EMAIL)) $criteria->add(UsuarioPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UsuarioPeer::EMAILSTOP)) $criteria->add(UsuarioPeer::EMAILSTOP, $this->emailstop);
		if ($this->isColumnModified(UsuarioPeer::TELEFONO1)) $criteria->add(UsuarioPeer::TELEFONO1, $this->telefono1);
		if ($this->isColumnModified(UsuarioPeer::TELEFONO2)) $criteria->add(UsuarioPeer::TELEFONO2, $this->telefono2);
		if ($this->isColumnModified(UsuarioPeer::INSTITUCION)) $criteria->add(UsuarioPeer::INSTITUCION, $this->institucion);
		if ($this->isColumnModified(UsuarioPeer::DEPARTAMENTO)) $criteria->add(UsuarioPeer::DEPARTAMENTO, $this->departamento);
		if ($this->isColumnModified(UsuarioPeer::DIRECCION)) $criteria->add(UsuarioPeer::DIRECCION, $this->direccion);
		if ($this->isColumnModified(UsuarioPeer::CP)) $criteria->add(UsuarioPeer::CP, $this->cp);
		if ($this->isColumnModified(UsuarioPeer::CIUDAD)) $criteria->add(UsuarioPeer::CIUDAD, $this->ciudad);
		if ($this->isColumnModified(UsuarioPeer::PAIS_ID)) $criteria->add(UsuarioPeer::PAIS_ID, $this->pais_id);
		if ($this->isColumnModified(UsuarioPeer::ULTIMOACCESO)) $criteria->add(UsuarioPeer::ULTIMOACCESO, $this->ultimoacceso);
		if ($this->isColumnModified(UsuarioPeer::ULTIMAIP)) $criteria->add(UsuarioPeer::ULTIMAIP, $this->ultimaip);
		if ($this->isColumnModified(UsuarioPeer::SECRETO)) $criteria->add(UsuarioPeer::SECRETO, $this->secreto);
		if ($this->isColumnModified(UsuarioPeer::CONECTADO)) $criteria->add(UsuarioPeer::CONECTADO, $this->conectado);
		if ($this->isColumnModified(UsuarioPeer::FOTO)) $criteria->add(UsuarioPeer::FOTO, $this->foto);
		if ($this->isColumnModified(UsuarioPeer::MOROSO)) $criteria->add(UsuarioPeer::MOROSO, $this->moroso);
		if ($this->isColumnModified(UsuarioPeer::NUMCONEXION)) $criteria->add(UsuarioPeer::NUMCONEXION, $this->numconexion);
		if ($this->isColumnModified(UsuarioPeer::MAT_ONLINE)) $criteria->add(UsuarioPeer::MAT_ONLINE, $this->mat_online);
		if ($this->isColumnModified(UsuarioPeer::MAT_IP)) $criteria->add(UsuarioPeer::MAT_IP, $this->mat_ip);
		if ($this->isColumnModified(UsuarioPeer::PRESENCIAL)) $criteria->add(UsuarioPeer::PRESENCIAL, $this->presencial);
		if ($this->isColumnModified(UsuarioPeer::CREATED_AT)) $criteria->add(UsuarioPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::ID, $this->id);

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

		$copyObj->setConfirmado($this->confirmado);

		$copyObj->setBorrado($this->borrado);

		$copyObj->setNombreusuario($this->nombreusuario);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setDni($this->dni);

		$copyObj->setNombre($this->nombre);

		$copyObj->setApellidos($this->apellidos);

		$copyObj->setEmail($this->email);

		$copyObj->setEmailstop($this->emailstop);

		$copyObj->setTelefono1($this->telefono1);

		$copyObj->setTelefono2($this->telefono2);

		$copyObj->setInstitucion($this->institucion);

		$copyObj->setDepartamento($this->departamento);

		$copyObj->setDireccion($this->direccion);

		$copyObj->setCp($this->cp);

		$copyObj->setCiudad($this->ciudad);

		$copyObj->setPaisId($this->pais_id);

		$copyObj->setUltimoacceso($this->ultimoacceso);

		$copyObj->setUltimaip($this->ultimaip);

		$copyObj->setSecreto($this->secreto);

		$copyObj->setConectado($this->conectado);

		$copyObj->setFoto($this->foto);

		$copyObj->setMoroso($this->moroso);

		$copyObj->setNumconexion($this->numconexion);

		$copyObj->setMatOnline($this->mat_online);

		$copyObj->setMatIp($this->mat_ip);

		$copyObj->setPresencial($this->presencial);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumPosts() as $relObj) {
				$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
			}

			foreach($this->getPreferencia_usuarios() as $relObj) {
				$copyObj->addPreferencia_usuario($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_rol_cursos() as $relObj) {
				$copyObj->addRel_usuario_rol_curso($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_paquetes() as $relObj) {
				$copyObj->addRel_usuario_paquete($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_temas() as $relObj) {
				$copyObj->addRel_usuario_tema($relObj->copy($deepCopy));
			}

			foreach($this->getMensajesRelatedByIdPropietario() as $relObj) {
				$copyObj->addMensajeRelatedByIdPropietario($relObj->copy($deepCopy));
			}

			foreach($this->getMensajesRelatedByIdEmisor() as $relObj) {
				$copyObj->addMensajeRelatedByIdEmisor($relObj->copy($deepCopy));
			}

			foreach($this->getMensajesRelatedByIdDestinatario() as $relObj) {
				$copyObj->addMensajeRelatedByIdDestinatario($relObj->copy($deepCopy));
			}

			foreach($this->getSeguimiento_mensajes() as $relObj) {
				$copyObj->addSeguimiento_mensaje($relObj->copy($deepCopy));
			}

			foreach($this->getNotificacions() as $relObj) {
				$copyObj->addNotificacion($relObj->copy($deepCopy));
			}

			foreach($this->getMensaje_chats() as $relObj) {
				$copyObj->addMensaje_chat($relObj->copy($deepCopy));
			}

			foreach($this->getRel_conectado_chats() as $relObj) {
				$copyObj->addRel_conectado_chat($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_eventos() as $relObj) {
				$copyObj->addRel_usuario_evento($relObj->copy($deepCopy));
			}

			foreach($this->getEjercicios() as $relObj) {
				$copyObj->addEjercicio($relObj->copy($deepCopy));
			}

			foreach($this->getEjercicio_resueltosRelatedByIdAutor() as $relObj) {
				$copyObj->addEjercicio_resueltoRelatedByIdAutor($relObj->copy($deepCopy));
			}

			foreach($this->getEjercicio_resueltosRelatedByIdCorrector() as $relObj) {
				$copyObj->addEjercicio_resueltoRelatedByIdCorrector($relObj->copy($deepCopy));
			}

			foreach($this->getTareas() as $relObj) {
				$copyObj->addTarea($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_tareas() as $relObj) {
				$copyObj->addRel_usuario_tarea($relObj->copy($deepCopy));
			}

			foreach($this->getCalificacioness() as $relObj) {
				$copyObj->addCalificaciones($relObj->copy($deepCopy));
			}

			foreach($this->getUsuarios_onlines() as $relObj) {
				$copyObj->addUsuarios_online($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004s() as $relObj) {
				$copyObj->addRel_usuario_sco2004($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_learnercs() as $relObj) {
				$copyObj->addRel_usuario_sco2004_learnerc($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_lmscs() as $relObj) {
				$copyObj->addRel_usuario_sco2004_lmsc($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_interactions() as $relObj) {
				$copyObj->addRel_usuario_sco2004_interaction($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_iobjectives() as $relObj) {
				$copyObj->addRel_usuario_sco2004_iobjective($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_iresponses() as $relObj) {
				$copyObj->addRel_usuario_sco2004_iresponse($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco2004_objectives() as $relObj) {
				$copyObj->addRel_usuario_sco2004_objective($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_sco12s() as $relObj) {
				$copyObj->addRel_usuario_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_objetivo_sco12s() as $relObj) {
				$copyObj->addRel_usuario_objetivo_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_interaccion_sco12s() as $relObj) {
				$copyObj->addRel_usuario_interaccion_sco12($relObj->copy($deepCopy));
			}

			foreach($this->getRel_interaccion_sco12_objetivos() as $relObj) {
				$copyObj->addRel_interaccion_sco12_objetivo($relObj->copy($deepCopy));
			}

			foreach($this->getRel_interaccion_sco12_respuestas() as $relObj) {
				$copyObj->addRel_interaccion_sco12_respuesta($relObj->copy($deepCopy));
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
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	
	public function setPais($v)
	{


		if ($v === null) {
			$this->setPaisId(NULL);
		} else {
			$this->setPaisId($v->getId());
		}


		$this->aPais = $v;
	}


	
	public function getPais($con = null)
	{
		if ($this->aPais === null && (($this->pais_id !== "" && $this->pais_id !== null))) {
						include_once 'lib/model/om/BasePaisPeer.php';

			$this->aPais = PaisPeer::retrieveByPK($this->pais_id, $con);

			
		}
		return $this->aPais;
	}

	
	public function initsfSimpleForumPosts()
	{
		if ($this->collsfSimpleForumPosts === null) {
			$this->collsfSimpleForumPosts = array();
		}
	}

	
	public function getsfSimpleForumPosts($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
					$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;
		return $this->collsfSimpleForumPosts;
	}

	
	public function countsfSimpleForumPosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPosts[] = $l;
		$l->setUsuario($this);
	}


	
	public function getsfSimpleForumPostsJoinsfSimpleForumForum($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


	
	public function getsfSimpleForumPostsJoinsfSimpleForumPostRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumPostRelatedByParentId($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumPostRelatedByParentId($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}

	
	public function initPreferencia_usuarios()
	{
		if ($this->collPreferencia_usuarios === null) {
			$this->collPreferencia_usuarios = array();
		}
	}

	
	public function getPreferencia_usuarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePreferencia_usuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPreferencia_usuarios === null) {
			if ($this->isNew()) {
			   $this->collPreferencia_usuarios = array();
			} else {

				$criteria->add(Preferencia_usuarioPeer::USUARIO_ID, $this->getId());

				Preferencia_usuarioPeer::addSelectColumns($criteria);
				$this->collPreferencia_usuarios = Preferencia_usuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Preferencia_usuarioPeer::USUARIO_ID, $this->getId());

				Preferencia_usuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastPreferencia_usuarioCriteria) || !$this->lastPreferencia_usuarioCriteria->equals($criteria)) {
					$this->collPreferencia_usuarios = Preferencia_usuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPreferencia_usuarioCriteria = $criteria;
		return $this->collPreferencia_usuarios;
	}

	
	public function countPreferencia_usuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePreferencia_usuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Preferencia_usuarioPeer::USUARIO_ID, $this->getId());

		return Preferencia_usuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPreferencia_usuario(Preferencia_usuario $l)
	{
		$this->collPreferencia_usuarios[] = $l;
		$l->setUsuario($this);
	}

	
	public function initRel_usuario_rol_cursos()
	{
		if ($this->collRel_usuario_rol_cursos === null) {
			$this->collRel_usuario_rol_cursos = array();
		}
	}

	
	public function getRel_usuario_rol_cursos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

				Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

				Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
					$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;
		return $this->collRel_usuario_rol_cursos;
	}

	
	public function countRel_usuario_rol_cursos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_rol_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_rol_curso(Rel_usuario_rol_curso $l)
	{
		$this->collRel_usuario_rol_cursos[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_rol_cursosJoinRol($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
	}


	
	public function getRel_usuario_rol_cursosJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_rol_cursoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_rol_cursos === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_rol_cursos = array();
			} else {

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
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

				$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getId());

				Rel_usuario_paquetePeer::addSelectColumns($criteria);
				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getId());

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

		$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getId());

		return Rel_usuario_paquetePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_paquete(Rel_usuario_paquete $l)
	{
		$this->collRel_usuario_paquetes[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_paquetesJoinPaquete($criteria = null, $con = null)
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

				$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelectJoinPaquete($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_paqueteCriteria) || !$this->lastRel_usuario_paqueteCriteria->equals($criteria)) {
				$this->collRel_usuario_paquetes = Rel_usuario_paquetePeer::doSelectJoinPaquete($criteria, $con);
			}
		}
		$this->lastRel_usuario_paqueteCriteria = $criteria;

		return $this->collRel_usuario_paquetes;
	}

	
	public function initRel_usuario_temas()
	{
		if ($this->collRel_usuario_temas === null) {
			$this->collRel_usuario_temas = array();
		}
	}

	
	public function getRel_usuario_temas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_temas === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_temas = array();
			} else {

				$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getId());

				Rel_usuario_temaPeer::addSelectColumns($criteria);
				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getId());

				Rel_usuario_temaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_temaCriteria) || !$this->lastRel_usuario_temaCriteria->equals($criteria)) {
					$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_temaCriteria = $criteria;
		return $this->collRel_usuario_temas;
	}

	
	public function countRel_usuario_temas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_temaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_tema(Rel_usuario_tema $l)
	{
		$this->collRel_usuario_temas[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_temasJoinTema($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_temas === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_temas = array();
			} else {

				$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelectJoinTema($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_temaCriteria) || !$this->lastRel_usuario_temaCriteria->equals($criteria)) {
				$this->collRel_usuario_temas = Rel_usuario_temaPeer::doSelectJoinTema($criteria, $con);
			}
		}
		$this->lastRel_usuario_temaCriteria = $criteria;

		return $this->collRel_usuario_temas;
	}

	
	public function initMensajesRelatedByIdPropietario()
	{
		if ($this->collMensajesRelatedByIdPropietario === null) {
			$this->collMensajesRelatedByIdPropietario = array();
		}
	}

	
	public function getMensajesRelatedByIdPropietario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdPropietario === null) {
			if ($this->isNew()) {
			   $this->collMensajesRelatedByIdPropietario = array();
			} else {

				$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastMensajeRelatedByIdPropietarioCriteria) || !$this->lastMensajeRelatedByIdPropietarioCriteria->equals($criteria)) {
					$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensajeRelatedByIdPropietarioCriteria = $criteria;
		return $this->collMensajesRelatedByIdPropietario;
	}

	
	public function countMensajesRelatedByIdPropietario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

		return MensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensajeRelatedByIdPropietario(Mensaje $l)
	{
		$this->collMensajesRelatedByIdPropietario[] = $l;
		$l->setUsuarioRelatedByIdPropietario($this);
	}


	
	public function getMensajesRelatedByIdPropietarioJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdPropietario === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdPropietario = array();
			} else {

				$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

				$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdPropietarioCriteria) || !$this->lastMensajeRelatedByIdPropietarioCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdPropietarioCriteria = $criteria;

		return $this->collMensajesRelatedByIdPropietario;
	}


	
	public function getMensajesRelatedByIdPropietarioJoinAsunto_mensaje($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdPropietario === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdPropietario = array();
			} else {

				$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

				$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_PROPIETARIO, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdPropietarioCriteria) || !$this->lastMensajeRelatedByIdPropietarioCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdPropietario = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdPropietarioCriteria = $criteria;

		return $this->collMensajesRelatedByIdPropietario;
	}

	
	public function initMensajesRelatedByIdEmisor()
	{
		if ($this->collMensajesRelatedByIdEmisor === null) {
			$this->collMensajesRelatedByIdEmisor = array();
		}
	}

	
	public function getMensajesRelatedByIdEmisor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdEmisor === null) {
			if ($this->isNew()) {
			   $this->collMensajesRelatedByIdEmisor = array();
			} else {

				$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastMensajeRelatedByIdEmisorCriteria) || !$this->lastMensajeRelatedByIdEmisorCriteria->equals($criteria)) {
					$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensajeRelatedByIdEmisorCriteria = $criteria;
		return $this->collMensajesRelatedByIdEmisor;
	}

	
	public function countMensajesRelatedByIdEmisor($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

		return MensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensajeRelatedByIdEmisor(Mensaje $l)
	{
		$this->collMensajesRelatedByIdEmisor[] = $l;
		$l->setUsuarioRelatedByIdEmisor($this);
	}


	
	public function getMensajesRelatedByIdEmisorJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdEmisor === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdEmisor = array();
			} else {

				$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

				$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdEmisorCriteria) || !$this->lastMensajeRelatedByIdEmisorCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdEmisorCriteria = $criteria;

		return $this->collMensajesRelatedByIdEmisor;
	}


	
	public function getMensajesRelatedByIdEmisorJoinAsunto_mensaje($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdEmisor === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdEmisor = array();
			} else {

				$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

				$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_EMISOR, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdEmisorCriteria) || !$this->lastMensajeRelatedByIdEmisorCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdEmisor = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdEmisorCriteria = $criteria;

		return $this->collMensajesRelatedByIdEmisor;
	}

	
	public function initMensajesRelatedByIdDestinatario()
	{
		if ($this->collMensajesRelatedByIdDestinatario === null) {
			$this->collMensajesRelatedByIdDestinatario = array();
		}
	}

	
	public function getMensajesRelatedByIdDestinatario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdDestinatario === null) {
			if ($this->isNew()) {
			   $this->collMensajesRelatedByIdDestinatario = array();
			} else {

				$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastMensajeRelatedByIdDestinatarioCriteria) || !$this->lastMensajeRelatedByIdDestinatarioCriteria->equals($criteria)) {
					$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensajeRelatedByIdDestinatarioCriteria = $criteria;
		return $this->collMensajesRelatedByIdDestinatario;
	}

	
	public function countMensajesRelatedByIdDestinatario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

		return MensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensajeRelatedByIdDestinatario(Mensaje $l)
	{
		$this->collMensajesRelatedByIdDestinatario[] = $l;
		$l->setUsuarioRelatedByIdDestinatario($this);
	}


	
	public function getMensajesRelatedByIdDestinatarioJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdDestinatario === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdDestinatario = array();
			} else {

				$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

				$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdDestinatarioCriteria) || !$this->lastMensajeRelatedByIdDestinatarioCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdDestinatarioCriteria = $criteria;

		return $this->collMensajesRelatedByIdDestinatario;
	}


	
	public function getMensajesRelatedByIdDestinatarioJoinAsunto_mensaje($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajesRelatedByIdDestinatario === null) {
			if ($this->isNew()) {
				$this->collMensajesRelatedByIdDestinatario = array();
			} else {

				$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

				$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_DESTINATARIO, $this->getId());

			if (!isset($this->lastMensajeRelatedByIdDestinatarioCriteria) || !$this->lastMensajeRelatedByIdDestinatarioCriteria->equals($criteria)) {
				$this->collMensajesRelatedByIdDestinatario = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		}
		$this->lastMensajeRelatedByIdDestinatarioCriteria = $criteria;

		return $this->collMensajesRelatedByIdDestinatario;
	}

	
	public function initSeguimiento_mensajes()
	{
		if ($this->collSeguimiento_mensajes === null) {
			$this->collSeguimiento_mensajes = array();
		}
	}

	
	public function getSeguimiento_mensajes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSeguimiento_mensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSeguimiento_mensajes === null) {
			if ($this->isNew()) {
			   $this->collSeguimiento_mensajes = array();
			} else {

				$criteria->add(Seguimiento_mensajePeer::ID_PROFESOR, $this->getId());

				Seguimiento_mensajePeer::addSelectColumns($criteria);
				$this->collSeguimiento_mensajes = Seguimiento_mensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Seguimiento_mensajePeer::ID_PROFESOR, $this->getId());

				Seguimiento_mensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastSeguimiento_mensajeCriteria) || !$this->lastSeguimiento_mensajeCriteria->equals($criteria)) {
					$this->collSeguimiento_mensajes = Seguimiento_mensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSeguimiento_mensajeCriteria = $criteria;
		return $this->collSeguimiento_mensajes;
	}

	
	public function countSeguimiento_mensajes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSeguimiento_mensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Seguimiento_mensajePeer::ID_PROFESOR, $this->getId());

		return Seguimiento_mensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSeguimiento_mensaje(Seguimiento_mensaje $l)
	{
		$this->collSeguimiento_mensajes[] = $l;
		$l->setUsuario($this);
	}

	
	public function initNotificacions()
	{
		if ($this->collNotificacions === null) {
			$this->collNotificacions = array();
		}
	}

	
	public function getNotificacions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	
	public function countNotificacions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

		return NotificacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotificacion(Notificacion $l)
	{
		$this->collNotificacions[] = $l;
		$l->setUsuario($this);
	}


	
	public function getNotificacionsJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}


	
	public function getNotificacionsJoinTema($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinTema($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinTema($criteria, $con);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}

	
	public function initMensaje_chats()
	{
		if ($this->collMensaje_chats === null) {
			$this->collMensaje_chats = array();
		}
	}

	
	public function getMensaje_chats($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensaje_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensaje_chats === null) {
			if ($this->isNew()) {
			   $this->collMensaje_chats = array();
			} else {

				$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->getId());

				Mensaje_chatPeer::addSelectColumns($criteria);
				$this->collMensaje_chats = Mensaje_chatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->getId());

				Mensaje_chatPeer::addSelectColumns($criteria);
				if (!isset($this->lastMensaje_chatCriteria) || !$this->lastMensaje_chatCriteria->equals($criteria)) {
					$this->collMensaje_chats = Mensaje_chatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensaje_chatCriteria = $criteria;
		return $this->collMensaje_chats;
	}

	
	public function countMensaje_chats($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensaje_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->getId());

		return Mensaje_chatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensaje_chat(Mensaje_chat $l)
	{
		$this->collMensaje_chats[] = $l;
		$l->setUsuario($this);
	}


	
	public function getMensaje_chatsJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensaje_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensaje_chats === null) {
			if ($this->isNew()) {
				$this->collMensaje_chats = array();
			} else {

				$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->getId());

				$this->collMensaje_chats = Mensaje_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Mensaje_chatPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastMensaje_chatCriteria) || !$this->lastMensaje_chatCriteria->equals($criteria)) {
				$this->collMensaje_chats = Mensaje_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastMensaje_chatCriteria = $criteria;

		return $this->collMensaje_chats;
	}

	
	public function initRel_conectado_chats()
	{
		if ($this->collRel_conectado_chats === null) {
			$this->collRel_conectado_chats = array();
		}
	}

	
	public function getRel_conectado_chats($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
			   $this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

				Rel_conectado_chatPeer::addSelectColumns($criteria);
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

				Rel_conectado_chatPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
					$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;
		return $this->collRel_conectado_chats;
	}

	
	public function countRel_conectado_chats($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

		return Rel_conectado_chatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_conectado_chat(Rel_conectado_chat $l)
	{
		$this->collRel_conectado_chats[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_conectado_chatsJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
				$this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;

		return $this->collRel_conectado_chats;
	}


	
	public function getRel_conectado_chatsJoinRol($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_conectado_chatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_conectado_chats === null) {
			if ($this->isNew()) {
				$this->collRel_conectado_chats = array();
			} else {

				$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;

		return $this->collRel_conectado_chats;
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

				$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getId());

				Rel_usuario_eventoPeer::addSelectColumns($criteria);
				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getId());

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

		$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_eventoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_evento(Rel_usuario_evento $l)
	{
		$this->collRel_usuario_eventos[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_eventosJoinEvento($criteria = null, $con = null)
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

				$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelectJoinEvento($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_eventoCriteria) || !$this->lastRel_usuario_eventoCriteria->equals($criteria)) {
				$this->collRel_usuario_eventos = Rel_usuario_eventoPeer::doSelectJoinEvento($criteria, $con);
			}
		}
		$this->lastRel_usuario_eventoCriteria = $criteria;

		return $this->collRel_usuario_eventos;
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

				$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

				EjercicioPeer::addSelectColumns($criteria);
				$this->collEjercicios = EjercicioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

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

		$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

		return EjercicioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio(Ejercicio $l)
	{
		$this->collEjercicios[] = $l;
		$l->setUsuario($this);
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

				$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinMateria($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinMateria($criteria, $con);
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

				$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

				$this->collEjercicios = EjercicioPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(EjercicioPeer::ID_AUTOR, $this->getId());

			if (!isset($this->lastEjercicioCriteria) || !$this->lastEjercicioCriteria->equals($criteria)) {
				$this->collEjercicios = EjercicioPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastEjercicioCriteria = $criteria;

		return $this->collEjercicios;
	}

	
	public function initEjercicio_resueltosRelatedByIdAutor()
	{
		if ($this->collEjercicio_resueltosRelatedByIdAutor === null) {
			$this->collEjercicio_resueltosRelatedByIdAutor = array();
		}
	}

	
	public function getEjercicio_resueltosRelatedByIdAutor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltosRelatedByIdAutor === null) {
			if ($this->isNew()) {
			   $this->collEjercicio_resueltosRelatedByIdAutor = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				$this->collEjercicio_resueltosRelatedByIdAutor = Ejercicio_resueltoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEjercicio_resueltoRelatedByIdAutorCriteria) || !$this->lastEjercicio_resueltoRelatedByIdAutorCriteria->equals($criteria)) {
					$this->collEjercicio_resueltosRelatedByIdAutor = Ejercicio_resueltoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEjercicio_resueltoRelatedByIdAutorCriteria = $criteria;
		return $this->collEjercicio_resueltosRelatedByIdAutor;
	}

	
	public function countEjercicio_resueltosRelatedByIdAutor($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());

		return Ejercicio_resueltoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio_resueltoRelatedByIdAutor(Ejercicio_resuelto $l)
	{
		$this->collEjercicio_resueltosRelatedByIdAutor[] = $l;
		$l->setUsuarioRelatedByIdAutor($this);
	}


	
	public function getEjercicio_resueltosRelatedByIdAutorJoinEjercicio($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltosRelatedByIdAutor === null) {
			if ($this->isNew()) {
				$this->collEjercicio_resueltosRelatedByIdAutor = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());

				$this->collEjercicio_resueltosRelatedByIdAutor = Ejercicio_resueltoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());

			if (!isset($this->lastEjercicio_resueltoRelatedByIdAutorCriteria) || !$this->lastEjercicio_resueltoRelatedByIdAutorCriteria->equals($criteria)) {
				$this->collEjercicio_resueltosRelatedByIdAutor = Ejercicio_resueltoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		}
		$this->lastEjercicio_resueltoRelatedByIdAutorCriteria = $criteria;

		return $this->collEjercicio_resueltosRelatedByIdAutor;
	}

	
	public function initEjercicio_resueltosRelatedByIdCorrector()
	{
		if ($this->collEjercicio_resueltosRelatedByIdCorrector === null) {
			$this->collEjercicio_resueltosRelatedByIdCorrector = array();
		}
	}

	
	public function getEjercicio_resueltosRelatedByIdCorrector($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltosRelatedByIdCorrector === null) {
			if ($this->isNew()) {
			   $this->collEjercicio_resueltosRelatedByIdCorrector = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				$this->collEjercicio_resueltosRelatedByIdCorrector = Ejercicio_resueltoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->getId());

				Ejercicio_resueltoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria) || !$this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria->equals($criteria)) {
					$this->collEjercicio_resueltosRelatedByIdCorrector = Ejercicio_resueltoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria = $criteria;
		return $this->collEjercicio_resueltosRelatedByIdCorrector;
	}

	
	public function countEjercicio_resueltosRelatedByIdCorrector($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->getId());

		return Ejercicio_resueltoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEjercicio_resueltoRelatedByIdCorrector(Ejercicio_resuelto $l)
	{
		$this->collEjercicio_resueltosRelatedByIdCorrector[] = $l;
		$l->setUsuarioRelatedByIdCorrector($this);
	}


	
	public function getEjercicio_resueltosRelatedByIdCorrectorJoinEjercicio($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEjercicio_resueltoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEjercicio_resueltosRelatedByIdCorrector === null) {
			if ($this->isNew()) {
				$this->collEjercicio_resueltosRelatedByIdCorrector = array();
			} else {

				$criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->getId());

				$this->collEjercicio_resueltosRelatedByIdCorrector = Ejercicio_resueltoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(Ejercicio_resueltoPeer::ID_CORRECTOR, $this->getId());

			if (!isset($this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria) || !$this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria->equals($criteria)) {
				$this->collEjercicio_resueltosRelatedByIdCorrector = Ejercicio_resueltoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		}
		$this->lastEjercicio_resueltoRelatedByIdCorrectorCriteria = $criteria;

		return $this->collEjercicio_resueltosRelatedByIdCorrector;
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

				$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

				TareaPeer::addSelectColumns($criteria);
				$this->collTareas = TareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

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

		$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

		return TareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTarea(Tarea $l)
	{
		$this->collTareas[] = $l;
		$l->setUsuario($this);
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

				$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

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

				$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinEjercicio($criteria, $con);
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

				$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_AUTOR, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
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

				$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

				Rel_usuario_tareaPeer::addSelectColumns($criteria);
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

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

		$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_tareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_tarea(Rel_usuario_tarea $l)
	{
		$this->collRel_usuario_tareas[] = $l;
		$l->setUsuario($this);
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

				$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinTarea($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinTarea($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}


	
	public function getRel_usuario_tareasJoinEjercicio_resuelto($criteria = null, $con = null)
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

				$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_tareaCriteria) || !$this->lastRel_usuario_tareaCriteria->equals($criteria)) {
				$this->collRel_usuario_tareas = Rel_usuario_tareaPeer::doSelectJoinEjercicio_resuelto($criteria, $con);
			}
		}
		$this->lastRel_usuario_tareaCriteria = $criteria;

		return $this->collRel_usuario_tareas;
	}

	
	public function initCalificacioness()
	{
		if ($this->collCalificacioness === null) {
			$this->collCalificacioness = array();
		}
	}

	
	public function getCalificacioness($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCalificacionesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCalificacioness === null) {
			if ($this->isNew()) {
			   $this->collCalificacioness = array();
			} else {

				$criteria->add(CalificacionesPeer::ID_USUARIO, $this->getId());

				CalificacionesPeer::addSelectColumns($criteria);
				$this->collCalificacioness = CalificacionesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CalificacionesPeer::ID_USUARIO, $this->getId());

				CalificacionesPeer::addSelectColumns($criteria);
				if (!isset($this->lastCalificacionesCriteria) || !$this->lastCalificacionesCriteria->equals($criteria)) {
					$this->collCalificacioness = CalificacionesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCalificacionesCriteria = $criteria;
		return $this->collCalificacioness;
	}

	
	public function countCalificacioness($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCalificacionesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CalificacionesPeer::ID_USUARIO, $this->getId());

		return CalificacionesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCalificaciones(Calificaciones $l)
	{
		$this->collCalificacioness[] = $l;
		$l->setUsuario($this);
	}


	
	public function getCalificacionessJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCalificacionesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCalificacioness === null) {
			if ($this->isNew()) {
				$this->collCalificacioness = array();
			} else {

				$criteria->add(CalificacionesPeer::ID_USUARIO, $this->getId());

				$this->collCalificacioness = CalificacionesPeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(CalificacionesPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastCalificacionesCriteria) || !$this->lastCalificacionesCriteria->equals($criteria)) {
				$this->collCalificacioness = CalificacionesPeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastCalificacionesCriteria = $criteria;

		return $this->collCalificacioness;
	}

	
	public function initUsuarios_onlines()
	{
		if ($this->collUsuarios_onlines === null) {
			$this->collUsuarios_onlines = array();
		}
	}

	
	public function getUsuarios_onlines($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
			   $this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

				Usuarios_onlinePeer::addSelectColumns($criteria);
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

				Usuarios_onlinePeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
					$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;
		return $this->collUsuarios_onlines;
	}

	
	public function countUsuarios_onlines($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

		return Usuarios_onlinePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuarios_online(Usuarios_online $l)
	{
		$this->collUsuarios_onlines[] = $l;
		$l->setUsuario($this);
	}


	
	public function getUsuarios_onlinesJoinCurso($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
				$this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinCurso($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinCurso($criteria, $con);
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;

		return $this->collUsuarios_onlines;
	}


	
	public function getUsuarios_onlinesJoinRol($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarios_onlinePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios_onlines === null) {
			if ($this->isNew()) {
				$this->collUsuarios_onlines = array();
			} else {

				$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;

		return $this->collUsuarios_onlines;
	}

	
	public function initRel_usuario_sco2004s()
	{
		if ($this->collRel_usuario_sco2004s === null) {
			$this->collRel_usuario_sco2004s = array();
		}
	}

	
	public function getRel_usuario_sco2004s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004s = array();
			} else {

				$criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004Peer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004Criteria) || !$this->lastRel_usuario_sco2004Criteria->equals($criteria)) {
					$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004Criteria = $criteria;
		return $this->collRel_usuario_sco2004s;
	}

	
	public function countRel_usuario_sco2004s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004(Rel_usuario_sco2004 $l)
	{
		$this->collRel_usuario_sco2004s[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004sJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004s = array();
			} else {

				$criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004Peer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004Criteria) || !$this->lastRel_usuario_sco2004Criteria->equals($criteria)) {
				$this->collRel_usuario_sco2004s = Rel_usuario_sco2004Peer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004Criteria = $criteria;

		return $this->collRel_usuario_sco2004s;
	}

	
	public function initRel_usuario_sco2004_learnercs()
	{
		if ($this->collRel_usuario_sco2004_learnercs === null) {
			$this->collRel_usuario_sco2004_learnercs = array();
		}
	}

	
	public function getRel_usuario_sco2004_learnercs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_learnercs === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_learnercs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_learnercPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_learnercPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_learnercCriteria) || !$this->lastRel_usuario_sco2004_learnercCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_learnercCriteria = $criteria;
		return $this->collRel_usuario_sco2004_learnercs;
	}

	
	public function countRel_usuario_sco2004_learnercs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_learnercPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_learnerc(Rel_usuario_sco2004_learnerc $l)
	{
		$this->collRel_usuario_sco2004_learnercs[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_learnercsJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_learnercPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_learnercs === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_learnercs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_learnercCriteria) || !$this->lastRel_usuario_sco2004_learnercCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_learnercs = Rel_usuario_sco2004_learnercPeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_learnercCriteria = $criteria;

		return $this->collRel_usuario_sco2004_learnercs;
	}

	
	public function initRel_usuario_sco2004_lmscs()
	{
		if ($this->collRel_usuario_sco2004_lmscs === null) {
			$this->collRel_usuario_sco2004_lmscs = array();
		}
	}

	
	public function getRel_usuario_sco2004_lmscs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_lmscs === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_lmscs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_lmscPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_lmscPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_lmscCriteria) || !$this->lastRel_usuario_sco2004_lmscCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_lmscCriteria = $criteria;
		return $this->collRel_usuario_sco2004_lmscs;
	}

	
	public function countRel_usuario_sco2004_lmscs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_lmscPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_lmsc(Rel_usuario_sco2004_lmsc $l)
	{
		$this->collRel_usuario_sco2004_lmscs[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_lmscsJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_lmscPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_lmscs === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_lmscs = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_lmscCriteria) || !$this->lastRel_usuario_sco2004_lmscCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_lmscs = Rel_usuario_sco2004_lmscPeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_lmscCriteria = $criteria;

		return $this->collRel_usuario_sco2004_lmscs;
	}

	
	public function initRel_usuario_sco2004_interactions()
	{
		if ($this->collRel_usuario_sco2004_interactions === null) {
			$this->collRel_usuario_sco2004_interactions = array();
		}
	}

	
	public function getRel_usuario_sco2004_interactions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_interactions === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_interactions = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_interactionPeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_interactionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_interactionCriteria) || !$this->lastRel_usuario_sco2004_interactionCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_interactionCriteria = $criteria;
		return $this->collRel_usuario_sco2004_interactions;
	}

	
	public function countRel_usuario_sco2004_interactions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_interactionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_interaction(Rel_usuario_sco2004_interaction $l)
	{
		$this->collRel_usuario_sco2004_interactions[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_interactionsJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_interactionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_interactions === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_interactions = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_interactionCriteria) || !$this->lastRel_usuario_sco2004_interactionCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_interactions = Rel_usuario_sco2004_interactionPeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_interactionCriteria = $criteria;

		return $this->collRel_usuario_sco2004_interactions;
	}

	
	public function initRel_usuario_sco2004_iobjectives()
	{
		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			$this->collRel_usuario_sco2004_iobjectives = array();
		}
	}

	
	public function getRel_usuario_sco2004_iobjectives($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_iobjectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_iobjectivePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_iobjectivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_iobjectiveCriteria) || !$this->lastRel_usuario_sco2004_iobjectiveCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_iobjectiveCriteria = $criteria;
		return $this->collRel_usuario_sco2004_iobjectives;
	}

	
	public function countRel_usuario_sco2004_iobjectives($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_iobjectivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_iobjective(Rel_usuario_sco2004_iobjective $l)
	{
		$this->collRel_usuario_sco2004_iobjectives[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_iobjectivesJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iobjectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iobjectives === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_iobjectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_iobjectiveCriteria) || !$this->lastRel_usuario_sco2004_iobjectiveCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_iobjectives = Rel_usuario_sco2004_iobjectivePeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_iobjectiveCriteria = $criteria;

		return $this->collRel_usuario_sco2004_iobjectives;
	}

	
	public function initRel_usuario_sco2004_iresponses()
	{
		if ($this->collRel_usuario_sco2004_iresponses === null) {
			$this->collRel_usuario_sco2004_iresponses = array();
		}
	}

	
	public function getRel_usuario_sco2004_iresponses($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iresponses === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_iresponses = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_iresponsePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_iresponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_iresponseCriteria) || !$this->lastRel_usuario_sco2004_iresponseCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_iresponseCriteria = $criteria;
		return $this->collRel_usuario_sco2004_iresponses;
	}

	
	public function countRel_usuario_sco2004_iresponses($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_iresponsePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_iresponse(Rel_usuario_sco2004_iresponse $l)
	{
		$this->collRel_usuario_sco2004_iresponses[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_iresponsesJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_iresponsePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_iresponses === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_iresponses = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_iresponseCriteria) || !$this->lastRel_usuario_sco2004_iresponseCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_iresponses = Rel_usuario_sco2004_iresponsePeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_iresponseCriteria = $criteria;

		return $this->collRel_usuario_sco2004_iresponses;
	}

	
	public function initRel_usuario_sco2004_objectives()
	{
		if ($this->collRel_usuario_sco2004_objectives === null) {
			$this->collRel_usuario_sco2004_objectives = array();
		}
	}

	
	public function getRel_usuario_sco2004_objectives($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_objectives === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco2004_objectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_objectivePeer::addSelectColumns($criteria);
				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->getId());

				Rel_usuario_sco2004_objectivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco2004_objectiveCriteria) || !$this->lastRel_usuario_sco2004_objectiveCriteria->equals($criteria)) {
					$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco2004_objectiveCriteria = $criteria;
		return $this->collRel_usuario_sco2004_objectives;
	}

	
	public function countRel_usuario_sco2004_objectives($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco2004_objectivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco2004_objective(Rel_usuario_sco2004_objective $l)
	{
		$this->collRel_usuario_sco2004_objectives[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco2004_objectivesJoinSco2004($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco2004_objectivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco2004_objectives === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco2004_objectives = array();
			} else {

				$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelectJoinSco2004($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco2004_objectiveCriteria) || !$this->lastRel_usuario_sco2004_objectiveCriteria->equals($criteria)) {
				$this->collRel_usuario_sco2004_objectives = Rel_usuario_sco2004_objectivePeer::doSelectJoinSco2004($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco2004_objectiveCriteria = $criteria;

		return $this->collRel_usuario_sco2004_objectives;
	}

	
	public function initRel_usuario_sco12s()
	{
		if ($this->collRel_usuario_sco12s === null) {
			$this->collRel_usuario_sco12s = array();
		}
	}

	
	public function getRel_usuario_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_sco12Criteria) || !$this->lastRel_usuario_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_sco12Criteria = $criteria;
		return $this->collRel_usuario_sco12s;
	}

	
	public function countRel_usuario_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->getId());

		return Rel_usuario_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_sco12(Rel_usuario_sco12 $l)
	{
		$this->collRel_usuario_sco12s[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_sco12sJoinSco12($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_sco12Criteria) || !$this->lastRel_usuario_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_sco12s = Rel_usuario_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		}
		$this->lastRel_usuario_sco12Criteria = $criteria;

		return $this->collRel_usuario_sco12s;
	}

	
	public function initRel_usuario_objetivo_sco12s()
	{
		if ($this->collRel_usuario_objetivo_sco12s === null) {
			$this->collRel_usuario_objetivo_sco12s = array();
		}
	}

	
	public function getRel_usuario_objetivo_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_objetivo_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_objetivo_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_objetivo_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_objetivo_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_objetivo_sco12Criteria) || !$this->lastRel_usuario_objetivo_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_objetivo_sco12Criteria = $criteria;
		return $this->collRel_usuario_objetivo_sco12s;
	}

	
	public function countRel_usuario_objetivo_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->getId());

		return Rel_usuario_objetivo_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_objetivo_sco12(Rel_usuario_objetivo_sco12 $l)
	{
		$this->collRel_usuario_objetivo_sco12s[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_objetivo_sco12sJoinSco12($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_objetivo_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_objetivo_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_objetivo_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_objetivo_sco12Criteria) || !$this->lastRel_usuario_objetivo_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_objetivo_sco12s = Rel_usuario_objetivo_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		}
		$this->lastRel_usuario_objetivo_sco12Criteria = $criteria;

		return $this->collRel_usuario_objetivo_sco12s;
	}

	
	public function initRel_usuario_interaccion_sco12s()
	{
		if ($this->collRel_usuario_interaccion_sco12s === null) {
			$this->collRel_usuario_interaccion_sco12s = array();
		}
	}

	
	public function getRel_usuario_interaccion_sco12s($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_interaccion_sco12s === null) {
			if ($this->isNew()) {
			   $this->collRel_usuario_interaccion_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_interaccion_sco12Peer::addSelectColumns($criteria);
				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->getId());

				Rel_usuario_interaccion_sco12Peer::addSelectColumns($criteria);
				if (!isset($this->lastRel_usuario_interaccion_sco12Criteria) || !$this->lastRel_usuario_interaccion_sco12Criteria->equals($criteria)) {
					$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_usuario_interaccion_sco12Criteria = $criteria;
		return $this->collRel_usuario_interaccion_sco12s;
	}

	
	public function countRel_usuario_interaccion_sco12s($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->getId());

		return Rel_usuario_interaccion_sco12Peer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_interaccion_sco12(Rel_usuario_interaccion_sco12 $l)
	{
		$this->collRel_usuario_interaccion_sco12s[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_usuario_interaccion_sco12sJoinSco12($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_usuario_interaccion_sco12Peer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_usuario_interaccion_sco12s === null) {
			if ($this->isNew()) {
				$this->collRel_usuario_interaccion_sco12s = array();
			} else {

				$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->getId());

				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_usuario_interaccion_sco12Criteria) || !$this->lastRel_usuario_interaccion_sco12Criteria->equals($criteria)) {
				$this->collRel_usuario_interaccion_sco12s = Rel_usuario_interaccion_sco12Peer::doSelectJoinSco12($criteria, $con);
			}
		}
		$this->lastRel_usuario_interaccion_sco12Criteria = $criteria;

		return $this->collRel_usuario_interaccion_sco12s;
	}

	
	public function initRel_interaccion_sco12_objetivos()
	{
		if ($this->collRel_interaccion_sco12_objetivos === null) {
			$this->collRel_interaccion_sco12_objetivos = array();
		}
	}

	
	public function getRel_interaccion_sco12_objetivos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_objetivos === null) {
			if ($this->isNew()) {
			   $this->collRel_interaccion_sco12_objetivos = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->getId());

				Rel_interaccion_sco12_objetivoPeer::addSelectColumns($criteria);
				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->getId());

				Rel_interaccion_sco12_objetivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_interaccion_sco12_objetivoCriteria) || !$this->lastRel_interaccion_sco12_objetivoCriteria->equals($criteria)) {
					$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_interaccion_sco12_objetivoCriteria = $criteria;
		return $this->collRel_interaccion_sco12_objetivos;
	}

	
	public function countRel_interaccion_sco12_objetivos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->getId());

		return Rel_interaccion_sco12_objetivoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_interaccion_sco12_objetivo(Rel_interaccion_sco12_objetivo $l)
	{
		$this->collRel_interaccion_sco12_objetivos[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_interaccion_sco12_objetivosJoinSco12($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_objetivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_objetivos === null) {
			if ($this->isNew()) {
				$this->collRel_interaccion_sco12_objetivos = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->getId());

				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelectJoinSco12($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_interaccion_sco12_objetivoCriteria) || !$this->lastRel_interaccion_sco12_objetivoCriteria->equals($criteria)) {
				$this->collRel_interaccion_sco12_objetivos = Rel_interaccion_sco12_objetivoPeer::doSelectJoinSco12($criteria, $con);
			}
		}
		$this->lastRel_interaccion_sco12_objetivoCriteria = $criteria;

		return $this->collRel_interaccion_sco12_objetivos;
	}

	
	public function initRel_interaccion_sco12_respuestas()
	{
		if ($this->collRel_interaccion_sco12_respuestas === null) {
			$this->collRel_interaccion_sco12_respuestas = array();
		}
	}

	
	public function getRel_interaccion_sco12_respuestas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_respuestas === null) {
			if ($this->isNew()) {
			   $this->collRel_interaccion_sco12_respuestas = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->getId());

				Rel_interaccion_sco12_respuestaPeer::addSelectColumns($criteria);
				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->getId());

				Rel_interaccion_sco12_respuestaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_interaccion_sco12_respuestaCriteria) || !$this->lastRel_interaccion_sco12_respuestaCriteria->equals($criteria)) {
					$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_interaccion_sco12_respuestaCriteria = $criteria;
		return $this->collRel_interaccion_sco12_respuestas;
	}

	
	public function countRel_interaccion_sco12_respuestas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->getId());

		return Rel_interaccion_sco12_respuestaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_interaccion_sco12_respuesta(Rel_interaccion_sco12_respuesta $l)
	{
		$this->collRel_interaccion_sco12_respuestas[] = $l;
		$l->setUsuario($this);
	}


	
	public function getRel_interaccion_sco12_respuestasJoinSco12($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_interaccion_sco12_respuestaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_interaccion_sco12_respuestas === null) {
			if ($this->isNew()) {
				$this->collRel_interaccion_sco12_respuestas = array();
			} else {

				$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->getId());

				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelectJoinSco12($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $this->getId());

			if (!isset($this->lastRel_interaccion_sco12_respuestaCriteria) || !$this->lastRel_interaccion_sco12_respuestaCriteria->equals($criteria)) {
				$this->collRel_interaccion_sco12_respuestas = Rel_interaccion_sco12_respuestaPeer::doSelectJoinSco12($criteria, $con);
			}
		}
		$this->lastRel_interaccion_sco12_respuestaCriteria = $criteria;

		return $this->collRel_interaccion_sco12_respuestas;
	}

} 