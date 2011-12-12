<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>
<?php use_helper('informacion'); ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">M&oacute;dulos instalados en la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="titulos_tabla_general">
        <table class="tmostrarCursos">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Opciones</th>
              </tr>
        </table>
    </div>

        <div class="listado_tabla_general_fixed">
        <table class="tmostrarCursos">
              <?php $i = 0; ?>
              <?php foreach($modulos as $modulo): ?>
                <?php $nombrecurso = $modulo->getNombre(); ?>
                <?php if ($nombrecurso != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to(truncate_text($nombrecurso, 55), 'supervisor/fichaModulo?idmodulo='.$modulo->getId(),array('id'=>'ln_modulo'.$modulo->getId())) ?></td>
                      <td class="td2"><?php echo $modulo->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $modulo->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4" style="text-align: center;">
                          <?php echo link_to(image_tag('ico_cursos_peq.gif',"Alt=\"Ver cursos del m&oacute;dulo $nombrecurso\" Title=\"Ver cursos del m&oacute;dulo $nombrecurso\" align=absmiddle"), 'supervisor/fichaModulo?idmodulo='.$modulo->getId().'&info=1',array('id'=>'ln_ficha_modulo'.$modulo->getId()) )?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_evaluacion_peq.gif',"Alt=\"Ver evaluaci&oacute;n del m&oacute;dulo $nombrecurso\" Title=\"Ver evaluaci&oacute;n del m&oacute;dulo $nombrecurso\" align=absmiddle"), '/evaluacion/evaluacionModulo?idmodulo='.$modulo->getId(),array('id'=>'ln_tareas_modulo'.$modulo->getId()) )?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_alumnos_peq.gif',"Alt=\"Ver alumnos del m&oacute;dulo $nombrecurso\" Title=\"Ver alumnos del m&oacute;dulo $nombrecurso\" align=absmiddle"), 'supervisor/listaAlumnosModulo?idmodulo='.$modulo->getId(),array('id'=>'ln_modulo'.$modulo->getId().'_alumnos')) ?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_profesores_peq.gif',"Alt=\"Ver profesores del m&oacute;dulo $nombrecurso\" Title=\"Ver profesores del m&oacute;dulo $nombrecurso\" align=absmiddle"), 'supervisor/listaProfesoresModulo?idmodulo='.$modulo->getId()) ?>
                      </td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>

              <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
           <?php echoAvisoVacioCorto('No hay m&oacute;dulos instalados en la plataforma');?>
         <?php endif;?>
     </div>
     <?php if ($i):?>
       <div class="totales_tabla">
         Total: &nbsp;<?php echo $i; ?> m&oacute;dulo(s)
       </div>
     <?php endif;?>
     <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('ico_cursos_peq.gif','Alt="Ver cursos del m&oacute;dulo" Title="Ver cursos del m&oacute;dulo"'); ?>
          </td>
          <td>
            Cursos
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_evaluacion_peq.gif','Alt="Ver evaluaci&oacute;n del m&oacute;dulo" Title="Ver evaluaci&oacute;n del m&oacute;dulo"'); ?>
          </td>
          <td>
            Evaluaci&oacute;n
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_alumnos_peq.gif','Alt="Ver alumnos del m&oacute;dulo" Title="Ver alumnos del m&oacute;dulo"'); ?>
          </td>
          <td>
            Alumnos
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_profesores_peq.gif','Alt="Ver profesores del m&oacute;dulo" Title="Ver profesores del m&oacute;dulo"'); ?>
          </td>
          <td>
            Profesores
          </td>
        </tr>
      </table>
    </div>

    <br>
    <? echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los m&oacute;dulos."); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
