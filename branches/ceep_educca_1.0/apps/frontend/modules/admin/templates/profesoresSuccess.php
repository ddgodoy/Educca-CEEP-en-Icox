<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>
<?php use_helper('informacion'); ?>

<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">
  <?php if ($curso):?>
    Profesores del curso <?php echo $curso->getNombre(); ?>
  <?php else:?>
    Profesores de la plataforma
  <?php endif;?>
  </h2></div>
  <div class="cont_box_correo">
    <div class="herramientas_general_fixed">
        <table cellpadding="0" cellspacing="0">
        <tr>
		      <td style="width:125px;"><?php echo sexy_button_to('Nuevo profesor','admin/nuevoUsuario?rol=profesor') ?></td>
            <?php if ($busqueda):?>
              <td style="width:135px;">
                <?php echo sexy_button_to('Nueva b&uacute;squeda', 'admin/buscar?rol=profesor') ?>
              </td>
              <td>
                <?php echo sexy_button_to('Ver todos los profesores', 'admin/profesores') ?>
              </td>
            <?php else:?>
              <td>
                <?php echo sexy_button_to('Buscar', 'admin/buscar?rol=profesor') ?>
              </td>
            <?php endif; ?>
        </tr>
        </table>
    </div>
    <div class="titulos_tabla_general">
        <table class="tadminprofesores">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Nombre de usuario</th>
                <th class="td3">Fecha Alta</th>
                <th class="td4">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general_fixed">
        <table class="tadminprofesores" >
              <?php $max_length = 43; ?>
              <?php $i = 0; ?>
              <?php foreach($profesores as $profesor): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1" style="padding-left: 5px;">
                        <?php
                          $nombre = $profesor->getNombre();
                          $nombre_normal = $nombre.' '.$profesor->getApellidos();
                          $length_nombre = strlen($nombre);
                          if (($length_nombre + 2) < $max_length)
                          {
                            $pendientes = $max_length - $length_nombre - 2;
                            $apellidos = truncate_text($profesor->getApellidos(), $pendientes);
                            $nombre_final = $apellidos.', '.$nombre;
                          }
                          else
                          {
                            $nombre_final = truncate_text($nombre, $max_length);
                          }
                        ?>
                        <?php echo link_to($nombre_final, 'usuario/mostrarPerfil?idusuario='.$profesor->getId()) ?>
                      </td>
                      <td class="td2"><?php echo $profesor->getNombreusuario() ?></td>
                      <td class="td3"><?php echo $profesor->getCreatedAt($format = 'd/m/Y') ?></td>
                      <td class="td4">
                        <?php echo link_to(image_tag('ico_cursos_peq.gif', array('alt' => 'Ver los cursos impartidos por '.$nombre_normal, 'title' => 'Ver los cursos impartidos por '.$nombre_normal, 'align' => 'absmiddle')), 'admin/listarCursosProfesor?id='.$profesor->getId()); ?>
                        &nbsp;&nbsp;<?php echo link_to(image_tag('papelera.gif', array('alt' => 'Eliminar usuario', 'title' => 'Eliminar usuario', 'align' => 'absmiddle')),'admin/eliminarUsuario?idusuario='.$profesor->getId().'&rol=profesor',array('id'=>'ln_eliminar_profesor'.$profesor->getId(),'confirm'=>'&iquest;Esta seguro que desea eliminar al usuario '.$profesor->getNombre().' '.$profesor->getApellidos().' ?')) ?>
                      </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>

        <?php if (!$i):?>
          <?php if ($busqueda):?>
            <?php echoAvisoVacio("No hay ning&uacute;n profesor que coincida con los par&aacute;metros de b&uacute;squeda");?>
          <?php else:?>
            <?php echoAvisoVacio("No hay ning&uacute;n profesor registrado en la plataforma. Para a&ntilde;adir nuevos profesores debe hacerlo desde la opci&oacute;n \"Usuarios\".");?>
          <?php endif; ?>
        <?php endif; ?>
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
            <?php echo image_tag('ico_cursos_peq.gif','Alt=Cursos impartidos por el profesor Title=Cursos impartidos por el profesor'); ?>
          </td>
          <td>
            Cursos impartidos por el profesor
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
    <?php echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los profesores de la plataforma (cursos que imparten) y podr&aacute; dar de alta a nuevos profesores y dar de baja a los ya existentes."); ?>
    <br><?php use_helper('volver'); echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
