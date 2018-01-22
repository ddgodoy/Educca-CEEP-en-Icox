<?php if ( ($sf_user->hasCredential('alumno')) || ($sf_user->hasCredential('profesor'))) : ?>
  <?php echo use_helper('Javascript') ?>
  	<?php echo periodically_call_remote(array(
      'frequency' => 5,  //si se cambia este tiempo hay qcambiar curso.php y paquete.php la funcion getUsuarioOnline
      'update'    => 'd_u_conectados', // online/menu
      'url'       => 'online/actualizaTiempo',
  )) ?>
  <div id="usuarioConectado"></div>
<?php endif; ?>