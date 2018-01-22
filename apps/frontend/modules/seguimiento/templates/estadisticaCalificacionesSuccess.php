<?php use_helper('SexyButton','Javascript') ?>

<div class="capa_principal" id="ordenarSeguimientoPorTemas">
  <div class="titulo_principal">
    <h2 class="titbox">Estad&iacute;sticas de calificaciones -
    <?php
      if ($display == 1)
      {
        echo "Ordenadas por tareas";
      }

      if ($display == 2)
      {
        echo "Ordenadas por alumno";
      }
    ?>
    </h2>
  </div>
  <div class="contenido_principal">

    <div class="herramientas_general_fixed" style="padding-bottom: 7px;">
      <table cell_padding="0" cell_spacing="0">
        <tr>
          <?php if ($display != 1):?>
            <td style="width: 160px; ">
              <?php {echo sexy_button_to('Estad&iacute;sticas por tarea', 'seguimiento/estadisticaCalificaciones?idcurso='.$id_curso.'&opcion=1'); } ?>
            </td>
          <?php endif;?>

          <?php if ($display != 2):?>
            <td style="width: 160px; ">
              <?php {echo sexy_button_to('Estad&iacute;sticas por alumno', 'seguimiento/estadisticaCalificaciones?idcurso='.$id_curso.'&opcion=2'); } ?>
            </td>
          <?php endif;?>

        </tr>
      </table>
    </div>

    <?php echo input_hidden_tag('id_curso', $curso->getId()) ?>

    <?php if ($display == 1):?>

    <div class="titulos_tabla_general">
      <table  border='0'  width="100%">
        <tr>
          <th style="text-align:left; width: 485px; padding-left:3px;">Tarea</th>
          <th style="text-align:center; ">Opciones</th>
        </tr>
      </table>
    </div>


    <div class="listado_tabla_general">
      <table border='0' width='100%'>
        <?php $count = 0; ?>
        <?php foreach($tareas as $tarea):?>
          <?php if($tarea->getId() != 354): ?>
            <?php $fondo = (($count % 2 == 0))? " id=\"filarayada\"" : ""; ?>
            <?php echo "<tr $fondo>" ?>
              <td style="text-align:left; width: 485px; padding-left:3px;">
                <div class='c_tarea<?=$tarea->getId()?>'><?php echo $tarea->getEjercicio()->getTitulo(); ?></div>
              </td>

              <td style="text-align:center;"><?php $alumnos = $tarea->getEntregas($id_curso)?>
                <?php if ($alumnos) : ?>
                <?php echo link_to(image_tag('ico_graficas_peq.gif', 'alt="Gr&aacute;ficas de los alumnos" title="Gr&aacute;ficas de los alumnos" align="absmiddle"'),'seguimiento/grafica?idtarea='.$tarea->getId().'&tipo=tareaVSalumnos&idcurso='.$id_curso, array('class' => 'a_explicito','id'=>'ln_grafica_tarea'.$tarea->getId())) ?>
                <?php //echo link_to('Gr&aacute;fica de alumnos','seguimiento/grafica?idtarea='.$tarea->getId().'&tipo=tareaVSalumnos&idcurso='.$id_curso, array('class' => 'a_explicito')) ?>
                <?php else : ?>
                (No hay entregas de esta tarea)
                <?php endif; ?>
              </td>

            </tr>
            <?php $count++; ?>
          <?php endif; ?>  
        <?php endforeach;?>
      </table>
      <?php if (!$count):?>
        <?php use_helper('informacion') ?>
        <?php echoAvisoVacio("No se ha mandado ninguna tarea o examen");?>
      <?php endif; ?>
    </div>
    <?php endif;?>



    <?php if ($display == 2):?>
      <div class="titulos_tabla_general">
        <table  border='0'  width="100%">
          <tr>
            <th style="text-align:left; width: 485px; padding-left:3px;">Alumno</th>
            <th style="text-align:center;">Gr&aacute;ficas</th>
          </tr>
        </table>
      </div>

      <div class="listado_tabla_general">
        <table border='0' width='100%'>
        <?php $count = 0; ?>
        <?php foreach($alumnos as $alumno):?>
          <?php $fondo = (($count % 2 == 0))? " id=\"filarayada\"" : ""; ?>
          <?php echo "<tr $fondo height=\"20\">" ?>
          <td style="text-align:left; width: 485px; padding-left:3px;"><div class='c_alumno<?=$alumno->getId()?>'><?php echo $alumno->getNombre().' '.$alumno->getApellidos()?></div></td>
          <td style="text-align:center;"><?php $tareas = $alumno->getTareasCorregidas($id_curso)?>
            <?php if ($tareas) : ?>
            <?php echo link_to(image_tag('ico_graficas_peq.gif', 'alt="Gr&aacute;ficas de las tareas" title="Gr&aacute;ficas de las tareas" align="absmiddle"'), 'seguimiento/grafica?idusuario='.$alumno->getId().'&tipo=alumnoVStareas&idcurso='.$id_curso, array('class' => 'a_explicito','id'=>'ln_tareas_alumno'.$alumno->getId())) ?>
            <?php else : ?>
            (No hay entregas de esta tarea)
            <?php endif; ?>
          </td>
          </tr>
          <?php $count++; ?>
        <?php endforeach;?>
        </table>
        <?php if (!$count):?>
          <?php use_helper('informacion') ?>
          <?php echoAvisoVacio("No hay alumnos en el curso");?>
        <?php endif; ?>
      </div>
    <?php endif;?>

    <br><?php use_helper('volver'); echo volver(); ?>
  </div>

  <div class="cierre_principal"></div>
</div>
