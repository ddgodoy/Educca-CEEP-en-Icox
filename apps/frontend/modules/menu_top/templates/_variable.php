<?php switch ($rol) {
  case 'alumno':
    include_partial('menu_top/alumno',array('moduloActual' => $moduloActual, 'accionActual' => $accionActual));
    break;
  case 'profesor':
    include_partial('menu_top/profesor',array('moduloActual' => $moduloActual, 'accionActual' => $accionActual));
    break;
  case 'supervisor':
    include_partial('menu_top/supervisor',array('moduloActual' => $moduloActual, 'accionActual' => $accionActual));
    break;
  case 'administrador':
    include_partial('menu_top/administrador',array('moduloActual' => $moduloActual, 'accionActual' => $accionActual));
    break;
  case 'moroso':
    include_partial('menu_top/moroso', array('moduloActual' => $moduloActual, 'accionActual' => $accionActual));
    break;
  default:
  	echo image_tag('bots_cierre_izq.jpg', '');
    echo image_tag('bots_cierre.gif', '');
}
?>
