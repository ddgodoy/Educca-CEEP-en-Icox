<?php use_helper('SexyButton') ?>
<div id="miscursos_g">
  <div class="tit_box_mensajes">
      <h2 class="titbox"><?= $curso->getNombre(90) ?> : Informaci&oacute;n General y Normativa</h2></td>
  </div>
  <div class="cont_box_correo">
    <div class="divinfo">
      <table class="tablanormativa">
        <tr>
          <td class="titulo"><h3>Normativa</h3></td>
        </tr>
        <tr>
          <td class="cont">
            <pre class='texto_normal'><?php echo wordwrap($curso->getMateria()->getNormativa(), 140, "\n"); ?></pre>
    	    </td>
        </tr>
        <tr>
          <td class="titulo"><h3>Informaci&oacute;n general</h3></td>
        </tr>
        <tr>
          <td class="cont"><pre class='texto_normal'><?php echo wordwrap($curso->getMateria()->getInformacion(), 140, "\n") ?></pre></td>
        </tr>
        <tr>
          <td class="cont">&nbsp;</td>
        </tr>
        <tr>
          <td class="cont"><pre class='texto_normal'><?php echo wordwrap($curso->getInformacionExtendida(), 140, "\n") ?></pre></td>
        </tr>

    	</table>
	  </div><br/>

     <? use_helper('volver'); ?>
     <?php if ($rol == 'profesor') : ?>
                <?php if (isset($idcurso)) : ?>
					         <?php $redireccion = "?idcurso=".$idcurso; ?>
						    <?php else  : ?>
							     <?php $redireccion = "?" ; ?>
				        <?php endif; ?>

			   <table border='0' width='100%'>
				   <tr>
				      <td style="width:20%;"><? echo volver();     ?></td>
				      <td style="width:17%;">&nbsp;</td>
				      <td style="width:63%;"><?php echo sexy_button_to('Modificar informaci&oacute;n', 'curso/modificarNormativa'.$redireccion); ?></td>
           </tr>
         </table>

        <?php else  : ?>
             <? echo volver();     ?>
        <?php endif;?>




  </div>
  <div class="cierre_box_correo"></div>
</div>
