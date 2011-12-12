<?php use_helper('informacion');?>
<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>

<div class="capa_principal" id="admin">

  <div class="titulo_principal"><h2 class="titbox">Lista de cursos impartidos por <?echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h2></div>

  <div class="contenido_principal">

    <div class="titulos_tabla_general">
      <table class="lista_cursos_profesor">
        <tr>
          <th class="td1">Nombre</th>
          <th class="td2">Inicio</th>
          <th class="td3">Fin</th>
          <th class="td4">N&ordm; temas</th>
          <th class="td5">Opciones</th>
        </tr>
      </table>
    </div>

    <div class="listado_tabla_general_fixed">
      <table class="lista_cursos_profesor">
        <?php $i = 0; ?>
        <?php foreach($cursos as $curso): ?>

          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?php echo $fondo1; ?>>
            <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 50), 'supervisor/fichaCurso?idcurso='.$curso->getCurso()->getId(), array('class' => 'a_explicito','id'=>'ln_curso'.$curso->getCurso()->getId())) ?></td>
            <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
            <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
            <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></td>
            <td class="td5">
              ---
            </td>
          </tr>
          <?php $i++ ?>
        <?php endforeach; ?>
      </table>
      <?php if (!$i):?>
        <?php echoAvisoVacio("Este profesor no imparte ning&uacute;n curso en la plataforma");?>
      <?php endif; ?>
    </div>
    <?php if ($i):?>
       <div class="totales_tabla">
         Total: &nbsp;<?php echo $i; ?> curso(s)
       </div>
     <?php endif;?>

  <br><?php use_helper('volver'); echo volver(); ?>
  </div>

  <div class="cierre_principal"></div>
</div>
