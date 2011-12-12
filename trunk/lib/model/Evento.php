<?php

/**
 * Subclass for representing a row from the 'evento' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Evento extends BaseEvento
{

  public function contar_alumnos () {
    
    $c = new Criteria();
    if ($this->getPrivado()) {
      $c->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());
      return Rel_usuario_eventoPeer::DoCount($c);
    } else {
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getIdCurso());
      $c->add(RolPeer::NOMBRE, 'Alumno');
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      return Rel_usuario_rol_cursoPeer::DoCount($c);
    }
  }
  
  public function alumnos_evento () {
    
    $c = new Criteria();
    if ($this->getPrivado()) {
      $c->add(Rel_usuario_eventoPeer::ID_EVENTO, $this->getId());
      $c->addJoin(Rel_usuario_eventoPeer::ID_USUARIO, UsuarioPeer::ID);
      return UsuarioPeer::DoSelect($c);
    } else {
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->getIdCurso());
      $c->add(RolPeer::NOMBRE, 'Alumno');
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
      return UsuarioPeer::DoSelect($c);
    }
  }


}
