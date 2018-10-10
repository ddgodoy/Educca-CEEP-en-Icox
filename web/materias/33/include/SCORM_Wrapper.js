
// JavaScript Document
// wrapper functions for SCORM 1.2
// AURALOG

// Not implemented for SCORM 2004
var SCORM_CORE_CHILDREN = "cmi.core._children";  // change all to this standard
var SCORM_STUDENT_DATA_CHILDREN = "cmi.student_data._children";  

// Not standart implementation
var sSCORMExtraParameters = "cmi.student_data.extra_parameters";

// Standart implementation
var sSCORMStudentId = "cmi.core.student_id";
var sSCORMStudentName = "cmi.core.student_name";
var sSCORMTime = "cmi.core.session_time";
var sSCORMScore = "cmi.core.score.raw";
var sSCORMMasteryScore = "cmi.student_data.mastery_score";
var sSCORMIncomplete = "incomplete";
var sSCORMPassed = "passed";
var sSCORMComplete = "complete";
var sSCORMBrowsed = "browsed";
var sSCORMLessonStatus = "cmi.core.lesson_status";
var bTOLDebug = false;
var bScormDebug = false;


function SCORM_Initialize()
{
	if(bTOLDebug)
	{
		alert("SCORM_Initialize()");
		return true;
	}else
	{
		if(bScormDebug)
		{
			alert("LMSInitialize()");
		}
		LMSInitialize();
		if(bScormDebug)
		{
			alert("End LMSInitialize()");
		}
		
		return true;
	}
}

function SCORM_GetValue(sValue)
{

	if(bTOLDebug)
	{	
		alert("SCORM_GetValue(" + sValue + ")");
		if(sValue==sSCORMStudentId)
		{
			return "test";
		}else if(sValue==sSCORMExtraParameters)
		{
			return "e_mail=test@domain.com";
		}else if(sValue==sSCORMStudentName)
		{
			return "LastName,  Name.M";
		}else
		{
			return "";
		}
	}else
	{	
		var coreChildren = doLMSGetValue(SCORM_CORE_CHILDREN); // Not valid for SCORM 2004
		var pos = sValue.lastIndexOf(".");
		var sValueTemp = sValue.substr(pos+1);
		if(coreChildren)
		{
			var n = coreChildren.indexOf(sValueTemp);
			if(bScormDebug)	
			{
				alert("SCORM_CORE_CHILDREN "+ coreChildren);
				alert("Getvalue : " + sValue + "=" + doLMSGetValue(sValue));
			}
			if(n!=-1)
			{	
				return doLMSGetValue(sValue);
			}else
			{
				return "";
			}
		}else
		{
			if((sValue==sSCORMStudentId)||(sValue==sSCORMStudentName)||(sValue==sSCORMTime)||(sValue==sSCORMScore)||(sValue==sSCORMLessonStatus))
			{
				return doLMSGetValue(sValue);
			}else
			{	
				return "";
			}
		}
	}
}

function SCORM_GetMasteryScore()
{
	
	sValue = sSCORMMasteryScore;
	
	if(bTOLDebug)
	{	
		alert("SCORM_GetMasteryScore()");
		return "90";
	}else
	{	
		var coreChildren = doLMSGetValue(SCORM_STUDENT_DATA_CHILDREN); // Not valid for SCORM 2004
		var pos = sValue.lastIndexOf(".");
		var sValueTemp = sValue.substr(pos+1);
		if(coreChildren)
		{
			var n = coreChildren.indexOf(sValueTemp);
			if(bScormDebug)	
			{
				alert("SCORM_STUDENT_DATA_CHILDREN "+ coreChildren);
				alert("Getvalue : " + sValue + "=" + doLMSGetValue(sValue));
			}
			if(n!=-1)
			{	
				return doLMSGetValue(sValue);
			}else
			{
				return "";
			}
		}else
		{
			return "";
		}
	}

}

function SCORM_SetValue(sKey,sValue)
{	
	if(bTOLDebug)
	{
		alert("Set value " + sKey + "=" + sValue);
	}else
	{
		if(bScormDebug)	
		{
			alert("Setvalue : " + sKey + "=" + sValue);
		}

		return doLMSSetValue(sKey,sValue);
	}
}

function SCORM_Terminate_Auto()
{  	
	if(bTOLDebug)
	{
		alert("SCORM_Terminate("+g_Score+","+g_MasteryScore+")");
		return true;
	}else
	{
		if(bScormDebug)
		{
			alert("SCORM_Terminate("+g_Score+","+g_MasteryScore+");");
		}
		var status = sSCORMIncomplete;
		if(is_numeric(g_MasteryScore))
		{
			if(is_numeric(g_Score))
			{
				if((parseInt(g_MasteryScore, 10)<=parseInt(g_Score, 10))&&(g_SentStatusToPlatform=="1"))
				{
					status = sSCORMPassed;
				}
			}
			
		}
		return SCORM_Terminate(status);
		
	}
}

function SCORM_Terminate(status)
{  	
	if(bTOLDebug)
	{
		alert("SCORM_Terminate("+status+")");
		return true;
	}else
	{
		if(bScormDebug)
		{
			alert("unloadPage("+status+");");
		}
		unloadPage(status); // TODO: verify return code problem with diffetent APIs from ADL
		return true;
	}
}


function SCORM_SetScore(Score)
{
   g_Score = Score;
   if(Score!="")
   {
      if(Score>=0)
		if(bScormDebug)
		{
			alert("SCORM_SetValue("+sSCORMScore+","+Score+");");
		}
         return SCORM_SetValue(sSCORMScore,Score);
   }
   
   return false;
}

function SCORM_SetElapsedTime(ElapsedTime)
{
  if(ElapsedTime!="")
  {
		if(bScormDebug)
		{
			alert("SCORM_SetValue("+sSCORMTime+","+ElapsedTime+");");
		}
       return SCORM_SetValue(sSCORMTime,ElapsedTime);
  }
  
  return false;

}