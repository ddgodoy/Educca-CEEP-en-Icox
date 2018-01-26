<?php use_helper('Javascript') ?>
	 <?php if (isset($idcurso)) : ?>
            <?php $redireccion = "&id=".$idcurso; ?>
        <?php else  : ?>
             <?php $redireccion = "" ; ?>
        <?php endif; ?>

<?php if (!isset($mostrarForm)) : ?>
<?php use_helper('SexyButton', 'Validation','Object') ?>
<div class="tit_box_calendario"><h2 class="titbox">Editar perfil</h2></div>
<div class="cont_box_grande">


    <div id="formEdit">
     <?php if ($sf_user->hasCredential('administrador')) : ?>
        	<?php $url = '?idusuario='.$usuario->getId() ?>
	     <?php else : ?>
	        <?php $url = '?' ?>
	     <?php endif; ?>


    <?php echo form_remote_tag(array(
                                      'update'   => 'capaAjax',
                                      'url'      => 'usuario/editarPerfil'.$url,
                                      'script' => true,
                                      'loading'  =>  visual_effect('appear', 'indicador'),
                                      'complete' =>  visual_effect('fade', 'indicador').
                                                     visual_effect('highlight', 'indicador'),
    	                               ),
    	                         array('name' => 'cambio_info')

    ) ?>

    <?php echo object_input_hidden_tag($usuario, 'getId') ?>

    <table class="tabla_show_perfil">
    <tbody>
    <?php if(!$usuario->getInspector() || $is_admin): ?>
    <tr>
      <th>DNI:</th>
      <td><?php echo object_input_tag($usuario, 'getDni', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <?php endif; ?>
    <tr>
      <th>Contrase&ntilde;a:</th>
      <td valign="middle">
                        <table>
                          <tr>
                            <td>*************</td>
                            <?php if ($sf_user->getAnyId() == $usuario->getId() || $is_admin) : ?>
                             <td><?php echo link_to(image_tag('b_modificar.gif'), 'usuario/modificarPassword?'.$redireccion) ?></td>
                            <?php endif; ?>
                          </tr>
                        </table>



	  	<?php //echo input_tag('pwd', '*************', array ('class' => 'inputperfil')) ?>

	  </td>
    </tr>
    <?php if(!$usuario->getInspector() || $is_admin): ?>
    <tr>
      <th>Nombre:</th>
      <td><?php echo object_input_tag($usuario, 'getNombre', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Apellidos:</th>
      <td><?php echo object_input_tag($usuario, 'getApellidos', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>E-mail:</th>
      <td><?php echo object_input_tag($usuario, 'getEmail', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Recibir informaci&oacute;n:</th>
      <td><?php
      echo select_tag('emailstop', options_for_select(array(
      '1'  => 'Si',
      '0'    => 'No'
    ), $selected), array (
      'class' => 'inputperfil')) ?>

    </td>
    </tr>
    <tr>
      <th>Telefono:</th>
      <td><?php echo object_input_tag($usuario, 'getTelefono1', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Telefono m&oacute;vil:</th>
      <td><?php echo object_input_tag($usuario, 'getTelefono2', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Instituci&oacute;n:</th>
      <td><?php echo object_input_tag($usuario, 'getInstitucion', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Departamento:</th>
      <td><?php echo object_input_tag($usuario, 'getDepartamento', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Direcci&oacute;n:</th>
      <td><?php echo object_input_tag($usuario, 'getDireccion', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>C&oacute;digo postal:</th>
      <td><?php echo object_input_tag($usuario, 'getCp', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Ciudad:</th>
      <td><?php echo object_input_tag($usuario, 'getCiudad', array (
      'class' => 'inputperfil'
    )) ?></td>
    </tr>
    <tr>
      <th>Pa&iacute;s:</th>
      <td><?php //echo object_input_tag($usuario, 'getPais', array (      'class' => 'inputperfil'    )) ?>

	<?php echo select_tag('pais', options_for_select($opcionesPais, $usuario->getPaisId())) ?>
	</td>
    </tr>
    <?php endif; ?>
    <tr>
      <th>Foto:</th>
      <td>
          <table border='0'>
            <tr>
              <td><?php echo ($usuario->getFoto())? image_tag('fotos_usuarios/'.$usuario->getId()."_foto.jpg", 'Title=Foto, class=imgfotoperfil') : image_tag("fotos_usuarios/no_foto.jpg", "Title=Foto, class=imgfotoperfil"); ?></td>
              <td valign="top">
                   <?php if ($sf_user->hasCredential('administrador')) : ?>
                    	<?php echo link_to(image_tag('b_modificar.gif'), 'usuario/modificarFoto?idusuario='.$usuario->getId(), array('popup' => array('', 'width=510,height=100,left=550,top=650'))) ?>
            	     <?php else : ?>
            	        <?php echo link_to(image_tag('b_modificar.gif'), 'usuario/modificarFoto', array('popup' => array('', 'width=510,height=100,left=550,top=650'))) ?>
            	     <?php endif; ?>
              </td>
            </tr>
          </table>
    	</td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
     <td>&nbsp;</td>
      <td>
           <center>
            <?php if ($sf_user->hasCredential('administrador')) : ?>
              	<?php echo sexy_button_to('Cancelar', 'usuario/mostrarPerfil?'.$redireccion.'&idusuario='.$usuario->getId()) ?>
      	     <?php else : ?>
      	        <?php echo sexy_button_to('Cancelar', 'usuario/mostrarPerfil?'.$redireccion) ?>
      	     <?php endif; ?>
             <?php if(!$usuario->getInspector()): ?>  
                <div id="trans" class="trans">
                 <?php echo sexy_submit_tag('Guardar',array('onmouseup'=>"bloqueaCapa('trans')")) ?>
                </div>
            <?php endif; ?>   
    	     </center>
    </td>
    </tr>
    </tbody>
    </table>

    </form>
    </div>

    <div id="capaAjax"></div>
    <div id="indicador" style="display: none">Procesando su petici&oacute;n...</div>
</div>
<div class="cierre_box_grande"></div>
<?php else : ?>
<?php use_helper('javascriptAjax') ?>
<?php echo image_tag('ico_p_endok.gif'); ?> Los datos se han guardado correctamente
<?php echo cargaPagina('usuario/mostrarPerfil',"idusuario=".$usuario->getId()) ?>
<?php endif; ?>


