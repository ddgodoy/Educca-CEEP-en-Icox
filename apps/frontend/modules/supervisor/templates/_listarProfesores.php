<?php use_helper('SexyButton') ?>
<?php use_helper('informacion') ?>

<div id="divadmin">
<div id="mensajes_recibidos">

  <div class="tit_box_mensajes"><h2 class="titbox">
    <?php if (isset($curso)):?>
      Profesores del Curso: <?echo $curso->getNombre()?>
    <?php else:?>
      Profesores de la plataforma
    <?php endif;?>
  </h2></div>
  <div class="cont_box_correo">

  <?php if($opciones):?>
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <?php if ($busqueda):?>
              <?php if (isset($curso)):?>
                <?php echo sexy_button_to('Nueva b&uacute;squeda en el mismo curso', 'supervisor/buscar?rol=profesor&idcurso='.$curso->getId()) ?>
              <?php else:?>
                <?php echo sexy_button_to('Nueva b&uacute;squeda', 'supervisor/buscar?rol=profesor') ?>
              <?php endif;?>
            <?php else:?>
              <?php if (isset($curso)):?>
                <?php echo sexy_button_to('Buscar profesores de este curso', 'supervisor/buscar?rol=profesor&idcurso='.$curso->getId()) ?>
              <?php else:?>
                <?php echo sexy_button_to('Buscar profesores', 'supervisor/buscar?rol=profesor') ?>
              <?php endif;?>
            <?php endif;?>
          </td>
        </tr>
      </table>
    </div>
  <?php endif;?>

     <div class="titulos_tabla_general">
        <table class="tnombrelistaprofes">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Nombre de usuario</th>
                <th class="td3" style="text-align: center;">Opciones</th>
              </tr>
        </table>
    </div>

    <div class="listado_tabla_general_fixed">
        <table class="tnombrelistaprofes">
                  <?php $i = 0; ?>
                  <?php foreach($profesores as $profesor): ?>
                      <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                      <tr class="cont_fil" <?= $fondo1 ?>>
                          <td class="td1"><?php echo link_to($profesor->getApellidos().", ".$profesor->getNombre(), 'usuario/mostrarPerfil?idusuario='.$profesor->getId(),array('id'=>'ln_usuario'.$profesor->getId())) ?></td>
                          <td class="td2"><?php echo $profesor->getNombreusuario() ?></td>
                          <td class="td3" style="text-align: center;">
                            <?php if (isset($curso)):?>
                              <?php echo link_to(image_tag('ico_mensajes_peq.gif',"Alt=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getNombre()." en el curso ".$curso->getNombre()."\" Title=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getNombre()." en el curso ".$curso->getNombre()."\" align=absmiddle"),'seguimiento/grafica?tipo=mensajes&idusuario='.$profesor->getId().'&idcurso='.$curso->getId(),array('id'=>'ln_mensajes_profesor'.$profesor->getId().'_curso'.$curso->getId())); ?>
                            <?php else:?>
                              <?php echo link_to(image_tag('ico_cursos_peq.gif',"Alt=\"Ver cursos impartidos por ".$profesor->getNombre()."\" Title=\"Ver cursos impartidos por ".$profesor->getNombre()."\" align=absmiddle"),'supervisor/listarCursosProfesor?id='.$profesor->getId(),array('id'=>'ln_cursos_profesor'.$profesor->getId())); ?>
                              &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_mensajes_peq.gif',"Alt=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getNombre()."\" Title=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getNombre()."\" align=absmiddle"),'seguimiento/grafica?tipo=mensajes&idusuario='.$profesor->getId(),array('id'=>'ln_mensajes_profesor'.$profesor->getId())); ?>
                            <?php endif;?>
                          </td>
                      </tr>
                      <?php $i++ ?>
                  <?php endforeach; ?>
         </table>
         <?php if (!$i):?>
           <?php if (isset($curso)) : ?>
              <?php echoAvisoVacioCorto('No hay profesores asignados a este curso');?>
           <?php else :?>
              <?php echoAvisoVacioCorto('No hay profesores registrados en la plataforma');?>
           <?php endif; ?>

         <?php endif;?>
     </div>
     <?php if ($i):?>
       <div class="totales_tabla">
         Total: &nbsp;<?php echo $i; ?> profesor(es)
       </div>
     <?php endif;?>
     <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('ico_cursos_peq.gif',"Alt=\"Ver cursos impartidos por el profesor\" Title=\"Ver cursos impartidos por el profesor\" align=absmiddle"); ?>
          </td>
          <td>
            Cursos impartidos por el profesor
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_mensajes_peq.gif','Alt="Estad&iacute;sticas de mensajes" Title="Estad&iacute;sticas de mensajes"'); ?>
          </td>
          <td>
            Estad&iacute;sticas de mensajes
          </td>
        </tr>
      </table>
    </div>


   <br>

   <?php if (isset($curso)) : ?>
      <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n de los profesores del '.$curso->getNombre())?>
   <?php else :?>
      <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n de los profesores')?>
   <?php endif; ?>


  </div>
  <div class="cierre_box_correo"></div>
</div>
</div>
