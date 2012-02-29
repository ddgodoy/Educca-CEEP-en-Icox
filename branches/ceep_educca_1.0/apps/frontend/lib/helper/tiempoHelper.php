<?php

  // Nombre del método: echoTiempo($segundos)
  // Añadida por: Jacobo Chaquet
  // Descripción: pasa de segundos a un string con el formato Horas:minutos:segundos

  function echoTiempo($segundos)
  {
    $horas = floor($segundos / 3600);
    if ($horas<10)
    {
      $horas = "0".$horas;
    }

    $minutos = (floor($segundos / 60)) % 60;
    if ($minutos<10)
    {
      $minutos = "0".$minutos;
    }

    $seg = (floor($segundos)) % 60;
    if ($seg<10)
    {
      $seg = "0".$seg;
    }
    echo("$horas:$minutos");
  }



    function segundos_tiempo($segundos)
    {
    //Función que pasa los segundos a formato 00:00:00
    $minutos=$segundos/60;
    $horas=floor($minutos/60);
    $minutos2=$minutos%60;
    $segundos_2=$segundos%60%60%60;
    if($minutos2<10)$minutos2='0'.$minutos2;
    if($segundos_2<10)$segundos_2='0'.$segundos_2;

    if($segundos<60){ // segundos
          if ($segundos<10) {
           	$resultado= '00:00:0'.$segundos;
           }else  $resultado= '00:00:'.$segundos;
    }elseif($segundos>=60 && $segundos<3600){// minutos
            $resultado= '00:'.$minutos2.':'.$segundos_2;
           }else{// horas
                 $resultado= $horas.':'.$minutos2.':'.$segundos_2;
                }
    return $resultado;
    }

?>
