<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Nuevo Libro </h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/nuevoLibro',
        'script' => true,
    )) ?>
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo input_tag('nombre', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="autor">Autor:</label></td>
        <td><?php echo input_tag('autor', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="editorial">Editorial:</label></td>
        <td><?php echo input_tag('editorial', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="publicacion">Publicado:</label></td>
        <td><?php echo input_tag('publicacion', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="isbn">ISBN:</label></td>
        <td><?php echo input_tag('isbn', '','class=input') ?></td>
      </tr>

      <tr>
        <td>&nbsp;<?php echo input_hidden_tag('idcurso', $sf_request->getParameter('idcurso')) ?></td>
        <td><br><div id="trans" class="trans">
             <?php echo sexy_submit_tag('Guardar libro'); ?>
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
<?php echo image_tag('ico_p_endok.gif'); ?> Libro Guardado
<?php echo cargaPagina('curso/mostrarBibliografia',"idcurso=".$sf_request->getParameter('idcurso')) ?>
<?php endif; ?>


