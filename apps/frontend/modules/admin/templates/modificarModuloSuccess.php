<?php use_helper('Javascript'); ?>
<?php use_helper('informacion'); ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar modulo <?php echo $modulo->getNombre()?></h2></div>
<div class="cont_box_grande">
<?php use_helper('SexyButton','Validation') ?>

    <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                         'url'      =>'admin/modificarModulo?idmodulo='. $modulo->getId(),
                                                         'script' => true));
    ?>
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', $modulo->getNombre(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Precio:</label></td>
        <td><?php echo form_error('precio') ?><?php echo input_tag('precio', $modulo->getPrecio(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Pago:</label></td>
        <td>
          <input name="modalidad" value="mensual" type="radio" <?php if ($modulo->getMensual()) {echo 'checked';} ?>> Mensual &nbsp;&nbsp;&nbsp;
          <input name="modalidad" value="completo" type="radio" <?php if (!$modulo->getMensual()) {echo 'checked';} ?>> Completo &nbsp;&nbsp;&nbsp;
        </td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Descipci&oacute;n:</label></td>
        <td><?php echo form_error('precio') ?><?php echo textarea_tag('descripcion', $modulo->getDescripcion(), 'size=34x5') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Fecha Inicio:</label></td>
        <td><?php echo $modulo->getFechaInicio("d/m/Y")?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="precio">Fecha Fin:</label></td>
        <td><?php echo $modulo->getFechaFin("d/m/Y")?></td>
      </tr>


	  <tr>
        <td class="titulo"><label for="precio">webcam:</label></td>
        <td><?php if ($modulo->getWebcam() ) : ?>
                      S&iacute;
                    <?php else :?>
                       No
                    <?php endif; ?></td>
      </tr>

	  <tr>
        <td class="titulo"><label for="precio">scaner:</label></td>
        <td><?php if ($modulo->getScan() ) : ?>
                      S&iacute;
                    <?php else :?>
                       No
                    <?php endif; ?>
              </td>
      </tr>
    </table>
    
    <br><br>
    
    <center>
      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">Cursos pertenecientes al m&oacute;dulo </th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
        <?php $j=0; ?>
  	    <?php foreach($cursosActuales as $cursosActual) : ?>
  	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("cursos$j", $cursosActual->getCurso()->getId(), true,array('onchange' => " pulsadoCheckbox('cursos$j');"))?></td>
            <td style="width: 95%; text-align: left;"><?php echo $cursosActual->getCurso()->getNombre(); ?></td>
    		    <?php $j++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
  	    <?php if (!$j):?>
  	      <?php echoNotaInformativaCorta('', 'El m&oacute;dulo no contiene ning&uacute;n curso'); ?>
  	    <?php endif;?>
      </div>
      <?php $pulsados = $j; ?>
      <br><br>
      
      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">A&ntilde;adir otros cursos al m&oacute;dulo:</th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
  	    <?php foreach($restosCursos as $restosCurso) : ?>
  	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("cursos$j", $restosCurso->getId(), false,array('onchange' => " pulsadoCheckbox('cursos$j');"))?></td>
            <td style="width: 95%; text-align: left;"><?php echo $restosCurso->getNombre(); ?></td>
    		    <?php $j++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
  	    <?php if ($j == $pulsados):?>
  	      <?php echoNotaInformativaCorta('', 'No hay m&aacute;s cursos que a&ntilde;adir al m&oacute;dulo'); ?>
  	    <?php endif;?>
      </div>
    
      <br>
      <table>
        <tr>
          <td>
            <?php echo sexy_submit_tag('Guardar cambios'); ?>
          </td>
        </tr>
      </table>
      </center>

    <?php echo input_hidden_tag('totalCursos', $j) ?>
    <?php echo input_hidden_tag('pulsadosCursos', $pulsados) ?>
    </form>


    <?php echo javascript_tag("
  function pulsadoCheckbox(chk)
  {  if (document.getElementById(chk).checked)
     {    document.getElementById('pulsadosCursos').value++;
		 }else  {   document.getElementById('pulsadosCursos').value--;
	          }

  }

") ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
<br><?php use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
  	<?php use_helper('javascriptAjax') ?>
    <?php echo cargaPagina('admin/fichaModulo','idmodulo='.$modulo->getId()) ?>
<?php endif; ?>


