<?php use_helper('Javascript') ?>

<script type="text/javascript">
	function checkTicketComentario()
	{
		var comentario = document.getElementById('tck_comentario');
		
		if (comentario.value == '') {
			alert('Escriba su comentario para continuar'); comentario.focus(); return false;
		}
		return true;
	}
</script>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes">
  	<h2 class="titbox">Detalle del Ticket - Código [<?php echo $codigo ?>]</h2>
  </div>
  <div class="cont_box_correo">
		<?php
			$i = 0;
			$ori_estado  = $original->getEstado();
			$ori_updated = $original->getActualizado('H:i d/m/Y');
			$ori_closed  = $original->getCerrado('H:i d/m/Y');
		?>
  	<table width="100%">
  		<tr>
  			<td style="text-align:left;">
  				Creado: <strong><?php echo $original->getAbierto('H:i d/m/Y'); ?></strong>
  			</td>
  			<td>
  			<?php if (!empty($ori_updated)): ?>
  				Actualizado: <strong><?php echo $ori_updated ?></strong>
  			<?php endif; ?>
  			<?php if (!empty($ori_closed)): ?>
  				&nbsp;|&nbsp;Cerrado: <strong><?php echo $ori_closed ?></strong>
  			<?php endif; ?>
  			</td>
  			<td style="text-align:right;">
  				Estado actual: <strong><?php echo $ori_estado; ?></strong>
  			</td>
  		</tr>
  		<tr><td height="10"></td></tr>
  	</table>

	  <?php foreach($detalles as $detalle): ?>
      <?php $fondo = (($i % 2 == 0)) ? 'e7e7e7' : 'FFFFFF'; ?>
      
    	<table cellspacing="5" style="background-color:#<?php echo $fondo ?>;" width="100%">
    		<?php
    			$asunto = $detalle->getAsunto();
    			$autor  = $detalle->getAutor();
    		?>
    		<tr>
    			<td style="padding:3px;text-align:left;border-bottom:1px solid #CCCCCC;">
	    			<strong>
		    		<?php if (!empty($asunto)): ?>
							<?php echo $detalle->getAsunto() ?>
		    		<?php else: ?>
							<?php if ($autor == 'alumno'): ?>
								Comentario agregado
							<?php else: ?>
								<label style="color:#095d64;">Respuesta del Administrador</label>
							<?php endif; ?>
							 | <?php echo $detalle->getAbierto('H:i d/m/Y') ?>
		    		<?php endif; ?>
		    		</strong>
    			</td>
    		</tr>
    		<tr>
    			<td style="padding:3px;text-align:left;">
    				<?php echo nl2br($detalle->getMensaje()) ?>
    			</td>
    		</tr>
    	</table>
      <br />
      <?php $i++; ?>
    <?php endforeach; ?>

    <?php if ($ori_estado != 'CERRADO'): ?>
    <br />
    <form method="POST" action="<?php echo url_for('ticket/ticketAlumnoDetalle?codigo='.$codigo) ?>" enctype="multipart/form-data">
    	<table width="100%">
    		<tr>
    			<td style="padding:5px;background-color:#ddfcd5;"><strong>Agregar un comentario</strong></td>
    		</tr>
    		<tr>
    			<td style="text-align:left;">
    				<textarea id="tck_comentario" name="tck_comentario" style="width:728px;height:100px;"><?php echo $coment ?></textarea>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				<input class="btn_et_submit" name="rec_comment" type="submit" value="Registrar" onclick="return checkTicketComentario();" />
    			</td>
    		</tr>
    	</table>
    </form>
    <?php endif; ?>
    <br />
    <a style="float:left;" href="<?php echo url_for('ticket/ticketsAlumno') ?>">
    	<strong><em>Listado de Tickets</em></strong>
    </a>
  </div>
 <div class="cierre_box_correo"></div>
</div>