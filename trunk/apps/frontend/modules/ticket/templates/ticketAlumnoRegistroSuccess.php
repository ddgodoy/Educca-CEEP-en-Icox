<?php use_helper('Javascript') ?>

<script type="text/javascript">
	function checkTicketRec()
	{
		var asunto  = document.getElementById('rec_asunto');
		var mensaje = document.getElementById('rec_mensaje');
		
		if (asunto.value == '') {
			alert('Escriba el asunto para continuar'); asunto.focus(); return false;
		}
		if (mensaje.value == '') {
			alert('Escriba el mensaje para continuar'); mensaje.focus(); return false;
		}
		return true;
	}
</script>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes">
  	<h2 class="titbox">Registro de un nuevo Ticket</h2>
  </div>
  <div class="cont_box_correo">
  	<form method="POST" action="<?php echo url_for('ticket/ticketAlumnoRegistro') ?>" enctype="multipart/form-data">
	  	<table>
	  		<tr><td style="text-align:left;">Asunto:</td></tr>
	  		<tr><td height="3"></td></tr>
	  		<tr>
	  			<td style="text-align:left;">
	  				<input id="rec_asunto" name="rec_asunto" type="text" value="<?php echo $r_asunto ?>" class="txt_et_form" style="width:600px;" />
	  			</td>
	  		</tr>
	  		<tr><td height="10"></td></tr>
	  		<tr><td style="text-align:left;">Mensaje:</td></tr>
	  		<tr><td height="3"></td></tr>
	  		<tr>
	  			<td style="text-align:left;">
	  				<textarea id="rec_mensaje" name="rec_mensaje" class="txt_et_form" style="width:600px;height:150px;"><?php echo $r_mensaje ?></textarea>
	  			</td>
	  		</tr>
	  		<tr><td height="15"></td></tr>
	  		<tr>
	  			<td>
	  				<input class="btn_et_submit" name="rec_ticket" type="submit" value="Registrar" onclick="return checkTicketRec();" />
	  			</td>
	  		</tr>
	  	</table>
  	</form>
    <br />
    <a style="float:left;" href="<?php echo url_for('ticket/ticketsAlumno') ?>">
    	<strong><em>Listado de Tickets</em></strong>
    </a>
  </div>
 <div class="cierre_box_correo"></div>
</div>