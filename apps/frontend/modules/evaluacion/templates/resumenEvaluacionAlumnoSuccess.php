<?php use_helper('informacion') ?>
<?php use_helper('fechas') ?>
<?php use_helper('Javascript') ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Ficha de evaluaci&oacute;n de &nbsp;<?php echo ($alumno->getNombre().' '.$alumno->getApellidos());?> &nbsp;&nbsp; - &nbsp;&nbsp; <?php echo $curso->getNombre()?></h2></div>
  <div class="contenido_principal">
  
  <div class="titulos_tabla_general">
  <table class="tests_realizados_alumno">
  <tr>
    <td class="tdselect"><input type="checkbox" name="all_tests" id="all_tests" onClick="checkAllTest()"></td>
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
      <td class="tdselect"><input type="checkbox" name="testgroup" id="<?php echo "test$count" ?>" value="<?php printf("%.2f", $solucion->getScore()); ?>"></td>
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
          <td class="tdselect"><input type="checkbox" name="testgroup" id="<?php echo "test$count" ?>" value="0"></td>
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
    <td class="tdselect"><input type="checkbox" name="all_cuestionarios" id="all_cuestionarios" onClick="checkAllCuestionario()"></td>
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
        <td class="tdselect"><input type="checkbox" name="cuestgroup" id="<?php echo "cuestionario$count" ?>" value="<?php printf("%.2f", $solucion->getScore()); ?>"></td>
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
          <td class="tdselect"><input type="checkbox" name="cuestgroup" id="<?php echo "cuestionario$count" ?>" value="0"></td>
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
    <td class="tdselect"><input type="checkbox" name="all_problemas" id="all_problemas" onClick="checkAllProblemas()"></td>
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
        <td class="tdselect"><input type="checkbox" name="problemgroup" id="<?php echo "problema$count" ?>" value="<?php printf("%.2f", $solucion->getScore()); ?>"></td>
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
          <td class="tdselect"><input type="checkbox" name="problemgroup" id="<?php echo "problema$count" ?>" value="0"></td>
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
        <?php echo ("$minutos minutos"); ?>
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
<?php if(!$usuario->getInspector()): ?>
<td class="td2">&nbsp;</td>
<td class="td3">
  <div class="resumen_trabajo_alumno">
  <center><strong><u>Notas medias obtenidas por el alumno</u></strong></center>
  <br>
  <?php echo form_tag('evaluacion/guardarCalificacion?id_alumno='.$alumno->getId().'&id_curso='.$curso->getId(), array('name' => 'form_eval', 'id'=>'form_eval'))?>
  <table class="tabla_trabajo_alumno">
    <tr>
      <th class="td3">Tests:</th>
      <td class="td4"><input class="input_nota" id="input_tests" type="text" value="" readonly></td>
      <th class="td5"><u>Opciones</u></th>
    </tr>
    <tr>
      <th class="td3">Cuestionarios:</th>
      <td class="td4"><input class="input_nota" id="input_cuestionarios" type="text" value="" readonly></td>
      <td class="td5"><input class="boton_verdecito_evaluacion" type="button" value="Ayuda" onClick="mostrarAyuda()"></td>
    </tr>
    <tr>
      <th class="td3">Problemas:</th>
      <td class="td4"><input class="input_nota" id="input_problemas" type="text" value="" readonly></td>
      <td class="td5"><input class="boton_azulito_evaluacion" type="button" value="Calcular medias" onClick="calcularMedias()"></td>
    </tr>
    <tr>
      <th class="td3">Nota final:</th>
      <td class="td4">
        <input name="nota_final" class="input_nota_final" id="nota_final" type="text" value="<?php echo $ultima_nota?>" maxlength="5">
        <input type="hidden" id="ultima_nota" value="<?php echo $ultima_nota?>">  
      </td>
      <td class="td5"><input class="boton_marroncito_evaluacion" type="button" value="Guardar nota" onClick="submitNotaFinal()"></td>
    </tr>
  </table>
  </form>
  </div>
</td>
<?php else: ?>
<td class="td2">&nbsp;</td>
<td class="td3">
  <div class="resumen_trabajo_alumno">
  <center><strong><u>Notas medias obtenidas por el alumno</u></strong></center>
  <br>
  <table class="tabla_trabajo_alumno">
    <tr>
      <th class="td3">Nota final:</th>
      <td class="td4">
          <input name="nota_final" class="input_nota_final" id="nota_final" type="text" value="<?php echo $ultima_nota?>" maxlength="5" readonly="readonly">
      </td>
    </tr>
  </table>
  </div>
</td>
<?php endif; ?>
</tr>
</table>
</div>

<div id="explicacion_eval" class="opciones_eval_oculto">
<center><strong><u>C&aacute;lculo de medias y nota final</u></strong></center><br>
Antes de poner la nota final es preferible que espere a que todos los ejercicios pendientes de entrega sean realizados por los alumnos. <br><br>
Podr&aacute; ver que en los apartados con los ejercicios de test, cuestionarios y problemas hay unas casillas que se pueden marcar. Elija los ejercicios de test, cuestionarios o problemas que quiera contabilizar para la evaluaci&oacute;n del alumno marcando las casillas correspondientes y haga click en el bot&oacute;n "Calcular medias". Autom&aacute;ticamente se calcular&aacute; la media aritm&eacute;tica para cada tipo de ejercicio.<br><br>
<strong> La nota final </strong> se calcula de forma autom&aacute;tica haciendo la media aritm&eacute;tica de las medias obtenidas en tests, cuestionarios y problemas. Si alguna de estas tres no est&aacute; disponible no se tiene en cuenta para la nota final. Debe tener en cuenta que esta nota es un dato indicativo y que puede ponerle al alumno la nota que usted crea oportuna seg&uacute;n sus criterios de evaluaci&oacute;n.<br><br>
<center><input class="boton_verdecito_evaluacion" type="button" value="Volver a evaluaci&oacute;n" onClick="ocultarAyuda()"></center>
</div>
  
       
  </div>
  <div class="cierre_principal"></div>
</div>
