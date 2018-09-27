<?php use_helper('Javascript','SexyButton', 'Validation') ?>

<div id="contenedor_ficha">
  <div class="tit_box_ficha"><h2 class="titbox">Acceso para invitados</h2></div>
  <div class="cont_box_grande">
    <table class="tablafichac">
      <tr>
        <td>
          <table class="tablaficha1">
            <tr>
              <td width="45"><?php echo image_tag('flecha_login.gif','Alt='); ?></td>
              <td class="tdtemas">
                <br />Si quiere probar la plataforma y ver los servicios y cursos que ofrecemos, es necesario rellenar este formulario.
                <br /><br />A continuaci&oacute;n, para que pueda acceder como invitado, le enviaremos por e-mail un nombre de usuario y una contrase&ntilde;a que deber&aacute; introducir en el cuadro "Alumnos inscritos" para entrar.
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="tddesc" align="center">
          <div id="formEdit">
            <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'formEdit',
                'url'=> 'comercial/invitados'));
            ?>

            <h2>Formulario para invitados</h2>
            <br />
            <table class="tabla_show_perfil" id="tabla_reg_perfil">
            <tbody>
            <tr>
              <th>Empresa:</th>
              <td><?php echo form_error('empresa') ?><?php echo input_tag('empresa', '', array (
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
              <th>Tel&eacute;fono:</th>
              <td><?php echo form_error('telefono') ?><?php echo input_tag('telefono', '', array (
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
              <th>&iquest;C&oacute;mo nos conoci&oacute;?</th>
              <td><?php
              echo select_tag('conocio', options_for_select(array(
              'Internet'  => 'Internet',
              'Un amigo o contacto'  => 'Un amigo o contacto',
              'Otros'    => 'Otros'
            )), array (
              'class' => 'inputperfil')) ?>

            </td>
            </tr>
            <tr>
                <td>Para evitar los registros abusivos escriba por favor los caracteres que aparecen en la imagen.</td>
                <td><br /><?php if($sf_user->getAttribute('captcha')): ?>
                	<img src="<?php echo url_for('sfCaptcha/index?key='.time()); ?>" />&nbsp;&nbsp;
                	<br /><?php echo form_error('captcha') ?><?php echo input_tag('captcha','','class=inputperfil'); ?>
                <?php else: ?>
                	There was an error validating your session. Captcha could not be created. <br />
                	Please reload this page or contact technical support.
                <?php endif; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><br><div id="trans" class="trans">
                   <?php echo sexy_submit_tag('Enviar') ?>
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
                 <?php echo link_to(image_tag('bot_volver.gif','Alt=Volver'), 'comercial/index') ?>
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
