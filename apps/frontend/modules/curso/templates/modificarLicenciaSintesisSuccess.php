<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>
<?php use_helper('javascriptAjax') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar Licencia Sintesis <?php echo $licenciaSintesis->getTitle(100)?></h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/modificarLicenciaSintesis?idlicenciasintesis='.$licenciaSintesis->getId(),
        'script' => true,
    ) ) ?>
    <table class="tablanuevocurso">
      <td>&nbsp;<?php echo input_hidden_tag('idcurso', $licenciaSintesis->getIdCurso()) ?></td>
      <tr>
        <td class="titulo"><label for="title">Titulo:</label></td>
        <td><?php echo input_tag('title', $licenciaSintesis->getTitle(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="capitulo">Capitulo:</label></td>
        <td><?php echo input_tag('capitulo', $licenciaSintesis->getCapitulo(),'class=input') ?></td>
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
<?php echo cargaPagina('curso/mostrarLicencias',"idcurso=".$licenciaSintesis->getIdCurso()) ?>
<?php endif; ?>
 

