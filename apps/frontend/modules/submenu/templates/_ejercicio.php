<?php if ($sf_user->getCursoMenu()):?>
  <?php $redireccion = '?idcurso='.$sf_user->getCursoMenu();?>
<?php else:?>
  <?php $redireccion = '';?>
<?php endif;?>

<?php if ($rol == 'profesor'):?>
  <div class="tit_box_submenu"><h2 class="titbox">Opciones de Ejercicios</h2></div>
  <ul class="listamenu">
    <li class="inicio"><?php echo link_to('Inicio', "ejercicio/index$redireccion", array('id'=>'ln_inicio_ejercicio')) ?></li>
    <li class="redactar"><?php echo link_to('Crear un ejercicio', "ejercicio/crearEjercicio$redireccion", array('id'=>'ln_crear_ejercicio')) ?></li>
    <li class="configuracion"><?php echo link_to('Edici&oacute;n de ejercicios', "ejercicio/ejercicios$redireccion", array('id'=>'ln_editar_ejercicio')) ?></li>
  </ul>
<?php endif;?>
