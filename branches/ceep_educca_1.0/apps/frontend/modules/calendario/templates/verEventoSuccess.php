<br>
<?php use_helper('Javascript') ?>
<?php  foreach ($eventosPrivados as $evento) : ?>
<table class="listaeventos">
<tr><td>
  <table class="tablaint2">
     <tr class="filint"><td>Evento:</td><td> PRIVADO</td></tr>
      <?php if (null!=$evento->getCurso()) :?>
	       <tr><td>CURSO:</td>
		       <td>
				    <?php echo $evento->getCurso()->getNombre() ;?>
		  	   </td></tr>
		  <?php endif; ?>
	     <tr class="filint"><td>TITULO:</td><td> <?php echo $evento->getTitulo() ;?> </td></tr>
       <tr class="filint"><td>Fecha Inicio:</td><td> <?php echo $evento->getFechaInicio("d-m-Y") ;?> </td></tr>
       <tr class="filint"><td>Fecha Fin:</td><td> <?php echo $evento->getFechaFin("d-m-Y") ;?> </td></tr>
       <tr class="filint"><td>Hora Inicio:</td><td> <?php echo $evento->getFechaInicio("H:i") ;?> </td></tr>
       <tr class="filint"><td>Hora Fin:</td><td> <?php echo $evento->getFechaFin("H:i") ;?> </td></tr>
       <tr class="filint"><td>Tipo :</td>
                          <td>
                	   							<?php if (null==$evento->getTipo_evento()) :?>
                								    <?php echo $evento->getTipo_cita()->getDescripcion() ;  ?>
                								 <?php else :?>
                								 	  <?php	 echo $evento->getTipo_evento()->getDescripcion() ;?>
                								 <?php endif; ?>
	   							        </td>
       </tr>
       <tr class="filint"><td>Descripci&oacute;n:</td><td> <?php echo $evento->getDescripcion() ;?> </td></tr>
       <tr class="filint"><td></td>
                          <td> 	
                            <?php if (null==$evento->getTipo_evento()) :?>
    								            <?php if (isset($idcurso)) : ?>
    					                             <? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getId().'&idcurso='.$idcurso,'confirm=&iquest;Esta seguro que desea eliminar la cita '.$evento->getTitulo().' ?') ?>
                                <?php else : ?>
    												              <? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getId().'&principal=1','confirm=&iquest;Esta seguro que desea eliminar la cita '.$evento->getTitulo().' ?') ?>
    									          <? endif; ?>
    								        <?php endif; ?>
							            </td>
       </tr>
</table>
</td>
 </tr>
</table>
<br><br>
<?php endforeach; ?>

<?php  foreach ($eventosPublicos as $evento) : ?>
<table class="listaeventos">
<tr><td>
  <table class="tablaint2">
     <tr class="filint"><td>Evento:</td><td> PUBLICO</td></tr>
      <tr class="filint"><td>CURSO:</td><td> <?php echo $evento->getCurso()->getNombre() ;?> </td></tr>
	  <tr class="filint"><td>TITULO:</td><td> <?php echo $evento->getTitulo() ;?> </td></tr>
      <tr class="filint"><td>Fecha Inicio:</td><td> <?php echo $evento->getFechaInicio("d-m-Y") ;?> </td></tr>
      <tr class="filint"><td>Fecha Fin:</td><td> <?php echo $evento->getFechaFin("d-m-Y") ;?> </td></tr>
      <tr class="filint"><td>Hora Inicio:</td><td> <?php echo $evento->getFechaInicio("H:i") ;?> </td></tr>
      <tr class="filint"><td>Hora Fin:</td><td> <?php echo $evento->getFechaFin("H:i") ;?> </td></tr>
      <tr class="filint"><td>Tipo :</td>
                         <td>
                          	<?php if (null==$evento->getTipo_evento()) :?>
            								    <?php echo $evento->getTipo_cita()->getDescripcion() ;  ?>
            								<?php else :?>
            								   	<?php	 echo $evento->getTipo_evento()->getDescripcion() ;?>
            								<?php endif; ?>
                         </td>
       </tr>
       <tr class="filint"><td>Descripci&oacute;n:</td><td> <?php echo $evento->getDescripcion() ;?> </td></tr>
   </table>
</td>
 </tr>
</table>
<br><br>
<?php endforeach; ?>

<?php echo link_to_remote('Cerrar', array(
                                           'update' => 'eventos',
                                           'url'    => 'calendario/cerrar',
                                          )
										      );
			     ?>


