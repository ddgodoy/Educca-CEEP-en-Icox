<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>

<div class="titulos_tabla_general">
  <table class="tabla_ejercicios_rep">
    <tr>
      <th class="tda1">T&iacute;tulo</th>
      <th class="tda2">Materia</th>
      <th class="tda3">Autor</th>
      <?php if($modificar_ejericicio): ?>
      <th style="text-align: left; width: 15%;">Estado</th>
      <?php endif; ?>
      <th class="tda4">Opciones</th>
    </tr>
  </table>
</div>
<?php $andismodificar=$modificar_ejericicio?'&edita-ejercicio=1':'' ?>
<div class="listado_tabla_general">
  <table class="tabla_ejercicios_rep">
    <?php $i = 0; ?>
    <?php foreach($ejercicios as $ejercicio): ?>
      <?php $fondo = (($i % 2 == 0))? " id=\"filarayada\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <td class="tda1" <?php if($modificar_ejericicio): ?> style="width: 30%;" <?php endif; ?>><?php echo link_to(truncate_text($ejercicio->getTitulo(), 37), 'ejercicio/mostrarEjercicio?id_ejercicio='.$ejercicio->getId()) ?></td>
        <td class="tda2"><?php $materia = MateriaPeer::RetrieveByPk($ejercicio->getIdMateria()); echo($materia->getNombre());?></td>
        <td class="tda3">
          <?php

            if ($ejercicio->getNombreAutor())
            {
              echo $ejercicio->getNombreAutor();
            }
            else
            {
              $profesor = UsuarioPeer::RetrieveByPk($ejercicio->getIdAutor());
              if ($profesor) {echo $profesor->getNombre().' '.$profesor->getApellidos();}
            }

          ?>
        </td>
        <?php if($modificar_ejericicio): ?>
        <?php $estado = Ejercicio_corregido::getEjerciciosCursoEstado($idusuario, $ejercicio->getId(), true )>0?'Realizado':'No Realizado';?>
        <td style="text-align: left; width: 25%;"><?php echo $estado; ?></td>
        <?php endif; ?>
        <?php if(!$modificar_ejericicio): ?>
        <td class="tda4">
          <a href="javascript:void(0)" onclick="exportar_popup(<?php echo $ejercicio->getId() ?>)"><?php echo image_tag('download.png','Alt="Exportar ejercicio en formato XML" Title="Exportar ejercicio en formato XML" align=absmiddle') ?></a>
          &nbsp;&nbsp;
          <?php echo link_to(image_tag('papelera.gif','Alt=Eliminar este ejercicio Title=Eliminar este ejercicio align=absmiddle'), 'admin/ejercicios?idelete='.$ejercicio->getId(), array('id'=>'ln_eliminar_ejercicio'.$ejercicio->getId(),'onclick' => 'return confirm("Seguro que quiere borrar este ejercicio?")'))?>
        </td>
        <?php else: ?>
        <td><?php echo link_to(image_tag('icon_edit.gif','Alt=Editar el estado de este ejercicio para el Alumno Title=Editar el estado de este ejercicio para el Alumno'),'admin/editarEjercicioAlumno?idusuario='.$idusuario.'&filtro='.$ejercicio->getIdMateria().$andismodificar.'&idcurso='.$idcurso.'&idejercicio='.$ejercicio->getId())?></td>
        <?php endif; ?>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </table>

  <?php if (!$i):?>
    <?php if ($rol == 'profesor'):?>
      <?php echoAvisoVacio("No hay ejercicios de esta(s) materia(s)");?>
    <?php else: ?>
      <?php echoAvisoVacio("No hay ejercicio(s) de esta(s) materia(s)");?>
    <?php endif; ?>
  <?php endif; ?>

    <?php echo (input_hidden_tag('total_ejercicios', $i)); ?>
</div>
<?php if ($i):?>
  <div class="totales_tabla">
    Total: &nbsp;<?php echo $i; ?> ejercicio(s)
  </div>
<?php endif;?>
<div style="width: 100%; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc; border-bottom: 1px solid #cccccc; border-top: 0px none; text-align: left; padding-top: 3px; padding-bottom: 3px; background-color:#F8FFF8;">
    <table>
      <tr>
       <?php if(!$modificar_ejericicio): ?>
        <td style="padding-left: 4px;">
          <?php echo image_tag('download.png','Alt="Exportar ejercicio en formato XML" Title="Exportar ejercicio en formato XML"'); ?>
        </td>
        <td>
          &nbsp;Exportar ejercicio en formato XML
        </td>
        <td style="padding-left: 18px;">
          <?php echo image_tag('papelera.gif','Alt="Eliminar ejercicio" Title="Eliminar ejercicio"'); ?>
        </td>
        <td>
          Eliminar ejercicio
        </td>
       <?php else: ?>
        <td style="padding-left: 18px;">
          <?php echo image_tag('icon_edit.gif','Alt="Editar el estado de este ejercicio para el Alumno" Title="Editar el estado de este ejercicio para el Alumno"'); ?>
        </td>
        <td>
         Editar el estado de este ejercicio para el Alumno
        </td>
       <?php endif; ?>
      </tr>
    </table>
  </div>
<br><br>

