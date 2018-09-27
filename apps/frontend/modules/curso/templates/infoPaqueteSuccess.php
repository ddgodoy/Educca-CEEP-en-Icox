INFORMACION PAQUETE:<?php echo $paquete->getNombre() ?>
<br>
<br>
Compuesto:<br>

 <table border='1'>
<tr>
  <td>Nombre</td>
  <td>fecha inicio</td>
  <td>fecha fin</td>
  <td>temas</td>
  <td>horas</td>
</tr>
<?php use_helper('Javascript') ?>
<?php foreach($cursos as $curso) : ?>
    <tr>
	   <td><?php  echo link_to_remote("<b>".$curso->getCurso()->getNombre()."</b>", array(
      																	'update' => 'infoCurso',
      							    									'url'    => 'curso/infoCurso?id='.$curso->getCurso()->getId(),
      					            									'complete' =>  visual_effect('grow', 'infoCurso')
  								    )
  								    )?>
       </td>
	   <td><?php echo $curso->getCurso()->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td><?php echo $curso->getCurso()->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td><?php echo $curso->getCurso()->getMateria()->getNumeroTemas(); ?></td>
	   <td><?php echo $curso->getCurso()->getDuracion() ; ?></td>
	 </tr>
<?php endforeach; ?>
</table>


<?php  echo link_to_remote("<b>cerrar</b>", array(
      																	'update' => 'infoPaquete',
      							    									'url'    => 'curso/cerrar',
    								    )
  								    )?>
