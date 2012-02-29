<?
require_once(dirname(__FILE__).'/../../bootstrap/functional.php');
require_once(dirname(__FILE__).'/../../lib/sfMyTestBrowser.class.php');

require_once(dirname(__FILE__).'/../../lib/adminTest.class.php');
require_once(dirname(__FILE__).'/../../lib/profesorTest.class.php');
require_once(dirname(__FILE__).'/../../lib/alumnoTest.class.php');
require_once(dirname(__FILE__).'/../../lib/supervisorTest.class.php');

// create a new test browser
$browser = new sfMyTestBrowser();

$admin_nombreusuario = "admin";
$admin_password = "4dm1n";

$usuario_password = "pwdtest";

$nombre_materias = 'materia_test_';
$nombre_curso = 'curso_test_';
$nombre_modulo = 'modulo_test_';
$nombre_usuario = 'usuario_test_';


$t = new lime_test();
$browser->initialize();

$adminTest = new adminTest($browser, $t, $admin_nombreusuario, $admin_password);
$adminTest->inicializacion($nombre_materias,$nombre_curso,$nombre_modulo,$nombre_usuario);

//login
$t->diag('*********************************************************************');
$t->diag('                         ADMINISTRACION TEST                         ');
$t->diag('*********************************************************************');

$adminTest->loggin();

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                           Test de menu administrador');
$t->diag('-------------------------------------------------------------------');

$adminTest->checkMenu();

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                           Test de siteMap administrador');
$t->diag('-------------------------------------------------------------------');

$adminTest->checkSiteMap();

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                            Crear Materias ');
$t->diag('-------------------------------------------------------------------');

$materia = $adminTest->crearMateria($nombre_materias);
$adminTest->eliminarMateria($materia);

$materias = array();
for($i=1;$i<=2;$i++)
{
  $materias[$i] = $adminTest->crearMateria($nombre_materias.$i);
}

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                 Importar ejercicios a materia 1'         );
$t->diag('-------------------------------------------------------------------');

$ejercicio = $adminTest->importarEjercicios($materias[1]);

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                 Exportar ejercicios de materia 1'         );
$t->diag('-------------------------------------------------------------------');

$adminTest->exportarEjercicios($ejercicio);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Eliminar ejercicios a materia 1'         );
$t->diag('-------------------------------------------------------------------');

$adminTest->eliminarEjercicio($ejercicio);


$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag("                            Crear Cursos");
$t->diag('-------------------------------------------------------------------');

$curso = $adminTest->crearCurso($materias[1]);
$adminTest->eliminarCurso($curso);

$cursos = array();
for($i=1;$i<=2;$i++)
{
  $cursos[$i] = $adminTest->crearCurso($materias[$i],$nombre_curso.$i);
}

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag("                           Crear Modulos");
$t->diag('-------------------------------------------------------------------');
$t->diag('');

$modulo = $adminTest->crearModulo($cursos,$nombre_modulo);
$adminTest->eliminarModulo($modulo);

$modulo = $adminTest->crearModulo($cursos,$nombre_modulo);

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag("                          Crear Super Usuarios");
$t->diag('-------------------------------------------------------------------');


$supervisor = $adminTest->crearSupervisor($nombre_usuario.'super');
$adminTest->eliminarSuperUsuario($supervisor);

$supervisor = $adminTest->crearSupervisor($nombre_usuario.'super');
$supervisor->setPassword($usuario_password);

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag("                          Crear Usuarios");
$t->diag('-------------------------------------------------------------------');

$usuario = $adminTest->matricularCurso($nombre_usuario.'0',$cursos[1],count($cursos),'alumno');
$adminTest->eliminarUsuario($usuario,'alumno');

$profesores = array();
for($i=1;$i<=2;$i++)
{
  $profesores[$i] = $adminTest->matricularCurso($nombre_usuario.$i,$cursos[$i],count($cursos),'profesor');
  $profesores[$i]->setPassword($usuario_password);
}

$alumnos = array();
$k=2;
for($i=1;$i<=$k;$i++)
{ $j = $i + $k; //para nombre de usuario distintos
  $alumnos[$i] = $adminTest->matricularCurso($nombre_usuario.$j,$cursos[$i],count($cursos),'alumno');
  $alumnos[$i]->setPassword($usuario_password);
}

