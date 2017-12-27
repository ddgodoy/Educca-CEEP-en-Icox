<?php use_helper('SexyButton') ?>
<?php use_helper('informacion'); ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Materias instaladas en la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="herramientas_general_fixed">
       <table cellpadding="0" cellspacing="0">
        <tr><td>
        <?php echo sexy_button_to('Nueva materia','admin/editMateria',array('name' =>'nueva')) ?>
        </td></tr>
       </table>
    </div>
    <div class="nombrescol" style="width: 100%;">
        <table class="tadmincursos">
              <tr>
                <th style="text-align: left; width: 70%; padding-left: 4px;">Nombre</th>
                <th style="text-align: center; width: 15%;">N&ordm; temas</th>
                <th style="text-align: center; width: 15%;">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos">
              <?php $i = 0; ?>
              <?php foreach($materias as $materia): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td style="text-align: left; width: 70%; padding-left: 4px;"><?php echo link_to($materia->getNombre(), 'admin/editMateria?idmateria='.$materia->getId()) ?></td>
                      <td style="text-align: center; width: 15%;"><?php echo $materia->getNumeroTemas() ?></td>
                      <td style="text-align: center; width: 15%;"><?php echo link_to(image_tag('icon_edit.gif','Alt=Editar/Modificar esta materia Title=Editar/Modificar esta materia align=absmiddle'), 'admin/editMateria?idmateria='.$materia->getId(),array('id'=>'ln_edit_materia'.$materia->getId())) ?>&nbsp;&nbsp;&nbsp;<?php echo link_to(image_tag('papelera.gif','Alt=Eliminar materia Title=Eliminar materia align=absmiddle'),'admin/eliminarMateria?idmateria='.$materia->getId(),'confirm=&iquest;Esta seguro que desea eliminar la materia '.$materia->getNombre().' ? id=ln_borrar_materia'.$materia->getId()) ?></td>
                  </tr>
                  <?php $i++ ?>

              <?php endforeach; ?>
        </table>
      <?php if (!$i):?>
        <?php echoAvisoVacio('No hay materias instaladas en la plataforma');?>
      <?php endif;?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> materia(s)
      </div>
    <?php endif;?>
    <div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; background-color:#F8FFF8;">
      <table>
        <tr>
          <td style="padding-left: 4px;">
            <?php echo image_tag('icon_edit.gif','Alt=Editar/modificar materia Title=Editar/modificar materia'); ?>
          </td>
          <td>
            Editar/modificar materia
          </td>
          <td style="padding-left: 18px;">
            <?php echo image_tag('papelera.gif','Alt=Eliminar materia Title=Eliminar materia'); ?>
          </td>
          <td>
            Eliminar materia
          </td>
        </tr>
      </table>
    </div>
       <br>

    <?php echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la informaci&oacute;n de las materias y podr&aacute; eliminar y crear materias."); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
