<?php

 // symfony directories
	$sf_symfony_lib_dir  = dirname(__FILE__).'/../lib/vendor/symfony/lib';
	$sf_symfony_data_dir = dirname(__FILE__).'/../lib/vendor/symfony/data';

	//Directorio de la clase Date
	$date_lib_dir = '/usr/share/pear/';	

	//Tiempo de ejecucion
	set_time_limit(0);

/*
// symfony directories
$sf_symfony_lib_dir  = '/usr/share/pear/symfony';
$sf_symfony_data_dir = '/usr/share/pear/data/symfony';
$sf_swfchart_dir= '/swfcharts/';

//Directorio de la clase Date
$date_lib_dir = '/usr/share/pear/';


//Carga de la clase Date
$cwd = getcwd();           //Guardamos el CWD de trabajo
chdir ($date_lib_dir);     //Cambiamos el CWD
require_once ('Date.php'); //Cargamos la clase
chdir ($cwd);              //Restauramos el CWD

//Tiempo de ejecucion
set_time_limit(0);
*/
?>