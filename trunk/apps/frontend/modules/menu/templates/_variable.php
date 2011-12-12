<?php switch ($rol) {
  case 'alumno':
    if ($sf_user->getCursoMenu()) {
    	include_partial('menu/alumno',array('idcurso' => $idcurso, 'rol' => $rol));}
	else  include_partial('menu/alumno');
    break;
  case 'profesor':
    if ($sf_user->getCursoMenu()) {
    	include_partial('menu/profesor',array('idcurso' => $idcurso, 'rol' => $rol));}
    else include_partial('menu/profesor');
    break;
  case 'supervisor':
    include_partial('menu/supervisor');
    break;
  case 'administrador':
    include_partial('menu/administrador');
    break;
  case 'moroso':
    include_partial('menu/moroso');
    break;
  default :
    include_component('login', 'login');
    break;
}
?>
