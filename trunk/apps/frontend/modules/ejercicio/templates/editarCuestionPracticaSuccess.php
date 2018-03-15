<?php use_helper('Javascript') ?>
<?php if($reload == 1):?>
<script>
    location.reload();
</script>
<?php endif; ?>
<?php if ($modificar):?>
<table class="tabla_cuestion_practica">
  <tr>
    <th class="td1">
      <?php echo("Problema $indice:"); ?>    
    </th>
    <td class="td2">
      <?php echo (input_hidden_tag('id_cuestion_practica', $cuestion_practica->getId())); ?>
      <?php echo (input_hidden_tag('indice', $indice)); ?>
      <?php $ruta_formula = SF_ROOT_DIR.'/web/images/ecuaciones/cuestionp_'.$cuestion_practica->getId().'.png'; ?>
      <?php $id_div = "div_pregunta".$cuestion_practica->getId(); ?>
      <?php if (file_exists($ruta_formula)): ?>
        <div id="<?php echo $id_div; ?>" style="width: 97%; border-width: 2px; border-style: solid; border-color: #FFFFFF;" onMouseOver="this.style.borderColor = '#D6E2EF';" onMouseOut="this.style.borderColor = '#FFFFFF';" onClick="abrirVentanaExp('p', 1, <?php echo $cuestion_practica->getId()?>, '<?php echo $id_div; ?>', 'target')"><?php echo '<img src="/images/ecuaciones/cuestionp_'.$cuestion_practica->getId().'.png"/>' ?></div>
      <?php else:?>
        <div id="<?php echo $id_div; ?>" class="formula_vacio" onMouseOver="this.style.backgroundColor='#E6F2FF';" onMouseOut="this.style.backgroundColor='#FFFFFF';" onClick="abrirVentanaExp('p', 1, <?php echo $cuestion_practica->getId()?>, '<?php echo $id_div; ?>', 'target')"><br><strong>Haga click aqu&iacute; para a&ntilde;adir contenido a este problema</strong></div>
      <?php endif;?>
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
      <?php echo(input_tag('puntuacion', $cuestion_practica->getPuntuacion())); ?>
      <?php echo (input_hidden_tag('id_cuestion_practica', $cuestion_practica->getId())); ?>
      <?php echo (input_hidden_tag('indice', $indice)); ?>
    </td>
  </tr>
  <tr class="separador_cuestion_practica">
    <td class="td1"></td><td class="td2"></td>
  </tr>
  <tr>
    <th class="td1">
      &nbsp;
    </th>
    <td class="td2">
      <?php echo submit_to_remote('ajax_submit', 'Guardar cambios', array('update' => "cuestion_practica$indice", 'url' => 'ejercicio/editarCuestionPractica?guardar=1&mostrar_edicion='.$mostrar_edicion))?>
    </td>
  </tr>
</table>

<?php else:?>
  <?php include_partial('mostrarCuestionPractica', array('cuestion_practica' => $cuestion_practica, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => 0, 'mostrar_respuestas' => 0, 'mostrar_correccion' => 0)) ?>
<?php endif;?>

