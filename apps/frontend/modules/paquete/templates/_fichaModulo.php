<?php use_helper('SexyButton') ?>
<div id="mensajes_recibidos">
  <?php if (!isset($info)) : ?>
    <div class="tit_box_mensajes"><h2 class="titbox">Ficha <?php echo $modulo->getNombre()?></h2></div>
  <?php else : ?>
    <div class="tit_box_mensajes"><h2 class="titbox">Cursos del <?php echo $modulo->getNombre()?></h2></div>
  <?php endif; ?>
  <div class="cont_box_correo" >
    <div class="herramientas_general_fixed" >
     <?php if ("administrador"==$rol) : ?>
        <table cellpadding="0" cellspacing="0">
         <tr>
           <td><?php echo sexy_button_to('Modificar m&oacute;dulo','admin/modificarModulo?idmodulo='.$modulo->getId()) ?></td>
         </tr>
        </table>
     <?php endif; ?>
     <?php if ("supervisor"==$rol) : ?>
        <table cellpadding="0" cellspacing="0">
         <tr>
           <td><?php echo sexy_button_to('Ver alumnos del m&oacute;dulo','supervisor/listaAlumnosModulo?idmodulo='.$modulo->getId()) ?></td>
         </tr>
        </table>
     <?php endif; ?>
    </div>
    <?php if (!isset($info)) : ?>
      <div class="detalles_mensaje">
        <div class="detallesLargo">
            <table class="tabladetalles">
		          <tr>
                <td class="titulo">M&oacute;dulo:</td>
                <td><?php echo $modulo->getnombre() ?></td>
              </tr>

              <tr>
                <td class="titulo">Inicio:</td>
                <td><?php echo $modulo->getFechaInicio("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Fin:</td>
                <td><?php echo $modulo->getFechaFin("d-m-Y") ?></td>
              </tr>

              <tr>
                <td class="titulo">Precio:</td>
                <td><?php echo $modulo->getPrecio() ?> &euro; <?php if ($modulo->getMensual()) {echo '/ mes';} ?></td>
              </tr>

              <tr>
                <td class="titulo">Esc&aacute;ner:</td>
                <td><?php if ($modulo->getScan() ) : ?>
                      S&iacute;
                    <?php else :?>
                       No
                    <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td class="titulo">Descripci&oacute;n:</td>
                <td style="vertical-align: top;"><?php echo $modulo->getDescripcion() ?></td>
              </tr>

            </table>
           </div>
      </div>
  <?php endif; ?>

<div id="divadmin" >

    <div class="admincursos">
        <table class="tadmincursosmodulo">
              <tr>
                <th class="td1">Nombre</th>
                <th class="td2">Inicio</th>
                <th class="td3" style="padding-left: 15px;">Fin</th>
                <th class="td4">N&ordm; temas</th>
              </tr>
        </table>
    </div>

    <div class="cursos">
        <table class="tadmincursosmodulo">
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>
                <?php if ($curso->getCurso()->getNombre() != "vacio") :?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <?php if ("administrador"==$rol) : ?>
                          <td class="td1"><?php echo link_to($curso->getCurso()->getNombre(), 'admin/fichaCurso?idcurso='.$curso->getCurso()->getId(),array('id'=>'ln_curso'.$curso->getCurso()->getId())) ?></td>
                      <?php endif; ?>
                      <?php if ("supervisor"==$rol) : ?>
                          <td class="td1"><?php echo link_to($curso->getCurso()->getNombre(), 'supervisor/fichaCurso?idcurso='.$curso->getCurso()->getId(),array('id'=>'ln_curso'.$curso->getCurso()->getId())) ?></td>
                      <?php endif; ?>
                      <td class="td2"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></td>
                  </tr>
                  <?php $i++ ?>
                <?php endif; ?>
              <?php endforeach; ?>
        </table>
    </div>
    <?php if ($i):?>
     <div class="totales_tabla">
       Total: &nbsp;<?php echo $i; ?> curso(s)
     </div>
   <?php endif;?>

<br><?php use_helper('volver');  echo volver(); ?>
</div>
  </div>
  <div class="cierre_box_correo"></div>
</div>
