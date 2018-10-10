
<br>
<br>
<br>
<br>
<?php echo  form_tag( 'chat/jquery') ?>
Seleccione la sala de Chat:
<?php echo select_tag('id', options_for_select($opciones, 0)) ?>
<?php echo submit_tag('Entrar') ?>
</form>