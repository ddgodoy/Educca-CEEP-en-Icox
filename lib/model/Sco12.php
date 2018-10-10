<?php

/**
 * Subclass for representing a row from the 'sco12' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Sco12 extends BaseSco12
{

  public function getRelacionAlumno ($id)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_sco12Peer::ID_SCO12, $this->getId());
    $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id);
    $rel = Rel_usuario_sco12Peer::doSelectOne($c);
    return $rel;
  }
}
