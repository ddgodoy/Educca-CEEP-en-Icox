<?php use_helper('informacion','SexyButton'); ?>
<div id="divplanificacion">


  <div class="tit_box_mensajes"><h2 class="titbox">Ranking <?echo $modulo->getNombre()?></h2></div>


  <div class="cont_box_correo">
      <div class="herramientas_general_fixed">
      <table cellspacing="0" cellpadding="0">
        <tr>
            <td>
            <?php echo sexy_button_to_remote('Enviar Ranking', array( 'update'   => 'guardar',
                                                                      'url'      => 'notificaciones/enviarRankingModulo?idmodulo='.$modulo->getId(),
                                                                      'script' => true,
            ))?>

            </td>
        </tr>
      </table>
    </div>
    <div id="guardar"></div><br>
<?php

use_helper('SwfChart');

$numAlumnos = $modulo->getNumeroAlumnos();

echo swf_chart("/seguimiento/sourceRanking?idmodulo=".$modulo->getId(), 700,($numAlumnos*25)+15);

echoNotaInformativa('Ayuda', "Desde este gr&aacute;fica podrá observar el ranking de los alumnos del <b>".$modulo->getNombre()."</b>. Las tareas no entregadas se contabilizaran con un 0 ");
?>
<br>
<?php
echoNotaInformativa('Ayuda', "Si pulsa el boton de 'Enviar ranking' se le enviara un email a cada alumno con el ranking");
?>


   </div>
    <div class="cierre_box_correo" ></div>
</div>
