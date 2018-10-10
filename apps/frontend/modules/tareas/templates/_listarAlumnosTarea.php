<?php use_helper('fechas') ?>

<div class="titulos_tabla_general">
  <table class="detalles_alumnos_tarea">
    <tr>
      <th class="td1">Apellidos, Nombre</th>
      <?php if ($tipo_tarea == 'Tarea'):?>
        <th class="td2">Estado de la tarea</th>
      <?php else:?>
        <th class="td2">Estado del examen</th>
      <?php endif;?>
      <th class="td3">Fecha de entrega</th>
      <th class="td4">Opci&oacute;n</th>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="detalles_alumnos_tarea">
    <?php $i = 0;?>
    <?php foreach($elementos_lista as $elemento):?>
    <?php $fondo = (($i % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>
    
      <td class="td1"><?php echo($elemento[1].', '.$elemento[0]);?></td>
      
      
      <?php if ($estado):?>
        <?php if ($estado == 1):?>
          <?php if ($tipo_tarea == 'Tarea'):?>
            <?php if ($elemento[3]):?>
              <td class="td2"><?php echo image_tag('entregado.gif', 'title=Tarea entregada');?></td>
              <td class="td3"><?php echo darFormato($elemento[4]) ?></td>
              <td class="td4">&nbsp;</td>
            <?php else:?>
              <?php if ($elemento[2] == null):?>
                <td class="td2"><?php echo image_tag('nointentado.png', 'title=Tarea no intentada'); ?></td>
                <td class="td3">No entregada</td>
                <td class="td4">
                  <?php if ($tipo_tarea == 'Tarea'):?>
                    <?php echo button_to('Quitar a este alumno', "tareas/mostrarTarea?id_tarea=$id_tarea&eliminar=".$elemento[5]) ?>
                  <?php endif;?>
                </td>
              <?php else:?>
                <td class="td2"><?php echo image_tag('incompleto.png','title=En desarrollo'); ?></td>
                <td class="td3">No entregada</td>
                <td class="td4">&nbsp;</td>
              <?php endif;?>
            <?php endif;?>
          <?php else:?>
            <td class="td2"><?php echo image_tag('incompleto.png', 'title=Est&aacute; realizando el examen'); ?></td>
            <td class="td3">No entregado</td>
            <td class="td4">&nbsp;</td>
          <?php endif;?>
        <?php else:?>
          <?php if ($elemento[2] == null):?>
            <?php if ($tipo_tarea == 'Tarea'):?>
              <td class="td2"><?php echo image_tag('nopresentado.gif', 'title=Tarea no entregada'); ?></td>
              <td class="td3">No entregada</td>
              <td class="td4">---</td>
            <?php else:?>
              <td class="td2"><?php echo image_tag('nopresentado.gif', 'title=Examen no presentado'); ?></td>
              <td class="td3">No presentado</td>
              <td class="td4">---</td>
            <?php endif;?>
          <?php else:?>
            <?php if ($tipo_tarea == 'Tarea'):?>
              <td class="td2"><?php echo image_tag('entregado.gif', 'title=Tarea entregada'); ?></td>
              <?php if ($elemento[3]):?>
                <td class="td3"><?php echo darFormato($elemento[4]) ?></td>
              <?php else:?>
                <td class="td3"><?php echo $evento->getFechaFin('d-m-Y')?></td>
              <?php endif;?>
              <td class="td4">---</td>
            <?php else:?>
              <td class="td2"><?php echo image_tag('entregado.gif', 'title=Examen entregado'); ?></td>
              <?php if ($elemento[3]):?>
                <td class="td3"><?php echo darFormato($elemento[4]) ?></td>
              <?php else:?>
                <td class="td3"><?php echo $evento->getFechaFin('d-m-Y')?></td>
              <?php endif;?>
              <td class="td4">---</td>
            <?php endif;?>
          <?php endif;?>
        <?php endif;?>
      <?php else:?>
        <td class="td2">---</td>
        <td class="td3">---</td>
        <td class="td4">
          <?php if ($tipo_tarea == 'Tarea'):?>
            <?php echo button_to('Quitar a este alumno', "tareas/mostrarTarea?id_tarea=$id_tarea&eliminar=".$elemento[5]) ?>
          <?php endif;?>
        </td>
      <?php endif;?>
    </tr>
      <?php $i++;?>
    <?php endforeach;?>
    
  </table>
</div>


<div class="nota_informativa">
  <table>
    <tr>
      <?php if ($estado == 1):?>
        <?php if ($tipo_tarea == 'Tarea'):?>
          <td width="150"><?php echo image_tag('nointentado.png'); ?> Tarea no intentada</td>
         	<td width="150"><?php echo image_tag('incompleto.png'); ?> Tarea en desarrollo</td>
        	<td width="150"><?php echo image_tag('entregado.gif'); ?> Tarea entregada</td>
        <?php else: ?>
          <td width="150"><?php echo image_tag('incompleto.png'); ?> Realizando el examen</td>
        <?php endif;?>
      <?php endif;?>
      <?php if ($estado == 2):?>
        <?php if ($tipo_tarea == 'Tarea'):?>
          <td width="150"><?php echo image_tag('nopresentado.gif'); ?> Tarea no entregada</td>
         	<td width="150"><?php echo image_tag('entregado.gif'); ?> Tarea entregada</td>
        <?php else: ?>
          <td width="150"><?php echo image_tag('nopresentado.gif'); ?> No presentado</td>
         	<td width="150"><?php echo image_tag('entregado.gif'); ?> Examen entregado</td>
        <?php endif;?>
      <?php endif;?>
    </tr>
  </table>
</div>
