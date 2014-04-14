<?php

/**
 * ticket actions
 *
 * @package    edoceo
 * @subpackage ticket
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class ticketActions extends sfActions
{
	/**
	 * Detalle ticket admin
	 */
  public function executeTicketAdminDetalle()
  {
  	$this->codigo = $this->getRequestParameter('codigo');
  	$this->respta = $this->getRequestParameter('adm_respuesta');

  	$c = new Criteria();
  	
  	$c->add(TicketPeer::CODIGO, $this->codigo);
    $c->addAscendingOrderByColumn(TicketPeer::ABIERTO);

    $this->detalles = TicketPeer::doSelect($c);
    $this->original = current($this->detalles);
    $default_estado = 'EN PROCESO';
    
    if ($this->original->getEstado() == 'EN PROCESO') {
    	$default_estado = 'CERRADO';
    }
    $this->estado = $this->getRequestParameter('adm_estado', $default_estado);

    if ($this->hasRequestParameter('rec_respuesta'))
    {
    	$fechaH = date('Y-m-d H:i:s');
    	$alumno = $this->original->getUsuarioRelatedByIdAlumno();
    	
    	$resp = new Ticket();
      $resp->setIdAlumno($alumno->getId());
      $resp->setCodigo  ($this->codigo);
      $resp->setMensaje ($this->respta);
      $resp->setAutor   ('admin');
      $resp->setOrigen  ('no');
      $resp->save();
      //
      $upd = TicketPeer::RetrieveByPk($this->original->getId());
			$upd->setEstado($this->estado);

      if ($this->estado == 'EN PROCESO') {
      	$upd->setActualizado($fechaH);
      } else {
      	$upd->setCerrado($fechaH);
      }
      $upd->save();
			//
      $this->redirect('ticket/ticketsAdmin?msg=1');
    }
  }
	
	/**
	 * Listado de tickets admin
	 */
  public function executeTicketsAdmin()
  {
  	$this->msg = $this->getRequestParameter('msg');

  	$c = new Criteria();

  	$c->add(TicketPeer::AUTOR, 'alumno');
  	$c->add(TicketPeer::ORIGEN, 'si');
  	$c->add(TicketPeer::ESTADO, 'CERRADO', Criteria::NOT_EQUAL);
    $c->addDescendingOrderByColumn(TicketPeer::ABIERTO);

    $this->tickets = TicketPeer::doSelect($c);
  }
	
	/**
	 * Listado de tickets de un alumno
	 */
  public function executeTicketsAlumno()
  {
  	$usuarioId = $this->getUser()->getAnyId();
  	$this->msg = $this->getRequestParameter('msg');

  	$c = new Criteria();
  	
  	$c->add(TicketPeer::ID_ALUMNO, $usuarioId);
  	$c->add(TicketPeer::AUTOR, 'alumno');
  	$c->add(TicketPeer::ORIGEN, 'si');
    $c->addDescendingOrderByColumn(TicketPeer::ABIERTO);

    $this->tickets = TicketPeer::doSelect($c);
  }
  
  /**
	 * Detalle ticket
	 */
  public function executeTicketAlumnoDetalle()
  {
  	$usuarioId    = $this->getUser()->getAnyId();
  	$this->codigo = $this->getRequestParameter('codigo');
  	$this->coment = $this->getRequestParameter('tck_comentario');
  	
  	$c = new Criteria();
  	
  	$c->add(TicketPeer::CODIGO, $this->codigo);
    $c->addAscendingOrderByColumn(TicketPeer::ABIERTO);

    $this->detalles = TicketPeer::doSelect($c);
    $this->original = current($this->detalles);
    
    if ($this->hasRequestParameter('rec_comment'))
    {
    	$coment = new Ticket();
      $coment->setIdAlumno($usuarioId);
      $coment->setCodigo  ($this->codigo);
      $coment->setMensaje ($this->coment);
      $coment->setAutor   ('alumno');
      $coment->setOrigen  ('no');
      $coment->save();

      $this->redirect('ticket/ticketsAlumno?msg=1');
    }
  }
  
  /**
	 * Registro alumno ticket
	 */
  public function executeTicketAlumnoRegistro()
  {
  	$usuarioId       = $this->getUser()->getAnyId();
  	$this->r_asunto  = $this->getRequestParameter('rec_asunto');
  	$this->r_mensaje = $this->getRequestParameter('rec_mensaje');
  	
  	if ($this->hasRequestParameter('rec_ticket'))
    {
    	$ticket = new Ticket();
      $ticket->setIdAlumno($usuarioId);
      $ticket->setCodigo  (uniqid(''));
      $ticket->setAsunto  ($this->r_asunto);
      $ticket->setMensaje ($this->r_mensaje);
      $ticket->setEstado  ('NO REVISADO');
      $ticket->setAutor   ('alumno');
      $ticket->setOrigen  ('si');
      $ticket->save();

      $this->redirect('ticket/ticketsAlumno?msg=2');
    }
  }

} // end class