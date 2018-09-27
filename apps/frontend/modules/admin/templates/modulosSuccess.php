<?php use_helper('SexyButton') ?>
<div class="capa_principal" id="admin">
  <div class="tit_box_mensajes"><h2 class="titbox">M&oacute;dulos instalados en la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr><td>
        <?php echo sexy_button_to('Nuevo m&oacute;dulo','admin/nuevoModulo') ?>
        </td></tr>
       </table>
    </div>
    <div class="titulos_tabla_general">
        <table class="tadmin_modulos">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">N&ordm; Cursos</th>
                <th class="td5">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general_fixed">
        <table class="tadmin_modulos">
              <?php $i = 0; ?>
              <?php foreach($modulos as $modulo): ?>
                <?php if ($modulo->getNombre() != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($modulo->getNombre(), 'admin/fichaModulo?idmodulo='.$modulo->getId(), array('class' => 'a_explicito')) ?></td>
                      <td class="td2"><?php echo $modulo->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $modulo->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $modulo->countRel_paquete_cursos()  ?></td>
                      <td class="td5">
                      <?php echo link_to(image_tag('icon_edit.gif','Alt="Editar/modificar m&oacute;dulo" Title="Editar/modificar m&oacute;dulo" align=absmiddle'),'admin/modificarModulo?idmodulo='.$modulo->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('ico_alumnos_peq.gif',"Alt=\"Ver alumnos del m&oacute;dulo\" Title=\"Ver alumnos del m&oacute;dulo\" align=absmiddle"), 'admin/alumnos?idmodulo='.$modulo->getId()) ?>
                      &nbsp;&nbsp;<?php echo link_to(image_tag('papelera.gif','Alt="Eliminar m&oacute;dulo" Title="Eliminar m&oacute;dulo" align=absmiddle'),'admin/eliminarModulo?idmodulo='.$modulo->getId(),array('id'=>'eliminar_modulo'.$modulo->getId(),'confirm'=>'&iquest;Esta seguro que desea eliminar el '.$modulo->getNombre().' ?')) ?></td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>
              <?php endforeach; ?>

          <?php if (!$i):?>
            <tr>
              <td class="tdnoaviso">
              <br><br>
                <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
                  <span class="txtinfo">No hay ning&uacute;n m&oacute;dulo instalado en la plataforma</span>
              </td>
            </tr>
          <?php endif; ?>
        </table>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> m&oacute;dulo(s)
      </div>
    <?php endif;?>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('icon_edit.gif','Alt="Editar/modificar m&oacute;dulo" Title="Editar/modificar m&oacute;dulo"'); ?>
          </td>
          <td>
            Editar/modificar m&oacute;dulo
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('ico_alumnos_peq.gif','Alt=Ver alumnos del m&oacute;dulo Title=Ver alumnos del m&oacute;dulo'); ?>
          </td>
          <td>
            Alumnos del m&oacute;dulo
          </td>
          <td style="padding-left: 20px;">
            <?php echo image_tag('papelera.gif','Alt="Eliminar m&oacute;dulo" Title="Eliminar m&oacute;dulo"'); ?>
          </td>
          <td>
            Eliminar m&oacute;dulo
          </td>
        </tr>
      </table>
    </div>
    <br>
    <?php use_helper('informacion'); ?>
    <? echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de los m&oacute;dulos y podr&aacute; eliminar y crear m&oacute;dulos."); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
