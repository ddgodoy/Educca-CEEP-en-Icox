<?php use_helper('SexyButton') ?>
<div id="miscursos_g">
  <div class="tit_box_mensajes"><h2 class="titbox"><?= $curso->getNombre(80) ?> : Informaci&oacute;n General y Normativa</h2></div>
  <div class="cont_box_correo">
    <div class="divinfo">
    <?php echo form_tag('curso/modificarNormativa',array('name'=>'modificar_normativa')) ?>
      <table class="tablanormativa">
        <tr>
          <td class="titulo"><h3>Normativa</h3></td>
        </tr>
        <tr>
          <td class="cont">
          <?php echo textarea_tag('normativa',$normativa,array('cols'=>88,'rows'=>8, 'class' => 'textcont')) ?>
    	    </td>
        </tr>
        <tr>
          <td class="titulo"><h3>Informaci&oacute;n general</h3></td>
        </tr>
        <tr>
          <td class="cont">
            <?php echo textarea_tag('info',$info,array('cols'=>88,'rows'=>8, 'class' => 'textcont')) ?>
            <br />
            <br />
    	      <?php echo textarea_tag('infoextendida',$infoextendida,array('cols'=>88,'rows'=>8, 'class' => 'textcont')) ?>
    	      <?php echo input_hidden_tag('idcurso',$idcurso) ?>
          </td>
        </tr>
    	</table>
	  </div><br />
    <?php if ($rol == 'profesor') : ?>

      <?php if (isset($idcurso)) : ?>
        <?php $redireccion = "?idcurso=".$idcurso; ?>
      <?php else  : ?>
        <?php $redireccion = "?" ; ?>
      <?php endif; ?>

      <center><div style="width: 150px; text-align: right; padding-bottom: 20px;"><?php echo sexy_button_to_function('Guardar informaci&oacute;n', 'document.modificar_normativa.submit()'); ?></div></center>
    <?php endif;?>
    </form>
  </div>
  <div class="cierre_box_correo"></div>
</div>
