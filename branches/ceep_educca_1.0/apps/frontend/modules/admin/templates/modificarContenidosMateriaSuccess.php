<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>

<?php if (!isset($mostrarForm)) : ?>
<div id="mistemas">
<div class="tit_box_calendario"><h2 class="titbox">Modificar contenidos materia <? echo $materia->getNombre() ?> </h2></div>
<div class="cont_box_grande">

<?php echo form_tag('admin/modificarContenidosMateria', 'multipart=true') ?>
    <table class="tablanuevacita">


      <tr>
        <td class="titulo_largo"><label for="nombre">N&uacute;mero temas:</label></td>
        <td>
            <?php echo input_tag('numeroTemas', $materia->getTemasTotales(),'class=input') ?></td>
      </tr>

    <tr>
      <td class="titulo_largo"><label for="nombre">Fichero</label></td>
      <td>  <?php echo input_file_tag('file') ?> </td>
    </tr>
    <?php echo input_hidden_tag('idmateria', $materia->getId()) ?>
      <tr>
        <td>&nbsp;</td>
        <td>  <?php echo sexy_submit_tag('Insertar'); ?>        </td>
      </tr>
    </table>
    </form>

</div>



<div class="cierre_box_grande"></div>
</div>
<? else : ?>
<? if (!isset($temasOK)) : ?>
<div id="mistemas">
<div class="tit_box_mensajes"><h2 class="titbox">Modificar contenidos materia <? echo $materia->getNombre() ?> </h2></div>
<div class="cont_box_correo">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'admin/modificarContenidosMateria',
        'script' => true,
    )) ?>

    <table class="tablanuevacita">
    <tr>
      <td><?php echo form_error('numeroTemas') ?></td>
      <td></td>
    </tr>

    <?php for($i=1;$i<=$numeroTemas;$i++) : ?>
      <tr>
        <td class="titulo_largo"><label for="horaFin">tema<?echo $i;?>:</label></td>
        <td><?php echo input_tag('tema'.$i, '','class=input') ?></td>
        <td><?php echo select_tag('fichero'.$i, options_for_select($ficheros, 0), '') ?></td>
      </tr>
    <?endfor; ?>
        <tr>
        <td>&nbsp;</td>
        <td><div id="trans" class="trans">
               <?php echo sexy_submit_tag('Insertar',array('onmouseup'=>"bloqueaCapa('trans')")); ?>
            </div>
            </td>
      </tr>
    <?php echo input_hidden_tag('numeroTemas', $numeroTemas) ?>
    <?php echo input_hidden_tag('guardarTemas', "OK") ?>
    <?php echo input_hidden_tag('idmateria', $materia->getId()) ?>
    </table>
    </form>
<!-- Capas AJAX -->
<div id="guardar"></div>
</div>
<div class="cierre_box_correo"></div>
</div>
 <? else : ?>
  <?php echo image_tag('ico_p_endok.gif'); ?> Materia Guardada
  <?php use_helper('javascriptAjax') ?>
  <?php echo cargaPagina('materia/fichaMateria',"idmateria=".$materia->getId()) ?>
 <? endif; ?>

<?endif;?>