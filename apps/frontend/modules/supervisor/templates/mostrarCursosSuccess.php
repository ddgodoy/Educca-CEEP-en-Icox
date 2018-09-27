<?php use_helper('SexyButton') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Cursos instalados en la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="nombrescol">
        <table class="tsupervcursos"  border='0'>
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Opciones</th>
              </tr>
        </table>
    </div>


    <div class="mostrarCursos">
        <table class="tmostrarCursos" cellspacing="0" border='0' >
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>
                <?php if ($curso->getNombre() != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($curso->getNombre(), 'supervisor/fichaCurso?idcurso='.$curso->getId()) ?></td>
                      <td class="td2"><?php echo $curso->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php /*echo link_to('Temas', 'supervisor/listaTemas?idcurso='.$curso->getId())*/ ?>
                          <?php echo link_to('Temas', 'supervisor/fichaCurso?idcurso='.$curso->getId().'&info=1' )?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Tareas', '/seguimiento/estadisticaCalificaciones?idcurso='.$curso->getId() )?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--?php echo link_to('Dudas', 'supervisor/dudas?idcurso='.$curso->getId()) ?-->
                          <?php echo link_to('Dudas','seguimiento/grafica?&tipo=dudas&idcurso='.$curso->getId()) ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Alumnos', 'supervisor/listaAlumnos?idcurso='.$curso->getId()) ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Profesores', 'supervisor/listaProfesores?idcurso='.$curso->getId()) ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Tripartita', 'supervisor/tripartita?idcurso='.$curso->getId(),array('popup' => array('', 'width=765,height=600,left=320,top=0,resizable=yes,scrollbars=yes'))) ?>
                      </td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>

              <?php endforeach; ?>
        </table>
     </div>
      <br>
      <?php use_helper('informacion') ?>
      <?echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a toda la informaci&oacute;n de un curso.')?>

   </div> <!-- cont_box_correo-->
  <div class="cierre_box_correo"></div>
</div>