$j_alum= ($k * 2) + 1;
$alumnos[$j_alum] = $adminTest->matricularModulo($nombre_usuario.$j_alum,$modulo,1);
$alumnos[$j_alum]->setPassword($usuario_password);

$alumnos_curso1 = array($alumnos[$j_alum],$alumnos[1]);
$alumnos_modulo = array($alumnos[$j_alum]);

$j_alum2 = $j_alum+1;
$alumnos[$k+1] = $adminTest->matricularCurso($nombre_usuario.$j_alum2,$cursos[2],count($cursos),'alumno');
$alumnos[$k+1]->setPassword($usuario_password);

$alumnos_curso2 = array($alumnos[$k+1]);

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag("                           logout admin");
$t->diag('-------------------------------------------------------------------');

$adminTest->logout();

$t->diag('*********************************************************************');
$t->diag('                         PROFESOR   TEST                         ');
$t->diag('*********************************************************************');

$profesorTest = new profesorTest($browser, $t, $profesores[1], $usuario_password);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando enlaces profesor              ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin();
$profesorTest->checkMenu();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando Mis cursos profesor           ');
$t->diag('-------------------------------------------------------------------');
$profesorTest->checkMenuMisCursos($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando Temario curso0           ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->checkTemario($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('            Biblioteca de archivos Temario curso0  Profesor        ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->checkBibliotecaArchivos($cursos[1]);


$archivo=$profesorTest->subirBibliotecaArchivos($cursos[1],true,true);
$profesorTest->modificarBibliotecaArchivos($archivo);
$profesorTest->borrarBibliotecaArchivos($archivo);

$archivo=$profesorTest->subirBibliotecaArchivos($cursos[1]);
$profesorTest->logout();

$t->diag('-------------------------------------------------------------------');
$t->diag('            Biblioteca de archivos Temario curso0  Alumno        ');
$t->diag('-------------------------------------------------------------------');

$alumnoTest = new alumnoTest($browser, $t, $alumnos_curso1[1], $usuario_password);
$alumnoTest->loggin(false,false); 
$alumnoTest->checkBibliotecaArchivos($archivo);
$alumnoTest->checkListarBibliotecaArchivosNoPermitida($cursos[2]);
$alumnoTest->logout();

$alumnoTest = new alumnoTest($browser, $t, $alumnos[$k+1], $usuario_password);
$alumnoTest->loggin(true,false); 
$alumnoTest->checkDownloadBibliotecaArchivosNoPermitida($archivo);
$alumnoTest->logout();

$profesorTest->loggin(false);


$t->diag('-------------------------------------------------------------------');
$t->diag('         Modificar informacion general del curso por profesor   ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->modificarInfoCurso($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Modificar Bibliografia           ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->modificarBiblio($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Seguimiento profesor           ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->checkMenuSeguimiento($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Eventos profesor           ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkMenuEventos($cursos[1]);

$evento = $profesorTest->nuevoEvento($cursos[1]);
$profesorTest->logout();

$t->diag('');
$t->diag('                Checkear que los alumnos tienen el evento           ');
$t->diag('');

foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  $alumnoTest->checkEvento($evento);
  $alumnoTest->logout();
}

$profesorTest->loggin(false);
// */
$t->diag('-------------------------------------------------------------------');
$t->diag('                     Configuar Eventos profesor           ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->configurarEventos($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                     Eliminar Evento           ');
$t->diag('-------------------------------------------------------------------');
// /*
$profesorTest->eliminarEvento($evento);
$profesorTest->logout();

$t->diag('');
$t->diag('                Checkear que los alumnos NO tienen el evento       ');
$t->diag('');

foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  $alumnoTest->NoTieneEventos($cursos[1]);
  $alumnoTest->logout();
}

$profesorTest->loggin(false);
// */
$t->diag('-------------------------------------------------------------------');
$t->diag('              Editar perfil(campos, password, imagen)   ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->editarPerfil();

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando mensajeria                      ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkMenuCorreo();
$msj = $profesorTest->redactarMensaje($cursos[1],$alumnos_curso1); //alumnos del mismo curso
$profesorTest->logout();

$alumnoTest = new alumnoTest($browser, $t, $alumnos[$j_alum], $usuario_password);
$alumnoTest->loggin(false);
$alumnoTest->MensajeRecibidos($cursos[1],$msj);
$alumnoTest->logout();

$alumnoTest = new alumnoTest($browser, $t, $alumnos[1], $usuario_password);
$alumnoTest->loggin(false);
$msj = $alumnoTest->MensajeRecibidos($cursos[1],$msj);
$alumnoTest->eliminarMensaje($msj);
$alumnoTest->recuperarMensaje($msj);
$alumnoTest->eliminarMensaje2($msj);  //checkbox
$alumnoTest->recuperarMensaje2($msj); //checkbox
$alumnoTest->eliminarMensaje($msj);
$alumnoTest->eliminarMensajePapelera($msj);

$alumnoTest->logout();
$profesorTest->loggin(false);
// */
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando foro                       ');
$t->diag('-------------------------------------------------------------------');
///*
$post = $profesorTest->nuevoTemaForo($cursos[1],'Post_prueba_foro');

$profesorTest->logout();
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  $alumnoTest->checkForo($cursos[1],$post,'Post_prueba_foro','msj_prueba_foro');
  $alumnoTest->logout();
}

$profesorTest->loggin(false);
$profesorTest->eliminarPostForo($post);
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  $alumnoTest->checkNoPostForo($cursos[1],'Post_prueba_foro');
  $alumnoTest->logout();
}
$profesorTest->loggin(false);
// */

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Editor Ejercicios                       ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkMenuEjercicios($cursos[1]);
$cuestion = $profesorTest->editarEjercicio($cursos[1],'cuestionario','ejercicio_cuestionario_test');
$profesorTest->eliminarEjercicio($cuestion->getEjercicio(),$cursos[1]);

$cuestion = $profesorTest->editarEjercicio($cursos[1],'cuestionario','ejercicio_cuestionario_test');
$profesorTest->editarSolucionCuestionario($cuestion);
$profesorTest->publicarEjercicio($cursos[1],$cuestion->getEjercicio());
$profesorTest->publicarSolucion($cursos[1],$cuestion->getEjercicio());

//$test = $profesorTest->editarEjercicio($cursos[1],'test','ejercicio_test_test',4,1,1,1); //con editor matematico
$test = $profesorTest->editarEjercicio($cursos[1],'test','ejercicio_test_test',4,1,1,0); //local sin editor matematico
$profesorTest->publicarEjercicio($cursos[1],$test->getEjercicio());
$profesorTest->publicarSolucion($cursos[1],$test->getEjercicio());

//$problema = $profesorTest->editarEjercicio($cursos[1],'problemas','ejercicio_problema_test',4,1,1,1);//con editor matematico
$problema = $profesorTest->editarEjercicio($cursos[1],'problemas','ejercicio_problema_test',4,1,1,0);  //local sin editor matematico
$profesorTest->editarSolucionProblema($problema);
$profesorTest->publicarEjercicio($cursos[1],$problema->getEjercicio());
$profesorTest->publicarSolucion($cursos[1],$problema->getEjercicio());
$profesorTest->despublicarSolucion($cursos[1],$problema->getEjercicio());
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Poner Tareas                       ');
$t->diag('-------------------------------------------------------------------');
///*
//tarea vacia
$tarea=$profesorTest->ponerTarea($cursos[1],$cuestion->getEjercicio());
$profesorTest->cancelarTarea($tarea);

$tareas = array();
$tareas[0]=$profesorTest->ponerTarea($cursos[1],$cuestion->getEjercicio());
$tareas[1]=$profesorTest->ponerTarea($cursos[1],$test->getEjercicio(),'Tarea','Opcional');
$tareas[2]=$profesorTest->ponerTarea($cursos[1],$problema->getEjercicio());
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Estado Tareas  (no entregada)                     ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkEstadoTarea($tareas,$alumnos_curso1,'no intentado');
$profesorTest->logout();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('              Chekear Tareas  resolver tareas       ');
$t->diag('-------------------------------------------------------------------');
///*
$array_resueltos = array();
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);

  foreach ($tareas as $tarea)
  {
//   $alumnoTest->checkEvento($tarea->getEvento(),false);
   $resueltos["".$alum->getId().""]["".$tarea->getId().""] = $alumnoTest->resolverTarea($tarea);
  }
  $alumnoTest->logout();
}
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                 Estado Tareas  (en desarrollo)                     ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);
$profesorTest->checkEstadoTarea($tareas,$alumnos_curso1,'en desarrollo');
$profesorTest->logout();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                        Entregar tareas       ');
$t->diag('-------------------------------------------------------------------');
///*
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  foreach ($tareas as $tarea)
  {
   $alumnoTest->entregarTarea($resueltos["".$alum->getId().""]["".$tarea->getId().""]);
   $resuelto = $alumnoTest->prohibidoResolverTarea($tarea); //ya la ha entregado
  }
  $alumnoTest->logout();
}
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                 Estado Tareas  (entregado)                     ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);
$profesorTest->checkEstadoTarea($tareas,$alumnos_curso1,'entregado');
$profesorTest->logout();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         corregir Tareas                       ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);
foreach ($tareas as $tarea)
{
    $profesorTest->corregirTarea($tarea);
}
$profesorTest->logout();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         reclamar Tareas                       ');
$t->diag('-------------------------------------------------------------------');
///*
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  foreach ($tareas as $tarea)
  {
   $alumnoTest->reclamarTarea($tarea);
  }
  $alumnoTest->logout();
}
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         corregir reclamaciones                       ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);

