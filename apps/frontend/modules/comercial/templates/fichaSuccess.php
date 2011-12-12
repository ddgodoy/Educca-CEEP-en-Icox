<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>

<?php
  if (isset($curso)) {
    $dir_portada = "img_cursos/portada_".$curso->getId().".jpg";
    $titulo = $curso->getNombre();
    $fecha_inicio = $curso->getFechaInicio('d/m/Y');
    $fecha_fin = $curso->getFechaFin('d/m/Y');
    $descripcion = $curso->getMateria()->getInformacion()."<br/><br/>".$curso->getInformacionExtendida();
    $precio = $curso->getPrecio();
    $mensual = $curso->getMensual();
    $desglose = "<table>";
    $vurl = "idcurso";
    $idref = $curso->getId();
    $tit_des = "Temas del curso:";

    foreach($temas as $tema) {
      $desglose .= "<tr><td valign='top'>".$tema->getNumeroTema().'.</td><td>'.$tema->getNombre()."<td/></tr>";
    }
    $desglose .="</table>";
  }
  else if (isset($modulo)) {
    $dir_portada = "img_modulos/portada_".$modulo->getId().".jpg";
    $titulo = $modulo->getNombre();
    $fecha_inicio = $modulo->getFechaInicio('d/m/Y');
    $fecha_fin = $modulo->getFechaFin('d/m/Y');
    $descripcion = $modulo->getDescripcion();
    $precio = $modulo->getPrecio();
    $mensual = $modulo->getMensual();
    $desglose = "";
    $vurl = "idmodulo";
    $idref = $modulo->getId();
    $tit_des = "Cursos que componen el m&oacute;dulo";

    foreach($cursos as $curso) {
      $desglose .= $curso->getCurso()->getNombre()."<br/>";
    }
  }
?>
<div id="contenedor_ficha">
  <div class="tit_box_ficha"><h2 class="titbox"><?= $titulo ?></h2></div>
  <div class="cont_box_grande">
    <table class="tablafichac">
      <tr>
        <td>
          <table class="tablaficha1" border='0'>
            <tr>
              <td valign="top">
                <strong>Duraci&oacute;n:</strong><br/><br/>
                Desde el <?= $fecha_inicio ?> hasta el <?= $fecha_fin ?><br/><br/>
                <strong><?= $tit_des ?></strong><br/><br/>
                <?= $desglose ?>
                <br/><strong>Precio: </strong><?= $precio ?> Euros <?php if ($mensual) {echo ' / mes'; }?><br/><br/>
			  </td>
              <td class="tdtemas">
                <?php echo (file_exists('images/'.$dir_portada))? image_tag($dir_portada,'class=tdimagen Alt=Portada'):image_tag('img_cursos/noimg.gif','class=tdimagen Alt=Portada'); ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="tddesc"><pre class="texto_normal"><? echo wordwrap($descripcion, 93, "\n", 1); ?></pre>
        </td>
      </tr>
      <tr>
        <td class="tdmatricula">
          <table width="100%">
            <tr>
              <td style="text-align:left; vertical-align:bottom;">
                 <?php echo link_to(image_tag('bot_volver.gif','Alt=Volver'),'comercial/index') ?>
              </td>
              <td style="text-align:right;">
                <br /><?= link_to(image_tag('bot_matriculate.gif','Alt=Matr&iacute;cula hspace="10"'),'comercial/matricula?'.$vurl.'='.$idref) ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div class="cierre_box_grande"></div>
</div>
<?php slot('columna_derecha') ?>
    <?php include_component('columna_derecha', 'oferta'); ?>
<?php end_slot(); ?>
