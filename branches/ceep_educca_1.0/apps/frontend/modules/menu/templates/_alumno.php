  <?php if ($sf_user->getCursoMenu()) : ?>
        <?php $redireccion = "?idcurso=".$sf_user->getCursoMenu(); ?>
   <?php else  : ?>
         <?php $redireccion = "?" ; ?>
   <?php endif; ?>
   <?php if ($sf_user->getCursoMenu()) : ?>
   <? $curso = CursoPeer::retrieveByPk($sf_user->getCursoMenu()); ?>
   <div class="tit_box_menu"><h2 class="titbox">Opciones del curso</h2></div>
      <ul class="listamenu">
          <li class="inicio"><?php echo link_to('Inicio', 'curso/index?idcurso='.$sf_user->getCursoMenu(),array('name' => 'ln_inicio')) ?></li>

        <?if ($curso->getMenuInfo()) :?>
          <li class="info_c"><?php echo link_to('Informaci&oacute;n General', 'curso/mostrarNormativa'.$redireccion,array('name' => 'ln_normativa')) ?></li>
        <? endif;?>

        <?if ($curso->getMenuTemario()) :?>
          <li class="cursos_c"><?php echo link_to('Revisar Temario', 'curso/mostrarTemas'.$redireccion,array('name' => 'ln_temas')) ?></li>
        <? endif; ?>

        <?if ($curso->getMenuBibliotecaArchivos()) :?>
          <li class="archivos_c"><?php echo link_to('Biblioteca Archivos', 'biblioteca_archivos/index'.$redireccion,array('name'=>'ln_biblioteca_archivos')) ?></li>
        <? endif; ?>

        <?if ($curso->getMenuBiblio()) :?>
          <li class="biblio_c"><?php echo link_to('Bibliograf&iacute;a', 'curso/mostrarBibliografia'.$redireccion,array('name' => 'ln_bibliografia')) ?></li>
        <? endif; ?>

        <?if ($curso->getMenuSeguimiento()) :?>
          <li class="seguimiento_c"><?php echo link_to('Seguimiento', 'seguimiento/index'.$redireccion,array('name' => 'ln_seguimiento')) ?></li>
        <? endif; ?>

        <?if ($curso->getMenuEventos()) :?>
    		  <li class="calendario_c"><?php echo link_to('Eventos del curso', 'calendario/mostrarCalendario'.$redireccion,array('name' => 'ln_eventos')) ?></li>
    		<? endif; ?>

    		<?if ($curso->getMenuChat()) :?>
          <li class="chat_c"><?php echo link_to('Chat del curso', 'chat/jquery?id='.$sf_user->getCursoMenu(),array('popup' => array('', 'width=650,height=600,left=320,top=0','name'=>'ln_chat'))) ?></li>
    	 	<? endif; ?>

    	 	<?if ($curso->getMenuForo()) :?>
         <li class="foros_c"><?php echo link_to('Foros', 'sfSimpleForum/foroCurso'.$redireccion,array('name' => 'ln_foro')) ?></li>
        <? endif; ?>

        <?if ($curso->getMenuEjercicios()) :?>
          <li class="repositorio_c"><?php echo link_to('Repositorio de ejercicios', 'ejercicio/ejercicios'.$redireccion,array('name' => 'ln_ejercicios')) ?></li>
          <li class="ejercicios_c"><?php echo link_to('Tareas y ex&aacute;menes', 'tareas/index'.$redireccion,array('name' => 'ln_tareas'))?></li>
        <? endif; ?>
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
   <?if ($sf_user->getCursoMenu()) : ?>
       <?php include_partial('online/menu') ;?>
   <? endif; ?>
