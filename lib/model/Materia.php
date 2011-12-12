<?php

/**
 * Subclass for representing a row from the 'materia' table.
 *
 *
 *
 * @package lib.model
 */
class Materia extends BaseMateria
{



  // Nombre del m�todo: getTemasMateria()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve los temas de esta materia
   */
 public function getTemasMateria($crit = null)
 {
    if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add(TemaPeer::ID_MATERIA, $this->id);
    return TemaPeer::doSelect($c2);
 }

  // Nombre del m�todo: getNumeroTemas()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve el numero de temas de esta materia
   */
 public function getNumeroTemas()
 {
    if (($this->tipo == 'compo') || ($this->tipo == 'segmentada'))
    {
      $c2 = new Criteria();
     	$c2->add(TemaPeer::ID_MATERIA, $this->id);
      return TemaPeer::doCount($c2);
    }

   	if (($this->tipo == 'scorm1.2'))
    {
      $c2 = new Criteria();
     	$c2->add(Sco12Peer::ID_MATERIA, $this->id);
      return Sco12Peer::doCount($c2);
    }
 }

  // Nombre del m�todo: matriculadoUsuario($idUsuario)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve true o false si el alumno esta matriculado en esa materia
   */
 public function matriculadoUsuario($idUsuario)
 {
   	$c2 = new Criteria();
   	$c2->add(CursoPeer::MATERIA_ID, $this->id);
    $cursosMatriculados = CursoPeer::doSelect($c2);

	// if supervisor return true ?????

    foreach ($cursosMatriculados as $cursoMatriculado)
    { $c = new Criteria();
      $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idUsuario);
      $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $cursoMatriculado->getId());
      $rel = Rel_usuario_rol_cursoPeer::doSelect($c2);

      if ($rel) {
      	return true;
      }
	}
	return false;
 }

  // Nombre del m�todo: tieneCursos
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve true o false si la materia tiene asignados cursos
   */
 public function tieneCursos($crit = null)
 {   if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add(CursoPeer::MATERIA_ID, $this->id);
    $rel = CursoPeer::doSelect($c2);
    if ($rel) {
      	return true;
      }
	else return false;
 }

  // Nombre del m�todo: tieneEjercicios
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve true o false si la materia tiene asignados ejercicios
   */
 public function tieneEjercicios($crit = null)
 {   if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add(EjercicioPeer::ID_MATERIA, $this->id);
    $rel = EjercicioPeer::doSelect($c2);
    if ($rel) {
      	return true;
      }
	else return false;
 }

  // Nombre del m�todo: deleteEjercicios
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: borra todos los ejercicos de una materia
   */
  public function deleteEjercicios($crit = null)
  {
    if (null != $crit)
    {
      $c2 = clone $crit;
    }
    else
    {
      $c2 = new Criteria();
    }

    //$c2->add(Ejercicio_resueltoPeer::ID_MATERIA, $this->id);
    $rel = EjercicioPeer::doDelete($c2);
}

  // Nombre del m�todo: esCompo()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve true o false si la materia es de tipo composica
   */
 public function esCompo()
 {  if ("compo" == $this->tipo)
    {
      return true;
    }return false;
 }

   // Nombre del m�todo: deleteContenido
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: elimina el directorio del contendo de la materia en la carpeta web
   */
 public function deleteContenido($folderPath=null)
 {
   if (!$folderPath)
   {
     $folderPath= sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'materias'.DIRECTORY_SEPARATOR.$this->id;
   }

   return $this->borrarDirectorio($folderPath);

 }

   // Nombre del m�todo: deleteContenido
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: elimina los cursos de una materia
   */
 public function deleteCursos()
 {
   $cursos = $this->getCursos();
   foreach ($cursos as $curso)
   {
     $curso->eliminarAll();
   }
 }


  public function borrarDirectorio($folderPath)
 {
     if ( is_dir ( $folderPath ) )
    { foreach ( scandir ( $folderPath )  as $value )
        {
            if ( $value != "." && $value != ".." )
            {  $value = $folderPath .DIRECTORY_SEPARATOR. $value;
                if ( is_dir ( $value ) )
                  { $this->borrarDirectorio($value);}
                elseif ( is_file ( $value ) )
                 {   @unlink ( $value );            }
            }
        }
        return rmdir ( $folderPath );
    }
    else
    { return FALSE;    }
 }

}
