<?php

  // Nombre del m�todo: volver()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve una cadena (para hacer echo), con un boton que al pulsar
                  vuelve a la p�gina anterior
  */
  function volver($align='left')
  {
    $cad="<div id='capa_volver' align='$align'>
               <a href='javascript:window.history.back()'>
              ".image_tag('bot_volver.gif', array('title' => 'Atr&aacute;s', 'alt' => 'Atr&aacute;s'))."
              </a>
          </div>";
    return $cad;
  }
?>
