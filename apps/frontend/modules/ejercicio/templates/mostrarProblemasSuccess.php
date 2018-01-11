<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

<?php if ($ejercicio->getTipo() == 'problemas'):?>
  <?php if (!$cuestiones_practicas):?>
    <?php if ($rol == 'profesor'):?>
      <br><br>
      <h2>EL EJERCICIO EST&Aacute; VAC&Iacute;O </h2>
    <?php endif;?>
  <?php else:?>
  <?php if ($mostrar_edicion == 2):?>
    <br><br>
    <?php echoWarning('', 'Este ejercicio ya ha sido resuelto por alg&uacute;n alumno o est&aacute; asociado a alguna tarea o examen. En consecuencia no se podr&aacute;n a&ntilde;adir ni eliminar preguntas del mismo.'); ?>
  <?php endif;?>

  <br><br>
  <h2>EJERCICIO PR&Aacute;CTICO </h2>
<?php endif;?>

  <?php if ($mostrar_edicion == 1):?>
    <br><br>
    <form>
    <?php echo (input_hidden_tag('id_ejercicio', $ejercicio->getId())); ?>
    <?php echo submit_to_remote('ajax_submit','A&ntilde;adir problema', array('update' => 'cuestiones_practicas', 'url' => 'ejercicio/mostrarProblemas?add=1&mostrar_edicion=1')) ?>
    </form>
  <?php endif;?>

  <br><br>

  <table class="tabla_problemas">


  <?php if ($mostrar_solucion == 1):?>
  <tr><td class="tdp1">
    <div class="div_cuestion_practica" style="background: url(/images/fondofila_verde.gif) repeat;"><center>

      <?php $ruta = SF_ROOT_DIR.'/web/uploads/problemas/'; ?>

      <table class="tabla_upload_problemas">

        <tr height="35">
          <th style="width: 100%; text-align: center;">
            SOLUCI&Oacute;N DEL PROFESOR
          </th>
        </tr>

      <?php $max_hojas_respuesta = $ejercicio->getNumeroHojas(); ?>   
      <?php if(is_dir($ruta.'/'.$id_solucion_ejercicio.'/')): ?>  
          <?php 
                $var_ind = 0;
                $files = [];
                // Creamos un puntero al directorio y obtenemos el listado de archivos
                chdir($ruta.'/'.$id_solucion_ejercicio.'/');
                array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
                foreach($files as $archivo){
                    // Obviamos los archivos ocultos
                    if($archivo[0] == ".") continue;
                    if(!is_dir($ruta.'/'.$id_solucion_ejercicio.'/'.$archivo)) {
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
              <tr height="25">
                <?php if(!empty($res)): ?>  
                    <?php if (!file_exists($ruta.'/'.$id_solucion_ejercicio.'/'.$res[$i_hojas][$i_hojas]) || !key_exists($i_hojas, $res)):?>
                      <th style="width: 100%; text-align: center;">
                      (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?> de la soluci&oacute;n)
                      </th>
                    <?php else:?>
                      <th style="width: 100%; text-align: center;">
                        <?php $link_archivo = '/uploads/problemas/'.$id_solucion_ejercicio.'/'.$res[$i_hojas][$i_hojas]; ?>  
                        <u><a href="<?php echo $link_archivo; ?>" target="_blanck">Haga click aqu&iacute; para ver la hoja #<?php echo $i_hojas ?> de la soluci&oacute;n</a></u>  
                      </th>
                    <?php endif;?>
                <?php endif;?>  
              </tr>
          <?php endfor; ?>
      <?php else: ?>      
      <?php for($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++):?>

        <tr height="25">
          <?php if (file_exists($ruta.'respuesta_'.$id_solucion_ejercicio.'_'.$i_hojas.'.jpg')):?>
            <th style="width: 100%; text-align: center;">
              <u><?php echo link_to('Haga click aqu&iacute; para ver la hoja #'.$i_hojas.' de la soluci&oacute;n', 'ejercicio/mostrarImagen?ruta=respuesta_'.$id_solucion_ejercicio.'_'.$i_hojas, array('popup' => array('', 'toolbar=0,location=0,status=0,menubar=0,resizable=1,top=0,left=200'))) ?></u>
            </th>
          <?php else:?>
            <th style="width: 100%; text-align: center;">
            (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?> de la soluci&oacute;n)
            </th>
          <?php endif;?>
        </tr>

      <?php endfor;?>
      <?php endif;?>  

      </table>
      <br>
      </center>
    </div>
    <br><br><br>
  </td></tr>
  <?php endif;?>



  <?php if ($mostrar_respuestas == 1):?>
  <tr><td class="tdp1">
    <div class="div_cuestion_practica" style="background: url(/images/fondofila_azul.gif) repeat;"><center>

      <?php $ruta = SF_ROOT_DIR.'/web/uploads/problemas/'; ?>

      <table class="tabla_upload_problemas">

        <tr height="35">
          <th style="width: 100%; text-align: center;">
            RESPUESTAS DEL ALUMNO
          </th>
        </tr>

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
                               $archivo[0] => $archivo,
                            );
                        }    
                    }
                }
        ?>
        <?php for($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++):?>
            <tr height="25">
              <?php if (!file_exists($ruta.'/'.$id_respuesta_ejercicio.'/'.$res[$i_hojas][$i_hojas]) || !key_exists($i_hojas, $res)):?>
                <th style="width: 100%; text-align: center;">
                (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?> de la soluci&oacute;n)
                </th>
              <?php else:?>
                <th style="width: 100%; text-align: center;">
                  <?php $link_archivo = '/uploads/problemas/'.$id_respuesta_ejercicio.'/'.$res[$i_hojas][$i_hojas]; ?>  
                  <u><a href="<?php echo $link_archivo; ?>" target="_blanck">Haga click aqu&iacute; para ver la hoja #<?php echo $i_hojas ?> de respuestas</a></u>  
                </th>
              <?php endif;?>
            </tr>
        <?php endfor; ?>
        <?php else: ?>
            <?php for($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++):?>

            <tr height="25">
              <?php if (file_exists($ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg')):?>
                <th style="width: 100%; text-align: center;">
                  <u><?php echo link_to('Haga click aqu&iacute; para ver la hoja #'.$i_hojas.' de respuestas', 'ejercicio/mostrarImagen?ruta=respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas, array('popup' => array('', 'toolbar=0,location=0,status=0,menubar=0,resizable=1,top=0,left=200'))) ?></u>
                </th>
              <?php else:?>
                <th style="width: 100%; text-align: center;">
                (No se adjunt&oacute; la hoja #<?php echo $i_hojas ?> de respuestas)
                </th>
              <?php endif;?>
            </tr>

            <?php endfor; ?>
        <?php endif; ?>    

      </table>
      <br>
      </center>
    </div>
    <br><br><br>
  </td></tr>
  <?php endif;?>

<!--
  <?php if ($mostrar_respuestas == 2):?>
  <tr><td class="tdp1">
    <div class="div_cuestion_practica" style="background: url(/images/fondofila_azul.gif) repeat;"><center>
      <br>
      <?php echoNotaInformativaAjustada('', 'Para responder a este examen debe adjuntar las im&aacute;genes resultantes de escanear las hojas con los problemas resueltos a mano. El tama&ntilde;o m&aacute;ximo permitido por cada imagen es de <strong>300 kilobytes</strong> y s&oacute;lo se admitir&aacute;n im&aacute;genes en <strong>formato JPG</strong>. Para no subir ficheros demasiado grandes se recomienda tomar las im&aacute;genes en blanco y negro y utilizando un muestreo de <strong>150 ppp</strong>.'); ?>
      <div id="deletion_div" style="display: none;"></div>
      <?php $ruta = SF_ROOT_DIR.'/web/uploads/problemas/'; ?>
      <br>
      <table class="tabla_upload_problemas">


      <?php $max_hojas_respuesta = $ejercicio->getNumeroHojas(); ?>
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

      </table>
      <br>
      </center>
    </div>
    <br><br><br>
  </td></tr>
  <?php endif;?>
-->


  <?php $indice = 1; foreach($cuestiones_practicas as $cuestion_practica): ?>
    <tr><td class="tdp1">
      <?php if ($mostrar_edicion == 0):?>
        <?php echo("<div id=\"cuestion_practica$indice\" class=\"div_cuestion_practica\">");?>
        <?php include_partial('mostrarCuestionPractica', array('cuestion_practica' => $cuestion_practica, 'indice' => $indice, 'mostrar_edicion' => 0, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'mostrar_correccion' => $mostrar_correccion, 'id_respuesta_ejercicio' => $id_respuesta_ejercicio)) ?>
      <?php else:?>
        <?php echo form_remote_tag(array('update' => "cuestion_practica$indice", 'url' => 'ejercicio/editarCuestionPractica')) ?>
        <?php echo("<div id=\"cuestion_practica$indice\" class=\"div_cuestion_practica\">");?>
        <?php include_partial('mostrarCuestionPractica', array('cuestion_practica' => $cuestion_practica, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'mostrar_correccion' => 0)) ?>
        </form>
      <?php endif;?>
    <?php $indice++;?>
    </div>
    <br><br>
    </td></tr>
  <?php endforeach; ?>

  </table>

  <?php if ($cuestiones_practicas && (($mostrar_respuestas == 2) || ($mostrar_correccion == 2))):?>
    <?php {echo (input_hidden_tag('total_preguntas_practicas',$indice));}?>
  <?php endif;?>

<?php endif;?>
