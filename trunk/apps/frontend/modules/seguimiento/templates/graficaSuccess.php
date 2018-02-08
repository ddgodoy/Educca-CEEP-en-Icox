<?php use_helper('informacion'); ?>
<div id="divplanificacion">
<div class="tit_box_mensajes">

<?php if (isset($idcurso)) : ?>
  <?php $curso = CursoPeer::retrieveByPk($idcurso); ?>
  <h2 class="titbox"><?php echo $curso->getNombre(100) ?> : Seguimiento </h2></div>
<?php else : ?>
  <h2 class="titbox"> Seguimiento </h2></div>
<?php endif; ?>


<div class="cont_box_correo">
<?php if (isset($idtema)) : ?>
<?php $tema = TemaPeer::retrieveByPk($idtema);
   if ($tema) {echo "Tema ".$tema->getNumeroTema().": ".$tema->getNombre() ; } ?>
<?php endif; ?>

<?php if (isset($idsco12)) : ?>
<?php $sco = Sco12Peer::retrieveByPk($idsco12);
   if ($sco) {echo $sco->getTitle(); } ?>
<?php endif; ?>

<?php if (isset($idusuario)) : ?>
  <?php $usuario = UsuarioPeer::retrieveByPk($idusuario); ?>
  <?php echo $usuario->getNombre()." ".$usuario->getApellidos() ?>
<?php endif; ?>


<?php

use_helper('SwfChart','volver');

switch($tipo)
{
  case 'alumno':
          echo swf_chart("/seguimiento/source?datos=idusuario=$idusuario@tipo=$tipo@idcurso=$idcurso", 700, 600);
          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra el tiempo dedicado por el alumno <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> en la teor&iacute;a y en los ejercicios del curso");
          break;

  case 'tema':
          $numAlumnos = $curso->getNumeroAlumnos();
          echo swf_chart("/seguimiento/source?datos=idtema=$idtema@tipo=$tipo@idcurso=$idcurso", 700, ($numAlumnos*20)+15);

          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra el tiempo dedicado al tema <b>".$tema->getNombre()."</b> por parte de todos los alumnos del curso");
          break;

  case 'scorm1.2':
          $numAlumnos = $curso->getNumeroAlumnos();
          echo swf_chart("/seguimiento/source?datos=idsco12=$idsco12@tipo=$tipo@idcurso=$idcurso", 700, ($numAlumnos*20)+15);

          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra el tiempo dedicado al tema <b>".$sco->getTitle()."</b> por parte de todos los alumnos del curso");
          break;

  case 'hitos':
          echo swf_chart("/seguimiento/sourceHitos?idcurso=$idcurso", 700, 800);
          break;

  case 'dudas':
          echo swf_chart("/seguimiento/dudas?idcurso=$idcurso", 700, 420);
          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra el n&uacute;mero de dudas preguntadas por los alumnos en el curso <b>".$curso->getNombre()."</b>");
          break;

  case 'mensajes':
          echo "<table border='0'>";
          echo "<tr><td colspan='2'>";
          echo swf_chart("/seguimiento/numeroMensajes?idusuario=$idusuario", 700, 150);
          echo "</td></tr>";
          echo "<tr><td>";
          echo swf_chart("/seguimiento/mensajesTiempos?idusuario=$idusuario", 350, 350);
          echo "</td><td>";
          echo swf_chart("/seguimiento/mensajes?idusuario=$idusuario", 350, 350);
          echo "</td></tr></table>";
          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra el numero de mensajes que recibe el profesor, as&iacute como el porcentaje de mensajes contestados y el tiempo medio de respuesta");
          break;

  case 'alumnoVStareas':
          $usuario = UsuarioPeer::retrieveByPk($idusuario);
 	        $tareas = $usuario->getTareasCorregidas($idcurso);
          $numtareas = count($tareas);
           if ((($numtareas*20)+25)< 250)
          {
              echo swf_chart("/seguimiento/alumnoVStareas?datos=idcurso=$idcurso@idusuario=$idusuario", 700, 250);
          }else  echo swf_chart("/seguimiento/alumnoVStareas?datos=idcurso=$idcurso@idusuario=$idusuario", 700, ($numtareas*20)+25);
          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra las notas obtenidas por el alumno <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> en las tareas del curso");
          break;

  case 'tareaVSalumnos':
          $tarea = TareaPeer::retrieveByPk($idtarea);
          $ejercicio = EjercicioPeer::retrieveByPk($tarea->getIdEjercicio());

 	        $usuarios = $tarea->getEntregas($idcurso);
          $numAlumnos = count($usuarios);
          echo "Tarea:".$ejercicio->getTitulo()."<br>";
          if ((($numAlumnos*20)+25)< 250)
          {
              echo swf_chart("/seguimiento/tareaVSalumnos?datos=idcurso=$idcurso@idtarea=$idtarea", 700, 250);
          }else  echo swf_chart("/seguimiento/tareaVSalumnos?datos=idcurso=$idcurso@idtarea=$idtarea", 700, ($numAlumnos*20)+25);
          echoNotaInformativa('Ayuda', "Esta gr&aacute;fica le muestra las notas obtenidas por los alumnos que han entregado la tarea <b>".$ejercicio->getTitulo()."</b>");
          break;

  default:
    ;
} // switch



