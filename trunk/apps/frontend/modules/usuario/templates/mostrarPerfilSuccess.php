<?php use_helper('SexyButton') ?>
<?php $title = $usuario->getInspector() == 1?' (Inspector Educativo)':''; ?>
<div class="tit_box_calendario"><h2 class="titbox">Perfil de usuario<?php echo $title ?></h2></div>
<div class="cont_box_grande">
    <table class="tabla_show_perfil">
    <tbody>
    <tr>
    <th>DNI: </th>
    <td class="tdinfo"><?php echo $usuario->getDni() ?></td>
    </tr>
    <tr>
    <th>Usuario: </th>
    <td class="tdinfo"><?php echo $usuario->getNombreusuario() ?></td>
    </tr>
    <tr>
    <th>Nombre: </th>
    <td class="tdinfo"><?php echo $usuario->getNombre()." ".$usuario->getApellidos() ?></td>
    </tr>
    <tr>
    <th>E-mail: </th>
    <td class="tdinfo"><?php echo $usuario->getEmail() ?></td>
    </tr>
    <tr>
    <th>Recibir informaci&oacute;n: </th>
    <td class="tdinfo">  <?php if ($usuario->getEmailstop() == 1): ?>
            S&iacute;
           <?php else : ?>
           No
        <?php endif; ?>
     </td>
    </tr>
    <tr>
    <th>Telefono: </th>
    <td class="tdinfo"><?php echo $usuario->getTelefono1() ?></td>
    </tr>
    <tr>
    <th>Telefono m&oacute;vil: </th>
    <td class="tdinfo"><?php echo $usuario->getTelefono2() ?></td>
    </tr>
    <tr>
    <th>Instituci&oacute;n: </th>
    <td class="tdinfo"><?php echo $usuario->getInstitucion() ?></td>
    </tr>
    <tr>
    <th>Departamento: </th>
    <td class="tdinfo"><?php echo $usuario->getDepartamento() ?></td>
    </tr>
    <tr>
    <th>Direcci&oacute;n: </th>
    <td class="tdinfo"><?php echo $usuario->getDireccion() ?></td>
    </tr>
    <tr>
    <th>C&oacute;digo postal: </th>
    <td class="tdinfo"><?php echo $usuario->getCp() ?></td>
    </tr>
    <tr>
    <th>Ciudad: </th>
    <td class="tdinfo"><?php echo $usuario->getCiudad() ?></td>
    </tr>
    <tr>
    <th>Pa&iacute;s: </th>
    <td class="tdinfo"><?php if ($usuario->getPais()) { echo $usuario->getPais()->getNombre(); } ?></td>
    </tr>
    <tr>
    <th>&Uacute;ltimo acceso: </th>
    <td class="tdinfo"><?php echo $usuario->getUltimoacceso() ?></td>
    </tr>
    <tr>
    <th>&Uacute;ltima ip: </th>
    <td class="tdinfo"><?php echo $usuario->getUltimaip() ?></td>
    </tr>
    <tr>
    <th>Foto: </th>
    <td><?php echo ($usuario->getFoto())? image_tag("fotos_usuarios/".$usuario->getId()."_foto.jpg?rand=".rand(0,9999), 'Title=Foto, class=imgfotoperfil') : image_tag("fotos_usuarios/no_foto.jpg", "Title=Foto, class=imgfotoperfil"); ?></td>
    </tr>
    <tr>
    <th>Fecha de alta: </th>
    <td class="tdinfo"><?php echo $usuario->getCreatedAt("d/m/y") ?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td><br />
        <?php if (isset($idcurso)) : ?>
            <?php $redireccion = "&id=".$idcurso; ?>
        <?php else  : ?>
             <?php $redireccion = "" ; ?>
        <?php endif; ?>

               <?php if ($sf_user->hasCredential('administrador')) : ?>
                	<?php echo sexy_button_to('Modificar', 'usuario/editarPerfil?'.$redireccion.'&idusuario='.$usuario->getId()) ?>
        	     <?php else : ?>
        	        <?php if ($sf_user->getAnyId() == $usuario->getId()) : ?>
                          <?php echo sexy_button_to('Modificar', 'usuario/editarPerfil?'.$redireccion) ?>
                  <?php endif; ?>
        	     <?php endif; ?>
		</td>

    </tr>
    </tbody>
    </table>
    <br /><?php use_helper('volver');  echo volver(); ?>
</div>
<div class="cierre_box_grande"></div>