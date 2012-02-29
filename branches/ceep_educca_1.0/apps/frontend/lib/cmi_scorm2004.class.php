<?php

// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DEL MODELO DE DATOS CMI                  **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 05/07/2009                                     **
// **                                                              **
// ******************************************************************


// ##################################################################
// ##                                                              ##
// ##            INCLUSIÓN DE LA IMPLEMENTACIÓN DE                 ##
// ##            LAS FUNCIONES CMI EN EL LMS                       ##
// ##                                                              ##
// ##################################################################

include('lms_cmi_scorm2004_implementation.php');




// ##################################################################
// ##                                                              ##
// ##        CONSTANTES GLOBALES  // FUNCIONES AUXILIARES          ##
// ##                                                              ##
// ##################################################################
/*
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

  function recortarParametros ($parametros, $desp=0)
  {
    $cut = 4 + $desp;

    $siguiente_query = '';
    for ($i = 0; $i < sizeof($parametros); $i++)
    {
      if (!$i) {$siguiente_query = $parametros[0];}
      if (($i != $cut) && ($i != 0)) {$siguiente_query .= '.'.$parametros[$i];}
    }
    return $siguiente_query;
  }

*/






































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.ObjectiveScore                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIObjectiveScore
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.ObjectiveScore              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_objective_score_getScaled = 'CMI_OBJECTIVE_SCORE_GETSCALED';
  private $CMI_objective_score_setScaled = 'CMI_OBJECTIVE_SCORE_SETSCALED';
  private $CMI_objective_score_getRaw = 'CMI_OBJECTIVE_SCORE_GETRAW';
  private $CMI_objective_score_setRaw = 'CMI_OBJECTIVE_SCORE_SETRAW';
  private $CMI_objective_score_getMax = 'CMI_OBJECTIVE_SCORE_GETMAX';
  private $CMI_objective_score_setMax = 'CMI_OBJECTIVE_SCORE_SETMAX';
  private $CMI_objective_score_getMin = 'CMI_OBJECTIVE_SCORE_GETMIN';
  private $CMI_objective_score_setMin = 'CMI_OBJECTIVE_SCORE_SETMIN';



// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.ObjectiveScore               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto
  public function getChildren()
  {
    return 'scaled,raw,min,max';
  }



  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param)
  {
    $parametros = explode('.', $query);

    if ($parametros[5] != 'score')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }

    $pendientes = sizeof($parametros) - 6;

    if (!$pendientes)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }


    $siguiente = $parametros[6];


    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $index = $parametros[4];
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
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'scaled':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objective_score_setScaled;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_getScaled;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'raw':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objective_score_setRaw;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_getRaw;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_setMin;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_getMin;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_setMax;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objective_score_getMax;
            if ($function_name != '')
            {
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

        case 'scaled':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'raw':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'min':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'max':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}

*/

































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####               CLASE CMI.Objectives                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIObjectives
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.Objectives             **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_objectives_getCount = 'CMI_OBJECTIVES_GETCOUNT';
  private $CMI_objectives_getId = 'CMI_OBJECTIVES_GETID';
  private $CMI_objectives_setId = 'CMI_OBJECTIVES_SETID';
  private $CMI_objectives_getSuccessStatus = 'CMI_OBJECTIVES_GETSUCCESSSTATUS';
  private $CMI_objectives_setSuccessStatus = 'CMI_OBJECTIVES_SETSUCCESSSTATUS';
  private $CMI_objectives_getCompletionStatus = 'CMI_OBJECTIVES_GETCOMPLETIONSTATUS';
  private $CMI_objectives_setCompletionStatus = 'CMI_OBJECTIVES_SETCOMPLETIONSTATUS';
  private $CMI_objectives_getProgressMeasure = 'CMI_OBJECTIVES_GETPROGRESSMEASURE';
  private $CMI_objectives_setProgressMeasure = 'CMI_OBJECTIVES_SETPROGRESSMEASURE';
  private $CMI_objectives_getDescription = 'CMI_OBJECTIVES_GETDESCRIPTION';
  private $CMI_objectives_setDescription = 'CMI_OBJECTIVES_SETDESCRIPTION';

  // ATRIBUTOS
  private $score = null;


// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.Objectives               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
    $this->score = new CMIObjectiveScore();
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Comments_from_lms
  public function getChildren()
  {
    return 'id,score,success_status,completion_status,progress_measure,description';
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
    // Si el valor siguiente a "interactions" es un número se trata de un índice
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
    // Procesamos las llamadas que puede atender este objeto
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
            $function_name = $this->CMI_objectives_getCount;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_setId;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_getId;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'success_status':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objectives_setSuccessStatus;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_getSuccessStatus;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'completion_status':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objectives_setCompletionStatus;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_getCompletionStatus;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'progress_measure':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objectives_setProgressMeasure;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_getProgressMeasure;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'description':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_objectives_setDescription;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_objectives_getDescription;
            if ($function_name != '')
            {
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

        case 'success_status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'completion_status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'progress_measure':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'description':
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
*/




















// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Score                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIScore
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.Score              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_score_getScaled = 'CMI_SCORE_GETSCALED';
  private $CMI_score_setScaled = 'CMI_SCORE_SETSCALED';
  private $CMI_score_getRaw = 'CMI_SCORE_GETRAW';
  private $CMI_score_setRaw = 'CMI_SCORE_SETRAW';
  private $CMI_score_getMax = 'CMI_SCORE_GETMAX';
  private $CMI_score_setMax = 'CMI_SCORE_SETMAX';
  private $CMI_score_getMin = 'CMI_SCORE_GETMIN';
  private $CMI_score_setMin = 'CMI_SCORE_SETMIN';



// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.Score               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto
  public function getChildren()
  {
    return 'scaled,raw,min,max';
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

    $pendientes = sizeof($parametros) - 5;

    if (!$pendientes)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }


    $siguiente = $parametros[5];



    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto
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
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'scaled':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_score_setScaled;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_getScaled;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'raw':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_score_setRaw;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_getRaw;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_setMin;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_getMin;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_setMax;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_score_getMax;
            if ($function_name != '')
            {
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


    if ($pendientes > 1)
    // Si hubiera más parámetros,
    // damos el error correspondiente
    {

      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'scaled':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'raw':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'min':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'max':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}


*/




































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Learner_preference                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################
/*

class CMILearnerPreference
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.LearnerPreference              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_learner_preference_getAudioLevel = 'CMI_LEARNER_PREFERENCE_GETAUDIOLEVEL';
  private $CMI_learner_preference_setAudioLevel = 'CMI_LEARNER_PREFERENCE_SETAUDIOLEVEL';
  private $CMI_learner_preference_getLanguage = 'CMI_LEARNER_PREFERENCE_GETLANGUAGE';
  private $CMI_learner_preference_setLanguage = 'CMI_LEARNER_PREFERENCE_SETLANGUAGE';
  private $CMI_learner_preference_getDeliverySpeed = 'CMI_LEARNER_PREFERENCE_GETDELIVERYSPEED';
  private $CMI_learner_preference_setDeliverySpeed = 'CMI_LEARNER_PREFERENCE_SETDELIVERYSPEED';
  private $CMI_learner_preference_getAudioCaptioning = 'CMI_LEARNER_PREFERENCE_GETAUDIOCAPTIONING';
  private $CMI_learner_preference_setAudioCaptioning = 'CMI_LEARNER_PREFERENCE_SETAUDIOCAPTIONING';



// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.LearnerPreference               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto
  public function getChildren()
  {
    return 'audio_level,language,delivery_speed,audio_captioning';
  }



  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param)
  {
    $parametros = explode('.', $query);

    if ($parametros[4] != 'learner_preference')
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


    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto
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
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'audio_level':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_preference_setAudioLevel;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_preference_getAudioLevel;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_preference_setLanguage;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_preference_getLanguage;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'delivery_speed':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_preference_setDeliverySpeed;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_preference_getDeliverySpeed;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'audio_captioning':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_preference_setAudioCaptioning;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_preference_getAudioCaptionings;
            if ($function_name != '')
            {
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


    if ($pendientes > 1)
    // Si hubiera más parámetros,
    // damos el error correspondiente
    {

      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case '_count':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'audio_level':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'language':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'delivery_speed':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'audio_captioning':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}

*/
































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####      CLASE CMI.InteractionCorrectResponses               ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIInteractionCorrectResponses
{


// ******************************************************************
// **                                                              **
// **    ATRIBUTOS DE LA CLASE CMI.InteractionCorrectResponses     **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interaction_correct_responses_getCount = 'CMI_INTERACTION_CORRECT_RESPONSES_GETCOUNT';
  private $CMI_interaction_correct_responses_getPattern = 'CMI_INTERACTION_CORRECT_RESPONSES_GETPATTERN';
  private $CMI_interaction_correct_responses_setPattern = 'CMI_INTERACTION_CORRECT_RESPONSES_SETPATTERN';



// ******************************************************************
// **                                                              **
// **     MÉTODOS DE LA CLASE CMI.InteractionCorrectResponses      **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto
  public function getChildren()
  {
    return 'pattern';
  }



  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param)
  {
    $parametros = explode('.', $query);

    if ($parametros[5] != 'correct_responses')
    // Si la llamada no es a este objeto devolvemos error de argumento incorrecto
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }

    $pendientes = sizeof($parametros) - 6;

    if (!$pendientes)
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }


    $siguiente = $parametros[6];


    if (is_numeric($siguiente))
    // Si el valor siguiente a "interactions" es un número se trata de un índice
    {
      if (sizeof($parametros) < 8)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }

      $pendientes--;
      $response_index = $siguiente;
      $siguiente = $parametros[7];

    }

    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $interaction_index = $parametros[4];
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
            $function_name = $this->CMI_interaction_correct_responses_getCount;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $interaction_index);
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
            $function_name = $this->CMI_interaction_correct_responses_setPattern;
            if ($function_name != '')
            {
              if ($function_name($student_id, $sco_id, $interaction_index, $response_index, $operando))
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
            $function_name = $this->CMI_interaction_correct_responses_getPattern;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $interaction_index, $response_index);
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

      switch ($siguiente)
      {
        case '_children':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

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





*/


































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.InteractionObjectives                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIInteractionObjectives
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.InteractionObjectives              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interaction_objectives_getCount = 'CMI_INTERACTION_OBJECTIVES_GETCOUNT';
  private $CMI_interaction_objectives_getId = 'CMI_INTERACTION_OBJECTIVES_GETID';
  private $CMI_interaction_objectives_setId = 'CMI_INTERACTION_OBJECTIVES_SETID';



// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.InteractionObjectives               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto
  public function getChildren()
  {
    return 'id';
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
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }


    $siguiente = $parametros[6];


    if (is_numeric($siguiente))
    // Si el valor siguiente a "interactions" es un número se trata de un índice
    {
      if (sizeof($parametros) < 8)
      {
        return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
      }

      $pendientes--;
      $objective_index = $siguiente;
      $siguiente = $parametros[7];

    }

    if ($pendientes == 1)
    // Procesamos las llamadas que puede atender este objeto
      {
      $function_name = '';
      $student_id = $parametros[0];
      $sco_id = $parametros[1];
      $operacion = $parametros[2];
      $interaction_index = $parametros[4];
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
            $function_name = $this->CMI_interaction_objectives_getCount;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $interaction_index);
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
            $function_name = $this->CMI_interaction_objectives_setId;
            if ($function_name != '')
            {
              if ($function_name($student_id, $sco_id, $interaction_index, $objective_index, $operando))
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
            $function_name = $this->CMI_interaction_objectives_getId;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $interaction_index, $objective_index);
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


*/




































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Interactions                        ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIInteractions
{


// ******************************************************************
// **                                                              **
// **          ATRIBUTOS DE LA CLASE CMI.Interactions              **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_interactions_getCount = 'CMI_INTERACTIONS_GETCOUNT';
  private $CMI_interactions_getId = 'CMI_INTERACTIONS_GETID';
  private $CMI_interactions_setId = 'CMI_INTERACTIONS_SETID';
  private $CMI_interactions_getType = 'CMI_INTERACTIONS_GETTYPE';
  private $CMI_interactions_setType = 'CMI_INTERACTIONS_SETTYPE';
  private $CMI_interactions_getTimestamp = 'CMI_INTERACTIONS_GETTIMESTAMP';
  private $CMI_interactions_setTimestamp = 'CMI_INTERACTIONS_SETTIMESTAMP';
  private $CMI_interactions_getWeighting = 'CMI_INTERACTIONS_GETWEIGHTING';
  private $CMI_interactions_setWeighting = 'CMI_INTERACTIONS_SETWEIGHTING';
  private $CMI_interactions_getLearnerResponse = 'CMI_INTERACTIONS_GETLEARNERRESPONSE';
  private $CMI_interactions_setLearnerResponse = 'CMI_INTERACTIONS_SETLEARNERRESPONSE';
  private $CMI_interactions_getResult = 'CMI_INTERACTIONS_GETRESULT';
  private $CMI_interactions_setResult = 'CMI_INTERACTIONS_SETRESULT';
  private $CMI_interactions_getLatency = 'CMI_INTERACTIONS_GETLATENCY';
  private $CMI_interactions_setLatency = 'CMI_INTERACTIONS_SETLATENCY';
  private $CMI_interactions_getDescription = 'CMI_INTERACTIONS_GETDESCRIPTION';
  private $CMI_interactions_setDescription = 'CMI_INTERACTIONS_SETDESCRIPTION';


  // ATRIBUTOS
  private $objectives = null;
  private $correct_responses = null;


// ******************************************************************
// **                                                              **
// **           MÉTODOS DE LA CLASE CMI.Interactions               **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Comments_from_lms Inicializa el objeto

  public function __construct ()
  {
    $this->objectives = new CMIInteractionObjectives();
    $this->correct_responses = new CMIInteractionCorrectResponses();
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Comments_from_lms
  public function getChildren()
  {
    return 'id,type,objectives,timestamp,correct_responses,weighting,learner_response,result,latency,description';
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
    // Si no hay más pasos que dar tenemos que procesar la consulta... en este caso no se puede llamar a cmi.objectives a secas, devolvemos error de argumentos
    {
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }


    $siguiente = $parametros[5];


    if (is_numeric($siguiente))
    // Si el valor siguiente a "interactions" es un número se trata de un índice
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
    // Procesamos las llamadas que puede atender este objeto
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
            $function_name = $this->CMI_interactions_getCount;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_setId;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getId;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'type':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setType;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getType;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'timestamp':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setTimestamp;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getTimestamp;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'weighting':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setWeighting;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getWeighting;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'learner_response':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setLearnerResponse;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getLearnerResponse;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'result':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setResult;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getResult;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'latency':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setLatency;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getLatency;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'description':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_interactions_setDescription;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_interactions_getDescription;
            if ($function_name != '')
            {
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

        case 'type':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'timestamp':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'weighting':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'learner_response':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'result':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'latency':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;

        case 'description':
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

        default:
          return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}
*/
































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Comments_from_lms                   ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIComments_from_lms
{


// ******************************************************************
// **                                                              **
// **      ATRIBUTOS DE LA CLASE CMI.Comments_from_lms         **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_lms_comments_getCount = 'CMI_LMS_COMMENTS_GETCOUNT';
  private $CMI_lms_comments_getComment = 'CMI_LMS_COMMENTS_GETCOMMENT';
  private $CMI_lms_comments_setComment = 'CMI_LMS_COMMENTS_SETCOMMENT';
  private $CMI_lms_comments_getLocation = 'CMI_LMS_COMMENTS_GETLOCATION';
  private $CMI_lms_comments_setLocation = 'CMI_LMS_COMMENTS_SETLOCATION';
  private $CMI_lms_comments_getTimestamp = 'CMI_LMS_COMMENTS_GETTIMESTAMP';
  private $CMI_lms_comments_setTimestamp = 'CMI_LMS_COMMENTS_SETTIMESTAMP';


// ******************************************************************
// **                                                              **
// **        MÉTODOS DE LA CLASE CMI.Comments_from_lms             **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Comments_from_lms Inicializa el objeto

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Comments_from_lms
  public function getChildren()
  {
    return 'comment,location,timestamp';
  }



  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param)
  {
    $parametros = explode('.', $query);

    if ($parametros[4] != 'comments_from_lms')
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
    // Procesamos las llamadas que puede atender este objeto
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
            $function_name = $this->CMI_lms_comments_getCount;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'comment':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_lms_comments_setComment;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_lms_comments_getComment;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'location':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_lms_comments_setLocation;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_lms_comments_getLocation;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'timestamp':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_lms_comments_setTimestamp;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_lms_comments_getTimestamp;
            if ($function_name != '')
            {
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
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
  }
}
*/



































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####            CLASE CMI.Comments_from_learner               ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMIComments_from_learner
{


// ******************************************************************
// **                                                              **
// **      ATRIBUTOS DE LA CLASE CMI.Comments_from_learner         **
// **                                                              **
// ******************************************************************


  // NOMBRES DE FUNCION
  private $CMI_learner_comments_getCount = 'CMI_LEARNER_COMMENTS_GETCOUNT';
  private $CMI_learner_comments_getComment = 'CMI_LEARNER_COMMENTS_GETCOMMENT';
  private $CMI_learner_comments_setComment = 'CMI_LEARNER_COMMENTS_SETCOMMENT';
  private $CMI_learner_comments_getLocation = 'CMI_LEARNER_COMMENTS_GETLOCATION';
  private $CMI_learner_comments_setLocation = 'CMI_LEARNER_COMMENTS_SETLOCATION';
  private $CMI_learner_comments_getTimestamp = 'CMI_LEARNER_COMMENTS_GETTIMESTAMP';
  private $CMI_learner_comments_setTimestamp = 'CMI_LEARNER_COMMENTS_SETTIMESTAMP';


// ******************************************************************
// **                                                              **
// **      MÉTODOS DE LA CLASE CMI.Comments_from_learner           **
// **                                                              **
// ******************************************************************


  //  Nombre del método: __construct ()
  //  Descripción: Constructor de la clase CMI.Comments_from_learner Inicializa el objeto

  public function __construct ()
  {
  }



  //  Nombre del método: getChildren()
  //  Descripción: Devuelve las opciones soportadas por el objeto CMI.Comments_from_learner
  public function getChildren()
  {
    return 'comment,location,timestamp';
  }



  //  Nombre del método: performQuery ($query, $param)
  //  Descripción: ---

  public function performQuery ($query, $param)
  {
    $parametros = explode('.', $query);

    if ($parametros[4] != 'comments_from_learner')
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
    // Procesamos las llamadas que puede atender este objeto
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
            $function_name = $this->CMI_learner_comments_getCount;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'comment':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_comments_setComment;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_comments_getComment;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'location':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_comments_setLocation;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_comments_getLocation;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id, $index);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'timestamp':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_learner_comments_setTimestamp;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_learner_comments_getTimestamp;
            if ($function_name != '')
            {
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
      return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
    }
  }
}

*/
































// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                        CLASE CMI                         ####
// ####                                                          ####
// ##################################################################
// ##################################################################

/*
class CMI_2004
{

// ******************************************************************
// **                                                              **
// **                  ATRIBUTOS DE LA CLASE CMI                   **
// **                                                              **
// ******************************************************************

  // NOMBRES DE FUNCION
  private $CMI_getCompletionStatus = 'CMI_GETCOMPLETIONSTATUS';
  private $CMI_setCompletionStatus = 'CMI_SETCOMPLETIONSTATUS';
  private $CMI_getCompletionTreshold = 'CMI_GETCOMPLETIONTRESHOLD';
  private $CMI_getCredit = 'CMI_GETCREDIT';
  private $CMI_getEntry = 'CMI_GETENTRY';
  private $CMI_setExit = 'CMI_SETEXIT';
  private $CMI_getLaunchData = 'CMI_GETLAUNCHDATA';
  private $CMI_getLearnerId = 'CMI_GETLEARNERID';
  private $CMI_getLearnerName = 'CMI_GETLEARNERNAME';
  private $CMI_getLocation = 'CMI_GETLOCATION';
  private $CMI_setLocation = 'CMI_SETLOCATION';
  private $CMI_getMaxTimeAllowed = 'CMI_GETMAXTIMEALLOWED';
  private $CMI_getMode = 'CMI_GETMODE';
  private $CMI_getProgressMeasure = 'CMI_GETPROGRESSMEASURE';
  private $CMI_setProgressMeasure = 'CMI_SETPROGRESSMEASURE';
  private $CMI_getScaledPassingScore = 'CMI_GETSCALEDPASSINGSCORE';
  private $CMI_setSessionTime = 'CMI_SETSESSIONTIME';
  private $CMI_getSuccessStatus = 'CMI_GETSUCCESSSTATUS';
  private $CMI_setSuccessStatus = 'CMI_SETSUCCESSSTATUS';
  private $CMI_getSuspendData = 'CMI_GETSUSPENDDATA';
  private $CMI_setSuspendData = 'CMI_SETSUSPENDDATA';
  private $CMI_getTimeLimitAction = 'CMI_GETTIMELIMITACTION';
  private $CMI_getTotalTime = 'CMI_GETTOTALTIME';



  // ATRIBUTOS
  private $comments_from_learner = null;
  private $comments_from_lms = null;
  private $interactions = null;
  private $learner_preference = null;
  private $objectives = null;
  private $score = null;

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
    $this->comments_from_learner = new CMIComments_from_learner();
    $this->comments_from_lms = new CMIComments_from_lms();
    $this->interactions = new CMIInteractions();
    $this->learner_preference = new CMILearnerPreference();
    $this->objectives = new CMIObjectives();
    $this->score = new CMIScore();

    $this->userid = $userid;
    $this->scoid = $scoid;
  }



  //  Nombre del método: getChildren ()
  //  Descripción: Devuelve los hijos soportados por la clase CMI
  public function getChildren ()
  {
    return 'comments_from_learner,comments_from_lms,completion_status,completion_treshold,credit,entry,exit,interactions,launch_data,learner_id,learner_name,learner_preference,location,max_time_allowed,mode,objectives,progress_measure,scaled_passing_score,score,session_time,success_status,suspend_data,time_limit_action,total_time';
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
        case '_version':
          if ($operacion == 'set')
          // No se puede hacer SET a una 'keyword' del  modelo CMI
          {
            return 'e:'.CMI_ERROR_INVALID_SET_VALUE;
          }
          if ($operacion == 'get')
          {
            return 's:1.0';
          }
        break;


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


        case 'completion_status':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setCompletionStatus;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getCompletionStatus;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'completion_treshold':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getCompletionTreshold;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_setCredit;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getCredit;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getEntry;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_setExit;
            if ($function_name != '')
            {
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


        case 'launch_data':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getLaunchData;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'learner_id':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getLearnerId;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'learner_name':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getLearnerName;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'location':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setLocation;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getLocation;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
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
            $function_name = $this->CMI_getMaxTimeAllowed;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'mode':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getLearnerName;
            if ($function_name!= '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'progress_measure':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setProgressMeasure;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getProgressMeasure;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'scaled_passing_score':
          if ($operacion == 'set')
          {
            return 'e:'.CMI_ERROR_READ_ONLY;
          }
          if ($operacion == 'get')
          {
            $function_name = $this->CMI_getScaledPassingScore;
            if ($function_name!= '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'session_time':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setSessionTime;
            if ($function_name != '')
            {
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


        case 'success_status':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setSuccessStatus;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getSuccessStatus;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
            }
            else
            {
              return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
            }
          }
        break;


        case 'suspend_data':
          if ($operacion == 'set')
          {
            $function_name = $this->CMI_setSuspendData;
            if ($function_name != '')
            {
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
            $function_name = $this->CMI_getSuspendData;
            if ($function_name != '')
            {
              return $function_name($student_id, $sco_id);
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
            $function_name = $this->CMI_getTimeLimitAction;
            if ($function_name!= '')
            {
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
            $function_name = $this->CMI_getTotalTime;
            if ($function_name!= '')
            {
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


        case 'completion_status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'completion_treshold':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'credit':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'entry':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'exit':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'launch_data':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'learner_id':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'learner_name':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'location':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'max_time_allowed':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'mode':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'progress_measure':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'scaled_passing_score':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'session_time':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'success_status':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'suspend_data':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'time_limit_action':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'total_time':
          return 'e:'.CMI_ERROR_NO_CHILDREN;
        break;


        case 'comments_from_learner':
          if ($this->comments_from_learner != NULL)
          {
            return $this->comments_from_learner->performQuery($siguiente_query, $param);
          }
          else
          {
            return 'e:'.CMI_ERROR_NOT_IMPLEMENTED;
          }
        break;


        case 'comments_from_lms':
          if ($this->comments_from_lms != NULL)
          {
            return $this->comments_from_lms->performQuery($siguiente_query, $param);
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


        case 'learner_preference':
          if ($this->learner_preference != NULL)
          {
            return $this->learner_preference->performQuery($siguiente_query, $param);
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


        default: return 'e:'.CMI_ERROR_INVALID_ARGUMENT;
        break;
      }
    }
  }
}

*/



?>
