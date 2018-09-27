// requires config.js, windows.js, utils.js, ADL_APIWrapper.js, ADL_SCOFunctions.js,lesson_fill.js
var bSCORMLoaded = false;
var winhndl = null;
var bExtraParameters = true;
var g_LaunchString = "";

function GetPlatformVariables(VariableName)
{
	var objFrame,obj;
	obj = document.getElementById("TmmOcx");
	return obj.GetPlatformVariables();
}
function SetScoreAndTime(Score,ElapsedTime)
{
	//alert("SetScore:"+Score);
	g_Score = Score;
	g_ElapsedTime = ElapsedTime;
}

function SetLessonInfo()
{

	var score,elapsed_time,mastery_score,send_status_to_platform;
	score = "";
	elapsed_time = "";
	send_status_to_platform = "";
	
	try
	{
		if(sNoOcx == "0")
		{
			var sPtfVariables = GetPlatformVariables();
			
			
			
			if(sPtfVariables!="")
			{
				score = getQueryString(sPtfVariables,"score");
				elapsed_time = getQueryString(sPtfVariables,"elapsed_time");
				mastery_score = getQueryString(sPtfVariables,"mastery_score");
				send_status_to_platform = getQueryString(sPtfVariables,"send_status_to_platform");
				if(mastery_score!="")
				{
					g_MasteryScore = mastery_score;
				}

				if(send_status_to_platform!="")
				{
					g_SentStatusToPlatform = send_status_to_platform;
				}
				
			}
		}else
		{
			score = g_Score;
			elapsed_time = g_ElapsedTime;
		}
	}catch(er)
	{
		return false;
	}
	
	//alert("SCORE:"+score);
	SCORM_SetScore(score);
    SCORM_SetElapsedTime(elapsed_time);
	
	if(score!="")
	{
		//alert(score);
		return true;
	}else
	{
		return false;
	}

}


function OnCloseChild(sStatus)
{  

   if(bSCORMLoaded&&(sStatus!=''))
   {
	SCORM_Terminate(sStatus);
	bSCORMLoaded = false;
   }

        
   if(sCloseLauncher=="1")
	window.close();
   
}

// this function is called when we detect that the 
// Portal windows has been closed
function OnClosePortal()
{
	var obj;
	if (navigator.appName.indexOf ("Microsoft") !=-1) {
		obj = document.getElementById("PtfManager");
	}else
	{
		obj = window.document["PtfManager"][1];
	}

	if(obj!=null)
	{
		obj.SetVariable("_finish",true);
		obj.SetVariable("_nState",2); // when using Ptf_Communicator
	}
	
	// if we are using the Ptf_Communicator then start the end proccess
	var objCommunicator;
	
	objCommunicator = document.getElementById("PtfCommunicator");
	
	if(objCommunicator)
	{
		objCommunicator.Finish(g_LaunchString);
	}

	
}

// this function is called at the end by the Flash Object
function FinishClosePortal(sPtfVariables)
{
    // set the score and time comming in sParameters

	var score,elapsed_time,mastery_score,send_status_to_platform;
	if(sPtfVariables!="")
	{
		score = getQueryString(sPtfVariables,"score");
		elapsed_time = getQueryString(sPtfVariables,"elapsed_time");
		mastery_score = getQueryString(sPtfVariables,"mastery_score");
		send_status_to_platform = getQueryString(sPtfVariables,"send_status_to_platform");
		if(mastery_score!="")
		{
			g_MasteryScore = mastery_score;
		}

		if(send_status_to_platform!="")
		{
			g_SentStatusToPlatform = send_status_to_platform;
		}
	}
	
	SCORM_SetScore(score);
	SCORM_SetElapsedTime(elapsed_time);
	
	// Finish the LMS
    if(bSCORMLoaded)
	{
		SCORM_Terminate_Auto();
		bSCORMLoaded = false;
	}
}

function closeTolSide(bTryAgain)
{
    var bLessonSet;
	bLessonSet=false;

	if(bSCORMLoaded)
	{  
	   bLessonSet = SetLessonInfo();
		
	   if(bLessonSet)
	   {
			SCORM_Terminate_Auto();
			bSCORMLoaded = false;
	   }else
	   {
			if(!bTryAgain)
			{   
				SCORM_Terminate_Auto();
				bSCORMLoaded = false;
			}   
	   }
	}
}



