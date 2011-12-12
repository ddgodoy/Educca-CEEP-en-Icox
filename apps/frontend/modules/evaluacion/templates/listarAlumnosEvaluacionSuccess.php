<?php use_helper('informacion') ?>
<?php if ($id_curso):?>

  <div class="titulos_tabla_general">
    <table class="evaluacion_resumen_alumnos">
      <tr>
        <th class="td1">&nbsp;</th>
        <th class="grupo">Ejercicios realizados</th>
        <th class="td5">&nbsp;</th>
      </tr>
    </table>
  </div>
  <div class="titulos_tabla_general">
    <table class="evaluacion_resumen_alumnos">
      <tr>
        <th class="td1">Apellidos, Nombre</th>
        <th class="td2">Tests</th>
        <th class="td3">Cuestionarios</th>
        <th class="td3">Problemas</th>
        <th class="td5">Nota final</th>
      </tr>
    </table>
  </div>

  <div class="listado_tabla_general">
    <table class="evaluacion_resumen_alumnos">
      <?php $i = 0;?>
      <?php foreach($alumnos as $alumno):?>
      <?php $fondo = (($i % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <?php $ntests = $alumno->contarEjercicios('test', $id_curso); ?>
        <?php $ncuestionarios = $alumno->contarEjercicios('cuestionario', $id_curso); ?>
        <?php $nproblemas = $alumno->contarEjercicios('problemas', $id_curso); ?>

        <td class="td1"><?php echo link_to($alumno->getApellidos().', '.$alumno->getNombre(), 'evaluacion/resumenEvaluacionAlumno?id_alumno='.$alumno->getId().'&id_curso='.$id_curso, array('id'=>'ln_evaluar_alumno'.$alumno->getId(),'popup' => array('', 'width=765,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,top=0,left=200')))?></td>
        <td class="td2"><?php if ($ntests) {echo("<strong>$ntests</strong>");} else {echo('0');} ?></td>
        <td class="td3"><?php if ($ncuestionarios) {echo("<strong>$ncuestionarios</strong>");} else {echo('0');} ?></td>
        <td class="td4"><?php if ($nproblemas) {echo("<strong>$nproblemas</strong>");} else {echo('0');} ?></td>
        <?php $c = new Criteria(); $c->add(CalificacionesPeer::ID_USUARIO, $alumno->getId()); $c->add(CalificacionesPeer::ID_CURSO, $id_curso); $cal = CalificacionesPeer::DoSelectOne($c);?>
        <?php if ($cal):?>
          <th class="td5"><div class='c_nota_usuario<?echo $alumno->getId()?>'><?php echo $cal->getScore();?></div></th>
        <?php else:?>
          <th class="td5">No asignada</th>
        <?php endif;?>

        <?php $i++;?>
      <?php endforeach;?>
    </table>

    <?php if (!$i):?>
      <?php echoAvisoVacio('No hay ning&uacute;n alumno matriculado en el curso'); ?>
    <?php endif; ?>
  </div>

  <?php if ($i):?>
    <br><?php echoNotaInformativa('', 'Para ver las calificaciones en detalle de un alumno y poner notas finales haga click en el nombre del alumno'); ?>
  <?php endif; ?>

<?php endif;?>



