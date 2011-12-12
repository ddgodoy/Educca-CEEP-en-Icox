 <?php if (isset($idcurso)) : ?>
     <?php include_component('seguimiento', 'listaAlumnos', array('idcurso' => $idcurso)
							 ) ?>
<? endif; ?>