function openInNewWindow(sName)
{
	var sActualURL =  document.location.href;
        
   if (sActualURL.indexOf("?")<0)
       sActualURL = sActualURL + "?alredy_new_window=1";
	else 
	    sActualURL = sActualURL + "&alredy_new_window=1";
       
 	
        winhndl = OpenPopupWindow(sActualURL,
   					sName,
				 	bFullScreen,
					800, 
				 	600,
				 	true,
				 	0,
				 	0,
				 	false,
				 	true,
				 	"OnCloseChild('')");
       /* if(sCloseLauncher=="1")
          if(winhndl!=null)
	    setTimeout("OnCloseChild('')",1000);*/

}

function printCloseMessage()
{
      document.write('<table width="100%"  border="0" cellpadding="10" cellspacing="0">');
      document.write('<tr><td width="0%" valign="top" bgcolor="#999999">&nbsp;</td><td width="100%" align="left" valign="top" bgcolor="#C0C0C0">');
      document.write(getString("28709"));
      document.write('</td></tr></table>');

}

function NeedsInstallation(objInstaller, configUrl)
{      try
       {
	var sProcessCmd,failCode;
	sProcessCmd = "url_config_file="+configUrl;
	errorCode = 0;
	errorCode = objInstaller.Process(sProcessCmd);
	failCode = objInstaller.FailTestCode;
	//return true;
	return ((failCode != 0)||(errorCode != 0));
       }catch(ex)
       {
         return true;
	}
}

function Installation(objInstaller, installUrl)
{
	try
	{
		var sProcessCmd,failCode;
		sProcessCmd = "url_config_file="+installUrl;
		errorCode = 0;
		errorCode = objInstaller.Process(sProcessCmd);
		failCode = objInstaller.FailTestCode;
		//return true;
		return ((failCode != 0)||(errorCode != 0));
	}catch(ex)
	{
		return false;
	}
}

function DoLastCheck(sInstallUrl,sActualURL)
{	
	objInstaller = document.getElementById("InstallerCtrl");
	if(Installation(objInstaller, sInstallUrl))
	{
		document.location = sActualURL;
	}else
	{
		document.write(getString("28712"))
	}
}

function GetFirstValues(bReturn)
{
   	var lmsStudent_id = SCORM_GetValue(sSCORMStudentId);
	var lmsStudent_Name = SCORM_GetValue(sSCORMStudentName);
	g_MasteryScore = SCORM_GetMasteryScore();
	var lmsExtraParameters;
	
	
	// bExtraParameters global for all the lessons is defined in the .js
	// sExtraParameters local for this lesson defined in the lesson.xml
	if((bExtraParameters)||(sExtraParameters=="1"))
	{
		lmsExtraParameters = SCORM_GetValue(sSCORMExtraParameters);
		if(lmsExtraParameters!="")
			lmsExtraParameters = "&" + lmsExtraParameters;
	}
	
	lmsExtraParameters = AddCustomVariableToExtraParameters(lmsExtraParameters);
	
	if(g_MasteryScore!="")
	{
		lmsExtraParameters = lmsExtraParameters + "&mastery_score=" + g_MasteryScore;
	}
	
	sValues = "student_id=" + utf8escape(lmsStudent_id) + "&student_name=" + utf8escape(lmsStudent_Name) + lmsExtraParameters;

	
	
	if(bReturn)
	{
		return sValues;
	}else
	{
		var obj;
		if (navigator.appName.indexOf ("Microsoft") !=-1) {
			obj = document.getElementById("PtfManager");
		}else
		{
			obj = window.document["PtfManager"][1];
		}
	
		if(obj!=null)
		{
			obj.SetVariable("_l",sValues);
		}

		return;
	}
}


