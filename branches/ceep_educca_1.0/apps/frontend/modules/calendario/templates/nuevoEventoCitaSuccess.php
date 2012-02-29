<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>
<div class="tit_box_calendario"><h2 class="titbox">Nueva cita</h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'calendario/guardarCita',
        'script' => true)) ?>
    <table class="tablanuevacita">
      <tr>
        <td class="titulo"><label for="tipo">Tipo evento:</label></td>
        <td><?php echo select_tag('tipo', options_for_select($opciones, 0), 'class=select') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaInicio">Fecha Inicio:</label></td>
        <td><?php echo input_date_tag('fechaInicio','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaFin">Fecha Fin:</label></td>
        <td><?php echo input_date_tag('fechaFin','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="horaInicio">Hora Inicio:</label></td>
        <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="horaFin">Hora Fin:</label></td>
        <td><?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="titulo">Titulo:</label></td>
        <td><?php echo input_tag('titulo', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="descripcion">Descripci&oacute;n:</label></td>
        <td><?php echo textarea_tag('descripcion', '', 'size=34x5') ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          <div id="trans" class="trans" >
           <?php echo sexy_submit_tag('Guardar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
          </div>
           </td>
      </tr>
    </table>
    </form>

    <!-- Capas AJAX -->
    <div id="guardar"></div>

</div>
<div class="cierre_box_grande"></div>


