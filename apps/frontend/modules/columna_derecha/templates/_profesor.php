<?php use_helper('SexyButton') ?>
<div id="miperfil">
    <div class="tit_box_perfil"><h2 class="titbox"><?php if(!$profesor->getInspector()): ?> Perfil de Profesor <?php else: ?> Perfil del Inspector <?php endif; ?></h2></div>
    <div class="cont_box_pequeno">
      <table class="cont_peq_tabl">
        <tr class="cont_fil">
          <td class="celda_perfil_izq">
             <table class="tabladatosperfil">
                <tr>
                    <td class="datostitulo">Datos personales:</td>
                </tr>
                <tr>
                    <td class="datosperfil"><?php echo $profesor->getNombre() .' '.$profesor->getApellidos() ?></td>
                </tr>
                <?php if(!$profesor->getInspector()): ?>
                <tr>
                    <td class="datosperfil">DNI: <?php echo $profesor->getDni() ?></td>
                </tr>
                <tr>
                    <td class="datosperfil">&nbsp;</td>
                </tr>
				<tr>
                    <td class="datosperfil">Fecha Alta: <?php echo $profesor->getCreatedAt("d / m / Y")?></td>
                </tr>
                <?php endif; ?>
             </table>
          </td>
          <td class="celda_perfil_der">
             <table class="tablafotoperfil">
                <tr>
                    <td class="fotoperfil"><?php echo ($profesor->getFoto())? image_tag("fotos_usuarios/".$profesor->getId()."_foto.jpg", 'Title=Foto, class=imgfotoperfil') : image_tag("fotos_usuarios/no_foto.jpg", "Title=Foto, class=imgfotoperfil"); ?></td>
                </tr>
                <tr>
                    <td class="boton_modificar_perfil">
						<?php if (isset($idcurso)) : ?>
					        <?php $redireccion = "?id=".$idcurso; ?>
						<?php else  : ?>
							<?php $redireccion = "" ; ?>
						<?php endif; ?>
						<?php echo sexy_button_to('Modificar', 'usuario/mostrarPerfil'.$redireccion) ?>
					</td>
                </tr>
             </table>
          </td>
        </tr>
      </table>
    </div>
    <div class="cierre_box_pequeno"></div>
</div>
