
 <h2><?php echo $tipo ?></h2>
 <br>
 <ul>
    <li><?php echo link_to('Buscar '.$tipo, 'supervisor/buscar?tipo='.$tipo) ?> </li>
    <li><?php echo link_to('Dar de alta a '.$tipo, 'supervisor/alta?tipo='.$tipo) ?> </li>
    <li><?php echo link_to('Dar de baja a '.$tipo, 'supervisor/baja?tipo='.$tipo) ?> </li>
    <li><?php echo link_to('Modificar '.$tipo, 'supervisor/modificacion?tipo='.$tipo) ?> </li>
  </ul>