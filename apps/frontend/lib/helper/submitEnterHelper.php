<?php

  // Nombre del método: echoNotaInformativa($asunto, $explicacion)
  // Añadida por: Jacobo Chaquet Ulldemolins
  /* Descripción: añadira el codigo javascript para que pulsando la tecla enter se haga
                  submit del formario que se le pasa por parametro
                  requiere el helper de javascript
                  */

use_helper('Javascript');

  function echoSubmitEnter()
  {
    echo javascript_tag("

    function iSubmitEnter(oEvento, oFormulario)
    {
         var iAscii;

        (oEvento.keyCode) ? iAscii=oEvento.keyCode : iAscii=oEvento.which;

         if (iAscii == 13) oFormulario.submit();

         return true;
    }


    function siguiente_campo(e,t)
    {
    var k=null;
    (e.keyCode) ? k=e.keyCode : k=e.which;
    if(k==13)
      t.focus();
    }


   ");
  }



?>
