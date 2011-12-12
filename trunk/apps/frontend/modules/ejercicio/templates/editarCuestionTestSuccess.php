<?php use_helper('Javascript') ?>

<?php $id_cuestion = $cuestion_test->getId(); ?>

<?php if ($modificar):?>
<table class="tabla_cuestion_test">
  <?php if ($expresiones_matematicas): ?>
    <tr height="40">
      <th class="td1"><?php echo("$indice. ") ?></th>
      <th class="td2">
        <?php echo (input_hidden_tag('id_cuestion_test', $cuestion_test->getId())); ?>
        <?php echo (input_hidden_tag('indice', $indice)); ?>
        <?php $style = ' style="vertical-align: center;"';?>
        <?php $trstyle = ' height="40"';?>
        <?php $id_div = "div_cuestion".$id_cuestion; ?>
        <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/cuestiont_'.$id_cuestion.'.png'; ?>
        <?php if (file_exists($ruta_formula)): ?>
          <div id="<?php echo $id_div; ?>" class="formula_lleno" onMouseOver="this.className = this.className+'_hover';" onMouseOut="this.className = this.className.substring(0, (this.className.length - 6));" onClick="abrirVentanaExp('t', 1, <?php echo $cuestion_test->getId()?>, '<?php echo $id_div; ?>', 'target')"><?php echo '<img src="/images/ecuaciones/cuestiont_'.$cuestion_test->getId().'.png"/>' ?></div>
        <?php else:?>
          <div id="<?php echo $id_div; ?>" class="formula_vacio" onMouseOver="this.className = this.className+'_hover';" onMouseOut="this.className = this.className.substring(0, (this.className.length - 6));" onClick="abrirVentanaExp('t', 1, <?php echo $cuestion_test->getId()?>, '<?php echo $id_div; ?>', 'target')"><br><center>Haga click aqu&iacute; para a&ntilde;adir contenido a esta pregunta</center></div>
        <?php endif;?>
      </th>
    </tr>

  <?php else:?>
    <tr height="20">
      <th class="td1"><?php echo("$indice. ") ?></th>
      <th class="td2">
        <?php echo (input_hidden_tag('id_cuestion_test', $cuestion_test->getId())); ?>
        <?php echo (input_hidden_tag('indice', $indice)); ?>
        <?php $style = ' style="vertical-align: top;"';?>
        <?php $trstyle = ' height="20"';?>
        <?php echo textarea_tag('contenido_cuestion_test', $cuestion_test->getPregunta(), 'size=81x4') ?>

      </th>
    </tr>
  <?php endif;?>

  <tr>
    <td class="td1">&nbsp;</td>
    <td class="td2">

      <?php $respuestas = $cuestion_test->getRespuestas();?>
      <table class="tabla_respuestas_test">
      <?php $indicerespuesta = 'a'; $index = 0;?>
      <?php foreach($respuestas as $respuesta):?>
        <?php $id_div = 'div_respuesta_'.$id_cuestion.'_'.$respuesta->getId(); ?>
        <tr<?php echo $trstyle?>>
          <td class="td1" <?php echo $style?>>&nbsp;</td>
          <td class="td2" <?php echo $style?>>&nbsp;</td>
          <td class="td3" <?php echo $style?>><?php echo("$indicerespuesta) ");?></td>
          <td class="td4" <?php echo $style?>>

            <?php if ($expresiones_matematicas): ?>
              <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/respuestat_'.$respuesta->getId().'.png'; ?>
              <?php if (file_exists($ruta_formula)): ?>
                <div id="<?php echo $id_div; ?>" class="formula_lleno" onMouseOver="this.className = this.className+'_hover';" onMouseOut="this.className = this.className.substring(0, (this.className.length - 6));" onClick="abrirVentanaExp('t', 0, <?php echo $respuesta->getId()?>, '<?php echo $id_div; ?>', 'target')"><?php echo '<img src="/images/ecuaciones/respuestat_'.$respuesta->getId().'.png"/>' ?></div>
              <?php else:?>
                <div id="<?php echo $id_div; ?>" class="formula_vacio" onMouseOver="this.className = this.className+'_hover';" onMouseOut="this.className = this.className.substring(0, (this.className.length - 6));" onClick="abrirVentanaExp('t', 0, <?php echo $respuesta->getId()?>, '<?php echo $id_div; ?>', 'target')"><center><strong><br>Haga click aqu&iacute; para a&ntilde;adir contenido a esta respuesta</strong></center></div>
              <?php endif;?>
            <?php else:?>
              <?php echo textarea_tag("respuesta$index", $respuesta->getRespuesta(), 'size=72x3') ?>
            <?php endif;?>

            <?php echo (input_hidden_tag("respuestaid$index", $respuesta->getId())); ?>
          </td>
          <td class="td5" <?php echo $style?>>&nbsp;</td>
        </tr>
        <?php $index++; ?>
        <?php $indicerespuesta++; ?>
      <?php endforeach;?>
      </table>
    </td>
  </tr>
  <tr>
    <td class="td1">&nbsp;</td>
    <td class="td2">
      <?php if ($expresiones_matematicas): ?>
        <?php echo submit_to_remote('ajax_submit', 'Finalizar modificaci&oacute;n', array('update' => "cuestion_test$indice", 'url' => 'ejercicio/editarCuestionTest?mostrar_edicion='.$mostrar_edicion))?>
      <?php else:?>
        <?php echo submit_to_remote('ajax_submit', 'Guardar cambios', array('update' => "cuestion_test$indice", 'url' => 'ejercicio/editarCuestionTest?guardar=1&mostrar_edicion='.$mostrar_edicion))?>
      <?php endif;?>
    </td>
  </tr>
</table>

<?php else:?>
  <?php include_partial('mostrarCuestionTest', array('cuestion_test' => $cuestion_test, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => 0, 'mostrar_respuestas' => 0, 'expresiones_matematicas' => $expresiones_matematicas)) ?>
<?php endif;?>

