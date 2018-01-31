<?php use_helper('SexyButton') ?>
<?php use_helper('Text') ?>
<?php $tipo_materia = $curso->getMateria()->getTipo(); ?>
<?php $idcurso = $curso->getId(); ?>

<div class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Alumnos del Curso: <?php echo $curso->getNombre()?></h2></div>
  <div class="contenido_principal">
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td style="padding-right: 15px;">
            <?php if ($busqueda):?>
              <?php echo sexy_button_to('Nueva b&uacute;squeda', 'supervisor/buscar?rol=alumno&idcurso='.$idcurso) ?>
            <?php else:?>
              <?php echo sexy_button_to('Buscar un alumno', 'supervisor/buscar?rol=alumno&idcurso='.$idcurso) ?>
            <?php endif;?>
          </td>
          <?php if ($tipo_materia != 'compo'):?>
            <td style="padding-right: 15px;">
              <?php echo sexy_button_to('Seguimiento de planificaci&oacute;n', 'seguimiento/sourceHitos?idcurso='.$idcurso) ?>
            </td>
            <td style="padding-right: 15px;">
              <?php echo sexy_button_to('Seguimiento por temas', 'seguimiento/seguimientoPorTemas?idcurso='.$idcurso) ?>
            </td>
          <?php endif;?>

        </tr>
      </table>
    </div>


    <div class="titulos_tabla_general">
        <table class="comp_lista_alumnos">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Tiempo dedicado</th>
                <th class="td3">% Teor&iacute;a</th>
                <th class="td3">% Ejercicios</th>
                <th class="td4">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general_fixed">
        <table class="comp_lista_alumnos">
          <?php $i = 0; ?>
          <?php foreach($alumnos as $alumno): ?>
            <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
              <tr class="cont_fil" <?= $fondo1 ?>>
                  <td class="td1"><?php echo link_to($alumno->getApellidos().", ".$alumno->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getId(), array('class'=>'a_explicito','id'=>'ln_usuario'.$alumno->getId())) ?></td>
                  <?php $tiempos = $alumno->tiemposDedicados($idcurso);        ?>
                  <?php if ($tiempos[0] + $tiempos[1] != 0) :?>
                    <?php use_helper('tiempo') ?>
                    <td class="td2"><?php echoTiempo($tiempos[0]+$tiempos[1])?></td>
                    <td class="td3"><?php echo floor(100-($tiempos[1]/($tiempos[0]+$tiempos[1]))*100)?>%</td>
                    <td class="td3"><?php echo floor(($tiempos[1]/($tiempos[0]+$tiempos[1]))*100)?>%</td>
                  <?php else :?>
                    <td class="td2">00:00:00</td>
                    <td class="td3">0%</td>
                    <td class="td3">0%</td>
                  <?php endif; ?>
                  <td class="td4">
                    <?php echo link_to(image_tag('incompleto.png', 'title="Gr&aacute;fica de tiempos dedicados al curso por el alumno" alt="Gr&aacute;fica de tiempos dedicados al curso por el alumno" align="absmiddle"'), 'seguimiento/grafica?idusuario='.$alumno->getId().'&tipo=alumno&idcurso='.$idcurso,array('id'=>'tiempo_alumno'.$alumno->getId())) ?>
                    <?php if ($curso->getMateria()->getTipo() != 'compo'):?>
                    <?php if ('supervisor'== $sf_user->obtenerCredenciales()) :?>  
                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_seguimiento_peq.gif', 'title="Gr&aacute;fica de planificaci&oacute;n. Permite ver si el alumno ha cumplido con la planificaci&oacute;n establecida para el curso." alt="Gr&aacute;fica de seguimiento. Permite ver si el alumno ha cumplido con la planificaci&oacute;n establecida para el curso." align="absmiddle"'), 'seguimiento/sourceHitos?idusuario='.$alumno->getId().'&idcurso='.$idcurso) ?>
                    <?php endif; ?>
                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_cursos_peq.gif', 'title="Gr&aacute;fica de tiempos dedicados por tema" alt="Gr&aacute;fica de tiempos dedicados por tema" align="absmiddle"'), 'seguimiento/seguimientoPorTemas?idusuario='.$alumno->getId().'&idcurso='.$idcurso,array('id'=>'tiempo_alumno'.$alumno->getId())) ?>
                    <?php endif;?>
                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_evaluacion_peq.gif', 'title="Ficha de evaluaci&oacute;n del alumno en el curso" alt="Ficha de evaluaci&oacute;n del alumno en el curso" align="absmiddle"'), '/seguimiento/fichaEvaluacion?idcurso='.$idcurso.'&idalumno='.$alumno->getId(), array('id'=>'evaluacion_alumno'.$alumno->getId(),'popup' => array('', 'width=765,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,top=0,left=200'))) ?>
                  </td>
              </tr>
            <?php $i++ ?>
          <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
           <?php echoAvisoVacioCorto('No hay alumnos matriculados en este curso');?>
         <?php endif;?>
    </div>
    <?php if ($i):?>
       <div class="totales_tabla">
         Total: &nbsp;<?php echo $i; ?> alumno(s)
       </div>
     <?php endif;?>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('incompleto.png','Alt=Cursos del alumno Title=Cursos del alumno'); ?>
          </td>
          <td>
            Gr&aacute;fica de tiempos dedicados
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_seguimiento_peq.gif','Alt=M&oacute;dulos del alumno Title=M&oacute;dulos del alumno'); ?>
          </td>
          <td>
            Gr&aacute;fica de planificaci&oacute;n
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_cursos_peq.gif','Alt=Eliminar usuario Title=Eliminar usuario'); ?>
          </td>
          <td>
            Gr&aacute;fica de tiempos por tema
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_evaluacion_peq.gif','Alt=Eliminar usuario Title=Eliminar usuario'); ?>
          </td>
          <td>
            Ficha de evaluaci&oacute;n
          </td>
        </tr>
      </table>
    </div>
   <br>
   <?php use_helper('informacion') ?>
   <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n de los alumnos, y observar sus progresos')?>
   <br><?php use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_principal"></div>
</div>
