<?php use_helper('informacion') ?>
<?php use_helper('fechas') ?>
<?php use_helper('Javascript') ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Ficha de evaluaci&oacute;n de &nbsp;<?php echo ($alumno->getNombre().' '.$alumno->getApellidos());?> &nbsp;&nbsp; - &nbsp;&nbsp; <?php echo $curso->getNombre(50)?></h2></div>
  <div class="contenido_principal">

  <div class="titulos_tabla_general">
  <table class="tests_realizados_alumno">
  <tr>
    <td class="tdselect">&nbsp;</td>
    <th class="td1">Ejercicios de test realizados</th>
    <th class="td2">Categor&iacute;a</th>
    <th class="td3">Aciertos</th>
    <th class="td4">Fallos</th>
    <th class="td5">Blancos</th>
    <th class="td6">Nota</th>
  </tr>
  </table>
  </div>
  <div class="listado_tabla_general_medio">
  <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_tests as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>


    <?php if ($elemento[4]):?>
      <?php $solucion = Ejercicio_resueltoPeer::RetrieveByPk($elemento[3]);?>
      <td class="tdselect">&nbsp;</td>
      <td class="td1"><?php echo $elemento[1]?></td>
      <td class="td2"><?php echo $elemento[2]?></td>
      <td class="td3"><?php echo $solucion->getAciertos() ?></td>
      <td class="td4"><?php echo $solucion->getFallos() ?></td>
      <td class="td5"><?php echo $solucion->getBlancos() ?></td>
      <th class="td6"><?php printf("%.2f", $solucion->getScore()); ?></th>
    <?php else:?>
      <?php if (($elemento[5]) || ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] != null))):?>
        <td class="tdselect">&nbsp;</td>
        <td class="td1"><?php echo $elemento[1]?></td>
        <td class="td2"><?php echo $elemento[2]?></td>
        <td class="td3">-</td>
        <td class="td4">-</td>
        <td class="td5">-</td>
        <th class="td6">Correcci&oacute;n pendiente</th>
      <?php else:?>
        <?php if ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] == null)):?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <td class="td3">-</td>
          <td class="td4">-</td>
          <td class="td5">-</td>
          <th class="td6">No presentado (0.00)</th>
        <?php else:?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <td class="td3">-</td>
          <td class="td4">-</td>
          <td class="td5">-</td>
          <th class="td6">Entrega pendiente</th>
        <?php endif;?>
      <?php endif;?>
    <?php endif;?>


    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de test que puedan contar para la evaluaci&oacute;n de este alumno');?>
  <?php endif;?>
  </div>

  <br>

  <div class="titulos_tabla_general">
  <table class="cuestionarios_realizados_alumno">
  <tr>
    <td class="tdselect">&nbsp;</td>
    <th class="td1">Cuestionarios realizados</th>
    <th class="td2">Categor&iacute;a</th>
    <th class="td3">Nota</th>
  </tr>
  </table>
  </div>
  <div class="listado_tabla_general_medio">
  <table class="cuestionarios_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_cuestionarios as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>


    <?php if ($elemento[4]):?>
      <?php $solucion = Ejercicio_resueltoPeer::RetrieveByPk($elemento[3]);?>
        <td class="tdselect">&nbsp;</td>
        <td class="td1"><?php echo $elemento[1]?></td>
        <td class="td2"><?php echo $elemento[2]?></td>
        <th class="td3"><?php printf("%.2f", $solucion->getScore()); ?></th>
    <?php else:?>
      <?php if (($elemento[5]) || ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] != null))):?>
        <td class="tdselect">&nbsp;</td>
        <td class="td1"><?php echo $elemento[1]?></td>
        <td class="td2"><?php echo $elemento[2]?></td>
        <th class="td3">Correcci&oacute;n pendiente</th>
      <?php else:?>
        <?php if ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] == null)):?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <th class="td3">No presentado (0.00)</th>
        <?php else:?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <th class="td3">Entrega pendiente</th>
        <?php endif;?>
      <?php endif;?>
    <?php endif;?>


    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay cuestionarios que puedan contar para la evaluaci&oacute;n de este alumno');?>
  <?php endif;?>
  </div>

  <br>

  <div class="titulos_tabla_general">
  <table class="cuestionarios_realizados_alumno">
  <tr>
    <td class="tdselect">&nbsp;</td>
    <th class="td1">Problemas realizados</th>
    <th class="td2">Categor&iacute;a</th>
    <th class="td3">Nota</th>
  </tr>
  </table>
  </div>
  <div class="listado_tabla_general_medio">
  <table class="cuestionarios_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_problemas as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>


    <?php if ($elemento[4]):?>
      <?php $solucion = Ejercicio_resueltoPeer::RetrieveByPk($elemento[3]);?>
        <td class="tdselect">&nbsp;</td>
        <td class="td1"><?php echo $elemento[1]?></td>
        <td class="td2"><?php echo $elemento[2]?></td>
        <th class="td3"><?php printf("%.2f", $solucion->getScore()); ?></th>
    <?php else:?>
      <?php if (($elemento[5]) || ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] != null))):?>
        <td class="tdselect">&nbsp;</td>
        <td class="td1"><?php echo $elemento[1]?></td>
        <td class="td2"><?php echo $elemento[2]?></td>
        <th class="td3">Correcci&oacute;n pendiente</th>
      <?php else:?>
        <?php if ((time() > getTiempoAbsoluto($elemento[6])) && ($elemento[3] == null)):?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <th class="td3">No presentado (0.00)</th>
        <?php else:?>
          <td class="tdselect">&nbsp;</td>
          <td class="td1"><?php echo $elemento[1]?></td>
          <td class="td2"><?php echo $elemento[2]?></td>
          <th class="td3">Entrega pendiente</th>
        <?php endif;?>
      <?php endif;?>
    <?php endif;?>


    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de problemas que puedan contar para la evaluaci&oacute;n de este alumno');?>
  <?php endif;?>
  </div>

  <br>

