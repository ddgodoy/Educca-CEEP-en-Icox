<div id='capaCalendario'>
<div class="tit_box_calendariop"><h2 class="titbox">Calendario</h2></div>
    <?php use_helper('Javascript') ?>
    <div class="cont_box_pequeno">
      <div class="cont_calendario">
      <center>
	   <table class="tablaPrincipal" cellpadding="0" cellspacing="1">
        <tr>
          <td class="filaMesAnyo" colspan='7'><?php echo $nombreMes." ".$anio ?></td>
        </tr>
        <tr class="textoNombresDia">
          <td class="filaNombresDia" width="14%">L</td>
          <td class="filaNombresDia" width="14%">M</td>
          <td class="filaNombresDia" width="14%">X</td>
          <td class="filaNombresDia" width="14%">J</td>
          <td class="filaNombresDia" width="14%">V</td>
          <td class="filaNombresDia" width="14%">S</td>
          <td class="filaNombresDia" width="14%">D</td>
        </tr>

        <?php $mesAnterior = true; ?>
        <?php $mesSig = false; ?>
        <?php $diaAnterior = 0; ?>
        <? $tipo_evento= array();?>
        <?php  foreach ($calendar as $week) : ?>
              <tr class="rows">
              <?php  foreach ($week as $day => $events) : ?>
                    <?php  if (date('d', strtotime($day)) == '01') : ?>
                                <?php $mesAnterior = false; ?>
                     <?php endif; ?>
                      <?php $hoy = (int)date('d', strtotime($day)); ?>
      				 <?php   if (  (!$mesAnterior)&&($diaAnterior > $hoy)) : ?>
                                         <?php $mesSig = true; ?>
      				<?php endif; ?>
      				<?php   if   (!$mesAnterior): ?>
                     				<?php $diaAnterior= (int) date('d', strtotime($day)); ?>
                     	<?php endif; ?>

                 <?php   if (!empty($events)) : ?>
                     <?php  foreach ($events as $event) : ?>
                                   <!--td class="s22"-->
      							    <?php if ($arrayFechas[$event['fecha']] > 1) :?>
                                        <td class="multiple">
                                        <? $tipo_evento["multiple"] =1  ;?>
                        <?php else :?>
                                   	  <?php  echo "<td class=\"".$event['clase']."\">" ?>
                                   	  <? $tipo_evento[$event['clase']] =1  ;?>
      							   <?php endif; ?>

      							    <?php $dayFecha = substr($day,8,2)."/".substr($day,5,2)."/".substr($day,0,4);?>
      							    <?php if (isset($idcurso)) : ?>
      							            <? $url = $event['url']."&idcurso=".$idcurso ?>
      							    <?php else : ?>
      							            <? $url = $event['url'] ?>
									       <? endif; ?>

      							    <?php  echo link_to_remote(date('d', strtotime($day)), array(
            								'update' => 'eventos',
            							    'url'    => $url,
            					            'complete' =>  visual_effect('appear', 'eventos')
        								), array( 'class' => 'linkq',
                                  'alt'   => $event['clase'],
        										  'onmouseover' => "overlib('".$cadOverLib[$event['fecha']]."', CAPTION,'$dayFecha', FGCOLOR, '#FFFFFF', BGCOLOR, '#CCCCCC', BORDER, '2')",
        										  'onmouseout' => 'nd()'
        											)
        						        );?></td>
        			        <?php endforeach; ?>
        		  <?php else : ?>
        		        <?php   if ($mesAnterior) : ?>
        		               <td class="mesAnterior"><?php echo date('d', strtotime($day));  ?></td>
      			   	   <?php else : ?>
      			   	        <?php   if ($mesSig) : ?>
      			   	           <td class="mesSiguiente"><?php echo date('d', strtotime($day));  ?></td>
      			   	           <?php else : ?>
         					            <?php  echo ($day == date('Y-m-d')) ? '<td class="s21 today">' : '<td class="s2">';
         					                       if ($day == date('Y-m-d')) {  $tipo_evento["s21 today"] =1;        }
                      		               echo date('d', strtotime($day)); ?></td>
                               <?php endif; ?>
                     <?php endif; ?>
                 <?php endif; ?>
                 <!--/td-->
               <?php endforeach; ?>
              </tr>
        <?php endforeach;?>
        </table>
        <table class="navTabla" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td align="left" width="33%">
            <?php if (isset($idcurso)) : ?>
			     <?php /* echo link_to('&lt;&lt;', 'calendario/mostrarCalendario?fecha='.$anterior.'&idcurso='.$idcurso) */?>
			      <?php echo link_to_remote(image_tag('ico_ant.gif'), array(
    															'update' => 'capaCalendario',
    															'url'    => 'calendario/verCalendarioAjax?fecha='.$anterior.'&idcurso='.$idcurso,
    															'loading'  =>  visual_effect('appear', 'indical'),
    															'complete' =>  visual_effect('fade', 'indical')
																)
														, array(  'onmouseover' => "overlib('mes anterior',LEFT, WIDTH, 80, FGCOLOR, '#FFFFFF')",
        										  					'onmouseout' => 'nd()'
        											             )
				  ) ?>
			<?php else : ?>
			      <?php /*echo link_to('&lt;&lt;', 'calendario/mostrarCalendario?fecha='.$anterior) */?>
			      <?php echo link_to_remote(image_tag('ico_ant.gif'), array(  'update' => 'capaCalendario',
    															'url'    => 'calendario/verCalendarioAjax?fecha='.$anterior,
    															'loading'  =>  visual_effect('appear', 'indical'),
    															'complete' =>  visual_effect('fade', 'indical')
    														)
    													, array(  'onmouseover' => "overlib('mes anterior',LEFT, WIDTH, 80, FGCOLOR, '#FFFFFF')",
        										  					'onmouseout' => 'nd()'
        											             )
			) ?>
			<?php endif; ?>
      	  <div id="respuesta"></div>
      	  </td>
            <td align="center" width="34%">&nbsp;</td>
            <td align="right" width="33%">
			<?php if (isset($idcurso)) : ?>
				<?php /* echo link_to('&gt;&gt;', 'calendario/mostrarCalendario?fecha='.$siguiente.'&idcurso='.$idcurso) */?>
				 <?php echo link_to_remote(image_tag('ico_sig.gif'), array(
    															'update' => 'capaCalendario',
    															'url'    => 'calendario/verCalendarioAjax?fecha='.$siguiente.'&idcurso='.$idcurso,
    															'loading'  =>  visual_effect('appear', 'indical')
																)
														, array(  'onmouseover' => "overlib('mes siguiente',LEFT, WIDTH, 80, FGCOLOR, '#FFFFFF')",
        										  					'onmouseout' => 'nd()'
        											             )
				) ?></td>
			<?php else : ?>
				<?php /*echo link_to('&gt;&gt;', 'calendario/mostrarCalendario?fecha='.$siguiente) */?>
				<?php echo link_to_remote(image_tag('ico_sig.gif'), array(
    															'update' => 'capaCalendario',
    															'url'    => 'calendario/verCalendarioAjax?fecha='.$siguiente,
    															'loading'  =>  visual_effect('appear', 'indical')
															)
														, array(  'onmouseover' => "overlib('mes siguiente',LEFT, WIDTH, 80, FGCOLOR, '#FFFFFF')",
        										  					'onmouseout' => 'nd()'
        											             )
				) ?></td>
			<?php endif; ?>

          </tr>
        </table>

            <div id="leyenda">
              <?php include_partial('calendario/leyenda',array('eventos' => $tipo_evento)) ?>
            </div>
        </center>
      </div>
    </div>

    <div class="cierre_box_pequeno"></div>
    <div id="preindical"><div id="indical" style="display:none;">Cargando...</div></div>
</div><!--capacalendario-->
