<?php use_helper('Javascript') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">  Seguimiento
  <?php if ($tipo_evento->getDescripcion() == 'Tarea'):?>
    de la tarea
  <?php else:?>
    del examen
  <?php endif;?>
  </h2></div>
  <div class="contenido_principal">

    <table class="tabla_detalles_tarea">
      <tr>
        <td class="td1">Ejercicio a realizar:</td>
        <td class='descripcion'><?php echo $evento->getDescripcion()?></td>
      </tr>
      <tr>
        <td class="td1">Categor&iacute;a:</td>
        <td class='categoria'><?php echo $tipo_evento->getDescripcion() ?></td>
      </tr>
      <tr>
        <th class="td1">Curso:</th>
        <td><?php echo($curso->getNombre());?></td>
      </tr>
      <tr>
        <?php if ($tipo_evento->getDescripcion() == 'Examen' || $tipo_evento->getDescripcion() == 'Examen sorpresa'):?>
          <td class="td1">Fecha: </td>
          <td>
            <?php echo($evento->getFechaInicio('d-m-y').' de '.$evento->getFechaInicio('H:i').' a '.$evento->getFechaFin('H:i'));?>
          </td>
        <?php else:?>
          <td class="td1">Plazo de entrega: </td>
          <td>
            <?php echo('Del '.$evento->getFechaInicio('d-m-y').' a las '.$evento->getFechaInicio('H:i').' hasta el '.$evento->getFechaFin('d-m-y').' a las '.$evento->getFechaFin('H:i'));?>
          </td>
        <?php endif;?>
      </tr>
      <?php if ($ahora < $inicio):?>
      <tr>
        <td class="td1">Estado: </td>
        <td><?php echo('En espera'); $estado = 0;?></td>
      </tr>
      <?php else:?>
        <?php if (($ahora >= $inicio) && ($ahora <= $fin)):?>
          <tr>
            <td class="td1">Estado: </td>
            <td><?php echo('Dentro del plazo'); $estado = 1;?></td>
          </tr>
        <?php else:?>
          <tr>
            <td class="td1">Estado: </td>
            <td><?php echo('Plazo terminado'); $estado = 2;?></td>
          </tr>
        <?php endif;?>
      <?php endif;?>

    </table>

    <br><br>

    <?php if ($tipo_evento->getDescripcion() == 'Tarea'): ?>
      Alumnos a los que se ha mandado esta tarea:
    <?php else:?>
      Alumnos convocados a este examen:
    <?php endif;?>

    <br><br>
    <?php include_partial('listarAlumnosTarea', array('elementos_lista' => $elementos_lista, 'estado' => $estado, 'evento' => $evento, 'tipo_tarea' => $tipo_evento->getDescripcion(), 'id_tarea' => $tarea->getId())) ?>

    <br><? use_helper('volver'); echo volver(); ?>
  </div>
  <div class="cierre_principal"></div>
</div>
