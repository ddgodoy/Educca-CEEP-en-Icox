<?php use_helper('Javascript', 'Validation','SexyButton','javascriptAjax') ?>
<?php if (!isset($mostrarForm)) : ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Planificar el estudio de la teor&iacute;a del tema <?php echo $tema->getNombre() ?> </h2></div>
  <div class="cont_box_correo">

    <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Curso:</td>
                <td><?php echo $curso->getnombre(90) ?></td>
              </tr>

               <tr>
                <td class="titulo"> Fecha Inicio:</td>
                <td><?php echo $curso->getFechaInicio("d-m-Y") ?></td>
              </tr>

               <tr>
                <td class="titulo">Fecha Fin:</td>
                <td><?php echo $curso->getFechaFin("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Fecha completar tema:</td>
                <td> <?php if ($temaCurso) : ?>
                          <?php echo $temaCurso->getFechaCompletado("d-m-Y")?>
                     <?php else : ?>
		                  Sin fecha asignada
		              <?php endif; ?>
                </td>
              </tr>
            </table>
        </div>
      </div>


    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'seguimiento/modificarFechaTema?idcurso='.$idcurso.'&idtema='.$idtema,
        'script' => true)) ?>
    <table class="tabla_show_perfil2">
      <tr>
        <td class="description"><?php echo $tema->getNombre()?>:</td>
        <td class="date"> <?php if (!$temaCurso) : ?>
                 <?php echo input_date_tag('fechaFin', '',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.date("Y-m-d"), 'class' => 'inputpeq')) ?>
             <?php else : ?>
		          <?php echo input_date_tag('fechaFin', '',array('rich' =>true, 'calendar_options' => 'ifFormat: "%d-%m-%Y",daFormat: "Y-%m-%d", date:'.$temaCurso->getFechaCompletado("Y-m-d"), 'class' => 'inputpeq')) ?>
		     <?php endif; ?>
	    </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="date">
        <div id="trans" class="trans">
           <?php echo sexy_submit_tag('Guardar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
        </div>
        </td>
      </tr>
    </table>
    </form>

    <!-- Capas AJAX -->
    <div id="guardar"></div>

</div>
<div class="cierre_box_correo"></div>
</div>


<?php else : ?>
  <?php echo image_tag('ico_p_endok.gif'); ?> Fecha Guardada
  <?php echo cargaPagina('seguimiento/seguimientoTemas',"idcurso=".$sf_user->getCursoMenu()) ?>
<?php endif; ?>
