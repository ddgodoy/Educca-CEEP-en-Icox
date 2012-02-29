<?php use_helper('Javascript','informacion') ?>

<div id="mensajes_recibidos">
        <div class="tit_box_mensajes">
          <h2 class="titbox">Evaluaci&oacute;n</h2>
        </div>
        <div class="cont_box_correo">
          <?echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; visualizar las calificaciones de todos los alumnos. Piche sobre el nombre del alumno y se desplegar&aacute; la ficha del alumno.')?>
        </div>
        <div class="cierre_box_correo"></div>
</div>


        <div id="div_oculto" style="display:none">
        <?php
          //para qs carguen las funciones necesarias de js
         echo link_to_function(
          '',
          visual_effect('appear', 'div_oculto')
        ) ?>
        </div>

        <?php echo javascript_tag("
        function mostrar(capa)
          {
            //document.getElementById(nomb_capa[capa])

            if (0==visible[capa])
            {  new Effect.Appear(capa, {});
            }
            else{  new Effect.Fade(capa, {});
                 }

            visible[capa] = (visible[capa] + 1) % 2;
          }
          var visible = Array();
        ") ?>


        <? foreach($alumnos as $alumno) :  ?>
          <?php echo javascript_tag("
            visible['ficha_".$alumno->getUsuario()->getId()."']= 0;") ?>
          <?php include_component('seguimiento', 'fichaEvaluacion',array('idcurso' => $idcurso, 'idalumno'=>$alumno->getUsuario()->getId())) ?>
        <? endforeach; ?>

