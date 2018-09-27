<?php slot('columna_derecha') ?>
    <?php if (!isset($idcurso)): ?>
        <?php include_component('calendario', 'mostrarCalendario'); ?>
    <?php else : ?>
       <?php include_component('calendario', 'mostrarCalendario', array('idcurso' => $idcurso)); ?>
	<?php endif; ?>
<?php end_slot() ?>

<div class="tit_box_calendario"><h2 class="titbox">Eventos pr&oacute;ximos <?php echo (isset($idcurso))? $curso->getNombre() : "Calendario Principal"?></h2></div>
<div class="cont_box_grande">
<?php use_helper('Javascript') ?>
  <div id="indicador" style="display: none">Procesando sus eventos...</div>
  <div id="eventosProximos">
  <table cellpadding="0" cellspacing="0" class="listaeventos">
  <?php $i = 0; ?>
  <?php	foreach( $eventosProximos as $evento): ?>
    <?php $i++; ?>
	<?php if (null==$evento->getTipo_evento()) :?>
      <?php $tipo = $evento->getTipo_cita()->getClase() ;
            $desc = $evento->getTipo_cita()->getDescripcion() ;  ?>
    <?php else :?>
    <?php	 $tipo = $evento->getTipo_evento()->getClase();
    	     $desc = $evento->getTipo_evento()->getDescripcion();?>

    <?php endif; ?>
    <tr class="filafecha">
      <td>
        <?php if ((isset($idcurso))) :  ?>
           <?php $result = $sf_user->getDiasConfCalendario($idcurso); ?>
        <?php else : ?>
           <?php $result = $sf_user->getDiasConfCalendario(); ?>
		<?php endif; ?>
        <?php  $c = new sfEventCalendar('month', date("Y-m-d"));
		       $numDias = $c->getCalendar()->dateDiff( $evento->getFechaInicio("d"),$evento->getFechaInicio("m"), $evento->getFechaInicio("Y"),
		                                               date("d"),date("m"),date("Y"));
               $compFechas = $c->getCalendar()->compareDates($evento->getFechaInicio("d"),$evento->getFechaInicio("m"), $evento->getFechaInicio("Y"),
		                                               date("d"),date("m"),date("Y"));
    		   //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller?>
    		   <?php if ((-1==$compFechas) && ($numDias > $result[0]) ) : ?>
    		       <?php echo $evento->getFechaFin("d-m-Y");
				      $evento->setTitulo($evento->getTitulo()." (FINALIZACION)");?>
    		   <?php else : ?>
    		       <?php echo $evento->getFechaInicio("d-m-Y"); ?>
    		   <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>
        <table class="tablaint">
          <tr>
            <td id="tdcolor" class="<?php echo $tipo ?>" width="15">&nbsp;</td>
            <td>
              <table class="tablaint2">
                <tr class="filint">
                  <td><?php  echo link_to_remote($desc.": ".$evento->getTitulo(), array(
      								'update' => 'eventos'.$i,
      							    'url'    => 'calendario/verEventoId?id='.$evento->getId().'&idcapa=eventos'.$i,
      							    'complete' =>  visual_effect('appear', 'eventos'.$i)
  								                                                        )
  								    )?></td>
                </tr>
                <tr class="filint">
                  <td>
                    <?php echo substr($evento->getDescripcion(), 0, 50);?><?php echo (strlen($evento->getDescripcion())>50) ? "...":"" ;?>
                    <div id="eventos<?php echo $i?>" style="display: none"></div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  <?php endforeach; ?>
    <?php if ($i == 0) : ?>
      <tr>
        <td class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?> <span class="txtinfo">No tiene ning&uacute;n evento pr&oacute;ximo.</span></td>
      </tr>
    <?php endif; ?>
  </table>
  </div>
  <div id="eventos" style="display: none"></div>
</div>
<div class="cierre_box_grande"></div>


