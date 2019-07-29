<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>
<?php use_helper('javascriptAjax') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar Licencia <?php echo $licencia->getBook(45)?></h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/modificarLicencia?idlicencia='.$licencia->getId(),
        'script' => true,
    ) ) ?>
    <table class="tablanuevocurso">
      <td>&nbsp;<?php echo input_hidden_tag('idusuario', $licencia->getIdUsuario()) ?></td>
      <tr>
        <td class="titulo"><label for="book">Licencia:</label></td>
        <td><?php echo input_tag('book', $licencia->getBook(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="licencia">Autor:</label></td>
        <td><?php echo input_tag('licencia', $licencia->getLicence(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="type">Tipo:</label></td>
        <td><?php echo input_tag('type', $licencia->getType(),'class=input') ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          <div id="trans" class="trans">
             <?php echo sexy_submit_tag('Modificar',array('onmouseup'=>'bloqueaCapa()')); ?>
        </div>
		</td>
      </tr>
    </table>
    </form> 


    <!-- Capas AJAX -->
  <div id="guardar"></div>

</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
<?php echo image_tag('ico_p_endok.gif'); ?> Licencia Modificada
<?php echo cargaPagina('curso/mostrarLicencias',"idcurso=".$licencia->getIdCurso()) ?>
<?php endif; ?>
 

