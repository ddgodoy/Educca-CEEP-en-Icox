<?php use_helper('informacion'); ?>
<?php if (isset($info)) :  ?>
  <?php include_component('paquete', 'fichaModulo',array('idmodulo' => $idmodulo,'info' => $info)) ?>
<?php else : ?>
  <?php include_component('paquete', 'fichaModulo',array('idmodulo' => $idmodulo)) ?>
<?php endif; ?>

