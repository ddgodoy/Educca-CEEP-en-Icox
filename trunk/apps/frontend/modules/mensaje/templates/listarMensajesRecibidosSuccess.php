<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tablamensajes" cellspacing="0">
    <tr class="filatitulo">
      <td class="td1"><input name="selectall" id="selectall" type="checkbox" onClick="checkAll()"></td>
      <th class="td3">De</th>
      <th class="td4">Asunto</th>
      <th class="td5">Curso</th>
      <th class="td6">Fecha</th>
    </tr>
  </table>
</div>
<div class="listado_tabla_general">
  <table class="tablamensajes" cellspacing="0">
    <?php $i = 0; ?>
    <?php foreach($mensajes as $mensaje): ?>
      <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
      <tr<?php echo ($mensaje->getLeido())? " class=\"leido\"":" class=\"noleido\""; echo $fondo;?>>
        <td class="td1"><?php echo checkbox_tag("mensaje$i", $mensaje->getId(), false) ?></td>
        <td class="td3"><?php $user = UsuarioPeer::RetrieveByPk($mensaje->getIdEmisor()); echo truncate_text($user->getNombre()." ".$user->getApellidos(), 35); ?></td>
        <td class="td4"><?php echo link_to(truncate_text($mensaje->getAsunto_mensaje()->getDescripcion(), 30), 'mensaje/mostrarMensajeRecibido?id_mensaje='.$mensaje->getId(),array('name' => 'ln_mensaje'.$mensaje->getId())) ?></td>
        <td class="td5"><?php $curso = CursoPeer::RetrieveByPk($mensaje->getIdCurso()); echo truncate_text($curso->getNombre(), 30) ?></td>
        <td class="td6"><?php echo $mensaje->getCreatedAt('H:i d/m/Y') ?></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </table>
  <?php if (!$i):?>
    <?php echoAvisoVacio("La carpeta de mensajes recibidos est&aacute; vac&iacute;a");?>
  <?php endif; ?>

  <?php echo (input_hidden_tag('total_mensajes', $i)); ?>
</div>
