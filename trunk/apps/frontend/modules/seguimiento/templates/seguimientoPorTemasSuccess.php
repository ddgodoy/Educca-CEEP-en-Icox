<?php use_helper('Javascript','tiempo','informacion', 'Text') ?>

<div class="capa_principal" id="ordenarSeguimientoPorTemas">
  <div class="titulo_principal"><h2 class="titbox">Tiempos invertidos en el curso - Ordenado por alumnos</h2></div>
  <div class="contenido_principal">

<?php if ($curso) : ?>
    <div class="herramientas_general_fixed">
        <?php if (!$curso->getMateria()->esCompo()):?>
          <?php use_helper('SexyButton') ?>
          <?php echo sexy_button_to('Ordenar por Temas', 'seguimiento/ordenar?idcurso='.$idcurso) ?>
        <?php endif; ?>

    </div>

    <?php echo input_hidden_tag('idcurso', $idcurso) ?>

    <?php if (isset($idusuario)) : ?>
      <?php echo input_hidden_tag('idusuario', $idusuario) ?>
    <?php endif; ?>
    </form>
<?php endif; ?>



  <div class="titulos_tabla_general">
    <table class="tablaseg">
      <tr>
        <th class="td1">Alumno</th>
        <?php if ($curso) : ?>
          <?php if ($curso->getMateria()->esCompo()): ?>
            <th class="td2">Tiempo teor&iacute;a</th>
            <th class="td3">Tiempo ejercicios</th>
          <?php else: ?>
            <th class="td4">&nbsp;</th>
          <?php endif;?>
       <?php endif ; ?>

      </tr>
    </table>
  </div>

  <div class="listado_tabla_general">
    <?php $col = 0 ?>
    <table class="tablaseg">
     <?php if ($alumnos) : ?>
      <?php foreach($alumnos as $alumno) : ?>
        <?php $fondo1 = (($col % 2 == 0))? "id=\"filarayada\"" : ""; ?>
        <tr <?=$fondo1?>>
          <td class="td1">
            <?php  echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() , 'seguimiento/grafica?tipo=alumno&idusuario='.$alumno->getUsuario()->getId()."&idcurso=".$idcurso,array('id'=>'ln_segAlumno'.$col))?>
          </td>
          <?php if ($curso->getMateria()->esCompo()): ?>
            <td class="td2"><?php echoTiempo($alumno->getUsuario()->tiempoTotalTeoriaScorm($curso->getMateriaId()));?></td>
            <td class="td3"><?php echoTiempo($alumno->getUsuario()->tiempoEjercicios($curso->getId())); ?></td>
          <?php else: ?>
            <td class="td4">
              <table style="width: 90%;">
                <tr>
                  <th style="width: 60%; text-align: left;">Tema</th>
                  <th style="width: 30%; text-align: center;">Tiempo estudio</th>
                  <th style="width: 10%; text-align: center;">Estado</th>
                </tr>
                
                <?php if($curso->getMateria()->getTipo() == 'scorm1.2'): ?>
                  <?php foreach($scos12 as $sco) : ?>
                    <tr>
                      <td style="width: 60%; text-align: left;">
                        <?php echo link_to(truncate_text($sco->getTitle(), 50) , 'seguimiento/grafica?tipo=sco12&idsco12='.$sco->getId().'&idcurso='.$idcurso) ?>
                      </td>
                      <td style="width: 30%; text-align: center;">
                        <?php
                        	$c = new Criteria();
                        	$c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco->getId());
                        	$c->add(Rel_usuario_sco12Peer::ID_USUARIO, $alumno->getIdUsuario());
                        	$rel = Rel_usuario_sco12Peer::doSelectOne($c);
                        	
                        	if ($rel) {echo $rel->showTiempoTotal();} else {echo '00:00';}
                        ?>
                      </td>
                      <td style="width: 10%; text-align: center;">
                        <?php
                          if ($rel) 
                          {
                            $lesson_status = $rel->getLessonStatus();
                          }
                          else
                          {
                            $lesson_status = 'not attempted';
                          }
                          
                          switch($lesson_status)
                          {
                            case 'passed': $estado = 2;
                            break;
                            
                            case 'completed': $estado = 2;
                            break;
                            
                            case 'not attempted': $estado = 0;
                            break;
                            
                            default: $estado = 1;
                            break;
                          }
                          
                          switch($estado)
                          {
                            case 0: echo image_tag('nointentado.png','title=No intentado');  break;
                            case 1: echo image_tag('incompleto.png','title=Incompleto');  break;
                            case 2: echo image_tag('finalizado.png','title=Finalizado');  break;
                            default: break;
                          }
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif;?>
                
                
                
                <?php if($curso->getMateria()->getTipo() == 'segmentada'): ?>
                  <?php foreach($temas as $tema) : ?>
                    <tr>
                      <td style="width: 60%; text-align: left;">
                        <?php echo link_to($tema->getNumeroTema().". ".$tema->getNombre() , 'seguimiento/grafica?tipo=tema&idtema='.$tema->getId().'&idcurso='.$idcurso) ?>
                      </td>
                      <td style="width: 30%; text-align: center;">
                        <?php echoTiempo($tema->getDuracionAlumno($alumno->getUsuario()->getId()))?>
                      </td>
                      <td style="width: 10%; text-align: center;">
                        <?php
                          $estado = $tema->getEstadoAlumno($alumno->getUsuario()->getId());
                          switch($estado)
                          {
                            case 0: echo image_tag('nointentado.png','title=No intentado');  break;
                            case 1: echo image_tag('incompleto.png','title=Incompleto');  break;
                            case 2: echo image_tag('finalizado.png','title=Finalizado');  break;
                            default: break;
                          }
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif;?>
                <tr>
                  <td class="tdtema">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          <?php endif; ?>
        </tr>
        <?php $col++; ?>
      <?php endforeach; ?>
     <?php endif ; ?>
    </table>
    <?php if (!$alumnos) :?>
      <?php echoWarning('Aviso', "No se puede hacer el seguimiento, no hay alumnos en el curso"); ?>
    <?php endif;?>
  </div>


  <?php if ($curso): ?>
    <?php if (!$curso->getMateria()->esCompo()): ?>
      <div class="cursos">
        <table class="tablacursos">
          <tr class="cont_fil">
            <td>
      	      <?php echo image_tag('nointentado.png'); ?> Tema no intentado.
       	      <?php echo image_tag('incompleto.png'); ?> Tema incompleto.
      	      <?php echo image_tag('finalizado.png'); ?> Tema finalizado.
            </td>
          </tr>
        </table>
      </div>
    <?php endif; ?>
  <?php endif ; ?>

    <br><?php echoNotaInformativa('Ayuda', 'Esta tabla le muestra el tiempo dedicado por los alumnos a cada tema y el estado de avance del alumno en el tema. Tambi&eacute;n <b>podr&aacute; acceder a las <u>gr&aacute;ficas de seguimiento</u> pinchando sobre los nombres de los alumnos</b>.'); ?>

    <br><?php use_helper('volver');  echo volver(); ?>

  </div>

  <div class="cierre_principal"></div>
</div>
