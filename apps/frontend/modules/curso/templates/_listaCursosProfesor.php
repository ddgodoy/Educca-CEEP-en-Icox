<?php use_helper('Text'); ?>
<?php if ($cursos || $paquetes): ?>  
   <div class="tit_box_cursos"><h2 class="titbox">Mis Cursos</h2></div>
  <div class="cont_box_grande">
    <div class="nombrescol">
        <table class="tablacursos" cellspacing="0">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Temas<?php echo image_tag('ayuda.png'); ?></th>
                <th class="td5">Horas</th>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tablacursos" cellspacing="0">
              <?php $i = 0;?>
              <?php foreach($cursos as $curso): ?>
                <?php $fondo2 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                <tr class="cont_fil" <?= $fondo2 ?>>
                  <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 42), 'curso/index?idcurso='.$curso->getIdCurso(),(array('id' => 'ln_mi_curso'.$curso->getCurso()->getId()))) ?></td>
                  <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd-m-Y') ?></td>
                  <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd-m-Y') ?></td>
                  <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas() ?></td>
                  <td class="td5"><?php echo $curso->getCurso()->getDuracion() ?></td>
                </tr>
                <?php $i++ ?>
              <?php endforeach; ?>
        </table>
    </div>
    <div class="cursos">
        <table class="tablacursos">
            <tr class="cont_fil">
                <td> <?php echo image_tag('ayuda.png'); ?> N&uacute;mero de temas por curso o cursos por m&oacute;dulo.</td>
            </tr>
        </table>
    </div>

  </div>
  <div class="cierre_box_grande"></div>
  <?php endif;  ?>
