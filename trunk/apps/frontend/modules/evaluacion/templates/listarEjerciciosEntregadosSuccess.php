<?php use_helper('Text') ?>
<?php use_helper('fechas') ?>

<div class="titulos_tabla_general">
  <table class="tabla_evaluacion_entregas">
    <tr>
      <th class="td1">Alumno</th>
      <th class="td2">Fecha de entrega</th>
      <th class="td3">Nota</th>
      <th class="td4">Opci&oacute;n</th>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="tabla_evaluacion_entregas">
  <?php $count = 0;?>
  <?php foreach ($pendientes_correccion as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>
    <?php $count++;?>

      <td  class="td1"><?php echo $elemento[1]?>, <?php echo $elemento[0]?> </td>

      <?php if ($elemento[3] != null) :?>
        <?php if ($elemento[4]):?>
          <td  class="td2"><?php echo darFormato($elemento[5])?></td>
        <?php else:?>
          <td  class="td2"><?php echo darFormato($elemento[6])?></td>
        <?php endif;?>
      <?php else:?>
        <?php if ($tipo_evento == 'Tarea'):?>
          <td  class="td2">No entregado</td>
        <?php else:?>
          <td  class="td2">No presentado</td>
        <?php endif;?>
      <?php endif;?>


      <?php if ($elemento[3] != null) :?>
        <?php if ($elemento[7]):?>
          <?php $solucion_alumno = Ejercicio_resueltoPeer::RetrieveByPk($elemento[3]);?>
          <td class="td3"><?php printf('%.2f', $solucion_alumno->getScore());?></td>
          <td class="td4"><?php //echo button_to('Revisar', 'evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$elemento[3], array ('popup' => array('', 'width=780,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,scrollbars=1,top=0,left=200')))?>
                          <?php echo link_to(image_tag('lupa.png', array('alt' => 'Revisar Tarea', 'title' => 'Revisar Tarea')),
                                         'evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$elemento[3],
                                         array( 'id' => 'ln_revisar_ejercicio'.$elemento[3],
                                                'popup' => array('', 'width=780,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,scrollbars=1,top=0,left=200') )
                            );  ?>
          </td>
        <?php else:?>
          <th class="td3">Pendiente de correcci&oacute;n</th>
          <td class="td4"><?php //echo button_to('Corregir', 'evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$elemento[3], array ('popup' => array('', 'width=780,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,scrollbars=1,top=0,left=200')))?>
                          <?php echo link_to(image_tag('corregir.png', array('alt' => 'Corregir Tarea', 'title' => 'Corregir Tarea')),
                                         'evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$elemento[3],
                                         array( 'id' => 'ln_corregir_ejercicio'.$elemento[3],
                                                'popup' => array('', 'width=780,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,scrollbars=1,top=0,left=200') )
                            );  ?>

          </td>
        <?php endif;?>
      <?php else:?>
        <th class="td3">-</th>
        <td class="td4">-</td>
      <?php endif;?>

    </tr>
  <?php endforeach;?>

  <?php if (!$count) : ?>
    <tr>
      <td class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?> <span class="txtinfo">No hay elementos que mostrar.</span></td>
    </tr>
  <?php endif; ?>

  </table>
</div>


