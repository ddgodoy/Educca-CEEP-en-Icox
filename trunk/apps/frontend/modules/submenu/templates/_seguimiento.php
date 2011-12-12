<?php if ($sf_user->getCursoMenu()) : ?>
        <?php $idcurso = $sf_user->getCursoMenu(); $redireccion = "?idcurso=".$idcurso; ?>
        <?php $curso = CursoPeer::retrieveByPk($idcurso); ?>
   <?php else  : ?>
         <?php $redireccion = "?" ;?>
   <?php endif; ?>

<?php if ($sf_context->getActionName() != "index") : ?>

 <?php if (($rol == 'alumno') || ($rol == 'profesor')): ?>
<div class="tit_box_submenu"><h2 class="titbox">Men&uacute; seguimiento</h2></div>
<ul class="listamenu">
    <?php if ($rol == 'alumno'): ?>
      <li class="inicio"><?php echo link_to('Inicio', 'seguimiento/index?idcurso='.$sf_user->getCursoMenu(),array('id' => 'ln_segInicio')) ?></li>
      <?php if ($curso->getMenuPlanificacionAlumnos()):?>
      <li class="nuevacita"><?php echo link_to('Planificaci&oacute;n','seguimiento/sourceHitos'.$redireccion,array('id' => 'ln_segPlanificacion') ) ?></li>
      <?php endif;?>
      <li class="redactar"><?php echo link_to('Mi ficha de evaluaci&oacute;n', "seguimiento/fichaEvaluacion$redireccion",array('id' => 'ln_segFicha')) ?></li>
      <li class="ejercicios_c"><?php echo link_to('Tiempo dedicado', 'seguimiento/grafica'.$redireccion.'&tipo=alumno&idusuario='.$sf_user->getAnyId()."&idcurso=".$idcurso,array('id' => 'ln_segTiempoDedicado')) ?></li>
    <?php endif;?>

    <?php if ($rol == 'profesor'):?>
    <li class="inicio"><?php echo link_to('Inicio', 'seguimiento/index'.$redireccion,array('id' => 'ln_segInicio')) ?></li>
    <li class="alumnos"><?php echo link_to('Lista Alumnos', 'seguimiento/listarAlumnosCurso'.$redireccion,array('id' => 'ln_segAlumnos')) ?></li>
    <?php if (isset($curso)) : ?>
        <?php if ($curso->getMenuPlanificacionAlumnos()):?>
          <li class="tiemposreloj"><?php echo link_to('Control de planificaci&oacute;n', 'seguimiento/sourceHitos'.$redireccion,array('id' => 'ln_segPlanificacion')) ?></li>
        <?php endif;?>
    <? endif; ?>
    <li class="nuevacita"><?php echo link_to('Tiempo de estudio', '/seguimiento/seguimientoPorTemas'.$redireccion,array('id' => 'ln_segTemas')) ?></li>
    <li class="enviados"><?php echo link_to('Tareas', '/seguimiento/seguimientoTareas'.$redireccion,array('id' => 'ln_segTareas')) ?></li>
    <li class="ejercicios_c"><?php echo link_to('Calificaciones', '/seguimiento/estadisticaCalificaciones'.$redireccion,array('id' => 'ln_segCalificaciones')) ?></li>
    <?php endif;?>
</ul>
 <?php endif; ?>
<?php endif; ?>
