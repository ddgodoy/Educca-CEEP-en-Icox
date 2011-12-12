<?php

  // Nombre del m�todo: getMensajesNoLeidos($usuario)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: Devuelve el n�mero de mensajes no leidos del usuario que est�
  // conectado
  function getMensajesNoLeidos($usuario)
  {
    $id_usuario = $usuario->getAnyId();

    $c = new Criteria();

    $c->add(MensajePeer::ID_PROPIETARIO, $id_usuario);
    $c->add(MensajePeer::ID_DESTINATARIO, $id_usuario);
    $c->add(MensajePeer::LEIDO, 0);
    $c->add(MensajePeer::BORRADO, 0);

    if ($usuario->hasCredential('alumno')) {$rol = 'alumno';}
    if ($usuario->hasCredential('profesor')) {$rol = 'profesor';}
    if ($usuario->hasCredential('supervisor'))
    {
       $rol = 'supervisor';
       $c->add(MensajePeer::SUPERVISOR, 1);
       return MensajePeer::DoCount($c);
    }else $c->add(MensajePeer::SUPERVISOR, 0);

    $c->add(RolPeer::NOMBRE, $rol);
    $c->add(MensajePeer::ID_PROPIETARIO, $id_usuario);
    $c->add(MensajePeer::ID_DESTINATARIO, $id_usuario);
    $c->add(MensajePeer::LEIDO, 0);
    $c->add(MensajePeer::BORRADO, 0);
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);

    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, MensajePeer::ID_CURSO);

    return MensajePeer::DoCount($c);

  }

?>
