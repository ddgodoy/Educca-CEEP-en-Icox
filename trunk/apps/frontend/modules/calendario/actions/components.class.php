<?php

/**
 * calendario actions.
 *
 * @package    edoceo
 * @subpackage calendario
 * @author     Jacobo
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class calendarioComponents extends sfComponents
{
  /**
   * Executes index action
   *
   */
  public function executeDefault()
  {
  }




   // Nombre del método:MostrarCalendario()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Mediante la libreria sfEventCalendar creamos un calendario, y añadimos los eventos publicos y privados para el usuario
   */
  public function executeMostrarCalendario()
  {

    $meses["01"]='Enero';
    $meses["02"]='Febrero';
    $meses["03"]='Marzo';
    $meses["04"]='Abril';
    $meses["05"]='Mayo';
    $meses["06"]='Junio';
    $meses["07"]='Julio';
    $meses["08"]='Agosto';
    $meses["09"]='Septiembre';
    $meses["10"]='Octubre';
    $meses["11"]='Noviembre';
    $meses["12"]='Diciembre';

    if($this->getRequestParameter('fecha'))
      { $fecha = $this->getRequestParameter('fecha');
        $fechaBD = str_replace('/','-',$fecha);
	  }
	 else { $fecha = date("Y/").date("m/")."01";
	        $fechaBD = date("Y-").date("m-")."01";
	      }

    if(isset ($this->idcurso) )
      { //$idcurso = $this->getRequestParameter('idcurso');
      $idcurso = $this->idcurso;
    	$c = new Criteria();
    	$c->add(CursoPeer::ID, $idcurso);
    	$this->curso = CursoPeer::doSelectOne($c);
    	$this->idcurso = $idcurso;
    	$eventosPrivados = $this->getUser()->getEventosPrivadosCurso($idcurso,$fechaBD);
      $eventosPublicos = $this->getUser()->getEventosPublicosCurso($idcurso,$fechaBD);
	  }
    else{ $eventosPrivados = $this->getUser()->getEventosPrivados($fechaBD);
          $eventosPublicos = $this->getUser()->getEventosPublicos($fechaBD);
        }

    $eventosPrivados = $this->getUser()->quitaEventosRepetidos($eventosPrivados);
	  $eventosPublicos = $this->getUser()->quitaEventosRepetidos($eventosPublicos);

    $result= $this->getUser()->setEventosCalendario($fecha,$eventosPrivados,$eventosPublicos);

	// Return an array of calendar dates with the events attached to them.
	// You can use this array to formulate a calendar in any way you'd like.
	// The array automatically breaks years into months and months into weeks, etc...
	//$this->calendar = $c->getEventCalendar();
	//$this->eventosProximos = self::getEventosDiasProximos(5,5);
    $this->calendar = $result[0]->getEventCalendar();

    $mes = substr($fecha,5,2);
    $anio = substr($fecha,0,4);

    $this->anio = $anio;
    $this->nombreMes = $meses[$mes] ;

    $this->anterior = $result[0]->getCalendar()->beginOfPrevMonth('1', $mes, $anio, '%Y-%m-%d');
    $this->siguiente = $result[0]->getCalendar()->beginOfNextMonth('1', $mes, $anio, '%Y-%m-%d');
    $this->semana = $result[0]->getCalendar()->weekOfYear();
    $this->arrayFechas = $result[1];
    $this->cadOverLib = $result[2];


  }





}


