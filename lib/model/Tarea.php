<?php

/**
 * Subclass for representing a row from the 'tarea' table.
 *
 *
 *
 * @package lib.model
 */
class Tarea extends BaseTarea
{

  // Nombre del método: contar_pendientes()
  // Añadida por: Angel Martín Latasa
  // Descripción: Devuelve el número de ejercicios pendientes de corrección
  // asociados a la tarea
  public function contar_pendientes()
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, null, Criteria::NOT_EQUAL);
    $c->add(Rel_usuario_tareaPeer::CORREGIDA, 0);
    return Rel_usuario_tareaPeer::DoCount($c);
  }

  // Nombre del método: contar_pendientes()
  // Añadida por: Angel Martín Latasa
  // Descripción: Devuelve el número de ejercicios corregidos
  // asociados a la tarea
  public function contar_corregidos()
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, null, Criteria::NOT_EQUAL);
    $c->add(Rel_usuario_tareaPeer::CORREGIDA, 1);
    return Rel_usuario_tareaPeer::DoCount($c);
  }

  // Nombre del método: contar_alumnos()
  // Añadida por: Angel Martín Latasa
  // Descripción: Devuelve el número de alumnos implicados en una tarea
  public function contar_alumnos()
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $this->getId());
    return Rel_usuario_tareaPeer::DoCount($c);
  }

  // Nombre del método: getEntregas($id_curso)
  // Añadida por: Angel Martín Latasa
  // Descripción: Devuelve los alumnos que han entregado la tarea
  public function getEntregas($id_curso)
  {
     $c = new Criteria();
     $c->add(TareaPeer::ID, $this->id);
     $c->add(TareaPeer::ID_CURSO, $id_curso);
     $c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);
     $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
     $c->addJoin(UsuarioPeer::ID, Rel_usuario_tareaPeer::ID_USUARIO);
     return UsuarioPeer::DoSelect($c);
  }

  // Nombre del método: comprobarPermisoResolver($id_curso)
  // Añadida por: Jacobo Chaquet Ulldemolins
  /* Descripción: Devuelve la relacion (Rel_usuario_tarea) si  existe o null
  */
  public function comprobarPermisoMostrar($id_usuario)
  {
     $c = new Criteria();
     $c->add(Rel_usuario_tareaPeer::ID_TAREA, $this->id);
     $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
     $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);

     return $relacion;
  }
  // Nombre del método: comprobarPermisoResolver($id_curso)
  // Añadida por: Jacobo Chaquet Ulldemolins
  /* Descripción: Devuelve los true o false
                  Devolvera true si el alumno tiene esa tarea asignada y aun no ha sido entregada
                  encaso contrario false
  */
  public function comprobarPermisoResolver($id_usuario)
  {
     $relacion = $this->comprobarPermisoMostrar($id_usuario);
     if (!$relacion)
     {
       return false; //el usuario no tiene asignada la tarea
     }

     if (1==$relacion->getEntregada())
     {
       return false;
     }else return true;
  }




}
