<?php

function getTiempoAbsoluto($str) {

  $str[10] = 'T';
  $str .= '+00:00';
  return strtotime($str);

}

function darFormato($str) 
{

  $salida="dd-mm-yyyy a las hh:mm";
  
  // Dia
  $salida[0] = $str[8];
  $salida[1] = $str[9];
  // Mes
  $salida[3] = $str[5];
  $salida[4] = $str[6];
  // Año
  $salida[6] = $str[0];
  $salida[7] = $str[1];
  $salida[8] = $str[2];
  $salida[9] = $str[3];
  // Hora
  $salida[17] = $str[11];
  $salida[18] = $str[12];
  // Minuto
  $salida[20] = $str[14];
  $salida[21] = $str[15];
  
  return $salida;
}

function darFormatoSinHora($str) {

  $salida="dd-mm-yyyy";
  
  // Dia
  $salida[0] = $str[8];
  $salida[1] = $str[9];
  // Mes
  $salida[3] = $str[5];
  $salida[4] = $str[6];
  // Año
  $salida[6] = $str[0];
  $salida[7] = $str[1];
  $salida[8] = $str[2];
  $salida[9] = $str[3];
    
  return $salida;

}



?>
