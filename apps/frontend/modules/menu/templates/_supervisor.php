<div class="tit_box_menu"><h2 class="titbox">Men&uacute; principal</h2></div>
  <ul class="listamenu">
    <li class="inicio"><?php echo link_to('Inicio', 'supervisor/index',array('name' => 'ln_inicio')) ?></li>
    <li class="infopersonal"><?php echo link_to('Informacion Personal', 'usuario/mostrarPerfil',array('name' => 'ln_perfil')) ?>
    <li class="cursos"><?php echo link_to('Cursos', 'supervisor/cursos',array('name' => 'ln_cursos')) ?></li>
    <li class="modulos"><?php echo link_to('M&oacute;dulos', 'supervisor/modulos',array('name' => 'ln_modulos')) ?></li>
    <li class="correo"><?php echo link_to('Correo', 'mensaje/mensajesRecibidos',array('name' => 'ln_correo')) ?></li>
    <li class="profesores"><?php echo link_to('Profesores', 'supervisor/listaProfesores',array('name' => 'ln_profesores')) ?></li>
    <li class="alumnos"><?php echo link_to('Alumnos', 'supervisor/listaAlumnos',array('name' => 'ln_alumnos')) ?></li>
    <li class="salir"><?php echo link_to('Salir', 'login/logout',array('name' => 'ln_logout')) ?></li>
  </ul>
<?php include_component_slot('submenu') ?>
