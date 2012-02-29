<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton', 'Validation') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar curso <?echo $curso->getNombre()?></h2></div>
<div class="cont_box_grande">


    <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                         'url'      =>'admin/modificarCurso?idcurso='.$curso->getId(),
                                                         'script' => true));
    ?>
    
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="materia">Materia:</label></td>
        <td><?echo select_tag('materia_id', options_for_select($opciones, $curso->getMateria()->getId()), 'class=select')?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', $curso->getNombre(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaInicio">Fecha Inicio:</label></td>
        <td><?php echo form_error('fechaInicio') ?><?php echo input_date_tag('fechaInicio', $curso->getFechaInicio("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaFin">Fecha Fin:</label></td>
        <td><?php echo form_error('fechaFin') ?><?php echo input_date_tag('fechaFin', $curso->getFechaFin("Y-m-d"), 'rich=true, class=inputpeq') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="horaInicio">Horas:</label></td>
        <td><?php echo form_error('duracion') ?><?php echo input_tag('duracion', $curso->getDuracion(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="scan">Scaner:</label></td>
        <td><?php echo select_tag('scan', options_for_select($opcionesScan, $curso->getScan()), 'class=select')?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="precio">Precio:</label></td>
        <td><?php echo form_error('precio') ?><?php echo input_tag('precio', $curso->getPrecio(),'class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="precio">Pago:</label></td>
        <td>
          <input name="modalidad" value="mensual" type="radio" <?php if ($curso->getMensual()) {echo 'checked';} ?>> Mensual &nbsp;&nbsp;&nbsp;
          <input name="modalidad" value="completo" type="radio" <?php if (!$curso->getMensual()) {echo 'checked';} ?>> Completo &nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
        <td class="titulo"><label for="opciones">Opciones:</label></td>
        <td><?php echo checkbox_tag("menu_info", 1, $curso->getMenuInfo()) ?>&nbsp;Informaci&oacute;n General y Normativa <br/>
 												                        <?php echo checkbox_tag("menu_biblio", 1, $curso->getMenuBiblio()) ?>&nbsp;Bibliograf&iacute;a <br/>
 												                        <?php echo checkbox_tag("menu_temario", 1, $curso->getMenuTemario()) ?>&nbsp;Temario <br/>
                                                <?php echo checkbox_tag("menu_biblio_archivos", 1, $curso->getMenuBibliotecaArchivos()) ?>&nbsp;Biblioteca de archivos <br/>
                                                <?php echo checkbox_tag("menu_seguimiento", 1, $curso->getMenuSeguimiento()) ?>&nbsp;Seguimiento <br/>
                                                <?php echo checkbox_tag("menu_eventos", 1, $curso->getMenuEventos()) ?>&nbsp;Eventos <br/>
                                                <?php echo checkbox_tag("menu_chat", 1, $curso->getMenuChat()) ?>&nbsp;Chat <br/>
                                                <?php echo checkbox_tag("menu_foro", 1, $curso->getMenuForo()) ?>&nbsp;Foro <br/>
                                                <?php echo checkbox_tag("menu_ejercicios", 1, $curso->getMenuEjercicios()) ?>&nbsp;Ejercicios y Ex&aacute;menes <br/><br/>
        </td>
      </tr>
       <tr>
        <td class="titulo"><label for="info">Informaci&oacute;n:</label></td>
        <td><?php echo textarea_tag('info', $curso->getInformacionExtendida(), 'size=35x6') ?></td>
      </tr>
    </table>
    
    <br>
    <center>
    <table><tr><td><?php echo sexy_submit_tag('Guardar cambios'); ?></td></tr></table>
    </center>
    </form>
<br><? use_helper('volver');  echo volver(); ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
    
</div>
<div class="cierre_box_grande"></div>


<? else : ?>
<br><br>
<?php echo image_tag('ico_p_endok.gif'); ?> Curso Modificado
<?php use_helper('javascriptAjax') ?>
<?php echo cargaPagina('admin/fichaCurso','idcurso='.$curso->getId()) ?>
<? endif; ?>
