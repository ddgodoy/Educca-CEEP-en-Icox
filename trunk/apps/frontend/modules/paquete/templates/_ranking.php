<?php use_helper('Text');?>
<div id='capaCalendario'>
<div class="tit_box_calendariop"><h2 class="titbox">Ranking</h2></div>
    <div class="cont_box_pequeno">
    <? if ($evaluacion) : ?>
      <table style="width: 95%;">
        <tr class="cont_fil">
          <td style="width: 12%; text-align: left;"><b>#</b></td>
          <td style="width: 78%; text-align: left;"><b>Alumno</b></td>
          <td style="width: 10%; text-align: center;"><b>Nota</b></td>
        </tr>
      <? $i=1; ?>
       <? foreach($datos as $dato => $clave) :?>
          <?     if (1==strlen($clave))
                 {  $clave.=".00";
                 }else if (3==strlen($clave))
                       {
                         $clave.="0";
                       }
            ?>
        <tr height="20" <?php if ($i%2) {echo 'id="filarayada"';}?>>
          <td style="width: 10%; text-align: left;"><?php if ($i < 4) {echo '<strong>';} ?><?php echo $i; ?>&ordm; <?php if ($i < 4) {echo '</strong>';} ?></td>
          <td style="width: 80%; text-align: left;"><?php echo truncate_text($dato, 32); ?></td>
          <td style="width: 10%; text-align: center;"><?php if ($i < 4) {echo '<strong>';} ?><?php echo sprintf("%.2f", $clave); ?><?php if ($i < 4) {echo '</strong>';} ?></td>
        </tr>
        <? $i++; ?>
        <? endforeach; ?>
    <? else : ?>
      <table>
        <tr>
          <td><? echo image_tag('info_general.gif', 'Title=Informaci&oacute;n', 'class=imginfo');?></td>
          <td>No se ha realizado a&uacute;n la evaluaci&oacute;n.</td>
        </tr>
      </table>


    <? endif; ?>

      </table>
    </div>
    <div class="cierre_box_pequeno"></div>
</div>
