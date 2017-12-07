<?php use_helper('Javascript') ?>

<?php if (!isset($mostrarForm)) : ?>
<?php use_helper('SexyButton', 'Validation') ?>
<?php $title = $inspector == 1?' (Inspector Educativo)':''; ?>
<div class="tit_box_calendario"><h2 class="titbox">Alta de un nuevo <?php echo $rol?><?php echo $title ?></h2></div>
<div class="cont_box_grande">
<?php $url = $inspector == 1?'admin/nuevoUsuario?rol='.$rol.'&inspector=1':'admin/nuevoUsuario?rol='.$rol; ?>
    <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                         'url'      =>$url,
                                                         'script'      =>true));
            ?>
  

    <table class="tabla_show_perfil">
    <tr>
      <th>USUARIO:</th>
      <td><?php echo form_error('usuario') ?><?php echo input_tag('usuario', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>DNI:</th>
      <td><?php echo form_error('dni') ?><?php echo input_tag('dni', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Apellidos:</th>
      <td><?php echo form_error('apellidos') ?><?php echo input_tag('apellidos', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>E-mail:</th>
      <td><?php echo form_error('email') ?><?php echo input_tag('email', '','class=inputperfil')?></td>
    </tr>
    <tr>
     <th>Confirmar e-mail:</th>
     <td><?php echo form_error('email2') ?><?php echo input_tag('email2', '', array (
              'class' => 'inputperfil'
            )) ?></td>
    </tr>
    <tr>
      <th>Recibir informaci&oacute;n:</th>
      <td><?php
      echo select_tag('emailstop', options_for_select(array(
      '1'  => 'Si',
      '0'    => 'No'
    ), 1), array (
      'class' => 'inputperfil')) ?>

    </td>
    </tr>
    <tr>
      <th>Telefono:</th>
      <td><?php echo form_error('telefono') ?><?php echo input_tag('telefono', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Telefono m&oacute;vil:</th>
      <td><?php echo form_error('telefono2') ?><?php echo input_tag('telefono2', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Instituci&oacute;n:</th>
      <td><?php echo form_error('institucion') ?><?php echo input_tag('institucion', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Departamento:</th>
      <td><?php echo form_error('departamento') ?><?php echo input_tag('departamento', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Direcci&oacute;n:</th>
      <td><?php echo form_error('direccion') ?><?php echo input_tag('direccion', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>C&oacute;digo postal:</th>
      <td><?php echo form_error('cp') ?><?php echo input_tag('cp', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Ciudad:</th>
      <td><?php echo form_error('ciudad') ?><?php echo input_tag('ciudad', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Pa&iacute;s:</th>
      <td><?php echo form_error('pais') ?><?php echo select_tag('pais', options_for_select($opcionesPais, '73'), "class=selectpais") ?>
      </td>
    </tr>

     <tr>
        <td class="titulo"><label for="cursos"> </label></td>
        <td>&nbsp;</td>
     </tr>
    </table>
    <center>
    <?php if ( ($rol=="alumno") || (($rol=="profesor") )): ?>
      <br>
      <div class="titulos_tabla_general_corto">
        <table style="width: 100%;">
          <tr style="height: 20px;">
            <th style="width: 5%; text-align: center;">&nbsp;</th>
            <th style="width: 95%; text-align: left;">
              <?php if ($rol=='alumno') {echo 'El alumno estar&aacute; matriculado en los siguientes cursos:';} ?>
              <?php if ($rol=='profesor') {echo 'El profesor impartir&aacute; los siguientes cursos:';} ?>
            </th>
          </tr>
        </table>
      </div>
      
      <div class="listado_tabla_general_corto">
        <table style="width: 100%;">
        <?php $i=0; ?>
  	    <?php foreach($cursos as $curso) : ?>
  	      <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
  	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
            <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("cursos$i", $curso->getId(), false,array('onchange' => " pulsadoCheckbox('cursos$i');"));?></td>
            <td style="width: 85%; text-align: left;"><?php echo $curso->getNombre(); ?></td>
    		    <?php $i++; ?>
  		    </tr>
  	    <?php endforeach; ?>
  	    </table>
      </div>
      <?php echo input_hidden_tag('totalCursos', $i) ?>
      
      
      <?php if (($rol=="alumno") && ($paquetes)):?>
        <br>
        <div class="titulos_tabla_general_corto">
          <table style="width: 100%;">
            <tr style="height: 20px;">
              <th style="width: 5%; text-align: center;">&nbsp;</th>
              <th style="width: 95%; text-align: left;">
                El alumno estar&aacute; matriculado en los siguientes m&oacute;dulos:
              </th>
            </tr>
          </table>
        </div>
        
        <div class="listado_tabla_general_corto">
          <table style="width: 100%;">
          <?php $j=0; ?>
    	    <?php foreach($paquetes as $paquete) : ?>
    	      <?php $fondo1 = (($j % 2 == 0))? "id=\"filarayada\"" : ""; ?>
    	      <tr style="height: 20px;" <?php echo $fondo1; ?>>
              <td style="width: 5%; text-align: center;"><?php echo checkbox_tag("paquetes$j", $paquete->getId(), false,array('onchange' => " pulsadoCheckboxPaquetes('paquetes$j');"));?></td>
              <td style="width: 85%; text-align: left;"><?php echo $paquete->getNombre(); ?></td>
      		    <?php $j++; ?>
    		    </tr>
    	    <?php endforeach; ?>
    	    </table>
        </div>
        <?php echo input_hidden_tag('totalPaquetes', $j) ?>
        
      <?php endif;?>  
    <?php endif;?>

    <?php echo input_hidden_tag('rol', $rol) ?>
    <?php echo input_hidden_tag('inspector', $inspector) ?>    
    <br>
    <table><tr><td><?php echo sexy_submit_tag('Dar de alta'); ?></td></tr></table>
    </center>
    <?php echo input_hidden_tag('pulsadosCursos', '0') ?>
    <?php echo input_hidden_tag('pulsadosPaquetes', '0') ?>
    
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

function pulsadoCheckboxPaquetes(chk)
  {  if (document.getElementById(chk).checked)
         {   document.getElementById('pulsadosPaquetes').value++;
		 }
     else   {   document.getElementById('pulsadosPaquetes').value--;
	        }
  //alert(document.getElementById('pulsadosPaquetes').value);
  }

") ?>
    <!-- Capas AJAX -->
    <div id="guardar"></div>
<br><?php use_helper('volver');  echo volver(); ?>
</div>

<div class="cierre_box_grande"></div>
<?php else : ?>
  <br><br>
  <?php echo image_tag('ico_p_endok.gif'); ?> Guardado nuevo usuario
   <?php use_helper('javascriptAjax') ?>

   <?php if ("profesor"==$rol) : ?>
        <?php echo cargaPagina('admin/profesores') ?>
   <?php endif;?>

   <?php if ("alumno"==$rol) : ?>
        <?php echo cargaPagina('admin/alumnos') ?>
   <?php endif;?>

   <?php if ("administrador"==$rol) : ?>
        <?php echo cargaPagina('admin/usuarios','superUsuario=1') ?>
   <?php endif;?>

   <?php if ("supervisor"==$rol) : ?>
        <?php echo cargaPagina('admin/usuarios','superUsuario=1') ?>
   <?php endif;?>
<?php endif; ?>
