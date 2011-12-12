<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Imagen del curso: <?echo $curso->getNombre()?></h2></div>
  <div class="cont_box_correo">

    

  <?if (!isset($mostrarForm)) : ?>
        <table>
          <tr>
            <td><?if (file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg')) : ?>
                    <?echo image_tag('img_cursos/portada_'.$curso->getId().'.jpg?rand='.rand(1,9999),'Alt=imagen')?>
                <? else :?>
                    <?echo image_tag('img_cursos/noimg.gif','Alt=imagen')?>
                <? endif; ?>
            </td>
            <td>
                  <?php echo form_tag('admin/imagenCurso', 'multipart=true') ?>
                      <table class="tablanuevacita">
                        <tr>
                          <td class="titulo_largo"><label for="nombre">Imagen:&nbsp;</label></td>
                          <td>  <?php echo input_file_tag('file') ?> <font color='red' size='1'>* Solo ficheros jpg</font>
                                 <?php echo input_hidden_tag('idcurso',$curso->getId())?>
                          </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td> <table>
                                 <tr>
                                   <td><?php echo sexy_submit_tag('Insertar'); ?></td>
                                       <?if (file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg')) : ?>
                                       <td><?php echo sexy_button_to('Eliminar', 'admin/eliminarImagenCurso?idcurso='.$curso->getId(),'onclick= return confirm(\'¿Estas seguro que deseas eliminar la imagen del curso?\') '); ?></td>
                                      <? endif; ?>
                                 </tr>
                               </table>




                          </td>
                        </tr>
                      </table>
                </form>
            </td>
          </tr>
      </table>
      <br><? use_helper('volver');  echo volver(); ?>
  <? else : ?>
      <?php echo image_tag('ico_p_endok.gif'); ?> Guardado
      <?php use_helper('javascriptAjax') ?>
      <?php echo cargaPagina('admin/cursos') ?>

  <? endif; ?>

    <br>

  </div>
  <div class="cierre_box_correo"></div>
</div>