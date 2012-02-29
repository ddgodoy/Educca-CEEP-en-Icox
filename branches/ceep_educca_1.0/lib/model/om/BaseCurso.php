<?php


abstract class BaseCurso extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $informacion_extendida;


	
	protected $fecha_inicio;


	
	protected $fecha_fin;


	
	protected $scan;


	
	protected $duracion;


	
	protected $precio;


	
	protected $mensual = false;


	
	protected $materia_id;


	
	protected $menu_info = true;


	
	protected $menu_biblio = true;


	
	protected $menu_temario = true;


	
	protected $menu_seguimiento = true;


	
	protected $menu_eventos = true;


	
	protected $menu_chat = true;


	
	protected $menu_foro = true;


	
	protected $menu_ejercicios = true;


	
	protected $menu_planificacion_alumnos = true;


	
	protected $menu_biblioteca_archivos = true;


	
	protected $created_at;

	
	protected $aMateria;

	
	protected $collsfSimpleForumForums;

	
	protected $lastsfSimpleForumForumCriteria = null;

	
	protected $collRel_paquete_cursos;

	
	protected $lastRel_paquete_cursoCriteria = null;

	
	protected $collRel_usuario_rol_cursos;

	
	protected $lastRel_usuario_rol_cursoCriteria = null;

	
	protected $collRel_curso_temas;

	
	protected $lastRel_curso_temaCriteria = null;

	
	protected $collMensajes;

	
	protected $lastMensajeCriteria = null;

	
	protected $collNotificacions;

	
	protected $lastNotificacionCriteria = null;

	
	protected $collMensaje_chats;

	
	protected $lastMensaje_chatCriteria = null;

	
	protected $collRel_conectado_chats;

	
	protected $lastRel_conectado_chatCriteria = null;

	
	protected $collEventos;

	
	protected $lastEventoCriteria = null;

	
	protected $collPublicado_ejercicio_cursos;

	
	protected $lastPublicado_ejercicio_cursoCriteria = null;

	
	protected $collTareas;

	
	protected $lastTareaCriteria = null;

	
	protected $collCalificacioness;

	
	protected $lastCalificacionesCriteria = null;

	
	protected $collUsuarios_onlines;

	
	protected $lastUsuarios_onlineCriteria = null;

	
	protected $collBiblioteca_archivoss;

	
	protected $lastBiblioteca_archivosCriteria = null;

	
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

	
	public function getInformacionExtendida()
	{

		return $this->informacion_extendida;
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

	
	public function getMateriaId()
	{

		return $this->materia_id;
	}

	
	public function getMenuInfo()
	{

		return $this->menu_info;
	}

	
	public function getMenuBiblio()
	{

		return $this->menu_biblio;
	}

	
	public function getMenuTemario()
	{

		return $this->menu_temario;
	}

	
	public function getMenuSeguimiento()
	{

		return $this->menu_seguimiento;
	}

	
	public function getMenuEventos()
	{

		return $this->menu_eventos;
	}

	
	public function getMenuChat()
	{

		return $this->menu_chat;
	}

	
	public function getMenuForo()
	{

		return $this->menu_foro;
	}

	
	public function getMenuEjercicios()
	{

		return $this->menu_ejercicios;
	}

	
	public function getMenuPlanificacionAlumnos()
	{

		return $this->menu_planificacion_alumnos;
	}

	
	public function getMenuBibliotecaArchivos()
	{

		return $this->menu_biblioteca_archivos;
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
			$this->modifiedColumns[] = CursoPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = CursoPeer::NOMBRE;
		}

	} 
	
	public function setInformacionExtendida($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->informacion_extendida !== $v) {
			$this->informacion_extendida = $v;
			$this->modifiedColumns[] = CursoPeer::INFORMACION_EXTENDIDA;
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
			$this->modifiedColumns[] = CursoPeer::FECHA_INICIO;
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
			$this->modifiedColumns[] = CursoPeer::FECHA_FIN;
		}

	} 
	
	public function setScan($v)
	{

		if ($this->scan !== $v) {
			$this->scan = $v;
			$this->modifiedColumns[] = CursoPeer::SCAN;
		}

	} 
	
	public function setDuracion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->duracion !== $v) {
			$this->duracion = $v;
			$this->modifiedColumns[] = CursoPeer::DURACION;
		}

	} 
	
	public function setPrecio($v)
	{

		if ($this->precio !== $v) {
			$this->precio = $v;
			$this->modifiedColumns[] = CursoPeer::PRECIO;
		}

	} 
	
	public function setMensual($v)
	{

		if ($this->mensual !== $v || $v === false) {
			$this->mensual = $v;
			$this->modifiedColumns[] = CursoPeer::MENSUAL;
		}

	} 
	
	public function setMateriaId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->materia_id !== $v) {
			$this->materia_id = $v;
			$this->modifiedColumns[] = CursoPeer::MATERIA_ID;
		}

		if ($this->aMateria !== null && $this->aMateria->getId() !== $v) {
			$this->aMateria = null;
		}

	} 
	
	public function setMenuInfo($v)
	{

		if ($this->menu_info !== $v || $v === true) {
			$this->menu_info = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_INFO;
		}

	} 
	
	public function setMenuBiblio($v)
	{

		if ($this->menu_biblio !== $v || $v === true) {
			$this->menu_biblio = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_BIBLIO;
		}

	} 
	
	public function setMenuTemario($v)
	{

		if ($this->menu_temario !== $v || $v === true) {
			$this->menu_temario = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_TEMARIO;
		}

	} 
	
	public function setMenuSeguimiento($v)
	{

		if ($this->menu_seguimiento !== $v || $v === true) {
			$this->menu_seguimiento = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_SEGUIMIENTO;
		}

	} 
	
	public function setMenuEventos($v)
	{

		if ($this->menu_eventos !== $v || $v === true) {
			$this->menu_eventos = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_EVENTOS;
		}

	} 
	
	public function setMenuChat($v)
	{

		if ($this->menu_chat !== $v || $v === true) {
			$this->menu_chat = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_CHAT;
		}

	} 
	
	public function setMenuForo($v)
	{

		if ($this->menu_foro !== $v || $v === true) {
			$this->menu_foro = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_FORO;
		}

	} 
	
	public function setMenuEjercicios($v)
	{

		if ($this->menu_ejercicios !== $v || $v === true) {
			$this->menu_ejercicios = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_EJERCICIOS;
		}

	} 
	
	public function setMenuPlanificacionAlumnos($v)
	{

		if ($this->menu_planificacion_alumnos !== $v || $v === true) {
			$this->menu_planificacion_alumnos = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_PLANIFICACION_ALUMNOS;
		}

	} 
	
	public function setMenuBibliotecaArchivos($v)
	{

		if ($this->menu_biblioteca_archivos !== $v || $v === true) {
			$this->menu_biblioteca_archivos = $v;
			$this->modifiedColumns[] = CursoPeer::MENU_BIBLIOTECA_ARCHIVOS;
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
			$this->modifiedColumns[] = CursoPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->informacion_extendida = $rs->getString($startcol + 2);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 3, null);

			$this->fecha_fin = $rs->getTimestamp($startcol + 4, null);

			$this->scan = $rs->getBoolean($startcol + 5);

			$this->duracion = $rs->getString($startcol + 6);

			$this->precio = $rs->getFloat($startcol + 7);

			$this->mensual = $rs->getBoolean($startcol + 8);

			$this->materia_id = $rs->getString($startcol + 9);

			$this->menu_info = $rs->getBoolean($startcol + 10);

			$this->menu_biblio = $rs->getBoolean($startcol + 11);

			$this->menu_temario = $rs->getBoolean($startcol + 12);

			$this->menu_seguimiento = $rs->getBoolean($startcol + 13);

			$this->menu_eventos = $rs->getBoolean($startcol + 14);

			$this->menu_chat = $rs->getBoolean($startcol + 15);

			$this->menu_foro = $rs->getBoolean($startcol + 16);

			$this->menu_ejercicios = $rs->getBoolean($startcol + 17);

			$this->menu_planificacion_alumnos = $rs->getBoolean($startcol + 18);

			$this->menu_biblioteca_archivos = $rs->getBoolean($startcol + 19);

			$this->created_at = $rs->getTimestamp($startcol + 20, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Curso object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CursoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CursoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CursoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CursoPeer::DATABASE_NAME);
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


												
			if ($this->aMateria !== null) {
				if ($this->aMateria->isModified()) {
					$affectedRows += $this->aMateria->save($con);
				}
				$this->setMateria($this->aMateria);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CursoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CursoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumForums !== null) {
				foreach($this->collsfSimpleForumForums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRel_paquete_cursos !== null) {
				foreach($this->collRel_paquete_cursos as $referrerFK) {
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

			if ($this->collRel_curso_temas !== null) {
				foreach($this->collRel_curso_temas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMensajes !== null) {
				foreach($this->collMensajes as $referrerFK) {
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

			if ($this->collEventos !== null) {
				foreach($this->collEventos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPublicado_ejercicio_cursos !== null) {
				foreach($this->collPublicado_ejercicio_cursos as $referrerFK) {
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

			if ($this->collBiblioteca_archivoss !== null) {
				foreach($this->collBiblioteca_archivoss as $referrerFK) {
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


												
			if ($this->aMateria !== null) {
				if (!$this->aMateria->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMateria->getValidationFailures());
				}
			}


			if (($retval = CursoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumForums !== null) {
					foreach($this->collsfSimpleForumForums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRel_paquete_cursos !== null) {
					foreach($this->collRel_paquete_cursos as $referrerFK) {
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

				if ($this->collRel_curso_temas !== null) {
					foreach($this->collRel_curso_temas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMensajes !== null) {
					foreach($this->collMensajes as $referrerFK) {
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

				if ($this->collEventos !== null) {
					foreach($this->collEventos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPublicado_ejercicio_cursos !== null) {
					foreach($this->collPublicado_ejercicio_cursos as $referrerFK) {
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

				if ($this->collBiblioteca_archivoss !== null) {
					foreach($this->collBiblioteca_archivoss as $referrerFK) {
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
		$pos = CursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getInformacionExtendida();
				break;
			case 3:
				return $this->getFechaInicio();
				break;
			case 4:
				return $this->getFechaFin();
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
				return $this->getMateriaId();
				break;
			case 10:
				return $this->getMenuInfo();
				break;
			case 11:
				return $this->getMenuBiblio();
				break;
			case 12:
				return $this->getMenuTemario();
				break;
			case 13:
				return $this->getMenuSeguimiento();
				break;
			case 14:
				return $this->getMenuEventos();
				break;
			case 15:
				return $this->getMenuChat();
				break;
			case 16:
				return $this->getMenuForo();
				break;
			case 17:
				return $this->getMenuEjercicios();
				break;
			case 18:
				return $this->getMenuPlanificacionAlumnos();
				break;
			case 19:
				return $this->getMenuBibliotecaArchivos();
				break;
			case 20:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CursoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getInformacionExtendida(),
			$keys[3] => $this->getFechaInicio(),
			$keys[4] => $this->getFechaFin(),
			$keys[5] => $this->getScan(),
			$keys[6] => $this->getDuracion(),
			$keys[7] => $this->getPrecio(),
			$keys[8] => $this->getMensual(),
			$keys[9] => $this->getMateriaId(),
			$keys[10] => $this->getMenuInfo(),
			$keys[11] => $this->getMenuBiblio(),
			$keys[12] => $this->getMenuTemario(),
			$keys[13] => $this->getMenuSeguimiento(),
			$keys[14] => $this->getMenuEventos(),
			$keys[15] => $this->getMenuChat(),
			$keys[16] => $this->getMenuForo(),
			$keys[17] => $this->getMenuEjercicios(),
			$keys[18] => $this->getMenuPlanificacionAlumnos(),
			$keys[19] => $this->getMenuBibliotecaArchivos(),
			$keys[20] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setInformacionExtendida($value);
				break;
			case 3:
				$this->setFechaInicio($value);
				break;
			case 4:
				$this->setFechaFin($value);
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
				$this->setMateriaId($value);
				break;
			case 10:
				$this->setMenuInfo($value);
				break;
			case 11:
				$this->setMenuBiblio($value);
				break;
			case 12:
				$this->setMenuTemario($value);
				break;
			case 13:
				$this->setMenuSeguimiento($value);
				break;
			case 14:
				$this->setMenuEventos($value);
				break;
			case 15:
				$this->setMenuChat($value);
				break;
			case 16:
				$this->setMenuForo($value);
				break;
			case 17:
				$this->setMenuEjercicios($value);
				break;
			case 18:
				$this->setMenuPlanificacionAlumnos($value);
				break;
			case 19:
				$this->setMenuBibliotecaArchivos($value);
				break;
			case 20:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CursoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInformacionExtendida($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFechaInicio($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFechaFin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScan($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDuracion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPrecio($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMensual($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMateriaId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMenuInfo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMenuBiblio($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setMenuTemario($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setMenuSeguimiento($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setMenuEventos($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setMenuChat($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setMenuForo($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setMenuEjercicios($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setMenuPlanificacionAlumnos($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setMenuBibliotecaArchivos($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCreatedAt($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CursoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CursoPeer::ID)) $criteria->add(CursoPeer::ID, $this->id);
		if ($this->isColumnModified(CursoPeer::NOMBRE)) $criteria->add(CursoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(CursoPeer::INFORMACION_EXTENDIDA)) $criteria->add(CursoPeer::INFORMACION_EXTENDIDA, $this->informacion_extendida);
		if ($this->isColumnModified(CursoPeer::FECHA_INICIO)) $criteria->add(CursoPeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(CursoPeer::FECHA_FIN)) $criteria->add(CursoPeer::FECHA_FIN, $this->fecha_fin);
		if ($this->isColumnModified(CursoPeer::SCAN)) $criteria->add(CursoPeer::SCAN, $this->scan);
		if ($this->isColumnModified(CursoPeer::DURACION)) $criteria->add(CursoPeer::DURACION, $this->duracion);
		if ($this->isColumnModified(CursoPeer::PRECIO)) $criteria->add(CursoPeer::PRECIO, $this->precio);
		if ($this->isColumnModified(CursoPeer::MENSUAL)) $criteria->add(CursoPeer::MENSUAL, $this->mensual);
		if ($this->isColumnModified(CursoPeer::MATERIA_ID)) $criteria->add(CursoPeer::MATERIA_ID, $this->materia_id);
		if ($this->isColumnModified(CursoPeer::MENU_INFO)) $criteria->add(CursoPeer::MENU_INFO, $this->menu_info);
		if ($this->isColumnModified(CursoPeer::MENU_BIBLIO)) $criteria->add(CursoPeer::MENU_BIBLIO, $this->menu_biblio);
		if ($this->isColumnModified(CursoPeer::MENU_TEMARIO)) $criteria->add(CursoPeer::MENU_TEMARIO, $this->menu_temario);
		if ($this->isColumnModified(CursoPeer::MENU_SEGUIMIENTO)) $criteria->add(CursoPeer::MENU_SEGUIMIENTO, $this->menu_seguimiento);
		if ($this->isColumnModified(CursoPeer::MENU_EVENTOS)) $criteria->add(CursoPeer::MENU_EVENTOS, $this->menu_eventos);
		if ($this->isColumnModified(CursoPeer::MENU_CHAT)) $criteria->add(CursoPeer::MENU_CHAT, $this->menu_chat);
		if ($this->isColumnModified(CursoPeer::MENU_FORO)) $criteria->add(CursoPeer::MENU_FORO, $this->menu_foro);
		if ($this->isColumnModified(CursoPeer::MENU_EJERCICIOS)) $criteria->add(CursoPeer::MENU_EJERCICIOS, $this->menu_ejercicios);
		if ($this->isColumnModified(CursoPeer::MENU_PLANIFICACION_ALUMNOS)) $criteria->add(CursoPeer::MENU_PLANIFICACION_ALUMNOS, $this->menu_planificacion_alumnos);
		if ($this->isColumnModified(CursoPeer::MENU_BIBLIOTECA_ARCHIVOS)) $criteria->add(CursoPeer::MENU_BIBLIOTECA_ARCHIVOS, $this->menu_biblioteca_archivos);
		if ($this->isColumnModified(CursoPeer::CREATED_AT)) $criteria->add(CursoPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CursoPeer::DATABASE_NAME);

		$criteria->add(CursoPeer::ID, $this->id);

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

		$copyObj->setInformacionExtendida($this->informacion_extendida);

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaFin($this->fecha_fin);

		$copyObj->setScan($this->scan);

		$copyObj->setDuracion($this->duracion);

		$copyObj->setPrecio($this->precio);

		$copyObj->setMensual($this->mensual);

		$copyObj->setMateriaId($this->materia_id);

		$copyObj->setMenuInfo($this->menu_info);

		$copyObj->setMenuBiblio($this->menu_biblio);

		$copyObj->setMenuTemario($this->menu_temario);

		$copyObj->setMenuSeguimiento($this->menu_seguimiento);

		$copyObj->setMenuEventos($this->menu_eventos);

		$copyObj->setMenuChat($this->menu_chat);

		$copyObj->setMenuForo($this->menu_foro);

		$copyObj->setMenuEjercicios($this->menu_ejercicios);

		$copyObj->setMenuPlanificacionAlumnos($this->menu_planificacion_alumnos);

		$copyObj->setMenuBibliotecaArchivos($this->menu_biblioteca_archivos);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumForums() as $relObj) {
				$copyObj->addsfSimpleForumForum($relObj->copy($deepCopy));
			}

			foreach($this->getRel_paquete_cursos() as $relObj) {
				$copyObj->addRel_paquete_curso($relObj->copy($deepCopy));
			}

			foreach($this->getRel_usuario_rol_cursos() as $relObj) {
				$copyObj->addRel_usuario_rol_curso($relObj->copy($deepCopy));
			}

			foreach($this->getRel_curso_temas() as $relObj) {
				$copyObj->addRel_curso_tema($relObj->copy($deepCopy));
			}

			foreach($this->getMensajes() as $relObj) {
				$copyObj->addMensaje($relObj->copy($deepCopy));
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

			foreach($this->getEventos() as $relObj) {
				$copyObj->addEvento($relObj->copy($deepCopy));
			}

			foreach($this->getPublicado_ejercicio_cursos() as $relObj) {
				$copyObj->addPublicado_ejercicio_curso($relObj->copy($deepCopy));
			}

			foreach($this->getTareas() as $relObj) {
				$copyObj->addTarea($relObj->copy($deepCopy));
			}

			foreach($this->getCalificacioness() as $relObj) {
				$copyObj->addCalificaciones($relObj->copy($deepCopy));
			}

			foreach($this->getUsuarios_onlines() as $relObj) {
				$copyObj->addUsuarios_online($relObj->copy($deepCopy));
			}

			foreach($this->getBiblioteca_archivoss() as $relObj) {
				$copyObj->addBiblioteca_archivos($relObj->copy($deepCopy));
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
			self::$peer = new CursoPeer();
		}
		return self::$peer;
	}

	
	public function setMateria($v)
	{


		if ($v === null) {
			$this->setMateriaId(NULL);
		} else {
			$this->setMateriaId($v->getId());
		}


		$this->aMateria = $v;
	}


	
	public function getMateria($con = null)
	{
		if ($this->aMateria === null && (($this->materia_id !== "" && $this->materia_id !== null))) {
						include_once 'lib/model/om/BaseMateriaPeer.php';

			$this->aMateria = MateriaPeer::retrieveByPK($this->materia_id, $con);

			
		}
		return $this->aMateria;
	}

	
	public function initsfSimpleForumForums()
	{
		if ($this->collsfSimpleForumForums === null) {
			$this->collsfSimpleForumForums = array();
		}
	}

	
	public function getsfSimpleForumForums($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->getId());

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->getId());

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
					$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;
		return $this->collsfSimpleForumForums;
	}

	
	public function countsfSimpleForumForums($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->getId());

		return sfSimpleForumForumPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumForum(sfSimpleForumForum $l)
	{
		$this->collsfSimpleForumForums[] = $l;
		$l->setCurso($this);
	}


	
	public function getsfSimpleForumForumsJoinsfSimpleForumCategory($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->getId());

				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con);
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;

		return $this->collsfSimpleForumForums;
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

				$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->getId());

				Rel_paquete_cursoPeer::addSelectColumns($criteria);
				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->getId());

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

		$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->getId());

		return Rel_paquete_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_paquete_curso(Rel_paquete_curso $l)
	{
		$this->collRel_paquete_cursos[] = $l;
		$l->setCurso($this);
	}


	
	public function getRel_paquete_cursosJoinPaquete($criteria = null, $con = null)
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

				$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->getId());

				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelectJoinPaquete($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_paquete_cursoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_paquete_cursoCriteria) || !$this->lastRel_paquete_cursoCriteria->equals($criteria)) {
				$this->collRel_paquete_cursos = Rel_paquete_cursoPeer::doSelectJoinPaquete($criteria, $con);
			}
		}
		$this->lastRel_paquete_cursoCriteria = $criteria;

		return $this->collRel_paquete_cursos;
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

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

				Rel_usuario_rol_cursoPeer::addSelectColumns($criteria);
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

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

		$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

		return Rel_usuario_rol_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_usuario_rol_curso(Rel_usuario_rol_curso $l)
	{
		$this->collRel_usuario_rol_cursos[] = $l;
		$l->setCurso($this);
	}


	
	public function getRel_usuario_rol_cursosJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
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

				$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_usuario_rol_cursoCriteria) || !$this->lastRel_usuario_rol_cursoCriteria->equals($criteria)) {
				$this->collRel_usuario_rol_cursos = Rel_usuario_rol_cursoPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastRel_usuario_rol_cursoCriteria = $criteria;

		return $this->collRel_usuario_rol_cursos;
	}

	
	public function initRel_curso_temas()
	{
		if ($this->collRel_curso_temas === null) {
			$this->collRel_curso_temas = array();
		}
	}

	
	public function getRel_curso_temas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_curso_temas === null) {
			if ($this->isNew()) {
			   $this->collRel_curso_temas = array();
			} else {

				$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->getId());

				Rel_curso_temaPeer::addSelectColumns($criteria);
				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->getId());

				Rel_curso_temaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRel_curso_temaCriteria) || !$this->lastRel_curso_temaCriteria->equals($criteria)) {
					$this->collRel_curso_temas = Rel_curso_temaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRel_curso_temaCriteria = $criteria;
		return $this->collRel_curso_temas;
	}

	
	public function countRel_curso_temas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->getId());

		return Rel_curso_temaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_curso_tema(Rel_curso_tema $l)
	{
		$this->collRel_curso_temas[] = $l;
		$l->setCurso($this);
	}


	
	public function getRel_curso_temasJoinTema($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRel_curso_temaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRel_curso_temas === null) {
			if ($this->isNew()) {
				$this->collRel_curso_temas = array();
			} else {

				$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->getId());

				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelectJoinTema($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_curso_temaPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_curso_temaCriteria) || !$this->lastRel_curso_temaCriteria->equals($criteria)) {
				$this->collRel_curso_temas = Rel_curso_temaPeer::doSelectJoinTema($criteria, $con);
			}
		}
		$this->lastRel_curso_temaCriteria = $criteria;

		return $this->collRel_curso_temas;
	}

	
	public function initMensajes()
	{
		if ($this->collMensajes === null) {
			$this->collMensajes = array();
		}
	}

	
	public function getMensajes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
			   $this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				$this->collMensajes = MensajePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				MensajePeer::addSelectColumns($criteria);
				if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
					$this->collMensajes = MensajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMensajeCriteria = $criteria;
		return $this->collMensajes;
	}

	
	public function countMensajes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MensajePeer::ID_CURSO, $this->getId());

		return MensajePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensaje(Mensaje $l)
	{
		$this->collMensajes[] = $l;
		$l->setCurso($this);
	}


	
	public function getMensajesJoinUsuarioRelatedByIdPropietario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdPropietario($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdPropietario($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinUsuarioRelatedByIdEmisor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdEmisor($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdEmisor($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinUsuarioRelatedByIdDestinatario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdDestinatario($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinUsuarioRelatedByIdDestinatario($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
	}


	
	public function getMensajesJoinAsunto_mensaje($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMensajePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMensajes === null) {
			if ($this->isNew()) {
				$this->collMensajes = array();
			} else {

				$criteria->add(MensajePeer::ID_CURSO, $this->getId());

				$this->collMensajes = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		} else {
									
			$criteria->add(MensajePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastMensajeCriteria) || !$this->lastMensajeCriteria->equals($criteria)) {
				$this->collMensajes = MensajePeer::doSelectJoinAsunto_mensaje($criteria, $con);
			}
		}
		$this->lastMensajeCriteria = $criteria;

		return $this->collMensajes;
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

				$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

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

		$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

		return NotificacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotificacion(Notificacion $l)
	{
		$this->collNotificacions[] = $l;
		$l->setCurso($this);
	}


	
	public function getNotificacionsJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinUsuario($criteria, $con);
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

				$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

				$this->collNotificacions = NotificacionPeer::doSelectJoinTema($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificacionPeer::ID_CURSO, $this->getId());

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

				$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->getId());

				Mensaje_chatPeer::addSelectColumns($criteria);
				$this->collMensaje_chats = Mensaje_chatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->getId());

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

		$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->getId());

		return Mensaje_chatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMensaje_chat(Mensaje_chat $l)
	{
		$this->collMensaje_chats[] = $l;
		$l->setCurso($this);
	}


	
	public function getMensaje_chatsJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->getId());

				$this->collMensaje_chats = Mensaje_chatPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Mensaje_chatPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastMensaje_chatCriteria) || !$this->lastMensaje_chatCriteria->equals($criteria)) {
				$this->collMensaje_chats = Mensaje_chatPeer::doSelectJoinUsuario($criteria, $con);
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

				$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

				Rel_conectado_chatPeer::addSelectColumns($criteria);
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

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

		$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

		return Rel_conectado_chatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRel_conectado_chat(Rel_conectado_chat $l)
	{
		$this->collRel_conectado_chats[] = $l;
		$l->setCurso($this);
	}


	
	public function getRel_conectado_chatsJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinUsuario($criteria, $con);
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

				$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Rel_conectado_chatPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastRel_conectado_chatCriteria) || !$this->lastRel_conectado_chatCriteria->equals($criteria)) {
				$this->collRel_conectado_chats = Rel_conectado_chatPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastRel_conectado_chatCriteria = $criteria;

		return $this->collRel_conectado_chats;
	}

	
	public function initEventos()
	{
		if ($this->collEventos === null) {
			$this->collEventos = array();
		}
	}

	
	public function getEventos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
			   $this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_CURSO, $this->getId());

				EventoPeer::addSelectColumns($criteria);
				$this->collEventos = EventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventoPeer::ID_CURSO, $this->getId());

				EventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
					$this->collEventos = EventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventoCriteria = $criteria;
		return $this->collEventos;
	}

	
	public function countEventos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventoPeer::ID_CURSO, $this->getId());

		return EventoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvento(Evento $l)
	{
		$this->collEventos[] = $l;
		$l->setCurso($this);
	}


	
	public function getEventosJoinTipo_evento($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
				$this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_CURSO, $this->getId());

				$this->collEventos = EventoPeer::doSelectJoinTipo_evento($criteria, $con);
			}
		} else {
									
			$criteria->add(EventoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
				$this->collEventos = EventoPeer::doSelectJoinTipo_evento($criteria, $con);
			}
		}
		$this->lastEventoCriteria = $criteria;

		return $this->collEventos;
	}


	
	public function getEventosJoinTipo_cita($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventos === null) {
			if ($this->isNew()) {
				$this->collEventos = array();
			} else {

				$criteria->add(EventoPeer::ID_CURSO, $this->getId());

				$this->collEventos = EventoPeer::doSelectJoinTipo_cita($criteria, $con);
			}
		} else {
									
			$criteria->add(EventoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastEventoCriteria) || !$this->lastEventoCriteria->equals($criteria)) {
				$this->collEventos = EventoPeer::doSelectJoinTipo_cita($criteria, $con);
			}
		}
		$this->lastEventoCriteria = $criteria;

		return $this->collEventos;
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

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $this->getId());

				Publicado_ejercicio_cursoPeer::addSelectColumns($criteria);
				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $this->getId());

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

		$criteria->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $this->getId());

		return Publicado_ejercicio_cursoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPublicado_ejercicio_curso(Publicado_ejercicio_curso $l)
	{
		$this->collPublicado_ejercicio_cursos[] = $l;
		$l->setCurso($this);
	}


	
	public function getPublicado_ejercicio_cursosJoinEjercicio($criteria = null, $con = null)
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

				$criteria->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $this->getId());

				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastPublicado_ejercicio_cursoCriteria) || !$this->lastPublicado_ejercicio_cursoCriteria->equals($criteria)) {
				$this->collPublicado_ejercicio_cursos = Publicado_ejercicio_cursoPeer::doSelectJoinEjercicio($criteria, $con);
			}
		}
		$this->lastPublicado_ejercicio_cursoCriteria = $criteria;

		return $this->collPublicado_ejercicio_cursos;
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

				$criteria->add(TareaPeer::ID_CURSO, $this->getId());

				TareaPeer::addSelectColumns($criteria);
				$this->collTareas = TareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TareaPeer::ID_CURSO, $this->getId());

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

		$criteria->add(TareaPeer::ID_CURSO, $this->getId());

		return TareaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTarea(Tarea $l)
	{
		$this->collTareas[] = $l;
		$l->setCurso($this);
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

				$criteria->add(TareaPeer::ID_CURSO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEjercicio($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_CURSO, $this->getId());

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

				$criteria->add(TareaPeer::ID_CURSO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_CURSO, $this->getId());

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

				$criteria->add(TareaPeer::ID_CURSO, $this->getId());

				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		} else {
									
			$criteria->add(TareaPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastTareaCriteria) || !$this->lastTareaCriteria->equals($criteria)) {
				$this->collTareas = TareaPeer::doSelectJoinEvento($criteria, $con);
			}
		}
		$this->lastTareaCriteria = $criteria;

		return $this->collTareas;
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

				$criteria->add(CalificacionesPeer::ID_CURSO, $this->getId());

				CalificacionesPeer::addSelectColumns($criteria);
				$this->collCalificacioness = CalificacionesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CalificacionesPeer::ID_CURSO, $this->getId());

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

		$criteria->add(CalificacionesPeer::ID_CURSO, $this->getId());

		return CalificacionesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCalificaciones(Calificaciones $l)
	{
		$this->collCalificacioness[] = $l;
		$l->setCurso($this);
	}


	
	public function getCalificacionessJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(CalificacionesPeer::ID_CURSO, $this->getId());

				$this->collCalificacioness = CalificacionesPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(CalificacionesPeer::ID_CURSO, $this->getId());

			if (!isset($this->lastCalificacionesCriteria) || !$this->lastCalificacionesCriteria->equals($criteria)) {
				$this->collCalificacioness = CalificacionesPeer::doSelectJoinUsuario($criteria, $con);
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

				$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

				Usuarios_onlinePeer::addSelectColumns($criteria);
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

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

		$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

		return Usuarios_onlinePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuarios_online(Usuarios_online $l)
	{
		$this->collUsuarios_onlines[] = $l;
		$l->setCurso($this);
	}


	
	public function getUsuarios_onlinesJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinUsuario($criteria, $con);
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

				$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(Usuarios_onlinePeer::ID_CURSO, $this->getId());

			if (!isset($this->lastUsuarios_onlineCriteria) || !$this->lastUsuarios_onlineCriteria->equals($criteria)) {
				$this->collUsuarios_onlines = Usuarios_onlinePeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastUsuarios_onlineCriteria = $criteria;

		return $this->collUsuarios_onlines;
	}

	
	public function initBiblioteca_archivoss()
	{
		if ($this->collBiblioteca_archivoss === null) {
			$this->collBiblioteca_archivoss = array();
		}
	}

	
	public function getBiblioteca_archivoss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBiblioteca_archivosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBiblioteca_archivoss === null) {
			if ($this->isNew()) {
			   $this->collBiblioteca_archivoss = array();
			} else {

				$criteria->add(Biblioteca_archivosPeer::ID_CURSO, $this->getId());

				Biblioteca_archivosPeer::addSelectColumns($criteria);
				$this->collBiblioteca_archivoss = Biblioteca_archivosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Biblioteca_archivosPeer::ID_CURSO, $this->getId());

				Biblioteca_archivosPeer::addSelectColumns($criteria);
				if (!isset($this->lastBiblioteca_archivosCriteria) || !$this->lastBiblioteca_archivosCriteria->equals($criteria)) {
					$this->collBiblioteca_archivoss = Biblioteca_archivosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBiblioteca_archivosCriteria = $criteria;
		return $this->collBiblioteca_archivoss;
	}

	
	public function countBiblioteca_archivoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBiblioteca_archivosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Biblioteca_archivosPeer::ID_CURSO, $this->getId());

		return Biblioteca_archivosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBiblioteca_archivos(Biblioteca_archivos $l)
	{
		$this->collBiblioteca_archivoss[] = $l;
		$l->setCurso($this);
	}

} 