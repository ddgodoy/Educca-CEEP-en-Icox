<?php use_helper('Javascript','SexyButton', 'Validation') ?>

<?php if (isset($modulo)) {
  $titulo = $modulo->getNombre();
  $tag = input_hidden_tag('idmodulo', $modulo->getId());
  $volver = 'comercial/ficha?idmodulo='.$modulo->getId();
} else if (isset($curso)) {
  $titulo = $curso->getNombre();
  $tag = input_hidden_tag('idcurso', $curso->getId());
  $volver = 'comercial/ficha?idcurso='.$curso->getId();
}
?>

<div id="contenedor_ficha">
  <div class="tit_box_ficha"><h2 class="titbox">Matr&iacute;cula <?= $titulo ?></h2></div>
  <div class="cont_box_grande">
    <div id="dinamico">
      <table class="tablafichac">
        <tr>
          <td>Atenci&oacute;n, est&aacute;s a punto de matricularte en el <?= $titulo ?>,
              si pulsas "Confirmar" recibir&aacute;s un email con las instrucci&oacute;nes para formalizar tu matr&iacute;cula.</td>
        </tr>
        <tr>
          <td class="tddesc" align="center"><br/>
            <?php echo form_remote_tag(array(
                                            'update'   => 'dinamico',
                                            'url'      => 'comercial/confirmacion',
                                        )) ?>
            <?php echo $tag ?>
            <?php echo input_hidden_tag('yaregistrado','1') ?>
            <?php echo sexy_submit_tag('Confirmar') ?>
          </td>
        </tr>
        <tr>
          <td class="tdmatricula">
            <table width="100%">
              <tr>
                <td style="text-align:left; vertical-align:bottom;">
                   <?php echo link_to(image_tag('bot_volver.gif','Alt=Volver'),$volver) ?>
                </td>
                <td style="text-align:right;">
                  &nbsp;
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="cierre_box_grande"></div>
</div>
<?php slot('columna_derecha') ?>
    <div class="tit_box_calendariop"><h2 class="titbox">Oferta de Cursos</h2></div>
    <div class="cont_box_promo">
      <table class="cont_peq_tabl" cellspacing="0" cellpading="0">
        <tr height="10">
          <td align="right"></td>
          <td></td>
        </tr>
        <tr>
          <td align="right"><?php echo image_tag('banners/promocursos_1.jpg') ?></td>
          <td><?php echo image_tag('banners/promocursos_2.jpg') ?></td>
        </tr>
        <tr height="5">
          <td class="tdindent"><?php echo sexy_button_to('Ver cursos', 'comercial/index'); ?></td>
          <td valign="top"><?php echo image_tag('banners/promocursos_3.jpg') ?></td>
        </tr>
      </table>
    </div>
    <div class="cierre_promocursos"></div>
<?php end_slot() ?>