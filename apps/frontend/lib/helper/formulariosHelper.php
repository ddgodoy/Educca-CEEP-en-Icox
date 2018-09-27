<?php


function echoSelectwMatch($nombre, $valor, $opciones_select, $parametros) 
{

  echo('<select name="'.$nombre.'" id="'.$nombre.'"');
  foreach($parametros as $name => $value) 
  {
    echo(" $name=");
    echo('"'.$value.'"');
  }
  echo(">\n");
  
  foreach($opciones_select as $value => $description) 
  {  
    echo('<option value="'.$value);
    if ($valor == $value)
    {
      echo('" selected>');
    }
    else
    {
      echo('">');
    }
    echo($description);
    echo("</option>\n");
  }
  echo("</select>");
}



?>
