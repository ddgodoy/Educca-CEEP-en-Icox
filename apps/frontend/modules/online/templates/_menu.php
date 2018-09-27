    <div class="tit_box_menu"><h2 class="titbox">Usuarios conectados</h2></div>
    <ul class="listamenu">
      <li class='conectados_c'>
        <div id='d_u_conectados'><?php echo link_to('&nbsp;Usuarios online ('.$sf_user->getNumUsuariosConectados().')', 'online/conectados?id='.$sf_user->getCursoMenu(),array('popup' => array('', 'width=180,height=350,left=320,top=0'))) ?></div>
      </li>
    </ul>

 