<?php use_helper('gWidgets') ?>
<div class="tit_box_avisos"><h2 class="titbox">Avisos</h2></div>
<div class="cont_box_grande">
  <div id="container" class="gtab">
	<ul>
		<li><a href="#tab1">Notificaciones</a></li>
		<li><a href="#tab2">Mensajes</a></li>
		<li><a href="#tab3">Eventos</a></li>
		<li><a href="/myajaxcontent.php#tab4">Tareas</a></li>
	</ul>

    <div id="tab1">
      <table class="cont_peq_tabl">
        <tr class="cont_fil">
          <td class="celda_aviso_tit"><?php echo link_to("Mensajes:", 'mensaje/mensajesRecibidos') ?></td>
          <td class="celda_aviso"><?php if ($nuevos): ?>
                                          <b> Tiene (<?php echo $nuevos ?>) mensajes nuevos</b>
                                        <?php else: ?>
                                          No tiene mensajes nuevos
                                 <?php endif; ?></td>
        </tr>
        <tr class="cont_fil">
          <td class="celda_aviso_tit"><?php echo link_to("Eventos:", 'calendario/mostrarCalendario') ?> </td>
          <td class="celda_aviso">No hay eventos pr&oacute;ximos</td>
        </tr>
        <tr class="cont_fil">
          <td class="celda_aviso_tit" valign="top">Tareas: </td>
          <td class="celda_aviso"><b>Tiene 7 ejercicios de alumnos pendientes de correci&oacute;n</b></td>
        </tr>
        <tr class="cont_fil">
          <td class="celda_aviso_tit" valign="top">Notificaciones: </td>
          <td class="celda_aviso">Ha pasado la fecha de finalizaci&oacute;n recomendada por el profesor para el Tema 2: N&uacute;meros Complejos, del curso de Matem&aacute;ticas I</td>
        </tr>
      </table>
    </div>
    <div id="tab2">Extracto bandeja de entrada</div>
	  <div id="tab3">Extracto eventos</div>
	  <div id="tab4">Extracto tareas</div>
  </div>
</div>
<div class="cierre_box_grande"></div>