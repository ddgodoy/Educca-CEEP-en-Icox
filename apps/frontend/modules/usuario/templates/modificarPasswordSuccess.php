<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>
<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificacion de contraseña del usuario: <?php echo $usuario->getNombre()." ".$usuario->getApellidos()?></h2></div>
<div class="cont_box_grande">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'usuario/modificarPassword',
        'script' => true
    )) ?>
    <table class="tablanuevocurso">

    <table class="tabla_show_perfil">
    <tbody>


    <tr>
      <th>Contrase&ntilde;a:</th>
      <td><?php echo input_password_tag('pwd', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Nueva contrase&ntilde;a:</th>
      <td><?php echo input_password_tag('pwd1', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Repita contrase&ntilde;a:</th>
      <td><?php echo input_password_tag('pwd2', '','class=inputperfil') ?></td>
    </tr>
    <tr>

        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
                <?php echo sexy_submit_tag('Insertar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
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
  <?php echo image_tag('ico_p_endok.gif'); ?> La contrase&ntilde;a ha sido guardada correctamente.

  <?php
     //sleep(1);
     use_helper('javascriptAjax');
     echo cargaPagina('usuario/mostrarPerfil'); ?>

  <?php endif; ?>
