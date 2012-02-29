<?php use_helper('Javascript','SexyButton','informacion') ?>

<?php if (isset($idcurso)) : ?>
      <?php $curso = CursoPeer::retrieveByPk($idcurso); ?>
      <?php $redireccion = "?idcurso=".$sf_user->getCursoMenu(); ?>
<?php else  : ?>
         <?php $redireccion = "?" ; ?>
<?php endif; ?>

<?php if (!isset($ajax)) : ?>
	<div id="indicador" style="background-color:#000000;color:#CCCC00;position:absolute;text-align:center;top:150px;left:470px;padding:65px;font-size:25px;font-weight:bold;width:380px;z-index:0;filter:alpha(opacity=40);float:left;-moz-opacity:.40;opacity:.40;">Cargando informacion de <?echo $curso->getNombre()?>...</div>
	<div id="resultado" style="z-index:5,display: none";></div>
     <?php if (isset($idusuario)) : ?>
          <?php $cad='&idusuario='.$idusuario?>
     <?php else :?>
           <?php $cad=''?>
     <?php endif; ?>
     <?   echo javascript_tag(
                        			 remote_function(array(
                                         					    'update'  => 'resultado',
                                          						'url'     => 'seguimiento/sourceHitos?idcurso='.$idcurso.$cad,
                                           						//'loading'  =>  visual_effect('appear', 'indicador'),
                                   								    'complete' =>  visual_effect('fade', 'indicador').visual_effect('appear', 'resultado').visual_effect('highlight', 'resultado').visual_effect('blinddown', 'indicador'),
                                                     )
                      							            )
                           )
      ?>