/*
if ($tipo=='alumno')
{
  echo swf_chart("/seguimiento/source?datos=idusuario=$idusuario@tipo=$tipo@idcurso=$idcurso", 700, 600);
  echoNotaInformativa('Ayuda', "Desde este gr&aacute;fica podrá observar el tiempo dedicado por el alumno <b>".$usuario->getApellidos().", ".$usuario->getNombre()."</b> en los temas que forman el curso");
} else { if ($tipo=='tema')
        {
           $numAlumnos = $curso->getNumeroAlumnos();
           echo swf_chart("/seguimiento/source?datos=idtema=$idtema@tipo=$tipo@idcurso=$idcurso", 700, ($numAlumnos*20)+15);

           echoNotaInformativa('Ayuda', "Desde este gr&aacute;fica podrá observar el tiempo dedicado al tema <b>".$tema->getNombre()."</b> por parte de todos los alumnos del curso");
         }
         else { if ($tipo=='hitos')
                {
                  echo swf_chart("/seguimiento/sourceHitos?idcurso=$idcurso", 700, 800);
                } else { if ($tipo=='dudas')
                         {
                           echo swf_chart("/seguimiento/dudas?idcurso=$idcurso", 700, 420);
                           echoNotaInformativa('Ayuda', "Desde este gr&aacute;ficas podrá observar el n&uacute;mero de dudas del <b>".$curso->getNombre()."</b>");
                         }else{ if ($tipo=='mensajes')
                                {  echo "<table border='0'>";
                                   echo "<tr><td colspan='2'>";
                                   echo swf_chart("/seguimiento/numeroMensajes?idusuario=$idusuario", 700, 150);
                                   echo "</td></tr>";
                                   echo "<tr><td>";
                                   echo swf_chart("/seguimiento/mensajesTiempos?idusuario=$idusuario", 350, 350);
                                   echo "</td><td>";
                                   echo swf_chart("/seguimiento/mensajes?idusuario=$idusuario", 350, 350);
                                   echo "</td></tr></table>";
                                   echoNotaInformativa('Ayuda', "Desde este gr&aacute;ficas podrá observar el numero de mensajes que recibe el profesor, as&iacute como el porcentaje de contestados y el tiempo medio de respuesta");
                                }
                                else{
                                    }
                              }
                        }
               }
       }
*/
?>

<br><?php use_helper('volver'); echo volver(); ?>
   </div>
    <div class="cierre_box_correo" ></div>
</div>
