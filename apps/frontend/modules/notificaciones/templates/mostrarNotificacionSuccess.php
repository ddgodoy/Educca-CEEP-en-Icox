<?php use_helper('Javascript') ?>
<?php use_helper('SexyButton') ?>

<script language="javascript" type="text/javascript">

  function borrar_not_conf()
  {
    return confirm('Una vez borradas las notificaciones desaparecen de forma permanente, est\u00e1 seguro de que quiere borrar esta notificaci\u00f3n?');
  }

</script>


<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $notificacion->getTitulo() ?></h2></div>
  <div class="cont_box_correo">
      <div class="herramientas">
       <table  cellpadding="0" cellspacing="0">
          <tr valign='top'>
            <td valign='top'><?php echo sexy_button_to('Borrar notificaci&oacute;n', 'notificaciones/borrarNotificacion?id_notificacion='.$notificacion->getId(), array('onClick' => 'return borrar_not_conf();')) ?></td>
          </tr>
       </table>

      </div>
      <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Asunto:</td>
                <td><?php echo $notificacion->getTitulo()?></td>
              </tr>
              <tr>
                <td class="titulo">Curso:</td>
                <td><? if ($notificacion->getCurso()) : ?>
                                <?php echo $notificacion->getCurso()->getNombre() ?>
                    <?endif; ?>
                    </td>
              </tr>
              <tr>
                <td class="titulo">Fecha:</td>
                <td><?php echo $notificacion->getCreatedAt("d-m-Y  H:i")?></td>
              </tr>
            </table>
        </div>
        <div class="cont_mensaje">
            <?php echo $notificacion->getContenido()?>
        </div>
      </div>
     <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>


