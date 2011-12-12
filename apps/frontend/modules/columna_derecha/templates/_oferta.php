<div class="tit_box_calendariop"><h2 class="titbox">Oferta de Cursos</h2></div>
    <div class="cont_box_promo" style="height: 143px;"><table style="width: 100%; height: 139px;" cellspacing="0" cellpading="0">
        <tr style="height: 10px;">
          <td style="width: 50%;">&nbsp;</td>
          <td style="width: 236px;">&nbsp;</td>
          <td style="width: 50%;">&nbsp;</td>
        </tr>
        <tr style="height: 88px;">
          <td style="width: 50%;">&nbsp;</td>
          <td style="width: 236px;">
            <table style="width: 236px;" cellspacing="0" cellpading="0">
              <tr>
                <td style="width: 113px; height:88px;"><?php echo image_tag('banners/banner_left.gif') ?></td>
                <td style="width: 51px; height:88px;">
                  <table style="width: 51px;" cellspacing="0" cellpading="0">
                    <tr>
                      <td style="width: 51px; height:33px;"><?php echo image_tag('banners/banner_up.gif') ?></td>
                    </tr>
                    <tr>
                      <!--      LA IMAGEN DEL LOGO (PEQUEÑA) DEBE SER DE  51x34   PÍXELES !!!!  -->
                      <?php if(file_exists('images/logo_peq.jpg')):?>
                        <td style="width: 51px; height:34px;"><?php echo image_tag('logo_peq.jpg') ?></td>
                      <?php else: ?>
                        <td style="width: 51px; height:34px; background-color: #000000;"> &nbsp;</td>
                      <?php endif; ?>
                    </tr>
                    <tr>
                      <td style="width: 51px; height:21px;"><?php echo image_tag('banners/banner_down.gif') ?></td>
                    </tr>
                  </table>
                </td>
                <td style="width: 72px; height:88px;"><?php echo image_tag('banners/banner_right.gif') ?></td>
              </tr>
            </table>
          </td>
          <td style="width: 50%;">&nbsp;</td>
        </tr>
        <tr style="height: 41px;">
          <td style="width: 50%;">&nbsp;</td>
          <td style="width: 236px; height: 41px;">
            <table style="width: 236px; height: 41px;" cellspacing="0" cellpading="0">
              <tr>
                <td style="width: 140px; height: 41px; padding-left: 15px;">
                  <?php echo sexy_button_to('Ver cursos', 'comercial/index'); ?>
                </td>
                <td style="width: 96px; height: 41px;">
                  <?php echo image_tag('banners/promocursos_3.jpg') ?>
                </td>
              </tr>
            </table>
          </td>
          <td style="width: 50%;">&nbsp;</td>
        </tr>
      </table></div><div class="cierre_promocursos"></div>
