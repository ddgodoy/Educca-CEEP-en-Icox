<?php use_helper('Javascript', 'Validation') ?>
<?php echo form_remote_tag(array(
    'update'   => 'capaAjax',
    'url'      => 'curso/darAlta',
    'loading'  =>  visual_effect('appear', 'indicador'),
    'complete' =>  visual_effect('fade', 'indicador').
                   visual_effect('highlight', 'feedback'),

)) ?>
Paquetes:<br>
<table border='1'>
<tr>
  <td>Nombre</td>
  <td>fecha inicio</td>
  <td>fecha fin</td>
  <td>Cursos</td>
  <td>horas</td>
  <td>webcam</td>
  <td>scanner</td>
  <td>precio</td>
  <td>matricularse</td>
</tr>
<?php $i=0; ?>
<?php foreach($paquetes as $paquete) : ?>
    <tr>
	   <td><?php  echo link_to_remote("<b>".$paquete->getNombre()."</b>", array(
      																	'update' => 'infoPaquete',
      							    									'url'    => 'curso/infoPaquete?id='.$paquete->getId(),
      					            									'complete' =>  visual_effect('grow', 'infoPaquete')
  								    )
  								    )?>


	  </td>
	   <td><?php echo $paquete->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td><?php echo $paquete->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td><?php echo $paquete->countRel_paquete_cursos(); ?></td>
	   <td><?php echo $paquete->getDuracion() ; ?></td>
	   <td><?php echo checkbox_tag("paquetes$i", $paquete->getId(), false,
	     array('onchange' => " pulsadoCheckbox('paquetes$i',1);")); ?>
		</td>
		<td><?php echo checkbox_tag("paquetes$i", $paquete->getId(), false,
	     array('onchange' => " pulsadoCheckbox('paquetes$i',1);")); ?>
		</td>
			   <td><?php echo $paquete->getDuracion() ; ?> €</td>
		<td><?php echo checkbox_tag("paquetes$i", $paquete->getId(), false,
	     array('onchange' => " pulsadoCheckbox('paquetes$i',1);")); ?>
		</td>
	 </tr>
  <?php $i++; ?>
<?php endforeach; ?>
</table>
<?php echo input_hidden_tag('totalPaquetes', $i) ?>
<div id='infoPaquete'></div>
<br>
<br>
cursos:<br>
<table border='1'>
<tr>
  <td>Nombre</td>
  <td>fecha inicio</td>
  <td>fecha fin</td>
  <td>temas</td>
  <td>horas</td>
  <td>webcam</td>
  <td>scanner</td>
  <td>precio</td>
  <td>matricularse</td>
</tr>

<?php $i=0; ?>
<?php foreach($cursos as $curso) : ?>
    <tr>
	   <td><?php  echo link_to_remote("<b>".$curso->getNombre()."</b>", array(
      																	'update' => 'infoCurso',
      							    									'url'    => 'curso/infoCurso?id='.$curso->getId(),
      					            									'complete' =>  visual_effect('grow', 'infoCurso')
  								    )
  								    )?>
	   <td><?php echo $curso->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td><?php echo $curso->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td><?php echo $curso->getMateria()->getNumeroTemas(); ?></td>
	   <td><?php echo $curso->getDuracion() ; ?></td>
	   <td><?php echo checkbox_tag("cursos$i", $curso->getId(), false,
	     array('onchange' => " pulsadoCheckbox('cursos$i',0);")); ?>
		 </td>
		 <td><?php echo checkbox_tag("cursos$i", $curso->getId(), false,
	     array('onchange' => " pulsadoCheckbox('cursos$i',0);")); ?>
		</td>
		<td><?php echo $paquete->getDuracion() ; ?> €</td>
		<td><?php echo checkbox_tag("cursos$i", $curso->getId(), false,
	     array('onchange' => " pulsadoCheckbox('cursos$i',0);")); ?>
		</td>
	 </tr>
  <?php $i++; ?>
<?php endforeach; ?>
</table>
<?php echo input_hidden_tag('totalCursos', $i) ?>
<?php echo input_hidden_tag('pulsadosCursos', '0') ?>
<?php echo input_hidden_tag('pulsadosPaquetes', '0') ?>
  <?php echo submit_tag('OK') ?>
</form>

<div id="capaAjax"></div>
<div id="indicador" style="display: none">Procesando su petici&oacute;n...</div>


<?php echo javascript_tag("
  function pulsadoCheckbox(chk,paquete)
  {  if (document.getElementById(chk).checked)
         { if (1==paquete)
		      {document.getElementById('pulsadosPaquetes').value++;}
		   else  document.getElementById('pulsadosCursos').value++;
		 }
     else   { if (1==paquete)
		        {document.getElementById('pulsadosPaquetes').value--;}
		      else  document.getElementById('pulsadosCursos').value--;
	        }
	 //alert('cursos'+document.getElementById('pulsadosCursos').value);
	 //alert('paquetes'+document.getElementById('pulsadosPaquetes').value);
  }
") ?>


<div id='infoCurso'></div>


