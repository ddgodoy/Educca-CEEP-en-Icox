<?php use_helper('Javascript') ?>
<table class='c_ver_evento'>
     <tr><td>Evento:</td><td><?echo ($evento->getPrivado()==1)? "PRIVADO" : "PUBLICO"?> </td></tr>
      <?php if (null!=$evento->getCurso()) :?>
	    <tr><td>CURSO:</td><td>
		    <?php echo $evento->getCurso()->getNombre() ;?>
		 </td></tr>
		<?php endif; ?>
      <tr><td>Fecha Inicio:</td><td> <?php echo $evento->getFechaInicio("d-m-Y") ;?> </td></tr>
       <tr><td>Hora Inicio:</td><td> <?php echo $evento->getFechaInicio("H:i") ;?> </td></tr>
       <tr><td>Fecha Fin:</td><td> <?php echo $evento->getFechaFin("d-m-Y") ;?> </td></tr>
       <tr><td>Hora Fin:</td><td> <?php echo $evento->getFechaFin("H:i") ;?> </td></tr>
       <tr><td>Tipo :</td><td>
	   							<?php if (null==$evento->getTipo_evento()) :?>
								    <?php echo $evento->getTipo_cita()->getDescripcion() ;  ?>
								 <?php else :?>
								 	<?php	 echo $evento->getTipo_evento()->getDescripcion() ;?>
								 <?php endif; ?>
	   							   </td>
       </tr>
       <?echo (strlen($evento->getDescripcion())>50) ? "<tr><td>Descripcion :</td><td>".$evento->getDescripcion()."</td></tr>":"" ;?>
       <tr><td><?php echo link_to_remote('Cerrar', array(
                                                                   'update' => $idcapa,
                                                                   'url'    => 'calendario/cerrar',
                                                                   )
										)
			     ?>
			     <?php if (null==$evento->getTipo_evento()) :?>
								            <?php if (isset($idcurso)) : ?>
					                             <? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getId().'&idcurso='.$idcurso,'confirm=&iquest;Esta seguro que desea eliminar la cita '.$evento->getTitulo().' ?') ?>
                                             <?php else : ?>
												 <? echo link_to('Eliminar','calendario/eliminarCitaId?idevento='.$evento->getId().'&principal=1','confirm=&iquest;Esta seguro que desea eliminar la cita '.$evento->getTitulo().' ?') ?>
									         <? endif; ?>
				 <?php endif; ?>
       </td></tr>
</table>






