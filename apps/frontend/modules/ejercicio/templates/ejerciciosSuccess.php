<?php use_helper('Javascript') ?>
<?php use_helper('formularios') ?>
<div class="capa_principal" id ="ejercicios">
  <div class="titulo_principal">
    <?php if ($rol == 'alumno'):?>
      <h2 class="titbox">Repositorio de ejercicios</h2>
    <?php endif;?>
    <?php if ($rol == 'profesor'):?>
      <h2 class="titbox">Edici&oacute;n de ejercicios</h2>
    <?php endif;?>
  </div>
  <div class="contenido_principal">
    <?php echo form_tag('ejercicio/ejercicios') ?>
      <div class="filtro_general">
        Mostrar ejercicios de:
        <?php echoSelectwMatch('filtro', $id_curso, $cursos, array('class' => 'select'));?>
        <?php echo observe_field('filtro', array('update'=>'listado_ejercicios_creados', 'url'=>'ejercicio/listarEjercicios', 'with' => "'filtro=' + value")) ?>
      </div>
      <div id="listado_ejercicios_creados"></div>
      <?php echo javascript_tag(remote_function(array('update' => 'listado_ejercicios_creados', 'url' => 'ejercicio/listarEjercicios?filtro='.$id_curso)))?>
    </form>
    <?php use_helper('volver'); echo volver();  ?>
  </div>
  <div class="cierre_principal"></div>
</div>
