<?php use_helper('informacion');?>
<div id="contenedor_ecursos">
  <div class="tit_box_ecursos"><h2 class="titbox" style="font-size: 13px;">Este usuario no tiene ning&uacute;n curso activo...</h2></div>
  <div class="cont_box_ecursos">
  <?php if ($cursosm): ?>
  <br>
    <span style="font-size: 13px; font-weight: bold; text-align: left;">Para recuperar el acceso a la plataforma compre nuevos cursos o efect&uacute;e el pago de los pendientes de pagar:</span>
      <br><br>
        <ul style="text-align: left; padding-left: 30px;">
        <?php foreach ($cursosm as $curso) : ?>
            <li><?php echo $curso->getCurso()->getNombre(); ?></li>
        <?php endforeach; ?>
        </ul>
  <?php else:?>
  <br>
    <span style="font-size: 13px; font-weight: bold; text-align: left;">Para recuperar el acceso a la plataforma compre nuevos cursos.</span>
  <?php endif;?>

  </div>
  <div class="cierre_box_correo"></div>
</div>

<br /><br />
<div id="contenedor_ecursos">
  <div class="tit_box_ecursos"><h2 class="titbox" style="font-size: 13px;">&iquest;Interesado en alg&uacute;n curso?</h2></div>
  <div class="cont_box_ecursos">
<?php if ($paquetes) : ?>
<div class="nombrescol">
  <table class="tablacursos">
    <tr>
      <td class="td1">M&oacute;dulo</td>
      <td class="td3">Inicio</td>
      <td class="td3">Fin</td>
      <td class="td2">Cursos</td>
      <td class="td2">Horas</td>
      <td class="td2">Esc&aacute;ner</td>
      <td class="td2b">Precio</td>
    </tr>
  </table>
</div>
<div class="datos">
<table class="tablacursos" cellspacing="0">
<?php $i=0; ?>
<?php foreach($paquetes as $paquete) : ?>
    <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
    <tr class="filacurso" <?= $fondo1 ?>>
	   <td class="td1"><?php  echo link_to($paquete->getNombre(),'comercial/ficha?idmodulo='.$paquete->getId()) ?></td>
	   <td class="td3"><?php echo $paquete->getFechaInicio($format = 'd-m-Y'); ?></td>
	   <td class="td3"><?php echo $paquete->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td class="td2"><?php echo $paquete->countRel_paquete_cursos(); ?></td>
	   <td class="td2"><?php echo $paquete->getDuracion() ; ?></td>
		 <td class="td2"><?php echo ($paquete->getScan())? image_tag('scanner.gif','Title=Se necesita esc&aacute;ner') : image_tag('webcamno.gif', 'Title=No necesario'); ?>
		</td>
		<td class="td2b"><?php echo $paquete->getPrecio() ; ?> &euro; <?php if ($paquete->getMensual()) {echo '/ mes';} ?></td>
		<?php /*echo checkbox_tag("paquetes$i", $paquete->getId(), false,
	     array('onchange' => " pulsadoCheckbox('paquetes$i',1);")); */?>
	 </tr>
  <?php $i++; ?>
<?php endforeach; ?>
  </table>
  </div>
<?php echo input_hidden_tag('totalPaquetes', $i) ?>
<div id='infoPaquete'></div>
<div class="separador"> <!--separador de tablas --> </div>
<?php endif; ?>
<div class="nombrescol">
  <table class="tablacursos">
	<tr>
	  <td class="td1">Curso</td>
	  <td class="td3">Inicio</td>
	  <td class="td3">Fin</td>
	  <td class="td2">Temas</td>
	  <td class="td2">Horas</td>
	  <td class="td2">Esc&aacute;ner</td>
	  <td class="td2b">Precio</td>
	</tr>
  </table>
</div>
<div class="datos">
<table class="tablacursos" cellspacing="0">
<?php if ($cursos) : ?>
<?php $j=0; ?>
<?php foreach($cursos as $curso) : ?>
    <?php $fondo2 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
    <tr class="filacurso" <?= $fondo2 ?>>
	   <td class="td1"><?php  echo link_to($curso->getNombre(),'comercial/ficha?idcurso='.$curso->getId()) ?>
	   <td class="td3"><?php echo $curso->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td class="td3"><?php echo $curso->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td class="td2"><?php echo $curso->getMateria()->getNumeroTemas(); ?></td>
	   <td class="td2"><?php echo $curso->getDuracion() ; ?></td>
		 <td class="td2"><?php echo ($curso->getScan())? image_tag('scanner.gif','Title=Se necesita esc&aacute;ner') : image_tag('webcamno.gif', 'Title=No necesario'); ?>
		</td>
		<td class="td2b"><?php echo $curso->getPrecio() ; ?> &euro; <?php if ($curso->getMensual()) {echo '/ mes';}?></td>
		<?php /*echo checkbox_tag("cursos$j", $curso->getId(), false,
	     array('onchange' => " pulsadoCheckbox('cursos$j',0);"));*/ ?>
	 </tr>
  <?php $j++; ?>
<?php endforeach; ?>
<?php else : ?>
	<tr><td class="tdnoaviso">
                      <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
                        <span class="txtinfo">De momento no hay cursos nuevos en la plataforma.</span>
                    </td>
    </tr>
<?php endif; ?>
</table>
</div>
  </div>

 <div class="cierre_box_correo"></div>
</div>
