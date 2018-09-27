<?php use_helper('SexyButton') ?>
<?php use_helper('informacion') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Lista de modulos para el <?echo $rol." ".$usuario->getNombre()." ".$usuario->getApellidos()?> </h2></div>
  <div class="cont_box_correo" id="admin">
    <div class="herramientas_general_fixed">
       <table cellpadding="0" cellspacing="0">
         <tr>
           <td><?php echo sexy_button_to('Matricular en nuevos m&oacute;dulos', 'admin/aniadirModulo?idusuario='.$usuario->getId().'&rol='.$rol) ?></td>
           <td style="padding-left: 15px;"><?php echo sexy_button_to('Ver los cursos del alumno', 'admin/listarCursosAlumno?idusuario='.$usuario->getId()) ?></td>
         </tr>
       </table>
    </div>

    <div class="titulos_tabla_general">
        <table class="tadmin_modulos_alumno">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Numero Cursos</th>
                <th class="td5">Estado</th>
                <th class="td6">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general">
        <table class="tadmin_modulos_alumno">
        <?php $i = 0; ?>
          <?php foreach($modulos as $modulo): ?>

              <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
              <tr class="cont_fil" <?= $fondo1 ?>>
                  <td class="td1"><?php echo link_to($modulo->getPaquete()->getNombre(), 'admin/fichaModulo?idmodulo='.$modulo->getPaquete()->getId()) ?></td>
                  <td class="td2"><?php echo $modulo->getPaquete()->getFechaInicio($format = 'd/m/Y') ?></td>
                  <td class="td3"><?php echo $modulo->getPaquete()->getFechaFin($format = 'd/m/Y') ?></td>
                  <td class="td4"><?php echo $modulo->getPaquete()->countRel_paquete_cursos()?></td>
                  <td class="td5">
                    <?php if ($modulo->getPaquete()->esMoroso($usuario->getId())) : ?>
                      <strong>MOROSO</strong>
                    <?php else : ?>
                      ACTIVO
                    <?php endif; ?>
                  </td>
			            <td class="td6">
			             <?php if ($modulo->getPaquete()->esMoroso($usuario->getId())) : ?>
                      <?php echo link_to(image_tag('ico_user_enabled.gif', array('alt' => 'Reanudar a este alumno en el m&oacute;dulo', 'title' => 'Reanudar a este alumno en el m&oacute;dulo')),'admin/morosoModulo?idusuario='.$usuario->getId().'&idmodulo='.$modulo->getPaquete()->getId().'&moroso=no','confirm=&iquest;Esta seguro que desea reanudar al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en '.$modulo->getPaquete()->getNombre().' ?') ?>
                    <?php else : ?>
                      <?php echo link_to(image_tag('ico_user_disabled.gif', array('alt' => 'Suspender a este alumno en el m&oacute;dulo', 'title' => 'Suspender a este alumno en el m&oacute;dulo')),'admin/morosoModulo?idusuario='.$usuario->getId().'&idmodulo='.$modulo->getPaquete()->getId().'&moroso=si','confirm=&iquest;Esta seguro que desea marcar como moroso al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en '.$modulo->getPaquete()->getNombre().' ?') ?>
                    <?php endif; ?>
                   | 
                  <?php echo link_to(image_tag('papelera.gif', array('alt' => 'Quitar este m&oacute;dulo a este alumno', 'title' => 'Quitar este m&oacute;dulo a este alumno')),'admin/eliminarModuloUsuario?idusuario='.$usuario->getId().'&idmodulo='.$modulo->getPaquete()->getId().'&rol='.$rol,'confirm=&iquest;Esta seguro que desea quitar el m&oacute;dulo '.$modulo->getPaquete()->getNombre().' al alumno '.$usuario->getNombre().' '.$usuario->getApellidos().'?'); ?>
			            </td>
                </tr>
              <?php $i++ ?>
          <?php endforeach; ?>
        </table>
        <?php if (!$i): ?>
          <?php echoAvisoVacio('El alumno no est&aacute; matriculado en ning&uacute;n m&oacute;dulo'); ?>
        <?php endif;?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> m&oacute;dulo(s)
      </div>
    <?php endif;?>
    <br>
    <?php use_helper('informacion'); ?>
    <?php echoNotaInformativa('', image_tag('papelera.gif')." Sirve para <b>borrar</b> a un alumno de un m&oacute;dulo. El alumno ya no podr&aacute; acceder a ninguno de los cursos del m&oacute;dulo y toda la informaci&oacute;n relativa a ese alumno en esos cursos se elimina tambi&eacute;n.
                                   <br><br>".image_tag('ico_user_disabled.gif')." Marca al alumno como <b>moroso</b> en el m&oacute;dulo correspondiente. Esta operaci&oacute;n se realiza cuando el alumno no ha realizado sus pagos. Mientras el alumno aparezca como <b>moroso</b> en un m&oacute;dulo no tendr&aacute; acceso a los cursos que lo componen.
                                   <br><br>".image_tag('ico_user_enabled.gif')." Marca al alumno como <b>activo</b> en el m&oacute;dulo correspondiente. Esta operaci&oacute;n se realiza cuando el alumno estaba marcado como moroso y se ha recibido su pago del m&oacute;dulo. Un alumno <b>activo</b> tiene pleno acceso a los cursos del m&oacute;dulo."); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
