<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>

<table style="width: 100%; text-align: left;">
<tr>

  <?php if ($modo == 'mostrar'): ?>
  
    <?php $evento = $tarea->getEvento(); ?>
    <?php if ($relacion->getEntregada() || (($relacion->getIdEjercicioResuelto() != null) && ($evento->getFechaFin('U') <= time()))): ?>
      
      <td width="5%"><?php echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo') ?></td>
      <td width="65%"><strong>Ya ha entregado este ejercicio y no se puede modificar</strong></td>
      <td width="30%">
        <?php if ($relacion->getCorregida() ):?>
          <?php echo sexy_button_to('Solicitar reclamaci&oacute;n', 'tareas/reclamar?id_tarea='.$tarea->getId(), array('onClick' => 'return confirmar_reclamacion();')) ?>
        <?php endif;?>
      </td>
    <?php else:?>
      <?php if ($evento->getFechaFin('U') <= time()):?>
        <td width="5%"><?php echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo') ?></td>
        <td width="65%"><strong>Perdi&oacute; la oportunidad de entregar este ejercicio y ya no se puede modificar</strong></td>
        <td width="30%"><?php //echo sexy_button_to('Solicitar reclamaci&oacute;n', 'tareas/reclamar?id_tarea='.$tarea->getId(), array('onClick' => 'return confirmar_reclamacion();')) ?></td>
      <?php else: ?>
        <td><?php echo sexy_button_to('Resolver / editar soluci&oacute;n', 'tareas/resolverEjercicioTarea?id_tarea='.$tarea->getId()) ?></td>
        <?php if ($id_respuesta_ejercicio): ?>
          <td><?php echo sexy_button_to('Entregar este ejercicio', 'tareas/entregarTarea?id_respuesta_ejercicio='.$id_respuesta_ejercicio) ?></td>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
 
  <?php if ($modo == 'resolver'): ?>
    <td><?php echo sexy_submit_tag('Guardar resultados') ?></td>
  <?php endif; ?>

</tr>
</table>
