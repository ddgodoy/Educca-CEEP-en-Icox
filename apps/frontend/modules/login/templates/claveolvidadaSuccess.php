<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Reestablecer contrase&ntilde;a</h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'login/claveolvidada' ),array('name' => 'folvido') ) ?>

    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="cursos">Email:</label></td>
        <td>
            <?php echo input_tag('email', '') ?>
		</td>
		<td rowspan="3" valign="top" style="padding:10px 20px 10px 20px;">
		Una nueva contrase&ntilde;a le ser&aacute; enviada a su direcci&oacute;n de email.
		</td>
      </tr>

      <tr>
        <td class="titulo"><label for="cursos">Dni:</label></td>
        <td>
            <?php echo input_tag('dni', '') ?>
		</td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
                 <?php echo sexy_submit_tag('Reestablecer',array('onmouseup'=>'bloqueaCapa()')); ?>
            </div>
		</td>
      </tr>
    </table>
    </form>

 <?php echo javascript_tag("
  function confirmar()
  {  // no funciona en explorer
    if (confirm('¿Esta seguro que desea cambiar el password de entrada?'))
       {bloqueaCapa();
       return true;}
    else return false;
  }
 ")
?>

    <!-- Capas AJAX -->
    <div id="guardar"></div>

</div>

<div class="cierre_box_grande"></div>
<? else : ?>
 <? /*$sf_Controller->redirect('admin/listaCursos?idusuario='.$idusuario.'&rol='.$rol);*/?>
 <?php echo image_tag('ico_p_endok.gif'); ?> Guardado
 <br><? //echo $pwd ;?>
<? endif; ?>
