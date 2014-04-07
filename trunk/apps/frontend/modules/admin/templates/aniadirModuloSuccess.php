<?php use_helper('Javascript') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Nuevos m&oacute;dulos para el <?php echo $rol." ".$usuario->getNombre()." ".$usuario->getApellidos()?></h2></div>
<div class="cont_box_grande"><br>
<?php use_helper('SexyButton') ?>
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'admin/aniadirModulo?idusuario='.$usuario->getId().'&rol='.$rol,
        'script' => true,
    ) ) ?>
    
  <?php if (!$modulos):?>
    <?php use_helper('informacion'); ?>
    <?php echoWarningCorto('', 'No se puede matricular a este alumno en nuevos m&oacute;dulos. O bien no se ha creado ning&uacute;n m&oacute;dulo o el alumno ya est&aacute; matriculado en todos los m&oacute;dulos.');?>
  <?php else:?>
  
  <center>
      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">Lista de nuevos m&oacute;dulos para el alumno </th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
        <?php $j=0; ?>
  	    <?php foreach($modulos as $modulo) : ?>
  	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("modulos$j", $modulo->getId(), false,array('onchange' => " pulsadoCheckbox('modulos$j');"))?></td>
            <td style="width: 95%; text-align: left;"><?php echo $modulo->getNombre()."<br>" ?></td>
    		    <?php $j++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
      </div>
    <br>
  <table><tr><td><?php echo sexy_submit_tag('Matricular en estos m&oacute;dulos'); ?></td></tr></table>
  </center>
  
  <?php echo input_hidden_tag('totalModulos', $j) ?>
  <?php endif;?>
    
  <?php echo input_hidden_tag('pulsadosModulos', '0') ?>
  </form>


    <?php echo javascript_tag("
  function pulsadoCheckbox(chk)
  {  if (document.getElementById(chk).checked)
         {   document.getElementById('pulsadosModulos').value++;
		 }
     else   {   document.getElementById('pulsadosModulos').value--;
	        }

  //alert(document.getElementById('pulsadosModulos').value);
  }

") ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
<br><?php use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
 <?php /*$sf_Controller->redirect('admin/listaCursos?idusuario='.$idusuario.'&rol='.$rol);*/?>
 <?php if (isset($errores)) : ?>
 	                <?php echo "<b>".$errores."<b><br>";?>
 <?php endif; ?>

<?php if (empty($errores)) : ?>
  	    <?php use_helper('javascriptAjax') ?>
         <?php echo cargaPagina('admin/listaModulos','idusuario='.$usuario->getId().'&rol='.$rol) ?>
<?php endif; ?>
<?php endif; ?>