function openLesson()
{	
   var sDontTestInstallation;
   sDontTestInstallation = QueryString("dont_check_installation");
   var sHref = lesson.getAttribute("href");
   var sRoot = GetRoot(sHref);
   var sConfigUrl = lesson.getAttribute("check_install");
   var sModPtoUrl = lesson.getAttribute("url_pto");
   var sInstallUrl; 
   
	
   if(sModPtoUrl == null)
   {
		sModPtoUrl = sRoot + "/modpto.axrq?";
	}else
   {
		if (sModPtoUrl.indexOf("?")<0)
          sModPtoUrl = sModPtoUrl + "?";
   	else 
          sModPtoUrl = sModPtoUrl + "&";
	}
	if((sConfigUrl==null))
	{
		sConfigUrl="0";
	}
	
	if((sNoOcx != "1")&&(sDontTestInstallation!="1")&&(sConfigUrl!="0"))
	{
		
		var sActualURL =  document.location.href;
        if (sActualURL.indexOf("?")<0)
            sActualURL = sActualURL + "?dont_check_installation=1";
   	    else 
   	        sActualURL = sActualURL + "&dont_check_installation=1";
        
        // instantiate the ocx installer
        var sCodebase;
        sCodebase='		CODEBASE="'+ sRoot + '/bin/Tol9Inst.cab#version=9.0.0.1">';
      
      
      document.write('<table width="100%" height="200"  border="0" cellpadding="10" cellspacing="0">');
      document.write('<tr><td width="0%" valign="top" bgcolor="#999999">&nbsp;</td><td width="100%" align="left" valign="top" bgcolor="#C0C0C0">');
      document.write('<div id="divLoading"> '+ getString("28713") +'</div>');
      document.write('<table cellpadding="0" cellspacing="0"><tr><td>');
      document.write('<OBJECT ID="InstallerCtrl" height="0" width="0"');
      document.write('		CLASSID="CLSID:91D4B4D5-E368-40AB-8F53-A37FA634B471"');
      document.write(sCodebase);
      document.write('</OBJECT>');
      document.write('</td></tr></table>');
      document.write('<div id="divInstall" style="visibility:hidden"><br>'+ getString("28714") +'</div>');
      document.write('</td></tr></table>');
      var objInstaller;
      var bNeedsInstallation;
      bNeedsInstallation=true;
      objInstaller = document.getElementById("InstallerCtrl");
        
		if(objInstaller)
		{
		
			if(sConfigUrl.indexOf("http://")<0)
			{	
				sConfigUrl = sRoot + "/cmd10/modpto.axrq";
				sInstallUrl = sRoot + "/cmd11/modpto.axrq";
			}else
			{
				sInstallUrl=lesson.getAttribute("url_install");
				if(sInstallUrl==null)
				    sInstallUrl = GetRoot(sConfigUrl) + "/cmd11/modpto.axrq";
			}
			if(sConfigUrl.indexOf("http://")<0)
			{
				document.write(getString("28715"));
				return false;
			}
			bNeedsInstallation = NeedsInstallation(objInstaller, sConfigUrl);
		}else
		{
			document.write(getString("28712")); 
			return false;
		}

      if(bNeedsInstallation)
		{
				// Call the installation cmd
				// resize the control to show the install progress
				var objDiv = document.getElementById("divLoading");
                                if(objDiv)
				{
					objDiv.style.visibility='hidden';
				}

				objDiv = document.getElementById("divInstall");
                                if(objDiv)
				{
					objDiv.style.visibility='visible';
				}
				objInstaller.height = 80;
				objInstaller.width = 350;
				
				if(Installation(objInstaller, sInstallUrl))
				{
					document.location = sActualURL;
				}else
				{
					alert(getString("28712"));
					if(Installation(objInstaller, sInstallUrl))
					{
						document.location = sActualURL;
					}else
					{	
						// last oportunity
 						//alert('DoLastCheck('+sInstallUrl+','+sActualURL+')');
                                                setTimeout('DoLastCheck("'+sInstallUrl+'","'+sActualURL+'")',5000);
					}
				}
		}else
		{
			// get the page with  TMMOCX
			document.location = sActualURL;
		}
	}else
	{
	
   	SCORM_Initialize();
	bSCORMLoaded = true;
        
	var lmsFirst = GetFirstValues(true);
    
        //alert(lmsStudent_id);
     	var sClassId = lesson.getAttribute("object_classid");
    
   	var sParamString = lesson.getAttribute("paramstring");
   	
   	var sObjectCodeBase = lesson.getAttribute("object_codebase");
   	var sObjectBase = lesson.getAttribute("object_base");
   	var sFlashBaseUrl =  lesson.getAttribute("flash_baseurl");
   	var sObjectSrc =  lesson.getAttribute("object_src");
   	var sPtfName = lesson.getAttribute('ptf_name'); // TODO: TEST HERE if not PARAMETTERS!!!
	var sClientId = lesson.getAttribute('client_id');
	if(sClientId==null)
		sClientId = "";
   	var sLessonId = lesson.getAttribute('id');

   	if(sParamString != "")
   	{
   		if(sNoOcx == "0") // TODO: enable extra ParamString in flash, problem with GET commands in the Query String
   		{
   		  	if (sHref.indexOf("?")<0)
       		    sHref = sHref + '?' + sParamString;
   	   		else 
   				sHref = sHref + '&' + sParamString;
   		}
   	}
        

	
   	if(sNoOcx == "0")
   	{

   		// write Object TMM
   		var sPtfParametters = lmsFirst + '&srv_cmd_url='+utf8escape(sHref)+'&ptf_name='+sPtfName+'&client_id='+sClientId+'&ptf_lessonid='+sLessonId + '&ptf_local=' + utf8escape(GetRoot(document.location.href));
		if(sILanguageCreation!="")
			sPtfParametters = sPtfParametters + '&ptf_il=' + sILanguageCreation;
        
        
		sPtfParametters = utf8escape(sPtfParametters);
   		var sParam = 'Ptf='+sPtfParametters+'&fullscreen=1&BaseUrl='+ sRoot + sFlashBaseUrl + '&UseHttp=1&UseCache=1';
		
		if(sILanguageCreation!="")
			sParam = sParam + '&_osil=' + sILanguageCreation;
		else
			sParam = sParam + '&_osil=' + sILanguage;
		
   		//sParam = sParam + '&_osttitle=' + utf8escape(getString("31574"))+'&_ostdesc='+utf8escape(getString("31575"))+
   		//         '&_osetitle='+ utf8escape(getString("31580")) + '&_osedesc=' + utf8escape(getString("31581")) + '&_oscanceling=' + utf8escape(getString("31586")) + 
   		//         '&_osstep0=' + utf8escape(getString("31576")) + '&_osstep1=' + utf8escape(getString("31577")) + '&_osstep2=' + utf8escape(getString("31578")) +
   		//         '&_osstep3=' + utf8escape(getString("31579")) + '&_oscancel=' + utf8escape(getString("17026")) + '&_osretry=' + utf8escape(getString("31583")) + 
   		//         '&_osignore=' + utf8escape(getString("31582")) + '&_oscantdl=' + utf8escape(getString("31584"));
   		
   		document.write('<OBJECT ID="TmmOcx" CLASSID="clsid:'+sClassId+'" ');
   		document.write('   CODEBASE="'+sRoot+sObjectCodeBase+'"');
   		document.write('   WIDTH="100%" HEIGHT="100%" >');
   		document.write('	<PARAM NAME="PARAMS" VALUE="'+sParam+'">');
   		document.write('	<PARAM NAME="BASE" VALUE="'+ sRoot + sObjectBase);
   		document.write('	<EMBED NAME="TmmOcx"');
   		document.write('      	SRC="'+sRoot+ sObjectSrc +'"');
   		document.write('      	TYPE="application/x-tell-me-more"');
   		document.write('      	PLUGINSPAGE="'+sRoot+sObjectCodeBase+'"');
   		document.write('      	ALIGN="center"');
   		document.write('      	WIDTH="100%"');
   		document.write('      	HEIGHT="100%"');
   		document.write('      	PARAMS="'+sParam+'"');
   		document.write('      	BASE="'+sRoot+sObjectBase+'">');
   		document.write('     </EMBED>');
   		document.write('</OBJECT>');
   	}else
   	{
   	    var sHrefScaped;
   	    sHrefScaped = escape(sHref);
   	    
   		// write object Flash
   		document.write('<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ');
		document.write('	ID="tmmflash" '); 
	        document.write('	CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,79,0" ');
   		document.write('	WIDTH="100%" ');
   		document.write('	HEIGHT="100%" ');
   		document.write('	ALIGN=""> ');
   		document.write('	<PARAM NAME="movie" VALUE='+ sRoot + sFlashBaseUrl + '?_inOCX=0&_useHttp=1&Ptf='+sHrefScaped+'&_lesson_id='+sLessonId+'&_ptf_name='+sPtfName+'&_client_id='+sClientId+'&_student_id='+lmsStudent_id+'&_SessionDuration=672"> ');
   		document.write('	<PARAM NAME="base" VALUE="'+ sRoot + sObjectBase );
   		document.write('	<PARAM NAME="play" VALUE="true"> ');
   		document.write('	<PARAM NAME="loop" VALUE="false"> ');
   		document.write('	<PARAM NAME="quality" VALUE="high"> ');
   		document.write('	<PARAM NAME="bgcolor" VALUE="#000000"> ');
   		document.write('	<PARAM NAME="scale" VALUE="exactfit"> ');
   		document.write('	<PARAM NAME="menu" VALUE="false"> ');
   		document.write('	<EMBED NAME="tmmflash" ');
   		document.write('		TYPE="application/x-shockwave-flash" ');
   		document.write('		PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" ');
   		document.write('		WIDTH="100%" ');
   		document.write('		HEIGHT="100%" ');
   		document.write('		ALIGN="" ');
   		document.write('		SRC="'+ sRoot + sFlashBaseUrl +'?_inOCX=0&_useHttp=1&Ptf='+sHrefScaped+'&_lesson_id='+sLessonId+'&_ptf_name='+sPtfName+'&_client_id='+sClientId+'&_student_id='+lmsStudent_id+'&_SessionDuration=672" ');
   		document.write('		BASE="'+ sRoot + sObjectBase );
   		document.write('		PLAY="true" ');
   		document.write('		LOOP="false" ');
   		document.write('		QUALITY="high" ');
   		document.write('		BGCOLOR="#000000" ');
   		document.write('		SCALE="exactfit" ');
   		document.write('		MENU="false"> ');
   		document.write('	</EMBED> ');
   		document.write('</OBJECT> '); 
   	} 
	}
	return true;
}

