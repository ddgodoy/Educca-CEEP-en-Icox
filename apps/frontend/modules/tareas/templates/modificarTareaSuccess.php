<?php use_helper('Javascript') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $titulo ?></h2></div>
  <div class="contenido_principal">

    <?php echo form_tag('tareas/modificarTarea')?>
      <?php echo input_hidden_tag('id_tarea', $id_tarea) ?>
      <?php echo input_hidden_tag('id_evento', $evento->getId()) ?>
    
    
    <?php if ($opcion == 0): ?>
      <?php echo input_hidden_tag('modificar', 0) ?>
      <?php echo input_hidden_tag('opcion', 0) ?>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaInicio"><strong>Fecha</strong></label></td>
          <td><?php echo input_date_tag('fechaInicio', date("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaInicio"><strong>Inicio&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaFin"><strong>Finalizaci&oacute;n&nbsp;</strong></label></td>
          <td>
            <?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?>
          </td>
        </tr>
      </table>
    <?php endif;?>

    <?php if ($opcion == 1):?>
      <?php echo input_hidden_tag('modificar', 1) ?>
      <?php echo input_hidden_tag('opcion', 1) ?>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaInicio"><strong>Fecha de inicio&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaInicio', date("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaInicio"><strong>Hora de inicio&nbsp;</strong></label></td>
          <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="fechaFin"><strong>Fecha de entrega&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaFin', date("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaFin"><strong>Hora de entrega&nbsp;</strong></label></td>
          <td>
            <?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?>
          </td>
        </tr>
      </table>
    <?php endif;?>

    <?php if ($opcion == 2):?>
      <?php echo input_hidden_tag('modificar', 2) ?>
      <?php echo input_hidden_tag('opcion', 2) ?>
      <table class="tablanuevacita">
        <tr>
          <td class="titulo_largo"><label for="fechaFin"><strong>Fecha de entrega&nbsp;</strong></label></td>
          <td><?php echo input_date_tag('fechaFin', date("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
        </tr>
        <tr>
          <td class="titulo_largo"><label for="horaFin"><strong>Hora de entrega&nbsp;</strong></label></td>
          <td>
            <?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?>
          </td>
        </tr>
      </table>
    <?php endif;?>
    
    <?php if ($opcion == 3):?>
      <?php echo input_hidden_tag('modificar', 3) ?>
      <?php echo input_hidden_tag('opcion', 3) ?>
      
      <div class="titulos_tabla_general">
      <table class="tabla_alumnos_tarea">
        <tr>
          <td class="td1"><?php echo checkbox_tag("seleccionar_todos", 1, false, array('onClick' => 'checkAll()')) ?></td>
          <th>Apellidos, Nombre</th>
        </tr>
      </table>
      </div>
  
      <div class="listado_tabla_general">
      <table class="tabla_alumnos_tarea">
      <?php $indice = 0; foreach($usuarios as $alumno):?>
        <?php $fondo = (($indice % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
        <?php echo("<tr$fondo>"); ?>
          <td class="td1"><?php echo checkbox_tag("usuario$indice", $alumno->getId(), false) ?></td>
          <td><?php echo($alumno->getApellidos().", ".$alumno->getNombre()); ?></td>
        </tr>
        <?php $indice++;?>
      <?php endforeach;?>
      </table>
      <?php echo input_hidden_tag('total_usuarios', $indice) ?>
      </div>

    <?php endif;?>
    
    
    <br><br>
      <?php echo button_to('Cancelar', 'tareas/mostrarTarea?id_tarea='.$id_tarea) ?></td>

      <?php if ($opcion < 3):?>
        <?php echo submit_tag('Guardar cambios') ?>
      <?php else:?>
        <?php echo submit_tag('A&ntilde;adir estos alumnos') ?>
      <?php endif;?>

      <?php if ($mensaje_error != ''):?>
        <?php echo $mensaje_error?>
      <?php endif; ?>
    </form>
    <br><br>
  </div>
  <div class="cierre_principal"></div>
</div>
