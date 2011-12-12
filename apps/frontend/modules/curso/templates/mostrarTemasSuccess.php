<?php
    use_helper('SexyButton','tiempo');
?>
<div id="mistemas">
  <div class="tit_box_mensajes"><h2 class="titbox"><?= $curso->getNombre(120); ?></h2></div>
    <div class="cont_box_correo">
      <div class="nombrescol">
          <table class="tablatemas" cellspacing="0">
                <tr>
                  <?php if ($materia->getTipo() == 'segmentada'): ?>
                    <th style="text-align: left; width: 70%; padding-left: 4px;"><div class='temario'>Temario</div></th>
                    <th style="text-align: center; width: 20%;">Tiempo empleado</th>
                    <th style="text-align: center; width: 10%;">Estado</th>
                  <?php endif; ?>

                  <?php if ($materia->getTipo() == 'compo'): ?>
                    <th style="text-align: left; width: 70%; padding-left: 4px;"><div class='temario'>Temario</div></th>
                    <th style="text-align: center; width: 20%;">&nbsp;</th>
                    <th style="text-align: center; width: 10%;">&nbsp;</th>
                  <?php endif; ?>

                  <?php if ($materia->getTipo() == 'scorm1.2'): ?>
                    <th style="text-align: left; width: 70%; padding-left: 4px;"><div class='temario'>Temario</div></th>
                    <th style="text-align: center; width: 20%;">Tiempo empleado</th>
                    <th style="text-align: center; width: 10%;">Estado</th>
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
              <td style="text-align: left; width: 70%; padding-left: 4px;">
                <?php echo link_to($tema->getNumeroTema().'. '.$tema->getNombre(), '/contenidosTema/verFichero?id='.$tema->getId().'&idmateria='.$tema->getIdMateria(), array( 'popup' => array('', "width=$width,height=$height,left=0,top=0,scrollbars=yes,resizable=yes"))); ?>
              </td>

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

              <td style="text-align: left; width: 70%; padding-left: 4px;">
                <?php echo $tema->getNombre(); ?>
              </td>
              <td style="text-align: center; width: 20%;">&nbsp;</td>
              <td style="text-align: center; width: 10%;">&nbsp;

              </td>
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

              <td style="text-align: left; width: 65%; padding-left: 4px;">
                <a style="color:#003399;" href="javascript:void(0)" onclick="window.open('<?php echo url_for('curso/mostrarContenido?sco12id='.$sco->getId()) ?>', 'scormbrowser', 'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=0, scrollbars=0, height=<?php echo $materia->getHeight()?>, width=<?php echo $materia->getWidth()?>')"><?php echo $sco->getTitle(); ?></a>
              </td>

                <?php $c = new Criteria();?>
                <?php $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco->getId());?>
                <?php $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_usuario);?>
                <?php $rel = Rel_usuario_sco12Peer::DoSelectOne($c);?>
                <?php if ($rel): ?>
                <td style="text-align: right; padding-right: 24px; width: 25%;">
                  <?php $tt = $rel->getTiempoTotal(); $total += $tt;?>
                  <?php $horas = floor($tt/3600); ?>
                  <?php $minutos = (floor($tt/60) % 60); ?>
                  <?php if ($horas) {$texto_horas = sprintf("<strong>%02d</strong> horas &nbsp;", $horas);} else {$texto_horas = '';} ?>
                  <?php if ($minutos) {$texto_minutos = sprintf("<strong>%02d</strong> minutos", $minutos);} else {$texto_minutos = '00 minutos';} ?>
                  <?php echo $texto_horas.$texto_minutos;?>
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
                  default: echo image_tag('incompleto.png','title=Incompleto');  break;
                } // switch
              ?>
              </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach;?>
            <?php $horas = floor($total/3600); ?>
            <?php $minutos = (floor($total/60) % 60); ?>
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
                        $horas = floor($ttotal / 3600);
                        $minutos = (floor($ttotal / 60) % 60);
                        echo "$horas horas y $minutos minutos";
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
					        <?php if ($materia->getTipo() == 'scorm1.2') {printf("Tiempo total invertido en el curso: <strong>%02d</strong> horas &nbsp; <strong>%02d</strong> minutos", $horas, $minutos);} ?>
					      </td>
	            </tr>
	        </table>
	    </div>

      <? use_helper('volver'); ?>
      <br /><br />
	    <?php if ($materia->getTipo() == 'compo'): ?>
        <center>
        <table border='0' width='100%'>
          <tr>
             <td width="259"><? echo volver(); ?>             </td>
          <td>
            <!--div style="display:none;"><?php echo sexy_button_to('', '') ?></div-->
                <div class="sexy-button-clear">
                  <? $link = 'curso/mostrarContenido?id='.$materia->getId(); ?>
                  <a class="sexy-button" onclick="window.open('<?php echo url_for($link) ?>', 'scormbrowser', 'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=0, scrollbars=0, height=<?php echo $materia->getHeight()?>, width=<?php echo $materia->getWidth()?>')" href="javascript:void(0)"><span>Ver contenido del curso</span></a>
                  <div style="display:none">
                    <?php echo link_to("", $link,(array('id' => 'ln_mostrar_tema0'))) ?>
                  </div>
                </div>
              </td>
          </tr>
        </table></center>
      <? else : ?>
          <? echo volver(); ?>
      <?php endif;?>

    </div>
    <div class="cierre_box_correo"></div>
</div>
