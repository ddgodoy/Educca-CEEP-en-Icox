<?php
      echo (($moduloActual == 'admin') && ($accionActual == 'index'))? image_tag('bots_miescritorioh.gif', array('alt' => 'Mi escritorio', 'title' => 'Mi escritorio')) : rollover('admin/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
	    echo rollover('administrador/index', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');

	    echo image_tag('bots_cierre.gif', '');
?>
