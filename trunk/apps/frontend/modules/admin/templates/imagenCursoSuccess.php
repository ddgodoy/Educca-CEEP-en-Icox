<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Imagen del curso: <?php echo $curso->getNombre()?></h2></div>
  <div class="cont_box_correo">

    

  <?php if(!isset($mostrarForm)) : ?>
        <table>
          <tr>
            <td><?php if(file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg')) : ?>
                    <?php echo image_tag('img_cursos/portada_'.$curso->getId().'.jpg?rand='.rand(1,9999),'Alt=imagen')?>
                <?php else :?>
                    <?php echo image_tag('img_cursos/noimg.gif','Alt=imagen')?>
                <?php endif; ?>
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
                                       <?php if (file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg')) : ?>
                                       <td><?php echo sexy_button_to('Eliminar', 'admin/eliminarImagenCurso?idcurso='.$curso->getId(),'onclick= return confirm(\'¿Estas seguro que deseas eliminar la imagen del curso?\') '); ?></td>
                                      <?php endif; ?>
                                 </tr>
                               </table>




                          </td>
                        </tr>
                      </table>
                </form>
            </td>
          </tr>
      </table>
      <br><?php use_helper('volver');  echo volver(); ?>
  <?php else : ?>
      <?php echo image_tag('ico_p_endok.gif'); ?> Guardado
      <?php use_helper('javascriptAjax') ?>
      <?php echo cargaPagina('admin/cursos') ?>

  <?php endif; ?>

    <br>

  </div>
  <div class="cierre_box_correo"></div>
</div>