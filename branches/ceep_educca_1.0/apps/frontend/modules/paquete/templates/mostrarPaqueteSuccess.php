<?php use_helper('Text');?>
<div id="miscursos">
  <div class="tit_box_cursos"><h2 class="titbox"><?php echo $paquete->getNombre()?></h2></div>
  <div class="cont_box_grande">
    <div class="nombrescol">
        <table class="tablacursos">
              <tr>
                <th class="td1">Asignatura</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Unidades</th>
                <th class="td5">Horas</th>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tablacursos">
            <?php $i = 0; ?>
              <?php foreach($paquete_cursos as $curso): ?>
                 <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo;?>>
                  <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 40), 'curso/index?idcurso='.$curso->getIdCurso(),(array('id' => 'ln_mi_curso'.$i))) ?></td>
                  <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd-m-Y') ?></td>
                  <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd-m-Y') ?></td>
                  <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas(); ?></td>
                  <td class="td5"><?php echo $curso->getCurso()->getDuracion() ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
        </table>
    </div>
  </div>
  <div class="cierre_box_grande"></div>
</div>
<?php slot('columna_derecha') ?>
<?php include_component('paquete', 'ranking',array('idmodulo' => $paquete->getId())) ?>
<?php end_slot() ?>
