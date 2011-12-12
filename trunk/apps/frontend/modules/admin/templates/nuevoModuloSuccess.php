<?php use_helper('Javascript') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Alta de un nuevo m&oacute;dulo</h2></div>
<div class="cont_box_grande">
<?php use_helper('SexyButton','Validation') ?>

      <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                         'url'      =>'admin/nuevoModulo',
                                                         'script' => true));
      ?>
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', '','class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Precio:</label></td>
        <td><?php echo form_error('precio') ?><?php echo input_tag('precio', '','class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Pago:</label></td>
        <td>
          <input name="modalidad" value="mensual" type="radio"> Mensual &nbsp;&nbsp;&nbsp;
          <input name="modalidad" value="completo" type="radio" checked> Completo &nbsp;&nbsp;&nbsp;
        </td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Descripci&oacute;n:</label></td>
        <td><?php echo form_error('descripcion') ?><?php echo textarea_tag('descripcion', '', 'size=34x5') ?></td>
      </tr>
    </table>
    
    <br><br>

      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">Cursos que se incluir&aacute;n en el m&oacute;dulo:</th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
        <?php $j = 0; ?>
  	    <?php foreach($cursos as $curso) : ?>
  	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("cursos$j", $curso->getId(), false,array('onchange' => " pulsadoCheckbox('cursos$j');"))?></td>
            <td style="width: 95%; text-align: left;"><?php echo $curso->getNombre()."<br>" ?></td>
    		    <?php $j++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
  	    <?php if (!$j):?>
  	      <?php echoWarningCorto('', 'No hay ning&uacute;n curso en la plataforma'); ?>
  	    <?php endif;?>
      </div>
<br>
      <table>
        <tr>
          <td>
            <?php echo sexy_submit_tag('Guardar m&oacute;dulo'); ?>
          </td>
        </tr>
      </table>
       


    <?php echo input_hidden_tag('totalCursos', $j) ?>
    <?php echo input_hidden_tag('pulsadosCursos', '0') ?>
    </form>


    <?php echo javascript_tag("
  function pulsadoCheckbox(chk)
  {  if (document.getElementById(chk).checked)
         {   document.getElementById('pulsadosCursos').value++;
		 }
     else   {   document.getElementById('pulsadosCursos').value--;
	        }
  }

") ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>

<br><? use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>
<? else : ?>
  	<? /*echo "fecha inicio modulo: ".$fechaInicio."<br>"
  	   echo "fecha fin modulo: ".$fechaFin."<br>"
  	 echo "Necesita webcam: ".$webcam."<br>"
  	 echo "Necesita scan: ".$scan."<br>"*/
  	?>
  	<?php use_helper('javascriptAjax') ?>
    <?php echo cargaPagina('admin/modulos') ?>
<? endif; ?>
