<?php use_helper('SexyButton') ?>
<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<?php use_helper('PagerNavigation') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Cursos instalados en la plataforma</h2></div>
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
              <?php foreach($cursos->getResults() as $curso): ?>
                <?php $nombrecurso = $curso->getNombre(); ?>
                <?php if ($nombrecurso != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to(truncate_text($nombrecurso, 54), 'supervisor/fichaCurso?idcurso='.$curso->getId(),array('id'=>'ln_curso'.$curso->getId())) ?></td>
                      <td class="td2"><?php echo $curso->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4">
                          <?php echo link_to(image_tag('ico_seguimiento_peq.gif',"Alt=\"Informe de seguimiento del curso $nombrecurso\" Title=\"Informe de seguimiento del curso $nombrecurso\" align=absmiddle"), 'supervisor/informeSeguimiento?idcurso='.$curso->getId(),array('id'=>'ln_seguimiento_curso'.$curso->getId()) )?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_cursos_peq.gif',"Alt=\"Ficha completa del curso $nombrecurso\" Title=\"Ficha completa del curso $nombrecurso\" align=absmiddle"), 'supervisor/fichaCurso?idcurso='.$curso->getId().'&info=1',array('id'=>'ln_ficha_curso'.$curso->getId()) )?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_tareas_peq.gif',"Alt=\"Ver tareas del curso $nombrecurso\" Title=\"Ver tareas del curso $nombrecurso\" align=absmiddle"), '/seguimiento/estadisticaCalificaciones?idcurso='.$curso->getId(),array('id'=>'ln_tareas_curso'.$curso->getId()) )?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_dudas_peq.gif',"Alt=\"Ver dudas del curso $nombrecurso\" Title=\"Ver dudas del curso $nombrecurso\" align=absmiddle"),'seguimiento/grafica?&tipo=dudas&idcurso='.$curso->getId(),array('id'=>'ln_dudas_curso'.$curso->getId())) ?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_alumnos_peq.gif',"Alt=\"Ver alumnos del curso $nombrecurso\" Title=\"Ver alumnos del curso $nombrecurso\" align=absmiddle"), 'supervisor/listaAlumnos?idcurso='.$curso->getId(),array('id'=>'ln_alumnos_curso'.$curso->getId())) ?>
                          &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_profesores_peq.gif',"Alt=\"Ver profesores del curso $nombrecurso\" Title=\"Ver profesores del curso $nombrecurso\" align=absmiddle"), 'supervisor/listaProfesores?idcurso='.$curso->getId(),array('id'=>'ln_profesores_curso'.$curso->getId())) ?>
                          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="window.open('<?php echo url_for('supervisor/informeTripartita?idcurso='.$curso->getId()); ?>', 'popupinformes', 'params')"><?php echo image_tag('ico_tripartita_peq.gif',"Alt=\"Generar informe tripartita curso $nombrecurso\" Title=\"Generar informe tripartita curso $nombrecurso\" align=absmiddle")?></a>
                      </td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>

              <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
           <?php echoAvisoVacioCorto('No hay cursos instalados en la plataforma');?>
         <?php endif;?>
     </div>
     <?php if ($i):?>
       <div class="totales_tabla">
         <?php include_partial('menu/pager', array('pager'=>$cursos, 'url'=>$index_url, 'params'=>'', 'oCant'=>$cursos->getNbResults())) ?>
       </div>
     <?php endif;?>
     <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('ico_seguimiento_peq.gif','Alt="Informe de seguimiento" Title="Informes de seguimiento"'); ?>
          </td> 
          <td>
            Informe de seguimiento
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_cursos_peq.gif','Alt="Ficha completa del curso" Title="Ficha completa del curso"'); ?>
          </td>
          <td>
            Ficha del curso
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_tareas_peq.gif','Alt="Ver tareas del curso" Title="Ver tareas del curso"'); ?>
          </td>
          <td>
            Tareas
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_dudas_peq.gif','Alt="Ver dudas del curso" Title="Ver dudas del curso"'); ?>
          </td>
          <td>
            Dudas
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_alumnos_peq.gif','Alt="Ver alumnos del curso" Title="Ver alumnos del curso"'); ?>
          </td>
          <td>
            Alumnos
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_profesores_peq.gif','Alt="Ver profesores del curso" Title="Ver profesores del curso"'); ?>
          </td>
          <td>
            Profesores
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_tripartita_peq.gif','Alt="Generar informe tripartita" Title="Generar informe tripartita"'); ?>
          </td>
          <td>
            Informe tripartita
          </td>
        </tr>
      </table>
    </div>
      <br>

      <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a toda la informaci&oacute;n de un curso.')?>

   </div> <!-- cont_box_correo-->
  <div class="cierre_box_correo"></div>
</div>
