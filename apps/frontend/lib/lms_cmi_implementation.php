<?php

// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DE LAS FUNCIONES CMI EN EL LMS           **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 08/10/2008                                     **
// **                                                              **
// ******************************************************************



// ##################################################################
// ##                                                              ##
// ##                   FUNCIONES AUXILIARES                       ##
// ##                                                              ##
// ##################################################################


function cmi_timespan_error ($string)
{
  if (!$string) {return 1;}
  $parametros = explode(':', $string);
  
  if (sizeof($parametros) != 3)
  {
    return 1;
  }
  
  if ((strlen($parametros[0]) > 4) || (strlen($parametros[0]) < 2) || (!is_numeric($parametros[0])))
  {
    return 1;
  }
  
  if ((strlen($parametros[1]) != 2) || (!is_numeric($parametros[1])))
  {
    return 1;
  }
  
  $segundos = $parametros[2];
  
  if (strlen($segundos) > 2)
  {
    if ($segundos[2] != '.')
    {
      return 1;
    }
    
    $parametros2 = explode('.', $segundos);
    if ((!is_numeric($parametros2[0])) || (!is_numeric($parametros2[1])) || (strlen($parametros[1]) > 2))
    {
      return 1;
    } 
  }
  else
  {
    if (!is_numeric($parametros[2]))
    {
      return 1;
    }
  }
  return 0;
}


function cmi_time_error ($string)
{
  if (!$string) {return 1;}
  $parametros = explode(':', $string);
  
  if (sizeof($parametros) != 3)
  {
    return 1;
  }
  
  if ((strlen($parametros[0]) != 2) || (!is_numeric($parametros[0])))
  {
    return 1;
  }
  
  if ((strlen($parametros[1]) != 2) || (!is_numeric($parametros[1])))
  {
    return 1;
  }
  
  $segundos = $parametros[2];
  
  if (strlen($segundos) > 2)
  {
    if ($segundos[2] != '.')
    {
      return 1;
    }
    
    $parametros2 = explode('.', $segundos);
    if ((!is_numeric($parametros2[0])) || (!is_numeric($parametros2[1])) || (strlen($parametros[1]) > 2))
    {
      return 1;
    } 
  }
  else
  {
    if (!is_numeric($parametros[2]))
    {
      return 1;
    }
  }
  return 0;
}


function is_CMI_Decimal ($string)
{

  if ((gettype($string) != 'string') || (strlen($string) > 25))
  {
    return 0;
  }
  
  $index = 0;
  $primero = $string[$index];

  if ($primero == '-')
  {
    $index++;
  }
  
  if (($primero != '-') && (!is_numeric($primero)))
  {
    return 0;
  }
  
  $count = 0;
  $decimales = false;
  for ($i = $index; $i < strlen($string); $i++)
  {
    if ($count > 1) {return 0;}
    $caracter = $string[$i];
    
    if ($caracter == '.') {$decimales = true; continue;}
    
    if (is_numeric($caracter))
    {
      if ($decimales) {$count++;}
    }
    else
    {
      return 0;
    }
  }
  return 1;
}





// ##################################################################
// ##                                                              ##
// ##            DEFINICIÓN DE LOS NOMBRES DE FUNCIÓN              ##
// ##                                                              ##
// ##################################################################


// -------------               CMI                 ------------------
define ('CMI_GETSUSPENDDATA', 'getCmiSuspendData');
define ('CMI_SETSUSPENDDATA', 'setCmiSuspendData');
define ('CMI_GETLAUNCHDATA', 'getCmiLaunchData');
define ('CMI_GETCOMMENTS', 'getCmiComments');
define ('CMI_SETCOMMENTS', 'setCmiComments');
define ('CMI_GETCOMMENTSFROMLMS', 'getCmiCommentsFromLMS');


