<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Lista de cursos para el <?echo $rol." ".$usuario->getNombre()." ".$usuario->getApellidos()?> </h2></div>
  <div class="cont_box_correo">
    <div class="herramientas"style="border-bottom: none;">
       <table cellpadding="0" cellspacing="0">
         <tr>
           <td><?php echo sexy_button_to('Nuevo curso','admin/aniadirCurso?idusuario='.$usuario->getId().'&rol='.$rol) ?></td>
         </tr>
       </table>

    </div>
       <div style="border-top: #CCCCCC 1px solid" class="nombrescol" style="width: 100%;">
        <table class="tadmincursos" border='0'>
              <tr>
                <td class="td5">Nombre</td>
                <td class="td3">Inicio</td>
                <td class="td3">Fin</td>
                <td class="td3">N&ordm; temas</td>
                <td class="td5">Modulo</td>
                <td class="td3">Estado</td>
                <td class="td3">Opciones</td>

                      </tr>
        </table>
       </div>
    <div class="cursos">
        <table class="tadmincursos" cellspacing="0" border='0'>
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>

                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td5"  style="padding-left: 2px;"><?php echo link_to($curso->getCurso()->getNombre(), 'admin/fichaCurso?idcurso='.$curso->getCurso()->getId()) ?></td>
                      <td class="td3"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td3" style=""><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td3"><center><?php echo $curso->getCurso()->getMateria()->getNumeroTemas()  ?></center></td>
                      <td class="td5"><?php $rels = $curso->getCurso()->getModulo($usuario->getId())?>
					  				  <?php if ($rels) : ?>
   	       									<?php foreach ($rels as $rel) :?>
													<?php echo $rel->getPaquete()->getNombre() ?>
											 <? endforeach; ?>
									  <? endif; ?>

					  </td>
					   <td class="td3"><?php if (!$rels) : ?>
					           <? if ($rol=="alumno") : ?>
					            <? if ($curso->getCurso()->esMoroso($usuario->getId())) : ?>
                                           MOROSO
                      				  <? else : ?>
                      				      ACTIVO
                      				  <? endif; ?>
                      			<? endif; ?>
						   <? endif; ?>
					  </td>

					  <td class="td3"><?php if (!$rels) : ?>
					           <? if ($rol=="alumno") : ?>
					            <? if ($curso->getCurso()->esMoroso($usuario->getId())) : ?>
                                           <?php echo link_to('Reanudar','admin/moroso?idusuario='.$usuario->getId().'&idcurso='.$curso->getCurso()->getId().'&moroso=no','confirm=&iquest;Esta seguro que desea reanudar al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?> |
                      				  <? else : ?>
                      				      <?php echo link_to('Suspender','admin/moroso?idusuario='.$usuario->getId().'&idcurso='.$curso->getCurso()->getId().'&moroso=si','confirm=&iquest;Esta seguro que desea marcar como moroso al usuario '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getCurso()->getNombre().' ?') ?> |
                      				  <? endif; ?>
                      			<? endif; ?>
					            <? echo link_to('Eliminar','admin/eliminarCursoUsuario?idusuario='.$usuario->getId().'&rol='.$rol.'&idcurso='.$curso->getCurso()->getId(),'confirm=&iquest;Esta seguro que desea eliminar el '.$curso->getCurso()->getNombre().' ?') ?>
						   <? endif; ?>
					  </td>
                  </tr>
                  <?php $i++; ?>

              <?php endforeach; ?>
        </table>
    </div>
    <?php use_helper('informacion'); ?>
    <br>
    <? echoNotaInformativa('Ayuda', "Desde este panel tendr&aacute; acceso a la lista de cursos matriculados por el usuario <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> y tendr&aacute; la posibilidad de baja al usuario del curso como limitarle el acceso temporalmente hasta que realize los pagos."); ?>
    <br>
    <? echoWarning('Aviso', "Si selecciona 'suspender' en alg&uacute;n curso al usuario <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> dejar&aacute; de tener acceso al curso hasta que lo vuelva 'reanudar'"); ?>
    <br>
    <? echoWarning('Aviso', "Solo podr&aacute 'suspender' en los cursos que no pertenezcan a ning&uacute;n m&oacute;dulo"); ?>
    <br><? use_helper('volver');  echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>
