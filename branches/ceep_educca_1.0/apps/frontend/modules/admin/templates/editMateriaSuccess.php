<?php use_helper('Validation', 'SexyButton', 'informacion') ?>

<div class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox"><?php if (!$materia->getId()) {echo 'Alta de una nueva materia';} else {echo 'Modificar materia "'.$materia->getNombre().'"';}?></h2></div>
  <div class="contenido_principal">
<?php if (!isset($ntemas)) {$ntemas = 0;} ?>
<?php if ($ntemas):?><?php echoWarning('IMPORTANTE', 'Si adjunta un nuevo fichero con el contenido te&oacute;rico de la materia, el contenido anterior se perder&aacute; y tambi&eacute;n toda la informaci&oacute;n relacionada con los temas anteriores como los tiempos invertidos por los alumnos en cada tema y el estado de avance de los alumnos en el curso.');?><br><?php endif;?>
<?php echo form_tag('admin/editMateria', 'multipart=true') ?>
    <?php if ($errores['scorm']) {echo '<br>'.$errores['scorm'];} ?>
    <table class="tablanuevacita">
      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Nombre:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <?php echo input_tag('materia', '', array('class' => 'inputmateria', 'value' => $materia->getNombre())) ?>
          <?php if ($materia->getId()) {echo '<input type="hidden" name="idmateria" value="'.$materia->getId().'">';} ?>
          <?php if ($errores['materia']) {echo '<br>'.$errores['materia'];} ?>
        </td>
      </tr>

      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Ancho:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <?php echo input_tag('width', '', array('class' => 'inputmateria', 'value' => $materia->getWidth())) ?>
          <?php if ($errores['width']) {echo '<br>'.$errores['width'];} ?>
        </td>
      </tr>

      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Alto:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <?php echo input_tag('height', '', array('class' => 'inputmateria', 'value' => $materia->getHeight())) ?>
          <?php if ($errores['height']) {echo '<br>'.$errores['height'];} ?>
        </td>
      </tr>

      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Informaci&oacute;n:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <textarea name="informacion" cols="72" rows="5"><?php echo $materia->getInformacion() ?></textarea>
        </td>
      </tr>

      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Normativa:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <textarea name="normativa" cols="72" rows="5"><?php echo $materia->getNormativa() ?></textarea>
        </td>
      </tr>
      
      <tr>
        <td class="titulo_largo"><strong><label for="nombre">SCORM:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <select name="version_scorm" class="inputmateria">
            <option value="scorm1.2">Versi&oacute;n SCORM 1.2</option>
            <option value="scorm2004">Versi&oacute;n SCORM 2004</option>
          </select>
          <br><span style="color: #dddddd;">Si el curso que quiere subir est&aacute; en formato SCORM seleccione la versi&oacute;n</span>
        </td>
      </tr>
      
      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Fichero:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <?php echo input_file_tag('my_file', 'class="inputfilemateria"') ?>
          <br><input type="checkbox" name="conservarcontenido"> Marque esta casilla para actualizar el contenido sin borrar el seguimiento <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>(s&oacute;lo para actualizaciones del mismo curso)</strong>
          <?php if ($errores['my_file']) {echo '<br>'.$errores['my_file'];} ?>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td style="text-align: left;"><br>
          <table><tr>

          <?php if ($materia->getId()):?>
            <td width="140"><?php echo sexy_submit_tag('Guardar cambios',array('name' => 'submit')); ?></td>
            <?php if ($ntemas && ($materia->getTipo() == 'segmentada')):?> <td width="160"><?php echo sexy_button_to('Configurar contenido', 'admin/contenidoMateria?idmateria='.$materia->getId()); ?></td> <?php endif;?>
            <td width="140"><?php echo sexy_button_to('Volver al listado', 'admin/materias'); ?></td>
          <?php else: ?>
            <td width="140"><?php echo sexy_submit_tag('Guardar',array('name' => 'submit')); ?>
            </td>
          <?php endif;?>
          </tr></table>
          <div style='display:none;'><input type='submit' value='guardar'></div>
        </td>
      </tr>
    </table>
    </form>
    <?php if ($materia->getId()):?>
    <br><br><br>
    <span class="titulo">Contenido del curso</span>
    <br><br>


    <div class="listado_tabla_general_fixed">
      <table style="width: 730px;">
        <?php $index = 0; ?>

        <?php if (($materia->getTipo() == 'segmentada') || ($materia->getTipo() == 'compo')):?>
          <?php foreach ($temas as $tema): ?>

            <?php $fondo = (($index % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
            <?php echo("<tr$fondo height=\"20\">"); ?>
            <?php $sub = strtolower(substr($tema->getNombre(), 0, 4));  ?>

            <?php if ($sub == 'tema'):?>
              <th style="width: 100%; text-align: left;"><?php echo $tema->getNombre(); ?></th>
            <?php else:?>
              <th style="width: 10%; text-align: left; padding-left:2px;">Tema <?php echo $tema->getNumeroTema(); ?></th>
              <td style="width: 90%; text-align: left;"><?php echo $tema->getNombre(); ?></td>
            <?php endif;?>
            </tr>
            <?php $index++;?>
          <?php endforeach; ?>
        <?php endif;?>


        <?php if (($materia->getTipo() == 'scorm1.2')):?>
          <?php foreach ($scos as $sco): ?>

            <?php $fondo = (($index % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
            <?php echo("<tr$fondo height=\"20\">"); ?>
              <th style="width: 5%; text-align: left; padding-left:2px;"><?php echo ($index + 1); ?></th>
              <td style="width: 95%; text-align: left;"><?php echo $sco->getTitle(); ?></td>
            </tr>
            <?php $index++;?>
          <?php endforeach; ?>
        <?php endif;?>
        </table>

        <?php if (!$index) : ?>
          <?php if ($materia->getTipo() == 'segmentada'):?>

            <table class="tabla_aviso_vacio_corta">
              <tr>
                <td style="width: 10%;">
                <?php echo image_tag('warning_general.gif', 'Title=Importante !!', 'class=imginfo'); ?>
                </td>
                <td style="width: 80%; text-align: center;">

                  <strong>El contenido te&oacute;rico de esta materia no est&aacute; en formato SCORM. <br><br>Deber&aacute; especificar el n&uacute;mero de temas y asignar un contenido a cada tema de forma manual.</strong><br><br><table><tr><td><?php echo sexy_button_to('Configurar contenido', 'admin/contenidoMateria?idmateria='.$materia->getId()); ?></td></tr></table>

                </td>
                <td style="width: 10%;">
                <?php echo image_tag('warning_general.gif', 'Title=Importante !!', 'class=imginfo'); ?>
                </td>
              </tr>
            </table>
          <?php else:?>
            <?php echoAvisoVacioCorto("No se adjunt&oacute; ning&uacute;n contenido te&oacute;rico"); ?>
          <?php endif; ?>
        <?php endif; ?>

    </div>
    <?php endif;?>
<br>
    <?php echoNotaInformativa('La plataforma soporta los siguientes formatos', "
        <br><br />
        <ul>
          <li style='margin-bottom: 10px;'><strong>Cursos SCORM 1.2:</strong> El curso debe estar empaquetado en un fichero ZIP con un manifiesto v&aacute;lido en la ra&iacute;z (imsmanifest.xml). Deber&aacute; elegir versi&oacute;n SCORM 1.2.</li>
          <li style='margin-bottom: 10px;'><strong>Cursos SCORM 2004:</strong> El curso debe estar empaquetado en un fichero ZIP con un manifiesto v&aacute;lido en la ra&iacute;z (imsmanifest.xml). Deber&aacute; elegir versi&oacute;n SCORM 2004.</li>
          <li style='margin-bottom: 10px;'><strong>Otros:</strong> Cursos desarrollados mediante otras t&eacute;cnicas (HTML, Flash, etc.) cuyo temario se encuentra segmentado en varios ficheros. Para estos cursos el administrador podr&aacute; configurar manualmente el n&uacute;mero de temas que lo componen, y el t&iacute;tulo y fichero que sirve de &iacute;ndice de cada tema.</li>
        </ul>"); ?>
<br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_principal"></div>
</div>
