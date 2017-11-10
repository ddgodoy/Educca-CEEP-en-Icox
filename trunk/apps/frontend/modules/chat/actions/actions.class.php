<?php

/**
 * chat actions.
 *
 * @package    edoceo
 * @subpackage chat
 * @author     Jacobo Chaquet
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class chatActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

    $cursos = $this->getUser()->getCursosAny();
    foreach ($cursos as $curso)
   	{		$opciones[$curso->getCurso()->getId()] = $curso->getCurso()->getNombre();
	 	}
	  $this->opciones = $opciones;
  }

  // Nombre del m�todo: UsuariosConectados()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: -Este metodo sera invocado de manera periodica (AJAX) para saber que usuarios estan conectados al chat
                  de un determinado curso.
                  -Actualiza la hora de la base de datos (Rel_conectado_chat) del propio usuario
				  -Para que muestre los usuarios realmente conectados (puede haber usuarios que hayan salido mal=cerrando ventana),
				   mira la hora que tienen los demas usuarios conectados, y si no ha pasado un determinado tiempo (tiene que ser un ligeramente
				   mayor que el tiempo en que se hace la llamada periodica Ajax).
   */

   public function executeUsuariosConectados()
   {
     	$this->getResponse()->setHttpHeader("Content-type: text/xml");
    	$this->getResponse()->setHttpHeader("Cache-Control: no-cache");

  	  $this->id = $this->getRequestParameter('id');

  	  $c = new Criteria();
  	  $c->add(Rel_conectado_chatPeer::ID_CURSO, $this->id);
  	  $c->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getUser()->getAnyID());
  	  $result = Rel_conectado_chatPeer::doSelectOne($c);

  	   if ($result)
       {
  	      /* el usario ya estaba conectado al chat, actualizamos su tiempo
  		     esta situacion puede darse cuando el usario haya salido del chat cerrando la ventana (X)*/
  	      $result->setTiempo(  time() );
  	      $result->save();
  	   }
  	   else{ /*tenia mas de una ventana abierta, y salio correctamente del alguna (lo elimino de la base datos)
  	           hay que conectarle de nuevo */
  	          if ($this->getUser()->hasCredential('alumno'))
              {  $credencial = 'alumno';}
              else { if ($this->getUser()->hasCredential('profesor'))
                     {  $credencial = 'profesor';                }
                   	 else { if ($this->getUser()->hasCredential('supervisor'))
                            {   $credencial = 'supervisor';       }
                          }
  				          }
  	          $c = new Criteria();
  	          $c->add(RolPeer::NOMBRE, $credencial);
      	    	$rol = RolPeer::doSelectOne($c);
  	          $rolId	= $rol->getId();
  	          $conectar = new Rel_conectado_chat();
         			$conectar->setIdUsuario(  $this->getUser()->getAnyID() );
  	          $conectar->setIdCurso(  $this->id );
  	          $conectar->setIdRol(  $rolId );
  	          $conectar->setTiempo(  time() );
  	        	$conectar->save();
  	         }

  	   $c = new Criteria();
       $c->add(Rel_conectado_chatPeer::ID_CURSO, $this->id);
  	   $c->add(Rel_conectado_chatPeer::TIEMPO, time()-8, Criteria::GREATER_THAN); /* usurios que han recargado hace menos de 8 seg, la peticion ajax es cada 2 */
  	   $conectados = Rel_conectado_chatPeer::doSelect($c);

  	   $response= "<?xml version=\"1.0\"?>\n";
  	   $response.= "<response>\n";
  	   foreach($conectados as $conectado)
       {
  		  	$response.= "\t<usuarios>\n";
  				$response.= "\t\t<nombre>".ucwords($conectado->getUsuario()->getNombre())."</nombre>\n";
  				$response.= "\t\t<tipo>".$conectado->getRol()->getNombre()."</tipo>\n";
  				$response.= "\t\t<tiempo>".$conectado->getTiempo()."</tiempo>\n";
  				$response.= "\t</usuarios>\n";
  	   }
  	   $response.= "</response>";
           echo $response;
           exit();
  	   return $this->renderText($response);
   }


  // Nombre del m�todo: SalirUsuario()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Elimina de la base de datos (Rel_conectado_chat) al usuario de la sala del chat
                  para que no siga saliendo conectado
   */
  public function executeSalirUsuario()
  {
     $this->id = $this->getRequestParameter('id');
     $c = new Criteria();
	   $c->add(Rel_conectado_chatPeer::ID_CURSO, $this->id);
	   $c->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getUser()->getAnyID());
	   $result = Rel_conectado_chatPeer::doSelectOne($c);

	    if($result)
		   $result->delete();
   }

	public function executeJquery()
  {
     $this->id = $this->getRequestParameter('id');

     $this->getUser()->comprobarPermiso($this->id);

     $c = new Criteria();
     $c->add(CursoPeer::ID, $this->id );
     $curso = CursoPeer::doSelectOne($c);
     $this->curso =  strtoupper( $curso->getNombre() );

     $usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyID());
     $this->forward404Unless($usuario);
     $this->nombreUsuario =   $usuario->getNombreusuario();

     /*comprobamos que no estubiera conectado*/
     $c = new Criteria();
	   $c->add(Rel_conectado_chatPeer::ID_CURSO, $this->id);
	   $c->add(Rel_conectado_chatPeer::ID_USUARIO, $this->getUser()->getAnyID());
	   $result = Rel_conectado_chatPeer::doSelectOne($c);

	   if ($result)
     {
	      /* el usario ya estaba conectado al chat, actualizamos su tiempo
		     esta situacion puede darse cuando el usario haya salido del chat cerrando la ventana (X)*/
	      $result->setTiempo(  time() );
	      $result->save();
	   }
	   else{/*conectamos al usario al chat*/
	         if ($this->getUser()->hasCredential('alumno'))
           { $credencial = 'alumno';}
           else { if ($this->getUser()->hasCredential('profesor'))
                  {  $credencial = 'profesor';              }
                  else {    if ($this->getUser()->hasCredential('supervisor'))
                            {    $credencial = 'supervisor';                           }
                       }
				         }
           $c = new Criteria();
           $c->add(RolPeer::NOMBRE, $credencial);
           $rol = RolPeer::doSelectOne($c);
           $rolId	= $rol->getId();

           $conectar = new Rel_conectado_chat();
           $conectar->setIdUsuario(  $this->getUser()->getAnyID() );
           $conectar->setIdCurso(  $this->id );
           $conectar->setIdRol(  $rolId );
           $conectar->setTiempo(  time() );

           $conectar->save();
	       }
	}

	public function executeGetmessages()
  {
 	   $this->getResponse()->setHttpHeader("Content-type: text/xml");
	   $this->getResponse()->setHttpHeader("Cache-Control: no-cache");

		 $store_num = 10;
		 $display_num = 10;
		 if( $this->getRequestParameter('operation') == "postmsg" )
		 {
				//selecting the messages

				if (''!=$this->getRequestParameter('message'))
        {
				$messages = new Mensaje_chat();
				$messages->setMsg(  $this->getRequestParameter('message') );

				$messages->setIdUsuario(  $this->getUser()->getAnyID() );
				$messages->setIdCurso(  $this->getRequestParameter('id') );
				$messages->setTime( time() );
				$messages->save();
				$lastMessageId = $messages->getId();
				//deleting the last 10 inputs
				$c = new Criteria();
				$c->add(Mensaje_chatPeer::ID,( $lastMessageId-$store_num ),Criteria::LESS_EQUAL);
				$c->add(Mensaje_chatPeer::ID_CURSO, $this->getRequestParameter('id'));
				$result = Mensaje_chatPeer::doDelete($c);
				}
		 }

		$c = new Criteria();
		$c->add(Mensaje_chatPeer::ID_CURSO, $this->getRequestParameter('id'));
  	if ($this->getRequestParameter('ultimo'))
    {
		   $c->add(Mensaje_chatPeer::ID, $this->getRequestParameter('ultimo'), Criteria::GREATER_THAN);
		}else $c->add(Mensaje_chatPeer::ID, $lastMessageId, Criteria::GREATER_THAN);
		$c->add(Mensaje_chatPeer::TIME, time()-(24*60*60), Criteria::GREATER_THAN); //que muestre los mensajes de hace - de 24 horas

		$c->addAscendingOrderByColumn(Mensaje_chatPeer::ID);
		$c->setLimit($display_num);
		$messages = Mensaje_chatPeer::doSelect($c);
					//$messages = mysql_query("SELECT user,msg
						//					 FROM messages
							//				 WHERE time>$time
								//			 ORDER BY id ASC
									//		 LIMIT $display_num",$dbconn);
		if( !$messages ) $status_code = 2;
		else $status_code = 1;

		$response.= "<?xml version=\"1.0\"?>\n";
		$response.= "<response>\n";
  	foreach($messages as $message)
    {
							//$message['msg'] = htmlspecialchars(stripslashes($message['msg']));
							$response.= "\t<message>\n";
							$response.= "\t\t<time>".date('H:i d-m-Y', $message->getTime())."</time>\n";
							$response.= "\t\t<author>".$message->getUsuario()->getNombreusuario()."</author>\n";
							$response.= "\t\t<text>".$message->getMsg()."</text>\n";
							$response.= "\t\t<idmessage>".$message->getId()."</idmessage>\n";
							$response.= "\t</message>\n";
    }
		$response.= "</response>";

		return $this->renderText($response);
	 }
}