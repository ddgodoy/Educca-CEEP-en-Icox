<?php use_helper('Javascript','tiempo', 'Text') ?>
<?php use_helper('SexyButton') ?>
<?php use_helper('informacion') ?>

<div class="capa_principal" id="ordenarSeguimientoPorTemas">
  <div class="titulo_principal"><h2 class="titbox">Tiempos invertidos en el curso - Ordenado por temas</h2></div>
  <div class="contenido_principal">
    
    <div class="herramientas_general_fixed">
      <?php echo sexy_button_to('Ordenar por Alumnos', 'seguimiento/seguimientoPorTemas?idcurso='.$idcurso) ?>
    </div>
    
    <?php echo input_hidden_tag('idcurso', $idcurso) ?>
    
    <?php if (isset($idusuario)) : ?>
      <?php echo input_hidden_tag('idusuario', $idusuario) ?>
    <?php endif; ?>
    </form>
  


  <div class="titulos_tabla_general">
    <table class="tablaseg">
      <tr>
        <th class="td1">Tema</th>
        <th class="td4">&nbsp;</th>
      </tr>
    </table>
  </div>
    
  <div class="listado_tabla_general">
    <?php if ($curso->getMateria()->esCompo()):?>
      <?php echoAvisoVacio("No se puede realizar seguimiento por temas a este curso");?>
    <?php else:?>
      <?php $col = 0 ?>
      <table class="tablaseg">
      <?php if ($curso->getMateria()->getTipo() == 'segmentada'): ?>
        <?php foreach($temas as $tema) : ?>
          <?php $fondo1 = (($col % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?=$fondo1?>>
            <td class="td1">
              <?php echo link_to($tema->getNumeroTema().". ".$tema->getNombre() , 'seguimiento/grafica?tipo=tema&idtema='.$tema->getId().'&idcurso='.$idcurso) ?>
            </td>
            <td class="td4">
              <table style="width: 90%;">
                <tr>
                  <th style="width: 60%; text-align: left;">Alumno</th>
                  <th style="width: 30%; text-align: center;">Tiempo estudio</th>
                  <th style="width: 10%; text-align: center;">Estado</th>
                </tr>
                
                <?php foreach($alumnos as $alumno) : ?>
                  <tr>
                    <td style="width: 60%; text-align: left;">
                      <?php  echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() , 'seguimiento/grafica?tipo=alumno&idusuario='.$alumno->getUsuario()->getId()."&idcurso=".$idcurso)?>
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
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <?php $col++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      
      
      <?php if ($curso->getMateria()->getTipo() == 'scorm1.2'): ?>
        <?php foreach($scos12 as $sco) : ?>
          <?php $fondo1 = (($col % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?=$fondo1?>>
            <td class="td1">
              <?php echo link_to(truncate_text($sco->getTitle(), 50) , 'seguimiento/grafica?tipo=sco12&idsco12='.$sco->getId().'&idcurso='.$idcurso) ?>
            </td>
            <td class="td4">
              <table style="width: 90%;">
                <tr>
                  <th style="width: 60%; text-align: left;">Alumno</th>
                  <th style="width: 30%; text-align: center;">Tiempo estudio</th>
                  <th style="width: 10%; text-align: center;">Estado</th>
                </tr>
                
                <?php foreach($alumnos as $alumno) : ?>
                  <tr>
                    <td style="width: 60%; text-align: left;">
                      <?php  echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() , 'seguimiento/grafica?tipo=alumno&idusuario='.$alumno->getUsuario()->getId()."&idcurso=".$idcurso)?>
                    </td>
                    <td style="width: 30%; text-align: center;">
                      <?php $c = new Criteria(); ?>
                      <?php $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco->getId()); ?>
                      <?php $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $alumno->getIdUsuario()); ?>
                      <?php $rel = Rel_usuario_sco12Peer::doSelectOne($c); ?>
                      <?php if ($rel) {echo $rel->showTiempoTotal();} else {echo '00:00';} ?>
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
                <tr>
                  <td class="tdtema">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <?php $col++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      </table>
      <?php if (!$alumnos) :?>
        <?php echoAvisoVacio("No hay informaci&oacute;n que mostrar porque no hay alumnos en el curso");?>
      <?php endif;?>
    <?php endif;?>
  </div>
      
  
  
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
            
    <br><?php echoNotaInformativa('Ayuda', 'Desde este panel dispone de la informaci&oacute;n del tiempo dedicado a los temas y su estado. Tambi&eacute;n podr&aacute; acceder a las gr&aacute;ficas de seguimiento pinchando sobre los enlaces.'); ?>

    <br><?php use_helper('volver');  echo volver(); ?>
    
  </div>
    
  <div class="cierre_principal"></div>
</div>


