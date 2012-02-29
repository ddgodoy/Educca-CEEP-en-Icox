<a href="javascript:void(0)" onclick="window.open('<?php echo url_for('supervisor/informeTripartita?idcurso='.$idcurso); ?>', 'popupinformes', 'params')"><? echo image_tag('icono-impresion.gif',array('alt' => 'Descargar versi&oacute;n para imprimir', 'title' => 'Descargar versi&oacute;n para imprimir'))?></a>
<?php include_component('curso', 'fichaCurso',array('idcurso' => $idcurso,'info' => 1)) ?>
<?php include_component('curso', 'listaAlumnos',array('idcurso' => $idcurso)) ?>
