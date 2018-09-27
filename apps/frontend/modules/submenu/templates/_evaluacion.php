<?php if ($rol == 'profesor'):?>
<?php if ($sf_user->getCursoMenu()):?>
  <?php $redireccion = '?idcurso='.$sf_user->getCursoMenu();?>
<?php else:?>
  <?php $redireccion = '';?>
<?php endif;?>

<div class="tit_box_submenu"><h2 class="titbox">Opciones de evaluaci&oacute;n</h2></div>
<ul class="listamenu">
  <li class="redactar"><?php echo link_to('Evaluaci&oacute;n y revisi&oacute;n', "/evaluacion/evaluacionRevision$redireccion") ?></li>
  <li class="ejercicios_c"><?php echo link_to('Calificaciones', "/evaluacion/calificaciones$redireccion") ?></li>
</ul>
<?php endif;?>
