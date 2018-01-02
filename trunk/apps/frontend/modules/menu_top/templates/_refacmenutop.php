<?php 
    if (($moduloActual == $rol) && ($accionActual == 'index')){//Compruebo que estoy en el m�dulo de alumno y voy a ejecutar la
                                  //acci�n index, para dejar est�tico el gif de Mi escritorio
      echo image_tag('bots_miescritorioh.gif', array('alt' => 'Mi escritorio', 'title' => 'Mi escritorio'));
      echo rollover('comercial/index', 'bots_ecursos.gif', 'bots_ecursosh.gif', 'ecursos', 'Oferta de cursos online');
	    if ($rol != 'moroso') 
            {
                echo rollover('sfSimpleForum/forum?forum_name=comunidad&submenu=off', 'bots_comunidad.gif', 'bots_comunidadh.gif', 'comunidad', 'Comunidad');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
	    }

    } else if (($moduloActual == 'comercial') && ($accionActual == 'index')) {//Compruebo que estoy en el m�dulo de alumno y voy a ejecutar la
                                                                                //acci�n mostrarCursos, para dejar est�tico el gif de ecursos
        echo rollover($rol.'/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
        echo image_tag('bots_ecursosh.gif', array('alt' => 'Oferta cursos online', 'title' => 'Oferta de cursos online'));
            if ($rol != 'moroso') 
            {
                echo rollover('sfSimpleForum/forum?forum_name=comunidad&submenu=off', 'bots_comunidad.gif', 'bots_comunidadh.gif', 'comunidad', 'Comunidad');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
            }

    } else if ($accionActual == 'ayuda') {//Compruebo que estoy en el m�dulo de alumno y voy a ejecutar la
                                          //acci�n ayuda, para dejar est�tico el gif de ayuda
          echo rollover($rol.'/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
          echo rollover('comercial/index', 'bots_ecursos.gif', 'bots_ecursosh.gif', 'ecursos', 'Oferta de cursos online');
          if ($rol != 'moroso') 
          {
                echo rollover('sfSimpleForum/forum?forum_name=comunidad&submenu=off', 'bots_comunidad.gif', 'bots_comunidadh.gif', 'comunidad', 'Comunidad');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
                echo image_tag('bots_ayudah.gif',array('alt' => 'Ayuda', 'title' => 'Ayuda'));
          }

    } else if ($sf_params->get('forum_name') == 'comunidad') {//Compruebo que estoy en el m�dulo de foro para dejar su gif est�tico

          echo rollover($rol.'/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
          echo rollover('comercial/index', 'bots_ecursos.gif', 'bots_ecursosh.gif', 'ecursos', 'Oferta de cursos online');
          if ($rol != 'moroso') 
          {
                echo image_tag('bots_comunidadh.gif',array('alt' => 'Comunidad', 'title' => 'Comunidad'));
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
          }
    
    } else {
          echo rollover($rol.'/index', 'bots_miescritorio.gif', 'bots_miescritorioh.gif', 'escritorio', 'Volver a mi escritorio');
          echo rollover('comercial/index', 'bots_ecursos.gif', 'bots_ecursosh.gif', 'ecursos', 'Oferta de cursos online');
          if ($rol != 'moroso') 
          {
                echo rollover('sfSimpleForum/forum?forum_name=comunidad&submenu=off', 'bots_comunidad.gif', 'bots_comunidadh.gif', 'comunidad', 'Comunidad');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
                echo rollover('https://www.grupoceep.com/noticias-y-eventos/', 'bots_ayuda.gif', 'bots_ayudah.gif', 'ayuda', 'Ayuda');
          }
    }

    echo image_tag('bots_cierre.gif', '');
?>
