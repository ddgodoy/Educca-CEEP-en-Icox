<?php $usuario = UsuarioPeer::retrieveByPk($sf_user->getAnyId()); ?>  
<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>

<table style="margin-bottom: 10px;">
<tr>
  
<?php if ($rol == 'profesor' && !$usuario->getInspector()):?>


  <?php if ($modo == 'mostrar'): ?>
    <td><?php echo sexy_button_to('Editar contenido', 'ejercicio/editarEjercicio?id_ejercicio='.$ejercicio->getId()) ?></td>
    <td><?php echo sexy_button_to('Editar soluci&oacute;n', 'ejercicio/resolverEjercicio?id_ejercicio='.$ejercicio->getId() ) ?></td>
    <?php if (!$eliminar_restringido):?>
      <td><?php echo sexy_button_to('Eliminar ejercicio', 'ejercicio/mostrarEjercicio?opcion=5&id_ejercicio='.$ejercicio->getId(), array('onClick' => "return confirm('&iquest;Est&aacute; seguro de que quiere borrar este ejercicio?');")) ?></td>
    <?php endif;?>
  <?php endif; ?>
  
  
  <?php if ($modo == 'edicion'): ?>
    <td><?php echo sexy_button_to('Finalizar edici&oacute;n de contenido', 'ejercicio/mostrarEjercicio?id_ejercicio='.$ejercicio->getId() ) ?></td>
  <?php endif; ?>
  
  
  <?php if ($modo == 'resolver'): ?>
    <td><?php echo sexy_submit_tag('Guardar resultados') ?></td>
  <?php endif; ?>
  
  
<?php endif; ?>



<?php if ($rol == 'alumno'):?>


  <?php if ($modo == 'mostrar'): ?>
    <td><?php echo sexy_button_to('Resolver / editar soluci&oacute;n', 'ejercicio/resolverEjercicio?id_ejercicio='.$ejercicio->getId()) ?></td>
  <?php endif; ?>
 
 
  <?php if ($modo == 'resolver'): ?>
    <td><?php echo sexy_submit_tag('Guardar resultados') ?></td> 
  <?php endif; ?>


<?php endif; ?>


<?php if ($rol == 'administrador' || $usuario->getInspector()):?>

    <td>&nbsp;</td>

<?php endif; ?>


</tr>
</table>
