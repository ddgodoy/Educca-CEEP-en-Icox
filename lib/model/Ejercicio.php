<?php

/**
 * Subclass for representing a row from the 'ejercicio' table.
 *
 *
 *
 * @package lib.model
 */
class Ejercicio extends BaseEjercicio
{

  /**
  *
  * @name         getPublicadoCurso ($id_curso)
  * @access       public
  * @author       Angel Martin
  * @deprecated   Devuelve 0 si el ejercicio no esta publicado en dicho curso o 1 en caso contrario
  */
public function getPublicadoCurso ($id_curso)
{
  $c = new Criteria();
  $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->id);
  $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
  return Publicado_ejercicio_cursoPeer::DoCount($c);
}




  /**
  *
  * @name         getPublicadaSolucionCurso ($id_curso) ($id_curso)
  * @access       public
  * @author       Angel Martin
  * @deprecated   Devuelve 0 si la solucion del el ejercicio no esta publicada en dicho curso o 1 en caso contrario
  */
public function getPublicadaSolucionCurso ($id_curso)
{
  $c = new Criteria();
  $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->id);
  $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);

  if (Publicado_ejercicio_cursoPeer::DoCount($c))
  {
    $rel = Publicado_ejercicio_cursoPeer::DoSelectOne($c);
    return $rel->getSolucion();
  }
  else
  {
    return 0;
  }
}

  /**
  *
  * @name         deleteSoluciones
  * @access       public
  * @author       Jacobo Chaquet
  * @deprecated   elimina las solicuiones de problemas
  */
public function deleteSoluciones()
{
  if ($this->getTipo() == 'problemas')
  {
    for($i_hojas = 1; $i_hojas <= $this->getNumeroHojas(); $i_hojas++)
    {
      $ruta = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'problemas'.DIRECTORY_SEPARATOR.'respuesta_'.$this->id_solucion.'_'.$i_hojas.'.jpg';
      if (file_exists($ruta))
      {
          unlink($ruta);
      }
    }
  }
}

  /**
  *
  * @name         deleteTareas
  * @access       public
  * @author       Jacobo Chaquet
  * @deprecated   elimina las tareas asociadas a un ejercicio
  */
public function deleteTareas()
{
  $c = new Criteria();
  $c->add(TareaPeer::ID_EJERCICIO, $this->id);
  $tareas = TareaPeer::DoSelect($c);

  foreach ($tareas as $tarea)
  {
    $tarea->getEvento()->delete();
    $tarea->delete();
  }
}

  // Nombre del método: comprobarPermisoResolver($id_curso)
  // Añadida por: Jacobo Chaquet Ulldemolins
  /* Descripción: Devuelve la relacion (Rel_usuario_tarea) si  existe o null
  */
  public function comprobarPermisoMostrar($id_usuario,$id_curso=null)
  {
     //$c = new Criteria();
     //$c->add(TareaPeer::ID_EJERCICIO, $this->id);
     $tareas = $this->getTareas();//Rel_usuario_tareaPeer::DoSelect($c);
     foreach($tareas as $tarea)
     {
       $c = new Criteria();
       $c->add(Rel_usuario_tareaPeer::ID_TAREA, $tarea->getId());
       $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
       if ( Rel_usuario_tareaPeer::DoSelectOne($c))
       {
         return true;
       }
     }

     if ($id_curso)
     {
        $c = new Criteria();
        $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $id_curso);
        $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
        if ( ! Rel_usuario_rol_cursoPeer::DoSelectOne($c))
        {
         return false;
        }
        $c = new Criteria();
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
        $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $this->id);
        if ( Publicado_ejercicio_cursoPeer::DoSelectOne($c))
        {
         return true;
        }
     }
     return false;
  }


}
