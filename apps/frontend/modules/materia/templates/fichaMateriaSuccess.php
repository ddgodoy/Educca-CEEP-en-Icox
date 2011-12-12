<?php use_helper('SexyButton') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Informaci&oacute;n de la materia <? echo $materia->getnombre() ?></h2></div>
  <div class="cont_box_correo">
    <div class="herramientas" style="border-bottom:none;">
    <?php if ('administrador'==$rol) : ?>
        <?php echo sexy_button_to('Modificar Materia','admin/modificarMateria?idmateria='.$materia->getId()) ?>
    <?php endif; ?>
    </div>
    <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">

             <tr>
                <td class="titulo">Curso:</td>
                <td><? echo $materia->getnombre() ?></td>
              </tr>

              <tr>
                <td class="titulo">Normativa:</td>
                <td><? echo $materia->getnormativa() ?></td>
              </tr>

             <tr>
                <td class="titulo">Informacion:</td>
                <td><? echo $materia->getInformacion() ?></td>
              </tr>

            </table>
         </div>
    </div>


<div id="divadmin">
    <div style="border-top: #CCCCCC 1px solid" class="nombrescol">
        <table class="tadmincursos">
          <tr>
            <td class="td1">N&ordm;</td>
            <td class="td2">Nombre</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div>

    <div class="cursos">
        <table class="tadmincursos" cellspacing="0">
              <?php $i = 0; ?>
              <?php foreach($temas as $tema): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1" style="padding-left: 2px;"><?php echo $tema->getNumeroTema()?></td>
                      <td class="td2" style="padding-left: 4px;"><?php echo $tema->getNombre() ?></td>
                      <td>&nbsp;</td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
    </div>
</div>
  </div>
  <div class="cierre_box_correo"></div>
</div>