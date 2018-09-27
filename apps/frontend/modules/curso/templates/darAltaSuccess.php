<div class="comment">
  <br><br>
  <?php foreach($errores as $error) : ?>
     <?php echo $error."<br>" ; ?>
  <?php endforeach; ?>
  <br><br>
  <?php foreach($cursos as $curso) : ?>
     <?php echo "Dado de alta en el curso ".$curso."<br>" ; ?>
  <?php endforeach; ?>
</div>
