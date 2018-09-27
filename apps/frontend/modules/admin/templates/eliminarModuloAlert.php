    <?php use_helper('informacion','SexyButton'); ?>
    <? echoWarning('Cuidado¡¡¡', "Este m&oacute;dulo tiene alumnos matriculados y/o profesores.<br>
    &iquest;Est&aacute; completamente seguro de querer elimnar el m&oacute;dulo ".$modulo->getNombre()."?
    <br><center><table><tr><td>".link_to(image_tag('papelera.gif','Alt="Eliminar m&oacute;dulo" Title="Eliminar m&oacute;dulo" align=absmiddle'),'admin/eliminarModulo?idmodulo='.$modulo->getId().'&forzar=1',array('id'=>'forzar_eliminar_modulo'.$modulo->getId(),'confirm'=>'&iquest;Esta seguro que desea eliminar el '.$modulo->getNombre().' ?'))."</td></tr></table></center>"); ?>
    <br>
    <br>

<?php include_component('paquete', 'fichaModulo',array('idmodulo' => $modulo->getId(),'info' => 1, 'eliminar'=>1)) ?>