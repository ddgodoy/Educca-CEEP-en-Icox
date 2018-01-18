<?php $usuario = UsuarioPeer::retrieveByPk($sf_user->getAnyId()); ?>    
<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>


<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $ejercicio->getTitulo() ?></h2></div>
  <div class="contenido_principal">


    <div class="herramientas_general">
      <?php if(!$usuario->getInspector()): ?>  
      <?php include_partial('opcionesEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'mostrar', 'rol' => $rol, 'eliminar_restringido' => $eliminar_restringido)) ?>
      <?php endif; ?>  
      <?php include_partial('cabeceraEjercicio', array('ejercicio' => $ejercicio, 'rol' => $rol, 'modo' => 'mostrar')) ?>
    </div>

    <?php if ($warning):?>
      <br>
      <?php echoWarning('', "La soluci&oacute;n del ejercicio es incompleta! Hay $warning pregunta(s) sin respuesta. Al editar la soluci&oacute;n de un problema es importante que resuelva todas las preguntas ya que esto le permitir&aacute; usar la correcci&oacute;n autom&aacute;tica en los tests."); ?>
    <?php endif; ?>
    <?php include_partial('contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>
    <?php use_helper('volver'); echo volver();  ?>
  </div>
  <div class="cierre_principal"></div>
</div>
