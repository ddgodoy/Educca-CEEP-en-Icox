<?php

/**
 * Subclass for representing a row from the 'notificacion' table.
 *
 *
 *
 * @package lib.model
 */
class Notificacion extends BaseNotificacion
{
 /**
 *
 * @name         setInfo($idusuario,$idcurso,$contenido,$texto)
 * @access       public
 * @author       Jacobo Chaquet
 *               inserta una nueva notificacion
 */
  public function setInfo($idusuario,$idcurso,$titulo,$contenido,$fecha=null,$tipo=null)
  {
    $this->setIdUsuario($idusuario);
    $this->setIdCurso($idcurso);
    $this->setTitulo($titulo);
    $this->setContenido($contenido);
    $this->setFecha($fecha);
    $this->setTipo($tipo);
    $this->save();
  }

 /**
 *
 * @name         comprobarPermiso($idusuario)
 * @access       public
 * @author       Jacobo Chaquet
 *               comprueba que la notificaion pertenece al usuario
 */
  public function comprobarPermiso($idusuario)
  {
    if ($this->getIdUsuario()==$idusuario)
    {
      return true;
    }else return false;
  }
}
