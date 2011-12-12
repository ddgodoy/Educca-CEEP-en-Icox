<?php use_helper('Javascript','Validation') ?>
<?php use_helper('SexyButton') ?>

<?php if (!isset($mostrarForm)) : ?>
<div class="tit_box_calendario"><h2 class="titbox">Matricular usuario: <?echo $usuario->getNombre()." ".$usuario->getApellidos()?></h2></div>
<div class="cont_box_grande" style="padding-left: 20px;">
<br>
    <?php echo form_tag('admin/guardar',array('name' => 'miform' )) ?>
    <table class="tablanuevacita">

      <tr>
        <td class="titulo"><label for="">Rol:</label></td>
        <td><?echo select_tag('rol', options_for_select($opciones, 0),array('onchange' => 'cambiaOpcion()', 'name' => 'selectRol', 'style' => 'width: 130px;') )?></td>
      </tr>

      <tr>
        <td class="titulo"><label for="">Matricular en:</label></td>
        <td><?echo select_tag('tipo', options_for_select($opciones2, 0),array( 'name' => 'selectTipo', 'style' => 'width: 130px;' )  )?></td>
      </tr>
      <tr>
        <td></td>
        <td><br><?php echo sexy_button_to_function('Matricular', 'matricula()' ) ?></td>
      </tr>
     </table>
    </form>

    <!-- Capas AJAX -->
       <?php echo javascript_tag("
      function cambiaOpcion()
     { if (0==document.miform.selectRol.selectedIndex)
         { //alumno
           document.miform.selectTipo.options[1]=new Option('Modulo','modulo');
           document.miform.selectTipo.length=2;
         }
        else  document.miform.selectTipo.length=1;
     }

     function matricula()
     {//alert('matricula');
      if (0==document.miform.selectRol.selectedIndex)
       { //alumno
         if (0==document.miform.selectTipo.selectedIndex)
            { //curso
              window.location='".url_for('/admin/aniadirCurso?idusuario='.$usuario->getId().'&rol=alumno')."';
            }
         else {//modulo
               window.location='".url_for('/admin/aniadirModulo?idusuario='.$usuario->getId().'&rol=alumno')."';
               }

       }
     else{ //window.redirect('admin/aniadirCurso?idusuario='+document.miform.id.value+'&rol=profesor')
           //alert('admin/aniadirCurso?idusuario='+document.miform.usuario.value+'&rol=profesor');
          window.location='".url_for('/admin/aniadirCurso?idusuario='.$usuario->getId().'&rol=profesor')."';
          }
     }
") ?>
<br><? use_helper('volver');  echo volver(); ?>
</div>



<div class="cierre_box_grande"></div>
<? else : ?>
<br><br>
<?php echo image_tag('ico_p_endok.gif'); ?> Curso Guardado

<?php echo link_to('Volver', 'admin/cursos') ?>
<? endif; ?>
