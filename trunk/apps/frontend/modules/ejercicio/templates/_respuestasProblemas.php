<?php use_helper('informacion') ?>
<table class="tabla_problemas">
  <tr><td class="tdp1">
    <br>
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
    <br>
  </td></tr>
</table>
<?php
      $total_preguntas = $ejercicio->countCuestion_practicas()+1;
      echo input_hidden_tag('total_preguntas_practicas', $total_preguntas);
?>