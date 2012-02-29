  <?php if  ($sf_user->getCursoMenu() ) : ?>
        <?php $redireccion = "?idcurso=".$sf_user->getCursoMenu(); ?>
   <?php else  : ?>
         <?php $redireccion = "?" ; ?>
   <?php endif; ?>


<div class="tit_box_submenu"><h2 class="titbox">Men&uacute; Calendario <?echo ($principal==1)? "Principal" : "Curso"?></h2></div>
<ul class="listamenu">
    <?php if ($principal==1) : ?>
    <li class="nuevacita"><?php echo link_to('Nueva cita', 'calendario/nuevoEventoCita?principal=1') ?></li>
    <!--<li class="nuevacita"><?php //echo link_to('Eliminar cita', 'calendario/eliminarCitas?principal=1') ?></li> -->
    <li class="ultimoseventos"><?php echo link_to('&Uacute;ltimos eventos', 'calendario/mostrarCalendario?principal=1') ?></li>
    	<?php if ($rol == 'profesor') : ?>
      	<li class="nuevoevento"><?php echo link_to('Nuevo evento', 'calendario/nuevoEvento?principal=1') ?></li>
      	<li class="borrarevento"><?php echo link_to('Eliminar evento', 'calendario/eliminarEventos?principal=1') ?></li>
    	<?php endif; ?>
    <li class="configuracion"><?php echo link_to('Configurar', 'calendario/configuracion?principal=1') ?></li>
    <?php else : ?>
      <? /*<li class="nuevacita"><?php echo link_to('Nueva cita', 'calendario/nuevoEventoCita'.$redireccion) ?></li>
      <li class="nuevacita"><?php echo link_to('Eliminar cita', 'calendario/eliminarCitas'.$redireccion) ?></li>*/?>
      <li class="ultimoseventos"><?php echo link_to('&Uacute;ltimos eventos', 'calendario/mostrarCalendario'.$redireccion,array('id' => 'ln_ultimosEventos')) ?></li>
    	<?php if ($rol == 'profesor') : ?>
      	<li class="nuevoevento"><?php echo link_to('Nuevo evento', 'calendario/nuevoEvento'.$redireccion,array('id' => 'ln_nuevoEventos')) ?></li>
      	<li class="borrarevento"><?php echo link_to('Eliminar evento', 'calendario/eliminarEventos'.$redireccion,array('id' => 'ln_eliminarEventos')) ?></li>
    	<?php endif; ?>
    <li class="configuracion"><?php echo link_to('Configurar', 'calendario/configuracion'.$redireccion,array('id' => 'ln_confEventos')) ?></li>
    <? endif; ?>

</ul>

