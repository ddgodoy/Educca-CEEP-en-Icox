<?php if ($curso): ?>
  <?php include_partial('listaAlumnosCurso', array('alumnos' => $alumnos, 'curso' => $curso, 'busqueda' => $busqueda, 'opciones' => true)) ?>
<?php else:?>
  <?php include_partial('listaAlumnosPlataforma', array('alumnos' => $alumnos, 'busqueda' => $busqueda, 'opciones' => true)) ?>
<?php endif;?>
