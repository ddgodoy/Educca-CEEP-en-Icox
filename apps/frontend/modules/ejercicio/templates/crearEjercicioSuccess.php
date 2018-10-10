<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('formularios') ?>

<script language="javascript" type="text/javascript">

function comprobar_parametros() {
  if (document.getElementById('titulo').value.length == 0){ 
    document.getElementById('titulo').focus();
    document.getElementById('contenedor_warning').style.display = '';
    document.getElementById('mensaje_warning').innerHTML = "<strong>Debe especificar un nombre para el ejercicio</strong>";
	  return false;
  }
  return true;
}

function mostrarOpciones() {

  var select = document.getElementById('categoria').value;
  var div = document.getElementById('opciones_crear_ejercicio');
  var div2 = document.getElementById('opciones_problemas');
  
  if (select == 'test') 
  {
    div.style.display = 'block';
  }
  else
  {
    div.style.display = 'none';
  }
  
  if (select == 'problemas') 
  {
    div2.style.display = 'block';
  }
  else
  {
    div2.style.display = 'none';
  }
  
  return true;
}

</script>

<div class="capa_principal" id="ejercicios">

  <div class="titulo_principal"><h2 class="titbox">Creaci&oacute;n de ejercicios y ex&aacute;menes</h2></div>
  <div class="contenido_principal">
    <div class="subcapa_opciones">
      <?php echo form_tag('ejercicio/guardarEjercicio', 'onSubmit="return comprobar_parametros();"') ?>
      <table class="tabla_opciones">
        <tr>
          <th width="330">T&iacute;tulo o nombre del ejercicio:</th>
          <td><?php echo input_tag('titulo', '', 'maxlength=40, class=input') ?></td>
        </tr>
        <tr>
          <th width="330">&iquest;Qu&eacute; materia de las que imparte tratar&aacute; el ejercicio?</th>
          <td><?php echoSelectwMatch('materia', $id_materia, $materias, array('class' => 'select'));?></td>
        </tr>
        <tr>
          <th width="330">&iquest;Qu&eacute; tipo de ejercicio desea crear?</th>
          <td><?php echo select_tag('categoria', options_for_select($tipos), array('class' => 'select', 'onChange' => 'mostrarOpciones()')) ?></td>
        </tr>
        </table>
        
        <div id="opciones_crear_ejercicio" style="display: none;" class="tabla_opciones">
          <table class="tabla_opciones">
            <tr>
              <th width="330">N&uacute;mero de respuestas por pregunta:</th>
              <td>
                <select name="numero_respuestas">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4" selected>4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
              </td>
            </tr>
            <tr>
              <th width="330">&iquest;Las respuestas incorrectas restan puntos?</th>
              <td><input type="radio" name="test_resta" value="1" checked> S&iacute; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="test_resta" value="0"> No</td>
            </tr>
            <tr>
              <th width="330">&iquest;Puede haber m&aacute;s de una respuesta correcta?</th>
              <td><input type="radio" name="test_multiple" value="1"> S&iacute; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="test_multiple" value="0" checked> No</td>
            </tr>
            <tr>
              <th width="330">&iquest;Se utilizar&aacute;n <u>expresiones matem&aacute;ticas</u> en este examen?</th>
              <td><input type="radio" name="exp_mat" value="1"> S&iacute; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="exp_mat" value="0" checked> No</td>
            </tr>
            <tr>
              <th width="330">(Las opciones del test no se podr&aacute;n cambiar)</th>
              <td>&nbsp;</td>
            </tr>
          
          </table>
        </div>
        
        <div id="opciones_problemas" style="display: none;" class="tabla_opciones">
          <table class="tabla_opciones">
            <tr>
              <th width="330">N&uacute;mero m&aacute;ximo de hojas que podr&aacute;n adjuntar los alumnos para contestar al ejercicio:</th>
              <td>
                <select name="numero_hojas">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              </td>
            </tr>
          </table>
        </div>
        
        <table class="tabla_opciones">
        <tr>
          <td width="330">&nbsp;</td>
          <td><?php echo submit_tag('Crear ejercicio','class=submit') ?></td>
        </tr>
      </table>
      </form>
    </div>
    <?php echoWarning('', '', true);?>
  </div>
  <div class="cierre_principal"></div>
</div>
