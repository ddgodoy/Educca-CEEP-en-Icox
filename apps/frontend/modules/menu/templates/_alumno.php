  <?php if ($sf_user->getCursoMenu()) : ?>
        <?php $redireccion = "?idcurso=".$sf_user->getCursoMenu(); ?>
   <?php else  : ?>
         <?php $redireccion = "?" ; ?>
   <?php endif; ?>
   <?php if ($sf_user->getCursoMenu()) : ?>
   <?php $curso = CursoPeer::retrieveByPk($sf_user->getCursoMenu()); ?>
   <div class="tit_box_menu"><h2 class="titbox">Opciones del curso</h2></div>
      <ul class="listamenu">
          <li class="inicio"><?php echo link_to('Inicio', 'curso/index?idcurso='.$sf_user->getCursoMenu(),array('name' => 'ln_inicio')) ?></li>

        <?php if ($curso->getMenuInfo()) :?>
          <li class="info_c"><?php echo link_to('Informaci&oacute;n General', 'curso/mostrarNormativa'.$redireccion,array('name' => 'ln_normativa')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuTemario()) :?>
          <li class="cursos_c"><?php echo link_to('Revisar Temario', 'curso/mostrarTemas'.$redireccion,array('name' => 'ln_temas')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuBibliotecaArchivos()) :?>
          <li class="archivos_c"><?php echo link_to('Biblioteca Archivos', 'biblioteca_archivos/index'.$redireccion,array('name'=>'ln_biblioteca_archivos')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuBiblio()) :?>
          <li class="biblio_c"><?php echo link_to('Bibliograf&iacute;a', 'curso/mostrarBibliografia'.$redireccion,array('name' => 'ln_bibliografia')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuSeguimiento()) :?>
          <li class="seguimiento_c"><?php echo link_to('Seguimiento', 'seguimiento/index'.$redireccion,array('name' => 'ln_seguimiento')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuEventos()) :?>
    		  <li class="calendario_c"><?php echo link_to('Eventos del curso', 'calendario/mostrarCalendario'.$redireccion,array('name' => 'ln_eventos')) ?></li>
    		<?php endif; ?>

    		<?php if ($curso->getMenuChat()) :?>
          <li class="chat_c"><?php echo link_to('Chat del curso', 'chat/jquery?id='.$sf_user->getCursoMenu(),array('popup' => array('', 'width=650,height=600,left=320,top=0','name'=>'ln_chat'))) ?></li>
    	 	<?php endif; ?>

    	 	<?php if ($curso->getMenuForo()) :?>
         <li class="foros_c"><?php echo link_to('Foros', 'sfSimpleForum/foroCurso'.$redireccion,array('name' => 'ln_foro')) ?></li>
        <?php endif; ?>

        <?php if ($curso->getMenuEjercicios()) :?>
          <li class="repositorio_c"><?php echo link_to('Repositorio de ejercicios', 'ejercicio/ejercicios'.$redireccion,array('name' => 'ln_ejercicios')) ?></li>
          <li class="ejercicios_c"><?php echo link_to('Tareas y ex&aacute;menes', 'tareas/index'.$redireccion,array('name' => 'ln_tareas'))?></li>
        <?php endif; ?>
    	</ul>
    <?php endif; ?>

    <!--div id="submenu"-->
	     <?php include_component_slot('submenu') ?>
	  <!--/div-->

    <div class="tit_box_menu"><h2 class="titbox">Men&uacute; principal</h2></div>
    <ul class="listamenu">
      <li class="cursos"><?php echo link_to('Mis Cursos', 'alumno/misCursos',array('name' => 'ln_mis_cursos')) ?></li>
      <li class="correo"><?php echo link_to('Correo', 'mensaje/mensajesRecibidos',array('name' => 'ln_correo')) ?></li>
      <!--li class="calendario"><?php echo link_to('Agenda personal', 'calendario/mostrarCalendario?principal=1',array('name' => 'ln_calendario_principal')) ?></li-->
      <li class="infopersonal"><?php echo link_to('Informacion Personal', 'usuario/mostrarPerfil',array('name' => 'ln_perfil')) ?></li>
      <li class="salir"><?php echo link_to('Salir', 'login/logout',array('name' => 'ln_logout')) ?></li>
   </ul>
   <?php if ($sf_user->getCursoMenu()) : ?>
       <?php include_partial('online/menu') ;?>
   <?php endif; ?>
