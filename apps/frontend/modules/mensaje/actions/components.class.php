<?php

/**
 * avisos actions.
 *
 * @package    edoceo
 * @component  avisos
 * @author     Angel Mart�n Latasa
 */
class mensajeComponents extends sfComponents
{
  // Acci�n #1
  // Accion predeterminada
  public function executeDefault()
  {
  }

  // Acci�n #2
  // Muestra una l�nea con el n�mero de mensajes totales y los nuevos.
  // Si se le pasa un curso como par�metro s�lo muestra el resumen de mensajes
  // relacionados con ese curso.
  public function executeResumenMensajesRecibidos()
  {
    $this->nuevos = $this->getUser()->getNumeroMensajesNuevos();
  }

  public function executeMenuMensajes()
  {

  }


}
