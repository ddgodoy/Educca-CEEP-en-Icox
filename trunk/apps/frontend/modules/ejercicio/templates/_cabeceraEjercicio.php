<br>
<div>
  <table style="text-align: left;">
    <?php if (($modo == 'mostrar') || ($modo == 'tarea') || ($modo == 'examen')):?>
      <tr>
        <td>Autor del ejercicio: &nbsp;&nbsp;&nbsp;</td>
        <td>
          <?php
            if ($ejercicio->getIdAutor())
            {
              $profesor = UsuarioPeer::RetrieveByPk($ejercicio->getIdAutor());
              echo $profesor->getApellidos().', '.$profesor->getNombre();
            }
            else
            {
              echo $ejercicio->getNombreAutor();
            }
          ?>
        </td>
      </tr>
    <?php endif;?>

    <?php if ($modo == 'evaluacion'):?>
      <tr>
        <td><strong>Nombre del alumno: &nbsp;&nbsp;&nbsp;</strong></td>
        <td><strong><?php echo $nombre_alumno ?></strong></td>
      </tr>

      <tr>
        <td><strong>Nota obtenida: &nbsp;&nbsp;&nbsp;</strong></td>
        <td class='nota'><?php echo $nota ?></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    <?php endif; ?>

    <tr>
      <td>Materia: &nbsp;&nbsp;&nbsp;</td>
      <td><?php $materia = MateriaPeer::RetrieveByPk($ejercicio->getIdMateria()); echo($materia->getNombre());?></td>
    </tr>

    <tr>
      <td>Tipo de ejercicio: &nbsp;&nbsp;&nbsp;</td>
      <td class='tipo'><?php echo $ejercicio->getTipo() ?></td>
    </tr>

    <?php if ($ejercicio->getTipo() == 'test'):?>
    <tr>
      <td>Las respuestas incorrectas en el test restan puntos: &nbsp;&nbsp;&nbsp;</td>
      <td>
        <?php if ($ejercicio->getTestResta()):?>
          S&iacute;
        <?php else: ?>
          No
         <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td>Es posible marcar m&aacute;s de una respuesta en el test: &nbsp;&nbsp;&nbsp;</td>
      <td>
        <?php if ($ejercicio->getTestMultiple()):?>
          S&iacute;
        <?php else: ?>
          No
         <?php endif; ?>
      </td>
    </tr>
    <?php endif; ?>


    <?php if ($ejercicio->getTipo() == 'problemas'):?>
    <tr>
      <td>N&uacute;mero m&aacute;ximo de hojas de respuesta: &nbsp;&nbsp;&nbsp;</td>
      <td>
        <?php echo ($ejercicio->getNumeroHojas());?>
      </td>
    </tr>
    <?php endif; ?>


    <?php if (($rol == 'profesor') && ($modo == 'mostrar')):?>
      <tr>
        <td>Est&aacute; habilitado el uso de expresiones matem&aacute;ticas: &nbsp;&nbsp;&nbsp;</td>
        <td>
          <?php if($ejercicio->getExpresionesMatematicas()):?>
            S&iacute;
          <?php else:?>
            No
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td>Publicado en repositorio: &nbsp;&nbsp;&nbsp;</td>
        <td>
          <?php if($ejercicio->getPublicado()):?>
            S&iacute;
          <?php else:?>
            No
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td>Los alumnos pueden ver la soluci&oacute;n del ejercicio: &nbsp;&nbsp;&nbsp;</td>
        <td>
          <?php if($ejercicio->getSolucion()):?>
            S&iacute;
          <?php else:?>
            No
          <?php endif;?>
        </td>
      </tr>
    <?php endif;?>

    <?php if ($modo == 'tarea'):?>
      <tr>
        <td>Estado de la tarea: &nbsp;&nbsp;&nbsp;</td>
        <? if (isset($tarea))  : ?>
           <td class='estado<?echo $tarea->getId()?>'><?php echo $estado_tarea ?></td>
        <? else : ?>
           <td class='estado'><?php echo $estado_tarea ?></td>
        <? endif; ?>
      </tr>
      <?php if ($estado_tarea == 'Entregada'):?>
        <tr>
          <td><strong>Nota obtenida: &nbsp;&nbsp;&nbsp;</strong></td>
          <td><?php echo $nota ?></td>
        </tr>
      <?php endif;?>
    <?php endif;?>

  </table>
</div>