function openDemo()
{   

   var sLesson = lesson.getAttribute("id");
   var sParamString = lesson.getAttribute("paramstring");
   var sLaunchPage = lesson.getAttribute("href");
   
   var sLaunchString = String(sLaunchPage); 

   //printCloseMessage();
   SCORM_Initialize();
   bSCORMLoaded = true;   

   if (sLaunchString.indexOf("?")<0)
        sLaunchString = sLaunchString + "?";
   else 
	sLaunchString = sLaunchString + "&";
   
   sLaunchString =  sLaunchString + "ptf_lessonid=" + utf8escape(sLesson);

   sLaunchString =  sLaunchString + "&ptf_launch_type=" + sLaunchType;

   if (sParamString != null) 
		sLaunchString = sLaunchString + "&" + sParamString;

  if(sILanguageCreation!="")
		sLaunchString = sLaunchString + '&ptf_il=' + sILanguageCreation;

   SCORM_Terminate(sSCORMBrowsed);      
   
   document.location = sLaunchString;
}


function openInfo()
{   

   var sLesson = lesson.getAttribute("id");
   var sParamString = lesson.getAttribute("paramstring");
   var sLaunchPage = lesson.getAttribute("href");
   
   var sLaunchString = String(sLaunchPage); 

   printCloseMessage();
   SCORM_Initialize();
   bSCORMLoaded = true;   

   if (sLaunchString.indexOf("?")<0)
        sLaunchString = sLaunchString + "?";
   else 
	sLaunchString = sLaunchString + "&";
   
   sLaunchString =  sLaunchString + "ptf_lessonid=" + sLesson;

   sLaunchString =  sLaunchString + "&ptf_lessontype=" + sLessonType;

   if (sParamString != null) 
		sLaunchString = sLaunchString + "&" + sParamString;

   // for "Info" type lessons the variable sNewWindows means full or not full screen
   // future version will have a property "fullscreen"

   winhndl = OpenPopupWindow(sLaunchString,
					'tolinfo',
				 	bFullScreen,
					800, 
				 	600,
				 	true,
				 	0,
				 	0,
				 	false,
				 	true,
				 	"OnCloseChild('"+sSCORMBrowsed+"')");
   
	
/*   if(winhndl!=null)
     setTimeout("OnCloseChild('"+sSCORMBrowsed+"')",1000);
   else
     OnCloseChild(sSCORMBrowsed);*/

}

