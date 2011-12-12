<?php

class myCursoValidator extends sfValidator
{

  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('curso_error', 'Invalid input');

    $this->getParameterHolder()->add($parameters);

    return true;
  }

  public function execute(&$value, &$error)
  {
    $fechaInicio_param = $this->getParameter('fechaInicio');
    $fechaInicio = $this->getContext()->getRequest()->getParameter($fechaInicio_param);

    $c = new sfEventCalendar('month', date("Y-m-d"));

    //sirve para difereciar si valido el formulario de nuevo curso o el de modificar curso
    if (!$this->getParameter('modificar'))
    {
        list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);
        $compFechas = $c->getCalendar()->compareDates($diaInicio,$mesInicio,$anioInicio,date("d"),date("m"),date("Y"));

        if (!$this->getParameter('fechaFin'))
        {
    	 	  if (-1==$compFechas)
          {
            $error = 'La fecha de inicio debe ser mayor que la fecha actual '.date("d-m-Y");
            return false;
    	    }
    	   }else{
          	    $fechaFin_param = $this->getParameter('fechaFin');
                $fechaFin = $this->getContext()->getRequest()->getParameter($fechaFin_param);
                list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
                $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,$diaInicio,$mesInicio,$anioInicio);

                //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
                 if (-1==$compFechas)
                 {
                  $error = 'La fecha de fin debe ser mayor que la de inicio';
              	  return false;
              	 }
              }
    }else{ //modificar curso
           if ($this->getParameter('fechaFin'))
           {
             $fechaFin_param = $this->getParameter('fechaFin');
             $fechaFin = $this->getContext()->getRequest()->getParameter($fechaFin_param);

             list($anioInicio,$mesInicio,$diaInicio ) = split("[-]", $fechaInicio);
             list($anioFin,$mesFin,$diaFin) = split("[-]", $fechaFin);
             $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,$diaInicio,$mesInicio,$anioInicio);

             //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
              if (-1==$compFechas)
              {
                $error = 'La fecha de fin debe ser mayor que la de inicio';
                return false;
               }
           }
         }


    return true;
  }

}

