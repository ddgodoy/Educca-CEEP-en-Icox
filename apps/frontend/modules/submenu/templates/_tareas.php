<?php if ($sf_user->getCursoMenu()):?>
  <?php $redireccion = '?idcurso='.$sf_user->getCursoMenu();?>
<?php else:?>
  <?php $redireccion = '';?>
<?php endif;?>

<div class="tit_box_submenu"><h2 class="titbox">Opciones de las Tareas</h2></div>
<ul class="listamenu">
    <?php if ($rol == 'alumno'):?>
      <li class="inicio"><?php echo link_to('Inicio', "tareas/index$redireccion") ?></li>
      <li class="nuevacita"><?php echo link_to('Tareas pendientes', "tareas/tareasPendientes$redireccion") ?></li>
      <li class="ejercicios_c"><?php echo link_to('Historial de entregas', "tareas/historialEntregas$redireccion") ?></li>
    <?php endif;?>

    <?php if ($rol == 'profesor'):?>
      <li class="inicio"><?php echo link_to('Inicio', "tareas/index$redireccion") ?></li>
      <li class="redactar"><?php echo link_to('Poner tareas y ex&aacute;menes', "tareas/tareasExamenes$redireccion") ?></li>
      <li class="ejercicios_c"><?php echo link_to('Cambiar o anular', "tareas/cambiarTareas$redireccion") ?></li>
    <?php endif;?>
</ul>
