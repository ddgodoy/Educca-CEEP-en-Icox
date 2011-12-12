<? echo image_tag('ico_p_endok.gif','Alt= '); ?> Guardado
<?php use_helper('Javascript','javascriptAjax') ?>
<? if (isset($principal)) : ?>
    <?php echo cargaPagina('calendario/mostrarCalendario',"principal=1") ?>
<? else : ?>
    <?php echo cargaPagina('calendario/mostrarCalendario',"idcurso=".$sf_user->getCursoMenu()) ?>
<? endif; ?>