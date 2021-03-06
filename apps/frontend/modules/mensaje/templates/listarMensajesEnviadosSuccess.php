<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tablamensajes" cellspacing="0">
    <tr class="filatitulo">
      <td class="td1"><input name="selectall" id="selectall" type="checkbox" onClick="checkAll()"></td>
      <th class="td3">De</th>
      <th class="td4">Para</th>
      <th class="td5">Asunto</th>
      <th class="td6">Curso</th>
      <th class="td7">Fecha</th>
    </tr>
  </table>
</div>
<div class="listado_tabla_general">
  <table class="tablamensajes" cellspacing="0">
    <?php $i = 0; ?>
    <?php foreach($mensajes as $mensaje): ?>
      <?php $fondo = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
      <tr class="leido" <?php echo $fondo;?>>
        <td class="td1"><?php echo checkbox_tag("mensaje$i", $mensaje->getId(), false) ?></td>
        <td class="td3"><?php $user = UsuarioPeer::RetrieveByPk($mensaje->getIdEmisor()); echo truncate_text($user->getNombre()." ".$user->getApellidos(), 35); ?></td>
        <td class="td4"><?php echo $mensaje->getListaDestinatarios() ?></td>
        <td class="td5"><?php echo link_to(truncate_text($mensaje->getAsunto_mensaje()->getDescripcion(), 30), 'mensaje/mostrarMensajeEnviado?id_mensaje='.$mensaje->getId()) ?></td>
        <td class="td6"><?php $curso = CursoPeer::RetrieveByPk($mensaje->getIdCurso()); echo truncate_text($curso->getNombre(), 30) ?></td>
        <td class="td7"><?php echo $mensaje->getCreatedAt('H:i d/m/Y') ?></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </table>
  <?php if (!$i):?>
    <?php echoAvisoVacio("La carpeta de mensajes enviados est&aacute; vac&iacute;a");?>
  <?php endif; ?>
  
  <?php echo (input_hidden_tag('total_mensajes', $i)); ?>
</div>
