<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

<script language="javascript" type="text/javascript">

  var tiempo_restante = <?php echo $tiempo ?>;
  
  function actualizar_contador () {
    var minutos = Math.floor(tiempo_restante / 60);
    var segundos = tiempo_restante % 60;
    var tm;
    var ts;
    
    if (tiempo_restante <= 0) {
      window.location = window.location+'/prevExamen';
    }
    else
    {
      if (minutos < 10) {tm = '0'+minutos;}
      else {tm = minutos;}
      
      if (segundos < 10) {ts = '0'+segundos;}
      else {ts = segundos;}
      
      document.getElementById('contador').value = tm+':'+ts;
      tiempo_restante--;
    }
  }
  
</script>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal">
    <h2 class="titbox">
      Examen !! 
    </h2>
  </div>
  <div class="contenido_principal">
    <br>

    <?php echoNotaInformativa('El examen de '.$curso->getNombre().' comenzar&aacute; en &nbsp;</strong><input class="input_contador" name="contador" id="contador" value="" readonly="readonly" type="text"><strong><br><br> En v&iacute;speras de un examen y hasta que finalice el mismo todas las funciones de la plataforma estar&aacute;n deshabilitadas', ''); ?>

      
  </div>
  <div class="cierre_principal"></div>
</div>
<script language="javascript" type="text/javascript">
new PeriodicalExecuter(actualizar_contador, 1)
</script>
