<?php use_helper('Javascript') ?>
<?php use_helper('Text') ?>
<?php use_helper('SexyButton') ?>
<?php if (isset($idcurso)) : ?>
        <?php $redireccion = "?idcurso=".$idcurso;      ?>
<?php else  : ?>
         <?php $redireccion = "?" ; ?>
<?php endif; ?>

<div id="divplanificacion">
  <div class="tit_box_mensajes"><h2 class="titbox">Listado de Alumnos</h2></div>
  <div class="cont_box_correo">
      <div class="herramientas_general_fixed">
        <?php echo sexy_button_to('Buscar','seguimiento/buscar'.$redireccion) ?>
      </div>
      <div class="titulos_tabla_general">
        <table class="tablamensajes">
          <tr>
            <th class="td1">Nombre</th>
            <th class="td2">Dni</th>
            <th class="td3">Email</th>
            <th class="td4">Tel. fijo</th>
            <th class="td5">M&oacute;vil</th>
            <th class="td6">Opciones</th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general">
        <table class="tablamensajes">
          <?php $i = 0; ?>
          <?php foreach($alumnos as $alumno) : ?>
            <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
            <tr <?php echo $fondo ?>>
              <td class="td1"><?php echo $alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() ?></td>
              <td class="td2"><?php echo $alumno->getUsuario()->getDni() ?></td>
              <td class="td3"><?php echo $alumno->getUsuario()->getEmail() ?></td>
              <td class="td4"><?php echo $alumno->getUsuario()->getTelefono1() ?></td>
              <td class="td5"><?php echo $alumno->getUsuario()->getTelefono2() ?></td>
              <td class="td6"><?php echo link_to(image_tag('nuevoevento.gif','Title=Nuevo evento'), 'calendario/nuevoEvento'.$redireccion."&idalumno=".$alumno->getUsuario()->getId()."&popUp=1",array(
        														'popup' => array('', 'width=510,height=560,left=320,top=0'))) ?>
                              <?php echo link_to(image_tag('sendmail.gif','Title=Enviar mensaje'), 'mensaje/redactarMensaje') ?>
                              <?php echo link_to(image_tag('nuevatarea.gif','Title=Asignar ejercicio'), 'tareas/tareasExamenes') ?>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
          <?php use_helper('informacion') ?>
          <?php if (isset($search)):?>
            <?php echoAvisoVacio("No se encontraron alumnos que encajen con los criterios de b&uacute;squeda");?>
          <?php else: ?>
            <?php echoAvisoVacio("No hay ning&uacute;n alumno en el curso");?>
          <?php endif;?>
          
        <?php endif; ?>
      </div>
      <div class="leyendaseg">
	        <table class="tablacursos">
	            <tr class="cont_fil">
	                <td>
						<?php echo image_tag('nuevoevento.gif','Title=Nuevo evento'); ?> Asignar un evento.
					 	<?php echo image_tag('sendmail.gif','Title=Enviar mensaje'); ?> Enviar mensaje.
						<?php echo image_tag('nuevatarea.gif','Title=Asignar ejercicio'); ?> Asignar un ejercicio.
					</td>
	            </tr>
	        </table>
	    </div>
    </form>
    <br><? use_helper('volver'); echo volver(); ?>
 </div>
 <div class="cierre_box_correo"></div>
</div>
