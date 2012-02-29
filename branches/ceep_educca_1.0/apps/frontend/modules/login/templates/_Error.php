<div class="error">
 <?php if ($sf_request->hasErrors()): ?>
<?php use_helper('informacion') ?>
  <?php foreach($sf_request->getErrors() as $nombre => $error): ?>
    <?echoWarning($nombre, $error,false,'nota_informativa_corta')?>
  <?php endforeach; ?>
<?php endif; ?>

<?php use_helper('SexyButton') ?>
<center>
<table>
<tr>
  <td>
     <div id="trans2" class="trans2">
     <?if (!isset($atras)) : ?>
       <? echo sexy_button_to_function('Modificar', "desBloqueaCapa('trans');bloqueaCapa('trans2')"); ?>
     <?else :?>
       <? echo sexy_button_to('Atras',"$atras") ?>
     <? endif; ?>

  </td>
</tr>
</table>
</center>
</div>