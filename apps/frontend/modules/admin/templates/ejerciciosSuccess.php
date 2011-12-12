<?php use_helper('Javascript') ?>
<?php use_helper('formularios') ?>
<?php use_helper('informacion') ?>
<?php use_helper('SexyButton') ?>

<script type="text/javascript">

function exportar_popup (id)
{
  var wref = window.open('/admin/exportarEjercicio?id='+id, "popupexportar", "status=0,toolbar=0,width=300,height=300");
  wref.focus();
}

</script>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal">
      <h2 class="titbox">Admnistraci&oacute;n de ejercicios</h2>
  </div>
  <div class="contenido_principal">
  <?php if ($ntareas) {echoWarning('No se pudo borrar el ejercicio', 'Este ejercicio ha sido utilizado por un profesor en alguna tarea para los alumnos. Su eliminaci&oacute;n est&aacute; restringida.'); echo '<br>';} ?>
  <?php if ($nejercicios) {echoWarning('No se pudo borrar el ejercicio', 'Este ejercicio ha sido publicado en el repositorio de ejercicios y resuelto por alg&uacute;n alumno. Su eliminaci&oacute;n est&aacute; restringida.'); echo '<br>';} ?>
    <?php echo form_tag('admin/ejercicios') ?>
      <div class="herramientas_general_fixed">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="75%" style="text-align: left;">
          &nbsp;&nbsp;Mostrar ejercicios de: &nbsp;&nbsp;&nbsp;
          <select id="filtro" name="filtro" class="select_general" onchange="new Ajax.Updater('listado_ejercicios_creados', '/admin/listarEjercicios/filtro/0', {asynchronous:true, evalScripts:false, parameters:'filtro=' + document.getElementById('filtro').value})">
            <option value="0">Todas las materias</option>
            <?php foreach($materias as $materia):?>
              <option value="<?php echo $materia->getId(); ?>"><?php echo $materia->getNombre(); ?></option>
            <?php endforeach;?>
          </select>
          </td>
          <td width="20%" style="text-align: right;">
          <?php echo sexy_button_to('&nbsp;&nbsp;<b>Importar ejercicios</b>&nbsp;&nbsp;', '/admin/importarEjercicios'); ?>
          
          </tr>
          </td>
        </table>
      </div>
      <div id="listado_ejercicios_creados"></div>
      <?php echo javascript_tag(remote_function(array('update' => 'listado_ejercicios_creados', 'url' => 'admin/listarEjercicios?filtro=0')))?>
    </form>
    <? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_principal"></div>
</div>
