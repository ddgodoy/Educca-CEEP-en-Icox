<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('SexyButton') ?>
<?php $andismodificar='&edita-ejercicio=1'; ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Edita Ejercicios para el Alumno</h2></div>
  <div class="contenido_principal">
    <?php if($sf_user->hasAttribute('notice')): ?>
    <?php
        echoNotaInformativaCorta($sf_user->getAttribute('notice'),'');
        $sf_user->getAttributeHolder()->remove('notice');
    ?>
    <?php endif; ?>
    <div class="herramientas_general">
      <br>
        <div>
            <form action="" method="post">
                <table style="text-align: left;">
                      <tr>
                        <td><strong>Nombre del alumno: &nbsp;&nbsp;&nbsp;</strong></td>
                        <td><strong><?php echo $usuario->getNombre().', '.$usuario->getApellidos() ?></strong></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td>DNI:</td>
                        <td>&nbsp;<?php echo $usuario->getDni() ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td>&nbsp;<?php echo $usuario->getEmail() ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td>Curso:</td>
                        <td>&nbsp;<?php echo $curso->getNombre() ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td>Ejercico:</td>
                        <td>&nbsp;<?php echo $ejercicio->getTitulo() ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td><strong>Estado &nbsp;&nbsp;&nbsp;</strong></td>
                        <td>&nbsp;<?php echo select_tag('estado', options_for_select($arrayEstado, $estado)) ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td><strong>Tiempo &nbsp;&nbsp;&nbsp;</strong></td>
                        <td>&nbsp;<?php echo input_tag('tiempo',$tiempo) ?></td>
                      </tr>
                      <tr>
                        <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                        <td><strong>Nota &nbsp;&nbsp;&nbsp;</strong></td>
                        <td>&nbsp;<?php echo input_tag('nota',$nota) ?></td>
                      </tr>
                      <tr>
                          <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                          <td><?php echo sexy_submit_tag('Actualizar'); ?></td>
                      </tr>
                </table>
            </form>
            <br/>
        </div>
    </div>
    <div id='capa_volver' align="left">
       <?php echo link_to(image_tag('bot_volver.gif', array('title' => 'Atr&aacute;s', 'alt' => 'Atr&aacute;s')), 'admin/listarEjercicios?idusuario='.$usuario->getId().'&filtro='.$curso->getMateria()->getId().$andismodificar.'&idcurso='.$curso->getId()); ?>
   </div>
  </div>
  <div class="cierre_principal"></div>
</div>