// -------------            CMI.Core               ------------------
define ('CMI_CORE_GETSTUDENTID', 'getCmiCoreStudentId');
define ('CMI_CORE_GETSTUDENTNAME', 'getCmiCoreStudentName');
define ('CMI_CORE_GETLESSONLOCATION', 'getCmiCoreLessonLocation');
define ('CMI_CORE_SETLESSONLOCATION', 'setCmiCoreLessonLocation');
define ('CMI_CORE_GETCREDIT', 'getCmiCoreCredit');
define ('CMI_CORE_GETLESSONSTATUS', 'getCmiCoreLessonStatus');
define ('CMI_CORE_SETLESSONSTATUS', 'setCmiCoreLessonStatus');
define ('CMI_CORE_GETENTRY', 'getCmiCoreEntry');
define ('CMI_CORE_GETTOTALTIME', 'getCmiCoreTotalTime');
define ('CMI_CORE_GETLESSONMODE', 'getCmiCoreLessonMode');
define ('CMI_CORE_SETEXIT', 'setCmiCoreExit');
define ('CMI_CORE_SETSESSIONTIME', 'setCmiCoreSessionTime');


// ----------            CMI.Core.Score               ---------------
define ('CMI_CORE_SCORE_GETRAW', 'getCmiCoreScoreRaw');
define ('CMI_CORE_SCORE_SETRAW', 'setCmiCoreScoreRaw');
define ('CMI_CORE_SCORE_GETMAX', 'getCmiCoreScoreMax');
define ('CMI_CORE_SCORE_SETMAX', 'setCmiCoreScoreMax');
define ('CMI_CORE_SCORE_GETMIN', 'getCmiCoreScoreMin');
define ('CMI_CORE_SCORE_SETMIN', 'setCmiCoreScoreMin');


// ----------             CMI.Objectives               ---------------
define ('CMI_OBJECTIVES_GETCOUNT', 'getCmiObjectivesCount');
define ('CMI_OBJECTIVES_GETIDBYINDEX', 'getCmiObjectivesIdByIndex');
define ('CMI_OBJECTIVES_SETIDBYINDEX', 'setCmiObjectivesIdByIndex');
define ('CMI_OBJECTIVES_GETSTATUSBYINDEX', 'getCmiObjectivesStatusByIndex');
define ('CMI_OBJECTIVES_SETSTATUSBYINDEX', 'setCmiObjectivesStatusByIndex');


// ----------         CMI.Objectives.Score             ---------------
define ('CMI_OBJECTIVES_SCORE_GETRAWBYINDEX', 'getCmiObjectivesScoreRawByIndex');
define ('CMI_OBJECTIVES_SCORE_SETRAWBYINDEX', 'setCmiObjectivesScoreRawByIndex');
define ('CMI_OBJECTIVES_SCORE_GETMAXBYINDEX', 'getCmiObjectivesScoreMaxByIndex');
define ('CMI_OBJECTIVES_SCORE_SETMAXBYINDEX', 'setCmiObjectivesScoreMaxByIndex');
define ('CMI_OBJECTIVES_SCORE_GETMINBYINDEX', 'getCmiObjectivesScoreMinByIndex');
define ('CMI_OBJECTIVES_SCORE_SETMINBYINDEX', 'setCmiObjectivesScoreMinByIndex');


// ----------            CMI.Studentdata             ---------------
define ('CMI_STUDENTDATA_GETMASTERYSCORE', 'getCmiStudentDataMasteryScore');
define ('CMI_STUDENTDATA_GETMAXTIMEALLOWED', 'getCmiStudentDataMaxTimeAllowed');
define ('CMI_STUDENTDATA_GETTIMELIMITACTION', 'getCmiStudentDataTimeLimitAction');


// ----------         CMI.Studentpreference          ---------------
define ('CMI_STUDENTPREFERENCE_GETAUDIO', 'getCmiStudentPreferenceAudio');
define ('CMI_STUDENTPREFERENCE_SETAUDIO', 'setCmiStudentPreferenceAudio');
define ('CMI_STUDENTPREFERENCE_GETLANGUAGE', 'getCmiStudentPreferenceLanguage');
define ('CMI_STUDENTPREFERENCE_SETLANGUAGE', 'setCmiStudentPreferenceLanguage');
define ('CMI_STUDENTPREFERENCE_GETSPEED', 'getCmiStudentPreferenceSpeed');
define ('CMI_STUDENTPREFERENCE_SETSPEED', 'setCmiStudentPreferenceSpeed');
define ('CMI_STUDENTPREFERENCE_GETTEXT', 'getCmiStudentPreferenceText');
define ('CMI_STUDENTPREFERENCE_SETTEXT', 'setCmiStudentPreferenceText');


