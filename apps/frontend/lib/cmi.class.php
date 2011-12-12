<?php

// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DEL MODELO DE DATOS CMI                  **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 10/10/2008                                     **
// **                                                              **
// ******************************************************************


// ##################################################################
// ##                                                              ##
// ##            INCLUSIÓN DE LA IMPLEMENTACIÓN DE                 ##
// ##            LAS FUNCIONES CMI EN EL LMS                       ##
// ##                                                              ##
// ##################################################################

include('lms_cmi_implementation.php');




// ##################################################################
// ##                                                              ##
// ##        CONSTANTES GLOBALES  // FUNCIONES AUXILIARES          ##
// ##                                                              ##
// ##################################################################

  define('CMI_ERROR_GENERAL_EXCEPTION', '101');
  define('CMI_ERROR_INVALID_ARGUMENT', '201');
  define('CMI_ERROR_NO_CHILDREN', '202');
  define('CMI_ERROR_NOT_ARRAY', '203');
  define('CMI_ERROR_NOT_INITIALIZED', '301');
  define('CMI_ERROR_LMS_GENERAL', '302');
  define('CMI_ERROR_NOT_IMPLEMENTED', '401');
  define('CMI_ERROR_INVALID_SET_VALUE', '402');
  define('CMI_ERROR_READ_ONLY', '403');
  define('CMI_ERROR_WRITE_ONLY', '404');
  define('CMI_ERROR_INCORRECT_DATA_TYPE', '405');
  
  function recortarParametros ($parametros)
  {
    $siguiente_query = '';
    for ($i = 0; $i < sizeof($parametros); $i++)
    {
      if (!$i) {$siguiente_query = $parametros[0];}
      if (($i != 4) && ($i != 0)) {$siguiente_query .= '.'.$parametros[$i];}
    }
    return $siguiente_query;
  }

















