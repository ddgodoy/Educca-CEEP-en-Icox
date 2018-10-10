<?php echo $mensaje; ?>

<br>

<?php 
  
  $operacion = 'get';
  $operando = '0';
  
  $consulta = "$operacion.null.cmi.interactions._children";
  echo "Consulta >> &nbsp;&nbsp; $consulta<br>";
  echo "Resultado >> &nbsp;&nbsp; ".$cmi->performQuery($consulta, $operando).'<br><br><br>';
  
  
  
  $operacion = 'set';
  $operando = '1.2';
  
  
  $consulta = "$operacion.null.cmi.interactions.2.weighting";
  echo "Consulta >> &nbsp;&nbsp; $consulta + $operando<br>";
  echo "Resultado >> &nbsp;&nbsp; ".$cmi->performQuery($consulta, $operando).'<br><br>';
  
?>

