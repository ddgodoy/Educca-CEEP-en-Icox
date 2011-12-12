<?php use_helper('informacion') ?>

<div id="divplanificacion">
  <div class="tit_box_mensajes"><h2 class="titbox">Evaluacion <?echo $modulo->getNombre()?></h2></div>
      <div class="cont_box_correo">

          <div id="scrolldiv">
              <table  class="tablaplanificacion" border='0' style="overflow-y:auto;">
                    <tr class="tsupervcursos">
                      <th height="30px">Nombre</th>
                      <? foreach ($tareas_evaluacion as $tarea) :?>
                         <th><? echo $tarea->getTarea()->getEjercicio()->getTitulo().'<br>&nbsp; &nbsp;&nbsp;('.$tarea->getPeso().'%)' ?></th>
                      <?endforeach;?>
                      <th>Nota final</th>
                    </tr>


                    <?php $i = 0; ?>
                    <?php foreach($datos as $dato => $clave): ?>
                        <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                        <tr <?= $fondo1 ?>>
                            <td>
                            <?echo $dato?>
                            </td>
                            <?php $total_datos = sizeof($clave) - 1; ?>
                            <?php $j = 0; ?>
                            <?php foreach($clave as $nota): ?>
                                <td class="tdeval">
                                <?php if ($j == $total_datos) {echo '<strong>';} ?>
                                <?php if (-1!=$nota) : ?>
                                    <?php echo sprintf("%.2f", $nota);?>
                                <?php else : ?>
                                    <font color='red'>No entregado</font>
                                <?php endif ;?>
                                <?php if ($j == $total_datos) {echo '</strong>';} ?>
                                </td>
                                <?php $j++; ?>
                             <?php endforeach; ?>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
              </table>
           </div>

         <?php if ($i):?>
           <div class="totales_tabla">
             <br>Total: &nbsp;<?php echo $i; ?> alumno(s)
           </div>
         <?php endif;?>
      <br>

      <?php echoNotaInformativa('Ayuda', 'En esta tabla podr&aacute; ver las notas obtenidas por los alumnos en los ejercicios que se tuvieron en cuenta para la evaluaci&oacute;n del m&oacute;dulo y la media final seg&uacute;n los criterios de evaluaci&oacute;n establecidos en el apartado anterior.'); ?>
      <br><?php use_helper('volver');  echo volver(); ?>
   </div> <!-- cont_box_correo-->
  <div class="cierre_box_correo"></div>
</div>
