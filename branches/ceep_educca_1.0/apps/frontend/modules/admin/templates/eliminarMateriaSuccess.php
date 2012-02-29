<?php use_helper('informacion'); ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Eliminar Materia</h2></div>
  <div class="cont_box_correo">
        <?php $cad="";?>
        <? foreach($cursos as $curso ) : ?>
           <?php $cad.= link_to($curso->getNombre(), 'curso/fichaCurso?idcurso='.$curso->getId()).'<br>' ?><br>
        <? endforeach; ?>
        <? echoWarning('Advertencia', "Si elimina la materia ".$materia->getNombre()." eliminira tambien los cursos, ejercicios y los alumnos inscritos en ella.<br>
                                       Cursos pertenecientes a la materia:<br> $cad"); ?>

        <br>
        <? echo link_to('Eliminar','admin/eliminarMateria?idmateria='.$materia->getId().'&conf=OK','confirm=&iquest;Esta seguro que desea eliminar la materia '.$materia->getNombre().' ? id=ln_conf_borrar_materia'.$materia->getId()) ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>