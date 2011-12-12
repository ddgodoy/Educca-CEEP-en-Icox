<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Editor de Ejercicios</h2></div>
  <div class="contenido_principal">
      <table class="tablaopciones">


        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_crear.gif'), "/ejercicio/crearEjercicio$redireccion",array('id'=>'ln_crear_ejercicio_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Crear un ejercicio', "/ejercicio/crearEjercicio$redireccion",array('id'=>'ln_crear_ejercicio_texto')) ?></div>
            <div class="explicacion">Permite crear nuevos ejercicios para las materias que usted imparte. Deber&aacute; elegir el tipo de ejercicio que desea crear: cuestionario, test o problemas.  </div>
          </td>
        </tr>
        <tr>
           <td colspan="2" class="separador">
           </td>
        </tr>
        <tr>
          <td class="imagen">
            <?php echo link_to(image_tag('bot_ej_editar.gif'), "/ejercicio/ejercicios$redireccion",array('id'=>'ln_editar_ejercicio_ico')) ?>
          </td>
          <td class="explica">
            <div class="titulo"><?php echo link_to('Edici&oacute;n de ejercicios', "/ejercicio/ejercicios$redireccion",array('id'=>'ln_editar_ejercicio_texto')) ?></div>
            <div class="explicacion">Le muestra un listado de sus ejercicios clasificados por materias. Tambi&eacute;n podr&aacute; visualizar y modificar el contenido de dichos ejercicios y sus soluciones y publicarlos en el repositorio de ejercicios de la materia correspondiente para que los alumnos tengan acceso a ellos.</div>
          </td>
        </tr>


      </table>
  </div>
  <div class="cierre_principal"></div>
</div>
