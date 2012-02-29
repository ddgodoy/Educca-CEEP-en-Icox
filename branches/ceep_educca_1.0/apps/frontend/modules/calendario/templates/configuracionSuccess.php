<?php use_helper('Javascript','SexyButton') ?>
<div class="tit_box_calendario"><h2 class="titbox">Configuraci&oacute;n calendario: <?php echo $nombre ?></h2></div>
<div class="cont_box_grande">

<?php echo form_remote_tag(array(
        					'update'   => 'guardar',
         				    'url'      => 'calendario/guardarConfiguracion',
         				    'script' => true),
		                    array('name'=>'fdatos')
		) ?>
<table class="tabla_show_perfil">
 <tr>
    <th><label for="tipo">D&iacute;as Antes:</label></th>
    <td><?php echo select_tag('diasAntes', options_for_select($opciones, $diasAntes), array('style' => 'width: 80px;')) ?></td>
 </tr>

 <tr>
    <th><label for="tipo">D&iacute;as Despu&eacute;s:</label></th>
    <td><?php echo select_tag('diasDespues', options_for_select($opciones, $diasDespues), array('style' => 'width: 80px;')) ?></td>
 </tr>

  <?php echo input_hidden_tag('idcurso', $idcurso) ?>
  <?php if (isset($principal)) : ?>
     <?php echo input_hidden_tag('principal', $principal) ?>
  <? endif; ?>

  <tr>
     <td>&nbsp;</td>
     <td>
     <div id="trans" class="trans">
     <br>
       <?php echo sexy_submit_tag('Guardar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
      </div>
     </td>
  </tr>
</table>
</form>
<div id="guardar"></div>
<?php use_helper('informacion'); ?>
<br><br>
<? echoNotaInformativaCorta('Ayuda', "Seleccione el numero d&iacute;as para mostrar eventos pr&oacute;ximos."); ?>
</div>
<div class="cierre_box_grande"></div>
