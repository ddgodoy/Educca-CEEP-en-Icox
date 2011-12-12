<? if ("false"==$guardarTemas) : ?>

<?php use_helper(); ?>
<?php use_helper('SexyButton','Validation'); ?>
<div class="tit_box_calendario"><h2 class="titbox">Modificar informaci&oacute; de la materia <?echo $materia->getNombre()?></h2></div>
<div class="cont_box_grande">

<?php echo form_tag('admin/modificarContenidosMateria', 'multipart=true'); ?>
    <table class="tablanuevacita">


      <tr>
        <td class="titulo"><label for="nombre">N&uacute;mero temas:</label></td>
        <td>
            <?php echo input_tag('numeroTemas', $numeroTemas,'class=input'); ?></td>
      </tr>

    <tr>
      <td class="titulo"><label for="nombre">Fichero</label></td>
      <td>  <?php echo input_file_tag('file'); ?> </td>
    </tr>
    <?php echo input_hidden_tag('idmateria', $materia->getId()); ?>
      <tr>
        <td>&nbsp;</td>
        <td>  <?php echo sexy_submit_tag('Insertar'); ?>        </td>
      </tr>
    </table>
    </form>




<div class="error">
 <?php if ($sf_request->hasErrors()): ?>
<?php use_helper('informacion'); ?>
  <?php foreach($sf_request->getErrors() as $nombre => $error): ?>
    <?echoWarning($nombre, $error,false,'nota_informativa_corta');?>
  <?php endforeach; ?>
<?php endif; ?>
<br><br><br>
</div>
<?php use_helper('SexyButton'); ?>
<center>

</div>
<div class="cierre_box_grande"></div>
<? else :?>
        <?php include_partial('login/Error'); ?>
<?endif; ?>