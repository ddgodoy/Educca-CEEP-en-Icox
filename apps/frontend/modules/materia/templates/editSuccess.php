<?php
// auto-generated by sfPropelCrud
// date: 2007/08/02 11:54:44
?>
<?php use_helper('Object') ?>

<?php echo form_tag('materia/update') ?>

<?php echo object_input_hidden_tag($materia, 'getId') ?>

<table>
<tbody>
<tr>
  <th>Nombre:</th>
  <td><?php echo object_input_tag($materia, 'getNombre', array (
  'size' => 80,
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($materia->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'materia/delete?idcurso='.$materia->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'materia/show?idcurso='.$materia->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'materia/list') ?>
<?php endif; ?>
</form>
