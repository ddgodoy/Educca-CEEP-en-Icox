<?php use_helper('Javascript') ?>
<?php use_helper('Text') ?>
<?php use_helper('SexyButton') ?>
<div id="bibliografia">
  <div class="tit_box_mensajes"><h2 class="titbox"><?= $curso->getNombre(120); ?></h2></div>
    <div class="cont_box_correo">
      <div class="titulos_tabla_general">
          <table class="tabla_libros" cellspacing="0">
                <tr>
                  <th class="td1">Nombre</th>
                  <th class="td2">Autor</th>
                  <th class="td3"><div class='editorial'>Editorial</div></th>
                  <th class="td4">A&ntilde;o</th>
                  <th class="td5">ISBN</th>
                  <?php if ($rol == 'profesor') : ?>
                    <?php if(!$usuario->getInspector()): ?>
                            <th class="td6">Opciones</th>
                    <?php endif; ?>                      
                  <?php endif;?>
                </tr>
          </table>
      </div>
      <div class="listado_tabla_general">
          <table class="tabla_libros" >
                <?php $i = 0; ?>
                <?php foreach($libros as $libro): ?>
                  <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo;?>>
                    <td class="td1"><?php echo $libro->getNombre() ?></td>
                    <td class="td2"><?php echo $libro->getAutor()?></td>
                    <td class="td3"><?php echo $libro->getEditorial()?></td>
                    <td class="td4"><?php echo $libro->getAnioPublicacion()?></td>
                    <td class="td5"><?php echo $libro->getIsbn()?></td>
                     <?php if ($rol == 'profesor') : ?>
                    <?php if(!$usuario->getInspector()): ?>
                    <td class="td6">
                    <?php echo link_to(image_tag('icon_edit.gif'),'curso/modificarLibro?idlibro='.$libro->getId()) ?>
                    | <?php echo link_to(image_tag('papelera.gif'),'curso/eliminarLibro?idlibro='.$libro->getId(),'confirm=&iquest;Esta seguro que desea eliminar el libro '.$libro->getNombre().' ?') ?>
                   	</td>
                   	<?php endif; ?>
                    <?php endif; ?>    
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
                <?php if ($i == 0) : ?>
                  <tr class="cont_fil">
                    <td colspan="5" class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?><span class="txtinfo">No hay libros propuestos.</span></td>
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
             <?php if(!$usuario->getInspector()): ?>
             <td><?php echo sexy_button_to('Nuevo libro', 'curso/nuevoLibro'.$redireccion); ?></td>
             <?php endif; ?>   
          </tr>
        </table>
        <?php else : ?>
          <?php echo volver(); ?>
        <?php endif;?>
    </div>
    <div class="cierre_box_correo"></div>
</div>
