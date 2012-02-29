<?php use_helper('informacion'); ?>
<div id="divplanificacion">
    <div class="tit_box_mensajes">
    
    <?php if (isset($idcurso)) : ?>
      <? $curso = CursoPeer::retrieveByPk($idcurso); ?>
      <h2 class="titbox"><?php echo $curso->getNombre(90) ?> : Seguimiento </h2></div>
    <? else : ?>
      <h2 class="titbox"> Seguimiento </h2></div>
    <? endif; ?>


    <div class="cont_box_correo">
            <?php if (isset($idtema)) : ?>
            <? $tema = TemaPeer::retrieveByPk($idtema);
               if ($tema) {echo "Tema ".$tema->getNumeroTema().": ".$tema->getNombre() ; } ?>
            <? endif; ?>
            
            <?php if (isset($idusuario)) : ?>
            <? $usuario = UsuarioPeer::retrieveByPk($idusuario); ?>
            <? echo $usuario->getApellidos().", ".$usuario->getNombre() ?>
            <?php endif; ?>
    
    </div>
    
    <div class="cierre_box_correo" ></div>

</div>
