<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>

<div class="nota_informativa">Elija el ejercicio que ira asociado a esta tarea o examen:</div>
<br>
<div class="titulos_tabla_general">
  <table class="tabla_ejercicios_rep">
    <tr>
      <th class="td_select">&nbsp;</th>
      <th class="td1">T&iacute;tulo</th>
      <th class="td3">Tipo</th>
      <th class="td4">Publicado</th>
      <th class="td5">Publicada soluci&oacute;n</th>
      <th class="relleno">&nbsp;</th>
    </tr>
  </table>
</div><div class="listado_tabla_general">
  <table class="tabla_ejercicios_rep">
    <?php $i = 0; ?>
    <?php foreach($ejercicios as $ejercicio): ?>
      <?php $fondo = (($i % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <?php if($i == 0):?>
          <td class="td_select"><?php echo radiobutton_tag('seleccion', $ejercicio->getId(), true) ?></td>
        <?php else:?>
          <td class="td_select"><?php echo radiobutton_tag('seleccion', $ejercicio->getId(), false) ?></td>
        <?php endif;?>
        <td class="td1"><?php echo(truncate_text($ejercicio->getTitulo(), 30)); ?></td>
        <td class="td3"><?php echo $ejercicio->getTipo() ?></td>
        <td class="td4">
          <?php if ($ejercicio->getPublicadoCurso($id_curso)) {echo("S&iacute;");} else {echo("No");} ?>
        </td>
        <td class="td5">
          <?php if ($ejercicio->getPublicadaSolucionCurso($id_curso)) {echo("S&iacute;");} else {echo("No");} ?>
        </td>
        <td class="relleno"></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
    </table>
    <?php echo (input_hidden_tag('total_ejercicios', $i)); ?>

    <?php if (!$i) : ?>
      <?php echoAvisoVacio("No ha creado ning&uacute;n ejercicio para este curso"); ?>
    <?php endif; ?>

</div>
<br>


<?php if ($i):?>
  <?php echoWarning('Sobre los ejercicios publicados', 'Tenga cuidado al elegir ejercicios que haya publicado alguna vez porque es posible que los alumnos ya los conozcan y sepan la soluci&oacute;n de antemano.'); ?>
  <br>
  <?php echo submit_tag('Siguiente >>') ?>
<?php endif; ?>
