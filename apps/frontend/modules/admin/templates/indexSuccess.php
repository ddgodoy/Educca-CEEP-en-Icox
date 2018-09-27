<?php use_helper('SexyButton','gWidgets') ?>

<script>
  
  function checkAll(nombre, checkmaster)
  {
  	var inputs = document.getElementsByTagName('input');
  	var checkboxes = [];
  	var cm = document.getElementById(checkmaster);
  	var cmvalue = cm.checked;
  	for (var i = 0; i < inputs.length; i++) 
    {
  	  if ((inputs[i].type == 'checkbox') && (inputs[i].id == nombre))
      {		
    		inputs[i].checked = cmvalue;
  	  }
  	}
  }
</script>

<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Alumnos pendientes por confirmar</h2></div>
  <div class="cont_box_correo">
    <div class="titulos_tabla_general">
        <table style="width: 715px;">
              <tr>
                <th style="width: 30%; text-align: left; padding-left: 3px;">Nombre</th>
                <th style="width: 23%; text-align: left;">Usuario</th>
                <th style="width: 12%; text-align: center;">Fecha Alta</th>
                <th style="width: 10%; text-align: center;">Cursos</th>
                <th style="width: 10%; text-align: center;">M&oacute;dulos</th>
                <th style="width: 15%; text-align: center;">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general_150">
      <table style="width: 715px;" >
      <?php if ($alumnos) :?>
              <?php $i = 0; ?>
                <?php foreach($alumnos as $alumno): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td style="width: 30%; text-align: left; padding-left: 3px;"><?php echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getUsuario()->getId()) ?></td>
                      <td style="width: 23%; text-align: left;"><?php echo $alumno->getUsuario()->getNombreusuario() ?></td>
                      <td style="width: 12%; text-align: center;"><?php echo $alumno->getUsuario()->getCreatedAt($format = 'd/m/Y') ?></td>
                      <td style="width: 10%; text-align: center; font-weight: bold;"><?php echo link_to(count($alumno->getUsuario()->getCursosAlumno()),'admin/listarCursosAlumno?idusuario='.$alumno->getUsuario()->getId()) ?></td>
                      <td style="width: 10%; text-align: center; font-weight: bold;"><?php echo link_to(count($alumno->getUsuario()->getPaquetes()),'admin/listaModulos?idusuario='.$alumno->getUsuario()->getId().'&rol=alumno') ?></td>
                      <td style="width: 15%; text-align: center;">
                        <?php  echo link_to(image_tag('ico_user_enabled.gif', array('alt' => 'Activar a este usuario', 'title' => 'Activar a este usuario')), 'admin/confirmarUsuario?idusuario='.$alumno->getUsuario()->getId().'&rol=alumno','confirm=&iquest;Esta seguro que desea dar de alta al usuario '.$alumno->getUsuario()->getNombre().' '.$alumno->getUsuario()->getApellidos().' ?')?>
                        &nbsp;<?php  echo link_to(image_tag('papelera.gif', array('alt' => 'Eliminar a este usuario', 'title' => 'Eliminar a este usuario')),'admin/eliminarUsuario?idusuario='.$alumno->getUsuario()->getId().'&rol=alumno','confirm=&iquest;Esta seguro que desea eliminar al usuario '.$alumno->getUsuario()->getNombre().' '.$alumno->getUsuario()->getApellidos().' ?') ?></td>
                  </tr>
                  <?php $i++ ?>
                <?php endforeach; ?>
      <?php else : ?>
          <tr><td class="tdnoaviso">
                  <br /><br /><br /><br />
                  <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
                  <span class="txtinfo">No hay alumnos por confirmar</span>
              </td>
          </tr>
      <?php endif; ?>
      </table>
    </div>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('ico_user_enabled.gif','Alt="Activa a un alumno para que tenga acceso a la plataforma en los cursos solicitados" Title="Activa a un alumno para que tenga acceso a la plataforma en los cursos solicitados"'); ?>
          </td>
          <td>
            Activar usuario
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('papelera.gif','Alt="Eliminar usuario" Title="Eliminar usuario"'); ?>
          </td>
          <td>
            Eliminar usuario
          </td>
        </tr>
      </table>
    </div>

  </div>
  <div class="cierre_box_correo"></div>


<div class="separadiv"></div>

<div id="misavisos">
  	<div class="tit_box_mensajes"><h2 class="titbox">Avisos</h2></div>
      <div class="cont_box_correo">

      <div id="container" class="gtab" style="width:100%;">
      	<ul class="gtab-controllers" >
      		<!-- <li><a href="#tab1">Notificaciones</a></li> -->
      		<li><a href="#tab1">Nuevas matr&iacute;culas</a></li>
      		<li><a href="notificaciones/mostrarNotificaciones/#tab2">Notificaciones</a></li>
      	</ul>
        <div id="tab1">&nbsp;</div>
        <div id="tab2">&nbsp;</div>
    	  <?php echo javascript_tag(remote_function(array('update' => 'tab1', 'url' => 'notificaciones/mostrarAlumnosCursosNuevos', 'script' => true)))?>

        </div>

      </div>

      <div class="cierre_box_correo"></div>
  	</div>
</div>
