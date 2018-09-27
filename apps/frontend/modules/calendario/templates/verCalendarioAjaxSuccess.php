 <?php if (isset($idcurso)) : ?>
     <?php include_component('calendario', 'mostrarCalendario', array('nombreMes' => $nombreMes,
																      'calendar' => $calendar,
																      'idcurso' => $idcurso
																)
							 ) ?>
 <?php else : ?>
     <?php include_component('calendario', 'mostrarCalendario', array('nombreMes' => $nombreMes,
																      'calendar' => $calendar
																)
							 ) ?>
<?php endif; ?>