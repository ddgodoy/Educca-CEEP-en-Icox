<?php use_helper('Text','informacion') ?>
<?php if ($archivos ): ?>
     <div class="cursos">
       <div class="nombrescol">
        <table class="tablacursos" cellspacing="0" border='0' width='100%'>
              <tr>
                <th style="width:10%;">&nbsp;</th>
                <th style="width:20%;">Nombre</th>
                <th style="width:50%;">Descripci&oacute;n</th>
                <th style="width:10%;">Tama&ntilde;o</th>
                <th style="width:10%;">Opciones</th>
              </tr>
        </table>
      </div>
       
        <table class="tablacursos" cellspacing="0" cellpadding="0" border='0' width='100%'>
              <?php $i = 0;?>
              <?php foreach($archivos as $archivo): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo1 ?> valign='top'>
                    <td style="width:10%;padding-left:2px;">
                      <?php echo $archivo->getIcoTipo();?>
                    </td>
                    <td style="width:20%;padding-left:2px;" valign='middle'>  
                      <font id ="ln_biblioteca_archivo<?php echo $archivo->getIdCurso()?>"><?php echo truncate_text($archivo->getNombreFichero(), 35)?></font>
                    </td>
                    
                    <td style="width:50%;" valign='middle'>
                      <font <?php echo $archivo->overlib() ?> >
                      <?php echo truncate_text($archivo->getDescripcion(), 210) ?>
                      </font>
                    </td>
                    
                    <td style="width:10%;" valign='middle'><?php echo $archivo->getFileSize(); ?> KB</td>
                    
                    <td style="width:10%;" valign='middle'>
                            <?php echo $archivo->linkDonwnload(false); ?>   
                          <?php if ($user->hasCredential('profesor')) : ?>
                            <?php if(!$usuario->getInspector()): ?>
                                <?php echo link_to(image_tag('corregir.png'),'biblioteca_archivos/modificar?id='.$archivo->getId(),array( 'id'=>'modificar_biblioteca_archivos'.$archivo->getId(), 'title' => 'Modificar' ) ) ?>
                                <?php echo link_to(image_tag('papelera.gif'),'biblioteca_archivos/eliminar?id='.$archivo->getId(),array('confirm' =>'&iquest;Esta seguro que desea eliminar el '.$archivo->getNombre().' ?', 'id'=>'delete_biblioteca_archivos'.$archivo->getId(), 'title' => 'Eliminar' ) ) ?>
                            <?php endif; ?>     
                          <?php endif ?>
                    </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
    </div>
    <div class="cursos">
        <table class="tablacursos">
            <tr class="cont_fil">
                <td> <?php //echo image_tag('ayuda.png'); ?> </td>
            </tr>
        </table>
    </div>

<?php else : ?>
    <?php echoAvisoVacio("No hay ficheros en este curso");?>
<?php endif; ?>
