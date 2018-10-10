<?php use_helper('Javascript') ?>
<?php foreach ($errores as $error): ?>
  <li><?php echo $error ?></li>
<?php endforeach; ?>
<?php if (!count($errores)): ?>
  <?php echo javascript_tag(update_element_function('lista_usuarios', array(
    'content'  => "<strong>Mensaje enviado correctamente</strong>"))) 
  ?>
<?php endif; ?>
