<div class="error">
 <?php if ($sf_request->hasErrors()): ?>
<?php use_helper('informacion') ?>
  <?php foreach($sf_request->getErrors() as $nombre => $error): ?>
    <?echoWarning($nombre, $error,false,'nota_informativa_corta')?>
  <?php endforeach; ?>
<?php endif; ?>
</div>