<?php use_helper('Text') ?>
<div id="listado_mensajes_recibidos_c" class="nombrescol">
  <table class="tablamensajescorto" cellspacing="0">
    <tr>
      <th class="td3">&nbsp;&nbsp;De</th>
      <th class="td4">Asunto</th>
      <th class="td6">Fecha</th>
    </tr>
  </table>
</div>
<div id="listado_mensajes_recibidos_c" class="mensajes" style="border: #CCCCCC 1px solid;">
  <table class="tablamensajescorto" cellspacing="0">
    <?php $i = 0; ?>
    <?php foreach($mensajes as $mensaje): ?>
      <?php $fondo = (($i % 2) == 0)? "id=\"filarayada\"" : ''; ?>
      <tr<?php echo ($mensaje->getLeido())? " class=\"leido\"" : " class=\"noleido\""; echo $fondo;?>>
        <td class="td3">&nbsp;&nbsp;<?php $user = UsuarioPeer::RetrieveByPk($mensaje->getIdEmisor()); echo truncate_text($user->getNombre()." ".$user->getApellidos(), 22); ?></td>
        <td class="td4"><?php echo link_to(truncate_text($mensaje->getAsunto_mensaje()->getDescripcion(), 40), 'mensaje/mostrarMensajeRecibido?id_mensaje='.$mensaje->getId(), array('class' => 'a_explicito')) ?></td>
        <td class="td6"><?php echo $mensaje->getCreatedAt('d/m/Y') ?></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
    <?php if ($i == 0) : ?>
      <tr>
        <td class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?> <span class="txtinfo">No tiene ning&uacute;n mensaje.</span></td>
      </tr>
    <?php endif; ?>
    <?php echo (input_hidden_tag('total_mensajes', $i)); ?>
  </table>
</div>
