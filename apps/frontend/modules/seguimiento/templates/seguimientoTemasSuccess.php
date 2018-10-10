<?php use_helper('SexyButton') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Planificar el estudio de la teor&iacute;a del <?php echo $curso->getnombre() ?> </h2></div>
  <div class="cont_box_correo">


    <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">Curso:</td>
                <td><?php echo $curso->getnombre(90) ?></td>
              </tr>

              <tr>
                <td class="titulo">Numero Temas:</td>
                <td><?php echo $curso->getMateria()->countTemas()?></td>
              </tr>

               <tr>
                <td class="titulo"> Fecha Inicio:</td>
                <td><?php echo $curso->getFechaInicio("d-m-Y") ?></td>
              </tr>

               <tr>
                <td class="titulo">Fecha Fin:</td>
                <td><?php echo $curso->getFechaFin("d-m-Y") ?></td>
              </tr>
            </table>
        </div>
      </div>

<div id="divadmin">
      <div class="nombrescol">
        <table class="tadmincursos">
              <tr>
                <td style="width: 350px;">Tema</td>
                <td style="width: 150px;">Fecha Finalizaci&oacute;n</td>
                <td>Opciones</td>

              </tr>
        </table>
      </div>

    <div class="cursos">
        <table class="tadmincursos" cellspacing="0">
              <?php $i = 0; ?>
              <?php foreach($temas as $tema): ?>
                  <?php $fondo1 = (($i % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                  <tr class="cont_fil" <?= $fondo1 ?>>
                      <td style="width: 350px;"><?php echo $tema->getNumeroTema().'. '.$tema->getNombre(); ?></td>
                      <td style="width: 150px;"><?php $c1 = new Criteria();
						                    $c1->add(Rel_curso_temaPeer::ID_CURSO, $curso->getId() );
                                            $c1->add(Rel_curso_temaPeer::ID_TEMA, $tema->getId() );
                                            $rel = Rel_curso_temaPeer::doSelectOne($c1);?>
                                            <?php if ($rel) : ?>
                                                   <?php echo $rel->getFechaCompletado("d/m/Y") ?>
                                            <?php else : ?>
                                                   Sin fecha asignada
											<?php endif; ?>
										</td>
					<td><?php echo link_to('Modificar fecha', 'seguimiento/modificarFechaTema?idtema='.$tema->getId().'&idcurso='.$idcurso) ?></td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; ?>
        </table>
    </div>
</div>
  </div>
  <div class="cierre_box_correo"></div>
</div>
