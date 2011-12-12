<?php use_helper('Javascript', 'SexyButton') ?>
<?php use_helper('informacion'); ?>


<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal">
      <h2 class="titbox">Importar ejercicios</h2>
  </div>
  <div class="contenido_principal">
  <br />
  <? echoNotaInformativa('', "Desde este panel podr&aacute; subir a la plataforma ejercicios en formato XML. Recuerde que s&oacute;lo son compatibles los ejercicios exportados desde la propia plataforma.<br /><br />Deber&aacute; especificar la materia asociada al ejercicio y proporcionar un fichero XML con el contenido del mismo"); ?>
    <?php echo form_tag('admin/importarEjercicios', 'multipart=true') ?>
    <br /><br />
    <?php foreach($errors as $error) {echo $error.'<br />';} ?>
    <?php echo $mensaje_importar.'<br />'; ?>
    <br />
    <table class="tablanuevacita">

      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Materia:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <select id="materia" name="materia" class="inputfilemateria" >
            <?php foreach($materias as $materia):?>
              <option value="<?php echo $materia->getId(); ?>"><?php echo $materia->getNombre(); ?></option>
            <?php endforeach;?>
          </select>
        </td>
      </tr>



      <tr>
        <td class="titulo_largo"><strong><label for="nombre">Fichero:&nbsp;&nbsp;</label></strong></td>
        <td class="td_especial">
          <?php echo input_file_tag('my_file', 'class="inputfilemateria"') ?>
        </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td>
        <br />
          <?php echo sexy_submit_tag('Guardar',array('name' => 'submit')); ?>
          <div style='display:none;'><input type='submit' value='guardarEjercicio' name='guardarEjercicio' /></div>
        </td>
      </tr>

    </table>
    </form>
  </div>
  <div class="cierre_principal"></div>
</div>
