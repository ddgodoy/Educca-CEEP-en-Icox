<?php use_helper('informacion','fechas','Javascript','SexyButton','Validation','Text') ?>


    <?php /*echo form_remote_tag(array(
        'update'   => 'capaAjax',
        'url'      => 'evaluacion/guardarEvaluacionModulo',
        'script' => true,
        'loading'  =>  visual_effect('appear', 'indicador'),
        'complete' =>  visual_effect('fade', 'indicador').
                       visual_effect('highlight', 'indicador'),
    	 ),array('name'=>'fevaluacion')
    ) */ ?>

  <form action="/evaluacion/guardarEvaluacionModulo" method="POST">

<?php echo input_hidden_tag('idmodulo', $modulo->getId()) ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Ficha de evaluaci&oacute;n del &nbsp;<?php echo ($modulo->getNombre());?> </h2></div>
  <div class="contenido_principal">

      <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding-right:15px;"><?php echo sexy_submit_tag('Guardar estos criterios de evaluaci&oacute;n'); ?></td>
            <td style="padding-right:15px;"><?php echo sexy_button_to('Evaluar seg&uacute;n estos criterios','evaluacion/evaluarModulo?idmodulo='.$modulo->getId()) ?> </td>
            <td style="padding-right:15px;"><?php echo sexy_button_to('Ver el ranking de alumnos','seguimiento/rankingModulo?idmodulo='.$modulo->getId()) ?></td>

        </tr>
      </table>
    </div>
    <br>
  <div id="capaAjax"></div>
  <div id="indicador" style="display: none">Procesando su petici&oacute;n...</div>
  <div class="titulos_tabla_general">
  <table class="tests_realizados_alumno">
  <tr>
    <td class="tdselect"><input type="checkbox" name="all_tests" id="all_tests" onClick="checkAll('test','all_tests')"></td>
    <th class="tds1">Ejercicios de test realizados</th>
    <th class="tds2">Categor&iacute;a</th>
    <th class="tds3">Curso</th>
    <th class="tds4">Peso %</th>
  </tr>
  </table>
  </div>

  <div class="listado_tabla_general_medio">
  <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_tests as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>
      <?$tarea = TareaPeer::retrieveByPk($elemento[0])?>
      <? if ($modulo->evaluacionTarea($tarea->getId())) : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "test$count" ?>" id="<?php echo "test$count" ?>" value="<?php echo $elemento[0]?>" checked ></td>
           <? $ok = true; ?>
      <? else : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "test$count" ?>" id="<?php echo "test$count" ?>" value="<?php echo $elemento[0]?>"></td>
           <? $ok = false; ?>
      <? endif; ?>


      <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
      <td class="tds2"><?php echo $elemento[2]?></td>
      <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
      <? if ($ok) : ?>
          <td class="tds4"><?php echo input_tag('pesoTest'.$count, $modulo->evaluacionPesoTarea($tarea->getId()), array('maxlength'=>'4','size'=>'4')) ?></td>
      <? else : ?>
          <td class="tds4"><?php echo input_tag('pesoTest'.$count, '', array('maxlength'=>'4','size'=>'4')) ?></td>
      <? endif; ?>


    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de test que puedan contar para la evaluaci&oacute;n ');?>
  <?php endif;?>
  </div>
  <?php echo input_hidden_tag('totalTest', $count) ?>
  <br>

  <div class="titulos_tabla_general">
  <table class="tests_realizados_alumno">
  <tr>
    <td class="tdselect"><input type="checkbox" name="all_cuestionarios" id="all_cuestionarios" onClick="checkAll('cuestionario','all_cuestionarios')"></td>
    <th class="tds1">Cuestionarios realizados</th>
    <th class="tds2">Categor&iacute;a</th>
    <th class="tds3">Curso</th>
    <th class="tds4">Peso %</th>
  </tr>
  </table>
  </div>
  <div class="listado_tabla_general_medio">
  <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_cuestionarios as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>

        <?$tarea = TareaPeer::retrieveByPk($elemento[0])?>
        <? if ($modulo->evaluacionTarea($tarea->getId())) : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "cuestionario$count" ?>" id="<?php echo "cuestionario$count" ?>" value="<?php echo $elemento[0]?>" checked></td>
           <? $ok = true; ?>
        <? else : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "cuestionario$count" ?>" id="<?php echo "cuestionario$count" ?>" value="<?php echo $elemento[0]?>"></td>
           <? $ok = false; ?>
        <? endif; ?>

        <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
        <td class="tds2"><?php echo $elemento[2]?></td>
        <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
        <? if ($ok) : ?>
          <td class="tds4"><?php echo input_tag('pesoCuest'.$count, $modulo->evaluacionPesoTarea($tarea->getId()), array('maxlength'=>'4','size'=>'4')) ?></td>
        <? else : ?>
          <td class="tds4"><?php echo input_tag('pesoCuest'.$count, '', array('maxlength'=>'4','size'=>'4')) ?></td>
        <? endif; ?>

    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay cuestionarios que puedan contar para la evaluaci&oacute;n');?>
  <?php endif;?>
  </div>
  <?php echo input_hidden_tag('totalCuestionarios', $count) ?>

  <br>

   <div class="titulos_tabla_general">
  <table class="tests_realizados_alumno">
  <tr>
    <td class="tdselect"><input type="checkbox" name="all_problemas" id="all_problemas" onClick="checkAll('problema','all_problemas')"></td>
    <th class="tds1">Problemas realizados</th>
    <th class="tds2">Categor&iacute;a</th>
    <th class="tds3">Curso</th>
    <th class="tds4">Peso %</th>
  </tr>
  </table>
  </div>
  <div class="listado_tabla_general_medio">
  <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_problemas as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>

        <?$tarea = TareaPeer::retrieveByPk($elemento[0])?>
        <? if ($modulo->evaluacionTarea($tarea->getId())) : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "problema$count" ?>" id="<?php echo "problema$count" ?>" value="<?php echo $elemento[0]?>" checked></td>
           <? $ok = true; ?>
        <? else : ?>
           <td class="tdselect"><input type="checkbox" name="<?php echo "problema$count" ?>" id="<?php echo "problema$count" ?>" value="<?php echo $elemento[0]?>"></td>
           <? $ok = false; ?>
        <? endif; ?>

        <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
        <td class="tds2"><?php echo $elemento[2]?></td>
        <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
        <? if ($ok) : ?>
          <td class="tds4"><?php echo input_tag('pesoProb'.$count, $modulo->evaluacionPesoTarea($tarea->getId()), array('maxlength'=>'4','size'=>'4')) ?></td>
        <? else : ?>
          <td class="tds4"><?php echo input_tag('pesoProb'.$count, '', array('maxlength'=>'4','size'=>'4')) ?></td>
        <? endif; ?>


    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de problemas que puedan contar para la evaluaci&oacute;n');?>
  <?php endif;?>
  </div>
  <?php echo input_hidden_tag('totalProblemas', $count) ?>



