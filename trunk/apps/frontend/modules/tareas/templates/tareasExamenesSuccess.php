<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('formularios') ?>


<script language="javascript" type="text/javascript">

function mostrarOpciones() {

  var select = document.getElementById('tipo_prueba').value;
  var div = document.getElementById('opciones_examen');
  if (select == 'Examen')
  {
    div.style.display = 'block';
  }
  else
  {
    div.style.display = 'none';
  }
  return true;
}

</script>


<div id="ejercicios" class="capa_principal">

  <div class="titulo_principal"><h2 class="titbox">Poner tareas y ex&aacute;menes - Paso 1</h2></div>
  <div class="contenido_principal">
    <div class="subcapa_opciones">
    <?php echo form_tag('tareas/tareasExamenesPaso2') ?>
      <table class="tabla_opciones">
        <tr>
          <th width="330" style="padding-left:10px;">Elija el curso donde quiera poner una tarea o examen:</th>
          <td>
            <?php echoSelectwMatch('curso', $id_curso, $cursos, array('class' => 'select'));?>
          </td>
        </tr>
        <tr>
          <th width="330" style="padding-left:10px;">Elija el tipo de ejercicio que desea crear:</th>
          <td>
            <?php echo select_tag('tipo_prueba', options_for_select($tipos_prueba), array('class' => 'select', 'onChange' => 'mostrarOpciones()')) ?>
          </td>
        </tr>
      </table>
      <div id="opciones_examen" style="display: none;" class="tabla_opciones">
        <table class="tabla_opciones">
          <tr>
            <th width="330" style="padding-left:10px;">&iquest;Examen sorpresa?</th>
            <td><INPUT type="radio" name="sorpresa" value="1"> S&iacute; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="radio" name="sorpresa" value="0" checked> No</td>
          </tr>
        </table>
      </div>
    </div>

    <br><br>

    <?php echoNotaInformativa("Tareas y ex&aacute;menes", "Un examen es una prueba que se realiza un d&iacute;a de una hora de inicio a una hora de fin determinadas, y la tarea es una prueba que tiene un plazo (normalmente de varios d&iacute;as) para realizarse. La fecha de los ex&aacute;menes y los plazos de entrega de las tareas son informaci&oacute;n que los alumnos podr&aacute;n ver.");?>
    <br>
    <?php echoNotaInformativa("Ex&aacute;menes sorpresa", "A diferencia de los ex&aacute;menes normales, los ex&aacute;menes sorpresa no ser&aacute;n avisados a los alumnos y les aparecer&aacute;n como tareas que deben realizar de inmediato a partir de un momento de \"lanzamiento\" que deber&aacute; concretar el profesor. Los alumnos que se conecten a la plataforma a partir de ese momento s&oacute;lo tendr&aacute;n la opci&oacute;n de realizar el examen sorpresa.");?>
    <br>
    <?php echoNotaInformativa("Sobre las calificaciones", "Las tareas y ex&aacute;menes entregados por los alumnos se puntuar&aacute;n en el apartado dedicado a la evaluaci&oacute;n y es all&iacute; donde se asignar&aacute;n pesos a los ejercicios y se pondr&aacute;n las notas finales.");?>
    <br>
    <?php echo submit_tag('Siguiente &gt;&gt;',array('id'=>'submit','name'=>'submit')) ?>
    </form>
  </div>
  <div class="cierre_principal"></div>
</div>