// ----------           CMI.Interactions             ---------------
define ('CMI_INTERACTIONS_GETCOUNT', 'getCmiInteractionsCount');
define ('CMI_INTERACTIONS_SETIDBYINDEX', 'setCmiInteractionsIdByIndex');
define ('CMI_INTERACTIONS_SETTIMEBYINDEX', 'setCmiInteractionsTimeByIndex');
define ('CMI_INTERACTIONS_SETTYPEBYINDEX', 'setCmiInteractionsTypeByIndex');
define ('CMI_INTERACTIONS_SETWEIGHTINGBYINDEX', 'setCmiInteractionsWeightingByIndex');
define ('CMI_INTERACTIONS_SETSTUDENTRESPONSEBYINDEX', 'setCmiInteractionsStudentResponseByIndex');
define ('CMI_INTERACTIONS_SETRESULTBYINDEX', 'setCmiInteractionsResultByIndex');
define ('CMI_INTERACTIONS_SETLATENCYBYINDEX', 'setCmiInteractionsLatencyByIndex');


// ----------      CMI.Interactions.Objectives        ---------------
define ('CMI_INTERACTIONS_OBJECTIVES_GETCOUNT', 'getCmiInteractionsObjectivesCount');
define ('CMI_INTERACTIONS_OBJECTIVES_SETIDBYINDEXES', 'setCmiInteractionsObjectivesIdByIndexes');


// --------     CMI.Interactions.Correctresponses      -------------
define ('CMI_INTERACTIONS_CORRECTRESPONSES_GETCOUNT', 'getCmiInteractionsCorrectResponsesCount');
define ('CMI_INTERACTIONS_CORRECTRESPONSES_SETPATTERNBYINDEXES', 'setCmiInteractionsCorrectResponsesPatternByIndexes');




// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                            CMI                               ##
// ##                                                              ##
// ##################################################################



function getCmiSuspendData ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getSuspendData();
}


function setCmiSuspendData ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 4096))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setSuspendData($value);
  $rel->save();
  return 0;
}


function getCmiLaunchData ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Sco12Peer::ID, $sco_id);
  $rel = Sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getLaunchData();
}


function getCmiComments ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getComments();
}


function setCmiComments ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 4096))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setComments($value);
  $rel->save();
  return 0;
}


function getCmiCommentsFromLMS ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getCommentsFromLms();
}

































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                         CMI.Core                             ##
// ##                                                              ##
// ##################################################################



function getCmiCoreStudentId ($student_id, $sco_id)
{
  return $student_id;
}



function getCmiCoreStudentName ($student_id, $sco_id)
{
  $usuario = UsuarioPeer::RetrieveByPk($student_id);
  //$nombre = $usuario->getNombre().' '.$usuario->getApellidos(); 
  $nombre = $usuario->getApellidos().','.$usuario->getNombre();
  return 's:'.$nombre;
}



function getCmiCoreLessonLocation ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getLessonLocation();
}



function setCmiCoreLessonLocation ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 255))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setLessonLocation($value);
  $rel->save();
  return 0;
}



function getCmiCoreCredit ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return $rel->getCredit();
}



function getCmiCoreLessonStatus ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getLessonStatus();
}



function setCmiCoreLessonStatus ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 255))
  {
    return 1;
  }
  if (!(($value == 'passed') || ($value == 'completed') || ($value == 'failed') || ($value == 'incomplete') || ($value == 'browsed') || ($value == 'not attempted')))
  {
    return 1;
  }
      
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setLessonStatus($value);
  /*
  if ((($value == 'passed') || ($value == 'completed')) && ($rel->getFinishedDate() == null))
  {
    $rel->setFinishedDate(time());
  }*/
  $rel->save();
  return 0;
}



function getCmiCoreEntry ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return $rel->getEntry();
}



function getCmiCoreTotalTime ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getTotalTime();
}



function getCmiCoreLessonMode ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getLessonMode();
}



function setCmiCoreExit ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 255))
  {
    return 1;
  }
  
  if (!(($value == 'time-out') || ($value == 'suspend') || ($value == 'logout') || ($value == '')))
  {
    return 1;
  } 
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setExitvalue($value);
  $rel->save();
  return 0;
}



function setCmiCoreSessionTime ($student_id, $sco_id, $value)
{
  if ((gettype($value) != 'string') || (strlen($value) > 255))
  {
    return 1;
  }
  
  if (cmi_timespan_error($value))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setSessionTime($value);
  $rel->save();
  return 0;
}

































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                      CMI.Core.Score                          ##
// ##                                                              ##
// ##################################################################