$notificaciones = $profesorTest->verReclamaciones();
foreach ($tareas as $tarea)
{
    if ('test'!=$tarea->getEjercicio()->getTipo())
    {
    $profesorTest->corregirTarea($tarea,true); //revisar
    }
}
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                    borrar notificacion de reclamaciones       ');
$t->diag('-------------------------------------------------------------------');
///*
foreach ($notificaciones as $notificacion)
{
  $profesorTest->borrarNotificacion($notificacion);
}
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Poner Examen Cuestionario                 ');
$t->diag('-------------------------------------------------------------------');
///*
$tareas_examenes = array();
$profesorTest->loggin(false);

$cuestion_exam = $profesorTest->editarEjercicio($cursos[1],'cuestionario','examen_cuestionario_test');
$profesorTest->editarSolucionCuestionario($cuestion_exam);

$tareas_examenes['cuestion_exam'] = $profesorTest->ponerTarea($cursos[1],$cuestion_exam->getEjercicio(),'Examen','Obligatorio',0,60);


$t->diag('-------------------------------------------------------------------');
$t->diag('        Estado Examen Cuestionario  (no entregada)                  ');
$t->diag('-------------------------------------------------------------------');
// /*
$profesorTest->checkEstadoTarea($tareas_examenes,$alumnos_curso1,'en desarrollo'); //el examen esta en desarrollo x q la fecha de comienzo del examen es mayor a la actual
$profesorTest->logout();
// */
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Resolver Examen Cuestionario              ');
$t->diag('-------------------------------------------------------------------');
///*
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false,true); //loggin para examen
  $resuelto = $alumnoTest->resolverExamen($tareas_examenes['cuestion_exam']);
  $alumnoTest->entregarExamen($resuelto);
}
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Poner Examen Test                 ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);

