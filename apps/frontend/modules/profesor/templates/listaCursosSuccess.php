<div id="mis_cursos">
 <h3>Mis cursos</h3>
  <table>
      <?php foreach($cursos as $curso): ?>
      <tr>
        <td><?php echo link_to($curso->getIdCurso(), 'curso/show?idcurso='.$curso->getIdCurso()) ?></td>
        <td><?php echo link_to($curso->getCurso()->getNombre(), 'alumno/mostrarTemas?id='.$curso->getIdCurso()) ?></td>
      </tr>
      <?php endforeach; ?>
  </table>
</div>
