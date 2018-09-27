<?php use_helper('Javascript') ?>

<script type="text/javascript">
	function checkTicketRespuesta()
	{
		var respuesta = document.getElementById('adm_respuesta');
		
		if (respuesta.value == '') {
			alert('Escriba su respuesta para continuar'); respuesta.focus(); return false;
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
  				Cerrado: <strong><?php echo $ori_closed ?></strong>
  			<?php endif; ?>
  			</td>
  			<td style="text-align:right;">
  				<?php
						if ($ori_estado == 'NO REVISADO')
						{
							$fix = TicketPeer::RetrieveByPk($original->getId());
							$fix->setEstado('REVISADO');
							$fix->save();
							
							$ori_estado = 'REVISADO';
						}
  				?>
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
    			$obAlum = $detalle->getUsuarioRelatedByIdAlumno();
    		?>
    		<tr>
    			<td style="padding:3px;text-align:left;border-bottom:1px solid #CCCCCC;">
	    			<strong>
		    		<?php if (!empty($asunto)): ?>
		    			<table cellpadding="0" cellspacing="0" width="100%">
		    				<tr>
		    					<td><?php echo $detalle->getAsunto() ?></td>
		    					<td style="text-align:right;">
		    						&nbsp;<em><?php echo $obAlum->getNombre().' '.$obAlum->getApellidos(); ?></em>
		    					</td>
		    				</tr>
		    			</table>
		    		<?php else: ?>
							<?php if ($autor == 'alumno'): ?>
								Comentario agregado por el alumno
							<?php else: ?>
								<label style="color:#095d64;">Respuesta del Administrador</label>
							<?php endif; ?>
							 | <?php echo $detalle->getAbierto('H:i d/m/Y') ?>
		    		<?php endif; ?>
		    		</strong>
    			</td>
    		</tr>
    		<tr><td style="padding:3px;text-align:left;"><?php echo nl2br($detalle->getMensaje()) ?></td></tr>
    	</table>
      <br />
      <?php $i++; ?>
    <?php endforeach; ?>
    <br />
    <form method="POST" action="<?php echo url_for('ticket/ticketAdminDetalle?codigo='.$codigo) ?>" enctype="multipart/form-data">
    	<table width="100%">
    		<tr>
    			<td style="padding:5px;background-color:#ddfcd5;"><strong>Enviar una respuesta</strong></td>
    		</tr>
    		<tr>
    			<td style="text-align:left;">
    				<textarea id="adm_respuesta" name="adm_respuesta" style="width:728px;height:100px;"><?php echo $respta ?></textarea>
    			</td>
    		</tr>
    		<tr><td height="5"></td></tr>
    		<tr>
    			<td>
    				<table cellpadding="0" cellspacing="0" align="center">
    					<tr>
    						<td>
    							<input class="btn_et_submit" name="rec_respuesta" type="submit" value="Enviar y establecer estado como" onclick="return checkTicketRespuesta();" />
    						</td>
    						<td style="padding-left:10px;">
	    						<select name="adm_estado" class="txt_et_form2">
	    							<?php if ($ori_estado != 'EN PROCESO'): ?>
	    								<option value="EN PROCESO"<?php if ($estado == 'EN PROCESO') { echo ' selected'; } ?>>EN PROCESO</option>
	    							<?php endif; ?>
			    					<option value="CERRADO"<?php if ($estado == 'CERRADO') { echo ' selected'; } ?>>CERRADO</option>
			    				</select>
    						</td>
    					</tr>
    				</table>
    			</td>
    		</tr>
    	</table>
    </form>
    <br />
    <a style="float:left;" href="<?php echo url_for('ticket/ticketsAdmin') ?>">
    	<strong><em>Listado de Tickets</em></strong>
    </a>
  </div>
 <div class="cierre_box_correo"></div>
</div>