<? else :?>

    <div id="divplanificacion">
        <div class="tit_box_mensajes"><h2 class="titbox">Planificaci&oacute;n para el <?php echo $curso->getNombre() ?></h2></div>
          <div class="cont_box_correo">
                  <?php if ($sf_user -> hasCredential('profesor')) : ?>
                    <div class="herramientas_general_fixed"><?php echo link_to(image_tag('cambiar_planificacion.gif'),'seguimiento/seguimientoTemas'.$redireccion) ?></div><br>
                  <?php endif; ?>
                  <div id="scrolldiv">
                  <table class="tablaplanificacion" cellspacing="0">
                  <tr>
                  <td><?php echo image_tag('separadorh.gif','Alt=') ?></td>
                  <? $i=1; ?>
                  <?php foreach ($fechas as $fecha): ?>
                      <td>

                  	      <? echo image_tag('separadorh.gif','Alt=')."<br/><a href=\"javascript:void(0);\"
                  		   onmouseover=\"return overlib('$fecha[0] al $fecha[1]', CAPTION, 'Fecha')\"
                  		    onmouseout=\"nd()\">$i"."&ordf; $periodo</a>";
                  			$i++ ;?>
                      </td>
                  <? endforeach; ?>
                  </tr>

                  <tr class="filarecomendada">
                      <th>Planificacion recomendada</th>
                      <? $planificacionHitos = $curso->getHitosPlanificacion() ?>
                      <?php foreach ($fechas as $fecha): ?>
                      <td>
                          <?php foreach ($planificacionHitos as $planificacionHito): ?>
                             <?     $fechaHitoFin = $planificacionHito->getFechaCompletado("d-m-Y");
                    			      $diaHitoFin=substr($fechaHitoFin,0,2);
                    			      $mesHitoFin=substr($fechaHitoFin,3,2);
                    			      $anioHitoFin=substr($fechaHitoFin,6,4);

                    			   	  $dia1=substr($fecha[0],0,2);
                    				  $mes1=substr($fecha[0],3,2);
                    				  $anio1=substr($fecha[0],6,4); //inicio periodo

                    				  $dia2=substr($fecha[1],0,2);
                    				  $mes2=substr($fecha[1],3,2);
                    				  $anio2=substr($fecha[1],6,4); //fin periodo
                                      //echo "fecha1=".$dia1."-".$mes1."-".$anio1."<br>" ;
                                      //echo "fecha2=".$dia2."-".$mes2."-".$anio2."<br>" ;
                    				  $compFechas = $c->getCalendar()->compareDates($dia1,$mes1,$anio1,$diaHitoFin,$mesHitoFin,$anioHitoFin);
                    				  $compFechas2 = $c->getCalendar()->compareDates($dia2,$mes2,$anio2,$diaHitoFin,$mesHitoFin,$anioHitoFin);
                                      // echo "com1=".$compFechas."  com2=".$compFechas2."<br><br>" ;
                    				  if ( (  (-1==$compFechas ) || (0==$compFechas )) && ( (1==$compFechas2 ) || (0==$compFechas2 ) ) )
                  				  { // inicio periodo <= fechaHitoIni => fin periodo
                  				    $cadena1="Tema ".$planificacionHito->getTema()->getNumeroTema().": ".$planificacionHito->getTema()->getNombre()."<br>Fecha fin deseable= ".$planificacionHito->getFechaCompletado("d-m-Y");
                  				     echo "<a href=\"javascript:void(0);\"
                  		   					onmouseover=\"return overlib('$cadena1', CAPTION, 'HITO')\"
                  		    				onmouseout=\"nd()\">".image_tag('ico_p_profesor.gif','Alt=')."</a>";
                  				  }
                    			?>
                    	    <? endforeach; ?>&nbsp;
                      </td><?php //echo "fin foreach planificacionHitos 1<br>"?>
                      <? endforeach; ?><?php //echo "fin foreach fechas 2<br>"?>
                  </tr>
                  <?php $numalumnos = 0 ?>
                  <?php foreach ($alumnos as $alumno): ?>
                  <?php $numalumnos++; ?>
                  <tr class="filaalumno">
                    <th><? echo $alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() ?></th>

                    <?php foreach ($fechas as $fecha): ?>
                      <td>
                           <? $hitos = $alumno->getUsuario()->getHitos($idcurso,$fecha[0],$fecha[1]) ?>
                           <?php foreach ($hitos as $hito): ?>
                                  <? //echo $fecha[0]." ".$fecha[1]
                                				    $dia1=substr($fecha[0],0,2);
                                  				  $mes1=substr($fecha[0],3,2);
                                  				  $anio1=substr($fecha[0],6,4); //inicio periodo

                                  				  $dia2=substr($fecha[1],0,2);
                                  				  $mes2=substr($fecha[1],3,2);
                                  				  $anio2=substr($fecha[1],6,4); //fin periodo

                                  				  $diaHitoIni=$hito->getFechaInicio("d");
                                  				  $mesHitoIni=$hito->getFechaInicio("m");
                                  				  $anioHitoIni=$hito->getFechaInicio("Y");

                                  				  $diaHitoFin=$hito->getFechaCompletado("d");
                                  				  $mesHitoFin=$hito->getFechaCompletado("m");
                                  				  $anioHitoFin=$hito->getFechaCompletado("Y");

                                  				  $compFechas = $c->getCalendar()->compareDates($dia1,$mes1,$anio1,$diaHitoIni,$mesHitoIni,$anioHitoIni);
                                  				  $compFechas2 = $c->getCalendar()->compareDates($dia2,$mes2,$anio2,$diaHitoIni,$mesHitoIni,$anioHitoIni);

                                  				  $compFechas3 = $c->getCalendar()->compareDates($dia1,$mes1,$anio1,$diaHitoFin,$mesHitoFin,$anioHitoFin);
                                  				  $compFechas4 = $c->getCalendar()->compareDates($dia2,$mes2,$anio2,$diaHitoFin,$mesHitoFin,$anioHitoFin);

                                  				  $cadena = $hito->getTema()->getNombre()."<br>";
                                  				  if ( (  (-1==$compFechas ) || (0==$compFechas )) && ( (1==$compFechas2 ) || (0==$compFechas2 ) ) )
                                  				  { // inicio periodo <= fechaHitoIni => fin periodo
                                  				    $cadena1=$cadena."Estado= Iniciado<br>Fecha:".$hito->getFechaInicio("d-m-Y");
                                  				     echo "<a href=\"javascript:void(0);\"
                                  		   					onmouseover=\"return overlib('$cadena1', CAPTION, 'HITO')\"
                                  		    				onmouseout=\"nd()\">".image_tag('ico_p_start.gif','Alt=')."</a>";
                                  				  }
                                  				  if(2==$hito->getEstado())
                                  				    {  if ( (  (-1==$compFechas3 ) || (0==$compFechas3 )) && ( (1==$compFechas4 ) || (0==$compFechas4 ) ) )
                                  				          { // inicio periodo <= fechaHitoFin => fin periodo

                                  					       		$c2 = new Criteria();
                                  				            $c2->add(Rel_curso_temaPeer::ID_TEMA, $hito->getTema()->getId());
                                  				            $planificacion = $curso->getHitosPlanificacion($c2);
                                  				            $cadena2=$cadena."Estado= Finalizado<br>Fecha:".$hito->getFechaCompletado("d-m-Y")."<br>";
                                  				            if ($planificacion)
                                                      {
                                  				               	   	$diaHitoDeseable=$planificacion[0]->getFechaCompletado("d");
                                    				           		   	$mesHitoDeseable=$planificacion[0]->getFechaCompletado("m");
                                    				           				$anioHitoDeseable=$planificacion[0]->getFechaCompletado("Y");

                                                              $compFechas5 = $c->getCalendar()->compareDates($diaHitoFin,$mesHitoFin,$anioHitoFin,$diaHitoDeseable,$mesHitoDeseable,$anioHitoDeseable);
                                                              if ( (-1==$compFechas5) || (0==$compFechas5))
                                                              {
                                    				           	   			 $cadena2 .=  "Completado: en Fecha";
                                    				           	   			 $icono = 'ico_p_endok.gif';
                                    				            			} else {
                                                                 					$cadena2 .=  "Completado: fuera de tiempo";
                                                                 					$icono = 'ico_p_endfuera.gif';
                                                                      }
                                  				  	          }
                                  				  	         else {$icono = 'ico_p_endok.gif';}

                                  				  	        echo "<a href=\"javascript:void(0);\"
                                  		   					          onmouseover=\"return overlib('$cadena2', CAPTION, 'HITO')\"
                                  		    				          onmouseout=\"nd()\">".image_tag($icono,'Alt=')."</a>";
                                  				          }
                                  					}
                  								unset($hito); //liberar memoria
                                                ?>
                           <? endforeach; ?>&nbsp;
                      </td><?php unset($hitos);//echo "fin foreach hitosAlumnos 3<br>"?>
                  <? endforeach; ?>
                  </tr><?php //echo "fin foreach fechas 4<br>"?>
                  <? endforeach; ?><?php //echo "fin foreach alumnos 5<br>"?>
                  <?php if ($numalumnos > 10) : ?>

                  <tr class="filarecomendada">
                      <th>Planificacion recomendada</th>
                      <? /*$planificacionHitos = $curso->getHitosPlanificacion() */?>
                      <?php foreach ($fechas as $fecha): ?>
                      <td>
                          <?php foreach ($planificacionHitos as $planificacionHito): ?>
                             <? $fechaHitoFin = $planificacionHito->getFechaCompletado("d-m-Y");
                    			      $diaHitoFin=substr($fechaHitoFin,0,2);
                    			      $mesHitoFin=substr($fechaHitoFin,3,2);
                    			      $anioHitoFin=substr($fechaHitoFin,6,4);

                    			   	  $dia1=substr($fecha[0],0,2);
                    				    $mes1=substr($fecha[0],3,2);
                    				    $anio1=substr($fecha[0],6,4); //inicio periodo

                    				    $dia2=substr($fecha[1],0,2);
                    				    $mes2=substr($fecha[1],3,2);
                    				    $anio2=substr($fecha[1],6,4); //fin periodo

                    				    $compFechas = $c->getCalendar()->compareDates($dia1,$mes1,$anio1,$diaHitoFin,$mesHitoFin,$anioHitoFin);
                    				    $compFechas2 = $c->getCalendar()->compareDates($dia2,$mes2,$anio2,$diaHitoFin,$mesHitoFin,$anioHitoFin);

                        				 if ( (  (-1==$compFechas ) || (0==$compFechas )) && ( (1==$compFechas2 ) || (0==$compFechas2 ) ) )
                      				  { // inicio periodo <= fechaHitoIni => fin periodo
                      				    $cadena1="Tema ".$planificacionHito->getTema()->getNumeroTema().": ".$planificacionHito->getTema()->getNombre()."<br>Fecha fin deseable= ".$planificacionHito->getFechaCompletado("d-m-Y");
                      				     echo "<a href=\"javascript:void(0);\"
                      		   					onmouseover=\"return overlib('$cadena1', CAPTION, 'HITO')\"
                      		    				onmouseout=\"nd()\">".image_tag('ico_p_profesor.gif','Alt=')."</a>";
                      				  }
                    			?>
                    	    <? endforeach; ?>&nbsp;
                      </td><?php //echo "fin foreach planificacionHitos 6<br>"?>
                      <? endforeach; ?><?php //echo "fin foreach fechas 7<br>";?>
                  </tr>

                  <tr>
                  <td>&nbsp;</td>
                  <? $i=1; ?>
                  <?php foreach ($fechas as $fecha): ?>
                      <td>

                  	      <? echo "<a href=\"javascript:void(0);\"
                  		              onmouseover=\"return overlib('$fecha[0] al $fecha[1]', CAPTION, 'Fecha')\"
                  		              onmouseout=\"nd()\">$i"."&ordf; $periodo</a>";
                  			$i++ ;?>
                      </td>
                  <? endforeach; ?>
                  </tr><?php //echo "fin foreach ferchas 8<br>"?>

                  <? endif; ?>

                  </table>
            </div>
            <div class="cursos">
    	        <table class="tablacursos">
    	            <tr class="cont_fil">
    	                <td>
              						<?php echo image_tag('ico_p_start.gif'); ?> Tema iniciado.
              					 	<?php echo image_tag('ico_p_endok.gif'); ?> Tema finalizado dentro de plazo.
              					 	<?php echo image_tag('ico_p_endfuera.gif'); ?> Tema finalizado fuera de plazo.
              						<?php echo image_tag('ico_p_profesor.gif'); ?> Finalizaci&oacute;n de tema recomendada.
    					       </td>
    	            </tr>
    	        </table>
    	    </div>
    	   <? echoNotaInformativa('Ayuda', "Desde este gr&aacute;fica podrá observar la planificaci&oacute;n recomendada por el profesor para el estudio de cada tema.");?>
    	   <br>
         <? use_helper('volver');  echo volver();     ?>

        </div>
        <div class="cierre_box_correo" ></div>
    </div>
<?php endif; /*(isset($ajax))*/?>
