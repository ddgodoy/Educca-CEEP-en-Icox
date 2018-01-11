<?php use_helper('informacion') ?>
<table class="tabla_problemas">
  <tr><td class="tdp1">
    <br>
    <div class="div_cuestion_practica" style="background: url(/images/fondofila_azul.gif) repeat;"><center>
      <br>
      <?php echoNotaInformativaAjustada('', 'Para responder a este examen debe adjuntar fichero de <strong>Word, Excel, PowerPoint, PDF o Imágenes JPG</strong>. El tamaño máximo permitido del fichero es de <strong>2 Mb</strong>. Puede adjuntar un segundo fichero si el primero no es suficiente..'); ?>
      <div id="deletion_div" style="display: none;"></div>
      <?php $ruta = SF_ROOT_DIR.'/web/uploads/problemas/'; ?>
      <br>
      <table class="tabla_upload_problemas">    
      <?php $max_hojas_respuesta = $ejercicio->getNumeroHojas(); ?>
      <?php if(file_exists($ruta.'/'.$id_respuesta_ejercicio.'/')): ?> 
          <?php 
                $var_ind = 0;
                // Creamos un puntero al directorio y obtenemos el listado de archivos
                chdir($ruta.'/'.$id_respuesta_ejercicio.'/');
                array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
                foreach($files as $archivo){
                    // Obviamos los archivos ocultos
                    if($archivo[0] == ".") continue;
                    if(!is_dir($ruta.'/'.$id_respuesta_ejercicio.'/'.$archivo)) {
                        if($var_ind != $archivo[0]){
                            $var_ind = $archivo[0]; 
                            $res[$archivo[0]] = array(
                               $archivo[0] =>$archivo,
                            );
                        }    
                    }
                }
          ?>
          <?php for($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++):?>
            <tr>
              
                <?php if (!file_exists($ruta.'/'.$id_respuesta_ejercicio.'/'.$res[$i_hojas][$i_hojas]) || !key_exists($i_hojas, $res)):?>
                        <td class="td1">
                          (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?>)
                        </td>
                        <th class="td2">
                          Adjuntar hoja de respuestas #<?php echo $i_hojas ?>
                        </th>
                        <td class="td3">
                          <input type="file" name="upfile<?php echo $i_hojas ?>" id="upfile<?php echo $i_hojas ?>" class="file_input">
                        </td>
                        <td class="tdespacio">&nbsp;</td>
                <?php else: ?>
                        <?php $link_archivo = '/uploads/problemas/'.$id_respuesta_ejercicio.'/'.$res[$i_hojas][$i_hojas]; ?>  
                        <th class="td1">
                          <u><a href="<?php echo $link_archivo; ?>" target="_blanck">Ver la hoja de respuestas #<?php echo $i_hojas ?></a></u>
                        </th>
                        <th class="td2">
                          Cambiar hoja de respuestas #<?php echo $i_hojas ?>
                        </th>
                        <td class="td3">
                          <input type="file" name="upfile<?php echo $i_hojas ?>" id="upfile<?php echo $i_hojas ?>" class="file_input">
                        </td>
                        <td class="tdespacio">
                          <a href="javascript:void(0)" onclick="borrar_upload('<?php echo '/web/uploads/problemas/'.$id_respuesta_ejercicio.'/'.$res[$i_hojas][$i_hojas] ?>')"><?php echo image_tag('ico_borrar.gif','title=Borrar hoja de respuestas '.$i_hojas); ?></a>
                        </td>
                <?php endif;?> 
                      
          <?php endfor; ?>
      <?php else: ?>    
        <?php for($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++):?>
          <tr>
            <?php if (file_exists($ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg')):?>
              <th class="td1">
                <u><?php echo link_to('Ver la hoja de respuestas #'.$i_hojas, 'ejercicio/mostrarImagen?ruta=respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas, array('popup' => array('', 'toolbar=0,location=0,status=0,menubar=0,resizable=1,top=0,left=200'))) ?></u>
              </th>
              <th class="td2">
                Cambiar hoja de respuestas #<?php echo $i_hojas ?>
              </th>
              <td class="td3">
                <input type="file" name="upfile<?php echo $i_hojas ?>" id="upfile<?php echo $i_hojas ?>" class="file_input">
              </td>
              <td class="tdespacio">
                <a href="javascript:void(0)" onclick="borrar_upload('<?php echo $id_respuesta_ejercicio?>_<?php echo $i_hojas?>')"><?php echo image_tag('ico_borrar.gif','title=Borrar hoja de respuestas '.$i_hojas); ?></a>
              </td>
            <?php else:?>
              <td class="td1">
                (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?>)
              </td>
              <th class="td2">
                Adjuntar hoja de respuestas #<?php echo $i_hojas ?>
              </th>
              <td class="td3">
                <input type="file" name="upfile<?php echo $i_hojas ?>" id="upfile<?php echo $i_hojas ?>" class="file_input">
              </td>
              <td class="tdespacio">&nbsp;</td>
            <?php endif;?>
          </tr>

      <?php endfor; ?>
     <?php endif; ?>     

      </table>
      <br>
      </center>
    </div>
    <br>
  </td></tr>
</table>
<?php
      $total_preguntas = $ejercicio->countCuestion_practicas()+1;
      echo input_hidden_tag('total_preguntas_practicas', $total_preguntas);
?>