<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Evaluaci&oacute;n</h2></div>
  <div class="contenido_principal">

      <table class="tablaopciones">
      
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_pendientes.gif'), "/evaluacion/evaluacionRevision$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Evaluaci&oacute;n y revisi&oacute;n de ejercicios', "/evaluacion/evaluacionRevision$redireccion") ?></div>
            <div class="explicacion">Este apartado est&aacute; dedicado a la evaluaci&oacute;n de ejercicios o ex&aacute;menes entregados por los alumnos y a la revisi&oacute;n de los mismos. Se le mostrar&aacute; una lista de las tareas y ex&aacute;menes que tienen ejercicios pendientes de correcci&oacute;n o ejercicios ya corregidos que podr&aacute;n ser revisados y reevaluados.</div>
          </td>
        </tr>
        
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        
        
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_pendientes.gif'), "/evaluacion/calificaciones$redireccion") ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Calificaciones', "/evaluacion/calificaciones$redireccion") ?></div>
            <div class="explicacion">Le ofrece una visi&oacute;n global de las calificaciones obtenidas por los alumnos en las pruebas de un curso.</div>
          </td>
        </tr>
      
      </table>
  </div>
  <div class="cierre_principal"></div>
</div>
