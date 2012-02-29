<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton','Validation') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Alta de un nuevo curso</h2></div>
<div class="cont_box_grande">

      <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                           'url'      =>'admin/nuevoCurso',
                                                           'script' => true));
      ?>
      
    <table class="tablanuevacita">
      <tr>
        <td class="titulo"><label for="materia">Materia:</label></td>
        <td><?php echo select_tag('materia_id', options_for_select($opciones, 0), 'class=select') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaInicio">Fecha Inicio:</label></td>
        <td><?php echo form_error('fechaInicio') ?><?php echo input_date_tag('fechaInicio', '',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="fechaFin">Fecha Fin:</label></td>
        <td><?php echo form_error('fechaFin') ?><?php echo input_date_tag('fechaFin','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="horaInicio">Horas:</label></td>
        <td><?php echo form_error('duracion') ?><?php echo input_tag('duracion', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="scan">Esc&aacute;ner:</label></td>
        <td><?echo select_tag('scan', options_for_select($opcionesScan, 0), 'class=select')?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="precio">Precio:</label></td>
        <td><?php echo form_error('precio') ?><?php echo input_tag('precio', '','class=input') ?></td>
      </tr>
      <tr>
        <td class="titulo"><label for="precio">Pago:</label></td>
        <td>
          <input name="modalidad" value="mensual" type="radio"> Mensual &nbsp;&nbsp;&nbsp;
          <input name="modalidad" value="completo" type="radio" checked> Completo &nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
        <td class="titulo"><label for="opciones">Opciones:</label></td>
        <td><?php echo form_error('opciones') ?><?php echo checkbox_tag("menu_info", 1, true) ?>&nbsp;Informaci&oacute;n General y Normativa <br/>
 												<?php echo checkbox_tag("menu_biblio", 1, true) ?>&nbsp;Bibliograf&iacute;a <br/>
 												<?php echo checkbox_tag("menu_temario", 1, true) ?>&nbsp;Temario <br/>
                        <?php echo checkbox_tag("menu_biblio_archivos", 1, true) ?>&nbsp;Biblioteca de archivos <br/>
                        <?php echo checkbox_tag("menu_seguimiento", 1, true) ?>&nbsp;Seguimiento <br/>
                        <?php echo checkbox_tag("menu_eventos", 1, true) ?>&nbsp;Eventos <br/>
                        <?php echo checkbox_tag("menu_chat", 1, true) ?>&nbsp;Chat <br/>
                        <?php echo checkbox_tag("menu_foro", 1, true) ?>&nbsp;Foro <br/>
                        <?php echo checkbox_tag("menu_ejercicios", 1, true) ?>&nbsp;Ejercicios y Ex&aacute;menes <br/><br/>
        </td>
      </tr>
      <tr>
        <td class="titulo"><label for="info">Informaci&oacute;n:</label></td>
        <td><?php echo form_error('precio') ?><?php echo textarea_tag('info', '', 'size=35x6') ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br><div id="trans" class="trans">
               <?php echo sexy_submit_tag('Crear curso'); ?>
            </div>
            </td>
      </tr>
    </table>
    </form>

    <!-- Capas AJAX -->
    <div id="guardar"></div>
       <?php echo javascript_tag("
  function pulsadoCheckbox(chk)
  {  if (document.getElementById(chk).checked)
         {   document.getElementById('pulsadosCursos').value++;
		 }
     else   {   document.getElementById('pulsadosCursos').value--;
	        }
  }

") ?>
<br><? use_helper('volver');  echo volver(); ?>
</div>



<div class="cierre_box_grande"></div>
<? else : ?>
<br><br>
<?php echo image_tag('ico_p_endok.gif'); ?> Curso <?echo $curso->getNombre() ?> Guardado
<?php use_helper('javascriptAjax') ?>
<?php echo cargaPagina('admin/cursos') ?>
<? endif; ?>
