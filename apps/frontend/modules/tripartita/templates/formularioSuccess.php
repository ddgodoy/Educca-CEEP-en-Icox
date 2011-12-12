<?php use_helper('Javascript', 'SexyButton', 'Validation') ?>
<style type="text/css">
	.showError { color: #DF0000; }
	.tituloRelacionados { font-size: 12px; text-align: center; background-color: #E2E2E2; padding:5px; font-weight: bold; }
	.selectedCursos { width:480px; height:80px; }
</style>
<div class="tit_box_calendario"><h2 class="titbox"><?php echo ucfirst($sAction) ?> Supervisor Tripartita</h2></div>
<div class="cont_box_grande">
	<form method="POST" action="<?php echo url_for('tripartita/index') ?>" enctype="multipart/form-data">
		<table class="tabla_show_perfil">
	    <tr>
	      <th>USUARIO:</th><td>
	      	<?php if ($error_usuario): ?><div class="showError">! Ingrese el nombre de usuario</div><?php endif; ?>
	      	<?php echo input_tag('usuario', $nombreusuario, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>DNI:</th><td>
	      	<?php if ($error_dni): ?><div class="showError">! Ingrese el DNI</div><?php endif; ?>
	      	<?php echo input_tag('dni', $dni, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>Nombre:</th><td>
	      	<?php if ($error_nombre): ?><div class="showError">! Ingrese el nombre</div><?php endif; ?>
	      	<?php echo input_tag('nombre', $nombre, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>Apellidos:</th><td>
	      	<?php if ($error_apellidos): ?><div class="showError">! Ingrese los apellidos</div><?php endif; ?>
	      	<?php echo input_tag('apellidos', $apellidos, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>E-mail:</th><td>
	      	<?php if ($error_email): ?><div class="showError">! Ingrese el email</div><?php endif; ?>
	      	<?php echo input_tag('email', $email, 'class=inputperfil')?>
	      </td>
	    </tr>
	    <tr>
	     <th>Confirmar e-mail:</th>
	     <td><?php echo input_tag('email2', $email, 'class=inputperfil') ?></td>
	    </tr>
	    <tr>
	      <th>Recibir informaci&oacute;n:</th>
	      <td><?php echo select_tag('emailstop', options_for_select(array('1'=>'Si', '0'=>'No'), $emailstop), array ('class' => 'inputperfil')) ?>
	    </td>
	    </tr>
	    <tr>
	      <th>Tel&eacute;fono:</th><td>
	      	<?php if ($error_telefono1): ?><div class="showError">! Ingrese el tel&eacute;fono</div><?php endif; ?>
	      	<?php echo input_tag('telefono', $telefono1, 'class=inputperfil')?>
	      </td>
	    </tr>
	    <tr>
	      <th>Telefono m&oacute;vil:</th>
	      <td><?php echo input_tag('telefono2', $telefono2, 'class=inputperfil')?></td>
	    </tr>
	    <tr>
	      <th>Instituci&oacute;n:</th>
	      <td><?php echo input_tag('institucion', $institucion, 'class=inputperfil')?></td>
	    </tr>
	    <tr>
	      <th>Departamento:</th>
	      <td><?php echo input_tag('departamento', $departamento, 'class=inputperfil')?></td>
	    </tr>
	    <tr>
	      <th>Direcci&oacute;n:</th><td>
	      	<?php if ($error_direccion): ?><div class="showError">! Ingrese la direcci&oacute;n</div><?php endif; ?>
	      	<?php echo input_tag('direccion', $direccion, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>C&oacute;digo postal:</th><td>
	      	<?php if ($error_cp): ?><div class="showError">! Ingrese el c&oacute;digo postal</div><?php endif; ?>
	      	<?php echo input_tag('cp', $cp, 'class=inputperfil')?>
	      </td>
	    </tr>
	    <tr>
	      <th>Ciudad:</th><td>
	      	<?php if ($error_ciudad): ?><div class="showError">! Ingrese la ciudad</div><?php endif; ?>
	      	<?php echo input_tag('ciudad', $ciudad, 'class=inputperfil') ?>
	      </td>
	    </tr>
	    <tr>
	      <th>Pa&iacute;s:</th>
	      <td><?php echo form_error('pais') ?><?php echo select_tag('pais', options_for_select($aPaises, $pais), "class=selectpais") ?>
	      </td>
	    </tr>
		</table>
		<table border="0" width="98%">
			<tr><td height="5"></td></tr>
			<tr><td class="tituloRelacionados">Cursos relacionados</td></tr>
			<tr>
				<td>
					<?php echo select_tag('cursos_rel', options_for_select($aCursos, $userCursos), array('class'=>'selectedCursos', 'multiple'=>true)) ?>
				</td>
			</tr>
		</table>
		<center>
	    <br />
	    <table><tr><td>
	    	<?php echo sexy_submit_tag(ucfirst($sAction).' Supervisor'); ?>
	    	<input type="hidden" value="<?php echo $user_id ?>" name="user_id"/>
	    </td></tr></table>
		</center>
	</form>
	<br /><?php use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>