<br>
<div id="guardar">
<? if (isset($saveok)): ?>
<br><?php echoNotaInformativa('', 'Los datos de la evaluaci&oacute;n han sido guardados.'); ?>
<? endif; ?>
</div>

<br><?php echoNotaInformativa('Ayuda', 'En esta panel podr&aacute; establecer los criterios de evaluaci&oacute;n para el m&oacute;dulo, guardarlos y evaluar a los alumnos y obtener un ranking de puntuaciones seg&uacute;n estos criterios. <br><br>Si quiere que un ejercicio punt&uacute;e en la evaluaci&oacute;n del m&oacute;dulo, marque la casilla correspondiente a dicho ejercicio y establezca el peso num&eacute;rico con el que se contabilizar&aacute; ese ejercicio. Cuando haya decidido que ejercicios se tendr&aacute;n en cuenta para la evaluaci&oacute;n haga clic en el bot&oacute;n "Guardar estos criterios de evaluaci&oacute;n".<br><br>El peso debe ser un n&uacute;mero. Por ejemplo 30 significa que ese ejercicio supondr&aacute; un 30% de la nota final del m&oacute;dulo.'); ?>

<br><?php use_helper('volver');  echo volver(); ?>
  </div><div class="cierre_principal"></div>
</div>
</form>
