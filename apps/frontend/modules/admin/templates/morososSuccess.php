<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>
<?php use_helper('informacion'); ?>

<div class="capa_principal" id="admin">
  <div class="tit_box_mensajes"><h2 class="titbox">Alumnos con pagos pendientes de la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="herramientas_general_fixed">
        <table cellpadding="0" cellspacing="0">
        <tr>
            <?php if ($busqueda):?>
              <td style="width:135px;">
                <?php echo sexy_button_to('Nueva b&uacute;squeda', 'admin/buscar?rol=moroso') ?>
              </td>
              <td>
                <?php echo sexy_button_to('Ver todos los alumnos con pagos pendientes', 'admin/morosos') ?>
              </td>
            <?php else:?>
              <td>
                <?php echo sexy_button_to('Buscar', 'admin/buscar?rol=moroso') ?>
              </td>   
            <?php endif; ?>
        </tr>
        </table>
    </div>
    <div class="titulos_tabla_general">
        <table class="lista_alumnos_admin">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Nombre de usuario</th>
                <th class="td3">Fecha Alta</th>
                <th class="td4">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general">
        <table class="lista_alumnos_admin" >
              <?php $i = 0; ?>
              <?php $max_length = 43; ?>
              <?php foreach($alumnos as $alumno): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1">
                        <?php 
                          $nombre = $alumno->getNombre();
                          $nombre_normal = $nombre.' '.$alumno->getApellidos();
                          $length_nombre = strlen($nombre);
                          if (($length_nombre + 2) < $max_length)
                          {
                            $pendientes = $max_length - $length_nombre - 2;
                            $apellidos = truncate_text($alumno->getApellidos(), $pendientes);
                            $nombre_final = $apellidos.', '.$nombre;
                          }
                          else
                          {
                            $nombre_final = truncate_text($nombre, $max_length);
                          }
                        ?>
                        <?php echo link_to($nombre_final, 'usuario/mostrarPerfil?idusuario='.$alumno->getId(), array('class' => 'a_explicito')) ?>
                      </td>
                      <td class="td2"><?php echo $alumno->getNombreusuario() ?></td>
                      <td class="td3"><?php echo $alumno->getCreatedAt($format = 'd/m/Y') ?></td>
                      <td class="td4">
                        <?php echo link_to(image_tag('ico_cursos_peq.gif', array('alt' => 'Ver los cursos de '.$nombre_normal, 'title' => 'Ver los cursos de '.$nombre_normal, 'align' => 'absmiddle')), 'admin/listarCursosAlumno?idusuario='.$alumno->getId(), array('class' => 'a_explicito')) ?>
                         &nbsp; <?php echo link_to(image_tag('ico_modulos_peq.gif', array('alt' => 'Ver los m&oacute;dulos de '.$nombre_normal, 'title' => 'Ver los m&oacute;dulos de '.$nombre_normal, 'align' => 'absmiddle')), 'admin/listaModulos?idusuario='.$alumno->getId().'&rol=alumno', array('class' => 'a_explicito')) ?>
                         &nbsp; <?php echo link_to(image_tag('papelera.gif','Alt=Eliminar Title=Eliminar align=absmiddle'),'admin/eliminarUsuario?idusuario='.$alumno->getId().'&rol=alumno','confirm=&iquest;Esta seguro que desea eliminar al usuario '.$alumno->getNombre().' '.$alumno->getApellidos().' ?') ?>
                      </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
          <?php if ($busqueda):?>
            <?php echoAvisoVacio("No hay ning&uacute;n alumno que coincida con los par&aacute;metros de b&uacute;squeda");?>
          <?php else:?>
            <?php echoAvisoVacio("No hay ning&uacute;n alumno con pagos pendientes en la plataforma");?>
          <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> moroso(s)
      </div>
    <?php endif;?>
      <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('ico_cursos_peq.gif','Alt=Cursos del alumno Title=Cursos del alumno'); ?>
          </td>
          <td>
            Cursos de un alumno
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_modulos_peq.gif','Alt=M&oacute;dulos del alumno Title=M&oacute;dulos del alumno'); ?>
          </td>
          <td>
            &nbsp;M&oacute;dulos de un alumno
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('papelera.gif','Alt=Eliminar usuario Title=Eliminar usuario'); ?>
          </td>
          <td>
            Eliminar usuario
          </td>
        </tr>
      </table>
    </div>
    <br>
    <?php use_helper('informacion'); ?>
    <? echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los alumnos con pagos pendientes o \"morosos\" de la plataforma (cursos, m&oacute;dulos matriculados) y podr&aacute; dar de alta a nuevos alumnos y dar de baja a los ya existentes."); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
