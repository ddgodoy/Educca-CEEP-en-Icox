<?php use_helper('SexyButton') ?>
<?php use_helper('Javascript','tiempo','informacion', 'Text') ?>

<div class="capa_principal" id="ordenarSeguimientoPorTemas">
  <div class="titulo_principal"><h2 class="titbox">Tiempos invertidos en el curso - Ordenado por alumnos</h2></div>
  <div class="contenido_principal">

  <div class="herramientas_general_fixed">
      <?php echo form_tag('/seguimiento/seguimientoTiempos',array('method'=>'get')) ?>
       <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="75%" style="text-align: left;">
          &nbsp;&nbsp;Mostrar alumnos del curso: &nbsp;&nbsp;&nbsp;
          <select id="filtro" name="idcurso" class="select_general" >
            <option value="0">--Seleccionar curso--</option>
            <?php foreach($cursos as $v):?>
            <option value="<?php echo $v->getId(); ?>" <?php if($v->getId()== $idcurso): ?> selected <?php endif; ?>><?php echo $v->getNombre(); ?></option>
            <?php endforeach;?>
          </select>
          </td>
          <td>
              <?php echo sexy_submit_tag('Buscar'); ?>
          </td>
        </tr>
       </table>
      </form>
  </div>

  <div class="titulos_tabla_general">
    <?if (!empty ($curso)) : ?>
    <table class="tablaseg">
      <tr>
       <?if ($curso) : ?>
          <?php if ($curso->getMateria()->esCompo()): ?>
            <th style="width: 25%;">Alumno</th>
            <th style="width: 15%; text-align: center">Tiempo teor&iacute;a</th>
            <th style="width: 15%; text-align: center">Tiempo ejercicios</th>
            <th style="width: 15%; text-align: center">Tiempo total</th>
            <th style="width: 5%; text-align: center">&nbsp;</th>
          <?php else: ?>
            <th class="td5">&nbsp;</th>
          <?php endif;?>
       <? endif ; ?>

      </tr>
    </table>
  </div>

  <div class="listado_tabla_general">
    <?php $col = 0 ?>
    <table class="tablaseg">
     <?php /*if ($curso->getMateria()->esCompo()):*/ ?>
     <? if ($alumnos) : ?>
      <?php foreach($alumnos as $alumno) : ?>
        <?php $fondo1 = (($col % 2 == 0))? "id=\"filarayada\"" : ""; ?>
        <tr <?=$fondo1?>>
          <td style="width: 25%;">
            <?php  echo link_to($alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre() , 'seguimiento/grafica?tipo=alumno&idusuario='.$alumno->getUsuario()->getId()."&idcurso=".$idcurso,array('id'=>'ln_segAlumno'.$col))?>
          </td>
            <td style="width: 15%; text-align: center"><?php echoTiempo($alumno->getUsuario()->tiempoTotalTeoriaScorm($curso->getMateriaId()));?></td>
            <td style="width: 15%; text-align: center"><?php echoTiempo($alumno->getUsuario()->tiempoEjercicios($curso->getId())); ?></td>
            <td style="width: 15%; text-align: center"><?php echoTiempo($alumno->getUsuario()->tiempoEjercicios($curso->getId())+$alumno->getUsuario()->tiempoTotalTeoriaScorm($curso->getMateriaId())); ?></td>
            <td style="width: 5%; text-align: center">
               <?php if(isEditableTime($alumno->getUsuario()->getId(),$curso->getId())): ?>
                    <?php echo link_to(image_tag('icon_edit.gif','Alt="Editar/modificar Tiempos" Title="Editar/modificar Tiempos" align="absmiddle"'),'/seguimiento/editarTiempos?idcurso='.$curso->getId().'&iduser='.$alumno->getUsuario()->getId().'&idmateria='.$curso->getMateriaId()) ?>
               <?php endif; ?>
            </td>
            
        </tr>
        <?php $col++; ?>
      <?php endforeach; ?>
     <? endif ; ?>
        <tr>
            <?php else: ?>
            <td class="td4">
              <? echoWarning('Aviso', "No se puede hacer el seguimiento"); ?>
            </td>
          <?php endif; ?>
        </tr>
    </table>
    <?php if (!$alumnos) :?>
      <? echoWarning('Aviso', "No se puede hacer el seguimiento, no hay alumnos en el curso"); ?>
    <?php endif;?>
    <?php /*endif; */ ?>
  </div>

    <br><?php echoNotaInformativa('Ayuda', 'Esta tabla le muestra el tiempo dedicado por los alumnos a cada tema y el estado de avance del alumno en el tema. Tambi&eacute;n <b>podr&aacute; acceder a las <u>gr&aacute;ficas de seguimiento</u> pinchando sobre los nombres de los alumnos</b>.<br/>
                                            Solo se podra editar los tiempos de aquellos alumnos que <b>tiene registros en el sistema</b>'); ?>

  </div>
  

  <div class="cierre_principal"></div>
</div>
