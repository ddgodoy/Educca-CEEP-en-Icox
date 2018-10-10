<?php use_helper('Javascript') ?>
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
        <?php echo $evento->getFechaInicio("d-m-Y"); ?>
      </td>
    </tr>
    <tr>
      <td>
        <table class="tablaint">
          <tr>
            <td id="tdcolor" class="<?php echo $tipo ?>">&nbsp;</td>
            <td>
              <table class="tablaint2">
                <tr class="filint">
                  <td><?php  echo $evento->getTitulo()?></td>
                </tr>
                <tr class="filint">
                  <td>
                    <?php echo $evento->getDescripcion();  ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  <?php endforeach; ?>
      <tr>
      <?php if ($i == 0) : ?>
        <td class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?> <span class="txtinfo">No tiene ning&uacute;n evento pr&oacute;ximo en los próximos 7 d&iacute;as.</span></td>
    <?php endif; ?>
     </tr>
  </table>
  </div>


