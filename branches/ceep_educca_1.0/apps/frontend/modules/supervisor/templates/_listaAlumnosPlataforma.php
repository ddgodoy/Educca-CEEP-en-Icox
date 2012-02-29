<?php use_helper('SexyButton') ?>
<?php use_helper('informacion') ?>
<div id="divadmin">
<div id="mensajes_recibidos">

  <div class="tit_box_mensajes"><h2 class="titbox">
    Alumnos de la plataforma
  </h2></div>
  <div class="cont_box_correo">

  <?php if($opciones):?>
    <div class="herramientas_general_fixed">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <?php if ($busqueda):?>
              <?php echo sexy_button_to('Nueva b&uacute;squeda', 'supervisor/buscar?rol=alumno') ?>
            <?php else:?>
              <?php echo sexy_button_to('Buscar alumnos', 'supervisor/buscar?rol=alumno') ?>
            <?php endif;?>
          </td>
        </tr>
      </table>
    </div>
  <?php endif;?>

     <div class="titulos_tabla_general">
        <table class="tnombrelistaprofes" style="width: 715px;">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Nombre de usuario</th>
                <th class="td3" style="text-align: center;">Opciones</th>
              </tr>
        </table>
    </div>

    <div class="listado_tabla_general_fixed">
        <table class="tnombrelistaprofes" style="width: 715px;">
                  <?php $i = 0; ?>
                  <?php foreach($alumnos as $alumno): ?>
                      <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                      <tr class="cont_fil" <?= $fondo1 ?>>
                          <td class="td1"><?php echo link_to($alumno->getApellidos().", ".$alumno->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getId(),array('id'=>'ln_usuario'.$alumno->getId())) ?></td>
                          <td class="td2"><?php echo $alumno->getNombreusuario() ?></td>
                          <td class="td3" style="text-align: center;">
                            <?php echo link_to(image_tag('ico_cursos_peq.gif',"Alt=\"Ver cursos del alumno ".$alumno->getNombre()."\" Title=\"Ver cursos del alumno ".$alumno->getNombre()."\" align=absmiddle"), 'supervisor/listarCursosAlumno?idusuario='.$alumno->getId(),array('id'=>'ln_cursos_usuario'.$alumno->getId().'')); ?>
                            &nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('ico_modulos_peq.gif', array('alt' => 'Ver los m&oacute;dulos de '.$alumno->getNombre(), 'title' => 'Ver los m&oacute;dulos de '.$alumno->getNombre(), 'align' => 'absmiddle')), 'supervisor/listaModulos?idusuario='.$alumno->getId().'&rol=alumno', array('class' => 'a_explicito','id'=>'ln_usuario'.$alumno->getId().'_modulos')) ?>
                          </td>
                      </tr>
                      <?php $i++ ?>
                  <?php endforeach; ?>
         </table>
         <?php if (!$i):?>
           <?php echoAvisoVacio('No hay alumnos registrados en la plataforma');?>
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
            <?php echo image_tag('ico_cursos_peq.gif',"Alt=\"Ver cursos a los que atiende el alumno\" Title=\"Ver cursos a los que atiende el alumno\" align=absmiddle"); ?>
          </td>
          <td>
            Cursos a los que atiende el alumno
          </td>
          <td style="padding-left: 15px;">
            <?php echo image_tag('ico_modulos_peq.gif',"Alt=\"M&oacute;dulos del alumno\" Title=\"M&oacute;dulos del alumno\" align=absmiddle"); ?>
          </td>
          <td>
            M&oacute;dulos del alumno
          </td>
        </tr>
      </table>
    </div>


   <br>
  <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n de los alumnos, y observar sus progresos')?>

    <br><?php use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
</div>
