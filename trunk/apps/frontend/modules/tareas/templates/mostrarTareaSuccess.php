<?php use_helper('Javascript') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">  Detalles
  <?php if ($tipo_evento->getDescripcion() == 'Tarea'):?>
    de la tarea
  <?php else:?>
    del examen
  <?php endif;?>
  </h2></div>
  <div class="contenido_principal">

    <table class="tabla_detalles_tarea">
      <tr>
        <th class="td1">Ejercicio a realizar:</th>
        <td><?php echo $evento->getDescripcion()?></td>
      </tr>
      <tr>
        <th class="td1">Categor&iacute;a:</th>
        <td><?php echo $tipo_evento->getDescripcion() ?></td>
      </tr>
      <tr>
        <th class="td1">Curso:</th>
        <td><?php echo($curso->getNombre());?></td>
      </tr>
      <tr>
        <?php if ($tipo_evento->getDescripcion() == 'Examen' || $tipo_evento->getDescripcion() == 'Examen sorpresa'):?>
          <th class="td1">Fecha: </th>
          <td>
            <?php echo($evento->getFechaInicio('d-m-y').' de '.$evento->getFechaInicio('H:i').' a '.$evento->getFechaFin('H:i'));?>
            <?php if ($ahora < $inicio): ?>
            <?php echo button_to('Cambiar fecha del examen', 'tareas/modificarTarea?opcion=0&id_evento='.$evento->getId().'&id_tarea='.$tarea->getId()) ?>
            <?php endif; ?>
          </td>
        <?php else:?>
          <th class="td1">Plazo de entrega: </th>
          <td>
            <?php echo('Del '.$evento->getFechaInicio('d-m-y').' a las '.$evento->getFechaInicio('H:i').' hasta el '.$evento->getFechaFin('d-m-y').' a las '.$evento->getFechaFin('H:i'));?>
            <?php if ($ahora < $inicio): ?>
              <?php echo button_to('Cambiar plazos', 'tareas/modificarTarea?opcion=1&id_evento='.$evento->getId().'&id_tarea='.$tarea->getId()) ?>
            <?php else:?>
              <?php if ($ahora < $fin): ?>
                <?php echo button_to('Cambiar fecha de entrega', 'tareas/modificarTarea?opcion=2&id_evento='.$evento->getId().'&id_tarea='.$tarea->getId()) ?>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        <?php endif;?>
      </tr>
      <?php if ($ahora < $inicio):?>
      <tr>
        <th class="td1">Estado: </th>
        <td><?php echo('En espera'); $estado = 0;?></td>
      </tr>
      <tr>
        <td class="td1">&nbsp;</td>
        <td><?echo link_to(image_tag('papelera.gif', array('alt' => 'Cancelar Tarea', 'title' => 'Cancelar Tarea'))
                           , 'tareas/cancelarTarea?id_evento='.$evento->getId(),
                           array( 'id' => 'ln_eliminar_tarea'.$tarea->getId(),
                                  'confirm' => '¿Estás seguro que desea elimnar la tarea?' )
                            );  ?>
        </td>
      </tr>
      <?php else:?>
        <?php if (($ahora >= $inicio) && ($ahora <= $fin)):?>
          <tr>
            <th class="td1">Estado: </th>
            <td><?php echo('Dentro del plazo'); $estado = 1;?></td>
          </tr>
          <tr>
            <td class="td1">&nbsp;</td>
            <td><?echo link_to(image_tag('papelera.gif', array('alt' => 'Cancelar Tarea', 'title' => 'Cancelar Tarea'))
                               , 'tareas/cancelarTarea?id_evento='.$evento->getId(),
                               array( 'id' => 'ln_eliminar_tarea'.$tarea->getId(),
                                      'confirm' => '¿Estás seguro que desea elimnar la tarea?' )
                                );  ?>
            </td>
          </tr>
        <?php else:?>
          <tr>
            <th class="td1">Estado: </th>
            <td><?php echo('Plazo terminado'); $estado = 2;?></td>
          </tr>
        <?php endif;?>
      <?php endif;?>

    </table>

    <br><br>

    <?php if ($tipo_evento->getDescripcion() == 'Tarea'): ?>
      Alumnos a los que se ha mandado esta tarea:
      <?php if (($add_more) && ($estado < 2)):?>
        <?php echo button_to('A&ntilde;adir alumnos', 'tareas/modificarTarea?opcion=3&id_evento='.$evento->getId().'&id_tarea='.$tarea->getId()) ?>
      <?php endif;?>
    <?php else:?>
      Alumnos convocados a este examen:
    <?php endif;?>

    <br><br>
    <?php include_partial('listarAlumnosTarea', array('elementos_lista' => $elementos_lista, 'estado' => $estado, 'evento' => $evento, 'tipo_tarea' => $tipo_evento->getDescripcion(), 'id_tarea' => $tarea->getId())) ?>


  </div>
  <div class="cierre_principal"></div>
</div>
