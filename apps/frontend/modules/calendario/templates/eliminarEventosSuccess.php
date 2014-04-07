<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Eliminar Eventos</h2></div>
  <div class="cont_box_correo">
    <div class="nombrescole">
        <table class="teventos">
              <tr>
                <td class="td1">Curso</td>
                <td class="td2">Titulo</td>
                <td class="td3">Inicio</td>
                <td class="td4">Fin</td>
                <td class="td5">Destinatario</td>
                <td class="td7">Opciones</td>
              </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="teventos" cellspacing="0">
              <?php $i = 0; ?>
              <?php foreach($eventos as $evento): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td1"><?php echo $evento->getCurso()->getNombre() ?></td>
                      <td class="td2"><?php echo $evento->getTitulo() ?></td>
                      <td class="td3"><?php echo $evento->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td4"><?php echo $evento->getFechaFin($format = 'd/m/Y')?></td>
                      <td class="td5"><?php $estado = $evento->getPrivado();
                              switch($estado){
                               	case 0: echo "todos los alumnos";  break;
                               	case 1: $c = new criteria();
                               	        $c->add(Rel_usuario_eventoPeer::ID_EVENTO,$evento->getId());
                               	        $rel = Rel_usuario_eventoPeer::doSelectOne($c);
								        echo $rel->getUsuario()->getApellidos().", ".$rel->getUsuario()->getNombre();  break;
                               	default: 	;
                              }
                       ?></td>
                      <td class="td7"><?php if (isset($principal)) : ?>
					                             <?php echo link_to('Eliminar','calendario/eliminarEventoId?idevento='.$evento->getId().'&principal='.$principal,'confirm=&iquest;Esta seguro que desea eliminar el evento '.$evento->getTitulo().' ? id=ln_eliminar_evento'.$evento->getId()) ?>
                                      <?php else : ?>
									             <? echo link_to('Eliminar','calendario/eliminarEventoId?idevento='.$evento->getId().'&idcurso='.$idcurso,'confirm=&iquest;Esta seguro que desea eliminar el evento '.$evento->getTitulo().' ? id=ln_eliminar_evento'.$evento->getId()) ?>
									  <?php endif; ?>
					  </td>
                  </tr>
                  <?php $i++; ?>
              <?php endforeach; ?>
              <?php if ($i == 0) : ?>
                <tr>
                  <td class="tdnoaviso"><?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?> <span class="txtinfo">No hay eventos.</span></td>
                </tr>
              <?php endif; ?>
        </table>
    </div>
  </div>
  <div class="cierre_box_correo"></div>
</div>