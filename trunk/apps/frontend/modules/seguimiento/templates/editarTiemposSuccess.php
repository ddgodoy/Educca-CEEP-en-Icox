<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('SexyButton') ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $curso->getNombre() ?></h2></div>
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
            <?php echo form_tag('/seguimiento/editarTiempos?idcurso='.$curso->getId().'&iduser='.$usuario->getId().'&idmateria='.$curso->getMateriaId(),array('method'=>'post')); ?>
            <table style="text-align: left;">
                  <tr>
                    <td><strong>Nombre del alumno: &nbsp;&nbsp;&nbsp;</strong></td>
                    <td><strong><?php echo $usuario->getNombre().', '.$usuario->getApellidos() ?></strong></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="width: 46%">Materia: &nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $materia->getNombre();?></td>
                  </tr>
            </table>
            <?php if($rel): ?>
            <br/>
            <table style="text-align: left;">
                  <tr>
                      <td><b>Tiempo teor&iacute;a</b></td>
                  </tr>
                  <tr>
                      <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                      <td style="width: 45%">Tiempo de sesion: </td>
                      <td><input type="text" name="rel_session" value="<?php echo traducir_de_fecha_scorm12($rel->getSessionTime()) ?>"/></td>
                  </tr>
                  <tr>
                      <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                      <td style="width: 45%">Tiempo Total participado: </td>
                      <td><input type="text" name="rel_total_time" value="<?php echo traducir_de_fecha_scorm12($rel->getTotalTime()) ?>"/></td>
                  </tr>
            </table>
            <?php endif; ?>
            <?php if($array_tiempo_ejercicios): ?>
            <br/>
            <table style="text-align: left;">
                  <tr>
                      <td><b>Tiempo ejercicios</b></td>
                  </tr>
                    <?php foreach ($array_tiempo_ejercicios as $k=>$v): ?>
                      <tr>
                          <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                          <td style="width: 45%"><?php echo $v['ejercicio'] ?>: </td>
                          <td><input type="text" name="ejercicio[<?php echo $k?>]" value="<?php echo $v['tiempo'] ?>"/></td>
                      </tr>
                    <?php endforeach; ?>
             </table>
             <?php endif; ?>
             <br/>
             <table>
                      <tr>
                          <td style="height: 10px;  "></td>
                      </tr>
                      <tr>
                          <td style="width: 45%"></td>
                          <td><?php echo sexy_submit_tag('Actualizar'); ?></td>
                      </tr>
             </table>
        </form>
        <br clear="all"/>
        </div>
    </div>
      <div id='capa_volver' align="left">
       <?php echo link_to(image_tag('bot_volver.gif', array('title' => 'Atr&aacute;s', 'alt' => 'Atr&aacute;s')), "/seguimiento/seguimientoTiempos?idcurso=".$curso->getId()); ?>
   </div>
    
  </div>
  <div class="cierre_principal"></div>
</div>