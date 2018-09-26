<?php

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

/*$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'fixtures');*/

$c = new sfEventCalendar('month', date("Y-m-d"));

$c_curso = new Curso();
$cursos = $c_curso->getCursos();

$fd= fopen("envios.html","w");

$diaHoy=date("d");
$mesHoy=date("m");
$anioHoy=date("Y");

$con = Propel::getConnection();
try
	{
	$con->begin();

foreach ($cursos as $curso)
{  $alumnos = $curso->getAlumnos();
   $planificacionHitos = $curso->getHitosPlanificacion();
   fwrite($fd,"CURSO:".$curso->getNombre()."<br>");

    foreach ($planificacionHitos as $planificacionHito)
   { fwrite($fd,"##########################################<br>");
     fwrite($fd," hito planificacion:".$planificacionHito->getFechaCompletado("d-m-Y")."<br>");
     fwrite($fd," ##########################################<br>");

      $diaHitoFin=$planificacionHito->getFechaCompletado("d");
  	  $mesHitoFin=$planificacionHito->getFechaCompletado("m");
  	  $anioHitoFin=$planificacionHito->getFechaCompletado("Y");

  	  $compFechas = $c->getCalendar()->compareDates($diaHoy,$mesHoy,$anioHoy,$diaHitoFin,$mesHitoFin,$anioHitoFin);
  	  if (1==$compFechas) {
  	    //fecha actual mayor que fecha recomendada de fin de tema
  	    foreach ($alumnos as $alumno)
	       {   $hitoAlumno = $alumno->getUsuario()->getHitoTema($planificacionHito->getIdTema());
	           fwrite($fd,"ALUMNO:".$alumno->getUsuario()->getNombre()."<br>");
	           if ($hitoAlumno) {
	           	  //fwrite($fd,$alumno->getUsuario()->getNombre().": ".$hitoAlumno->getTema()->getNombre()." ".$hitoAlumno->getEstado()."<br>");
	           	  if (1==$hitoAlumno->getEstado()) {
                       // no compleatado
                       $crit = new Criteria();
                       $crit->add(NotificacionPeer::ID_USUARIO, $alumno->getUsuario()->getId());
                       $crit->add(NotificacionPeer::ID_CURSO, $curso->getId());
                       $crit->add(NotificacionPeer::ID_TEMA, $planificacionHito->getIdTema());
                       $notif = NotificacionPeer::doSelectOne($crit);
                       if (!$notif) {
						        fwrite($fd,"notificacion nueva".$planificacionHito->getTema()->getNombre()." no completado<br>");
						        $notificacion = new Notificacion();
						        $notificacion->setIdTema($planificacionHito->getIdTema());
						        $notificacion->setIdCurso($curso->getId());
						        $notificacion->setIdUsuario($alumno->getUsuario()->getId());
						        $notificacion->setTitulo("No completado ");
						        $notificacion->setContenido("No completado  el tema ".$planificacionHito->getTema()->getNombre());
						        $notificacion->setFecha(date("Y-m-d"));
						        $notificacion->setTipo(1);
						        $notificacion->save($con);
						      }
	           	  }
	           	  else { if (2==$hitoAlumno->getEstado()) {
                         // completado comprobar si en fecha
						  $diaHitoFinAlumno = $hitoAlumno->getFechaCompletado("d");
  	                      $mesHitoFinAlumno = $hitoAlumno->getFechaCompletado("m");
  	                      $anioHitoFinAlumno = $hitoAlumno->getFechaCompletado("Y");
                          fwrite($fd,"hito Alumno:".$hitoAlumno->getFechaCompletado("d-m-Y")."<br>");
						  $compFechas2 = $c->getCalendar()->compareDates($diaHitoFinAlumno,$mesHitoFinAlumno,$anioHitoFinAlumno,$diaHitoFin,$mesHitoFin,$anioHitoFin);
						   if (1==$compFechas) {
						     //completado pero no en fecha
						     $crit = new Criteria();
                             $crit->add(NotificacionPeer::ID_USUARIO, $alumno->getUsuario()->getId());
                             $crit->add(NotificacionPeer::ID_CURSO, $curso->getId());
                             $crit->add(NotificacionPeer::ID_TEMA, $planificacionHito->getIdTema());
                             $notif = NotificacionPeer::doSelectOne($crit);

						     if (!$notif) {
						        fwrite($fd,"notificacion nueva".$planificacionHito->getTema()->getNombre()."  completado pero no en fecha<br>");
						        $notificacion = new Notificacion();
						        $notificacion->setIdTema($planificacionHito->getIdTema());
						        $notificacion->setIdCurso($curso->getId());
						        $notificacion->setIdUsuario($alumno->getUsuario()->getId());
						        $notificacion->setTitulo("No completado en fecha");
						        $notificacion->setContenido("No completado en fecha el tema ".$planificacionHito->getTema()->getNombre());
						        $notificacion->setFecha(date("Y-m-d"));
						        $notificacion->setTipo(2);
						        $notificacion->save($con);

						      }
						     }
	           	          }
					   }
	           }
	          else{ fwrite($fd,"notificacion nueva".$planificacionHito->getTema()->getNombre()." no completado ni iniciado<br>");
						        $notificacion = new Notificacion();
						        $notificacion->setIdTema($planificacionHito->getIdTema());
						        $notificacion->setIdCurso($curso->getId());
						        $notificacion->setIdUsuario($alumno->getUsuario()->getId());
						        $notificacion->setTitulo("No completado ");
						        $notificacion->setContenido("No completado  el tema ".$planificacionHito->getTema()->getNombre());
						        $notificacion->setFecha(date("Y-m-d"));
						        $notificacion->setTipo(1);
						        $notificacion->save($con);
			    }
	       fwrite($fd,"<br>-----FIN ALUMNO------<br>");
		   }
  	  }



   }
   fwrite($fd,"<br>************<br><br><br>");
   }
 $con->commit();
 }
  			catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}


?>