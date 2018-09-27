<?php use_helper('Javascript') ?>


<?php /*echo form_remote_tag(array('update'   => '',
     							 'url'      => 'calendario/seleccionFecha'),
    					  array ('name'     => 'falumno')
) */?>
<?php echo form_tag('', array('name'=>'falumno')) ?>

  <?php /*echo link_to_function(
  'OK',
  visual_effect('appear', 'fecha')
) */?>
<?php echo select_tag('salumnos', options_for_select($opciones, 0),
                          array('onchange' => 'cambiaAlumno()' )
		)  ?>
</form>