//$test_exam = $profesorTest->editarEjercicio($cursos[1],'test','examen_test_test',4,1,1,1); //con editor matematico
$test_exam = $profesorTest->editarEjercicio($cursos[1],'test','examen_test_test',4,1,1,0); //local sin editor matematico
$tareas_examenes['test_exam']=$profesorTest->ponerTarea($cursos[1],$test_exam->getEjercicio(),'Examen','Obligatorio',0,60);

$t->diag('-------------------------------------------------------------------');
$t->diag('                Estado Examen Test (no entregada)                  ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkEstadoTarea(array($tareas_examenes['test_exam']),$alumnos_curso1,'en desarrollo');
$profesorTest->logout();
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Resolver Examen Test              ');
$t->diag('-------------------------------------------------------------------');
///*
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false,true); //loggin para examen
  $resuelto = $alumnoTest->resolverExamen($tareas_examenes['test_exam']);
  $alumnoTest->entregarExamen($resuelto);
}
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Poner Examen Problemas                 ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);
//$problem_exam = $profesorTest->editarEjercicio($cursos[1],'problemas','examen_problema_test',4,1,1,1);//con editor matematico
$problem_exam = $profesorTest->editarEjercicio($cursos[1],'problemas','examen_problema_test',4,1,1,0);  //local sin editor matematico
$tareas_examenes['problem_exam']=$profesorTest->ponerTarea($cursos[1],$problem_exam->getEjercicio(),'Examen','Obligatorio',0,60);
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                Estado Examen Problemas (no entregada)             ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkEstadoTarea(array($tareas_examenes['problem_exam']),$alumnos_curso1,'en desarrollo');
$profesorTest->logout();
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Resolver Examen Problemas              ');
$t->diag('-------------------------------------------------------------------');
///*
foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false,true); //loggin para examen
  $resuelto = $alumnoTest->resolverExamen($tareas_examenes['problem_exam']);
  $alumnoTest->entregarExamen($resuelto);
}
//*/

