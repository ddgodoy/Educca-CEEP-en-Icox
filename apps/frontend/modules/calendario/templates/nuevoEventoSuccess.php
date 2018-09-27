<?php use_helper('Javascript', 'Validation') ?>
<?php use_helper('SexyButton') ?>

<div class="tit_box_calendario"><h2 class="titbox">Nuevo evento</h2></div>
<div class="cont_box_grande">

<table class="tablanuevacita">

<?php if ( ( $idcurso!=-1) && ($idalumno!=-1) ) :?>
	<tr><td class="titulo"><label for="elemento">Curso:</label></td>
        <td><?php echo CursoPeer::retrieveByPk($idcurso)->getNombre() ?></td>
	</tr>
	<tr><td class="titulo"><label for="elemento">Alumno :</label></td>
	 <td><?php $alumno = UsuarioPeer::retrieveByPk($idalumno);
	      echo $alumno->getNombre()." ".$alumno->getApellidos() ?>
	      </td>
	</tr>
	<!--div id="fecha"--> <?php /*capa visible xq tenemos el curso y el alumno*/ ?>
<?php else : ?><tr>
        <td class="titulo"><label for="elemento">Curso:</label></td>
        <td>
	<?php echo form_remote_tag(array(
    							'update'   => 'alumnos',
    							'url'      => 'calendario/seleccionAlumno'),
							 array ('name'     => 'fcurso')
							)
	?>
		<?php echo select_tag('cursos', options_for_select($opciones, $idcurso),
  							array('onchange' => 'cambiaCurso()' )) ?>
  		<div style="display:none"><?php echo submit_tag('OK',array ('name'     => 'ok')) ?></div></td>
      </tr>
	</form>
<!-- Capas AJAX -->


  	<tr>
        <td class="titulo"><label for="elemento">Alumno :</label></td>
        <td><div id="alumnos">
		<?php echo form_tag('', array('name'=>'falumno')) ?>
		<?php echo select_tag('salumnos', options_for_select($opcionesAlum, 0),
                          array('onchange' => 'cambiaAlumno()' )
		)  ?>
		</form>
		</div></td>
      </tr>

<!--div id="fecha" -->

<?php endif; ?>
</table>

<?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'calendario/guardarEvento',
        'script' => true,
    ),array('name'=>'fdatos')) ?>

  <?php echo input_hidden_tag('curso', $idcurso) ?>
  <?php echo input_hidden_tag('alumno', $idalumno) ?>
  <?php echo input_hidden_tag('popUp', $popUp) ?>

<table class="tablanuevacita">
  <tr>
        <td class="titulo"><label for="elemento">Tipo evento:</label></td>
        <td>
	 <?php echo select_tag('tipo', options_for_select($opcionesEvento, 0)) ?>
	 </td>
  </tr>

<?php //echo form_tag('calendario/guardarEvento', array('name'=>'fdatos')) ?>



  <tr>
        <td class="titulo"><label for="fechaInicio">Fecha Inicio:</label></td>
        <td><?php echo input_date_tag('fechaInicio','',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
  </tr>

  <tr>
        <td class="titulo"> <label for="fechaFin">Fecha Fin:</label></td>
        <td><?php echo input_date_tag('fechaFin', '',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?></td>
  </tr>


  <tr>
        <td class="titulo"><label for="horaInicio">Hora Inicio:</label></td>
        <td><?php echo select_tag('horaInicio', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
  </tr>

  <tr>
        <td class="titulo"><label for="horaFin">Hora Fin:</label></td>
        <td><?php echo select_tag('horaFin', options_for_select($opcionesHora, 0), 'class=selectpeq') ?></td>
  </tr>

  <tr>
        <td class="titulo"><label for="titulo">Titulo:</label></td>
        <td><?php echo input_tag('titulo', '','class=input') ?></td>
  </tr>

  <tr>
        <td class="titulo"><label for="descripcion">Descripci&oacute;n:</label></td>
        <td><?php echo textarea_tag('descripcion', '', 'size=34x5') ?></td>
  </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
                <?php echo sexy_submit_tag('Guardar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
            </div>
         </td>
      </tr>
 </table>
</form>
<div id="guardar"></div>
</div>





<div class="cierre_box_grande"></div>

<?php echo javascript_tag("

   function cambiaCurso()
  { document.fdatos.curso.value = document.fcurso.cursos.value ;
    document.fdatos.alumno.value  = -1; /*$idcurso;*/
    document.fcurso.ok.click() ;
    //alert('aki2  '+document.fdatos.curso.value);
	}

   function cambiaAlumno()
  { document.fdatos.alumno.value  =  document.falumno.salumnos.value  ;
	//alert('aki2  '+document.fdatos.alumno.value);
	}

") ?>