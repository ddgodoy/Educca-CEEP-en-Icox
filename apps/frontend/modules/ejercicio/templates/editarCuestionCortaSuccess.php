<?php use_helper('Javascript') ?>

<?php if ($modificar):?>
<table class="tabla_cuestion_corta">
  <tr>
    <th class="td1">
      <?php echo("Cuesti&oacute;n $indice:"); ?>    
    </th>
    <td class="td2">
      <?php echo textarea_tag('cuestion_corta', $cuestion_corta->getPregunta(), 'size=70x4') ?>
    </td>
  </tr>
  <tr class="separador_cuestion_corta">
    <td class="td1"></td><td class="td2"></td>
  </tr>
  <tr>
    <th class="td1">
      Puntuaci&oacute;n:  
    </th>
    <td class="td2">
      <?php echo(input_tag('puntuacion', $cuestion_corta->getPuntuacion())); ?>
      <?php echo (input_hidden_tag('id_cuestion_corta', $cuestion_corta->getId())); ?>
      <?php echo (input_hidden_tag('indice', $indice)); ?>
    </td>
  </tr>
  <tr class="separador_cuestion_corta">
    <td class="td1"></td><td class="td2"></td>
  </tr>
  <tr>
    <th class="td1">
      &nbsp;
    </th>
    <td class="td2">
      <?php echo submit_to_remote('ajax_submit', 'Guardar cambios', array('update' => "cuestion_corta$indice", 'url' => 'ejercicio/editarCuestionCorta?guardar=1&mostrar_edicion='.$mostrar_edicion))?>
    </td>
  </tr>
</table>

<?php else:?>
  <?php include_partial('mostrarCuestionCorta', array('cuestion_corta' => $cuestion_corta, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => 0, 'mostrar_respuestas' => 0, 'mostrar_correccion' => 0)) ?>
<?php endif;?>



