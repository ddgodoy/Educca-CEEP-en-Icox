<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Lista de modulos para el <?php echo $rol." ".$usuario->getNombre()." ".$usuario->getApellidos()?> </h2></div>
  <div class="cont_box_correo" id="admin">
    <div class="herramientas_general_fixed">
       <table cellpadding="0" cellspacing="0">
         <tr>
           <td><?php echo sexy_button_to('Ver los cursos del alumno', 'supervisor/listarCursosAlumno?idusuario='.$usuario->getId()) ?></td>
         </tr>
       </table>
    </div>

    <div class="titulos_tabla_general">
        <table class="tadmin_modulos_alumno">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3">Fin</th>
                <th class="td4">Numero Cursos</th>
                <th class="td5">Estado</th>
                <th class="td6">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="listado_tabla_general">
        <table class="tadmin_modulos_alumno">
        <?php $i = 0; ?>
        <?php if (!$usuario) : ?>
              <?php use_helper('informacion') ?>
              <?php echoAvisoVacioCorto("No hay modulos asignados") ?>
        <?php else : ?>
              <?php foreach($modulos as $modulo): ?>

                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($modulo->getPaquete()->getNombre(), 'supervisor/fichaModulo?idmodulo='.$modulo->getPaquete()->getId(),array('id'=>'ln_modulo'.$modulo->getPaquete()->getId())) ?></td>
                      <td class="td2"><?php echo $modulo->getPaquete()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $modulo->getPaquete()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $modulo->getPaquete()->countRel_paquete_cursos()?></td>
                      <td class="td5">
                        <?php if ($modulo->getPaquete()->esMoroso($usuario->getId())) : ?>
                          <strong>MOROSO</strong>
                        <?php else : ?>
                          ACTIVO
                        <?php endif; ?>
                      </td>
                      <td class="td6">
                       <?php if ('supervisor'== $sf_user->obtenerCredenciales()) :?>    
                        <?php echo link_to(image_tag('ico_seguimiento_peq.gif',"Alt=\"Informe de seguimiento del m&oacute;dulo ".$modulo->getPaquete()->getNombre()."\" Title=\"Informe de seguimiento del m&oacute;dulo ".$modulo->getPaquete()->getNombre()."\" align=absmiddle"), 'supervisor/informeSeguimientoModulo?idmodulo='.$modulo->getPaquete()->getId(),array('id'=>'ln_seguimiento_modulo'.$modulo->getPaquete()->getId()) )?>
                       <?php endif; ?>   
                      </td>
                    </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
          <?php endif; ?>
        </table>
    </div>
    <br>
    <?php use_helper('informacion'); ?>
    <?php echoNotaInformativa('',  "Un alumno <b>ACTIVO</b> tiene pleno acceso a todas las opciones de un curso o m&oacute;dulo
                                    <br><br>Un alumno aparece como <b>MOROSO</b> cuando tiene pendiente alguno de los pagos mensuales. El alumno no podr&aacute; acceder al curso o m&oacute;dulo correspondiente hasta que haya realizado sus pagos y la administraci&oacute;n le marque de nuevo como <b>ACTIVO</b>."); ?>
    <br><?php use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
