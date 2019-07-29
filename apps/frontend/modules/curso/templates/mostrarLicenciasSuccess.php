<?php use_helper('Javascript') ?>
<?php use_helper('Text') ?>
<?php use_helper('SexyButton') ?>
<div id="bibliografia">
  <div class="tit_box_mensajes"><h2 class="titbox">Cargar Licencias de <?= $curso->getNombre(120); ?></h2></div> 
   
   <!-- Licencias McGraw Hill -->
    <div class="cont_box_correo">
      <div class="titulos_tabla_general">
          <table class="tabla_libros" cellspacing="0">
                <tr>
                  <th class="td1">Nombre Usuario</th>
                  <th class="td2">Libro</th>
                  <th class="td3"><div class='editorial'>Licencia</div></th>
                  <th class="td5">Tipo de Licencia</th>
                  <th class="td6">Opciones</th>
                </tr>
          </table>
      </div>
      <div class="listado_tabla_general">
          <table class="tabla_libros" >                
                <?php if ($licencias > 0): ?>
                <?php $i = 0; ?>                
                <?php foreach($licencias as $licencia): ?>
                  <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo;?>>
                    <?php
                    $c = new Criteria();
                    $c->add(UsuarioPeer::ID, $licencia->getIdUsuario());                    
                    $usuario = UsuarioPeer::doSelectOne($c);                    
                    ?>
                    <td class="td1"><?php echo $usuario->getNombreusuario(); ?></td>
                    <td class="td2"><?php echo $licencia->getBook()?></td>
                    <td class="td3"><?php echo $licencia->getLicence()?></td>
                    <td class="td5"><?php echo $licencia->getType()?></td>
                    <td class="td6">
                    <?php if ($rol == 'profesor') : ?>
                    <?php echo link_to(image_tag('icon_edit.gif'),'curso/modificarLicencia?idlicencia='.$licencia->getId()) ?>
                    | <?php echo link_to(image_tag('papelera.gif'),'curso/eliminarLicencia?idlicencia='.$licencia->getId(),'confirm=&iquest;Esta seguro que desea eliminar la licencia '.$licencia->getBook().' ?') ?>
                   	</td>
                    <?php endif; ?>                    
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>                                
                <?php if ($licencias == 0): ?>
                  <tr class="cont_fil">
                    <td colspan="5" class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?><span class="txtinfo">No hay licencias activas.</span></td>
                  </tr>
                <?php endif; ?>                 
          </table>
      </div>
      <br />
      <?php use_helper('volver'); ?>

        <?php if ($rol == 'profesor') : ?>
                <?php if (isset($idcurso)) : ?>
					           <?php $redireccion = "?idcurso=".$idcurso; ?>
						    <?php else  : ?>
							       <?php $redireccion = "?" ; ?>
				        <?php endif; ?>
        <center>
        <table border='0' width='100%'>
          <tr>
            <td style="width: 300px;"><?php echo volver(); ?></td>          
            <td><?php echo sexy_button_to('Nueva Licencia', 'curso/nuevaLicencia'.$redireccion); ?></td>
          </tr>
        </table>
        <?php else : ?>
          <?php echo volver(); ?>
        <?php endif;?>
    </div>
    <div class="cierre_box_correo"></div>
    <!-- Fin Licencias McGraw Hill -->

    <!-- Licencias Sintesis -->
    <div class="cont_box_correo">
      <div class="titulos_tabla_general">
          <table class="tabla_libros" cellspacing="0">
                <tr>
                  <th class="td1">Titulo</th>
                  <th class="td2">Capitulo</th>                 
                </tr>
          </table>
      </div>
      <div class="listado_tabla_general">
          <table class="tabla_libros" >                
                <?php if ($sintesis > 0): ?>
                <?php $i = 0; ?>                
                <?php foreach($sintesis as $sintesi): ?>
                  <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo;?>>
                    <td class="td1"><?php echo $sintesi->getTitle() ?></td>
                    <td class="td2"><?php echo $sintesi->getCapitulo()?></td>
                    <td class="td6">
                    <?php if ($rol == 'profesor') : ?>
                <?php echo link_to(image_tag('icon_edit.gif'),'curso/modificarLicenciaSintesis?idlicenciasintesis='.$sintesi->getId()) ?>
                | <?php echo link_to(image_tag('papelera.gif'),'curso/eliminarLicenciaSintesis?idlicenciasintesis='.$sintesi->getId(),'confirm=&iquest;Esta seguro que desea eliminar la licencia '.$sintesi->getTitle().' ?' ,'curso/modificarLicenciaSintesis?idlicenciasintesis='.$sintesi->getId()) ?>
                    </td>
                    <?php endif; ?>                    
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>                                
                <?php if ($sintesis == 0): ?>
                  <tr class="cont_fil">
                    <td colspan="5" class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?><span class="txtinfo">No hay licencias sintesis activas.</span></td>
                  </tr>
                <?php endif; ?>                 
          </table>
      </div>
      <br />
      <?php use_helper('volver'); ?>

        <?php if ($rol == 'profesor') : ?>
                <?php if (isset($idcurso)) : ?>
                     <?php $redireccion = "?idcurso=".$idcurso; ?>
                <?php else  : ?>
                     <?php $redireccion = "?" ; ?>
                <?php endif; ?>
        <center>
        <table border='0' width='100%'>
          <tr>
             <td style="width: 300px;"><?php echo volver(); ?></td>          
             <td><?php echo sexy_button_to('Nueva Licencia Sintesis', 'curso/nuevaLicenciaSintesis'.$redireccion); ?></td>
          </tr>
        </table>
        <?php else : ?>
          <?php echo volver(); ?>
        <?php endif;?>
    </div>
    <div class="cierre_box_correo"></div>
    <!-- Fin Licencias Sintesis -->



</div>
