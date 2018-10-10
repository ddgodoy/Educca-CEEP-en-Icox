<?php use_helper('SexyButton', 'Text') ?>
<div id="mensajes_recibidos">
    <div class="tit_box_mensajes"><h2 class="titbox">Informes de seguimiento</h2></div>
  <div class="cont_box_correo" >
      <div class="detalles_mensaje" style="margin-bottom: 15px;">
        <div class="detallesLargo">
            <table class="tabladetalles">
		          <tr>
                <td class="titulo">M&oacute;dulo:</td>
                <td><?php echo $modulo->getnombre() ?></td>
              </tr>

              <tr>
                <td class="titulo">Inicio:</td>
                <td><?php echo $modulo->getFechaInicio("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Fin:</td>
                <td><?php echo $modulo->getFechaFin("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Precio:</td>
                <td><?php echo $modulo->getPrecio() ?> &euro; <?php if ($modulo->getMensual()) {echo '/ mes';} ?></td>
              </tr>

              <tr>
                <td class="titulo">Esc&aacute;ner:</td>
                <td><?php if ($modulo->getScan() ) : ?>
                      S&iacute;
                    <?php else :?>
                       No
                    <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td class="titulo">Descripci&oacute;n:</td>
                <td style="vertical-align: top;"><?php echo $modulo->getDescripcion() ?></td>
              </tr>

            </table>
           </div>
      </div>
    <div id="divadmin" >

    <div class="titulos_tabla_general">
        <table class="tadmincursosmodulo">
              <tr>
                <th class="td1">Cursos</th>
                <th class="td2">Inicio</th>
                <th class="td3" style="padding-left: 15px;">Fin</th>
                <th class="td4">N&ordm; temas</th>
              </tr>
        </table>
    </div>

    <div class="listado_tabla_general_medio">
        <table class="tadmincursosmodulo">
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>
                <?php if ($curso->getCurso()->getNombre() != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo link_to($curso->getCurso()->getNombre(), 'supervisor/fichaCurso?idcurso='.$curso->getCurso()->getId(),array('id'=>'ln_curso'.$curso->getCurso()->getId())) ?></td>
                      <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>
              <?php endforeach; ?>
        </table>
    </div>
    <?php if ($i):?>
     <div class="totales_tabla">
       Total: &nbsp;<?php echo $i; ?> curso(s)
     </div>
   <?php endif;?>
</div>
<div id="ejercicios" class="contenido_principal">
    <br>
    <div class="titulos_tabla_general">
        <table class="tests_realizados_alumno">
            <tr>
                <th class="tds1">Ejercicios de test realizados</th>
                <th class="tds2">Categor&iacute;a</th>
                <th class="tds3">Curso</th>
                <th class="tds4">Peso %</th>
            </tr>
        </table>
    </div>

    <div class="listado_tabla_general_medio">
        <table class="tests_realizados_alumno">
            <?php $count=0; ?>
            <?php foreach ($relacion_tests as $elemento):?>
            <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
            <?php echo("<tr$fondo>"); ?>
                <?php $tarea = TareaPeer::retrieveByPk($elemento[0])?>
                <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
                <td class="tds2"><?php echo $elemento[2]?></td>
                <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
                <td class="tds4"><?php echo $modulo->evaluacionPesoTarea($tarea->getId())?></td>
                <?php $count++;?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de test que puedan contar para la evaluaci&oacute;n ');?>
    <?php endif;?>
    </div>
    <br>

    <div class="titulos_tabla_general">
    <table class="tests_realizados_alumno">
    <tr>
    <th class="tds1">Cuestionarios realizados</th>
    <th class="tds2">Categor&iacute;a</th>
    <th class="tds3">Curso</th>
    <th class="tds4">Peso %</th>
    </tr>
    </table>
    </div>
    <div class="listado_tabla_general_medio">
    <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_cuestionarios as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>

    <?php $tarea = TareaPeer::retrieveByPk($elemento[0])?>
    <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
    <td class="tds2"><?php echo $elemento[2]?></td>
    <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
    <td class="tds4"><?php echo $modulo->evaluacionPesoTarea($tarea->getId()) ?></td>
    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
    </table>
    <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay cuestionarios que puedan contar para la evaluaci&oacute;n');?>
    <?php endif;?>
    </div>
    <br>

    <div class="titulos_tabla_general">
    <table class="tests_realizados_alumno">
    <tr>
    <th class="tds1">Problemas realizados</th>
    <th class="tds2">Categor&iacute;a</th>
    <th class="tds3">Curso</th>
    <th class="tds4">Peso %</th>
    </tr>
    </table>
    </div>
    <div class="listado_tabla_general_medio">
    <table class="tests_realizados_alumno">
    <?php $count=0; ?>
    <?php foreach ($relacion_problemas as $elemento):?>
    <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>

    <?php $tarea = TareaPeer::retrieveByPk($elemento[0])?>
    <td class="tds1"><?php echo truncate_text($elemento[1], 36); ?></td>
    <td class="tds2"><?php echo $elemento[2]?></td>
    <td class="tds3"><?php echo truncate_text($elemento[4], 36); ?></td>
    <td class="tds4"><?php echo $modulo->evaluacionPesoTarea($tarea->getId()) ?></td>
    <?php $count++;?>
    </tr>
    <?php endforeach; ?>
    </table>
    <?php if (!$count):?>
    <?php echoAvisoVacioCorto('Por el momento no hay ejercicios de problemas que puedan contar para la evaluaci&oacute;n');?>
    <?php endif;?>
    </div>
    <br>
</div> 
<div class="contenido_principal">        
        <div class="titulos_tabla_general">
        <table class="tnombrelistaprofes" style="width: 715px;">
            <tr>
              <th class="td1">Alumno</th>
              <th class="td2">Nombre de usuario</th>
            </tr>
        </table>
        </div>

        <div class="listado_tabla_general_fixed">
        <table class="tnombrelistaprofes" style="width: 715px;">
                <?php $i = 0; ?>
                <?php foreach($alumnos as $alumno): ?>
                    <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                    <tr class="cont_fil" <?= $fondo1 ?>>
                        <td class="td1"><?php echo link_to($alumno->getApellidos().", ".$alumno->getNombre(), 'usuario/mostrarPerfil?idusuario='.$alumno->getId(),array('id'=>'ln_usuario'.$alumno->getId())) ?></td>
                        <td class="td2"><?php echo $alumno->getNombreusuario() ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
         <?php echoAvisoVacio('No hay alumnos registrados en la plataforma');?>
        <?php endif;?>
        </div>
        <?php if ($i):?>
        <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> alumno(s)
        </div>
        <?php endif;?>
    <br/>
</div>      
<div class="contenido_principal">        
        <div class="titulos_tabla_general">
        <table class="tnombrelistaprofes" style="width: 715px;">
            <tr>
              <th class="td1">Profesores</th>
              <th class="td2">Nombre de usuario</th>
            </tr>
        </table>
        </div>

        <div class="listado_tabla_general_fixed">
        <table class="tnombrelistaprofes" style="width: 715px;">
                <?php $i = 0; ?>
                <?php foreach($profesores as $profesor): ?>
                    <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                    <tr class="cont_fil" <?= $fondo1 ?>>
                        <td class="td1"><?php echo link_to($profesor->getApellidos().", ".$profesor->getNombre(), 'usuario/mostrarPerfil?idusuario='.$profesor->getId(),array('id'=>'ln_usuario'.$profesor->getId())) ?></td>
                        <td class="td2"><?php echo $profesor->getNombreusuario() ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
        </table>
        <?php if (!$i):?>
         <?php echoAvisoVacio('No hay profesores registrados en la plataforma');?>
        <?php endif;?>
        </div>
        <?php if ($i):?>
        <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> profesor(es)
        </div>
        <?php endif;?>
</div>  
  <br>
<?php use_helper('informacion'); ?>
<?php echoNotaInformativa('Ayuda', 'Este panel le ofrece una vista general del Modulo'); ?>
    

  <br><?php use_helper('volver');  echo volver(); ?>
</div>  
  <div class="cierre_box_correo"></div>
</div>


