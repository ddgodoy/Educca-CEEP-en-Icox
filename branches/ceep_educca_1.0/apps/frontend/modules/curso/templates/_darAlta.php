<div class="error">
<br><br>
 <?php if ($sf_request->hasErrors()): ?>
  <p>Los datos introducidos no son correctos.
  Por favor, corrija los siguientes errores y vuelva a enviar el formulario:</p>
  <ul>
  <?php foreach($sf_request->getErrors() as $nombre => $error): ?>
    <li><?php echo $nombre ?>: <?php echo $error ?></li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
<br><br><br>
</div>
