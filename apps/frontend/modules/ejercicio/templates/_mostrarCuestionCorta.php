<?php 
  if ($cuestion_corta->getPuntuacion() == 1) {
    $texto_puntuacion = "1 punto";
  } else {
    $texto_puntuacion = $cuestion_corta->getPuntuacion()." puntos";
  }
?>
<table class="tabla_cuestion_corta">
  <tr>
    <th class="td1">
      <?php echo("Cuesti&oacute;n $indice:"); ?>    
    </th>
    <td class="td2">
      <pre class="texto_normal"><?php echo wordwrap($cuestion_corta->getPregunta(), 118, "\n", 1);?></pre>
    </td>
  </tr>
  
  <?php if ($mostrar_respuestas):?>
  
    <?php $respuesta = $cuestion_corta->getRespuestaEjercicio($id_respuesta_ejercicio);?>
    <?php if ($respuesta):?>
      <?php $texto_respuesta = $respuesta->getRespuesta(); $id_respuesta = $respuesta->getId();?>
    <?php else:?>
      <?php $texto_respuesta = ""; $id_respuesta = 0;?>
    <?php endif;?>
    <tr class="separador_cuestion_corta">
      <td class="td1"></td><td class="td2"></td>
    </tr>
    <tr>
      <td class="td1"><strong>Respuesta: </strong></td>
      
        <?php if (($mostrar_respuestas) == 0):?>
        <td class="td2"></td>
        <?php endif;?>
      
        <?php if (($mostrar_respuestas) == 1):?>
          <td class="td2" id="filarayada_azul"><pre class="texto_normal"><?php echo wordwrap($texto_respuesta, 118, "\n", 1);?></pre></td>
        <?php endif;?>
      
        <?php if (($mostrar_respuestas) == 2):?>
        <td class="td2">
          <?php echo textarea_tag("respuesta_cuestion_corta$indice", $texto_respuesta, 'size=60x4') ?>
          <?php echo (input_hidden_tag("id_respuesta_cuestion_corta$indice", $id_respuesta)); ?>
          <?php echo (input_hidden_tag("id_cuestion_corta$indice", $cuestion_corta->getId())); ?>
        </td>
        <?php endif;?>
      
    </tr>
  <?php endif;?>
  
  <?php if ($mostrar_solucion):?>
    <?php $solucion = $cuestion_corta->getSolucion();?>
    <?php if ($solucion):?>
    <tr class="separador_cuestion_corta">
      <td class="td1"></td><td class="td2"></td>
    </tr>
      <tr>
        <td class="td1"><strong>Soluci&oacute;n: </strong></td>
        <td class="td2" id="filarayada_verde"><pre class="texto_normal"><?php echo wordwrap($solucion->getRespuesta(), 118, "\n", 1);?></pre></td>
      </tr>
    <?php endif;?>
  <?php endif;?>
  
  <?php if ($mostrar_correccion):?>
    <?php if ($mostrar_correccion == 1):?>
    <tr class="separador_cuestion_corta">
      <td class="td1"></td><td class="td2"></td>
    </tr>
    <tr>
      <td class="td1"><strong>Comentario del profesor: </strong></td>
      <td class="td2" id="filarayada_amarilla"><pre class="texto_normal"><?php echo($respuesta->getComentario());?></pre></td>
    </tr>
    <tr class="separador_cuestion_corta">
      <td class="td1"></td><td class="td2"></td>
    </tr>
    <tr>
      <th class="td1">Puntuacion obtenida:</th>
      <th class="td2"><?php echo($respuesta->getPuntuacion().' puntos de '.$cuestion_corta->getPuntuacion());?></th>
    </tr>
    <?php endif;?>
    
    <?php if ($mostrar_correccion == 2):?>
      <tr class="separador_cuestion_corta">
        <td class="td1"></td><td class="td2"></td>
      </tr>
      <tr>
        <td class="td1"><strong>Comentario del profesor: </strong></td>
        <td class="td2"><?php echo textarea_tag("comentario_cuestion_corta$indice", $respuesta->getComentario(), 'size=60x2') ?></td>
      </tr>
      <tr class="separador_cuestion_corta">
        <td class="td1"></td><td class="td2"></td>
      </tr>
      <tr>
        <th class="td1">Puntuaci&oacute;n: </th>
        <td class="td2">
          <?php echo(input_tag("puntuacion_cuestion$indice", $respuesta->getPuntuacion()));?> &nbsp;&nbsp;&nbsp;<strong>(M&aacute;ximo <?php echo $cuestion_corta->getPuntuacion()?>)</strong>
          <?php echo (input_hidden_tag("id_respuesta_cuestion_corta$indice", $respuesta->getId())); ?>
        </td>
      </tr>
    <?php endif;?>
  <?php else:?>
    <tr class="separador_cuestion_corta">
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
<tr class="separador_cuestion_corta">
  <td class="td1"></td><td class="td2"></td>
</tr>
<tr>
  <th class="td1">
    &nbsp;
  </th>
  <th class="td2">
    <?php echo (input_hidden_tag('id_cuestion_corta', $cuestion_corta->getId())); ?>
    <?php echo (input_hidden_tag('indice', $indice)); ?>
    <?php echo (input_hidden_tag('id_ejercicio', $cuestion_corta->getIdEjercicio())); ?>
    <?php echo submit_to_remote('ajax_submit', 'Modificar', array('update' => "cuestion_corta$indice", 'url' => 'ejercicio/editarCuestionCorta?modificar=1&mostrar_edicion='.$mostrar_edicion, 'script' => true))?>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php if ($mostrar_edicion != 2):?>
      <?php echo submit_to_remote('ajax_submit', 'Eliminar pregunta', array('update' => 'cuestiones_cortas', 'url' => 'ejercicio/mostrarCuestionario?mostrar_edicion=1&borrar=1'))?>
    <?php endif; ?>
  </th>
</tr>
<?php endif;?>
</table>