<div id="div_opciones_eval" class="opciones_eval">
<table class="contenedor_resumen_talumno">
<tr>
<td class="td1">
  <div class="resumen_trabajo_alumno">
  <center><strong><u>Resumen de tiempos dedicados por el alumno</u></strong></center>
  <br>
  <table class="tabla_trabajo_alumno">
    <tr>
      <th class="td1">Revisar el temario:</th>
      <td class="td2">
        <?php $horas = floor($tiempo_estudio / 3600);?>
        <?php $minutos = (floor($tiempo_estudio / 60)) % 60;?>
        <?php if ($horas == 1) {echo("1 hora ");}?>
        <?php if ($horas > 1) {echo("$horas horas ");}?>
        <?php echo ("$minutos minutos");?>
      </td>
    </tr>
    <tr>
      <th class="td1">Realizar tareas y ex&aacute;menes:</th>
      <td class="td2">
        <?php $horas = floor($tiempo_tareas / 3600);?>
        <?php $minutos = (floor($tiempo_tareas / 60)) % 60;?>
        <?php if ($horas == 1) {echo("1 hora ");}?>
        <?php if ($horas > 1) {echo("$horas horas ");}?>
        <?php echo ("$minutos minutos");?>
      </td>
    </tr>
    <tr>
      <th class="td1">Realizar ejercicios del repositorio:</th>
      <td class="td2">
        <?php $horas = floor($tiempo_repositorio / 3600);?>
        <?php $minutos = (floor($tiempo_repositorio / 60)) % 60;?>
        <?php if ($horas == 1) {echo("1 hora ");}?>
        <?php if ($horas > 1) {echo("$horas horas ");}?>
        <?php echo ("$minutos minutos");?>
      </td>
    </tr>
    <tr>
      <th class="td1">Tiempo total:</th>
      <th class="td2">
        <?php $tiempo_total = $tiempo_repositorio + $tiempo_tareas + $tiempo_estudio; ?>
        <?php $horas = floor($tiempo_total / 3600);?>
        <?php $minutos = (floor($tiempo_total / 60)) % 60;?>
        <?php if ($horas == 1) {echo("1 hora ");}?>
        <?php if ($horas > 1) {echo("$horas horas ");}?>
        <?php echo ("$minutos minutos");?>
      </th>
    </tr>
  </table>
  </div>
</td>
<td class="td2">&nbsp;</td>
<td class="td3">
  <div class="resumen_trabajo_alumno">
  <center><strong><u>Notas</u></strong></center>
  <br>

  <table class="tabla_trabajo_alumno">
    <tr>
      <th width="34%">Nota final:</th>
      <th width="33%"><div class='c_nota_final'><?php echo $nota?></div></th>
      <td width="33%">&nbsp;</td>
    </tr>
  </table>
  </div>
</td>
</tr>
</table>
</div>



  </div>
  <div class="cierre_principal"></div>
</div>
