<?php
  if ($cuestion_practica->getPuntuacion() == 1) {
    $texto_puntuacion = "1 punto";
  } else {
    $texto_puntuacion = $cuestion_practica->getPuntuacion()." puntos";
  }
?>
<table class="tabla_cuestion_practica">
  <tr>
    <th class="td1">
      <?php echo("Problema $indice:"); ?>
    </th>
    <td class="td2">
      <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/cuestionp_'.$cuestion_practica->getId().'.png'; ?>
      <?php if (file_exists($ruta_formula)): ?>
        <?php echo '<img src="/images/ecuaciones/cuestionp_'.$cuestion_practica->getId().'.png"/>' ?>
      <?php else:?>
        <div class="formula_vacio"></div>
      <?php endif;?>
    </td>
  </tr>

  <?php if ($mostrar_correccion):?>
    <?php $respuesta = $cuestion_practica->getRespuestaEjercicio($id_respuesta_ejercicio); ?>

    <?php if ($mostrar_correccion == 1):?>
    <tr class="separador_cuestion_practica">
      <td class="td1"></td><td class="td2"></td>
    </tr>
    <tr>
      <th class="td1">Puntuacion obtenida:</th>
      <th class="td2"><?php echo($respuesta->getPuntuacion().' puntos de '.$cuestion_practica->getPuntuacion());?></th>
    </tr>
    <?php endif;?>

    <?php if ($mostrar_correccion == 2):?>
      <tr class="separador_cuestion_practica">
        <td class="td1"></td><td class="td2"></td>
      </tr>
      <tr>
        <th class="td1">Puntuaci&oacute;n: </th>
        <td class="td2">
          <?php echo(input_tag("puntuacion_cuestion$indice", $respuesta->getPuntuacion()));?> &nbsp;&nbsp;&nbsp;<strong>(M&aacute;ximo <?php echo $cuestion_practica->getPuntuacion()?>)</strong>
          <?php echo (input_hidden_tag("id_respuesta_cuestion_practica$indice", $respuesta->getId())); ?>
        </td>
      </tr>
    <?php endif;?>
  <?php else:?>
    <tr class="separador_cuestion_practica">
      <td class="td1"></td><td class="td2"></td>
    </tr>
    <tr>
      <th class="td1">
        Puntuaci&oacute;n:
      </th>
      <th class="td2">
        <?php echo $texto_puntuacion ?>
      </th>
    </tr>
  <?php endif;?>


<?php if ($mostrar_edicion):?>
<tr class="separador_cuestion_practica">
  <td class="td1"></td><td class="td2"></td>
</tr>
<tr>
  <th class="td1">
    &nbsp;
  </th>
  <th class="td2">
    <?php echo (input_hidden_tag('id_cuestion_practica', $cuestion_practica->getId())); ?>
    <?php echo (input_hidden_tag('indice', $indice)); ?>
    <?php echo (input_hidden_tag('id_ejercicio', $cuestion_practica->getIdEjercicio())); ?>
    <?php echo submit_to_remote('ajax_submit', 'Modificar', array('update' => "cuestion_practica$indice", 'url' => 'ejercicio/editarCuestionPractica?modificar=1&mostrar_edicion='.$mostrar_edicion))?>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php if ($mostrar_edicion != 2):?>
      <?php echo submit_to_remote('ajax_submit', 'Eliminar problema', array('update' => 'cuestiones_practicas', 'url' => 'ejercicio/mostrarProblemas?mostrar_edicion=1&borrar=1'))?>
    <?php endif; ?>
  </th>
</tr>
<?php endif;?>
</table>

<?php if ($mostrar_respuestas == 2):?>
  <?php echo (input_hidden_tag("id_cuestion_practica$indice", $cuestion_practica->getId())); ?>
<?php endif;?>
