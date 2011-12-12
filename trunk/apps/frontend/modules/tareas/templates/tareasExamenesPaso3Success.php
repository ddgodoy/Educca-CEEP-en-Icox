<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Poner tareas y ex&aacute;menes - Paso 3</h2></div>
  <div class="contenido_principal">

    <?php echo form_tag('tareas/tareasExamenesPaso4') ?>
    <?php echo (input_hidden_tag('id_curso', $id_curso)); ?>
    <?php echo (input_hidden_tag('nombre_curso', $nombre_curso)); ?>
    <?php echo (input_hidden_tag('tipo_prueba', $tipo_prueba)); ?>
    <?php echo (input_hidden_tag('id_ejercicio', $id_ejercicio)); ?>
    <?php echo (input_hidden_tag('nombre_ejercicio', $nombre_ejercicio)); ?>
    <?php echo (input_hidden_tag('sorpresa', $sorpresa)); ?>

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
          Tipo de ejercicio
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
    </table>

    <br><br>

    <?php if (($tipo_prueba == 'Examen') && !$sorpresa):?>
    <script language="javascript" type="text/javascript">
    function comprobar() {
    
      var fechainicio = document.getElementById('fechaInicio');
      var horainicio = document.getElementById('horaInicio');
      var filtro = /^\d+$/
      var duracion = document.getElementById('duracion').value;
      var ahora = new Date();
      var inicio = new Date();
      var diferencia = 0;
      var string;

      if (fechainicio.value == '') {
        alert('Debe especificar la fecha de celebraci\u00f3n del examen');
        fechainicio.focus();
        return false;
      }
      
      string = fechainicio.value;
      inicio.setDate(string.substring(0,2));
      inicio.setMonth((string.substring(3,5)*1)-1);
      inicio.setYear(string.substring(6,10));
      string = horainicio.value;
      inicio.setHours(string.substring(0,2));
      inicio.setMinutes(string.substring(3,5));
      inicio.setSeconds(0);
      
      if (ahora.valueOf() > inicio.valueOf()) {
        alert('Debe poner un momento futuro para la fecha y hora de inicio del examen');
        return false;
      }
      
      if (duracion == '') {
        alert('Debe especificar una duraci\u00f3n para el examen');
        return false;
      }
      
      if (!filtro.test(duracion)) {
        alert('La duraci\u00f3n debe ser un n\u00famero');
        return false;
      }
      
      if ((duracion*1) < 5) {
        alert('El examen no puede durar menos de 5 minutos');
        return false;
      }
      
      if ((duracion*1) <= 20) {
        return confirm('Est\u00e1 seguro de que s\u00f3lo quiere dar '+duracion+' minutos para realizar el examen?');
      }
      
      return true;
    
    }
    </script>
    <div class="nota_informativa">Establezca que d&iacute;a y a qu&eacute; hora se celebrar&aacute; el examen:</div><br>
    <br><br>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaInicio"><strong>Fecha&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaInicio','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq', 'readonly' => 'true')) ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaInicio"><strong>Hora de inicio&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="duracion"><strong>Duraci&oacute;n&nbsp;</strong></label></td>
          <td><?php echo input_tag('duracion', '', array('style' => 'width: 70px;')) ?> (en minutos)</td>
        </tr>
      </table>
    <?php endif;?>

    <?php if (($tipo_prueba == 'Examen') && $sorpresa):?>
    <script language="javascript" type="text/javascript">
    function comprobar() {
    
      var fechainicio = document.getElementById('fechaInicio');
      var fechafin = document.getElementById('fechaFin');
      var horainicio = document.getElementById('horaInicio');
      var horafin = document.getElementById('horaFin');
      var duracion = document.getElementById('duracion').value;
      var filtro = /^\d+$/
      var ahora = new Date();
      var inicio = new Date();
      var fin = new Date();
      var diferencia = 0;
      var string;

      if (fechainicio.value == '') {
        alert('Debe especificar la fecha de inicio del examen sorpresa');
        fechainicio.focus();
        return false;
      }
      if (fechafin.value == '') {
        alert('Debe especificar la fecha de finalizaci\u00f3n del plazo del examen sorpresa');
        fechafin.focus();
        return false;
      }
      
      string = fechainicio.value;
      inicio.setDate(string.substring(0,2));
      inicio.setMonth((string.substring(3,5)*1)-1);
      inicio.setYear(string.substring(6,10));
      string = horainicio.value;
      inicio.setHours(string.substring(0,2));
      inicio.setMinutes(string.substring(3,5));
      inicio.setSeconds(0);
      
      string = fechafin.value;
      fin.setDate(string.substring(0,2));
      fin.setMonth((string.substring(3,5)*1)-1);
      fin.setYear(string.substring(6,10));
      string = horafin.value;
      fin.setHours(string.substring(0,2));
      fin.setMinutes(string.substring(3,5));
      fin.setSeconds(0);
      
      if (ahora.valueOf() > inicio.valueOf()) {
        alert('La fecha y hora de inicio del examen sorpresa deben ser posteriores al momento actual.');
        return false;
      }
      
      if (inicio.valueOf() >= fin.valueOf()) {
        alert('La fecha de finalizaci\u00f3n del plazo para el examen sorpresa debe ser posterior al inicio del mismo');
        return false;
      }
      
      diferencia = fin.valueOf() - inicio.valueOf();
      diferencia = diferencia / (1000 * 3600);
            if (duracion == '') {
        alert('Debe especificar una duraci\u00f3n para el examen');
        return false;
      }
      
      if (!filtro.test(duracion)) {
        alert('La duraci\u00f3n debe ser un n\u00famero');
        return false;
      }
      
      if ((duracion*1) < 5) {
        alert('El examen no puede durar menos de 5 minutos');
        return false;
      }
      
      if ((duracion*1) <= 20) {
        if (!confirm('Est\u00e1 seguro de que s\u00f3lo quiere dar '+duracion+' minutos para realizar el examen?')) {return false;}
      }
      
      if (diferencia < 120) {
        if (!confirm('El plazo para el examen sorpresa es inferior a 5 d\u00edas, es recomendable que ponga plazos largos para que de tiempo a que todos los alumnos se conecten y lo realicen. Est\u00e1 seguro de querer poner este plazo?')) {return false;}
      }
      
      return true;
    
    }
    </script>
    <div class="nota_informativa">Establezca el per&iacute;odo de tiempo en el que estar&aacute; activo el examen sorpresa:</div><br>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaInicio"><strong>Fecha de inicio&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaInicio','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq', 'readonly' => 'true')) ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaInicio"><strong>Hora de inicio&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="fechaFin"><strong>Fecha l&iacute;mite&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaFin','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq', 'readonly' => 'true')) ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaFin"><strong>Hora l&iacute;mite&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="duracion"><strong>Duraci&oacute;n&nbsp;</strong></label></td>
          <td><?php echo input_tag('duracion', '', array('style' => 'width: 70px;')) ?> (en minutos)</td>
        </tr>

      </table>
      <br>
      <?php echoNotaInformativa("Ex&aacute;menes sorpresa", "A diferencia de los ex&aacute;menes normales, los ex&aacute;menes sorpresa no ser&aacute;n avisados a los alumnos y les aparecer&aacute;n como ex&aacute;menes que deben realizar de inmediato si se conectan dentro del plazo que usted concrete en este apartado. Si un alumno no se conecta en ese per&iacute;odo perder&aacute; la oportunidad de hacer el examen y se le considerar&aacute; como no presentado.");?>
    <?php endif;?>

    <?php if ($tipo_prueba == 'Tarea'):?>
    <script language="javascript" type="text/javascript">
    function comprobar() {
    
      var fechainicio = document.getElementById('fechaInicio');
      var fechafin = document.getElementById('fechaFin');
      var horainicio = document.getElementById('horaInicio');
      var horafin = document.getElementById('horaFin');
      var ahora = new Date();
      var inicio = new Date();
      var fin = new Date();
      var diferencia = 0;
      var string;

      if (fechainicio.value == '') {
        alert('Debe especificar la fecha de inicio de la tarea');
        fechainicio.focus();
        return false;
      }
      if (fechafin.value == '') {
        alert('Debe especificar la fecha de entrega para la tarea');
        fechafin.focus();
        return false;
      }
      
      string = fechainicio.value;
      inicio.setDate(string.substring(0,2));
      inicio.setMonth((string.substring(3,5)*1)-1);
      inicio.setYear(string.substring(6,10));
      string = horainicio.value;
      inicio.setHours(string.substring(0,2));
      inicio.setMinutes(string.substring(3,5));
      inicio.setSeconds(0);
      
      string = fechafin.value;
      fin.setDate(string.substring(0,2));
      fin.setMonth((string.substring(3,5)*1)-1);
      fin.setYear(string.substring(6,10));
      string = horafin.value;
      fin.setHours(string.substring(0,2));
      fin.setMinutes(string.substring(3,5));
      fin.setSeconds(0);
      
      if (ahora.valueOf() > inicio.valueOf()) {
        alert('La fecha y hora de inicio de la tarea deben ser posteriores al momento actual.');
        return false;
      }
      
      if (inicio.valueOf() >= fin.valueOf()) {
        alert('La entrega de la tarea debe ser posterior al inicio de la misma');
        return false;
      }
      
      diferencia = fin.valueOf() - inicio.valueOf();
      diferencia = diferencia / (1000 * 3600);
      
      if (diferencia < 24) {
        return confirm('Los alumnos disponen de menos de 24 horas para hacer la tarea, esta seguro de que quiere darles este tiempo?');
      }
      
      return true;
    
    }
    </script>
    
    
    <div class="nota_informativa">Establezca el plazo de entrega para la tarea:</div><br>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaInicio"><strong>Fecha de inicio&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaInicio','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq', 'readonly' => 'true')) ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaInicio"><strong>Hora de inicio&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="fechaFin"><strong>Fecha de entrega&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaFin','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq', 'readonly' => 'true')) ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaFin"><strong>Hora de entrega&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
      </table>
      <br>
      <?php echoNotaInformativa('Sobre los plazos', 'Los alumnos ver&aacute;n anunciada la fecha de comienzo de la tarea con unos d&iacute;as de antelaci&oacute;n pero no podr&aacute;n trabajar en el ejercicio hasta que no llegue el d&iacute;a de inicio de la tarea.'); ?>
    <?php endif;?>

    <br><br>

    <?php echo submit_tag('Siguiente >>', array('onClick' => 'return comprobar();')) ?>

    </form>
  </div>
  <div class="cierre_box_correo"></div>
</div>

