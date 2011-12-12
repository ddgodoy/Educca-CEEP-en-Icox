<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>

<script language="javascript" type="text/javascript">

  function confirmar() {
  
    return confirm('La entrega del examen ser\u00e1 definitiva y ya no podr\u00e1 modificarlo. Desea continuar ?');
  
  }

</script>

<table style="width: 100%; text-align: left;">
<tr>

  <?php if ($modo == 'mostrar'): ?>
      
    <td><?php echo sexy_button_to('Resolver / editar soluci&oacute;n', 'examen/resolverExamen') ?></td>
    
    <?php if ($relacion->getIdEjercicioResuelto() != null): ?>
      <td><?php echo sexy_button_to('Entregar el examen', 'examen/entregarExamen', array('onClick' => 'return confirmar();')) ?></td>
    <?php endif; ?>
    
  <?php endif; ?>



  <?php if ($modo == 'resolver'): ?>
    <td><?php echo sexy_submit_tag('Guardar resultados') ?></td>
  <?php endif; ?>

  <td style="text-align: right;"><input class="contador_grande" name="contador" id="contador" value="" readonly="readonly" type="text"></td>
</tr>
</table>
