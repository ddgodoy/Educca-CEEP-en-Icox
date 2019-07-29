<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Nueva Licencia </h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/nuevaLicenciaSintesis',
        'script' => true,
    )) ?>
  
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="title">Titulo:</label></td>
        <td><?php echo input_tag('title', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="capitulo">Capitulo:</label></td>
        <td><?php echo input_tag('capitulo', '','class=input') ?></td>
      </tr>
      <tr>
        <td>&nbsp;<?php echo input_hidden_tag('idcurso', $sf_request->getParameter('idcurso')) ?></td>
        <td><br><div id="trans" class="trans">
         <?php echo sexy_submit_tag('Guardar licencia', 'curso/nuevaLicenciaSintesis','confirm=&iquest;Desea agregar otro Capitulo?', 'curso/nuevaLicenciaSintesis?idcurso='.$idcurso); ?>             
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
<?php use_helper('javascriptAjax') ?>
<?php echo image_tag('ico_p_endok.gif'); ?> Licencia Guardada
<?php echo cargaPagina('curso/mostrarLicencias',"idcurso=".$sf_request->getParameter('idcurso')) ?>
<?php endif; ?>

