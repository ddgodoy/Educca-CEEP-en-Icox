<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>

<?php slot('submenu') ?>

    <div class="tit_box_submenu2"><h2 class="titbox">Acceso como invitado</h2></div>
  <div class="loginsubcomp2">
    <center>
      <div style="width: 80%; padding-top: 10px;">
      &iquest;Quiere probar la plataforma y ver en detalle los cursos que ofrecemos?<br><br>

        <a href="/comercial/invitados" class="claveolvidada">Haga click en este enlace !</a>

      </div>
    </center>
  </div>

  <div class="cierre_menu"></div>
  <div>
    <?php echo image_tag('logo_mad_excelente.jpg')?>
  </div>  
<?php end_slot() ?>



<div id="contenedor_img">
  <?php echo image_tag('foto_comercial.jpg','Title=Tu aprendizaje comienza aqu&iacute;'); ?>
</div>

<div id="contenedor_ecursos">
  <div class="tit_box_ecursos"><h2 class="titbox">Oferta did&aacute;ctica</h2></div>
  <div class="cont_box_ecursos">
<? if ($paquetes) : ?>
<div class="nombrescol">
  <table class="tablacursos">
    <tr>
      <td class="td1">M&oacute;dulo</td>
      <td class="td3">Inicio</td>
      <td class="td3">Fin</td>
      <td class="td2">Cursos</td>
      <td class="td2">Horas</td>
      <td class="td2">Esc&aacute;ner</td>
      <td class="td2">Precio</td>
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
		<td class="td2"><?php echo $paquete->getPrecio() ; ?> &euro;</td>
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
	  <td class="td2">Precio</td>
	</tr>
  </table>
</div>
<div class="datos">
<table class="tablacursos" cellspacing="0">
<?php $j=0; ?>
<?php foreach($cursos as $curso) : ?>
    <?php $fondo2 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
    <tr class="filacurso" <?= $fondo2 ?>>
	   <td class="td1"><?php  echo link_to($curso->getNombre(50),'comercial/ficha?idcurso='.$curso->getId(),'title='.$curso->getNombre()) ?>
	   <td class="td3"><?php echo $curso->getFechaInicio($format = 'd-m-Y') ; ?></td>
	   <td class="td3"><?php echo $curso->getFechaFin($format = 'd-m-Y'); ?></td>
	   <td class="td2"><?php echo $curso->getMateria()->countTemas(); ?></td>
	   <td class="td2"><?php echo $curso->getDuracion() ; ?></td>
		 <td class="td2"><?php echo ($curso->getScan())? image_tag('scanner.gif','Title=Se necesita esc&aacute;ner') : image_tag('webcamno.gif', 'Title=No necesario'); ?>
		</td>
		<td class="td2"><?php echo $curso->getPrecio() ; ?> &euro;</td>
		<?php /*echo checkbox_tag("cursos$j", $curso->getId(), false,
	     array('onchange' => " pulsadoCheckbox('cursos$j',0);"));*/ ?>
	 </tr>
  <?php $j++; ?>
<?php endforeach; ?>
</table>
</div>
  </div>

 <div class="cierre_box_correo"></div>
</div>
<?php /*echo input_hidden_tag('totalCursos', $i)
 echo input_hidden_tag('pulsadosCursos', '0')
 echo input_hidden_tag('pulsadosPaquetes', '0') */?>

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
