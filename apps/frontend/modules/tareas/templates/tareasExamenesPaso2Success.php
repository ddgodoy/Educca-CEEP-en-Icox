<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Poner tareas y ex&aacute;menes - Paso 2</h2></div>
  <div class="contenido_principal">
    <?php echo form_tag('tareas/tareasExamenesPaso3') ?>
    <?php echo (input_hidden_tag('id_curso', $id_curso)); ?>
    <?php echo (input_hidden_tag('nombre_curso', $nombre_curso)); ?>
    <?php echo (input_hidden_tag('tipo_prueba', $tipo_prueba)); ?>
    <?php echo (input_hidden_tag('sorpresa', $sorpresa)); ?>

    <table class="tabla_resumen_tarea">
      <tr>
        <th class="td1">
          Curso elegido: 
        </th>
        <td>
          <?php echo $nombre_curso ?>
        </td>
      </tr>
      <tr>
        <th class="td1">
          Tipo de ejercicio: 
        </th>
        <td>
          <?php echo $tipo_prueba ?>
          <?php if($sorpresa){echo(" sorpresa");}?>
        </td>
      </tr>
    </table>

    <br>

    <div id="listado_ejercicios_examen"></div>
    <?php echo javascript_tag(remote_function(array('update' => 'listado_ejercicios_examen', 'url' => 'tareas/listarEjerciciosExamen?filtro='.$id_materia.'&id_curso='.$id_curso)))?>

    </form>
  </div>
  <div class="cierre_principal"></div>
</div>
