<?php

/**
 * Subclass for representing a row from the 'tema' table.
 *
 *
 *
 * @package lib.model
 */
class Tema extends BaseTema
{

  // Nombre del m�todo: getDuracionAlumno($idusuario)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve el tiempo que el usuario ha estado en ese tema
   */
 public function getDuracionAlumno($idusuario)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_temaPeer::ID_USUARIO, $idusuario);
    $c->add(Rel_usuario_temaPeer::ID_TEMA, $this->id);
    $rel = Rel_usuario_temaPeer::doSelectOne($c);
    if ($rel) {
       return $rel->getTiempo();
    }
    else return 0;


  }

  // Nombre del m�todo: getEstadoAlumno($idusuario)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve el estado del usuario en ese tema
   */
 public function getEstadoAlumno($idusuario, $crit = null)
  {

	if (null != $crit) {
   	    $c = clone $crit;
   	}else $c = new Criteria();

    $c->add(Rel_usuario_temaPeer::ID_USUARIO, $idusuario);
    $c->add(Rel_usuario_temaPeer::ID_TEMA, $this->id);
    $rel = Rel_usuario_temaPeer::doSelectOne($c);

    if ($rel) {
       return  $rel->getEstado();
    }
    else return 0;
  }

  // Nombre del m�todo: getEstadosAlumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve los estados de los usuarios en ese tema
   */
 public function getEstadosAlumnos($crit = null)
  {

	if (null != $crit) {
   	    $c = clone $crit;
   	}else $c = new Criteria();

    $c->add(Rel_usuario_temaPeer::ID_TEMA, $this->id);
    $rel = Rel_usuario_temaPeer::doSelect($c);

    return $rel;

  }

  // Nombre del m�todo: getCursos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve los cursos en los que esta ese tema
   */
 public function getCursos($crit = null)
  {

	if (null != $crit) {
   	    $c = clone $crit;
   	}else $c = new Criteria();

    $c->add(CursoPeer::MATERIA_ID,$this->id_materia);
    $rel = CursoPeer::doSelect($c);

    return $rel;

  }



}
