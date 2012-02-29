<?php use_helper('Javascript') ?>
<?php use_helper('formularios') ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Seguimiento de tareas y ex&aacute;menes</h2></div>
  <div class="contenido_principal">

  <div class="filtro_general">
    Mostrar tareas de: &nbsp;&nbsp;
    <?php echoSelectwMatch('filtro', $id_curso, $cursos, array('class' => 'select'));?>
    <?php echo observe_field('filtro', array('update'=>'listado_tareas', 'url'=>'seguimiento/listarTareas', 'with' => "'filtro=' + value")) ?>
  </div>

  <div id="listado_tareas">
  </div>

  <?php echo javascript_tag(remote_function(array('update' => 'listado_tareas', 'url' => 'seguimiento/listarTareas?filtro='.$id_curso))) ?>

    <br><? use_helper('volver'); echo volver(); ?>
  </div>
  
  <div class="cierre_principal"></div>
</div>
