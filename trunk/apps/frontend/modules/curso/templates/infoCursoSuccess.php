INFORMACION CURSO:<?php echo $curso->getNombre() ?>
<br>
<br>
 <table border='1'>
<tr>
  <td>Nombre</td>
  <td>fecha inicio</td>
  <td>fecha fin</td>
  <td>temas</td>
  <td>horas</td>
</tr>

    <tr>
	   <td><?php echo $curso->getNombre() ; ?></td>
	   <td><?php echo $curso->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td><?php echo $curso->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td><?php echo $curso->getMateria()->getNumeroTemas(); ?></td>
	   <td><?php echo $curso->getDuracion() ; ?></td>
	 </tr>
</table>

<?php use_helper('Javascript') ?>
<?php  echo link_to_remote("<b>cerrar</b>", array(
      																	'update' => 'infoCurso',
      							    									'url'    => 'curso/cerrar',
    								    )
  								    )?>
