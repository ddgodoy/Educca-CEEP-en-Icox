<?php use_helper('SexyButton') ?>
<?php use_helper('informacion') ?>

<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Informaci&oacute;n del <?php echo $curso->getNombre(100) ?> </h2></div>
  <div class="cont_box_correo">
    <?php if ('administrador'==$rol) : ?>
      <?php if (1!=$eliminar) : ?>
          <div class="herramientas_general_fixed">
             <table cellpadding="0" cellspacing="0">
               <tr>
                 <td><?php echo sexy_button_to('Modificar Curso','admin/modificarCurso?idcurso='.$curso->getId()) ?></td>
                 <td>&nbsp;<?php // echo sexy_button_to('Inicializar Ejercicios','admin/inicializarEjercicios?idcurso='.$curso->getId(),array('onclick'=>"return inicializarEjercicos()")) ?></td>
               </tr>
             </table>
          </div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if (!isset($info)) : ?>
      <div class="detalles_mensaje">
        <div class="detallesLargo">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Curso:</td>
                <td><?php echo $curso->getnombre() ?></td>
              </tr>

              <tr>
                <td class="titulo">Nº Temas:</td>
                <td><?php echo $curso->getMateria()->getNumeroTemas()?></td>
              </tr>

              <tr>
                <td class="titulo">Inicio:</td>
                <td><?php echo $curso->getFechaInicio("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Fin:</td>
                <td><?php echo $curso->getFechaFin("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Precio:</td>
                <td><?php echo $curso->getPrecio() ?> &euro; <?php if ($curso->getMensual()) {echo '/ mes';} ?></td>
              </tr>

              <tr>
                <td class="titulo">Esc&aacute;ner:</td>
                <td><?php if ($curso->getScan() ) : ?>
                      S&iacute;
                    <?php else :?>
                       No
                    <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td class="titulo" valign='top'>Informaci&oacute;n:</td>
                <td><pre class='texto_normal'><?php echo wordwrap($curso->getInformacionExtendida()) ?></pre></td>
              </tr>
            </table>
           </div>
      </div>
  <?php endif; ?>
  <div id="divadmin" style="width: 100%;">
  <?php if ("supervisor"==$rol) : ?>
    <div class="herramientas_general_fixed" >
        <table cellpadding="0" cellspacing="0">
         <tr>
           <td style="padding-right: 15px;"><?php echo sexy_button_to('Ir a alumnos del curso','supervisor/listaAlumnos?idcurso='.$curso->getId()) ?></td>
           <td style="padding-right: 15px;"><?php echo sexy_button_to('Ir a profesores del curso','supervisor/listaProfesores?idcurso='.$curso->getId()) ?></td>
         </tr>
        </table>
    </div>
  <?php endif; ?>
	  <div class="nombrescol" style="width: 100%; <?php if ('administrador'!=$rol) echo "border-top: #CCCCCC 1px solid;"; ?>">
        <table class="tadmincursos" border='0'>
              <tr>
                <th width='50%' style="padding-left: 5px;">Profesores</th>
                <th >Correo</th>
                <?php if ('supervisor'==$rol) :?>
                    <th width='20%'></th>
                <?php endif; ?>
              </tr>
        </table>
    </div>

    <div class="cursos">
        <table class="tadmincursos" cellspacing="0" border="0">
        <?php $i = 0; ?>
              <?php if (!$profesores) : ?>
                  <?php echoAvisoVacioCorto("No hay profesores asignados al curso") ?>
               <?php else : ?>
                    <?php foreach($profesores as $profesor): ?>
                        <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                          <tr class="cont_fil" <?= $fondo1 ?>>
                              <td width="50%" style="padding-left: 5px;"><div class='c_profesor<?php echo $profesor->getIdUsuario()?>'><?php echo $profesor->getUsuario()->getNombre().' '.$profesor->getUsuario()->getApellidos()?></div></td>
                              <td><?php echo $profesor->getUsuario()->getEmail() ?></td>
                              <?php if ('supervisor'==$rol) :?>
                              <td width='20%'>
                                <?php echo link_to(image_tag('ico_mensajes_peq.gif',"Alt=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getUsuario()->getNombre()." en el curso ".$curso->getNombre()."\" Title=\"Estad&iacute;sticas de mensajes del profesor ".$profesor->getUsuario()->getNombre()." en el curso ".$curso->getNombre()."\" align=absmiddle"),'seguimiento/grafica?tipo=mensajes&idusuario='.$profesor->getUsuario()->getId().'&idcurso='.$curso->getId(),array('id'=>'ln_mensajes_profesor'.$profesor->getUsuario()->getId().'_curso'.$curso->getId())); ?>
                              </td>
                              <?php endif; ?>
                          </tr>
                          <?php $i++ ?>
                    <?php endforeach;  ?>
                <?php endif; ?>
        </table>
     </div>
     <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> profesor(es)
      </div>
    <?php endif;?>
    <br>

   <?php if (('administrador'==$rol) || ('supervisor'==$rol)):?>
   	  <div class="nombrescol">
        <table class="tadmincursos" border='0' style="width: 100%; border-top: #CCCCCC 1px solid;">
              <tr>
                <th width='50%'>&nbsp;Alumnos</th>
                <th >Correo</th>
                <?php if ('supervisor'==$rol) :?>
                <th width='20%'>Opciones</th>
                <?php endif ;?>
              </tr>
        </table>
      </div>

      <div class="cursos">
          <table class="tadmincursos" cellspacing="0" border="0">
          <?php $i = 0;
            $alumnos =  $curso->getAlumnos(); ?>
                <?php if (!$alumnos) : ?>
                    <?php use_helper('informacion') ?>
                    <?php echoAvisoVacioCorto("No hay alumnos matriculados en el curso") ?>
                 <?php else : ?>
                 <?php ?>
                      <?php foreach($alumnos as $alumno): ?>
                          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                            <tr class="cont_fil" <?= $fondo1 ?>>
                                <td width='50%' style="padding-left: 5px;"><div class='c_alumno<?php echo $alumno->getIdUsuario()?>'><?php echo $alumno->getUsuario()->getNombre().' '.$alumno->getUsuario()->getApellidos()?></div></td>
                                <td>&nbsp;<?php echo $alumno->getUsuario()->getEmail() ?></td>
                                <?php if ('supervisor'==$rol) :?>
                                  <td width='20%'>
                                   <?php echo link_to(image_tag('incompleto.png', 'title="Gr&aacute;fica de tiempos dedicados al curso por el alumno" alt="Gr&aacute;fica de tiempos dedicados al curso por el alumno" align="absmiddle"'), 'seguimiento/grafica?idusuario='.$alumno->getUsuario()->getId().'&tipo=alumno&idcurso='.$idcurso,array('id'=>'tiempo_alumno'.$alumno->getUsuario()->getId())) ?>
                                    <?php if ($curso->getMateria()->getTipo() != 'compo'):?>
                                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_seguimiento_peq.gif', 'title="Gr&aacute;fica de planificaci&oacute;n. Permite ver si el alumno ha cumplido con la planificaci&oacute;n establecida para el curso." alt="Gr&aacute;fica de seguimiento. Permite ver si el alumno ha cumplido con la planificaci&oacute;n establecida para el curso." align="absmiddle"'), 'seguimiento/sourceHitos?idusuario='.$alumno->getUsuario()->getId().'&idcurso='.$idcurso) ?>
                                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_cursos_peq.gif', 'title="Gr&aacute;fica de tiempos dedicados por tema" alt="Gr&aacute;fica de tiempos dedicados por tema" align="absmiddle"'), 'seguimiento/seguimientoPorTemas?idusuario='.$alumno->getUsuario()->getId().'&idcurso='.$idcurso,array('id'=>'tiempo_alumno'.$alumno->getUsuario()->getId())) ?>
                                    <?php endif;?>
                                    &nbsp;&nbsp;<?php echo link_to(image_tag('ico_evaluacion_peq.gif', 'title="Ficha de evaluaci&oacute;n del alumno en el curso" alt="Ficha de evaluaci&oacute;n del alumno en el curso" align="absmiddle"'), '/seguimiento/fichaEvaluacion?idcurso='.$idcurso.'&idalumno='.$alumno->getUsuario()->getId(), array('id'=>'evaluacion_alumno'.$alumno->getUsuario()->getId(),'popup' => array('', 'width=765,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,top=0,left=200'))) ?>
                                  </td>
                                <?php endif ;?>
                            </tr>
                            <?php $i++ ?>
                      <?php endforeach;  ?>
                  <?php endif;?>

          </table>
       </div>
       <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> alumno(s)
      </div>
    <?php endif;?>
        &nbsp;<br>

        <div class="nombrescol">
        <table class="tadmincursos" border='0' style="width: 100%; border-top: #CCCCCC 1px solid;">
              <tr>
                <th width='50%'>&nbsp;M&oacute;dulos a los que pertenece este curso</th>
              </tr>
        </table>
      </div>

      <div class="cursos">
          <table class="tadmincursos" cellspacing="0" border="0">
          <?php $i = 0;

            $modulos =  $curso->getEnModulo(); ?>
                <?php if (!$modulos) : ?>
                    <?php use_helper('informacion') ?>
                    <?echoAvisoVacioCorto("El curso no pertenece a ning&uacute;n m&oacute;dulo") ?>
                 <?php else : ?>
                      <?php foreach($modulos as $modulo): ?>
                          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                            <tr class="cont_fil" <?= $fondo1 ?>>
                                <td width='50%' >&nbsp;&nbsp;<?php echo $modulo->getPaquete()->getNombre()?></td>
                            </tr>
                            <?php $i++ ?>
                      <?php endforeach;  ?>
                  <?php endif;?>

          </table>
       </div>

       <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> m&oacute;dulo(s)
      </div>
    <?php endif;?>
        &nbsp;<br />



    <?php endif; ?>

     	  <div class="nombrescol" >
        <table class="tadmincursos" border='0' style="width: 100%; border-top: #CCCCCC 1px solid;">
              <tr>
                <th class="td1">Tema</th>
                <th class="td2">Nombre</th>
                <th class="td3">Finalizacion</th>
                <?php if (('supervisor'==$rol) && ($curso->getMateria()->getTipo() != 'compo')) :?>
                  <th style="width: 23%; text-align: center;">Gr&aacute;ficas</th>
                <?php endif; ?>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos" cellspacing="0" border="0">
              <?php $i = 0; ?>
              <?php if (!$temas) : ?>
                <?php use_helper('informacion'); ?>
                <?php echoAvisoVacioCorto("No tiene temas asignados"); ?>
               <?php else : ?>
                <?php foreach($temas as $tema): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?php echo $fondo1; ?>>
                    <td class="td1" style="padding-left: 5px;"><?php echo $tema->getNumeroTema()?>&nbsp;&nbsp;&nbsp;</td>
                    <td class="td2" style="padding-left: 2px;"><?php echo $tema->getNombre() ?></td>
                    <td class="td3">
                      <?php
                        $c1 = new Criteria();
                        $c1->add(Rel_curso_temaPeer::ID_CURSO, $curso->getId());
                        $c1->add(Rel_curso_temaPeer::ID_TEMA, $tema->getId());
                        $rel = Rel_curso_temaPeer::doSelectOne($c1);
                      ?>
                      <?php if ($rel) : ?>
                        <?php echo $rel->getFechaCompletado("d/m/Y") ?>
                      <?php else : ?>
                        Sin fecha.
                      <?php endif; ?>
                    </td>
                    <?php if (('supervisor'==$rol)) :?>
                        <?php echo $curso->getMateria()->getTipo()?> 
                        <?php if($curso->getMateria()->getTipo() != 'scorm1.2'): ?>
                            <td style="width: 23%; text-align: center;"><?php echo link_to(image_tag('ico_graficas_peq.gif', 'alt="Gr&aacute;ficas" title="Gr&aacute;ficas" align="absmiddle"'),'seguimiento/grafica?idtema='.$tema->getId().'&tipo=tema&idcurso='.$curso->getId()) ?></td>
                        <?php else: ?>
                            <?php  $c = new Criteria();
                                    $c->add(Sco12Peer::ID_MATERIA, $curso->getMateria()->getId());
                                    $c->add(Sco12Peer::TITLE, $tema->getNombre());
                                    $c->addAscendingOrderByColumn(Sco12Peer::ID);
                                    $scos = Sco12Peer::doSelectOne($c);
                             ?>       
                            <td style="width: 23%; text-align: center;"><?php echo link_to(image_tag('ico_graficas_peq.gif', 'alt="Gr&aacute;ficas" title="Gr&aacute;ficas" align="absmiddle"'),'seguimiento/grafica?idsco12='.$scos->getId().'&tipo=sco12&idcurso='.$curso->getId()) ?></td>
                        <?php endif; ?>    
                    <?php endif; ?>
                  </tr>
                  <?php $i++; ?>
              <?php endforeach; ?>
             <?php endif; ?>
        </table>
    </div>


</div>


    <?php if ('supervisor'==$rol): ?>
    <br>
      <?php use_helper('informacion'); ?>
      <?php echoNotaInformativa('Ayuda', 'Este panel le ofrece una vista general del curso: Alumnos, profesores, temario...'); ?>
    <?php endif; ?>

    <?php if ('administrador'==$rol): ?>
       <?php if (1!=$eliminar): ?>
            <br>
            <?php use_helper('informacion'); ?>
            <?php echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informaci&oacute;n del curso(temas, fechas de comienzo y fin...), as&iacute; como la posibilidad de realizar cambios en el curso.'); ?>
       <?php endif; ?>
    <?php endif; ?>

  <br><?php use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>

