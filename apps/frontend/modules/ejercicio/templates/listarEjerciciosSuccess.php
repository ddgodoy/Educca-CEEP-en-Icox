<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tabla_ejercicios_rep">
    <tr>
      <th class="td1">T&iacute;tulo</th>
      <th class="td2">Curso</th>
      <th class="td3">Tipo</th>
      <?php if ($rol == 'profesor'):?>
        <th class="td4">Publicado</th>
      <?php endif; ?>
      <?php if(!$usuario->getInspector()): ?>  
      <th class="td5">Publicada soluci&oacute;n</th>
      <?php if ($rol == 'alumno'):?>
        <th class="relleno_alumno">&nbsp;</th>
      <?php endif; ?>
      <?php endif; ?>  
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="tabla_ejercicios_rep">
    <?php $i = 0; ?>
    <?php foreach($ejercicios as $ejercicio): ?>
      <?php $fondo = (($i % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <td class="td1"><?php echo link_to(truncate_text($ejercicio->getTitulo(), 33), 'ejercicio/mostrarEjercicio?id_ejercicio='.$ejercicio->getId()) ?></td>
        <td class="td2"><?php $materia = MateriaPeer::RetrieveByPk($ejercicio->getIdMateria()); echo($materia->getNombre());?></td>
        <td class="td3"><?php echo $ejercicio->getTipo() ?></td>
        <?php if ($rol == 'profesor'):?>
          <td class="td4">
            <?php if ($ejercicio->getPublicadoCurso($id_curso)):?>
              <div class='d_publicado_<?php echo $ejercicio->getId()?>'>
                S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(!$usuario->getInspector()): ?>
                <a href="<?php echo url_for('ejercicio/ejercicios?idcurso='.$id_curso.'&quitar='.$ejercicio->getId()); ?>" id='ln_despublicar_<?echo $ejercicio->getId()?>'><?php echo image_tag('bot_despublicar.gif', array('alt' => 'Retirar este ejercicio del repositorio', 'title' => 'Retirar este ejercicio del repositorio')); ?></a>
                <?php endif; ?>
              </div>
            <?php else:?>
              <div class='d_no_publicado_<?php echo $ejercicio->getId()?>'>
                No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(!$usuario->getInspector()): ?> 
                <a href="<?php echo url_for('ejercicio/ejercicios?idcurso='.$id_curso.'&publicar='.$ejercicio->getId()); ?>" id='ln_publicar_<?echo $ejercicio->getId()?>'><?php echo image_tag('bot_publicar.gif', array('alt' => 'Publicar este ejercicio en el repositorio', 'title' => 'Publicar este ejercicio en el repositorio')); ?></a>
                <?php endif; ?>
              </div>
            <?php endif;?>
          </td>
        <?php endif; ?>
        <?php if(!$usuario->getInspector()): ?>   
        <td class="td5">  
          <?php if ($ejercicio->getPublicadaSolucionCurso($id_curso)):?>
              <div class='d_publicada_solucion_<?php echo $ejercicio->getId()?>'>S&iacute;<?php if ($rol == 'profesor'):?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('ejercicio/ejercicios?idcurso='.$id_curso.'&quitarsol='.$ejercicio->getId()); ?>" id='ln_despublicar_solucion_<?php echo $ejercicio->getId()?>'><?php echo image_tag('bot_despublicar.gif', array('alt' => 'Oculta la soluci&oacute;n si el ejercicio estaba en el repositorio', 'title' => 'Oculta la soluci&oacute;n si el ejercicio estaba en el repositorio')); ?></a><?php endif;?></div>
            <?php else:?>
              <div class='d_no_publicada_solucion_<?php echo $ejercicio->getId()?>'>No&nbsp;<?php if ($rol == 'profesor'):?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('ejercicio/ejercicios?idcurso='.$id_curso.'&publicarsol='.$ejercicio->getId()); ?>" id='ln_publicar_solucion_<?php echo $ejercicio->getId()?>'><?php echo image_tag('bot_publicar.gif', array('alt' => 'Publicar la soluci&oacute;n del ejercicio. Si el ejercicio est&aacute; publicado en el repositorio los alumnos podr&aacute;n ver su soluci&oacute;n', 'title' => 'Publicar la soluci&oacute;n del ejercicio. Si el ejercicio est&aacute; publicado en el repositorio los alumnos podr&aacute;n ver su soluci&oacute;n')); ?></a><?php endif;?></div>
            <?php endif;?>   
        </td>
        <?php endif;?>
        <?php if ($rol == 'alumno'):?>
          <td class="relleno_alumno">&nbsp;</td>
        <?php endif; ?>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </table>

  <?php if (!$i):?>
    <?php if ($rol == 'profesor'):?>
      <?php echoAvisoVacio("No hay ejercicios de esta(s) materia(s)");?>
    <?php else: ?>
      <?php echoAvisoVacio("No se han publicado ejercicios de esta(s) materia(s)");?>
    <?php endif; ?>
  <?php endif; ?>

    <?php echo (input_hidden_tag('total_ejercicios', $i)); ?>

</div>
<br><br>
<?php if ($rol == 'profesor'):?>
  <?php echoNotaInformativa("Sobre los ejercicios publicados", "Los ejercicios que usted publique aparecer&aacute;n en un apartado especial dedicado a los alumnos llamado \"repositorio de ejercicios\". Una vez publicado un ejercicio tambi&eacute;n podr&aacute; resolverlo y publicar dicha soluci&oacute;n. Los alumnos podr&aacute;n acceder a este repositorio y practicar con los ejercicios publicados.");?>
<?php endif;?>

