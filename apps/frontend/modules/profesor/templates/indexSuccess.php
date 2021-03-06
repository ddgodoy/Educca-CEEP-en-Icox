<?php use_helper('gWidgets'); ?>
<?php use_helper('Mensajes'); ?>
<?php use_helper('EjerciciosEvaluacion'); ?>

<div id="miscursos">
    <?php include_component('curso', 'listaCursosProfesor') ?>
</div>
	<?php slot('columna_derecha') ?>
	  <?php include_component('calendario', 'mostrarCalendario'); ?>
	  <?php include_component('columna_derecha', 'profesor'); ?>
	<?php end_slot() ?>

<?php $mensajes_nuevos = getMensajesNoLeidos($user);?>
<?php $correcciones = contarCorreccionesPendientes($user->getAnyId());?>
<?php $notificaciones = count($user->getAvisos()); ?>
<div class="separadiv"></div>
<div id="misavisos">
  	<div class="tit_box_avisos"><h2 class="titbox">Avisos</h2></div>
    <div class="cont_box_grande">
      <div id="container" class="gtab">
      	<ul class="gtab-controllers">
      		<li><a href="#tab1">Mensajes  <?php echo("($mensajes_nuevos)");?></a></li>
                <?php if(!$usuario->getInspector()): ?>
      		<li><a href="notificaciones/mostrarNotificaciones/#tab2">Notificaciones <?php echo("($notificaciones)");?></a></li>
                <?php endif; ?>
      		<li><a href="calendario/mostrarCalendarioAvisos/#tab3">Eventos</a></li>
                <?php if(!$usuario->getInspector()): ?>
      		<li><a href="evaluacion/listarTareasEvaluacionCorto/#tab4">Entregas <?php echo("($correcciones)");?></a></li>
                <?php endif; ?>
      	</ul>
        <div id="tab1">&nbsp;</div>
        <div id="tab2">&nbsp;</div>
    	  <div id="tab3">&nbsp;</div>
    	  <div id="tab4">&nbsp;</div>
    	  <?php echo javascript_tag(remote_function(array('update' => 'tab1', 'url' => 'mensaje/listarMensajesRecibidosCorto')))?>
      </div>
    </div>
    <div class="cierre_box_grande"></div>
</div>
