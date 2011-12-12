<?php use_helper('SexyButton') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Ficha tema <? echo $tema->getNombre()?></h2></div>
  <div class="cont_box_correo">
    <div class="herramientas">
        <?php /*echo sexy_button_to('Modificar Curso','admin/modificarTema?idtema='.$tema->getId()) */?>
    </div>

        <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Numero Tema:</td>
                <td><? echo $tema->getNumeroTema()?></td>
              </tr>

              <tr>
                <td class="titulo"> Materia:</td>
                <td><? echo $tema->getMateria()->getNombre()?></td>
              </tr>
            </table>
            </div>
      </div>

<div id="divadmin">
           <table>
		   <tr>
		          <td>
			         Descripcion:<? echo $tema->getDescripcion() ?><br>
			     </td>
			</tr>
            </table>
            <br><br>

</div>

  </div>
  <div class="cierre_box_correo"></div>
</div>