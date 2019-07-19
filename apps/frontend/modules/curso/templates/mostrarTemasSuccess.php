<?php
  use_helper('SexyButton','tiempo');
?>
<script type="text/javascript">
window.onload = function() {
    if(window.location.hash) {
        var url =  new String(window.location);
        var new_url = url.replace("#loaded","");
        window.location.replace(new_url);
    }
}
</script>
<div id="mistemas">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $curso->getNombre(120); ?></h2></div>
    <div class="cont_box_correo">
      <div class="nombrescol">
          <table class="tablatemas" cellspacing="0">
                <tr>
                    <th style="text-align: left; width: 50%; padding-left: 4px;"><div class='temario'>Temario</div></th>
                    <th style="text-align: center; width: 20%;">Fecha Finalización</th>
                    <th style="text-align: center; width: 20%;"><?php if ($materia->getTipo() == 'compo'): ?>&nbsp;<?php else: ?>Tiempo empleado<?php endif; ?></th>
                    <th style="text-align: center; width: 10%;"><?php if ($materia->getTipo() == 'compo'): ?>&nbsp;<?php else: ?>Estado<?php endif; ?></th>  
                    <?php if($is_alumno): ?>
                    <th style="text-align: center; width: 10%;"><?php if ($materia->getTipo() == 'compo'): ?>&nbsp;<?php else: ?>Opciones<?php endif; ?></th>  
                    <?php endif; ?>
                </tr>
          </table>
      </div>
      <div class="cursos">
        <table class="tablatemas" cellspacing="0">
          <?php $i = 0; ?>

          <?php if ($materia->getTipo() == 'segmentada'): ?>
            <?php
              $c = new Criteria();
        	    $c->add(TemaPeer::ID_MATERIA, $idmateria);
        	    $c->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
        	    $temas = TemaPeer::doSelect($c);
            ?>
            <?php foreach($temas as $tema): ?>
            <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>

            <tr class="cont_fil" <?= $fondo ?>>
              <td style="text-align: left; width: 50%; padding-left: 4px;">
                <?php echo link_to($tema->getNumeroTema().'. '.$tema->getNombre(), '/contenidosTema/verFichero?id='.$tema->getId().'&idmateria='.$tema->getIdMateria(), array( 'popup' => array('', "width=$width,height=$height,left=0,top=0,scrollbars=yes,resizable=yes"))); ?>
              </td>
              <?php 
                      $cct = new Criteria();
                      $cct->add(Rel_curso_temaPeer::ID_CURSO, $idcurso);
                      $cct->add(Rel_curso_temaPeer::ID_TEMA, $tema->getId());
                      
                      $curso_temas = Rel_curso_temaPeer::doSelectOne($cct);
              ?>
              <td style="text-align: center; width: 20%;"><?php echo $curso_temas->getFechaCompletado('d/m/Y') ?></td>

              <?php
                $c = new Criteria();
		            $c->add(Rel_usuario_temaPeer::ID_TEMA, $tema->getId());
		            $c->add(Rel_usuario_temaPeer::ID_USUARIO, $sf_user->getAlumnoId());
		            $RelTiempos = Rel_usuario_temaPeer::doSelectOne($c);
              ?>

              <td style="text-align: center; width: 20%;">
                <?php if (isset($RelTiempos)): ?>
                  <?php echo segundos_tiempo($RelTiempos->getTiempo()); ?>
                <?php else: ?>
                  <?php echo "00:00:00"; ?>
                <?php endif; ?>
              </td>

              <td style="text-align: center; width: 10%;">
                <?php if (isset($RelTiempos)): ?>
                  <?php
                    switch($RelTiempos->getEstado())
                    {
                      case 0: echo image_tag('nointentado.png','title=No intentado');  break;
                      case 1: echo image_tag('incompleto.png','title=Incompleto');  break;
                      case 2: echo image_tag('finalizado.png','title=Finalizado');  break;
                      default: break;
                    } // switch
                  ?>
                <?php else : ?>
                  <?php echo image_tag('nointentado.png','title=No intentado'); ?>
                <?php endif; ?>
              </td>
              <?php if($is_alumno): ?>
              <td>
                  <?php if($RelTiempos->getEstado() != 2):?>
                    <?php echo link_to('Finalizar', 'contenidosTema/finish?type=1&idcurso='.$curso->getId().'&idtema='.$tema->getId()) ?>
                  <?php else: ?>
                    &nbsp;
                  <?php endif ?>
              </td>      
              <?php endif; ?>
            </tr>
            <?php $i++; ?>
            <?php endforeach;?>
          <?php endif;?>



          <?php if ($materia->getTipo() == 'compo'): ?>
            <?php
              $c = new Criteria();
        	    $c->add(TemaPeer::ID_MATERIA, $idmateria);
        	    $c->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
        	    $temas = TemaPeer::doSelect($c);
            ?>

            <?php foreach($temas as $tema): ?>
            <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>

            <tr class="cont_fil" <?= $fondo ?>>

              <td style="text-align: left; width: 50%; padding-left: 4px;">
                <?php echo $tema->getNombre(); ?>
              </td>
              <?php 
                      $cct = new Criteria();
                      $cct->add(Rel_curso_temaPeer::ID_CURSO, $idcurso);
                      $cct->add(Rel_curso_temaPeer::ID_TEMA, $tema->getId());
                      
                      $curso_temas = Rel_curso_temaPeer::doSelectOne($cct);
              ?>
              <td style="text-align: center; width: 20%;"><?php echo $curso_temas->getFechaCompletado('d/m/Y') ?></td>
              <td style="text-align: center; width: 20%;">&nbsp;</td>
              <td style="text-align: center; width: 10%;">&nbsp;</td>
              <?php if($is_alumno): ?>
              <td style="text-align: center; width: 10%;">&nbsp;</td>
              <?php endif; ?>
            </tr>
            <?php $i++; ?>
            <?php endforeach;?>
          <?php endif; ?>



          <?php if ($materia->getTipo() == 'scorm1.2'): ?>
            <?php
              $c = new Criteria();
        	    $c->add(Sco12Peer::ID_MATERIA, $idmateria);
        	    $c->addAscendingOrderByColumn(Sco12Peer::ID);
        	    $scos = Sco12Peer::DoSelect($c);
        	    $total = 0;
            ?>
            <?php foreach($scos as $sco): ?>
            <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>

            <tr class="cont_fil" <?= $fondo ?>>
              <?php $ruta_libro = ''; ?>
                <?php 
                if($sco->getTitle() === 'LIBRO' && $url_libro): 
                    $ruta_libro = '&ruta='.urlencode($url_libro);
                elseif($sco->getTitle() === $title_0 && $capitulo_0):
                    $ruta_libro = '&ruta='.urlencode($capitulo_0);
                elseif($sco->getTitle() === $title_1 && $capitulo_1):
                    $ruta_libro = '&ruta='.urlencode($capitulo_1);
                elseif($sco->getTitle() === $title_2 && $capitulo_2):
                    $ruta_libro = '&ruta='.urlencode($capitulo_2);
                elseif($sco->getTitle() === $title_3 && $capitulo_3):
                    $ruta_libro = '&ruta='.urlencode($capitulo_3);
                elseif($sco->getTitle() === $title_4 && $capitulo_4):
                    $ruta_libro = '&ruta='.urlencode($capitulo_4);
                elseif($sco->getTitle() === $title_5 && $capitulo_5):
                    $ruta_libro = '&ruta='.urlencode($capitulo_5);
                elseif($sco->getTitle() === $title_6 && $capitulo_6):
                    $ruta_libro = '&ruta='.urlencode($capitulo_6);
               elseif($sco->getTitle() === $title_7 && $capitulo_7):
                    $ruta_libro = '&ruta='.urlencode($capitulo_7);
               elseif($sco->getTitle() === $title_8 && $capitulo_8):
                    $ruta_libro = '&ruta='.urlencode($capitulo_8);
               elseif($sco->getTitle() === $title_9 && $capitulo_9):
                    $ruta_libro = '&ruta='.urlencode($capitulo_9);
               elseif($sco->getTitle() === $title_10 && $capitulo_10):
                    $ruta_libro = '&ruta='.urlencode($capitulo_10);
               elseif($sco->getTitle() === $title_11 && $capitulo_11):
                    $ruta_libro = '&ruta='.urlencode($capitulo_11);
               elseif($sco->getTitle() === $title_12 && $capitulo_12):
                    $ruta_libro = '&ruta='.urlencode($capitulo_12);
               elseif($sco->getTitle() === $title_13 && $capitulo_13):
                    $ruta_libro = '&ruta='.urlencode($capitulo_13);
               elseif($sco->getTitle() === $title_14 && $capitulo_14):
                    $ruta_libro = '&ruta='.urlencode($capitulo_14);
               elseif($sco->getTitle() === $title_15 && $capitulo_15):
                    $ruta_libro = '&ruta='.urlencode($capitulo_15);
               endif; 
                
                ?>
                <?php 
              
                      $ct  = new Criteria();
                      $ct->add(TemaPeer::NOMBRE, $sco->getTitle());
                      $ct->add(TemaPeer::ID_MATERIA, $idmateria);
                      $tema_sc = TemaPeer::doSelectOne($ct);
                   
                      $cct = new Criteria();
                      $cct->add(Rel_curso_temaPeer::ID_CURSO, $idcurso);
                      $cct->add(Rel_curso_temaPeer::ID_TEMA, $tema_sc->getId());
                      
                      $curso_temas = Rel_curso_temaPeer::doSelectOne($cct);
              ?>
              <td style="text-align: left; width: 45%; padding-left: 4px;">
                <a style="color:#003399;" href="javascript:void(0)" onclick="window.open('<?php echo url_for('curso/mostrarContenido?sco12id='.$sco->getId().'&id_tema='.$tema_sc->getId().'&id_curso='.$idcurso.$ruta_libro) ?>', 'scormbrowser', 'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=0, scrollbars=0, height=<?php echo $materia->getHeight()?>, width=<?php echo $materia->getWidth()?>')"><?php echo $sco->getTitle(); ?></a>
              </td>
              <td style="text-align: right; width: 15%;"><?php echo $curso_temas?$curso_temas->getFechaCompletado('d/m/Y'):""; ?></td>
                <?php $c = new Criteria();?>
                <?php $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco->getId());?>
                <?php $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_usuario);?>
                <?php $rel = Rel_usuario_sco12Peer::DoSelectOne($c);?>
                <?php if ($rel): ?>
                <td style="text-align: right; padding-right: 24px; width: 25%;"> 
                  <?php $tt = $rel->getTiempoTotal(); $total += $tt;?>
                  <?php $for_tt = segundos_tiempo($tt);?>   
                  <?php $fot_tt_arr= explode(':', $for_tt); ?>  
                  <?php //$horas = floor($tt/3600); ?>
                  <?php //$minutos = number_format(($tt/60),2); ?> 
                  <?php if ($fot_tt_arr[0]!='00') {$texto_horas = "<strong>$fot_tt_arr[0]</strong> horas &nbsp;";} else {$texto_horas = '';} ?>
                  <?php if ($fot_tt_arr[1]!='00') {$texto_minutos = "<strong>$fot_tt_arr[1]</strong> minutos &nbsp;";} else {$texto_minutos = '';} ?>
                    <?php if ($fot_tt_arr[2]!='00') {$texto_segundos = "<strong>$fot_tt_arr[2]</strong> segundos";} else {$texto_segundos = '00 segundos';} ?>
                  <?php echo $texto_horas.$texto_minutos.$texto_segundos;?>
                </td>
                <?php else: ?>
                <td style="text-align: center; width: 25%;">
                ---
                </td>
                <?php endif; ?>
              <td style="text-align: center; width: 10%;">
              <?php
                if ($rel) {$estado = $rel->getLessonStatus();} else {$estado = 'nointentado';}
                switch($estado)
                {
                  case 'nointentado': echo image_tag('nointentado.png','title=No intentado');  break;
                  case 'completed': echo image_tag('finalizado.png','title=Finalizado');  break;
                  case 'passed': echo image_tag('finalizado.png','title=Finalizado');  break;
                  default: echo image_tag('incompleto.png','title=Incompleto');  break;
                } // switch
              ?>
              </td>
              <?php if($is_alumno): ?>
              <td>
                  <?php if($rel): ?> 
                    <?php if($rel->getLessonStatus() != 'completed' && $rel->getLessonStatus() != 'passed'):?>
                      <?php echo link_to('Finalizar', 'contenidosTema/finishScorm?type=1&idcurso='.$curso->getId().'&idscorm='.$sco->getId().'&id_tema='.$tema_sc->getId()) ?>
                    <?php else: ?>
                      &nbsp;
                    <?php endif ?> 
                  <?php endif; ?>    
              </td>
              <?php endif ?> 
            </tr>
            <?php $i++; ?>
            <?php endforeach;?>
            <?php $for_ttt = segundos_tiempo($total);?>
            <?php $fot_ttt_arr= explode(':', $for_ttt); ?> 
            <?php $horas_t = $fot_ttt_arr[0]; ?>
            <?php $minutos_t = $fot_ttt_arr[1]; ?>
            <?php $segundos_t = $fot_ttt_arr[2]; ?>
          
        <?php endif; ?>
        </table>
      </div>

	    <div class="cursos">
	        <table style="width: 100%;">
	            <tr class="cont_fil">
	                <td style="width: 50%; text-align: left; padding-left: 5px;"">
	                <?php if ($materia->getTipo() == 'compo'): ?>
	                  <div style="display: block; margin-top: 3px; margin-bottom: 3px;">
                    Tiempo total invertido en el curso:
	                  <strong>
                    <?php

                      $c = new Criteria();
                      $c->add(Sco12Peer::ID_MATERIA, $materia->getId());
                      $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_usuario);
                      $c->addJoin(Sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12);
                      $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
                      if ($rel)
                      {
                        $ttotal = $rel->getTiempoTotal();
                        $for_tttt = segundos_tiempo($ttotal);
                        $fot_tttt_arr= explode(':', $for_ttt);
                        $horas = $fot_tttt_arr[0];
                        $minutos = $fot_tttt_arr[1];
                        $segundos = $fot_tttt_arr[2];
                        echo "$horas horas, $minutos minutos y $segundos segundos";
                      }
                      else
                      {
                        echo "0 horas y 0 minutos";
                      }
                    ?>
                    </strong></div>

                    <div style="display: block; margin-top: 3px; margin-bottom: 3px;">
                    <?php
                      if (!$rel)
                      {
                        $var_estado = 'No intentado';
                      }
                      else
                      {
                        switch ($rel->getLessonStatus())
                        {
                          case 'not attempted': $var_estado = 'No intentado'; break;
                          case 'browsed': $var_estado = 'En progreso'; break;
                          case 'incomplete': $var_estado = 'En progreso'; break;
                          case 'failed': $var_estado = 'En progreso'; break;
                          case 'completed': $var_estado = 'Completado'; break;
                          case 'passed': $var_estado = 'Completado'; break;
                          default: break;
                        }
                      }
                     
                    ?>
                    Estado actual: <strong><?php echo $var_estado; ?></strong>
                    </div>
                    <?php
                      $texto_puntuacion = '';
                      if ($var_estado != 'No intentado')
                      {
                        $score_raw = $rel->getScoreRaw();
                        if (!$score_raw) {$score_raw = 0;}
                        $score_max = $rel->getScoreMax();
                        
                        if ($score_max)
                        {
                          $texto_puntuacion = "<div style=\"display: block; margin-top: 3px; margin-bottom: 3px; \">Puntuaci&oacute;n: <strong>$score_raw / $score_max<strong></div>";
                        }
                      }
                      echo $texto_puntuacion;
                    ?>
	                <?php else: ?>
        	          <?php echo image_tag('nointentado.png'); ?> Tema no intentado.
        					 	<?php echo image_tag('incompleto.png'); ?> Tema incompleto.
        						<?php echo image_tag('finalizado.png'); ?> Tema finalizado.
	                <?php endif; ?>
                        </td>
                        <td style="width: 50%; text-align: right; padding-right: 5px;">
                          <?php if ($materia->getTipo() == 'scorm1.2') {echo "Tiempo total invertido en el curso: <strong>$horas_t</strong> horas &nbsp; <strong>$minutos_t</strong> minutos &nbsp; <strong>$segundos_t</strong> segundos ";} ?>
                        </td>
	            </tr>
	        </table>
	    </div>

      <?php use_helper('volver'); ?>
      <br /><br />
	    <?php if ($materia->getTipo() == 'compo'): ?>
        <center>
        <table border='0' width='100%'>
          <tr>
             <td width="259"><?php echo volver(); ?>             </td>
          <td>
            <!--div style="display:none;"><?php echo sexy_button_to('', '') ?></div-->
                <div class="sexy-button-clear">
                  <?php $link = 'curso/mostrarContenido?id='.$materia->getId(); ?>
                  <a class="sexy-button" onclick="window.open('<?php echo url_for($link) ?>', 'scormbrowser', 'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=0, scrollbars=0, height=<?php echo $materia->getHeight()?>, width=<?php echo $materia->getWidth()?>')" href="javascript:void(0)"><span>Ver contenido del curso</span></a>
                  <div style="display:none">
                    <?php echo link_to("", $link,(array('id' => 'ln_mostrar_tema0'))) ?>
                  </div>
                </div>
              </td>
          </tr>
        </table></center>
      <?php else : ?>
          <?php echo volver(); ?>
      <?php endif;?>
    </div>
    <div class="cierre_box_correo"></div>
</div>