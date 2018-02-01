<?php use_helper('Validation', 'SexyButton', 'Text') ?>

<?php if (!isset($mostrarForm)) : ?>
<div id="mistemas">
 <div class="tit_box_mensajes"><h2 class="titbox"><?php echo truncate_text( $curso->getNombre(), 60) ?> - Biblioteca de archivos - Subir nuevo</h2></div>
  <div class="cont_box_correo">

<?php echo form_tag('biblioteca_archivos/nuevo', 'multipart=true') ?>
    <?php echo input_hidden_tag('idcurso', $curso->getId()) ?>
    <table class="tablanuevacita">

      <tr>
        <td class="titulo_largo"><label for="curso">Curso:&nbsp;</label></td>
        <td> <?= $curso->getNombre()?>  </td>
      </tr>

      <tr>
        <td class="titulo_largo"><label for="nombre">Fichero:&nbsp;</label></td>
        <td>  <?php echo input_file_tag('fichero') ?> <font color='red'> Tamaño m&aacute;ximo 2GB</font> </td>
      </tr>

      <tr>
        <td class="titulo_largo"><label for="nombre">Descripci&oacute;n:&nbsp;</label></td>
        <td>
            <?php echo textarea_tag('descripcion', '', 'size=40x6') ?></td>
      </tr>


      <tr>
        <td>&nbsp;</td>
        <td>
              <?php if ($sf_request->hasErrors()): ?>
                    <?php include_partial('login/ErrorMsg') ?>
              <?php endif; ?>
              <?php echo sexy_submit_tag('Guardar'); ?>
              
              <div style='display:none;'><input type='submit' value='guardar'></div> <?php //para tests ?>  
        </td>
      </tr>
    </table>
    </form>
  </div>
  <div class="cierre_box_correo"></div>
</div>



<?php else : ?>



<?php endif;?>