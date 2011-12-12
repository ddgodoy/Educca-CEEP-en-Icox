<?php if (isset($cursos)) :  ?>
  <?php foreach($cursos as $curso) :?>
    <?php 
      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso->getIdCurso());
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
      $c->add(RolPeer::NOMBRE, 'profesor');
      $profesores = UsuarioPeer::doSelect($c);
      $cursoh = CursoPeer::RetrieveByPk($curso->getIdCurso());
    ?>
    <?php include_partial('listarProfesores', array('profesores' => $profesores, 'curso' => $cursoh, 'busqueda' => false, 'opciones' => false)) ?>
    <br>
  <?php endforeach; ?>
<?php endif; ?>
