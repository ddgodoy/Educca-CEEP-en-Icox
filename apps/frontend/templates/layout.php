<?php $nombrelms = sfConfig::get('app_lms_nombre'); ?>
<?php $colortop = sfConfig::get('app_lms_color_top'); ?>
<?php echo use_helper('Javascript') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>
<?php echo use_helper('rollover') ?>

<link rel="shortcut icon" href="/favicon.ico" />

<script>
	function ajustarTamanoPantalla () {
		var htm = document.getElementsByTagName('html')[0];
		var tamano_pantalla= htm.scrollHeight;
		document.getElementById('truco').style.height= tamano_pantalla+'px';
	}

	function ajustarTamanoPantalla2 () {
		var htm = document.getElementsByTagName('html')[0];
		var tamano_contenido= htm.offsetHeight;
		var tamano_pantalla= htm.scrollHeight;
		var tamano_cliente= htm.clientHeight;
		if (tamano_contenido > tamano_pantalla){
			//el contenido es mas grande que la pantalla
			alert('op1');
			document.getElementById('contenido_wrap').style.height= 'auto';//tamano_contenido+'px';
		}
		if (tamano_pantalla > tamano_contenido ){
			//el contenido es mas peque�o que la pantalla
			alert('op2');
			document.getElementById('contenido_wrap').style.height= tamano_pantalla+'px';
		}
	}
</script>

</head>
<body onresize="ajustarTamanoPantalla();">

	<div id="contenido_wrap">
       <div id="contenido">
       	  <div id="truco"></div>
		  <div style="float:right;">
	          <div id="header" style="background: #<?php echo $colortop; ?>"><table class="tablalogo" cellpadding="0" cellspacing="0">
			  						<tr>
									  <td width="185"><?php echo link_to(image_tag('logo.jpg', 'alt='.$nombrelms), '@homepage') ?></td>
                                      <td width="337">&nbsp;</td>
                                      <td width="428"><?php echo image_tag('header_right.jpg', 'alt='.$nombrelms) ?></td>
									</tr>
								</table></div>
	          <div id="contenedor_barra_enlaces">
			  	<div id="barra_enlaces">&nbsp;<?php include_component_slot('menu_top'); ?></div>
			  </div>
	          <div id="col1">
	                 <div id="menu">
                     <?php include_component_slot('menu') ?>
                     <?php if (has_slot('submenu')): ?>
	                    	<?php include_slot('submenu') ?>
	                    <?php endif; ?>
                   </div>
	          </div> <!-- fin col1 -->
	          <div id="wrapper">
	              <div id="col2">
	                  <?php echo $sf_data->getRaw('sf_content') ?>
	              </div> <!-- fin col2 -->
	              <div id="col3">
	                    <?php if (has_slot('columna_derecha')): ?>
	                    	<?php include_slot('columna_derecha') ?>
	                    <?php endif; ?>
                            <?php if($sf_user->hasCredential('administrador') && !$sf_request->getParameter('idusuario') && $sf_request->getParameter('action')=='mostrarPerfil'): ?>
                              <div style="padding-left: 15px">
                                <?php  echo link_to('Control de tiempos >>', '/seguimiento/seguimientoTiempos',array('style'=>'float:left;'))?>
                                <br/>
                                <?php  echo link_to('Auditoría a "Supervisor SRE" >>', '/seguimiento/auditoriaSRE',array('style'=>'float:left;'))?>
                                <br/>
                                <?php  echo link_to('Editar exámenes >>', '/admin/alumnos?edita-ejercicio=1',array('style'=>'float:left;'))?>
                              </div>
                            <?php endif; ?>
	              </div> <!-- fin col3 -->
	          </div>
          </div>
       </div>
    </div>
	<script language="javascript" type="text/javascript">
		ajustarTamanoPantalla();
	</script>
	  <div id="usuarioValido"></div> <!-- usuarioValido -->
	<?php echo periodically_call_remote(array(
    'frequency' => 180,
    'update'    => 'usuarioValido',
    'url'       => 'login/usuarioValido',
    401 => "alert ('Alguien ha entrado con su usuario desde otro ordenador, y ha finalizado su sesi�n.');document.location='/';",
)) ?>

 <?php include_partial('online/javascript_periodico') ;?>
</body>
</html>

