<?php use_helper('Javascript', 'informacion') ?>

<div id="mensajes_recibidos">
  <div class="tit_box_mensajes">
  	<h2 class="titbox">Tickets registrados</h2>
  </div>
  <div class="cont_box_correo">
  	<?php if (!empty($msg)): ?>
  	<table width="100%">
  		<tr>
  			<td style="background-color:#fff2d4;padding:5px;">
  				<strong><em>Su respuesta fue registrada exitosamente</em></strong>
  			</td>
  		</tr>
  		<tr><td height="10"></td></tr>
  	</table>	
  	<?php endif; ?>
	  <div class="titulos_tabla_general">
		  <table class="tablamensajes" cellspacing="0">
		    <tr class="filatitulo">
		      <th width="15%">Fecha</th>
		      <th width="21%">Alumno</th>
		      <th width="43%">Asunto</th>
		      <th width="14%">Estado</th>
		      <th width="7%"></th>
		    </tr>
		  </table>
		</div>
		<div class="listado_tabla_general">
		  <table class="tablamensajes" cellspacing="0">
		    <?php $i = 0; ?>
		    <?php foreach($tickets as $ticket): ?>
		      <?php
		      	$fondo = (($i % 2 == 0))? "id=\"filarayada\"" : "";
		      	$uAlum = $ticket->getUsuarioRelatedByIdAlumno();
		      ?>
		      <tr <?php echo $fondo; ?>>
		        <td width="15%" style="padding:5px;"><?php echo $ticket->getAbierto('H:i d/m/Y') ?></td>
		        <td width="21%"><?php echo $uAlum->getNombre().' '.$uAlum->getApellidos(); ?></td>
		        <td width="43%"><?php echo $ticket->getAsunto(); ?></td>
		        <td width="14%"><?php echo $ticket->getEstado(); ?></td>
		        <td width="7%">
		        	<?php echo link_to('Detalle', 'ticket/ticketAdminDetalle?codigo='.$ticket->getCodigo(), array('name' => 'ln_ticket')) ?>
		        </td>
		      </tr>
		      <?php $i++; ?>
		    <?php endforeach; ?>
		  </table>
		  <?php if (!$i):?>
		    <?php echoAvisoVacio("La carpeta de tickets est&aacute; vac&iacute;a");?>
		  <?php endif; ?>
		
		  <?php echo (input_hidden_tag('total_tickets', $i)); ?>
		</div>
  </div>
 <div class="cierre_box_correo"></div>
</div>