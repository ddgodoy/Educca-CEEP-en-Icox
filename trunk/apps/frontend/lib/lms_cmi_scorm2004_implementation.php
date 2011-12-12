<?php
/*
 * 
 * 
 * 
 * 
 * 
// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DE LAS FUNCIONES CMI EN EL LMS           **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 05/07/2009                                     **
// **                                                              **
// ******************************************************************



// ##################################################################
// ##                                                              ##
// ##                   FUNCIONES AUXILIARES                       ##
// ##                                                              ##
// ##################################################################


function time_10_0_to_seconds ($string)
{
  $length = strlen($string);
  
  if ($length < 4) {return -1;}
  
  $ano = substr($string, 0, 4);
  $mes = '01';
  $dia = '01';
  $hora = '00';
  $minuto = '00';
  $segundo = '00';
  
  // *-rem-M?-H?-A?*
  //if ($ano > 2038) || ($ano < 1970) {return -1;}

  if ($length == 4)
  {
    $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
    if ($res === false) {return - 1;}
    return $res;
  }
 
  // Procesamos el mes si es que hay...
  if ($length < 7) {return -1;}
  
  $mes = substr($string, 5, 2);
  
  if ($length == 7)
  {
    $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
    if ($res === false) {return - 1;}
    return $res;
  }
  
  // Procesamos el dia si es que hay...
  if ($length < 10) {return -1;}
  
  $dia = substr($string, 8, 2);
  
  if ($length == 10)
  {
    $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
    if ($res === false) {return - 1;}
    return $res;
  }
  
  // Procesamos la hora si es que hay...
  if ($length < 13) {return -1;}
  
  $hora = substr($string, 11, 2);
  
  if ($length == 13)
  {
    $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
    if ($res === false) {return - 1;}
    return $res;
  }
  
  // Procesamos los minutos si es que hay...
  if ($length < 16) {return -1;}
  
  $minuto = substr($string, 14, 2);
  
  if ($length == 16)
  {
    $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
    if ($res === false) {return - 1;}
    return $res;
  }
  
  // Procesamos los segundos si es que hay...
  if ($length < 19) {return -1;}
  
  $segundo = substr($string, 17, 2);

  $res = strtotime("$ano-$mes-$dia $hora:$minuto:$segundo");
  if ($res === false) {return - 1;}
  return $res;
  
}


function seconds_to_time_10_0 ($seconds)
{ 
  return date('Y-m-d', $seconds).'T'.date('H:i:s', $seconds);
}






function time_10_2_to_seconds ($string)
{
  $length = strlen($string);
  
  $seconds = 0;
  
  $key_characters = array('Y', 'M', 'D', 'T', 'H', 'N', 'S', '.');
  
  if ($length < 1) {return -1;}
  
  if ($string[0] != 'P') {return -1;}
  
  $index = 1;
  $dot_found = false;
  $tfound = false;
  
  for (;;)
  {
  
    $temp_string = '';
    
    for (;;)
    {
      if ($index == $length)
      {
        $last_found = 'eof';
        break;
      }
      
      if (in_array($string[$index], $key_characters, true))
      {
        $last_found = $string[$index];
        $index++;
        break;
      }
      
      $temp_string = $temp_string.$string[$index];
      
      $index++;
    }
    switch ($last_found)
    {
      case 'eof': return intval($seconds);
      break;
      
      case 'Y':
        $temp_int = (integer) $temp_string; 
        $seconds += $temp_int * 31104000;
      break;
      
      case 'M':
        if ($tfound)
        {
          $temp_int = (integer) $temp_string; 
          $seconds += $temp_int * 60;
        }
        else
        {
          $temp_int = (integer) $temp_string; 
          $seconds += $temp_int * 2592000;
        }
      break;
      
      case 'D':
        $temp_int = (integer) $temp_string; 
        $seconds += $temp_int * 86400;
      break;
      
      case 'H':
        $temp_int = (integer) $temp_string; 
        $seconds += $temp_int * 3600;
      break;
      
      case '.':
        $temp_int = (integer) $temp_string; 
        $seconds += $temp_int;
        $dot_found = true;
      break;
      
      case 'S':
        if (!$dot_found)
        {
          $temp_int = (integer) $temp_string; 
          $seconds += $temp_int;
        }
      break;
      
      case 'T':
        $tfound = true;
      break;
      
      default: break;
    }
  }
}



function seconds_to_time_10_2 ($seconds)
{
  $temp = intval($seconds);
  if ($temp < 0) {$temp = $temp * (-1);}
  
  $anos = floor($temp / 31104000);
  $temp = $temp % 31104000;
  
  $meses = floor($temp / 2592000);
  $temp = $temp % 2592000;
  
  $dias = floor($temp / 86400);
  $temp = $temp % 86400;
  
  $horas = floor($temp / 3600);
  $temp = $temp % 3600;
  
  $minutos = floor($temp / 60);
  $temp = $temp % 60;
  
  $segundos = $temp;
  
  
  $string = 'P';
  
  if ($anos) {$string .= $anos.'Y';}
  if ($meses) {$string .= $meses.'M';}
  if ($dias) {$string .= $dias.'D';}
  $string .= 'T';
  if ($horas) {$string .= $horas.'H';}
  if ($minutos) {$string .= $minutos.'M';}
  if ($segundos) {$string .= $segundos.'S';}
  
  return $string;
}




// ##################################################################
// ##                                                              ##
// ##            DEFINICIÓN DE LOS NOMBRES DE FUNCIÓN              ##
// ##                                                              ##
// ##################################################################


// -------------               CMI                 ------------------
define ('CMI_GETCOMPLETIONSTATUS', 'getCmiCompletionStatus');
define ('CMI_SETCOMPLETIONSTATUS', 'setCmiCompletionStatus');
define ('CMI_GETCOMPLETIONTRESHOLD', 'getCmiCompletionTreshold');
define ('CMI_GETCREDIT', 'getCmiCredit');
define ('CMI_GETENTRY', 'getCmiEntry');
define ('CMI_SETEXIT', 'setCmiExit');
define ('CMI_GETLAUNCHDATA', 'getCmiLaunchData');
define ('CMI_GETLEARNERID', 'getCmiLearnerId');
define ('CMI_GETLEARNERNAME', 'getCmiLearnerName');
define ('CMI_GETLOCATION', 'getCmiLocation');
define ('CMI_SETLOCATION', 'setCmiLocation');
define ('CMI_GETMAXTIMEALLOWED', 'getCmiMaxTimeAllowed');
define ('CMI_GETMODE', 'getCmiMode');
define ('CMI_GETPROGRESSMEASURE', 'getCmiProgressMeasure');
define ('CMI_SETPROGRESSMEASURE', 'setCmiProgressMeasure');
define ('CMI_GETSCALEDPASSINGSCORE', 'getCmiScaledPassingScore');
define ('CMI_SETSESSIONTIME', 'setCmiSessionTime');
define ('CMI_GETSUCCESSSTATUS', 'getCmiSuccessStatus');
define ('CMI_SETSUCCESSSTATUS', 'setCmiSuccessStatus');
define ('CMI_GETSUSPENDDATA', 'getCmiSuspendData');
define ('CMI_SETSUSPENDDATA', 'setCmiSuspendData');
define ('CMI_GETTIMELIMITACTION', 'getCmiTimeLimitAction');
define ('CMI_GETTOTALTIME', 'getCmiTotalTime');


// -------------         CMI.Comments_from_learner            ------------------
define ('CMI_LEARNER_COMMENTS_GETCOUNT', 'getCmiLearnerCommentsCount');
define ('CMI_LEARNER_COMMENTS_GETCOMMENT', 'getCmiLearnerCommentsComment');
define ('CMI_LEARNER_COMMENTS_SETCOMMENT', 'setCmiLearnerCommentsComment');
define ('CMI_LEARNER_COMMENTS_GETLOCATION', 'getCmiLearnerCommentsLocation');
define ('CMI_LEARNER_COMMENTS_SETLOCATION', 'setCmiLearnerCommentsLocation');
define ('CMI_LEARNER_COMMENTS_GETTIMESTAMP', 'getCmiLearnerCommentsTimestamp');
define ('CMI_LEARNER_COMMENTS_SETTIMESTAMP', 'setCmiLearnerCommentsTimestamp');


// -------------         CMI.Comments_from_lms           ------------------
define ('CMI_LMS_COMMENTS_GETCOUNT', 'getCmiLmsCommentsCount');
define ('CMI_LMS_COMMENTS_GETCOMMENT', 'getCmiLmsCommentsComment');
define ('CMI_LMS_COMMENTS_SETCOMMENT', 'setCmiLmsCommentsComment');
define ('CMI_LMS_COMMENTS_GETLOCATION', 'getCmiLmsCommentsLocation');
define ('CMI_LMS_COMMENTS_SETLOCATION', 'setCmiLmsCommentsLocation');
define ('CMI_LMS_COMMENTS_GETTIMESTAMP', 'getCmiLmsCommentsTimestamp');
define ('CMI_LMS_COMMENTS_SETTIMESTAMP', 'setCmiLmsCommentsTimestamp');


// -------------         CMI.Interactions           ------------------
define ('CMI_INTERACTIONS_GETCOUNT', 'getCmiInteractionsCount');
define ('CMI_INTERACTIONS_GETID', 'getCmiInteractionsId');
define ('CMI_INTERACTIONS_SETID', 'setCmiInteractionsId');
define ('CMI_INTERACTIONS_GETTYPE', 'getCmiInteractionsType');
define ('CMI_INTERACTIONS_SETTYPE', 'setCmiInteractionsType');
define ('CMI_INTERACTIONS_GETTIMESTAMP', 'getCmiInteractionsTimestamp');
define ('CMI_INTERACTIONS_SETTIMESTAMP', 'setCmiInteractionsTimestamp');
define ('CMI_INTERACTIONS_GETWEIGHTING', 'getCmiInteractionsWeighting');
define ('CMI_INTERACTIONS_SETWEIGHTING', 'setCmiInteractionsWeighting');
define ('CMI_INTERACTIONS_GETLEARNERRESPONSE', 'getCmiInteractionsLearnerResponse');
define ('CMI_INTERACTIONS_SETLEARNERRESPONSE', 'setCmiInteractionsLearnerResponse');
define ('CMI_INTERACTIONS_GETRESULT', 'getCmiInteractionsResult');
define ('CMI_INTERACTIONS_SETRESULT', 'setCmiInteractionsResult');
define ('CMI_INTERACTIONS_GETLATENCY', 'getCmiLatency');
define ('CMI_INTERACTIONS_SETLATENCY', 'setCmiLatency');
define ('CMI_INTERACTIONS_GETDESCRIPTION', 'getCmiInteractionsDescription');
define ('CMI_INTERACTIONS_SETDESCRIPTION', 'setCmiInteractionsDescription');


// -------------         CMI.InteractionObjectives           ------------------
define ('CMI_INTERACTION_OBJECTIVES_GETCOUNT', 'getCmiInteractionObjectivesCount');
define ('CMI_INTERACTION_OBJECTIVES_GETID', 'getCmiInteractionObjectivesId');
define ('CMI_INTERACTION_OBJECTIVES_SETID', 'setCmiInteractionObjectivesId');


// -------------         CMI.InteractionCorrectResponses           ------------------
define ('CMI_INTERACTION_CORRECT_RESPONSES_GETCOUNT', 'getCmiInteractionCorrectResponsesCount');
define ('CMI_INTERACTION_CORRECT_RESPONSES_GETID', 'getCmiInteractionCorrectResponsesPattern');
define ('CMI_INTERACTION_CORRECT_RESPONSES_SETID', 'setCmiInteractionCorrectResponsesPattern');


// -------------         CMI.LearnerPreference           ------------------
define ('CMI_LEARNER_PREFERENCE_GETAUDIOLEVEL', 'getCmiLearnerPreferenceAudioLevel');
define ('CMI_LEARNER_PREFERENCE_SETAUDIOLEVEL', 'setCmiLearnerPreferenceAudioLevel');
define ('CMI_LEARNER_PREFERENCE_GETLANGUAGE', 'getCmiLearnerPreferenceLanguage');
define ('CMI_LEARNER_PREFERENCE_SETLANGUAGE', 'setCmiLearnerPreferenceLanguage');
define ('CMI_LEARNER_PREFERENCE_GETDELIVERYSPEED', 'getCmiLearnerPreferenceDeliverySpeed');
define ('CMI_LEARNER_PREFERENCE_SETDELIVERYSPEED', 'setCmiLearnerPreferenceDeliverySpeed');
define ('CMI_LEARNER_PREFERENCE_GETAUDIOCAPTIONING', 'getCmiLearnerPreferenceAudioCaptioning');
define ('CMI_LEARNER_PREFERENCE_SETAUDIOCAPTIONING', 'setCmiLearnerPreferenceAudioCaptioning');


// -------------         CMI.Score           ------------------
define ('CMI_SCORE_GETSCALED', 'getCmiScoreScaled');
define ('CMI_SCORE_SETSCALED', 'setCmiScoreScaled');
define ('CMI_SCORE_GETRAW', 'getCmiScoreRaw');
define ('CMI_SCORE_SETRAW', 'setCmiScoreRaw');
define ('CMI_SCORE_GETMIN', 'getCmiScoreMin');
define ('CMI_SCORE_SETMIN', 'setCmiScoreMin');
define ('CMI_SCORE_GETMAX', 'getCmiScoreMax');
define ('CMI_SCORE_SETMAX', 'setCmiScoreMax');


// -------------         CMI.Objective.Score           ------------------
define ('CMI_OBJECTIVE_SCORE_GETSCALED', 'getCmiObjectiveScoreScaled');
define ('CMI_OBJECTIVE_SCORE_SETSCALED', 'setCmiObjectiveScoreScaled');
define ('CMI_OBJECTIVE_SCORE_GETRAW', 'getCmiObjectiveScoreRaw');
define ('CMI_OBJECTIVE_SCORE_SETRAW', 'setCmiObjectiveScoreRaw');
define ('CMI_OBJECTIVE_SCORE_GETMIN', 'getCmiObjectiveScoreMin');
define ('CMI_OBJECTIVE_SCORE_SETMIN', 'setCmiObjectiveScoreMin');
define ('CMI_OBJECTIVE_SCORE_GETMAX', 'getCmiObjectiveScoreMax');
define ('CMI_OBJECTIVE_SCORE_SETMAX', 'setCmiObjectiveScoreMax');


// -------------         CMI.Objectives          ------------------
define ('CMI_OBJECTIVES_GETCOUNT', 'getCmiObjectivesCount');
define ('CMI_OBJECTIVES_GETID', 'getCmiObjectivesId');
define ('CMI_OBJECTIVES_SETID', 'setCmiObjectivesId');
define ('CMI_OBJECTIVES_GETSUCCESSSTATUS', 'getCmiObjectivesSuccessStatus');
define ('CMI_OBJECTIVES_SETSUCCESSSTATUS', 'setCmiObjectivesSuccessStatus');
define ('CMI_OBJECTIVES_GETCOMPLETIONSTATUS', 'getCmiObjectivesCompletionStatus');
define ('CMI_OBJECTIVES_SETCOMPLETIONSTATUS', 'setCmiObjectivesCompletionStatus');
define ('CMI_OBJECTIVES_GETPROGRESSMEASURE', 'getCmiObjectivesProgressMeasure');
define ('CMI_OBJECTIVES_SETPROGRESSMEASURE', 'setCmiObjectivesProgressMeasure');
define ('CMI_OBJECTIVES_GETDESCRIPTION', 'getCmiObjectivesDescription');
define ('CMI_OBJECTIVES_SETDESCRIPTION', 'setCmiObjectivesDescription');



































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                            CMI                               ##
// ##                                                              ##
// ##################################################################



function getCmiCompletionStatus ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getCompletionStatus();
}


function setCmiCompletionStatus ($student_id, $sco_id, $value)
{
  if (($value != 'completed') && ($value != 'incomplete') && ($value != 'not_attempted') && ($value != 'unknown'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  
  $rel->setCompletionStatus($value);
  $rel->save();
  return 0;
}


function getCmiCompletionTreshold ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  $val = number_format($sco2004->getCompletionTreshold(), 4, '.', '');
  return 's:'.$val;
}


function getCmiCredit ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  return 's:'.$sco2004->getCredit();
}


function getCmiEntry ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getEntry();
}


function setCmiExit ($student_id, $sco_id, $value)
{
  if (($value != 'timeout') && ($value != 'suspend') && ($value != 'logout') && ($value != 'normal') && ($value != '_nil_'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setExit($value);
  $rel->save();
  return 0;
}


function getCmiLaunchData ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  return 's:'.$sco2004->getLaunchData();
}


function getCmiLearnerId ($student_id, $sco_id)
{
  return $student_id;
}


function getCmiLearnerName ($student_id, $sco_id)
{
  $usuario = UsuarioPeer::RetrieveByPk($student_id);
  $nombre = $usuario->getNombre().' '.$usuario->getApellidos(); 
  return 's:'.$nombre;
}


function getCmiLocation ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getLocation();
}


function setCmiLocation ($student_id, $sco_id, $value)
{
  if (strlen($value) > 1000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setLocation($value);
  $rel->save();
  return 0;
}


function getCmiMaxTimeAllowed ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  return 's:'.$sco2004->getMaxTimeAllowed();
}


function getCmiMode ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getMode();
}


function getCmiProgressMeasure ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getProgressMeasure(), 4, '.', '');
  return 's:'.$val;
}


function setCmiProgressMeasure ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setProgressMeasure($val);
  $rel->save();
  return 0;
}


function getCmiScaledPassingScore ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  $val = number_format( $sco2004->getScaledPassingScore() , 4, '.' , '');
  return 's:'.$val;
}


function setCmiSessionTime ($student_id, $sco_id, $value)
{
  $val = time_10_2_to_seconds($value);
  
  if ($val == -1) {return 1;}
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  
  $rel->setSessionTime($val);
  $rel->save();
  return 0;
}


function getCmiSuccessStatus ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getSuccessStatus();
}


function setCmiSuccessStatus ($student_id, $sco_id, $value)
{
  if (($value != 'passed') && ($value != 'failed') && ($value != 'unknown'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  
  $rel->setSuccessStatus($value);
  $rel->save();
  return 0;
}


function getCmiSuspendData ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getSuspendData();
}


function setCmiSuspendData ($student_id, $sco_id, $value)
{
  if (strlen($value) > 64000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  
  $rel->setSuspendData($value);
  $rel->save();
  return 0;
}


function getCmiTimeLimitAction ($student_id, $sco_id)
{
  $c = new Criteria();
  $sco2004 = Sco2004Peer::retrieveByPk($sco_id);
  return 's:'.$sco2004->getTimeLimitAction();
}


function getCmiTotalTime ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $total_time = seconds_to_time_10_2($rel->getTotalTime());
  return 's:'.$total_time;
}






























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                   CMI.LearnerPreference                      ##
// ##                                                              ##
// ##################################################################



function getCmiLearnerPreferenceAudioLevel ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getAudioLevel(), 4, '.', '');
  return 's:'.$val;
}


function setCmiLearnerPreferenceAudioLevel ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setAudioLevel($val);
  $rel->save();
  return 0;
}


function getCmiLearnerPreferenceLanguage ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getLanguage();
}


function setCmiLearnerPreferenceLanguage ($student_id, $sco_id, $value)
{
  if (strlen($value) > 250)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setLanguage($value);
  $rel->save();
  return 0;
}


function getCmiLearnerPreferenceDeliverySpeed ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getDeliverySpeed(), 4, '.', '');
  return 's:'.$val;
}


function setCmiLearnerPreferenceDeliverySpeed ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setDeliverySpeed($val);
  $rel->save();
  return 0;
}


function getCmiLearnerPreferenceAudioCaptioning ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  return 's:'.$rel->getAudioCaptioning();
}


function setCmiLearnerPreferenceAudioCaptioning ($student_id, $sco_id, $value)
{
  if (strlen($value) > 250)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setAudioCaptioning($value);
  $rel->save();
  return 0;
}




































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                        CMI.Score                             ##
// ##                                                              ##
// ##################################################################


function getCmiScoreScaled ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getScoreScaled(), 4, '.', '');
  return 's:'.$val;
}


function setCmiScoreScaled ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setScoreScaled($val);
  $rel->save();
  return 0;
}


function getCmiScoreRaw ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getScoreRaw(), 4, '.', '');
  return 's:'.$val;
}


function setCmiScoreRaw ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setScoreRaw($val);
  $rel->save();
  return 0;
}


function getCmiScoreMax ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getScoreMax(), 4, '.', '');
  return 's:'.$val;
}


function setCmiScoreMax ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setScoreMax($val);
  $rel->save();
  return 0;
}


function getCmiScoreMin ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $val = number_format($rel->getScoreMin(), 4, '.', '');
  return 's:'.$val;
}


function setCmiScoreMin ($student_id, $sco_id, $value)
{
  $val = (float) $value;
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004Peer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004Peer::ID_SCO2004, $sco_id);
  $rel = Rel_usuario_sco2004Peer::DoSelectOne($c);
  $rel->setScoreMin($val);
  $rel->save();
  return 0;
}

























// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                  CMI.CommentsFromLearner                     ##
// ##                                                              ##
// ##################################################################


function getCmiLearnerCommentsCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  
  return 's:'.Rel_usuario_sco2004_learnercPeer::doCount($c);
}


function getCmiLearnerCommentsComment ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getComment();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLearnerCommentsComment ($student_id, $sco_id, $comment_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_learnercPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_learnerc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setComment($value);
  $rel->save();
  
  return 0;
}


function getCmiLearnerCommentsLocation ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getLocation();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLearnerCommentsLocation ($student_id, $sco_id, $comment_index, $value)
{
  if (strlen($value) > 250)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_learnercPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_learnerc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setLocation($value);
  $rel->save();
  
  return 0;
}


function getCmiLearnerCommentsTimestamp ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $ts = seconds_to_time_10_0($rel->getTstamp());
    return 's:'.$ts;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLearnerCommentsTimestamp ($student_id, $sco_id, $comment_index, $value)
{
  $val = time_10_0_to_seconds($value);
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_learnercPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_learnercPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_learnercPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_learnercPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_learnerc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setTstamp($val);
  $rel->save();
  
  return 0;
}
































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                   CMI.CommentsFromLms                        ##
// ##                                                              ##
// ##################################################################


function getCmiLmsCommentsCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  
  return 's:'.Rel_usuario_sco2004_lmscPeer::doCount($c);
}


function getCmiLmsCommentsComment ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getComment();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLmsCommentsComment ($student_id, $sco_id, $comment_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_lmscPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_lmsc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setComment($value);
  $rel->save();
  
  return 0;
}


function getCmiLmsCommentsLocation ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getLocation();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLmsCommentsLocation ($student_id, $sco_id, $comment_index, $value)
{
  if (strlen($value) > 250)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_lmscPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_lmsc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setLocation($value);
  $rel->save();
  
  return 0;
}


function getCmiLmsCommentsTimestamp ($student_id, $sco_id, $comment_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $ts = seconds_to_time_10_0($rel->getTstamp());
    return 's:'.$ts;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiLmsCommentsTimestamp ($student_id, $sco_id, $comment_index, $value)
{
  $val = time_10_0_to_seconds($value);
  
  if ($val == -1)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_lmscPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_lmscPeer::doCount($c);
  if ($comment_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_lmscPeer::COMMENT_INDEX, $comment_index);
  $rel = Rel_usuario_sco2004_lmscPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_lmsc();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setCommentIndex($comment_index);
  }
  
  $rel->setTstamp($val);
  $rel->save();
  
  return 0;
}
































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                     CMI.Interactions                        ##
// ##                                                              ##
// ##################################################################


function getCmiInteractionsCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  return 's:'.Rel_usuario_sco2004_interactionPeer::doCount($c);
}


function getCmiInteractionsId ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getId();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsId ($student_id, $sco_id, $interaction_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setId($value);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsType ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getType();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsType ($student_id, $sco_id, $interaction_index, $value)
{
  if (
        ($value != 'true_false') && 
        ($value != 'multiple_choice') && 
        ($value != 'fill_in') && 
        ($value != 'long_fill_in') && 
        ($value != 'matching') && 
        ($value != 'performance') && 
        ($value != 'sequence') && 
        ($value != 'likert') && 
        ($value != 'numeric')&& ($value != 'other'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setType($value);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsTimestamp ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $ts = seconds_to_time_10_0($rel->getTstamp());
    return 's:'.$ts;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsTimestamp ($student_id, $sco_id, $interaction_index, $value)
{
  $val = time_10_0_to_seconds($value);
  
  if ($val == -1)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setTstamp($val);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsWeighting ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getWeighting(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsWeighting ($student_id, $sco_id, $interaction_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setWeighting($val);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsLearnerResponse ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getLearnerResponse();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsLearnerResponse ($student_id, $sco_id, $interaction_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setLearnerResponse($value);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsResult ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getResult();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsResult ($student_id, $sco_id, $interaction_index, $value)
{
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setResult($value);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsLatency ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = seconds_to_time_10_2($rel->getLatency());
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsLatency ($student_id, $sco_id, $interaction_index, $value)
{

  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $val = time_10_2_to_seconds($value);
  if ($val == -1)
  {
    return 1;
  }
  $rel->setLatency($val);
  $rel->save();
  
  return 0;
}


function getCmiInteractionsDescription ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getDescription();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionsDescription ($student_id, $sco_id, $interaction_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_interactionPeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_interactionPeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_interactionPeer::INTERACTION_INDEX, $interaction_index);
  $rel = Rel_usuario_sco2004_interactionPeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_interaction();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
  }
  
  $rel->setDescription($value);
  $rel->save();
  
  return 0;
}
































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                 CMI.Interaction.Objectives                   ##
// ##                                                              ##
// ##################################################################


function getCmiInteractionObjetivesCount ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX, $interaction_index);
  
  return 's:'.Rel_usuario_sco2004_iobjectivePeer::doCount($c);
}


function getCmiInteractionObjectivesId ($student_id, $sco_id, $interaction_index, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX, $interaction_index);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_iobjectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getId();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionObjectivesId ($student_id, $sco_id, $interaction_index, $objective_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iobjectivePeer::INTERACTION_INDEX, $interaction_index);
  
  $next_index = Rel_usuario_sco2004_iobjectivePeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  }
  
  $c->add(Rel_usuario_sco2004_iobjectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_iobjectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_iobjective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setId($value);
  $rel->save();
  
  return 0;
}






































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##             CMI.Interaction.CorrectResponses                 ##
// ##                                                              ##
// ##################################################################



function getCmiInteractionCorrectResponsesCount ($student_id, $sco_id, $interaction_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX, $interaction_index);
  
  return 's:'.Rel_usuario_sco2004_iresponsePeer::doCount($c);
}


function getCmiInteractionCorrectResponsesPattern ($student_id, $sco_id, $interaction_index, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX, $interaction_index);
  $c->add(Rel_usuario_sco2004_iresponsePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_iresponsePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getPattern();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiInteractionCorrectResponsesPattern ($student_id, $sco_id, $interaction_index, $objective_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_iresponsePeer::INTERACTION_INDEX, $interaction_index);
  
  $next_index = Rel_usuario_sco2004_iresponsePeer::doCount($c);
  if ($interaction_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_iresponsePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_iresponsePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_iresponse();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setInteractionIndex($interaction_index);
    $rel->setResponseIndex($response_index);
  }
  
  $rel->setPattern($value);
  $rel->save();
  
  return 0;
}






































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                     CMI.Objectives                           ##
// ##                                                              ##
// ##################################################################


function getCmiObjectivesCount ($student_id, $sco_id)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  return 's:'.Rel_usuario_sco2004_objectivePeer::doCount($c);
}


function getCmiObjectivesId ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getId();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesId ($student_id, $sco_id, $objective_index, $value)
{
  if (strlen($value) > 4000)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setId($value);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesSuccessStatus ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getSuccessStatus();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesSuccessStatus ($student_id, $sco_id, $objective_index, $value)
{
  if (($value != 'passed') && ($value != 'failed') && ($value != 'unknown'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setSuccessStatus($value);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesCompletionStatus ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getCompletionStatus();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesCompletionStatus ($student_id, $sco_id, $objective_index, $value)
{
  if (($value != 'completed') && ($value != 'incomplete') && ($value != 'not_attempted') && ($value != 'unknown'))
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setCompletionStatus($value);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesProgressMeasure ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getCompletionStatus(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesProgressMeasure ($student_id, $sco_id, $objective_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setCompletionStatus($val);
  $rel->save();
  
  return 0;
}

function getCmiObjectivesDescription ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    return 's:'.$rel->getDescription();
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesDescription ($student_id, $sco_id, $objective_index, $value)
{
  if (strlen($value) > 250)
  {
    return 1;
  }
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setDescription($value);
  $rel->save();
  
  return 0;
}



































// ##################################################################
// ##                                                              ##
// ##              IMPLEMENTACIÓN DE LAS FUNCIONES                 ##
// ##                                                              ##
// ##                  CMI.Objectives.Score                        ##
// ##                                                              ##
// ##################################################################


function getCmiObjectivesScoreScaled ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getScoreScaled(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesScoreScaled ($student_id, $sco_id, $objective_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setScoreScaled($val);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesScoreRaw ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getScoreRaw(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesScoreRaw ($student_id, $sco_id, $objective_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setScoreRaw($val);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesScoreMax ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getScoreMax(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesScoreMax ($student_id, $sco_id, $objective_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setScoreMax($val);
  $rel->save();
  
  return 0;
}


function getCmiObjectivesScoreMin ($student_id, $sco_id, $objective_index)
{
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if ($rel)
  {
    $val = number_format($rel->getScoreMin(), 4, '.', '');
    return 's:'.$val;
  }
  else
  {
    return 'e:301';
  }
  
}


function setCmiObjectivesScoreMin ($student_id, $sco_id, $objective_index, $value)
{
  $val = (float) $value;
  
  $c = new Criteria();
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_USUARIO, $student_id);
  $c->add(Rel_usuario_sco2004_objectivePeer::ID_SCO2004, $sco_id);
  
  $next_index = Rel_usuario_sco2004_objectivePeer::doCount($c);
  if ($objective_index > $next_index)
  {
    return 1;
  } 
  
  $c->add(Rel_usuario_sco2004_objectivePeer::OBJECTIVE_INDEX, $objective_index);
  $rel = Rel_usuario_sco2004_objectivePeer::DoSelectOne($c);
  
  if (!$rel)
  {
    $rel = new Rel_usuario_sco2004_objective();
    $rel->setIdUsuario($student_id);
    $rel->setIdSco2004($sco_id);
    $rel->setObjectiveIndex($objective_index);
  }
  
  $rel->setScoreMin($val);
  $rel->save();
  
  return 0;
}



*/

?>
