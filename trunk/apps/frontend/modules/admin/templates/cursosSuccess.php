<?php use_helper('SexyButton') ?>
<?php use_helper('informacion'); ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Cursos instalados en la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr><td>
        <?php echo sexy_button_to('Nuevo curso','admin/nuevoCurso') ?>
        </td></tr>
       </table>
    </div>
    <div class="nombrescol" style="width: 100%;">
        <table class="tadmincursos" border='0'>
              <tr>
                <th class="td7">Nombre</th>
                <th class="td3">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td10">Materia</th>
                <!--td class="td5">Modulo</td-->
                <th class="td12">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos">
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>
                <?php $nombrecurso = $curso->getNombre(38); ?>
                <?php if ($nombrecurso != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td7"><?php echo link_to($nombrecurso, 'admin/fichaCurso?idcurso='.$curso->getId(),"title=". $curso->getNombre()) ?></td>
                      <td class="td3"><?php echo $curso->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td10"><?php echo $curso->getMateria()->getNombre() ?></td>
                      <td class="td12">
                      <?php echo link_to(image_tag('icon_edit.gif','Alt="Editar/modificar curso" Title="Editar/modificar curso" align="absmiddle"'),'admin/modificarCurso?idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('ico_alumnos_peq.gif',"Alt=\"Ver alumnos del curso $nombrecurso\" Title=\"Ver alumnos del curso $nombrecurso\" align=absmiddle"), 'admin/alumnos?idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('ico_profesores_peq.gif',"Alt=\"Ver profesores del curso $nombrecurso\" Title=\"Ver profesores del curso $nombrecurso\" align=absmiddle"), 'admin/profesores?idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('icono_foto.gif','Alt="A&ntilde;adir imagen al curso" Title="A&ntilde;adir imagen al curso" align=absmiddle'),'admin/imagenCurso?idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('papelera.gif','Alt="Eliminar curso" Title="Eliminar curso" align=absmiddle'),'admin/eliminarCurso?idcurso='.$curso->getId(),array('id'=>'eliminar_curso'.$curso->getId(),'confirm'=>'&iquest;Esta seguro que desea eliminar el '.$curso->getNombre().' ?')) ?>
                      </td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>
              <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
          <?php echoAvisoVacio('No hay cursos instalados en la plataforma');?>
        <?php endif;?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> curso(s)
      </div>
    <?php endif;?>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('icon_edit.gif','Alt="Editar/modificar curso" Title="Editar/modificar curso"'); ?>
          </td>
          <td>
            Editar/modificar curso
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_alumnos_peq.gif','Alt=Ver alumnos del curso Title=Ver alumnos del curso'); ?>
          </td>
          <td>
            Alumnos del curso
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_profesores_peq.gif','Alt=Ver profesores del curso Title=Ver profesores del curso'); ?>
          </td>
          <td>
            Profesores del curso
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('icono_foto.gif','Alt="A&ntilde;adir imagen al curso" Title="A&ntilde;adir imagen al curso"'); ?>
          </td>
          <td>
            &nbsp;A&ntilde;adir imagen al curso
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('papelera.gif','Alt="Eliminar curso" Title="Eliminar curso"'); ?>
          </td>
          <td>
            Eliminar curso
          </td>
        </tr>
      </table>
    </div>
    <br>

    <? echoNotaInformativa('Ayuda', "Este panel muestra informaci&oacute;n de los cursos instalados en la plataforma, adem&aacute;s de permitir modificar, borrar o subir una imagen representativa de los mismos."); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
