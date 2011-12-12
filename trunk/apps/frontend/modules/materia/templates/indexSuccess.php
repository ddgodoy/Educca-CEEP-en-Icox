<?php $idcurso = $curso->getId(); ?>
<div id="miscursos_g">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $curso->getNombre() ?>: &Iacute;ndice</h2></div>
  <div class="cont_box_correo">
      <table class="tablaopciones">
	     	<tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_revisar.gif'), '/materia/mostrarTemas?idcurso='.$idcurso) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('TEMA 1: La Constitución de 1978', '/materia/mostrarTemas?idcurso='.$idcurso) ?></div>
            <div class="explicacion">Permite crear nuevos ejercicios pr&aacute;cticos para el curso, cuestionarios y ex&aacute;menes, adem&aacute;s de modificar o eliminar los ya existentes.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_eventos.gif'), '/seguimiento/mostrarPlanificacionAlumno?idcurso='.$idcurso) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('TEMA 2', '/seguimiento/mostrarPlanificacionAlumno?idcurso='.$idcurso) ?></div>
            <div class="explicacion">Desde esta opci&oacute;n podr&aacute; proponer un examen para una fecha libre del calendario de ex&aacute;menes.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_chat.gif'), '/seguimiento/mostrarTiemposAlumno?id='.$idcurso) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('TEMA 3', '/seguimiento/mostrarTiemposAlumno?id='.$idcurso) ?></div>
            <div class="explicacion">Aqu&iacute; el alumno podr&r&aacute; ver los tiempos que ha empleado en cada uno de los temas del curso.</div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_cur_foro.gif'), '/materia/mostrarBibliografia?id='.$idcurso) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('TEMA 4', '/materia/mostrarBibliografia?id='.$idcurso) ?></div>
            <div class="explicacion">Desde esta opci&oacute;n podr&aacute; proponer un examen para una fecha libre del calendario de ex&aacute;menes.</div>
          </td>
        </tr>
      </table>
  </div>
  <div class="cierre_box_correo"></div>
</div>


