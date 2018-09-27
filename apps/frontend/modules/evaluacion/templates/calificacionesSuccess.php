<?php use_helper('Javascript') ?>
<?php use_helper('formularios') ?>
<?php echo javascript_tag("
  var pulsado1 = 0;
  var pulsado2 = 0;
  function mostrar_ejercicios_obligatorios() {
    if (pulsado1 == 0) {".visual_effect('appear', 'ejercicios_obligatorios')."}
    else {".visual_effect('fade', 'ejercicios_obligatorios')."}
    pulsado1 = (pulsado1 + 1) % 2; 
  }
")?>

<?php echo javascript_tag("
  function mostrar_ejercicios_opcionales() {
    if (pulsado2 == 0) {".visual_effect('appear', 'ejercicios_opcionales')."}
    else {".visual_effect('fade', 'ejercicios_opcionales')."}
    pulsado2 = (pulsado2 + 1) % 2; 
  }
")?>

<?php echo javascript_tag("
  function pasarParametros() {
    document.getElementById('submit_opciones').click();
  }
")?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Calificaciones obtenidas por los alumnos hasta la fecha</h2></div>
  <div class="contenido_principal">
    
    <div class="filtro_general">
    <?php echo form_remote_tag(array('update' => 'div_calificaciones', 'url' => 'evaluacion/procesar'), array('name' => 'form1')) ?>
    <input type="submit" id="submit_opciones" style="display:none;">
    <table width="100%">
      <tr>
        <td width="50%">
          Curso: <?php echoSelectwMatch('filtro', $id_curso, $cursos, array('class' => 'select'));?>
          <?php echo observe_field('filtro', array('update'=>'div_calificaciones', 'url'=>'evaluacion/listarAlumnosEvaluacion', 'with' => "'filtro=' + value")) ?>
        </td>
        <td width="50%">
          &nbsp;
        </td>
      </tr>
    </table>
    </form>
    </div>
    <div id="div_calificaciones"></div>
    <?php echo javascript_tag(remote_function(array('update' => 'div_calificaciones', 'url' => 'evaluacion/listarAlumnosEvaluacion', 'with' => "'filtro=' + document.form1.filtro.value"))) ?>

  </div>
 <div class="cierre_principal"></div>
</div>
