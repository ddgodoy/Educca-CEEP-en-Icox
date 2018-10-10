<?php

/**
 * avisos actions.
 *
 * @package    edoceo
 * @component  avisos
 * @author     Angel Martín Latasa
 */
class mensajeComponents extends sfComponents
{
  // Acción #1
  // Accion predeterminada
  public function executeDefault()
  {
  }

  // Acción #2
  // Muestra una línea con el número de mensajes totales y los nuevos.
  // Si se le pasa un curso como parámetro sólo muestra el resumen de mensajes
  // relacionados con ese curso.
  public function executeResumenMensajesRecibidos()
  {
    $this->nuevos = $this->getUser()->getNumeroMensajesNuevos();
  }

  public function executeMenuMensajes()
  {

  }


}
