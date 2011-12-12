<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>
<div class="tit_box_calendario"><h2 class="titbox">Nuevo libro</h2></div>
<div class="cont_box_grande">
    <?php /*echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'profesor/guardarLibro',
    )) */?>
    <?php echo form_tag('profesor/guardarLibro') ?>
    <table class="tablanuevacita">
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
        <td>&nbsp;<?php $idcurso = $sf_request->getParameter('idcurso'); echo input_hidden_tag('idcurso', $idcurso) ?></td>
        <td><?php echo sexy_submit_tag('Insertar'); ?></td>
      </tr>
    </table>
    </form>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
</div>
<div class="cierre_box_grande"></div>
