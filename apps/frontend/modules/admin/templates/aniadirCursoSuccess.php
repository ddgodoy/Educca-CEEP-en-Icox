<?php use_helper('Javascript') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">
<?php if ($rol == 'profesor'):?>
  Asignar cursos al profesor <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?>
<?php endif;?>
<?php if ($rol == 'alumno'):?>
  Nuevos cursos para el alumno <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?>  
<?php endif;?>


</h2></div>
<div class="cont_box_grande">
<br />
<?php use_helper('SexyButton') ?>
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'admin/aniadirCurso?idusuario='.$usuario->getId().'&rol='.$rol,
        'script' => true,
    ) ) ?>
    
    <?php if (!$cursos):?>
      <?php use_helper('informacion'); ?>
      <?php if ($rol == 'alumno'):?>
        <?php echoWarningCorto('', 'No se puede matricular a este alumno en nuevos cursos. O bien no se ha creado ning&uacute;n curso o el alumno ya est&aacute; matriculado en todos los cursos.');?>
      <?php endif;?>
      <?php if ($rol == 'profesor'):?>
        <?php echoWarningCorto('', 'No se pueden asignar nuevos cursos a este profesor. O bien no se ha creado ning&uacute;n curso o el profesor ya imparte todos los cursos.');?>
      <?php endif;?>
      
    <?php else: ?>
    <center>
      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">Lista de cursos </th>
          </tr>
        </table>
      </div>
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
        <?php $j=0; ?>
  	    <?php foreach($cursos as $curso) : ?>
  	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("cursos$j", $curso->getId(), false,array('onchange' => " pulsadoCheckbox('cursos$j');"))?></td>
            <td style="width: 85%; text-align: left;"><?php echo $curso->getNombre()."<br>" ?></td>
    		    <?php $j++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
      </div>
    <br>
    
      <table>
        <tr>
          <td>
            <?php if (($rol == 'profesor') && ($j != 0)):?>
              <?php echo sexy_submit_tag('Asignar cursos al profesor'); ?>
            <?php endif;?>
            <?php if ($rol == 'alumno'):?>
              <?php echo sexy_submit_tag('Matricular al alumno en estos cursos'); ?>
            <?php endif;?>
        
            <?php echo input_hidden_tag('totalCursos', $j) ?>
            <?php echo input_hidden_tag('pulsadosCursos', '0') ?>
          </td>
        </tr>
      </table>
    </center>
      
    <?php endif;?>
    </form>


    <?php echo javascript_tag("
  function pulsadoCheckbox(chk)
  {  if (document.getElementById(chk).checked)
         {   document.getElementById('pulsadosCursos').value++;
		 }
     else   {   document.getElementById('pulsadosCursos').value--;
	        }

  //alert(document.getElementById('pulsadosCursos').value);
  }

") ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
<br><br><?php use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
  <?php echo image_tag('ico_p_endok.gif'); ?> Guardado
  <?php use_helper('javascriptAjax') ?>
  
  <?php if ($rol == 'profesor'):?>
    <?php echo cargaPagina('admin/listarCursosProfesor', 'id='.$usuario->getId()) ?>
  <?php endif;?>
  
  <?php if ($rol == 'alumno'):?>
    <?php echo cargaPagina('admin/listarCursosAlumno','idusuario='.$usuario->getId()) ?>
  <?php endif;?>
  
<?php endif; ?>