function getCmiCoreScoreRaw ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getScoreRaw();
}

function getCmiCoreScoreMax ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return sprintf("s:%01.1f", $rel->getScoreMax());
}

function getCmiCoreScoreMin ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return sprintf("s:%01.1f", $rel->getScoreMin());
}

function setCmiCoreScoreRaw ($student_id, $sco_id, $value)
{
  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }
  
  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setScoreRaw($numero);
  $rel->save();
  
  return 0;
}

function setCmiCoreScoreMax ($student_id, $sco_id, $value)
{
  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }
  
  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setScoreMax($numero);
  $rel->save();
  
  return 0;
}

function setCmiCoreScoreMin ($student_id, $sco_id, $value)
{
  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }

  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }

  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setScoreMin($numero);
  $rel->save();

  return 0;
}

































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                       CMI.Objectives                          ##
// ##                                                              ##
// ##################################################################



function getCmiObjectivesCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  return 's:'.Rel_usuario_objetivo_sco12Peer::DoCount($c);
}


function getCmiObjectivesIdByIndex ($student_id, $sco_id, $index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  if (!$rel)
  {
    return 's:';
  }
  else
  {
    return 's:'.$rel->getRefObjetivo();
  }
}


function setCmiObjectivesIdByIndex ($student_id, $sco_id, $index, $value)
{
  if (strlen($value) > 255)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setRefObjetivo($value);
  }
  else
  {
    $rel = new Rel_usuario_objetivo_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexObjetivo($index);
    $rel->setRefObjetivo($value);
  }
  
  $rel->save();
  
  return 0;
}


function getCmiObjectivesStatusByIndex ($student_id, $sco_id, $index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  if (!$rel)
  {
    return 's:';
  }
  else
  {
    return 's:'.$rel->getStatus();
  }
}


function setCmiObjectivesStatusByIndex ($student_id, $sco_id, $index, $value)
{
  if (!(($value == 'passed') || ($value == 'completed') || ($value == 'incomplete') || ($value == 'failed') || ($value == 'browsed') || ($value == 'not attempted')))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setStatus($value);
  }
  else
  {
    $rel = new Rel_usuario_objetivo_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexObjetivo($index);
    $rel->setStatus($value);
  }
  
  $rel->save();
  
  return 0;
}





























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                    CMI.Objectives.Score                       ##
// ##                                                              ##
// ##################################################################


function getCmiObjectivesScoreRawByIndex ($student_id, $sco_id, $index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  if (!$rel)
  {
    return 's:';
  }
  else
  {
    return 's:'.$rel->getScoreRaw();
  }
}



function setCmiObjectivesScoreRawByIndex ($student_id, $sco_id, $index, $value)
{

  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }
  
  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setScoreRaw($numero);
  }
  else
  {
    $rel = new Rel_usuario_objetivo_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexObjetivo($index);
    $rel->setScoreRaw($numero);
  }
  
  $rel->save();
  
  return 0;
}


function getCmiObjectivesScoreMaxByIndex ($student_id, $sco_id, $index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  if (!$rel)
  {
    return 's:';
  }
  else
  {
    return 's:'.$rel->getScoreMax();
  }
}


function setCmiObjectivesScoreMaxByIndex ($student_id, $sco_id, $index, $value)
{

  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }
  
  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setScoreMax($numero);
  }
  else
  {
    $rel = new Rel_usuario_objetivo_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexObjetivo($index);
    $rel->setScoreMax($numero);
  }
  
  $rel->save();
  
  return 0;
}


function getCmiObjectivesScoreMinByIndex ($student_id, $sco_id, $index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  if (!$rel)
  {
    return 's:';
  }
  else
  {
    return 's:'.$rel->getScoreMin();
  }
}


function setCmiObjectivesScoreMinByIndex ($student_id, $sco_id, $index, $value)
{

  $string = (string) $value;
  if (strlen($value) == 0)
  {
    return 0;
  }
  
  if (!is_CMI_Decimal($string)) 
  {
    return 1;
  }
  
  $numero = (float) $string;
  
  if (($numero < 0) || ($numero > 100))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_objetivo_sco12Peer::INDEX_OBJETIVO, $index);
  $rel = Rel_usuario_objetivo_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setScoreMin($numero);
  }
  else
  {
    $rel = new Rel_usuario_objetivo_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexObjetivo($index);
    $rel->setScoreMin($numero);
  }
  
  $rel->save();
  
  return 0;
}
































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                     CMI.Studentdata                          ##
// ##                                                              ##
// ##################################################################


