<?php if ($mostrar):?>

<input type="hidden" id="es_envio" value="1">

  <?php use_helper('Javascript') ?>
  <?php use_helper('Text') ?>
  <div id="lista_usuarios2">
  &nbsp;<a class="claveolvidada" href="javascript:void(0)" onclick="checkTodos()">Todos</a> &nbsp;/&nbsp; <a class="claveolvidada" href="javascript:void(0)" onclick="checkNinguno()">Ninguno</a><br><br>
    <table class="tabladest" cellspacing="0">

      <?php $i = 0; ?>
        <?php $max_length = 33; ?>
        <?php foreach ($profesores as $profesor) : ?>
          <tr class="trprofesor">
            <td class="tdcheck">
              <?php echo checkbox_tag("usuario$i", $profesor->getId()); ?>
            </td>
            <td class="tdnombredest">
              <?php echo image_tag('profesor.png','Title=Profesor class=ico_profesor'); ?>
              <?php 
              $nombre = $profesor->getNombre();
              $length_nombre = strlen($nombre);
              if (($length_nombre + 2) < $max_length)
              {
                $pendientes = $max_length - $length_nombre - 2;
                $apellidos = truncate_text($profesor->getApellidos(), $pendientes);
                $nombre_final = $apellidos.', '.$nombre;
              }
              else
              {
                $nombre_final = truncate_text($nombre, $max_length);
              }
              echo $nombre_final
            ?>
            </td>
          </tr>
        <?php $i++; ?>
      <?php endforeach; ?>

      <?php foreach($alumnos as $alumno) : ?>
        <tr class="tralumno">
          <td class="tdcheck">
            <?php echo checkbox_tag("usuario$i", $alumno->getId()); ?>
          </td>
          <td class="tdnombredest">
            <?php 
              $nombre = $alumno->getNombre();
              $length_nombre = strlen($nombre);
              if (($length_nombre + 2) < $max_length)
              {
                $pendientes = $max_length - $length_nombre - 2;
                $apellidos = truncate_text($alumno->getApellidos(), $pendientes);
                $nombre_final = $apellidos.', '.$nombre;
              }
              else
              {
                $nombre_final = truncate_text($nombre, $max_length);
              }
              echo $nombre_final
            ?>
          </td>
        </tr>
        <?php $i++; ?>
      <?php endforeach; ?>

    <?php echo (input_hidden_tag('numero_destinatarios', $i)); ?>
    </table>
  </div>

<?php else:?>

&nbsp;Elige curso y asunto

<?php endif; ?>
