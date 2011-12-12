<?php

    // FUNCION AUXILIAR NECESARIA
    function traducir_de_fecha_scorm12 ($string, $tipo=null)
    {
      if ((!$string) && ($tipo != 1)) {return 0;}
      $parametros = explode(':', $string);

      $horas = (int) $parametros[0];
      $minutos = (int) $parametros[1];
      $segundos = floor((int) $parametros[2]);

      $total = ($horas * 3600) + ($minutos * 60) + $segundos;

      if ($tipo!=1)
      {
         return $total;
      }else{
             $horas = floor($ttotal / 3600);
             $minutos = (floor($ttotal / 60) % 60);
             return "$horas horas, $minutos minutos y $segundos segundos";
           }
    }

?>
