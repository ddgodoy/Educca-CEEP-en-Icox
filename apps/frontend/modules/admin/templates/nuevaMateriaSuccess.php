<?php use_helper('Validation', 'SexyButton') ?>

<?php if (!isset($mostrarForm)) : ?>
<div id="mistemas">
 <div class="tit_box_mensajes"><h2 class="titbox">Alta de una nueva materia</h2></div>
  <div class="cont_box_correo">

<?php echo form_tag('admin/nuevaMateria', 'multipart=true') ?>
    <table class="tablanuevacita">

      <tr>
        <td class="titulo_largo"><label for="nombre">Nombre:&nbsp;</label></td>
        <td><?php echo input_tag('materia', '','class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo_largo"><label for="nombre">Ancho:&nbsp;</label></td>
        <td>
            <?php echo input_tag('width', '','class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo_largo"><label for="nombre">Alto:&nbsp;</label></td>
        <td>
            <?php echo input_tag('height', '','class=input') ?></td>
      </tr>

      <tr>
        <td class="titulo_largo"><label for="nombre">N&uacute;mero temas:&nbsp;</label></td>
        <td>
            <?php echo input_tag('numeroTemas', '','class=input') ?></td>
      </tr>

    <tr>
      <td class="titulo_largo"><label for="nombre">Fichero:&nbsp;</label></td>
      <td>  <?php echo input_file_tag('file') ?> </td>
    </tr>
      <tr>
        <td>&nbsp;</td>
        <td>  <?php echo sexy_submit_tag('Insertar'); ?>        </td>
      </tr>
    </table>
    </form>
  </div>
  <div class="cierre_box_correo"></div>
</div>
<? else : ?>
<? if (!isset($temasOK)) : ?>
<?php use_helper('Javascript') ?>
<div id="mistemas">
<div class="tit_box_mensajes"><h2 class="titbox">Alta de una nueva materia</h2></div>
<div class="cont_box_correo">
    <?php echo form_remote_tag(array(
        'update'   => 'guardar',
        'url'      => 'admin/nuevaMateria',
        'script' => true,
    )) ?>
    <table class="tablanuevacita">

    <?php for($i=1;$i<=$numeroTemas;$i++) : ?>
      <tr>
        <td class="titulo"><label for="horaFin">tema<?echo $i;?>:</label></td>
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
    <?php echo input_hidden_tag('materiaId', $materia->getId()) ?>
    </table>
    </form>
<!-- Capas AJAX -->
<div id="guardar"></div>
</div>
<div class="cierre_box_correo"></div>
</div>
 <? else : ?>
  <?php use_helper('javascriptAjax') ?>
  <?php echo image_tag('ico_p_endok.gif'); ?> Materia Guardada
  <?php echo cargaPagina('admin/materias') ?>
 <? endif; ?>

<?endif;?>