function getCmiStudentDataMasteryScore ($sco_id)
{
  $sco = Sco12Peer::RetrieveByPk($sco_id);
  return 's:'.$sco->getMasteryScore();
}


function getCmiStudentDataMaxTimeAllowed ($sco_id)
{
  $sco = Sco12Peer::RetrieveByPk($sco_id);
  return 's:'.$sco->getMaxTimeAllowed();
}


function getCmiStudentDataTimeLimitAction ($sco_id)
{
  $sco = Sco12Peer::RetrieveByPk($sco_id);
  return 's:'.$sco->getTimeLimitAction();
}































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                   CMI.Studentpreference                      ##
// ##                                                              ##
// ##################################################################


function getCmiStudentPreferenceAudio ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getPreferenceAudio();
}


function setCmiStudentPreferenceAudio ($student_id, $sco_id, $value)
{

  if (!is_numeric($value))
  {
    return 1;
  }
  
  $numero = (int) $value;
  // Lo recortamos a 100
  if ($numero > 100) {$numero = 100;}
  if ($numero < -1) {$numero = -1;}
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setPreferenceAudio($numero);
  $rel->save();
  
  return 0;
}


function getCmiStudentPreferenceLanguage ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getPreferenceLanguage();
}


function setCmiStudentPreferenceLanguage ($student_id, $sco_id, $value)
{

  if (strlen($value) > 255)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setPreferenceLanguage($value);
  $rel->save();
  
  return 0;
}


function getCmiStudentPreferenceSpeed ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getPreferenceSpeed();
}


function setCmiStudentPreferenceSpeed ($student_id, $sco_id, $value)
{

  if (!is_numeric($value))
  {
    return 1;
  }
  
  $numero = (int) $value;
  // Lo recortamos a 100
  if ($numero > 100) {$numero = 100;}
  if ($numero < -100) {$numero = -100;}
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setPreferenceSpeed($numero);
  $rel->save();
  
  return 0;
}


function getCmiStudentPreferenceText ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  return 's:'.$rel->getPreferenceText();
}


function setCmiStudentPreferenceText ($student_id, $sco_id, $value)
{

  if (!is_numeric($value))
  {
    return 1;
  }
  
  $numero = (int) $value;
  
  if (($numero > 1) || ($numero < -1))
  {
    return 1;
  } 

  
  $c = new Criteria();
  $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco12Peer::ID_SCO12, $sco_id);
  $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
  $rel->setPreferenceText($numero);
  $rel->save();
  
  return 0;
}






























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                      CMI.Interactions                        ##
// ##                                                              ##
// ##################################################################


function getCmiInteractionsCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  return 's:'.Rel_usuario_interaccion_sco12Peer::DoCount($c);
}


function setCmiInteractionsIdByIndex ($student_id, $sco_id, $index, $value)
{
  if (strlen($value) > 255)
  {
    return 1;
  }
  
  
  // Comprobamos que no hay espacios
  $posicion = strrpos($value, ' ');
  if (!($posicion === false)) {return 1;} 
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setRefInteraccion($value);
    $rel->save();
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setRefInteraccion($value);
    $rel->save();
  }
  
  return 0;
}


function setCmiInteractionsTimeByIndex ($student_id, $sco_id, $index, $value)
{
  if (cmi_time_error($value))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setTime($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setTime($value);
  }
  
  $rel->save();
  
  return 0;
}


function setCmiInteractionsTypeByIndex ($student_id, $sco_id, $index, $value)
{
  
  if (($value != 'true-false') && ($value != 'choice') && ($value != 'fill-in') && ($value != 'matching') && ($value != 'performance') && ($value != 'sequencing') && ($value != 'likert') && ($value != 'numeric')) 
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setType($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setType($value);
  }
  
  $rel->save();
  
  return 0;
}