$profesorTest->loggin(false);
$t->diag('-------------------------------------------------------------------');
$t->diag('                 Estado Tareas  (entregado)                     ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->checkEstadoTarea($tareas_examenes,$alumnos_curso1,'entregado');
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         corregir Examenes                       ');
$t->diag('-------------------------------------------------------------------');
///*
foreach ($tareas_examenes as $examen)
{
    $profesorTest->corregirTarea($examen);
}
//*/

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Evaluar                       ');
$t->diag('-------------------------------------------------------------------');
///*
$nota_final=6;
foreach ($alumnos_curso1 as $alum)
{
    $profesorTest->evaluar($alum,$cursos[1],$nota_final);
}
$profesorTest->logout();
// */

$t->diag('*********************************************************************');
$t->diag('                         ALUMNO   TEST                         ');
$t->diag('*********************************************************************');
///*
$alumnoTest = new alumnoTest($browser, $t, $alumnos_curso1[1], $usuario_password);
$alumnoTest->loggin();
$alumnoTest->checkMenu();
// */
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando Mis cursos alumno           ');
$t->diag('-------------------------------------------------------------------');
$alumnoTest->checkMenuMisCursos($cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando evntos alumno           ');
$t->diag('-------------------------------------------------------------------');
$alumnoTest->checkMenuEventos($cursos[1]);
$alumnoTest->logout();

$t->diag('*********************************************************************');
$t->diag('                         SUPERVISOR   TEST                         ');
$t->diag('*********************************************************************');

$supervisorTest = new supervisorTest($browser, $t, $supervisor, $usuario_password);
$supervisorTest->loggin();

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando enlaces supervisor            ');
$t->diag('-------------------------------------------------------------------');
///*
$supervisorTest->checkMenu();
$supervisorTest->checkMenuCorreo();
//*/
$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando cursos supervisor            ');
$t->diag('-------------------------------------------------------------------');
///*
$supervisorTest->checkCursos($cursos);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando modulo supervisor            ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkModulo($modulo);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando cursos en modulos            ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkCursosEnModulo($modulo,$cursos);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando alumnos supervisor            ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkAlumnos($alumnos);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Comprobando profesores supervisor            ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkProfesores($profesores);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando alumnos en curso supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkAlumnosEnCurso($alumnos_curso1,$cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando profesores en curso supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkProfesoresEnCurso($profesores[1],$cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando mensajes profesor supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkMensajesProfesor($profesores[1],$cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando alumnos en modulo supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkAlumnoEnModulo($alumnos[$j_alum],$modulo);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando fichas cursos supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkFichaCurso($cursos[1],$alumnos_curso1,$profesores[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando ficha modulo supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkFichaModulo($modulo,$cursos,$alumnos_modulo);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando tareas cursos supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkTareasCurso($alumnos_curso1,$cursos[1],$tareas,$tareas_examenes);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando dudas cursos supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkDudasCurso($cursos);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Comprobando tripartitas cursos supervisor           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkTripartitas($cursos);

$t->diag('-------------------------------------------------------------------');
$t->diag('      Comprobando tiempos dedicado x alumno (supervisor)           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkTiemposAlumno($alumnos_curso1,$cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('      Comprobando evaluacion alumnos (supervisor)           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkEvaluacionAlumnos($alumnos_curso1,$cursos[1],$nota_final);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Pesos Evaluacion modulos (supervisor)           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkPesosEvaluacionModulo($modulo,$tareas,$tareas_examenes);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Evaluar modulos (supervisor)           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkEvaluarModulo($modulo,$alumnos_modulo);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 ver ranking (supervisor)           ');
$t->diag('-------------------------------------------------------------------');

$supervisorTest->checkVerRanking($modulo);

$t->diag('-------------------------------------------------------------------');
$t->diag('                 Enviar Ranking(supervisor)           ');
$t->diag('-------------------------------------------------------------------');
$supervisorTest->checkEnviarRanking($modulo);

$supervisorTest->logout();


$t->diag('-------------------------------------------------------------------');
$t->diag('                         Cancelar Tareas  profesor                 ');
$t->diag('-------------------------------------------------------------------');
///*
$profesorTest->loggin(false);

$profesorTest->eliminarEjercicio($cuestion->getEjercicio(),$cursos[1]);
$profesorTest->eliminarEjercicio($test->getEjercicio(),$cursos[1]);
$profesorTest->eliminarEjercicio($problema->getEjercicio(),$cursos[1]);

$t->diag('-------------------------------------------------------------------');
$t->diag('                         Cancelar Examenes                       ');
$t->diag('-------------------------------------------------------------------');

$profesorTest->eliminarEjercicio($cuestion_exam->getEjercicio(),$cursos[1]);
$profesorTest->eliminarEjercicio($test_exam->getEjercicio(),$cursos[1]);
$profesorTest->eliminarEjercicio($problem_exam->getEjercicio(),$cursos[1]);


$profesorTest->logout();

foreach($alumnos_curso1 as $alum)
{
  $alumnoTest = new alumnoTest($browser, $t, $alum, $usuario_password);
  $alumnoTest->loggin(false);
  $alumnoTest->NoTieneEventos($cursos[1]);
  $alumnoTest->logout();
}

//*/


/****************************************************************************/
/*                           Login admin                                   */
/****************************************************************************/
$t->diag('');
$t->diag('------------------------------------------------------------------');
$t->diag("   Login administrador para eliminar materias,cursos,alumnos...");
$t->diag('------------------------------------------------------------------');
$t->diag('');
$adminTest->loggin();

/****************************************************************************/
/*                        Borrar datos prubas                               */
/****************************************************************************/
$t->diag('');
$t->diag('---------------------------');
$t->diag("       Borrando datos");
$t->diag('---------------------------');
$t->diag('');$t->diag('');

/****************************************************************************/
/*                        Eliminar modulos                                */
/****************************************************************************/
$t->diag('');
$t->diag('---------------------------');
$t->diag("     Eliminar modulo");
$t->diag('---------------------------');

$adminTest->eliminarModulo($modulo, true);

///*
$t->diag('');
$t->diag('---------------------------');
$t->diag("     Eliminar profesores");
$t->diag('---------------------------');
foreach($profesores as $profesor)
{
 $adminTest->eliminarProfesor($profesor);
}

$t->diag('');
$t->diag('---------------------------');
$t->diag("     Eliminar alumnos");
$t->diag('---------------------------');
foreach($alumnos as $alumno)
{
  if ($alumno->getNombre()!=$alumnos_modulo[0]->getNombre())
  {
   $adminTest->eliminarAlumno($alumno);
  }else $adminTest->eliminarUsuario($alumno,'alumno');
}

//*/
$t->diag('');
$t->diag('---------------------------');
$t->diag("     Eliminar Materias");
$t->diag('---------------------------');
foreach($materias as $materia)
{
 $adminTest->eliminarMateria($materia, true);
}


$t->diag('');
$t->diag('---------------------------');
$t->diag("     Eliminar supervisor");
$t->diag('---------------------------');
$adminTest->eliminarSuperUsuario($supervisor);

$adminTest->borrarNotificaciones($nombre_materias,$nombre_curso,$nombre_modulo,$nombre_usuario);
//*/
/*$test=print_r($browser,true);
$df = fopen('test2.txt','w');
fwrite($df,$test);
fclose($df);*/
?>