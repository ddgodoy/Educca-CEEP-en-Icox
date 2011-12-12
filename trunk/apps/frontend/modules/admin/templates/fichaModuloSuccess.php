<?php use_helper('informacion'); ?>
<? if (isset($info)) :  ?>
  <?php include_component('paquete', 'fichaModulo',array('idmodulo' => $idmodulo,'info' => $info)) ?>
<? else : ?>
  <?php include_component('paquete', 'fichaModulo',array('idmodulo' => $idmodulo)) ?>
<? endif; ?>

