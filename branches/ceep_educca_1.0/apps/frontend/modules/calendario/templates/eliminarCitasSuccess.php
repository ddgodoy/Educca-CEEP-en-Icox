<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Eliminar Eventos</h2></div>
  <div class="cont_box_correo">
    <div class="nombrescol">
        <table class="tadmincursos">
              <tr>
                <td class="td2">Titulo</td>
                <td class="td3">Inicio</td>
                <td class="td4">Fin</td>
                <td class="td5">Destinatario</td>
                <td class="td6">Descripcion</td>
                <td class="td7">Opciones</td>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos" cellspacing="0">
              <?php $i = 0; ?>
              <?php foreach($eventos as $evento): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td2"><?php echo $evento->getEvento()->getTitulo() ?></td>
                      <td class="td3"><?php echo $evento->getEvento()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $evento->getEvento()->getFechaFin($format = 'd/m/Y')?></td>
                      <td class="td5"><?php echo $evento->getEvento()->getTipo_cita()->getDescripcion()?></td>
                      <td class="td6"><?php echo $evento->getEvento()->getDescripcion() ?></td>
                      <td class="td7"><?php if (isset($idcurso)) : ?>
                                                 <? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getEvento()->getId().'&idcurso='.$idcurso,'confirm=¿Esta seguro que desea eliminar la cita '.$evento->getEvento()->getTitulo().' ?') ?>
                                      <?php else : ?>
												<? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getEvento()->getId().'&principal='.$principal,'confirm=¿Esta seguro que desea eliminar la cita '.$evento->getEvento()->getTitulo().' ?') ?>
									  <? endif; ?>
					  </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
    </div>
  </div>
  <div class="cierre_box_correo"></div>
</div>