// this function is called by flash at the end of the portal loading process
function openWindowFromFlash(sLaunchString,bParamFullScreen)
{
   if(bParamFullScreen==null)
	bParamFullScreen = bFullScreen;
	
   var bScrolls;
   bScrolls = !bParamFullScreen;
	
   winhndl = OpenPopupWindow(sLaunchString,
					'tolportal',
				 	bParamFullScreen,
					800, 
				 	600,
				 	true,
				 	0,
				 	0,
				 	bScrolls,
				 	true,
				 	"OnClosePortal()");


}

function ChangeStatusTest()
{
	
	var objOcx,objFlash;
	objOcx = document.getElementById("PtfCommunicator");
	
	if (navigator.appName.indexOf ("Microsoft") !=-1) {
		objFlash = document.getElementById("PtfManager");
	}else
	{
		objFlash = window.document["PtfManager"][1];
	}

	if(objFlash!=null)
	{
		objFlash.SetVariable("_nState",1);
	}
	
	this.setTimeout("ChangeStatusTest2()",5000);
	

}



function openLessonWithObject()
{
	//printCloseMessage();
	
   SCORM_Initialize();
   bSCORMLoaded = true;

	var sHref = lesson.getAttribute("href");
	var sRoot = GetRoot(sHref);
	var sParamString = lesson.getAttribute("paramstring");
	var sPtfName = lesson.getAttribute('ptf_name'); // TODO: TEST HERE if not PARAMETTERS!!!
        var sClientId = lesson.getAttribute('client_id');
	if(sClientId==null)
		sClientId = "";
	var sLessonId = lesson.getAttribute('id');
	var sDirCourse = getDirCourse(document.location.href);
	
	var sLaunchString;
        
	sLaunchString =  "_lesson_id=" + sLessonId + "&_server_root=" + utf8escape(sRoot) + "&_TMMurl="+ utf8escape(sHref) + "&_ptf_name=" + sPtfName +'&_client_id=' + sClientId + "&_launch_type=" + sLaunchType + '&_ptf_local=' + utf8escape(sDirCourse);
        
	if(sILanguageCreation!="")
		sLaunchString = sLaunchString + "&_ptf_il=" + sILanguageCreation;
	
	if (sParamString != null) 
		if(sParamString!="")
		    sLaunchString = sLaunchString  + "&" + sParamString;

        // add the localized messages in flash
	var sMsg;
	sMsg = getString("28711");
        if(sMsg!="")
		sLaunchString = sLaunchString + "&_ActiveMessage=" + utf8escape(sMsg); 

	sMsg = getString("10589");
        if(sMsg!="")
		sLaunchString = sLaunchString + "&_WaitMessage=" + utf8escape(sMsg); 

	sMsg = getString("28709");
        if(sMsg!="")
		sLaunchString = sLaunchString + "&_CloseMessage=" + utf8escape(sMsg); 

	sMsg = getString("28706");
        if(sMsg!="")
		sLaunchString = sLaunchString + "&_ErrorMessage=" + utf8escape(sMsg); 
	
	
    if(sNoOcx=="0") // we are using the OCX for communication
		sLaunchString = sLaunchString + "&_UseComOcx=1"; 

	
	

	document.write('<HTML>');
	document.write('<HEAD>');
	document.write('<meta http-equiv=Content-Type content="text/html;  charset=utf-8">');
	document.write('<TITLE>platforms</TITLE>');
	document.write('</HEAD>');
	document.write('<BODY bgcolor="#006699">');
	
	if(sNoOcx=="0")
	{
		document.write('<object WIDTH="0" HEIGHT="0" classid="clsid:515D557B-1D26-4E90-B315-E14C683917FC" id="PtfCommunicator" >');
		document.write('<PARAM NAME=parameters VALUE="'+ sLaunchString + '">');
		document.write('</object>');
		
		document.write('<SCRIPT LANGUAGE=javascript  FOR=PtfCommunicator  EVENT=Finished(task_id)>');
		document.write('PtfCommunicator_Finished(task_id)');
		document.write('<\/SCRIPT>');

		g_LaunchString = sLaunchString + "&_l=" + escape(GetFirstValues(true));
	}


	document.write('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" NAME="PtfManager" ID="PtfManager"');
	document.write('codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"');
	document.write('WIDTH="99%" HEIGHT="99%" ALIGN="">');
	document.write('<PARAM NAME=movie VALUE="'+ sDirCourse +'platforms.swf?' + 
							sLaunchString + '"> <PARAM NAME=base VALUE="../../"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#006699> <EMBED src="'+ sDirCourse +'platforms.swf?'+ sLaunchString +'" quality=high bgcolor=#006699  WIDTH="100%" HEIGHT="100%" NAME="PtfManager" ALIGN=""');
	document.write('TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>');
	document.write('</OBJECT>');
	
	
	document.write('</BODY>');
	document.write('</HTML>');
	


   
}




