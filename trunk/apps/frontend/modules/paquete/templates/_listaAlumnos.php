<?php use_helper('SexyButton') ?>

<div id="divadmin">
<?if (isset($curso)) : ?>
  <div class="tit_box_mensajes"><h2 class="titbox">Alumnos del Curso: <?echo $curso->getNombre()?> en el <?echo $modulo->getNombre()?></h2></div>
  <div class="cont_box_correo">
    <div class="herramientas">
        <table>
        <tr>
           <td>
		       <?php //echo sexy_button_to('Buscar','supervisor/buscar?rol=alumno&idcurso='.$curso->getId()) ?>
		       </td>
        </tr>
        <tr><td>Numero de alumnos en el curso: <?echo $modulo->getNumeroAlumnos()?></td></tr>
        </table>
    </div>


    <div class="nombrescol">
        <table class="tnombreslistalumnos" border='0'>
              <tr>
                <td class="td8">Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="td2">Usuario</td>
                <td class="td3">% teoria</td>
                <td class="td3">% Ejercicios</td>
                <td class="td3">Tiempo Total&nbsp;</td>
                <td class="td4">Opciones&nbsp;&nbsp;&nbsp;&nbsp;<? echo link_to('Estados','seguimiento/sourceHitos?idcurso='.$curso->getId())?>&nbsp;&nbsp;&nbsp;&nbsp;<? echo link_to('Temas','seguimiento/seguimientoPorTemas?idcurso='.$curso->getId())?></td>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tlistalumnos" cellspacing="0" border='0' >
              <?php $i = 0; ?>
              <?php foreach($alumnos as $alumno): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getUsuario()->getId()) ?></td>
                      <td class="td2"><?php echo $alumno->getUsuario()->getNombreusuario() ?></td>
                      <? $tiempos = $alumno->getUsuario()->tiemposDedicados($curso->getId());        ?>
                      <?php if ($tiempos[0]+$tiempos[1]!=0) :?>
                      <?php use_helper('tiempo') ?>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo floor(($tiempos[0]/($tiempos[0]+$tiempos[1]))*100)?>%</center></td>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo floor(($tiempos[1]/($tiempos[0]+$tiempos[1]))*100)?>%</td>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;<?php echoTiempo($tiempos[0]+$tiempos[1])?>&nbsp;</td>
                      <? else :?>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;0%</td>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0%</td>
                        <td class="td3">&nbsp;&nbsp;&nbsp;&nbsp;00:00:00&nbsp;</td>
                      <? endif; ?>
                      <td class="td4"><?php echo link_to('Tiempos','seguimiento/grafica?idusuario='.$alumno->getUsuario()->getId().'&tipo=alumno&idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--td class="td4"--><?php echo link_to('Estados','seguimiento/sourceHitos?idusuario='.$alumno->getUsuario()->getId().'&idcurso='.$curso->getId()) ?>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--td class="td4"--><?php echo link_to('Temas','seguimiento/seguimientoPorTemas?idusuario='.$alumno->getUsuario()->getId().'&idcurso='.$curso->getId()) ?></td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>

<? else : ?>
<div class="tit_box_mensajes"><h2 class="titbox">Alumnos del la plataforma</h2></div>
  <div class="cont_box_correo">
    <div class="herramientas">

        <table>
        <tr>
           <td>
		       <?php echo sexy_button_to('Buscar','supervisor/buscar?rol=alumno') ?>
		   </td>
        </tr>
        <tr><td>Numero de alumnos : <?echo count($alumnos)?></td></tr>
        </table>
    </div>

    <div class="nombrescol">
         <table class="tnombreslistalumnos" border='0'>
              <tr>
                <td class="td5">Nombre</td>
                <td class="td6">Usuario</td>
                <td class="td7">Cursos</td>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadminalumnos" cellspacing="0" border='0'>
              <?php $i = 0; ?>
              <?php foreach($alumnos as $alumno): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td6"><?php echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getUsuario()->getId()) ?></td>
                      <td class="td7"><?php echo $alumno->getUsuario()->getNombreusuario() ?></td>
                      <td class="td8"><?php echo link_to('lista de cursos','supervisor/listaCursos?idusuario='.$alumno->getUsuario()->getId().'&rol=alumno') ?></td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>

<? endif; ?>

    </div>
   <br>
   <?php use_helper('informacion') ?>
   <?echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n de los alumnos, y observar sus progresos')?>

  </div>
  <div class="cierre_box_correo"></div>
</div>