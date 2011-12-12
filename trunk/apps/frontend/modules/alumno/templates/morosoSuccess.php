<?php use_helper('informacion');?>
<?php use_helper('SexyButton'); ?>
<div id="contenedor_ecursos">
  <div class="tit_box_ecursos"><h2 class="titbox" style="font-size: 13px;">Este usuario tiene pendiente los pagos de alg&uacute;n curso...</h2></div>
  <div class="cont_box_ecursos">
  <br>
    <strong>Estamos pendientes de recibir sus pagos de los siguientes cursos:</strong>
      <br><br>
        <ul style="text-align: left; padding-left: 300px;">
        <?php foreach ($cursosm as $curso) : ?>
            <li><?php echo $curso->getCurso()->getNombre(); ?></li>
        <?php endforeach; ?>
        </ul>
    <br><br>
    <strong>No tendr&aacute; acceso a estos cursos hasta que no realice los pagos correspondientes.</strong>
    <br><br><br>
    <center>
    <table><tr><td><?php echo sexy_button_to('Ir al escritorio de alumno', 'alumno/index') ?></td></tr></table>
    </center>
    <br>
  </div>
  <div class="cierre_box_correo"></div>
</div>
