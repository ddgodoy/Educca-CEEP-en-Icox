<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>

<table>
<tr>

  <?php if ($modo == 'evaluar'): ?>
    <?php if ($ejercicio->getTipo() == 'test'):?>
      <td width="10%"><?php echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo') ?></td>
      <td width="90%"><strong>Los ejercicios de test se corrigen todos juntos desde 'Evaluaci&oacute;n y revisi&oacute;n de ejercicios'.</strong></td>
    <?php else:?>
      <td><?php echo sexy_button_to('Evaluar ejercicio', 'evaluacion/evaluarEjercicio?id_respuesta_ejercicio='.$id_respuesta_ejercicio) ?></td>
    <?php endif; ?>  
  <?php endif; ?>
 
  <?php if ($modo == 'evaluando'): ?>
    <td><?php echo sexy_submit_tag('Guardar evaluaci&oacute;n') ?></td>
  <?php endif; ?>

</tr>
</table>
