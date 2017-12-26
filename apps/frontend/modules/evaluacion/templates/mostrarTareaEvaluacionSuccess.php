<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"> Evaluaci&oacute;n y revisi&oacute;n</h2></div>
  <div class="contenido_principal">

      <div class="ejerciciosdet">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Ejercicio a realizar:</td>
                <td class='descripcion'><?php echo $evento->getDescripcion()?></td>
              </tr>
              <tr>
                <td class="titulo">Categor&iacute;a:</td>
                <td><?php echo $tipo_evento->getDescripcion() ?></td>
              </tr>
              <tr>
                <td class="titulo">Curso:</td>
                <td><?php echo($curso->getNombre());?></td>
              </tr>
              <tr>
                <?php if ($tipo_evento->getDescripcion() == 'Examen' || $tipo_evento->getDescripcion() == 'Examen sorpresa'):?>
                <td class="titulo">Fecha: </td>
                  <td><?php echo($evento->getFechaInicio('d-m-y').' de '.$evento->getFechaInicio('H:i').' a '.$evento->getFechaFin('H:i'));?></td>
                <?php else:?>
                <td class="titulo">Plazo de entrega: </td>
                  <td><?php echo('Del '.$evento->getFechaInicio('d-m-y').' a las '.$evento->getFechaInicio('H:i').' hasta el '.$evento->getFechaFin('d-m-y').' a las '.$evento->getFechaFin('H:i'));?></td>
                <?php endif;?>
              </tr>
            </table>
        </div>

        <?php if ($tipo_ejercicio == 'test'):?>
          <?php if ($solucion_test):?>
            <?php if ($solucion_incompleta):?>
              <br><br>
              <?php echoWarning('', 'Existe una soluci&oacute;n para este ejercicio de test pero es incompleta, faltan preguntas por responder. Para habilitar la correcci&oacute;n autom&aacute;tica la soluci&oacute;n del test debe responder todas las preguntas. Vaya al apartado "Edici&oacute;n de ejercicios" dentro del "Gestor de ejercicios" para completar la soluci&oacute;n.'); ?>
            <?php else:?>
              <br><br>
              <?php //echoNotaInformativa('Para corregir de forma autom&aacute;tica todos los tests haga click en este bot&oacute;n', ' '.button_to('Corregir todos los test', 'evaluacion/corregirTests?id_tarea='.$tarea->getId())); ?>
              <?php echo echoNotaInformativa('
                                          <table border=\'0\'>
                                          <tr>
                                            <td valign=\'middle\'>
                                            Para corregir de forma autom&aacute;tica todos los tests haga click en este bot&oacute;n',
                                            '</td>
                                             <td> '.link_to(image_tag('lists.png', array('alt' => 'Corregir todos los test', 'title' => 'Corregir todos los test')),
                                            'evaluacion/corregirTests?id_tarea='.$tarea->getId(),
                                         array( 'id' => 'b_corregir_test'))

                                          .'</td>
                                          </tr></table>'
                                        );  ?>

            <?php endif;?>
          <?php else:?>
            <br><br>
            <?php echoNotaInformativa('', 'Para habilitar la correcci&oacute;n autom&aacute;tica de los tests se debe crear antes una soluci&oacute;n para el mismo. Vaya al apartado "Edici&oacute;n de ejercicios" dentro del "Gestor de ejercicios" para crear una la soluci&oacute;n para el test. '); ?>
          <?php endif;?>
        <?php endif;?>

        <br><br>

        <?php if ($tipo_evento->getDescripcion() == 'Tarea'): ?>
          <h2>Alumnos que han entregado esta tarea: </h2>
        <?php else:?>
          <h2>Alumnos que han entregado este examen: </h2>
        <?php endif;?>

        <br>
        <div id="listado_ejercicios_entregados"></div>
        <?php echo javascript_tag(remote_function(array('update' => 'listado_ejercicios_entregados', 'url' => 'evaluacion/listarEjerciciosEntregados?id_tarea='.$tarea->getId().'&tipo_evento='.$tipo_evento->getDescripcion()))) ?>


      </div>
  </div>
  <div class="cierre_principal"></div>
</div>
