<?php $idcurso = $curso->getId(); ?>
<div id="miscursos_g">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $curso->getNombre(90) ?> : Seguimiento y planificaci&oacute;n</h2></div>
  <div class="cont_box_correo">
      <table class="tablaopciones">
      <?php if ($rol == 'alumno'):?>
      <?php if ($curso->getMenuPlanificacionAlumnos()):?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_hitos.gif'), 'seguimiento/sourceHitos?idcurso='.$idcurso) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Planificaci&oacute;n', 'seguimiento/sourceHitos?idcurso='.$idcurso) ?></div>
            <div class="explicacion">Muestra la gr&aacute;fica de planificaci&oacute;n del curso por temas, las fechas recomendadas por el profesor para su finalizaci&oacute;n y el progreso actual.</div>
          </td>
        </tr>
		    <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_pendientes.gif'), '/seguimiento/fichaEvaluacion?idcurso='.$idcurso, array('popup' => array('', 'width=765,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,top=0,left=200'))) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Mi ficha de evaluaci&oacute;n del curso', '/seguimiento/fichaEvaluacion?idcurso='.$idcurso, array('popup' => array('', 'width=765,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,top=0,left=200'))) ?></div>
            <div class="explicacion">Aqu&iacute; podr&aacute; ver la ficha de evaluaci&oacute;n del curso, donde se encuentran todas las notas obtenidas hasta el momento, tiempos dedicados a revisar temario y realizar ejercicios...</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_alumnos.gif'), 'seguimiento/grafica?idcurso='.$idcurso.'&tipo=alumno&idusuario='.$idusuario) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Tiempo dedicado por temas y ejercicios', 'seguimiento/grafica?idcurso='.$idcurso.'&tipo=alumno&idusuario='.$idusuario) ?></div>
            <div class="explicacion">Permite tener un control sobre el tiempo de estudio dedicado a cada tema del curso.</div>
          </td>
        </tr>

      <?php endif;?>

      <?php if ($rol == 'profesor'):?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_alumnos.gif'), '/seguimiento/listarAlumnosCurso?idcurso='.$idcurso,array('id' => 'ln_segAlumnos_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Lista de Alumnos', '/seguimiento/listarAlumnosCurso?idcurso='.$idcurso,array('id' => 'ln_segAlumnos_texto')) ?></div>
            <div class="explicacion">Le permite ver al profesor la lista de alumnos que tiene en el curso <?php $curso->getNombre()?>.</div>
          </td>
        </tr>
		    <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <?php if ($curso->getMenuPlanificacionAlumnos()):?>
		    <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_hitos.gif'), '/seguimiento/sourceHitos?idcurso='.$idcurso,array('id' => 'ln_segPlanificacion_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Planificaci&oacute;n del trabajo de cada alumno', '/seguimiento/sourceHitos?idcurso='.$idcurso,array('id' => 'ln_segPlanificacion_texto')) ?></div>
            <div class="explicacion">El profesor podr&aacute; establecer en qu&eacute; periodos se han de terminar cada uno de los temas del curso, y se le informar&aacute; de los alumnos que no cumples dichos periodos.</div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <?php endif;?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_alumnos.gif'), '/seguimiento/seguimientoPorTemas?idcurso='.$idcurso,array('id' => 'ln_segTemas_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Tiempos de estudio de los alumnos', '/seguimiento/seguimientoPorTemas?idcurso='.$idcurso,array('id' => 'ln_segTemas_texto')) ?></div>
            <div class="explicacion">El profesor puede ver los tiempos empleados por los alumnos en el estudio de cada uno de los temas que se imparten en su curso.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>

        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_estado.gif'), '/seguimiento/seguimientoTareas?idcurso='.$idcurso,array('id' => 'ln_segTareas_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Estado de las tareas y ex&aacute;menes', '/seguimiento/seguimientoTareas?idcurso='.$idcurso,array('id' => 'ln_segTareas_texto')) ?></div>
            <div class="explicacion">Este apartado est&aacute; dedicado al seguimiento de las tareas y ex&aacute;menes mandados a los alumnos. Podr&aacute; ver si los alumnos est&aacute;n trabajando en las tareas, cuando las entregaron, si se presentaron al examen. Tambi&eacute;n modificar la fecha de entrega de una tarea o la fecha de celebraci&oacute;n de un examen y a&ntilde;adir o quitar los alumnos a los que se les ha asignado una tarea o un examen.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_seg_ranking.gif'), '/seguimiento/estadisticaCalificaciones?idcurso='.$idcurso,array('id' => 'ln_segCalificaciones_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Estad&iacute;sticas de calificaciones', '/seguimiento/estadisticaCalificaciones?idcurso='.$idcurso,array('id' => 'ln_segCalificaciones_texto')) ?></div>
            <div class="explicacion">Le permite ver estad&iacute;sticas sobre las calificaciones obtenidas por los alumnos hasta la fecha.</div>
          </td>
        </tr>
      <?php endif;?>
      </table>
  </div>
  <div class="cierre_box_correo"></div>
</div>
