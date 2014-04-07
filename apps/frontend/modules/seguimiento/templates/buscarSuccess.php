<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>


<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Buscar Alumno en curso <?php echo $curso->getNombre(90)?></h2></div>
<div class="cont_box_grande">
<?php echo form_tag('seguimiento/buscar?idcurso='.$curso->getId()) ?>

    <table class="tablanuevocurso">

    <table class="tabla_show_perfil">
    <tbody>


    <tr>
      <th>USUARIO:</th>
      <td><?php echo input_tag('usuario', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>DNI:</th>
      <td><?php echo input_tag('dni', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo input_tag('nombre', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>Apellidos:</th>
      <td><?php echo input_tag('apellidos', '','class=inputperfil') ?></td>
    </tr>
    <tr>
      <th>E-mail:</th>
      <td><?php echo input_tag('email', '','class=inputperfil')?></td>
    </tr>
    <tr>
      <th>Criterio busqueda</th>
      <td><?php echo radiobutton_tag('tipo[]', 'And', true) ?>Todos
	      &nbsp;&nbsp;&nbsp;
		  <?php echo radiobutton_tag('tipo[]', 'Or', false) ?>Cualquiera
	  </td>
	</tr>


        <td>&nbsp;</td>
        <td><br><?php echo sexy_submit_tag('Buscar!'/*,array('onmouseup'=>'bloqueaCapa()')*/); ?></td>
      </tr>
    </table>
    </form>


    <?php echo javascript_tag("

  function bloqueaCapa()
  {
     document.getElementById('trans').style.display='' ;

  }

  function desBloqueaCapa()
  {
     document.getElementById('trans').style.display='none' ;

  }
") ?>
    <!-- Capas AJAX -->
    <div id="buscar"></div>
<br><?php use_helper('volver'); echo volver(); ?>
</div>
    <div id="trans" class="trans" style="background-color:#000000;color:#CCCC00;position:absolute;text-align:center;top:150px;left:350px;padding:65px;font-size:25px;font-weight:bold;width:350px;height:50px;z-index:0;filter:alpha(opacity=50);float:left;-moz-opacity:.50;opacity:.50;display: none">
    <p></p>
   </div>
<div class="cierre_box_grande"></div>
<?php else : ?>
  <?php if (isset($curso)) : ?>
    <?php $search = true; ?>
    <?php include_component('seguimiento', 'listaAlumnos', array ('alumnos' => $alumnos , 'idcurso' => $curso->getId(), 'search' => true) ) ?>
  <?php endif; ?>
<?php endif; ?>
