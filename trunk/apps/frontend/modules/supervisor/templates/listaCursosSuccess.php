<?php use_helper('SexyButton') ?>
<div id="divadmin">
  <div class="tit_box_mensajes"><h2 class="titbox">Lista de cursos para el <?echo $rol." ".$usuario->getNombre()." ".$usuario->getApellidos()?> </h2></div>
  <div class="cont_box_correo">
    <div class="herramientas">

    </div>

    <div class="nombrescol">
           <table>
		   <tr>
		   <td>      <?php echo $rol?>: <? echo link_to($usuario->getNombre()." ".$usuario->getApellidos(), 'usuario/mostrarPerfil?idusuario='.$usuario->getId()) ?><br>
			     </td>
			  </tr>
            </table>
            <br><br>
        <table class="tadmincursos" border='0'>
              <tr>
                <td class="td7">Nombre</td>
                <td class="td8">Inicio</td>
                <td class="td8">Fin</td>
                <td class="td9">Temas</td>
                <td class="td10">Modulo</td>
                <td class="td11">Opciones</td>

                      </tr>
        </table>
    </div>
    <div class="cursos">
        <table class="tadmincursos" cellspacing="0" border='0'>
              <?php $i = 0; ?>
              <?php foreach($cursos as $curso): ?>

                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td class="td12"><?php echo link_to($curso->getCurso()->getNombre(), 'supervisor/fichaCurso?idcurso='.$curso->getCurso()->getId()) ?></td>
                      <td class="td13"><?php echo $curso->getCurso()->getFechaInicio($format = 'd/m/Y') ?></td>
                      <td class="td14"><?php echo $curso->getCurso()->getFechaFin($format = 'd/m/Y') ?></td>
                      <td class="td15"><?php echo $curso->getCurso()->getMateria()->countTemas()  ?></td>
                      <td class="td16"><?php $rels = $curso->getCurso()->getModulo($usuario->getId())?>
					  				  <?php if ($rels) : ?>
   	       									<?php foreach ($rels as $rel) :?>
													<?php echo $rel->getPaquete()->getNombre() ?>
											 <? endforeach; ?>
									  <? endif; ?>
					 <td class="td17">
					                 <?php if ('alumno'==$rol) : ?>
					                 <?php echo link_to('Tiempos','seguimiento/grafica?idusuario='.$usuario->getId().'&tipo=alumno&idcurso='.$curso->getCurso()->getId()) ?>
					                 <? endif; ?>
                     </td>


					  </td>
					  <td>
					  </td>
                  </tr>
                  <?php $i++ ?>

              <?php endforeach; ?>
        </table>
    </div>
    <br>
    <?php use_helper('informacion') ?>
   <?echoNotaInformativa('Ayuda', 'Desde este panel podr&aacute; acceder a la informci&oacute;n de los cursos matriculados por el alumno')?>

  </div>
  <div class="cierre_box_correo"></div>
</div>