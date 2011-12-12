<?php use_helper('Mensajes') ?>
  <?php if (isset($idcurso)) : ?>
        <?php $redireccion = "?idcurso=".$idcurso; ?>
   <?php else  : ?>
         <?php $redireccion = "?" ; ?>
   <?php endif; ?>

<?php $nuevos = getMensajesNoLeidos($user);?>
<div class="tit_box_submenu"><h2 class="titbox">Men&uacute; Correo</h2></div>
<ul class="listamenu">
    <li class="redactar"><?php echo link_to('Redactar un mensaje', 'mensaje/redactarMensaje'.$redireccion,array('name' => 'ln_redactar')) ?></li>
    <li class="recibidos"><?php echo link_to("Mensajes recibidos ($nuevos)", 'mensaje/mensajesRecibidos'.$redireccion,array('name' => 'ln_recibidos')) ?></li>
    <li class="enviados"><?php echo link_to('Mensajes enviados', 'mensaje/mensajesEnviados'.$redireccion,array('name' => 'ln_enviados')) ?></li>
    <li class="papelera"><?php echo link_to('Papelera', 'mensaje/mensajesPapelera'.$redireccion,array('name' => 'ln_papelera')) ?></li>
</ul>

