<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificacion de foto usuario: <?php echo $usuario->getNombre()." ".$usuario->getApellidos()?></h2></div>


<div class="cont_box_grande">

 <?php if ($sf_user->hasCredential('administrador')) : ?>
        	 <?php echo form_tag('usuario/modificarFoto?idusuario='.$usuario->getId(), 'multipart=true') ?>
	     <?php else : ?>
	         <?php echo form_tag('usuario/modificarFoto', 'multipart=true') ?>
 <?php endif; ?>


    <table class="tablanuevocurso">

    <table class="tabla_show_perfil">
    <tbody>


    <tr>
      <th>Foto</th>
      <td>  <?php echo input_file_tag('file') ?> </td>
    </tr>


        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
                <?php echo sexy_submit_tag('Guardar'); ?>
              </div>
        </td>
      </tr>
    </table>
    <div style='display:none;'><input type='submit' value='guardar'></div>
    </form>


    <!-- Capas AJAX -->
    <div id="guardar"></div>

</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
  <?php if(!$usuario->getInspector()): ?>  
    <?php echo image_tag('ico_p_endok.gif'); ?> Foto Guardada.
        <?php echo javascript_tag("
        //window.opener.location.reload();
        window.opener.document.cambio_info.submit();
        window.close();
            ") ?>
  <?php else: ?>
        <?php echo image_tag('ico_p_endok.gif'); ?> Foto Guardada.
        <?php echo javascript_tag("
        window.opener.location.reload();
        //window.opener.document.cambio_info.submit();
        window.close();
            ") ?>
  <?php endif; ?>  
<?php endif; ?>
