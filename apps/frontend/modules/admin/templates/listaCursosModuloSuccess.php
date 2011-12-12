<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Lista de cursos para el modulo <? echo $modulo->getNombre() ?> </h2></div>
  <div class="cont_box_correo">

    <div class="nombrescol">
                   <table class="tadmincursos">
              <tr>
                <td class="td1">Nombre</td>
                <td class="td2">Inicio</td>
                <td class="td3">Fin</td>
                <td class="td4">Numero Temas</td>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos" cellspacing="0">
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>

                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($curso->getCurso()->getNombre(), 'admin/fichaCurso?idcurso='.$curso->getCurso()->getId()) ?></td>
                      <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></td>
                  </tr>
                  <?php $i++ ?>

              <?php endforeach; ?>
        </table>
    </div>
  </div>
  <div class="cierre_box_correo"></div>
</div>
