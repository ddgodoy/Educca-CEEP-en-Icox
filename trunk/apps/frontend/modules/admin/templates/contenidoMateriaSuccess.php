<?php use_helper('Validation', 'SexyButton', 'informacion') ?>

<script type="text/javascript">
  function activar_div (indice)
  {
    var target = 'divtema'+(indice + 1);
    if (document.getElementById('selecttema'+indice).value != '')
    {
      document.getElementById(target).style.display = 'block';
    }
  }
</script>

<div class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Configurar contenido de la materia "<?php echo $materia->getNombre(); ?>"</h2></div>
  <div class="contenido_principal">
<?php if ($display_warning):?><?php echoWarning('IMPORTANTE', 'Si guarda esta nueva configuraci&oacute;n se perder&aacute; toda la informaci&oacute;n relacionada con los temas anteriores como los tiempos invertidos por los alumnos en cada tema y el estado de avance de los alumnos en el curso.');?><br><br><?php endif;?>
<?php echo form_tag('admin/contenidoMateria', 'multipart=true') ?>

  <input type="hidden" name="idmateria" value="<?php echo $materia->getId() ?>">
  
  <table class="tablanuevacita">
    <tr>
      <td width="120">&nbsp;</td>
      <th style="text-align: left; padding-left: 8px; width: 250px;">T&iacute;tulo del tema</th>
      <th style="text-align: left; padding-left: 8px;">&nbsp;&nbsp;&nbsp;&nbsp;Fichero</th>
    </tr>
  </table>
  <?php $nresultados = sizeof($resultados); $maxentradas = $nresultados; if ($maxentradas > 30) {$maxentradas = 30;}?>
  <?php for ($index = 0; $index < $maxentradas; $index++): ?>
  <div id="divtema<?php echo $index?>" <?php if ($index) {echo 'style="display: none;"';} ?>>
  <table class="tablanuevacita">
  <tr>
    <td class="titulo_largo"><strong><label for="nombre">Tema <?php echo ($index+1);?>:&nbsp;&nbsp;</label></strong></td>
    <td class="td_especial">
      <input type="text" name="nombretema<?php echo $index?>" style="height: 18px; width: 250px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select name="selecttema<?php echo $index?>" id="selecttema<?php echo $index?>" <?php if ($index != ($nresultados - 1)) {echo 'onchange="activar_div('.$index.')"';} ?>>
        <option value="">&nbsp;</option>
        <?php for ($j = 0; $j < $nresultados; $j++): ?>
          <option value="<?php echo $resultados[$j]?>"><?php echo $resultados[$j]?></option>
        <?php endfor;?>
      </select>
    </td>
  </tr>
  </table>
  </div>
  <?php endfor;?>
  <br><br>
  
  <table class="tablanuevacita">
    <tr>
      <td width="125">&nbsp;</td>
      <td width="185"><?php echo sexy_submit_tag('Guardar esta configuraci&oacute;n'); ?></td>
      <td><?php echo sexy_button_to('Volver', 'admin/editMateria?idmateria='.$materia->getId()); ?></td>
    </tr>
  </table>
  <input type="hidden" name="maxtemas" value="<?php echo $nresultados ?>">
  
</form>
    
    
    
  </div>
  <div class="cierre_principal"></div>
</div>
