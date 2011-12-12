<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>


<div class="tit_box_calendario"><h2 class="titbox">Buscar <?php echo $rol; if ($curso) {echo ' en el curso '.$curso->getNombre();}?> </h2></div>
<div class="cont_box_grande">

<?php if ($rol == 'profesor'):?>
  <?php echo form_tag('supervisor/listaProfesores') ?>
<?php endif;?>
<?php if ($rol == 'alumno'):?>
  <?php echo form_tag('supervisor/listaAlumnos') ?>
<?php endif;?>


    <table class="tabla_show_perfil">
    <tbody>


    <tr>
      <th>USUARIO:</th>
      <td><?php echo input_tag('usuario', '', 'class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>DNI:</th>
      <td><?php echo input_tag('dni', '', 'class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo input_tag('nombre', '', 'class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Apellidos:</th>
      <td><?php echo input_tag('apellidos', '', 'class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>E-mail:</th>
      <td><?php echo input_tag('email', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Criterio busqueda</th>
      <td><?php echo radiobutton_tag('tipo', 'And', false) ?>Todos
	      &nbsp;&nbsp;&nbsp;
		  <?php echo radiobutton_tag('tipo', 'Or', true) ?>Cualquiera
	  </td>
	</tr>
     <?php if ($curso) {echo input_hidden_tag('idcurso', $curso->getId()); } ?>


        <td>&nbsp;</td>
        <td><br><?php echo sexy_submit_tag('Buscar'); ?></td>
      </tr>
    </table>
    </form>



    <!-- Capas AJAX -->
    <div id="buscar"></div>
<br><?php use_helper('volver');  echo volver(); ?>
</div>
    <div id="trans" class="trans" style="background-color:#000000;color:#CCCC00;position:absolute;text-align:center;top:150px;left:350px;padding:65px;font-size:25px;font-weight:bold;width:350px;height:50px;z-index:0;filter:alpha(opacity=50);float:left;-moz-opacity:.50;opacity:.50;display: none">
    <p></p>
   </div>
<div class="cierre_box_grande"></div>

