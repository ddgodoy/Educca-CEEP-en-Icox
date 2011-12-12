<?php use_helper('Javascript','Validation') ?>
<?php if (!isset($mostrarForm)) : ?>
<?php use_helper('SexyButton') ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar informaci&oacute; de la materia <?echo $materia->getNombre()?></h2></div>
<div class="cont_box_grande">

    <?php echo yzValidatorHelper::form_remote_tag(array( 'update'=> 'guardar',
                                                         'url'      =>'admin/modificarMateria?idmateria='.$materia->getId(),
                                                         'script' => true));
    ?>
    <table class="tablanuevocurso">
      <tr>
        <td class="titulo"><label for="nombre">Nombre:</label></td>
        <td><?php echo form_error('nombre') ?><?php echo input_tag('nombre', $materia->getNombre(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="nombre">Ancho:</label></td>
        <td><?php echo form_error('width') ?>
            <?php echo input_tag('width', $materia->getWidth(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="nombre">Alto:</label></td>
        <td><?php echo form_error('height') ?>
            <?php echo input_tag('height', $materia->getHeight(),'class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="nombre">Informacion:</label></td>
        <td><?php echo form_error('informacion') ?><?php echo textarea_tag('informacion', $materia->getInformacion(), 'size=34x5') ?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="nombre">Normativa:</label></td>
        <td><?php echo form_error('normativa') ?><?php echo textarea_tag('normativa', $materia->getNormativa(), 'size=34x5') ?></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
             <table>
             <tr>
               <td><?php echo sexy_submit_tag('Modificar'); ?></td>
               <td><?echo sexy_button_to('Modificar Contenidos', 'admin/modificarContenidosMateria?idmateria='.$materia->getId(), 'nodiv=true'); ?></td>
              </tr> </table>
            </div>


        </td>
      </tr>
    </table>
    </form>

    <!-- Capas AJAX -->
    <div id="guardar"></div>
</div>
<div class="cierre_box_grande"></div>


<? else : ?>
<br><br>
<?php echo image_tag('ico_p_endok.gif'); ?> Materia Modificada.
<?php use_helper('javascriptAjax') ?>
<?php echo cargaPagina('materia/fichaMateria',"idmateria=".$materia->getId()) ?>

<? endif; ?>