  <?php echo use_helper('Javascript') ?>
  	<?php echo periodically_call_remote(array(
      'frequency' => 45,
      'update'    => 'usuarios_conectados_popup',
      'url'       => 'online/conectados',
  )) ?>



<div id='usuarios_conectados_popup'>

  <div class="tit_box_menu"><h2 class="titbox">Usuarios conectados:</h2></div>
    <ul class="listamenu">
        <?php foreach ($onlines as $users_online) :?>

          <?php foreach ($users_online as $usuario) :?>
            <li class="infopersonal">
                  <?php if ('profesor' == $usuario->getRol()->getNombre() ) : ?>
                     <div style='text-align:left;padding:5px;padding-left:40px;color:red'>
                  <?php else : ?>
                     <div style='text-align:left;padding:5px;padding-left:40px;'>
                  <?php endif; ?>
                     <?php echo $usuario->getUsuario()->getNombreusuario()?>  
                </div>
            </li>
          <?php endforeach;?>
        <?php endforeach;?>
        <li class='conectados_c'>
          <div style='text-align:left;padding:5px;padding-left:40px;'>
             <?php echo $sf_user->getNumUsuariosConectados()?> Usuarios online
          </div>
        </li>
   </ul>
</div>