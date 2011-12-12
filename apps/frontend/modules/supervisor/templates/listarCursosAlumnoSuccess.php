<?php use_helper('informacion');?>
<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>

<div class="capa_principal" id="admin">

  <div class="titulo_principal"><h2 class="titbox">Lista de cursos del alumno <?echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h2></div>

  <div class="contenido_principal">

    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td><?php echo sexy_button_to('Ver los m&oacute;dulos del alumno', 'supervisor/listaModulos?idusuario='.$usuario->getId()) ?></td>
        </tr>
      </table>
    </div>

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

    <div class="listado_tabla_general">
      <table class="lista_cursos_alumno">
        <?php $i = 0; ?>
        <?php foreach($cursos as $curso): ?>

          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?php echo $fondo1; ?>>
            <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 50), 'supervisor/fichaCurso?idcurso='.$curso->getCurso()->getId(), array('class' => 'a_explicito','id'=>'ln_curso'.$curso->getCurso()->getId())) ?></td>
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
              <?php if ($rels) : ?>
                <?php echo link_to(image_tag('ayuda.png', array('alt' => 'Estos cursos pertenecen a un m&oacute;dulo, para gestionar los m&oacute;dulos del alumno haga clic aqu&iacute;', 'title' => 'Estos cursos pertenecen a un m&oacute;dulo, para gestionar los m&oacute;dulos del alumno haga clic aqu&iacute;')), 'supervisor/listaModulos?idusuario='.$usuario->getId()) ?>
              <?php else: ?>
                ---
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
    <br>
    <?php echoNotaInformativa('',  "Un alumno <b>ACTIVO</b> tiene pleno acceso a todas las opciones de un curso o m&oacute;dulo
                                    <br><br>Un alumno aparece como <b>MOROSO</b> cuando tiene pendiente alguno de los pagos mensuales. El alumno no podr&aacute; acceder al curso o m&oacute;dulo correspondiente hasta que haya realizado sus pagos y la administraci&oacute;n le marque de nuevo como <b>ACTIVO</b>."); ?>

  <br><?php use_helper('volver'); echo volver(); ?>
  </div>

  <div class="cierre_principal"></div>
</div>
