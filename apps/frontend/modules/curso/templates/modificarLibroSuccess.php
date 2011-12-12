<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>
<?php use_helper('javascriptAjax') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar Libro <?echo $libro->getNombre(100)?></h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'curso/modificarLibro?idlibro='.$libro->getId(),
        'script' => true,
    ) ) ?>
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo input_tag('nombre', $libro->getNombre(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="autor">Autor:</label></td>
        <td><?php echo input_tag('autor', $libro->getAutor(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="editorial">Editorial:</label></td>
        <td><?php echo input_tag('editorial', $libro->getEditorial(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="publicacion">Publicado:</label></td>
        <td><?php echo input_tag('publicacion', $libro->getAnioPublicacion(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="isbn">ISBN:</label></td>
        <td><?php echo input_tag('isbn', $libro->getIsbn(),'class=input') ?></td>
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
<? else : ?>
<?php echo image_tag('ico_p_endok.gif'); ?> Libro modificado
<?php echo cargaPagina('curso/mostrarBibliografia',"idcurso=".$sf_user->getCursoMenu()) ?>
<? endif; ?>


