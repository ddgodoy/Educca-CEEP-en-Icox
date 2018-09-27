<br><br>
<?php
  /*echo  $fechaInicio;
  echo "<br>";
  echo  $fechaFin;
  echo "<br>";
  echo  $curso;
  echo "<br>alumno";
  echo  $alumno;
  echo "<br>titulo";
  echo  $titulo;
  echo "<br>descripcion";
  echo  $descipcion;
  echo "<br>tipo";
  echo  $tipo;
  echo "<br>";*/

echo image_tag('ico_p_endok.gif'); ?> Evento Guardado
<?if (!isset($PopUp)) : ?>
   <?php use_helper('Javascript','javascriptAjax') ?>
   <?php echo cargaPagina('calendario/mostrarCalendario',"idcurso=".$sf_user->getCursoMenu()) ?>
<?endif; ?>



