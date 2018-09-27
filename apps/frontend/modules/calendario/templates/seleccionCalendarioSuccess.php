 <table border='1'>
  <tr><td colspan='9'><?php echo $nombreMes." ".$anio ?></td>
  </tr>
  <tr>
    <td>L</td>
    <td>M</td>
    <td>X</td>
    <td>J</td>
    <td>V</td>
    <td>S</td>
    <td>D</td>

  </tr>
<?php use_helper('Javascript') ?>
<?php  foreach ($calendar as $week) : ?>
      <tr>
      <?php  foreach ($week as $day => $events) : ?>
         <?php   if (!empty($events)) : ?>
             <?php  foreach ($events as $event) : ?>
				   <td><?php  echo link_to_remote(date('d', strtotime($day)), array(
    								'update' => 'evento',
    							    'url'    => '/calendario/anadirEvento?'.$event['url'],
    					            'complete' =>  visual_effect('grow', 'eventos')
								), array(  'alt'   => $event['tipo'],
											)
						        )
							?>
					</td>
			  <?php endforeach; ?>
		  <?php else : ?>
 			<td><?php
                   echo link_to_remote(date('d', strtotime($day)), array(
    								'update' => 'evento',
    							    'url'    => '/calendario/anadirEvento?fecha='.$day."&alumno=".$alumno."&curso=".$curso,
    					            'complete' =>  visual_effect('grow', 'eventos')
								), array( 								)
						        )?>
			</td>
         <?php endif; ?>
       <?php endforeach; ?>
	   </tr>
<?php endforeach; ?>
</table>

<div id="indicador" style="display: none">Procesando sus eventos...</div>
<div id="eventos"></div>

