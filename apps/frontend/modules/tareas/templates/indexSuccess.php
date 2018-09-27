<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Tareas y ex&aacute;menes</h2></div>
  <div class="contenido_principal">
      <table class="tablaopciones">
      <?php if ($rol == 'profesor'):?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_asignar.gif'), "/tareas/tareasExamenes$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Poner tareas y ex&aacute;menes', "/tareas/tareasExamenes$redireccion") ?></div>
            <div class="explicacion">Desde esta opci&oacute;n podr&aacute; poner un examen o mandar tareas a los alumnos. Tanto las tareas como los ex&aacute;menes llevar&aacute;n un ejercicio asociado que los alumnos deber&aacute;n realizar en una fecha en el caso del examen, o dentro de un plazo dado en el caso de la tarea. </div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>


        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_pendientes.gif'), "/tareas/cambiarTareas$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Cambiar o anular tareas y ex&aacute;menes', "/tareas/cambiarTareas$redireccion") ?></div>
            <div class="explicacion">Una vez que se ha puesto una tarea o un examen es posible anularlos, cambiar la fecha de realizaci&oacute;n o los plazos de entrega y a&ntilde;adir o quitar los alumnos que deben realizarla.</div>
          </td>
        </tr>
      <?php endif;?>



      <?php if ($rol == 'alumno'):?>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_asignar.gif'), "/tareas/tareasPendientes$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Tareas pendientes', "/tareas/tareasPendientes$redireccion") ?></div>
            <div class="explicacion">Desde aqu&iacute; podr&aacute; ver una lista de las tareas que le han ido mandando, el estado de las mismas y la fecha de entrega. Tambi&eacute;n podr&aacute; realizar estas tareas, retomar las que haya dejado a medias y entregar las que haya terminado.  </div>
          </td>
        </tr>

        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>


        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_estado.gif'), "/tareas/historialEntregas$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Historial de entregas', "/tareas/historialEntregas$redireccion") ?></div>
            <div class="explicacion">En este apartado se muestra un historial de las tareas y ex&aacute;menes entregados y tambi&eacute;n aquellos que perdi&oacute; la oportunidad de entregar.</div>
          </td>
        </tr>
      <?php endif;?>

      </table>
  </div>
  <div class="cierre_principal"></div>
</div>