function openTol(){

   var sAlreadyNewWindow;


   sAlreadyNewWindow = QueryString("alredy_new_window");

   
   if(sLessonType=="4") //info: we dont open SCORM, We dont pass score an time and 
   {
	openInfo();
   }else if (sLessonType=="3") //lesson: We Open SCORM , and pass status information
   {
    // Launch Types
	// 0: Launch a TMM lesson
	// 1: Launch a Demo Lesson
	// Others: Launch Possition test, certification test, Portal.
	if(sLaunchType=="1") 
	{
		openDemo();
	}else
	if(sLaunchType=="0") //Launch
	{
		if(sNewWindow=="1"&&sAlreadyNewWindow!="1")
		{
			printCloseMessage();
			openInNewWindow('tolptf'); 
		}else
		{
			openLesson();
		}
	}else
	{
		openLessonWithObject();
	}
   }
   
	
}


function Load()
{  
   filldata(); 
   openTol();
}

function PrintObjectTag()
{
    Load();
}

//events for PtfCommunicator 

function PtfCommunicator_Finished(task_id)
{
	var objFlash;
	var objOcx;
	
	objOcx = document.getElementById("PtfCommunicator");
	
	var sTrace = objOcx.GetLogText();
	

	if (navigator.appName.indexOf ("Microsoft") !=-1) {
		objFlash = document.getElementById("PtfManager");
	}else
	{
		objFlash = window.document["PtfManager"][1];
	}

	if(objFlash!=null)
		objFlash.SetVariable("_txt_minitracer",sTrace);
		
	if(objOcx.HasErrors()==1)
	{
		if(objFlash!=null)
		{
								
			objFlash.SetVariable("_sExternalErrorCode",objOcx.GetErrorCode());
			var sMsg = objOcx.GetErrorDesc();
				
			objFlash.SetVariable("_sExternalErrorDesc",sMsg);
			objFlash.SetVariable("_nState",4);
			return;
		}
	}
	


	switch(task_id)
	{
		case 0: //finish the load part
		{
			// notify the flash object
			if(objFlash!=null)
			{
				objFlash.SetVariable("_nState",1);
			}
			
			var sFullScreen;
			var sPtfVariables = objOcx.GetOptionsVariables();
			
			sFullScreen = getQueryString(sPtfVariables,"full_screen");
			
			
			// load the URL
			openWindowFromFlash(objOcx.PL(),(sFullScreen=="1"));
		}
		break;
		case 1: //finish the end part
		{
			var score,elapsed_time,mastery_score,send_status_to_platform;
			score = "";
			elapsed_time = "";
			mastery_score = "";
						
			var sPtfVariables = objOcx.GetPlatformVariables();

			if(sPtfVariables!="")
			{
				score = getQueryString(sPtfVariables,"score");
				elapsed_time = getQueryString(sPtfVariables,"elapsed_time");
				mastery_score = getQueryString(sPtfVariables,"mastery_score");
				send_status_to_platform = getQueryString(sPtfVariables,"send_status_to_platform");

				if(mastery_score!="")
				{
					g_MasteryScore = mastery_score;
				}

				if(send_status_to_platform!="")
				{
					g_SentStatusToPlatform = send_status_to_platform;
				}


			}
			
			// set the score and time
			
			SCORM_SetScore(score);
   			SCORM_SetElapsedTime(elapsed_time);
   						
			if(objFlash!=null)
			{
				objFlash.SetVariable("_nState",3);
			}
		}
		break;
	}
	

}


function startCommunication()
{
	var objCommunicator;
	
	objCommunicator = document.getElementById("PtfCommunicator");
	
	// start the comunication only if objCommunicator defined
	// otherwise it means that no Ocx is being used
	if(objCommunicator)
	{
		objCommunicator.Start(g_LaunchString);
	}
	
}



