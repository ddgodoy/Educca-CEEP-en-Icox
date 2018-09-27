<?php use_helper('Javascript') ?>
<div id="mensajes_recibidos">

  <div class="tit_box_tareas"><h2 class="titbox">Estado de las tareas y ex&aacute;menes</h2></div>
  <div class="cont_box_tareas">

  <div class="herramientas">
    Filtrar por curso:
    <?php echo select_tag('filtro', options_for_select($cursos), 'class=select') ?>
    <?php echo observe_field('filtro', array('update'=>'listado_tareas', 'url'=>'ejercicio/listarTareas', 'with' => "'filtro=' + value")) ?>
  </div>

  <div id="listado_tareas">
  </div>

  <?php $keys = array_keys($cursos);?>
  <?php echo javascript_tag(remote_function(array('update' => 'listado_tareas', 'url' => 'ejercicio/listarTareas', 'with' => 'filtro='.$keys[0]))) ?>


  </div>
  <div class="cierre_box_tareas"></div>
</div>
