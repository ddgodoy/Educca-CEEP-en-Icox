<?php
      echo (($moduloActual == 'supervisor') && ($accionActual == 'index'))? image_tag('bots_miescritorioh.gif', array('alt' => 'Mi escritorio', 'title' => 'Mi escritorio')) : rollover('supervisor/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
	    echo rollover('sfSimpleForum/forum?forum_name=comunidad&submenu=off', 'bots_comunidad.gif', 'bots_comunidadh.gif', 'comunidad', 'Comunidad');
      echo rollover('usuario/ayuda', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
	    echo image_tag('bots_cierre.gif', '');
?>
