<?php

/**
 * notificaciones actions.
 *
 * @package    edoceo
 * @subpackage notificaciones
 * @author     Ángel Martín Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class notificacionesActions extends sfActions
{

  public function executeMostrarNotificaciones()
  {
    $id_usuario = $this->getUser()->getAnyId();
    $c = new Criteria();
    $c->add(NotificacionPeer::ID_USUARIO, $id_usuario);
    $c->addDescendingOrderByColumn(NotificacionPeer::CREATED_AT);
    $this->notificaciones = NotificacionPeer::DoSelect($c);
  }

	// Nombre del método: executeMostrarNotificacion()
  // Añadida por: Jacobo Chaquet
  /* Descripción: muestra notificacion al usuario, se comprueba que la notificacion
                  es para el usuario.
   */
  public function executeMostrarNotificacion()
  {
    $id_notificacion = $this->getRequestParameter('id_notificacion');
    $this->notificacion = NotificacionPeer::RetrieveByPk($id_notificacion);
    $this->forward404Unless($this->notificacion);
    if (!$this->notificacion->comprobarPermiso($this->getUser()->getAnyId()))
    { return sfView::NONE;
      $this->forward404();
    }

  }


  public function executeBorrarNotificacion()
  {
    $id_notificacion = $this->getRequestParameter('id_notificacion');
    $notificacion = NotificacionPeer::RetrieveByPk($id_notificacion);
    if ($notificacion->comprobarPermiso($this->getUser()->getAnyId()))
    {
      $notificacion->delete();
    }

    $usuario = $this->getUser();
    $credencial = $usuario->obtenerCredenciales();
    if ("administrador"==$credencial) {
      $this->redirect('admin/index');
    }else $this->redirect($credencial.'/index');


  }

  public function executeMostrarAlumnosCursosNuevos()
  {
    $id_usuario = $this->getUser()->getAnyId();
    $c = new Criteria();
    $c->add(NotificacionPeer::ID_USUARIO, $id_usuario);
    $c->add(NotificacionPeer::TIPO, 0);
    $c->addDescendingOrderByColumn(NotificacionPeer::CREATED_AT);
    $this->notificaciones = NotificacionPeer::DoSelect($c);
    return;
  }

	// Nombre del método: executeEnviarRankingModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripción: envia el ranking por email a los alumnos de un modulo
   */
  public function executeEnviarRankingModulo()
  {
     $idmodulo = $this->getRequestParameter('idmodulo');
     $modulo = PaquetePeer::retrieveByPk($idmodulo);
	   $this->forward404Unless($modulo);
	   $datos = $modulo->getRankingAlumnos();

	   $tabla="<br>Ranking:<table><tr bgcolor='#55ff55'><td>Alumno</td><td>Nota</td></tr>";
	   $i=0;
	   foreach($datos as $dato => $clave)
     {
           if (1==strlen($clave))
           {
             $clave.=".00";
           }else if (3==strlen($clave))
                {
                    $clave.="0";
                }


        if ($i % 2 == 1)
         {
               $tabla.="<tr bgcolor='#ffffff'>";
         } else $tabla.="<tr bgcolor='#ffff00'>";
         $tabla.="<td>".$dato."</td><td>".$clave."</td></tr>";
         $i++;

     }

	   $tabla.="</table><br>";
     //echo $tabla;
	   $alumnos = $modulo->getAlumnos();
	   $ejercicios_evaluacion = $modulo->getEvaluacion();

	   foreach ($alumnos as $alumno)
	   {
	     $tablaNota="<br>Notas Alumno:<table><tr bgcolor='#55ff55'><td></td><td>Peso(%)</td><td>Nota</td><td>Total</td></tr>";

	     $ejercicios = $modulo->getNotasAlumno($alumno->getUsuario()->getId(),$ejercicios_evaluacion);
       $i=0;
	     foreach($ejercicios[0] as $ejercicio => $clave)
	     {
         if ($i % 2 == 1)
         {
               $tablaNota.="<tr bgcolor='#ffffff'>";
         } else $tablaNota.="<tr bgcolor='#ffff00'>";
         $i++;

         $tablaNota.="<td>".$ejercicio."</td>";
         $cont=0;
         foreach($clave as $nota)
         {   if (2==$cont)
             { if (1==strlen($nota))
               {
                $nota.=".00";
               }else if (3==strlen($nota))
                     {
                      $nota.="0";
                     }
             }
 	           $tablaNota.="<td>".$nota.'</td>';
 	           $cont++;
         }
         $tablaNota.="</tr>";
       }

       if (1==strlen($ejercicios[1]))
       {
           $ejercicios[1].=".00";
       }else if (3==strlen($ejercicios[1]))
             {
                $ejercicios[1].="0";
             }
       $tablaNota.="<tr bgcolor='#55ff55'><td><b>Nota final:</b><td></td><td></td><td>".$ejercicios[1]."</td></tr>";

       $contenido="<b>".$modulo->getNombre();
       $contenido.=" Evaluacui&oacute;n del alumno ".$alumno->getUsuario()->getNombre()." ".$alumno->getUsuario()->getApellidos()."</b>";
       $contenido.="<table><tr><td>".$tablaNota."</td></tr><tr><td>".$tabla."</td></tr></table>";

	     $alumno->getUsuario()->emailUsuario($idmodulo,1,'ranking',$contenido);
     }
  }

}
