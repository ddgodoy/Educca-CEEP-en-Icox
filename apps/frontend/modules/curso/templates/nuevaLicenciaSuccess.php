<?php use_helper('Javascript','Validation','formularios') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Nueva Licencia </h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/nuevaLicencia',
        'script' => true,
    )) ?>
    
    <table class="tablanuevocurso">
      <tr>

        <td class="titulo"><label for="usuario">Usuario:</label></td>
        <td>
            <?php echoSelectwMatch('usuario', $usuarioId, $usuarios, array('class' => 'select'));?>
        </td>        
      </tr>
      <tr>
        <td class="titulo"><label for="book">Libro:</label></td>
        <td><?php echo input_tag('book', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="licencia">Licencia:</label></td>
        <td><?php echo input_tag('licencia', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="type">Tipo:</label></td>
        <td><?php echo input_tag('type', '','class=input') ?></td>
      </tr>   
      <tr>
        <td>&nbsp;<?php echo input_hidden_tag('idcurso', $sf_request->getParameter('idcurso')) ?></td>
        <td><br><div id="trans" class="trans">
             <?php echo sexy_submit_tag('Guardar licencia'); ?>      
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


