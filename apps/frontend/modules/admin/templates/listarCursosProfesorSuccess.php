<?php use_helper('informacion');?>
<?php use_helper('SexyButton'); ?>
<?php use_helper('Text'); ?>

<div class="capa_principal" id="admin">

  <div class="titulo_principal"><h2 class="titbox">Lista de cursos impartidos por <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h2></div>
  
  <div class="contenido_principal">
  
    <div class="herramientas_general_fixed">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td><?php echo sexy_button_to('Asignar m&aacute;s cursos', 'admin/aniadirCurso?idusuario='.$usuario->getId().'&rol=profesor') ?></td>
        </tr>
      </table>
    </div>
    
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
    
    <div class="listado_tabla_general">
      <table class="lista_cursos_profesor">
        <?php $i = 0; ?>
        <?php foreach($cursos as $curso): ?>
          
          <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
          <tr <?php echo $fondo1; ?>>
            <td class="td1"><?php echo link_to(truncate_text($curso->getCurso()->getNombre(), 50), 'admin/fichaCurso?idcurso='.$curso->getCurso()->getId(), array('class' => 'a_explicito')) ?></td>
            <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
            <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
            <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></td>
            <td class="td5">
              <?php echo link_to(image_tag('papelera.gif', array('alt' => 'Deshabilitar a este profesor en este curso', 'title' => 'Deshabilitar a este profesor en este curso')), 'admin/listarCursosProfesor?id='.$usuario->getId().'&delcurso='.$curso->getCurso()->getId(),'confirm=&iquest;Esta seguro querer deshabilitar al profesor '.$usuario->getNombre()." ".$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?>
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
    <br>
    <?php echoNotaInformativa('Ayuda', "Si quiere deshabilitar a un profesor para que <u>ya no imparta alguno de sus cursos</u> haga clic sobre el icono ".image_tag('papelera.gif')." del curso correspondiente"); ?>
  
  <br><?php use_helper('volver'); echo volver(); ?>
  </div>

  <div class="cierre_principal"></div>
</div>
