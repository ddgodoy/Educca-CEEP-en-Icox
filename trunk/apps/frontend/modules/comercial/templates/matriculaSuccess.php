<?php use_helper('Javascript','SexyButton', 'Validation') ?>

<?php if (isset($modulo)) {
  $titulo = $modulo->getNombre();
  $tag = input_hidden_tag('idmodulo', $modulo->getId());
  $volver = 'comercial/ficha?idmodulo='.$modulo->getId();
} else if (isset($curso)) {
  $titulo = $curso->getNombre();
  $tag = input_hidden_tag('idcurso', $curso->getId());
  $volver = 'comercial/ficha?idcurso='.$curso->getId();
}
?>
<div id="contenedor_ficha">
  <div class="tit_box_ficha"><h2 class="titbox">Matr&iacute;cula <?= $titulo ?></h2></div>
  <div class="cont_box_grande">
    <table class="tablafichac">
      <tr>
        <td>
          <table class="tablaficha1">
            <tr>
              <td width="45"><?php echo image_tag('flecha_login.gif','Alt='); ?></td>
              <td class="tdtemas">
                <br />Si eres un usuario registrado introduce tus datos en el cuadro
                de "Alumnos inscritos" y pulsa en Entrar. Una vez dentro de la plataforma selecciona el men&uacute; e-cursos
                para ver el cat&aacute;logo de cursos y matricularte.<br/><br/>
                Si a&uacute;n no eres un usuario registrado rellena el formulario que aparece a continuaci&oacute;n:
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="tddesc" align="center">
          <div id="formEdit">
            <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'formEdit',
                'url'=> 'comercial/matricula'));
            ?>
            <?php echo $tag ?>
            <h2>Nuevo alumno</h2>
            <br/>
            <table class="tabla_show_perfil" id="tabla_reg_perfil">
            <tbody>
            <tr>
              <th>Nombre de usuario:</th>
              <td><?php echo form_error('usuario') ?><?php echo input_tag('usuario', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>DNI (n&uacute;mero y letra):</th>
              <td><?php echo form_error('dni') ?><?php echo input_tag('dni', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Nombre:</th>
              <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Apellidos:</th>
              <td><?php echo form_error('apellidos') ?><?php echo input_tag('apellidos', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>E-mail:</th>
              <td><?php echo form_error('email') ?><?php echo input_tag('email', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Confirmar e-mail:</th>
              <td><?php echo form_error('email2') ?><?php echo input_tag('email2', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Recibir informaci&oacute;n:</th>
              <td><?php
              echo select_tag('emailstop', options_for_select(array(
              '1'  => 'Si',
              '0'    => 'No'
            )), array (
              'class' => 'inputperfil')) ?>

            </td>
            </tr>
            <tr>
              <th>Tel&eacute;fono:</th>
              <td><?php echo form_error('telefono') ?><?php echo input_tag('telefono', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Direcci&oacute;n:</th>
              <td><?php echo form_error('direccion') ?><?php echo input_tag('direccion', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>C&oacute;digo postal:</th>
              <td><?php echo form_error('cp') ?><?php echo input_tag('cp', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Ciudad:</th>
              <td><?php echo form_error('ciudad') ?><?php echo input_tag('ciudad', '', array (
              'class' => 'inputperfil'
            )) ?></td>
            </tr>
            <tr>
              <th>Pa&iacute;s:</th>
              <td><?php echo form_error('pais') ?><?php echo select_tag('pais', options_for_select($opcionesPais, '73'), "class=selectpais") ?></td>
            </tr>
            <tr>
                <td>Para evitar los registros abusivos escriba por favor los caracteres que aparecen en la imagen.</td>
                <td><br/><?php if($sf_user->getAttribute('captcha')): ?>
                	<img src="<?php echo url_for('sfCaptcha/index?key='.time()); ?>" />&nbsp;&nbsp;
                	<br/><?php echo form_error('captcha') ?><?php echo input_tag('captcha','','class=inputperfil'); ?>
                <?php else: ?>
                	There was an error validating your session. Captcha could not be created. <br />
                	Please reload this page or contact technical support.
                <?php endif; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="trans" class="trans">
                   <?php echo sexy_submit_tag('&iexcl;Matric&uacute;late!') ?>
                  </div>
              </td>
            </tr>
            </tbody>
            </table>
            </form>
          </div>
        </td>
      </tr>
      <tr>
        <td class="tdmatricula">
          <table width="100%">
            <tr>
              <td style="text-align:left; vertical-align:bottom;">
                 <?php echo link_to(image_tag('bot_volver.gif','Alt=Volver'), $volver) ?>
              </td>
              <td style="text-align:right;">
                &nbsp;
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div class="cierre_box_grande"></div>
</div>
<?php slot('columna_derecha') ?>
    <?php include_component('columna_derecha', 'oferta'); ?>
<?php end_slot(); ?>
