<?php echo "menu curso: <b>".$curso->getNombre()."</b>" ?>
<br><br>

<ul class="listamenu">
<li class="cursos"><?php echo link_to('Revisar temario', 'materia/mostrarTemas?id='.$id) ?></li>
<li class="calendario"><?php echo link_to('Eventos del curso', 'materia/mostrarCalCurso?id='.$id) ?></li>
<li class="correo"><?php echo link_to('Correo', 'mensaje/mensajesRecibidos') ?></li>
<li class="chat"><?php echo link_to('Chat del curso', 'chat/jquery?id='.$id,array(
  														'popup' => array('', 'width=650,height=600,left=320,top=0'))) ?></li>


<?php switch ($rol) {
  case 'alumno':
     echo "<li class='chat'>".link_to('Ejercicios', 'ejercicios/index?id='.$id)."</li>\n
           <li class='chat'>".link_to('menu principal', 'alumno/index')."</li>\n";
    break;
  case 'profesor':
    echo "<li class='chat'>".link_to('Ejercicios', 'ejercicios/index?id='.$id)."</li>\n
           <li class='chat'>".link_to('menu principal', 'profesor/index')."</li>\n";
    break;
  case 'supervisor':
    include_partial('menu/supervisor');
    break;
}
?>

<li class="salir"><?php echo link_to('Salir', 'login/logout') ?></li>
</ul>

