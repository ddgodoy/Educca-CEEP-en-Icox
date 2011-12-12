    <?php use_helper('informacion','SexyButton'); ?>
    <? echoWarning('Cuidado¡¡¡', "Este curso tiene alumnos matriculados y/o profesores y/o pertenece a alg&uacute;n m&oacute;dulo.<br>
    &iquest;Est&aacute; completamente seguro de querer elimnar el curso ".$curso->getNombre()."?
    <br><center><table><tr><td>".sexy_button_to('Eliminar Curso','admin/eliminarCurso?idcurso='.$curso->getId().'&forzar=1')."</td></tr></table></center>"); ?>
    <br>
    <br>

<?php include_component('curso', 'fichaCurso',array('idcurso' => $curso->getId(),'info' => 1, 'eliminar'=>1)) ?>