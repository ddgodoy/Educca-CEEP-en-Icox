<style type="text/css">
	.divMensajeFlash {
		margin-bottom: 10px; width: 730px; text-align: center;
		font-size: 12px; color: #006600; font-weight: bold;
	}
</style>  
<?php if (isset($superUsuario)): ?>
        <?php $redireccion = "&superUsuario=1"; ?>
   <?php else: ?>
         <?php $redireccion = ''; ?>
   <?php endif; ?>

<?php use_helper('informacion'); ?>
<?php use_helper('SexyButton') ?>
<?php use_helper('Text'); ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Usuarios de la plataforma</h2></div>
  <div class="cont_box_correo">
  	<?php if ($sf_params->has('tm')): ?>
  		<div class="divMensajeFlash">El Supervisor Tripartita fue <?php echo $sf_params->get('tm')=='crear' ? 'creado' : 'actualizado' ?> exitosamente!</div>
  	<?php endif; ?>
    <div class="herramientas_general_fixed">
        <table cellpadding="0" cellspacing="0">
        <tr>
           <td>
             <?php if (isset($superUsuario)): ?>
               <?php echo sexy_button_to('Buscar','admin/buscar?rol=superusuario') ?>
             <?php else:?>
               <?php echo sexy_button_to('Buscar','admin/buscar?rol=usuario') ?>
             <?php endif;?>
           </td>
           <?php if (isset($superUsuario)): ?>
             <td style="padding-left: 11px;"><?php echo sexy_button_to('Nuevo Administrador','admin/nuevoUsuario?rol=administrador') ?></td>
             <td style="padding-left: 11px;"><?php echo sexy_button_to('Nuevo Supervisor','admin/nuevoUsuario?rol=supervisor') ?></td>
             <td style="padding-left: 11px;"><?php echo sexy_button_to('Supervisor Tripartita', 'tripartita/index') ?></td>
           <?php endif; ?>
            <?php if ($busqueda): ?>
              <?php if (isset($superUsuario)): ?>
                <td style="padding-left: 11px;"><?php echo sexy_button_to('Ver todos los superusuarios', 'admin/usuarios?superUsuario=1') ?></td>
              <?php else:?>
                <td style="padding-left: 11px;"><?php echo sexy_button_to('Ver todos los usuarios', 'admin/usuarios') ?></td>
              <?php endif; ?>
            <?php endif; ?>
        </tr>
        </table>
    </div>
    <div class="titulos_tabla_general">
        <table class="listado_usuarios_admin">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Usuario</th>
                <th class="td3">Fecha Alta</th>
                <th class="td4">Credenciales</th>
                <th class="td5">Cursos</th>
                <th class="td6">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general_largo">
        <table class="listado_usuarios_admin">
              <?php $i = 0; ?>
              <?php $max_length = 38; ?>
              <?php foreach($usuarios as $usuario): ?>
                  <?php $roles = $usuario->roles(); ?>
                  <?php if ($roles['moroso']) {continue;}?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1" >
                        <?php
                          $nombre = $usuario->getNombre();
                          $length_nombre = strlen($nombre);
                          if (($length_nombre + 2) < $max_length)
                          {
                            $pendientes = $max_length - $length_nombre - 2;
                            $apellidos = truncate_text($usuario->getApellidos(), $pendientes);
                            $nombre_final = $apellidos.', '.$nombre;
                          }
                          else
                          {
                            $nombre_final = truncate_text($nombre, $max_length);
                          }
                        ?>

                      <?php echo link_to($nombre_final, 'usuario/mostrarPerfil?idusuario='.$usuario->getId()) ?>

                      </td>
                      <td class="td2" style="padding-left: 6px;"><?php echo $usuario->getNombreusuario() ?></td>
                      <td class="td3"><?php echo $usuario->getCreatedAt($format = 'd/m/Y') ?></td>


                      <td class="td4" style="text-align: center;">
                        <table>
                          <tr>
                            <td style="width: 38px; text-align:center;">
                              <?php if ($roles['administrador']) :?>
                                <?php echo image_tag('icouser_admin.gif','Alt=Administrador Title=Administrador'); ?>
                              <?php else:?>
                                &nbsp;
                              <?php endif; ?>
                            </td>
                            <td style="width: 38px; text-align:center; border-left: solid #F2F2F2 1px; border-right: solid #F2F2F2 1px;">
                              <?php if ($roles['supervisor']) :?>
                                <?php echo image_tag('icouser_supervisor.gif','Alt=Supervisor Title=Supervisor'); ?>
                              <?php else:?>
                                &nbsp;
                              <?php endif; ?>
                            </td>
                            <td style="width: 38px; text-align:center; border-right: solid #F2F2F2 1px;">
                              <?php if ($roles['profesor']) :?>
                                <?php echo image_tag('icouser_profesor.gif','Alt=Profesor Title=Profesor'); ?>
                              <?php else:?>
                                &nbsp;
                              <?php endif; ?>
                            </td>
                            <td style="width: 38px; text-align:center;">
                              <?php if ($roles['alumno']) :?>
                                <?php echo image_tag('icouser_student.gif','Alt=Alumno Title=Alumno'); ?>
                              <?php else:?>
                                &nbsp;
                              <?php endif; ?>
                            </td>
                          </tr>
                        </table>
                      </td>

                      <td class="td5">
                        <?php if ( (!$roles['supervisor']) && (!$roles['administrador']) ):?>
                          <?php echo link_to(image_tag('add_icon.gif','Alt="Matricular en nuevo curso" Title="Matricular en nuevo curso" align=absmiddle'),'admin/matricular?idusuario='.$usuario->getId()) ?>
                        <?php endif; ?>
                      </td>
                      <td class="td6">
                        <?php if (($usuario->getNombreusuario() == 'admin') || ($usuario->getNombreusuario() == 'supervisor')): ?>
                          &nbsp;
                        <?php else:?>
                          <?php echo link_to(image_tag('papelera.gif','Alt="Eliminar usuario" Title="Eliminar usuario" align=absmiddle'),'admin/eliminarUsuario?idusuario='.$usuario->getId().$redireccion,array('confirm'=>'&iquest;Esta seguro que desea eliminar al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' ?',
                                                                                                                                                                                                                 'id'=>'ln_eliminar_usuario'.$usuario->getId())) ?>
                        <?php endif;?>
                      </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
          <?php if ($busqueda):?>
            <?php echoAvisoVacio("No hay ning&uacute;n usuario que coincida con los par&aacute;metros de b&uacute;squeda");?>
          <?php else:?>
            <?php echoAvisoVacio("No hay ning&uacute;n usuario registrado en la plataforma");?>
          <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> usuario(s)
      </div>
    <?php endif;?>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('icouser_admin.gif','Alt=Administrador Title=Administrador'); ?>
          </td>
          <td>
            &nbsp;Administrador
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('icouser_supervisor.gif','Alt=Supervisor Title=Supervisor'); ?>
          </td>
          <td>
            &nbsp;Supervisor
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('icouser_profesor.gif','Alt=Profesor Title=Profesor'); ?>
          </td>
          <td>
            &nbsp;Profesor
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('icouser_student.gif','Alt=Alumno Title=Alumno'); ?>
          </td>
          <td>
            &nbsp;Alumno
          </td>
        </tr>
      </table>
    </div>
    <br>
      <?php if  (isset($superUsuario))  : ?>
        <?php echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los administradores y supervisores de la plataforma, y podr&aacute; dar de alta y baja a estos."); ?>
   <?php else  : ?>
         <?php echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los usuarios de la plataforma, pudiendo dar de alta en nuevos cursos o eliminarlos."); ?>
   <?php endif; ?>

<br><?php use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
