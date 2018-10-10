<?php use_helper('informacion'); ?>
<div id="divplanificacion">
    <div class="tit_box_mensajes">
    
    <?php if (isset($idcurso)) : ?>
      <?php $curso = CursoPeer::retrieveByPk($idcurso); ?>
      <h2 class="titbox"><?php echo $curso->getNombre(90) ?> : Seguimiento </h2></div>
    <?php else : ?>
      <h2 class="titbox"> Seguimiento </h2></div>
    <?php endif; ?>


    <div class="cont_box_correo">
            <?php if (isset($idtema)) : ?>
            <?php $tema = TemaPeer::retrieveByPk($idtema);
               if ($tema) {echo "Tema ".$tema->getNumeroTema().": ".$tema->getNombre() ; } ?>
            <?php endif; ?>
            
            <?php if (isset($idusuario)) : ?>
            <?php $usuario = UsuarioPeer::retrieveByPk($idusuario); ?>
            <?php echo $usuario->getApellidos().", ".$usuario->getNombre() ?>
            <?php endif; ?>
    
    </div>
    
    <div class="cierre_box_correo" ></div>

</div>
