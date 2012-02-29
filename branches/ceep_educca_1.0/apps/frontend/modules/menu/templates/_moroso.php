  <div class="tit_box_menu"><h2 class="titbox">Men&uacute; principal</h2></div>
  <ul class="listamenu">
    <li class="inicio"><?php echo link_to('Inicio', 'moroso/index',array('name' => 'incio')) ?></li>
    <li class="infopersonal"><?php echo link_to('Informacion Personal', 'usuario/mostrarPerfil') ?></li>
    <li class="salir"><?php echo link_to('Salir', 'login/logout') ?></li>
  </ul>
