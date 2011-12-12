<div class="error">
<?php if ($sf_request->hasErrors()): ?>
<?php use_helper('informacion') ?>
  <?php foreach($sf_request->getErrors() as $nombre => $error): ?>
    <?echoWarning($nombre, $error)?>
  <?php endforeach; ?>
<?php endif; ?>
<a href="javascript:void(0)" onclick='window.history.back()'>Modificar</a>