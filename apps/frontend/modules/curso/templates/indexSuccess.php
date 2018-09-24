<?php use_helper('Text') ?>
<?php $idcurso = $curso->getId(); ?>
<?php $usuario = UsuarioPeer::retrieveByPk($sf_user->getAnyId()); ?>  




<?php if ($sf_user->getCursoMenu()) : ?>
        <?php $redireccion = "?idcurso=".$sf_user->getCursoMenu(); ?>
   <?php else  : ?>
         <?php $redireccion = "?" ; ?>
   <?php endif; ?>

<div id="miscursos_g">
  <div class="tit_box_mensajes">
    <h2 class="titbox"><?php echo $curso->getNombre(120);?></h2>
    <div style="display: flex; align-items: center; height: 30px; " align="right" > <?php echo 'Primer conex: '.$fecha_primer_conex.' / '.'fecha ultima conex: '.$fecha_ultima_conex;?> </div>
  </div>
  <div class="cont_box_correo">
      <table class="tablaopciones">
		<?php if ($curso->getMenuInfo()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_info.gif', 'Title=Mostrar normativa'), '/curso/mostrarNormativa?idcurso='.$idcurso, array('id' => 'ln_info_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Informaci&oacute;n General y Normativa', '/curso/mostrarNormativa/?idcurso='.$idcurso, array('id' => 'ln_info_texto' )) ?></div>
            <div class="explicacion">Normas e informaci&oacute;n general sobre el curso.</div>
          </td>
        </tr>
    	<tr>
           <td colspan="2" class="separador">
           </td>
        </tr>

      <?php endif; ?>

    	<?php if ($curso->getMenuTemario()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_revisar.gif', 'Title=Revisar temario'), '/curso/mostrarTemas?idcurso='.$idcurso,array('id' => 'ln_temario_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Revisar temario', '/curso/mostrarTemas?idcurso='.$idcurso,array('id' => 'ln_temario_texto' )) ?></div>
            <div class="explicacion">Acceso al contenido did&aacute;ctico del curso.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
     <?php endif; ?>


      <?php if ($curso->getMenuBibliotecaArchivos()) :?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('book-stack-g.png', 'Title=Biblioteca de archivos'), '/biblioteca_archivos/index?idcurso='.$idcurso,array('id' => 'ln_biblioteca_archivos_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Biblioteca de archivos', '/biblioteca_archivos/index?idcurso='.$idcurso,array('id' => 'ln_biblioteca_archivos_texto' )) ?></div>
            <div class="explicacion">Acceso a la biblioteca de ficheros del curso.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
     <?php endif; ?>

		<?php if ($curso->getMenuBiblio()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_bibliografia.gif', 'Title=Bibliograf&iacute;a del curso'), '/curso/mostrarBibliografia?idcurso='.$idcurso,array('id' => 'ln_biblio_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Bibliograf&iacute;a', '/curso/mostrarBibliografia?idcurso='.$idcurso,array('id' => 'ln_biblio_texto' )) ?></div>
            <div class="explicacion">Bibliograf&iacute;a te&oacute;rica y pr&aacute;ctica recomendada para la asignatura.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
		<?php endif; ?>

		<?php if ($curso->getMenuSeguimiento()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_seguimiento.gif', 'Title=Seguimiento'), '/seguimiento/index?idcurso='.$idcurso,array('id' => 'ln_seguimiento_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Seguimiento', '/seguimiento/index?idcurso='.$idcurso,array('id' => 'ln_seguimiento_texto' )) ?></div>
            <div class="explicacion">El seguimiento engloba estad&iacute;sticas e informes sobre el trabajo, progreso, tiempo invertido y notas obtenidas.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
		<?php endif; ?>


		<?php if ($curso->getMenuEventos()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_eventos.gif', 'Title=Eventos'), '/calendario/mostrarCalendario?idcurso='.$idcurso,array('id' => 'ln_eventos_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Eventos', '/calendario/mostrarCalendario?idcurso='.$idcurso,array('id' => 'ln_eventos_texto' )) ?></div>
            <div class="explicacion">En el calendario aparecen avisos, tutor&iacute;as y otros eventos relacionados con el curso.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
		<?php endif; ?>

		<?php if ($curso->getMenuChat()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_chat.gif', 'Title=Chat'), 'chat/jquery?id='.$sf_user->getCursoMenu(),array(
  														'popup' => array('', 'width=650,height=600,left=320,top=0'),'id' => 'ln_chat_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Chat', 'chat/jquery?id='.$sf_user->getCursoMenu(),array(
  														'popup' => array('', 'width=650,height=600,left=320,top=0'),'id' => 'ln_chat_texto')) ?></div>
            <div class="explicacion">El servicio de chat ofrece un canal para cada curso en el que podr&aacute; hablar en tiempo real con otros alumnos y profesores.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
		<?php endif; ?>

		<?php if ($curso->getMenuForo()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_foro.gif', 'Title=Foro'), 'sfSimpleForum/foroCurso'.$redireccion,array('id' => 'ln_foro_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Foro', 'sfSimpleForum/foroCurso'.$redireccion,array('id' => 'ln_foro_texto' )) ?></div>
            <div class="explicacion">El foro de discusi&oacute;n permite a alumnos y profesores intercambiar opiniones sobre el curso.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <?php endif; ?>

    <?php if ($sf_user->hasCredential('profesor')) : ?>
		<?php if ($curso->getMenuEjercicios()) : ?>
        <tr>
          <td class="imagen">

            <?php echo link_to(image_tag('bot_cur_ejercicio.gif', 'Title=Gestor de ejercicios'), '/ejercicio/index',array('id' => 'ln_ejercicios_ico' )) ?>
          </td>
          <td class="explica">

            <div class="titulo"><?php echo link_to('Editor de ejercicios', '/ejercicio/index?idcurso='.$idcurso,array('id' => 'ln_ejercicios_texto' )) ?></div>
            <div class="explicacion">El editor permite crear y editar ejercicios del curso para que los alumnos practiquen o para enviarlos como tareas o ex&aacute;menes.</div>

          </td>
        </tr>

        <tr>
        <td colspan="2" class="separador">
        </td>
        </tr>

        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_pendientes.gif', 'Title=Evaluaci&oacute;n'), '/evaluacion/index',array('id' => 'ln_evaluacion_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Evaluaci&oacute;n', '/evaluacion/index',array('id' => 'ln_evaluacion_texto' )) ?></div>
            <div class="explicacion">Este apartado permite corregir los ejercicios entregados, ver calificaciones obtenidas por los alumnos hasta la fecha y poner las notas finales del curso.</div>
          </td>
        </tr>


        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>

        <?php if(!$usuario->getInspector()): ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_asignar.gif', 'Title=Tareas y ex&aacute;menes'), '/tareas/index',array('id' => 'ln_tarea_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Tareas y ex&aacute;menes', '/tareas/index',array('id' => 'ln_tarea_texto' )) ?></div>
            <div class="explicacion">Desde este apartado se pueden poner tareas o un examen para los alumnos del curso, modificar las fechas o los plazos de entrega de estos.</div>
          </td>
        </tr>
        <?php endif; ?>
		<?php endif; ?>

  <?php else : ?>
  		<?php if ($curso->getMenuEjercicios()) : ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_ejercicio.gif', 'Title=Repositorio de ejercicios'), '/ejercicio/ejercicios'.$redireccion,array('id' => 'ln_repositorio_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Repositorio de ejercicios', '/ejercicio/ejercicios'.$redireccion,array('id' => 'ln_repositorio_texto' )) ?></div>
            <div class="explicacion">En este apartado se pueden encontrar los ejercicios pr&aacute;cticos publicados por el profesor y sus soluciones.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        
        <?php if(!$usuario->getInspector()): ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_asignar.gif', 'Title=Tareas y ex&aacute;menes'), '/tareas/index',array('id' => 'ln_tarea_ico' )) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Tareas y ex&aacute;menes', '/tareas/index',array('id' => 'ln_tarea_texto' )) ?></div>
            <div class="explicacion">Desde este apartado se puede acceder a las tareas y ex&aacute;menes pendientes, as&iacute; como al historial de entregas.</div>
          </td>
        </tr>
        <?php endif; ?>

     <?php endif; ?>
  <?php endif; ?>

      </table>
  </div>
  <div class="cierre_box_correo"></div>
</div>

