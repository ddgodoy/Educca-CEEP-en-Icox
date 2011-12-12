<?php use_helper('Javascript') ?>
<?php echo javascript_tag(
  remote_function(array(
    'update'  => 'eventoActuales',
    'url'     => 'calendario/verEvento?fecha='.$fecha
  ))
) ?>


<?php echo form_remote_tag(array(
    'update'   => 'fecha',
    'url'      => 'calendario/seleccionFecha',
)) ?>
  <label for="elemento">Titulo :</label><?php echo input_tag('titulo', 'valor inicial') ?>
  <br>
  <label for="elemento">Duracion Evento:</label><?php echo input_tag('duracion', 'valor inicial') ?> dias
  <br>
  <label for="elemento">Hora comienzo:</label><?php echo input_tag('horaComienzo', 'valor inicial') ?>
  <br>
  <label for="elemento">Hora Fin:</label><?php echo input_tag('horaFin', 'valor inicial') ?>
  <?php echo select_tag('tipo', options_for_select($opciones, 0)) ?>

  <?php echo input_hidden_tag('curso', $curso) ?>
  <?php echo input_hidden_tag('alumno', $alumno) ?>
  <?php echo input_hidden_tag('fecha', $fecha) ?>

  <?php echo submit_tag('OK') ?>
</form>