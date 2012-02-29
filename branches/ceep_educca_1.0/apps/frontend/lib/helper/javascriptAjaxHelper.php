<?php

  // Nombre del método: cargaPagina($url,$param,$modo=0)
  // Añadida por: Jacobo Chaquet
  /* Descripción: - permite redirigir a una accion mediante javascript
                  - para que funcione con los helpers de ajax hay que incluir 'script' => true
                    en "echo form_remote_tag" (ver curso/nuevoLibroSuccess)
                  - $modo = 0 redirige modulo/accion (modo symfony)
                    $modo = 1 redirige a cualquier pagina de internet (Ej: http://www.google.es  es necesario el http://)
                  - $param = parametros que queramos pasar (Ej: par1=4&par2)
                  - $url según $modo

  */
  function cargaPagina($url,$param=null,$modo=0)
  {
    if (0==$modo) {
       return javascript_tag("window.location='".url_for($url.'?'.$param)."';");
     } else {
            return javascript_tag("window.location='$url?$param'");}
  }

?>
