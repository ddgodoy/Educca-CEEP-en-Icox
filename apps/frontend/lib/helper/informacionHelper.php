<?php

  // Nombre del m�todo: echoNotaInformativa($asunto, $explicacion)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: muestra una nota informativa con el asunto en negrita y una
  // explicaci�n. Si no hay asunto s�lo se muestra la explicaci�n
  function echoNotaInformativa($asunto, $explicacion)
  {
    echo("<div class=\"nota_informativa\">");
    echo("<table>");
    echo("<tr>");
    echo("<td class=\"td1\" valign='middle'>"); echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo'); echo("</td>");

    echo("<td class=\"td2\">");
    if ($asunto != "") {echo("<strong>".$asunto.".</strong> ");}
    echo($explicacion);
    echo("</td>");

    echo("</tr>");
    echo("</table>");
    echo("</div>");
  }

  // Nombre del m�todo: echoNotaInformativaAjustada($asunto, $explicacion)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: lo mismo pero width al 95%
  function echoNotaInformativaAjustada($asunto, $explicacion)
  {
    echo("<div class=\"nota_informativa_ajustada\">");
    echo("<table>");
    echo("<tr>");
    echo("<td class=\"td1\">"); echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo'); echo("</td>");

    echo("<td class=\"td2\">");
    if ($asunto != "") {echo("<strong>".$asunto.".</strong> ");}
    echo($explicacion);
    echo("</td>");

    echo("</tr>");
    echo("</table>");
    echo("</div>");
  }

  // Nombre del m�todo: echoNotaInformativaCorta($asunto, $explicacion)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: lo mismo pero mas corta
  function echoNotaInformativaCorta($asunto, $explicacion)
  {
    echo("<div class=\"nota_informativa_corta\">");
    echo("<table>");
    echo("<tr>");
    echo("<td class=\"td1\">"); echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo'); echo("</td>");

    echo("<td class=\"td2\">");
    if ($asunto != "") {echo("<strong>".$asunto.".</strong> ");}
    echo($explicacion);
    echo("</td>");

    echo("</tr>");
    echo("</table>");
    echo("</div>");
  }


  // Nombre del m�todo: echoAvisoVacio($mensaje, $black=false)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: para el caso de listas sin elementos es el cuadro que muestra
  // el aviso diciendo que la tabla esta vacia. Si el parametro $black es true
  // muestra un borde negro (para las listas cortas)
  function echoAvisoVacio($mensaje, $black=false)
  {
    if ($black) {echo("<table class=\"tabla_contorno_negro\">");}
    else {echo("<table class=\"tabla_aviso_vacio\">");}
    echo("<tr>");
    echo("<td class=\"tdnoaviso\">");
    echo image_tag('info.gif', 'Title=Informaci&oacute;n', 'class=imginfo');
    echo("<span class=\"txtinfo\">");
    echo("&nbsp;".$mensaje);
    echo("</span>");
    echo("</td>");
    echo("</tr>");
    echo("</table>");

  }

  function echoAvisoVacioCorto($mensaje)
  {
    echo("<table class=\"tabla_aviso_vacio_corta\">");
    echo("<tr>");
    echo("<td class=\"tdnoaviso\">");
    echo image_tag('info.gif', 'Title=Informaci&oacute;n', 'class=imginfo');
    echo("<span class=\"txtinfo\">");
    echo("&nbsp;".$mensaje);
    echo("</span>");
    echo("</td>");
    echo("</tr>");
    echo("</table>");

  }

  // Nombre del m�todo: echoWarning($asunto, $explicacion, $indetifier, $hidden)
  // A�adida por: �ngel Mart�n Latasa
  // Descripci�n: muestra una advertencia con el asunto en negrita y una
  // explicaci�n. Si no hay asunto s�lo se muestra la explicaci�n.
  // Si el par�metro hidden es 'true' la capa no se mostrar�
  function echoWarning($asunto, $explicacion, $javascript=false, $estilo=null)
  {

    if ($javascript) {$texto = "id=\"contenedor_warning\" style=\"display: none;\"";}
    else {$texto = '';}

    if ($estilo)
    {
      echo("<div $texto class=\"$estilo\">");
    }else  echo("<div $texto class=\"nota_informativa\">");
    echo("<table>");
    echo("<tr>");
    echo("<td class=\"td1\">"); echo image_tag('warning_general.gif', 'Title=Importante', 'class=imginfo'); echo("</td>");

    echo("<td class=\"td2\">");
    if ($javascript) {
      echo("<div id=\"mensaje_warning\"></div>");

    } else {
      if ($asunto != "") {echo("<strong>".$asunto.".</strong> ");}
      echo($explicacion);
    }

    echo("</td>");

    echo("</tr>");
    echo("</table>");
    echo("</div>");
  }

    function echoWarningCorto($asunto, $explicacion, $javascript=false, $estilo=null)
  {

    if ($javascript) {$texto = "id=\"contenedor_warning\" style=\"display: none;\"";}
    else {$texto = '';}

    if ($estilo)
    {
      echo("<div $texto class=\"$estilo\">");
    }else  echo("<div $texto class=\"nota_informativa_corta\">");
    echo("<table>");
    echo("<tr>");
    echo("<td class=\"td1\">"); echo image_tag('warning_general.gif', 'Title=Importante', 'class=imginfo'); echo("</td>");

    echo("<td class=\"td2\">");
    if ($javascript) {
      echo("<div id=\"mensaje_warning\"></div>");

    } else {
      if ($asunto != "") {echo("<strong>".$asunto.".</strong> ");}
      echo($explicacion);
    }

    echo("</td>");

    echo("</tr>");
    echo("</table>");
    echo("</div>");
  }

?>
