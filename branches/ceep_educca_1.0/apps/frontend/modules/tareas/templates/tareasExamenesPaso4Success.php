<script language="javascript" type="text/javascript">

var paridad=0;
function check_global() {
  paridad++;

  if (paridad % 2) {

  } else {

  }
}

</script>

<?php use_helper('Javascript') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Poner tareas y ex&aacute;menes - Paso 4</h2></div>
  <div class="contenido_principal">
    <?php echo form_tag('tareas/tareasExamenesFin') ?>

    <?php echo (input_hidden_tag('id_curso', $id_curso)); ?>
    <?php echo (input_hidden_tag('nombre_curso', $nombre_curso)); ?>
    <?php echo (input_hidden_tag('tipo_prueba', $tipo_prueba)); ?>
    <?php echo (input_hidden_tag('id_ejercicio', $id_ejercicio)); ?>
    <?php echo (input_hidden_tag('nombre_ejercicio', $nombre_ejercicio)); ?>
    <?php echo (input_hidden_tag('sorpresa', $sorpresa)); ?>
    <?php echo (input_hidden_tag('horaInicio', $horaInicio)); ?>
    <?php echo (input_hidden_tag('fechaInicio', $fechaInicio)); ?>
    <?php echo (input_hidden_tag('horaFin', $horaFin)); ?>
    <?php echo (input_hidden_tag('fechaFin', $fechaFin)); ?>
    <?php echo (input_hidden_tag('duracion', $duracion)); ?>

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
          <?php echo("El $fechaInicio a las $horaInicio"); ?>
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

    </table>
    <br><br>
    <div class="nota_informativa">Elija los alumnos del curso a los que mandar&aacute; esta tarea:</div>
    <br><br>
    <div class="titulos_tabla_general">
    <table class="tabla_alumnos_tarea">
      <tr>
        <th class="td1"><?php echo checkbox_tag("seleccionar_todos", 1, false, array('onClick' => 'checkAll()')) ?></th>
        <th class="td2">Apellidos, Nombre</th>
      </tr>
    </table>
    </div>

    <div class="listado_tabla_general">
    <table class="tabla_alumnos_tarea">
    <?php $indice = 0; foreach($alumnos as $alumno):?>
      <?php $fondo = (($indice % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <td class="td1"><?php echo checkbox_tag("id_alumno$indice", $alumno->getId(), false) ?></td>
        <td class="td2"><?php echo($alumno->getApellidos().", ".$alumno->getNombre()); ?></td>
      </tr>
      <?php $indice++;?>
    <?php endforeach;?>
    </table>
    </div>
    <?php echo (input_hidden_tag('total_alumnos', $indice)); ?>
    <br><br>
    <?php echo submit_tag('Finalizar', array('onClick' => 'return contar_checks();')) ?>
    </form>
  </div>
  <div class="cierre_principal"></div>
</div>