function setCmiInteractionsWeightingByIndex ($student_id, $sco_id, $index, $value)
{
  
  if (!is_CMI_Decimal($value)) 
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setWeighting($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setWeighting($value);
  }
  
  $rel->save();
  
  return 0;
}


function setCmiInteractionsStudentResponseByIndex ($student_id, $sco_id, $index, $value)
{
  
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setStudentResponse($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setStudentResponse($value);
  }
  
  $rel->save();
  
  return 0;
}



function setCmiInteractionsResultByIndex ($student_id, $sco_id, $index, $value)
{
  
  if (($value != 'correct') && ($value != 'wrong') && ($value != 'unanticipated') && ($value != 'neutral') && (!is_numeric($value))) 
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setResult($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setResult($value);
  }
  
  $rel->save();
  
  return 0;
}


function setCmiInteractionsLatencyByIndex ($student_id, $sco_id, $index, $value)
{
  if (cmi_timespan_error($value))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::ID_SCO12, $sco_id);
  $c->add(Rel_usuario_interaccion_sco12Peer::INDEX_INTERACCION, $index);
  $rel = Rel_usuario_interaccion_sco12Peer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setLatency($value);
  }
  else
  {
    $rel = new Rel_usuario_interaccion_sco12();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($index);
    $rel->setLatency($value);
  }
  
  $rel->save();
  
  return 0;
}





























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                CMI.Interactions.Objectives                    ##
// ##                                                              ##
// ##################################################################


function getCmiInteractionsObjectivesCount ($student_id, $sco_id, $indexi)
{
  $c = new Criteria();
  $c->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $student_id);
  $c->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $sco_id);
  $c->add(Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION, $indexi);
  return 's:'.Rel_interaccion_sco12_objetivoPeer::DoCount($c);
}


function setCmiInteractionsObjectivesIdByIndexes ($student_id, $sco_id, $indexi, $indexo, $value)
{
  if (strlen($value) > 255)
  {
    return 1;
  }
  
  // Comprobamos que no hay espacios
  $posicion = strrpos($value, ' ');
  if (!($posicion === false)) {return 1;} 
  
  $c = new Criteria();
  $c->add(Rel_interaccion_sco12_objetivoPeer::ID_USUARIO, $student_id);
  $c->add(Rel_interaccion_sco12_objetivoPeer::ID_SCO12, $sco_id);
  $c->add(Rel_interaccion_sco12_objetivoPeer::INDEX_INTERACCION, $indexi);
  $c->add(Rel_interaccion_sco12_objetivoPeer::INDEX_OBJETIVO, $indexo);
  $rel = Rel_interaccion_sco12_objetivoPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setRefObjetivo($value);
  }
  else
  {
    $rel = new Rel_interaccion_sco12_objetivo();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($indexi);
    $rel->setIndexObjetivo($indexo);
    $rel->setRefObjetivo($value);
  }
  
  $rel->save();
  
  return 0;
}






























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##             CMI.Interactions.Correctresponses                ##
// ##                                                              ##
// ##################################################################


function getCmiInteractionsCorrectResponsesCount ($student_id, $sco_id, $indexi)
{
  $c = new Criteria();
  $c->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $student_id);
  $c->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $sco_id);
  $c->add(Rel_interaccion_sco12_respuestaPeer::INDEX_INTERACCION, $indexi);
  return 's:'.Rel_interaccion_sco12_respuestaPeer::DoCount($c);
}


function setCmiInteractionsCorrectResponsesPatternByIndexes ($student_id, $sco_id, $indexi, $indexcr, $value)
{
  
  $c = new Criteria();
  $c->add(Rel_interaccion_sco12_respuestaPeer::ID_USUARIO, $student_id);
  $c->add(Rel_interaccion_sco12_respuestaPeer::ID_SCO12, $sco_id);
  $c->add(Rel_interaccion_sco12_respuestaPeer::INDEX_INTERACCION, $indexi);
  $c->add(Rel_interaccion_sco12_respuestaPeer::INDEX_RESPUESTA, $indexcr);
  $rel = Rel_interaccion_sco12_respuestaPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $rel->setPattern($value);
  }
  else
  {
    $rel = new Rel_interaccion_sco12_respuesta();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco12($sco_id);
    $rel->setIndexInteraccion($indexi);
    $rel->setIndexRespuesta($indexcr);
    $rel->setPattern($value);
  }

  $rel->save();
  
  return 0;
}


?>
