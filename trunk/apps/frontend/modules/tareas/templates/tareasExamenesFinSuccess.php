<?php use_helper('Javascript') ?>

<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Poner tareas y ex&aacute;menes - Completado</h2></div>
  <div class="contenido_principal">
       <table class="tabla_resumen_tarea">
      <tr>
        <th class="td1">
          Curso elegido:
        </th>
        <td>
          <?php echo $nombre_curso ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Tipo de ejercicio:
        </th>
        <td>
          <?php echo $tipo_prueba ?>
          <?php if($sorpresa){echo(" sorpresa");}?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Ejercicio elegido:
        </th>
        <td>
          <?php echo $nombre_ejercicio ?>
        </td>
      </tr>
      <?php if($tipo_prueba == 'Tarea'): ?>
      <tr>
        <th class="td1">
          Fecha de inicio:
        </th>
        <td>
          <?php echo("El $fechaInicio a las ".substr($horaInicio,0,5 )); ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Fecha de entrega:
        </th>
        <td>
          <?php echo("El $fechaFin a las ".substr($horaFin,0,5 )); ?>
        </td>
      </tr>
      <?php endif;?>
      <?php if (($tipo_prueba == 'Examen') && (!$sorpresa)): ?>
      <tr>
        <th class="td1">
          Fecha:
        </th>
        <td>
          <?php echo("El $fechaInicio a las ".substr($horaInicio,0,5 )); ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Duraci&oacute;n del examen:
        </th>
        <td>
          <?php echo("$duracion minutos"); ?>
        </td>
      </tr>
      <?php endif;?>
      <?php if (($tipo_prueba == 'Examen') && ($sorpresa)): ?>
      <tr>
        <th class="td1">
          Comienzo del examen sorpresa:
        </th>
        <td>
          <?php echo("El $fechaInicio a las ".substr($horaInicio,0,5 )); ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Fin del examen sorpresa:
        </th>
        <td>
          <?php echo("El $fechaFin a las ".substr($horaFin,0,5 )); ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Duraci&oacute;n del examen:
        </th>
        <td>
          <?php echo("$duracion minutos"); ?>
        </td>
      </tr>
      <?php endif;?>
      <tr>
        <th class="td1">
          Alumnos:
        </th>
        <td>
          <?php foreach($implicados as $implicado):?>
            <?php echo $implicado ?><br>
          <?php endforeach;?>
        </td>
      </tr>
  </table>

  </div>
  <div class="cierre_principal"></div>
</div>

