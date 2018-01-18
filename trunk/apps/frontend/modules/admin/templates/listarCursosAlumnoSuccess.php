<?php use_helper('informacion');?>
<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>

<div class="capa_principal" id="admin">

  <div class="titulo_principal"><h2 class="titbox">Lista de cursos del alumno <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h2></div>
  
  <div class="contenido_principal">
  <?php if(!$modificar_ejericicio): ?>
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td><?php echo sexy_button_to('Matricular en nuevos cursos', 'admin/aniadirCurso?idusuario='.$usuario->getId().'&rol=alumno') ?></td>
          <td style="padding-left: 15px;"><?php echo sexy_button_to('Ver los m&oacute;dulos del alumno', 'admin/listaModulos?idusuario='.$usuario->getId()) ?></td>
        </tr>
      </table>
    </div>
  <?php endif; ?>
    <div class="titulos_tabla_general">
      <table class="lista_cursos_alumno">
        <tr>
          <th class="td1">Nombre</th>
          <th class="td2">Inicio</th>
          <th class="td3">Fin</th>
          <th class="td4">M&oacute;dulo</th>
          <th class="td5">Estado</th>
          <th class="td6">Opciones</th>
        </tr>
      </table>
    </div>
    <?php $andismodificar=$modificar_ejericicio?'&edita-ejercicio=1':'' ?>
    <div class="listado_tabla_general">
      <table class="lista_cursos_alumno">
        <?php $i = 0; ?>
        <?php foreach($cursos as $curso): ?>
          
          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?php echo $fondo1; ?>>
            <?php if(!$modificar_ejericicio): ?>
            <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 50), 'admin/fichaCurso?idcurso='.$curso->getCurso()->getId(), array('class' => 'a_explicito')) ?></td>
            <?php else: ?>
            <td class="td1"><?php echo truncate_text($curso->getCurso()->getNombre(), 50) ?></td>
            <?php endif; ?>
            <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
            <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
            <td class="td4">
              <?php $rels = $curso->getCurso()->getModulo($usuario->getId())?>
              <?php if ($rels) : ?>
                <?php foreach ($rels as $rel) :?>
                  <?php echo truncate_text($rel->getPaquete()->getNombre(), 23); ?>
                <?php endforeach; ?>
              <?php else:?>
                ---
              <?php endif; ?>
            </td>
            <td class="td5">
              
              <?php if ($curso->getCurso()->esMoroso($usuario->getId())) : ?>
              <strong>MOROSO</strong>
              <?php else : ?>
              ACTIVO
              <?php endif; ?>
            
            </td>
            <td class="td6">
             <?php if(!$modificar_ejericicio): ?>
              <?php if (!$rels) : ?>
                <?php if ($curso->getCurso()->esMoroso($usuario->getId())) : ?>
                  <?php echo link_to(image_tag('ico_user_enabled.gif', array('alt' => 'Habilitar a este alumno en el curso', 'title' => 'Habilitar a este alumno en el curso')),'admin/listarCursosAlumno?idusuario='.$usuario->getId().'&idcurso='.$curso->getCurso()->getId().'&moroso=no','confirm=&iquest;Esta seguro que desea reanudar al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?> |
                <?php else : ?>
                  <?php echo link_to(image_tag('ico_user_disabled.gif', array('alt' => 'Deshabilitar a este alumno en el curso', 'title' => 'Deshabilitar a este alumno en el curso')),'admin/listarCursosAlumno?idusuario='.$usuario->getId().'&idcurso='.$curso->getCurso()->getId().'&moroso=si','confirm=&iquest;Esta seguro que desea marcar como moroso al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?> |
                <?php endif; ?>
                <?php echo link_to(image_tag('papelera.gif', array('alt' => 'Quitar este curso a este alumno', 'title' => 'Quitar este curso a este alumno')), 'admin/listarCursosAlumno?idusuario='.$usuario->getId().'&delcurso='.$curso->getCurso()->getId(),'confirm=&iquest;Esta seguro querer deshabilitar al alumno '.$usuario->getNombre()." ".$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?>
              <?php else: ?>
              <?php echo link_to(image_tag('ayuda.png', array('alt' => 'Estos cursos pertenecen a un m&oacute;dulo, para gestionar los m&oacute;dulos del alumno haga clic aqu&iacute;', 'title' => 'Estos cursos pertenecen a un m&oacute;dulo, para gestionar los m&oacute;dulos del alumno haga clic aqu&iacute;')), 'admin/listaModulos?idusuario='.$usuario->getId()) ?>
              <?php endif; ?>
             <?php elseif ($modificar_ejericicio && !$curso->getCurso()->esMoroso($usuario->getId())): ?>
                <?php echo link_to(image_tag('ico_tareas_peq.gif', array('alt' => 'Editar ejercicios del curso para el alumno', 'title' => 'Editar ejercicios del curso para el alumno')),'admin/listarEjercicios?idusuario='.$usuario->getId().'&filtro='.$curso->getCurso()->getMateria()->getId().$andismodificar.'&idcurso='.$curso->getCurso()->getId()) ?>
             <?php endif; ?>
            </td>
          </tr>
          <?php $i++ ?>
        <?php endforeach; ?>
      </table>
      <?php if (!$i):?>
        <?php echoAvisoVacio("Este alumno no est&aacute; matriculado en ning&uacute;n curso");?>
      <?php endif; ?>
    </div>
    <?php if ($i):?>
      <div class="totales_tabla">
        Total: &nbsp;<?php echo $i; ?> curso(s)
      </div>
    <?php endif;?>
    <br>
    <?php if(!$modificar_ejericicio): ?>
    <?php echoNotaInformativa('', image_tag('papelera.gif')." Sirve para <b>borrar</b> a un alumno de un curso. El alumno ya no podr&aacute; acceder al curso y toda la informaci&oacute;n relativa a ese alumno en ese curso se elimina tambi&eacute;n.
                                   <br><br>".image_tag('ico_user_disabled.gif')." Marca al alumno como <b>moroso</b> en el curso correspondiente. Esta operaci&oacute;n se realiza cuando el alumno no ha realizado sus pagos. Mientras el alumno aparezca como <b>moroso</b> en un curso no tendr&aacute; acceso a &eacute;ste.
                                   <br><br>".image_tag('ico_user_enabled.gif')." Marca al alumno como <b>activo</b> en el curso correspondiente. Esta operaci&oacute;n se realiza cuando el alumno estaba marcado como moroso y se ha recibido su pago del curso. Un alumno <b>activo</b> tiene pleno acceso al curso."); ?>
    <?php else: ?>
    <?php echoNotaInformativa('', image_tag('ico_tareas_peq.gif')." Sirve para <b>editar</b> el estado del ejercico, a un alumno de un curso."); ?>
    <?php endif; ?>
  <br><?php use_helper('volver'); echo volver(); ?>
  </div>

  <div class="cierre_principal"></div>
</div>
