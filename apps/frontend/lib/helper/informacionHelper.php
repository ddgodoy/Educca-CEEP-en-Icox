<?php

  // Nombre del método: echoNotaInformativa($asunto, $explicacion)
  // Añadida por: Ángel Martín Latasa
  // Descripción: muestra una nota informativa con el asunto en negrita y una
  // explicación. Si no hay asunto sólo se muestra la explicación
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

  // Nombre del método: echoNotaInformativaAjustada($asunto, $explicacion)
  // Añadida por: Ángel Martín Latasa
  // Descripción: lo mismo pero width al 95%
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

  // Nombre del método: echoNotaInformativaCorta($asunto, $explicacion)
  // Añadida por: Ángel Martín Latasa
  // Descripción: lo mismo pero mas corta
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


  // Nombre del método: echoAvisoVacio($mensaje, $black=false)
  // Añadida por: Ángel Martín Latasa
  // Descripción: para el caso de listas sin elementos es el cuadro que muestra
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

  // Nombre del método: echoWarning($asunto, $explicacion, $indetifier, $hidden)
  // Añadida por: Ángel Martín Latasa
  // Descripción: muestra una advertencia con el asunto en negrita y una
  // explicación. Si no hay asunto sólo se muestra la explicación.
  // Si el parámetro hidden es 'true' la capa no se mostrará
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
