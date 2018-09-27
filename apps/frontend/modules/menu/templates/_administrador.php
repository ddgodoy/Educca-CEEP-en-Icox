  <div class="tit_box_menu"><h2 class="titbox">Men&uacute; principal</h2></div>
  <ul class="listamenu">
    <li class="inicio"><?php echo link_to('Inicio', 'admin/index',array('name' => 'ln_inicio')) ?></li>
    <li class="infopersonal"><?php echo link_to('Informacion Personal', 'usuario/mostrarPerfil',array('name' => 'ln_perfil')) ?></li>
    <li class="materias"><?php echo link_to('Materias', 'admin/materias',array('name' => 'ln_materias')) ?></li>
    <li class="gejercicios_a"><?php echo link_to('Ejercicios', 'admin/ejercicios',array('name' => 'ln_ejercicios')) ?></li>
    <li class="cursos"><?php echo link_to('Cursos', 'admin/cursos',array('name' => 'ln_cursos')) ?></li>
    <li class="modulos"><?php echo link_to('M&oacute;dulos', 'admin/modulos',array('name' => 'ln_modulos')) ?></li>
    <li class="usuarios"><?php echo link_to('Usuarios', 'admin/usuarios',array('name' => 'ln_usuarios')) ?></li>
    <li class="superusuarios"><?php echo link_to('Super Usuarios', 'admin/usuarios?superUsuario=1',array('name' => 'ln_superUsuarios')) ?></li>
    <li class="profesores"><?php echo link_to('Profesores', 'admin/profesores',array('name' => 'ln_profesores')) ?></li>
    <li class="alumnos"><?php echo link_to('Alumnos', 'admin/alumnos',array('name' => 'ln_alumnos')) ?></li>
    <li class="morosos"><?php echo link_to('Morosos', 'admin/morosos',array('name' => 'ln_morosos')) ?></li>
    <li class="ticket"><?php echo link_to('Tickets', 'ticket/ticketsAdmin',array('name' => 'ln_ticket')) ?></li>
    <li class="salir"><?php echo link_to('Salir', 'login/logout',array('name' => 'ln_logout')) ?></li>
  </ul>