// ##################################################################
// ##################################################################
// ####                                                          ####
// ####         CLASE CMI.Interactions.Correctresponses          ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIInteractionsCorrectresponses
{


// ******************************************************************
// **                                                              **
// **   ATRIBUTOS DE LA CLASE CMI.Interactions.Correctresponses    **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interactions_correctresponses_getCount = CMI_INTERACTIONS_CORRECTRESPONSES_GETCOUNT;
  private $CMI_interactions_correctresponses_setPatternByIndexes = CMI_INTERACTIONS_CORRECTRESPONSES_SETPATTERNBYINDEXES;

  
  
// ******************************************************************
// **                                                              **
// **    MÉTODOS DE LA CLASE CMI.Interactions.Correctresponses     **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Interactions.Correctresponses Inicializa el objeto

  public function __construct () 
  {

  }
  
  
  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    $pendientes = sizeof($parametros) - 6;
    
    if (!$pendientes)
    // Si no hay al menos 6 parámetros la consulta es incorrecta. 
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $indexi = $parametros[4];
    $actual = $parametros[5];
    $siguiente = $parametros[6];
    
    if ($actual != 'correct_responses')
    // Si la llamada no es a "correct_responses" devolvemos error 
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    if (is_numeric($siguiente))
    // Si el valor siguiente a "[index_i].correct_responses." es un número entonces se trata de un índice
    {
      if (sizeof($parametros) < 8)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }
      
      $pendientes--;
      $indexcr = $siguiente;
      $siguiente = $parametros[7];
    }
    
    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto '[index_i].correct_responses.consulta' o '[index_i].correct_responses.[index_cr].consulta'
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {

        
        case '_count': 
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_interactions_correctresponses_getCount != '') 
            {
              $function_name = $this->CMI_interactions_correctresponses_getCount;
              return $function_name($student_id, $sco_id, $indexi);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
      
        case 'pattern':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_correctresponses_setPatternByIndexes != '') 
            {
              $function_name = $this->CMI_interactions_correctresponses_setPatternByIndexes;
              if ($function_name($student_id, $sco_id, $indexi, $indexcr, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if ($pendientes > 1)
    // Si hubiera más parámetros, 
    // damos el error correspondiente o redirigimos al siguiente objeto 
    {
    
      $siguiente_query = recortarParametros($parametros);
      
      switch ($siguiente)
      {

        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'pattern':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }  
}



































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Interactions.Objectives              ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIInteractionsObjectives
{


// ******************************************************************
// **                                                              **
// **      ATRIBUTOS DE LA CLASE CMI.Interactions.Objectives        **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interactions_objectives_getCount = CMI_INTERACTIONS_OBJECTIVES_GETCOUNT;
  private $CMI_interactions_objectives_setIdByIndexes = CMI_INTERACTIONS_OBJECTIVES_SETIDBYINDEXES;

  
  
// ******************************************************************
// **                                                              **
// **        MÉTODOS DE LA CLASE CMI.Interactions.Objectives        **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Interactions.Objectives Inicializa el objeto

  public function __construct () 
  {

  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Interactions.Objectives
  public function getChildren()
  {
    $string = '';
    
    if ($this->CMI_interactions_objectives_setIdByIndexes != '')  {$string .= 'id,';}

    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }
  
  
  
  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    if ($parametros[5] != 'objectives')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $pendientes = sizeof($parametros) - 6;
    
    if (!$pendientes)
    // Si no hay mas elementos despues de "interactions" damos error, la consulta es incompleta 
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $indexi = $parametros[4];
    $actual = $parametros[5];
    $siguiente = $parametros[6];
    
    
    if (is_numeric($siguiente))
    // Si el valor siguiente a "[indexi].objectives..." es un número se trata de un índice
    {
      if (sizeof($parametros) < 8)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }
      
      $pendientes--;
      $indexo = $siguiente;
      $siguiente = $parametros[7];
    }
    
    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto 'cmi.interactions.consulta' o 'cmi.interactions.[index].consulta' 
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
      
      
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        
        case '_count': 
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_interactions_objectives_getCount != '') 
            {
              $function_name = $this->CMI_interactions_objectives_getCount;
              return $function_name($student_id, $sco_id, $indexi);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
      
        case 'id':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_objectives_setIdByIndexes != '') 
            {
              $function_name = $this->CMI_interactions_objectives_setIdByIndexes;
              if ($function_name($student_id, $sco_id, $indexi, $indexo, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if ($pendientes > 1)
    // Si hubiera más parámetros, 
    // damos el error correspondiente o redirigimos al siguiente objeto 
    {
    
      $siguiente_query = recortarParametros($parametros);
      
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'id':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }  
}



































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                  CLASE CMI.Interactions                  ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIInteractions
{


// ******************************************************************
// **                                                              **
// **           ATRIBUTOS DE LA CLASE CMI.Interactions             **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interactions_getCount = CMI_INTERACTIONS_GETCOUNT;
  private $CMI_interactions_setIdByIndex = CMI_INTERACTIONS_SETIDBYINDEX;
  private $CMI_interactions_setTimeByIndex = CMI_INTERACTIONS_SETTIMEBYINDEX;
  private $CMI_interactions_setTypeByIndex = CMI_INTERACTIONS_SETTYPEBYINDEX;
  private $CMI_interactions_setWeightingByIndex = CMI_INTERACTIONS_SETWEIGHTINGBYINDEX;
  private $CMI_interactions_setStudentResponseByIndex = CMI_INTERACTIONS_SETSTUDENTRESPONSEBYINDEX;
  private $CMI_interactions_setResultByIndex = CMI_INTERACTIONS_SETRESULTBYINDEX;
  private $CMI_interactions_setLatencyByIndex = CMI_INTERACTIONS_SETLATENCYBYINDEX;


  // ATRIBUTOS
  private $objectives = null;
  private $correct_responses = null;
  
  
// ******************************************************************
// **                                                              **
// **             MÉTODOS DE LA CLASE CMI.Interactions             **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Interactions Inicializa el objeto

  public function __construct () 
  {
    $this->objectives = new CMIInteractionsObjectives();
    $this->correct_responses = new CMIInteractionsCorrectresponses();
  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Core.Objectives
  public function getChildren()
  {
    $string = '';
    
    if ($this->CMI_interactions_setIdByIndex != '')  {$string .= 'id,';}
    if ($this->objectives != null) {$string .= 'objectives,';}
    if ($this->CMI_interactions_setTimeByIndex != '')  {$string .= 'time,';}
    if ($this->CMI_interactions_setTypeByIndex != '')  {$string .= 'type,';}
    if ($this->correct_responses != null) {$string .= 'correct_responses,';}
    if ($this->CMI_interactions_setWeightingByIndex != '')  {$string .= 'weighting,';}
    if ($this->CMI_interactions_setStudentResponseByIndex != '')  {$string .= 'student_response,';}
    if ($this->CMI_interactions_setResultByIndex != '')  {$string .= 'result,';}
    if ($this->CMI_interactions_setLatencyByIndex != '')  {$string .= 'latency,';}
    
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }
  
  
  
  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    if ($parametros[4] != 'interactions')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $pendientes = sizeof($parametros) - 5;
    
    if (!$pendientes)
    // Si no hay mas elementos despues de "interactions" damos error, la consulta es incompleta 
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $siguiente = $parametros[5];
    
    
    if (is_numeric($siguiente))
    // Si el valor siguiente a "objectives" es un número se trata de un índice
    {
      if (sizeof($parametros) < 7)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }
      
      $pendientes--;
      $index = $siguiente;
      $siguiente = $parametros[6];
      
    }
    
    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto 'cmi.interactions.consulta' o 'cmi.interactions.[index].consulta' 
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
      
      
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        
        case '_count':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_interactions_getCount != '') 
            {
              $function_name = $this->CMI_interactions_getCount;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
      
        case 'id':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setIdByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setIdByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
      
        
        case 'time':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setTimeByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setTimeByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        case 'type':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setTypeByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setTypeByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        case 'weighting':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setWeightingByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setWeightingByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        case 'student_response':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setStudentResponseByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setStudentResponseByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        case 'result':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setResultByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setResultByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        case 'latency':
          if ($operacion == 'set')
          {
            if ($this->CMI_interactions_setLatencyByIndex != '') 
            {
              $function_name = $this->CMI_interactions_setLatencyByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if ($pendientes > 1)
    // Si hubiera más parámetros, 
    // damos el error correspondiente o redirigimos al siguiente objeto 
    {
    
      $siguiente_query = recortarParametros($parametros);
      
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'id':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'objectives':
          if ($this->objectives != NULL) 
          {
            return $this->objectives->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        case 'time':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'type':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'correct_responses':
          if ($this->correct_responses != NULL) 
          {
            return $this->correct_responses->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        case 'weighting':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'student_response':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'result':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'latency':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }  
}

































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####               CLASE CMI.Studentpreference                ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIStudentpreference
{


// ******************************************************************
// **                                                              **
// **        ATRIBUTOS DE LA CLASE CMI.Studentpreference           **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_studentpreference_getAudio = CMI_STUDENTPREFERENCE_GETAUDIO;
  private $CMI_studentpreference_setAudio = CMI_STUDENTPREFERENCE_SETAUDIO;
  private $CMI_studentpreference_getLanguage = CMI_STUDENTPREFERENCE_GETLANGUAGE;
  private $CMI_studentpreference_setLanguage = CMI_STUDENTPREFERENCE_SETLANGUAGE;
  private $CMI_studentpreference_getSpeed = CMI_STUDENTPREFERENCE_GETSPEED;
  private $CMI_studentpreference_setSpeed = CMI_STUDENTPREFERENCE_SETSPEED;
  private $CMI_studentpreference_getText = CMI_STUDENTPREFERENCE_GETTEXT;
  private $CMI_studentpreference_setText = CMI_STUDENTPREFERENCE_SETTEXT;




// ******************************************************************
// **                                                              **
// **          MÉTODOS DE LA CLASE CMI.Studentpreference           **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Core.Studentpreference Inicializa el objeto

  public function __construct ()
  {

  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Core.Studentpreference
  public function getChildren()
  {
    $string = '';
    
    if (($this->CMI_studentpreference_getAudio != '') && ($this->CMI_studentpreference_setAudio != '')) {$string .= 'audio,';}
    if (($this->CMI_studentpreference_getLanguage != '') && ($this->CMI_studentpreference_setLanguage != '')) {$string .= 'language,';}
    if (($this->CMI_studentpreference_getSpeed != '') && ($this->CMI_studentpreference_setSpeed != '')) {$string .= 'speed,';}
    if (($this->CMI_studentpreference_getText != '') && ($this->CMI_studentpreference_setText != '')) {$string .= 'text,';}

    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }


  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    
    if (sizeof($parametros) < 6)
    // Si la llamada no tiene al menos 6 parametros damos error
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $actual = $parametros[4];
    $siguiente = $parametros[5];
    
    if ($actual != 'student_preference')
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    if (sizeof($parametros) == 6)
    // Procesamos las llamadas que puede atender este objeto 'cmi.core.student_preference.consulta'
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        case '_count': 
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
      
      
        case 'audio':
          if ($operacion == 'set')
          {
            if ($this->CMI_studentpreference_setAudio != '') 
            {
              $function_name = $this->CMI_studentpreference_setAudio;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentpreference_getAudio != '') 
            {
              $function_name = $this->CMI_studentpreference_getAudio;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
        
        case 'language':
          if ($operacion == 'set')
          {
            if ($this->CMI_studentpreference_setLanguage != '') 
            {
              $function_name = $this->CMI_studentpreference_setLanguage;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentpreference_getLanguage != '') 
            {
              $function_name = $this->CMI_studentpreference_getLanguage;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        case 'speed':
          if ($operacion == 'set')
          {
            if ($this->CMI_studentpreference_setSpeed != '') 
            {
              $function_name = $this->CMI_studentpreference_setSpeed;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentpreference_getSpeed != '') 
            {
              $function_name = $this->CMI_studentpreference_getSpeed;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        case 'text':
          if ($operacion == 'set')
          {
            if ($this->CMI_studentpreference_setText != '') 
            {
              $function_name = $this->CMI_studentpreference_setText;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentpreference_getText != '') 
            {
              $function_name = $this->CMI_studentpreference_getText;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if (sizeof($parametros) > 6)
    {
      
      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'audio':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'language':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'speed':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'text':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}




































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                   CLASE CMI.Studentdata                  ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIStudentdata
{


// ******************************************************************
// **                                                              **
// **            ATRIBUTOS DE LA CLASE CMI.Studentdata             **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_studentdata_getMasteryScore = CMI_STUDENTDATA_GETMASTERYSCORE;
  private $CMI_studentdata_getMaxTimeAllowed = CMI_STUDENTDATA_GETMAXTIMEALLOWED;
  private $CMI_studentdata_getTimeLimitAction = CMI_STUDENTDATA_GETTIMELIMITACTION;




// ******************************************************************
// **                                                              **
// **              MÉTODOS DE LA CLASE CMI.Studentdata             **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Studentdata Inicializa el objeto

  public function __construct ()
  {

  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Core.Studentdata
  public function getChildren()
  {
    $string = '';
    
    if ($this->CMI_studentdata_getMasteryScore != '') {$string .= 'mastery_score,';}
    if ($this->CMI_studentdata_getMaxTimeAllowed != '') {$string .= 'max_time_allowed,';}
    if ($this->CMI_studentdata_getTimeLimitAction != '') {$string .= 'time_limit_action,';}

    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }


  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    
    if (sizeof($parametros) < 6)
    // Si la llamada tiene menos de 6 parametros damos error
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $actual = $parametros[4];
    $siguiente = $parametros[5];
    
    if ($actual != 'student_data')
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    if (sizeof($parametros) == 6)
    // Procesamos las llamadas que puede atender este objeto 'cmi.core.student_data.consulta'
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        case '_count': 
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
      
      
        case 'mastery_score':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentdata_getMasteryScore != '') 
            {
              $function_name = $this->CMI_studentdata_getMasteryScore;
              return $function_name($sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
        
        case 'max_time_allowed':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentdata_getMaxTimeAllowed != '') 
            {
              $function_name = $this->CMI_studentdata_getMaxTimeAllowed;
              return $function_name($sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        case 'time_limit_action':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_studentdata_getTimeLimitAction != '') 
            {
              $function_name = $this->CMI_studentdata_getTimeLimitAction;
              return $function_name($sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if (sizeof($parametros) > 6)
    {
      
      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'mastery_score':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'max_time_allowed':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'time_limit_action':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}





































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                 CLASE CMI.Objectives.Score                ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIObjectivesScore
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.Objectives.Score           **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_objectives_score_getRawByIndex = CMI_OBJECTIVES_SCORE_GETRAWBYINDEX;
  private $CMI_objectives_score_setRawByIndex = CMI_OBJECTIVES_SCORE_SETRAWBYINDEX;
  private $CMI_objectives_score_getMaxByIndex = CMI_OBJECTIVES_SCORE_GETMAXBYINDEX;
  private $CMI_objectives_score_setMaxByIndex = CMI_OBJECTIVES_SCORE_SETMAXBYINDEX;
  private $CMI_objectives_score_getMinByIndex = CMI_OBJECTIVES_SCORE_GETMINBYINDEX;
  private $CMI_objectives_score_setMinByIndex = CMI_OBJECTIVES_SCORE_SETMINBYINDEX;



// ******************************************************************
// **                                                              **
// **            MÉTODOS DE LA CLASE CMI.Objectives.Score           **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Objectives.Score Inicializa el objeto

  public function __construct ()
  {

  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Objectives.Score
  public function getChildren()
  {
    $string = '';
    
    if (($this->CMI_objectives_score_getRawByIndex != '') && ($this->CMI_objectives_score_setRawByIndex != '')) {$string .= 'raw,';}
    if (($this->CMI_objectives_score_getMaxByIndex != '') && ($this->CMI_objectives_score_setMaxByIndex != '')) {$string .= 'max,';}
    if (($this->CMI_objectives_score_getMinByIndex != '') && ($this->CMI_objectives_score_setMinByIndex != '')) {$string .= 'min,';}
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }


  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    
    if (sizeof($parametros) < 7)
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $index = $parametros[4];
    $actual = $parametros[5];
    $siguiente = $parametros[6];
    
    if ((!is_numeric($index)) || ($actual != 'score'))
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    if (sizeof($parametros) == 7)
    // Procesamos las llamadas que puede atender este objeto 'cmi.objectives.score.consulta'
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        case '_count': 
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
      
      
        case 'raw':
          if ($operacion == 'set')
          {
            if ($this->CMI_objectives_score_setRawByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_setRawByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_score_getRawByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_getRawByIndex;
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
        
        case 'max':
          if ($operacion == 'set')
          {
            if ($this->CMI_objectives_score_setMaxByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_setMaxByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_score_getMaxByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_getMaxByIndex;
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        case 'min':
          if ($operacion == 'set')
          {
            if ($this->CMI_objectives_score_setMinByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_setMinByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_score_getMinByIndex != '') 
            {
              $function_name = $this->CMI_objectives_score_getMinByIndex;
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if (sizeof($parametros) > 7)
    // Si hubiera más parámetros....
    // damos el error correspondiente
    {
      
      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'raw':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'max':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'min':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}





































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                    CLASE CMI.Objectives                   ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMIObjectives
{


// ******************************************************************
// **                                                              **
// **             ATRIBUTOS DE LA CLASE CMI.Objectives              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_objectives_getCount = CMI_OBJECTIVES_GETCOUNT;
  private $CMI_objectives_getIdByIndex = CMI_OBJECTIVES_GETIDBYINDEX;
  private $CMI_objectives_setIdByIndex = CMI_OBJECTIVES_SETIDBYINDEX;
  private $CMI_objectives_getStatusByIndex = CMI_OBJECTIVES_GETSTATUSBYINDEX;
  private $CMI_objectives_setStatusByIndex = CMI_OBJECTIVES_SETSTATUSBYINDEX;

  // ATRIBUTOS
  private $score = null;
  
  
// ******************************************************************
// **                                                              **
// **               MÉTODOS DE LA CLASE CMI.Objectives              **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Objectives Inicializa el objeto

  public function __construct () 
  {
    $this->score = new CMIObjectivesScore();
  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Objectives
  public function getChildren()
  {
    $string = '';
    
    if (($this->CMI_objectives_getIdByIndex != '') && ($this->CMI_objectives_setIdByIndex != '')) {$string .= 'id,';}
    if ($this->score != null) {$string .= 'score,';}
    if (($this->CMI_objectives_getStatusByIndex != '') && ($this->CMI_objectives_setStatusByIndex != '')) {$string .= 'status,';}
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }
  
  
  
  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    if ($parametros[4] != 'objectives')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    $pendientes = sizeof($parametros) - 5;
    
    if (!$pendientes)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $siguiente = $parametros[5];
    
    
    if (is_numeric($siguiente))
    // Si el valor siguiente a "objectives" es un número se trata de un índice
    {
      if (sizeof($parametros) < 7)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }
      
      $pendientes--;
      $index = $siguiente;
      $siguiente = $parametros[6];
      
    }
    
    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto 'cmi.core.objectives.consulta' o 'cmi.core.objectives.[index].consulta' 
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
      
      
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        
        case '_count': 
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_getCount != '') 
            {
              $function_name = $this->CMI_objectives_getCount;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
      
        case 'id':
          if ($operacion == 'set')
          {
            if ($this->CMI_objectives_setIdByIndex != '') 
            {
              $function_name = $this->CMI_objectives_setIdByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_getIdByIndex != '') 
            {
              $function_name = $this->CMI_objectives_getIdByIndex;
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
        
        case 'status':
          if ($operacion == 'set')
          {
            if ($this->CMI_objectives_setStatusByIndex != '') 
            {
              $function_name = $this->CMI_objectives_setStatusByIndex;
              if ($function_name($student_id, $sco_id, $index, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_objectives_getStatusByIndex != '') 
            {
              $function_name = $this->CMI_objectives_getStatusByIndex;
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if ($pendientes > 1)
    // Si hubiera más parámetros, 
    // damos el error correspondiente 
    {
    
      $siguiente_query = recortarParametros($parametros);
      
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'id':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'score':
          if ($this->score != NULL) 
          {
            return $this->score->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}













































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                   CLASE CMI.Core.Score                   ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMICoreScore
{


// ******************************************************************
// **                                                              **
// **            ATRIBUTOS DE LA CLASE CMI.Core.Score              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_core_score_getRaw = CMI_CORE_SCORE_GETRAW;
  private $CMI_core_score_setRaw = CMI_CORE_SCORE_SETRAW;
  private $CMI_core_score_getMax = CMI_CORE_SCORE_GETMAX;
  private $CMI_core_score_setMax = CMI_CORE_SCORE_SETMAX;
  private $CMI_core_score_getMin = CMI_CORE_SCORE_GETMIN;
  private $CMI_core_score_setMin = CMI_CORE_SCORE_SETMIN;



// ******************************************************************
// **                                                              **
// **              MÉTODOS DE LA CLASE CMI.Core.Score              **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Core.Score Inicializa el objeto

  public function __construct () 
  {

  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Core.Score
  public function getChildren()
  {
    $string = '';
    
    if (($this->CMI_core_score_getRaw != '') && ($this->CMI_core_score_setRaw != '')) {$string .= 'raw,';}
    if (($this->CMI_core_score_getMax != '') && ($this->CMI_core_score_setMax != '')) {$string .= 'max,';}
    if (($this->CMI_core_score_getMin != '') && ($this->CMI_core_score_setMin != '')) {$string .= 'min,';}
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }


  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---
  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    if ($parametros[4] != 'score')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    if (sizeof($parametros) == 5)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.core.score a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $siguiente = $parametros[5];
    
    
    if (sizeof($parametros) == 6)
    // Procesamos las llamadas que puede atender este objeto 'cmi.core.score.consulta'
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
      
      switch ($siguiente)
      {
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        case '_count': 
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
      
      
        case 'raw':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_score_setRaw != '') 
            {
              $function_name = $this->CMI_core_score_setRaw;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
              return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_score_getRaw != '') 
            {
              $function_name = $this->CMI_core_score_getRaw;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
      
        
        case 'max':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_score_setMax != '') 
            {
              $function_name = $this->CMI_core_score_setMax;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_score_getMax != '') 
            {
              $function_name = $this->CMI_core_score_getMax;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        case 'min':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_score_setMin != '') 
            {
              $function_name = $this->CMI_core_score_setMin;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_score_getMin != '') 
            {
              $function_name = $this->CMI_core_score_getMin;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
        
        
        default: 
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    
    if (sizeof($parametros) > 6)
    // Si hubiera más parámetros, como cmi.core.score.parametro.parametro....
    // damos el error correspondiente porque cmi.core.score solo tiene 4 hijos sin mas anidamiento
    {
      
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'raw':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'max':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'min':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}





































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                      CLASE CMI.Core                      ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMICore
{


// ******************************************************************
// **                                                              **
// **               ATRIBUTOS DE LA CLASE CMI.core                 **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_core_getStudentId = CMI_CORE_GETSTUDENTID;
  private $CMI_core_getStudentName = CMI_CORE_GETSTUDENTNAME;
  private $CMI_core_getLessonLocation = CMI_CORE_GETLESSONLOCATION;
  private $CMI_core_setLessonLocation = CMI_CORE_SETLESSONLOCATION;
  private $CMI_core_getCredit = CMI_CORE_GETCREDIT;
  private $CMI_core_getLessonStatus = CMI_CORE_GETLESSONSTATUS;
  private $CMI_core_setLessonStatus = CMI_CORE_SETLESSONSTATUS;
  private $CMI_core_getEntry = CMI_CORE_GETENTRY;
  private $CMI_core_getTotalTime = CMI_CORE_GETTOTALTIME;
  private $CMI_core_getLessonMode = CMI_CORE_GETLESSONMODE;
  private $CMI_core_setExit = CMI_CORE_SETEXIT;
  private $CMI_core_setSessionTime = CMI_CORE_SETSESSIONTIME;
  
  // ATRIBUTOS
  private $score = null;

  


// ******************************************************************
// **                                                              **
// **                 MÉTODOS DE LA CLASE CMI.core                 **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.core. Inicializa el objeto

  public function __construct () 
  {
    $this->score = new CMICoreScore();
  }
  
  
  
  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.core
  public function getChildren()
  {
    $string = '';
    
    if ($this->CMI_core_getStudentId != '') {$string .= 'student_id,';}
    if ($this->CMI_core_getStudentName != '') {$string .= 'student_name,';}
    if (($this->CMI_core_getLessonLocation != '') && ($this->CMI_core_setLessonLocation != '')) {$string .= 'lesson_location,';}
    if ($this->CMI_core_getCredit != '') {$string .= 'credit,';}
    if (($this->CMI_core_getLessonStatus != '') && ($this->CMI_core_setLessonStatus != '')) {$string .= 'lesson_status,';}
    if ($this->CMI_core_getEntry != '') {$string .= 'entry,';}
    if ($this->score != null) {$string .= 'score,';}
    if ($this->CMI_core_getTotalTime != '') {$string .= 'total_time,';}
    if ($this->CMI_core_getLessonMode != '') {$string .= 'lesson_mode,';}
    if ($this->CMI_core_setExit != '') {$string .= 'exit,';}
    if ($this->CMI_core_setSessionTime != '') {$string .= 'session_time,';}
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }


  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param) 
  {
    $parametros = explode('.', $query);
    
    if ($parametros[4] != 'core')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    if (sizeof($parametros) == 5)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.core a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $siguiente = $parametros[5];
    
    
    if (sizeof($parametros) == 6)
    // Procesamos las llamadas que puede atender este objeto 'cmi.core.consulta'
    {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $operando = $param;
       
      switch ($siguiente)
      {
      
      
        case '_children':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        
        case '_count':
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
         
         
        case 'student_id':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getStudentId != '') 
            {
              $function_name = $this->CMI_core_getStudentId;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        case 'student_name':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getStudentName != '') 
            {
              $function_name = $this->CMI_core_getStudentName;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
       
       
        case 'lesson_location':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_setLessonLocation != '') 
            {
              $function_name = $this->CMI_core_setLessonLocation;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getLessonLocation!= '') 
            {
              $function_name = $this->CMI_core_getLessonLocation;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        case 'credit':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getCredit!= '') 
            {
              $function_name = $this->CMI_core_getCredit;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        case 'lesson_status':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_setLessonStatus != '') 
            {
              $function_name = $this->CMI_core_setLessonStatus;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getLessonStatus != '') 
            {
              $function_name = $this->CMI_core_getLessonStatus;
              return $function_name($student_id, $sco_id);
           }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
       
       
        case 'entry':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getEntry!= '') 
            {
              $function_name = $this->CMI_core_getEntry;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         


        case 'total_time':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getTotalTime != '') 
            {
              $function_name = $this->CMI_core_getTotalTime;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


         
        case 'lesson_mode':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_core_getLessonMode!= '')              
            {
              $function_name = $this->CMI_core_getLessonMode;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         

         
        case 'exit':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_setExit != '') 
            {
              $function_name = $this->CMI_core_setExit;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
         
         
        case 'session_time':
          if ($operacion == 'set')
          {
            if ($this->CMI_core_setSessionTime != '') 
            {
              $function_name = $this->CMI_core_setSessionTime;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            return 'e:'.CMI_ERROR_WRITE_ONLY;
          }
        break;
         
         
        default: return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    if (sizeof($parametros) > 6)
    // Cuando la llamada tiene más de seis parámetros debemos redirigir la consulta
    // al objeto correspondiente
    {
    
      $siguiente_query = recortarParametros($parametros);
    
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'student_id':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'student_name':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'lesson_location':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'credit': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'lesson_status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'entry':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'score':
          if ($this->score != NULL) 
          {
            return $this->score->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        case 'total_time': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'lesson_mode':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'exit':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        case 'session_time':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}









































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                        CLASE CMI                         ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class CMI
{

// ******************************************************************
// **                                                              **
// **                  ATRIBUTOS DE LA CLASE CMI                   **
// **                                                              **
// ******************************************************************

  // NOMBRES DE FUNCION
  private $CMI_getSuspendData = CMI_GETSUSPENDDATA;
  private $CMI_setSuspendData = CMI_SETSUSPENDDATA;
  private $CMI_getLaunchData = CMI_GETLAUNCHDATA;
  private $CMI_getComments = CMI_GETCOMMENTS;
  private $CMI_setComments = CMI_SETCOMMENTS;
  private $CMI_getCommentsFromLMS = CMI_GETCOMMENTSFROMLMS;
  
  
  // ATRIBUTOS
  private $core = null;
  private $objectives = null;
  private $student_data = null;
  private $student_preference = null;
  private $interactions = null;
  private $scoid = 0;
  private $userid = 0;


// ******************************************************************
// **                                                              **
// **                    MÉTODOS DE LA CLASE CMI                   **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI, inicializa el objeto

  public function __construct ($userid, $scoid) 
  {
    $this->core = new CMICore();
    $this->objectives = new CMIObjectives();
    $this->student_data = new CMIStudentdata();
    $this->student_preference = new CMIStudentpreference();
    $this->interactions = new CMIInteractions();
    $this->userid = $userid;
    $this->scoid = $scoid;
  }
  
  
  
  //  Nombre del método: getChildren ()
  //  Descripción: Devuelve los hijos soportados por la clase CMI
  public function getChildren ()
  {
    $string = '';
    
    if ($this->core != null) {$string .= 'core,';}
    if (($this->CMI_getSuspendData != '') && ($this->CMI_setSuspendData != '')) {$string .= 'suspend_data,';}
    if ($this->CMI_getLaunchData != '') {$string .= 'launch_data,';}
    if (($this->CMI_getComments != '') && ($this->CMI_setComments != '')) {$string .= 'comments,';}
    if ($this->CMI_getCommentsFromLMS != '') {$string .= 'comments_from_lms,';}
    if ($this->objectives != null) {$string .= 'objectives,';}
    if ($this->student_data != null) {$string .= 'student_data,';}
    if ($this->student_preference != null) {$string .= 'student_preference,';}
    if ($this->interactions != null) {$string .= 'interactions,';}
    
    if (strlen($string) > 0) {$string = substr($string, 0, -1);}
    return $string;
  }
  
  
  
  //  Nombre del método: performQuery ($inputquery, $param)
  //  Descripción: ---
  public function performQuery ($inputquery, $param) 
  {
    $query = $this->userid.'.'.$this->scoid.'.'.$inputquery;
    $parametros = explode('.', $query);
    
    $function_name = '';
    $student_id = $parametros[0];
    $sco_id = $parametros[1];
    $operacion = $parametros[2];
    $operando = $param;
    
    if (sizeof($parametros) < 5)
    {
      return 'e:'.CMI_ERROR_GENERAL_EXCEPTION;
    }
    
    if (!(($parametros[2] == 'get') || ($parametros[2] == 'set')))
    {
      return 'e:'.CMI_ERROR_GENERAL_EXCEPTION;
    }
    
    if ($parametros[4] != 'cmi')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    if (sizeof($parametros) == 5)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
    
    
    $siguiente = $parametros[5];
    
    if (sizeof($parametros) == 6)
    // Procesamos las llamadas que puede atender este objeto 'cmi.consulta'
    {
      switch ($siguiente)
      {
        case '_children': 
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:'.$this->getChildren();
          }
        break;
        
        
        case '_count':
          return 'e:'.CMI_ERROR_NOT_ARRAY;
        break;
        
        
        case 'suspend_data':
          if ($operacion == 'set')
          {
            if ($this->CMI_setSuspendData != '') 
            {
              $function_name = $this->CMI_setSuspendData;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_getSuspendData != '') 
            {
              $function_name = $this->CMI_getSuspendData;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        case 'launch_data':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_getLaunchData != '') 
            {
              $function_name = $this->CMI_getLaunchData;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
       
       
        case 'comments':
          if ($operacion == 'set')
          {
            if ($this->CMI_setComments != '') 
            {
              $function_name = $this->CMI_setComments;
              if ($function_name($student_id, $sco_id, $operando))
              {
                return 'e:'.CMI_ERROR_INCORRECT_DATA_TYPE;
              }
              else
              {
                return 's:true';
              }
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_getComments != '') 
            {
              $function_name = $this->CMI_getComments;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        case 'comments_from_lms':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            if ($this->CMI_getCommentsFromLMS != '') 
            {
              $function_name = $this->CMI_getCommentsFromLMS;
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;
         
         
        default: return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
    
    $siguiente_query = recortarParametros($parametros);
    
    if (sizeof($parametros) > 6)
    // Si las llamadas no las puede atender este objeto, redirigimos la llamada 
    // con los parametros correspondientes al siguiente
    {
      switch ($siguiente)
      {
        case '_children': 
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        
        case 'suspend_data':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        
        case 'launch_data':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        
        case 'comments':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        
        case 'comments_from_lms':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;
        
        
        case 'core':
          if ($this->core != NULL) 
          {
            return $this->core->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        
        case 'objectives':
          if ($this->objectives != NULL) 
          {
            return $this->objectives->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        
        case 'student_data':
          if ($this->student_data != NULL) 
          {
            return $this->student_data->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        
        case 'student_preference':
          if ($this->student_preference != NULL) 
          {
            return $this->student_preference->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        
        case 'interactions':
          if ($this->interactions != NULL) 
          {
            return $this->interactions->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;
        
        
        default: return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }  
}








?>
