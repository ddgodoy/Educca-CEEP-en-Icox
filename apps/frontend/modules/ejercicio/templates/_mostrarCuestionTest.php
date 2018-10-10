<table class="tabla_cuestion_test">

  <?php if ($expresiones_matematicas): ?>
    <tr height="40">
      <th class="td1"><?php echo("$indice. ") ?></th>
      <th class="td2">
        <?php $style = ' style="vertical-align: center;"';?>
        <?php $trstyle = ' height="40"';?>
        <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/cuestiont_'.$cuestion_test->getId().'.png'; ?>
        <?php if (file_exists($ruta_formula)): ?>
          <?php echo '<img src="/images/ecuaciones/cuestiont_'.$cuestion_test->getId().'.png"/>' ?>
        <?php else:?>
          <div class="formula_vacio"></div>
        <?php endif;?>
      </th>
    </tr>
  <?php else:?>
    <tr height="20">
      <th class="td1"><?php echo("$indice. ") ?></th>
      <th class="td2">
        <?php $style = ' style="vertical-align: top;"';?>
        <?php $trstyle = ' height="20"';?>
        <?php echo $cuestion_test->getPregunta() ?>
      </th>
    </tr>
  <?php endif;?>


  <tr>
    <td class="td1">&nbsp;</td>
    <td class="td2">
      <?php $respuestas = $cuestion_test->getRespuestas();?>
      <table class="tabla_respuestas_test">
      <?php $indicerespuesta = 'a';?>
      <?php $index = 0;?>
      <?php foreach($respuestas as $respuesta): ?>
        <tr<?php echo $trstyle ?>>

        <?php $fondo=""; ?>
        <?php if ($mostrar_solucion == 1):?>
          <?php if ($respuesta->getSeleccionEjercicio($id_respuesta_ejercicio)):?>
            <?php if ($respuesta->getCorrecta()):?>
              <?php $fondo=" id=\"filarayada_verdefuerte\""; ?>
            <?php else:?>
              <?php $fondo=" id=\"filarayada_roja\""; ?>
            <?php endif;?>
          <?php else:?>
            <?php if ($respuesta->getCorrecta() && ($mostrar_solucion == 1)):?>
              <?php $fondo=" id=\"filarayada_amarilla\""; ?>
            <?php endif;?>
          <?php endif;?>
        <?php endif;?>


          <td class="td1" <?php echo $style?>>
          <?php if ($mostrar_respuestas == 1):?>
            <?php if ($respuesta->getSeleccionEjercicio($id_respuesta_ejercicio)):?>
              <?php echo image_tag('this.png','title=Su elecci&oacute;n'); ?>
            <?php else:?>
              &nbsp;
            <?php endif;?>
          <?php else:?>
            &nbsp;
          <?php endif;?>
          </td>

          <td class="td2" <?php echo $style?>>
          <?php if ($mostrar_respuestas == 2):?>
            <?php if ($respuesta->getSeleccionEjercicio($id_respuesta_ejercicio)){$marcar = true;} else {$marcar = false;}?>
              <?php echo checkbox_tag("checkboxr$index".'c'.$indice, 1, $marcar) ?>
              <?php echo (input_hidden_tag("hiddenr$index".'c'.$indice, $respuesta->getId())); ?>
          <?php else:?>
            &nbsp;
          <?php endif;?>
          </td>

          <td class="td3" <?php echo $style?>>
            <?php echo("$indicerespuesta)");?>
          </td>

          <?php echo("<td class=\"td4\"$fondo $style>") ?>
            <?php if ($expresiones_matematicas): ?>
              <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/respuestat_'.$respuesta->getId().'.png'; ?>
              <?php if (file_exists($ruta_formula)): ?>
                <?php echo '<img src="/images/ecuaciones/respuestat_'.$respuesta->getId().'.png"/>' ?>
              <?php else:?>
                <div class="formula_vacio"></div>
              <?php endif;?>
            <?php else:?>
              <?php echo $respuesta->getRespuesta() ?>
            <?php endif;?>
          </td>

          <td class="td5" <?php echo $style?>>
          <?php if ($mostrar_solucion == 1):?>
            <?php if ($respuesta->getCorrecta()):?>
              <?php echo image_tag('right.png', 'title=Es correcta'); ?>
              <div class='correcta' style='display:none;'>correcta<?php echo $respuesta->getId()?></div>
            <?php else:?>
              <?php if ($respuesta->getSeleccionEjercicio($id_respuesta_ejercicio)):?>
                <?php echo image_tag('wrong.png', 'title=Incorrecta'); ?>
              <?php endif;?>
            <?php endif;?>
          <?php else:?>
            &nbsp;
          <?php endif;?>
          </td>

        </tr>
        <?php $indicerespuesta++;?>
        <?php $index++;?>
      <?php endforeach; ?>
      </table>
      <?php if ($mostrar_respuestas == 2):?>
        <?php echo (input_hidden_tag("id_cuestion_test$indice", $cuestion_test->getId())); ?>
      <?php endif;?>
    </td>
  </tr>


<?php if ($mostrar_edicion):?>
<tr>
  <td class="td1">&nbsp;</td>
  <td class="td2">
    <?php echo (input_hidden_tag('id_cuestion_test', $cuestion_test->getId())); ?>
    <?php echo (input_hidden_tag('indice', $indice)); ?>
    <?php echo (input_hidden_tag('id_ejercicio', $cuestion_test->getIdEjercicio())); ?>
    <?php echo submit_to_remote('ajax_submit', 'Modificar', array('update' => "cuestion_test$indice", 'url' => 'ejercicio/editarCuestionTest?modificar=1&mostrar_edicion='.$mostrar_edicion))?>
    <?php if ($mostrar_edicion != 2):?>
      <?php echo submit_to_remote('ajax_submit', 'Eliminar pregunta', array('update' => 'cuestiones_test', 'url' => 'ejercicio/mostrarTest?mostrar_edicion=1&borrar=1'))?>
    <?php endif;?>
  </td>
<?php endif;?>
</table>
