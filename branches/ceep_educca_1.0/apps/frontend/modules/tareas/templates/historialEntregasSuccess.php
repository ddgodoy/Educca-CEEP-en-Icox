<?php use_helper('Javascript') ?>
<?php use_helper('formularios') ?>

<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Historial de entregas</h2></div>
  <div class="contenido_principal">

  <div class="filtro_general">
    Filtrar por curso:
    <?php echoSelectwMatch('filtro', $id_curso, $cursos, array('class' => 'select'));?>
    <?php echo observe_field('filtro', array('update'=>'listado_historial_entregas', 'url'=>'tareas/listarHistorialEntregas', 'with' => "'filtro=' + value")) ?>
  </div>

  <div id="listado_historial_entregas">
  </div>

  <?php echo javascript_tag(remote_function(array('update' => 'listado_historial_entregas', 'url' => 'tareas/listarHistorialEntregas?filtro='.$id_curso))) ?>
  <br>
  <? use_helper('volver'); echo volver();  ?>

  </div>
  <div class="cierre_principal"></div>
</div>
