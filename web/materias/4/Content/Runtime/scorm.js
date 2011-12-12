/*@cc_on @*/
;/*@if(@debugMode)
var LMSDebug={Init:function(){this.debugWin=window.open("javascript:'<h1>LMS Debug - SCORM 1.2</h1><ol id=debugList style=\"font-family:arial;font-size:10pt\"></ol>'","debugWin","menu=0,location=0,width=500,height=700,scrollbars=1")},Errors:function(){var sErr=LMSInterface.API.LMSGetLastError(),sErrStr="Unknown error",sErrDiag="No diagnostic"
if(sErr!=0){try{sErrStr=LMSInterface.API.LMSGetErrorString(sErr);}catch(e){}
try{sErrDiag=LMSInterface.API.LMSGetDiagnostic(sErr);}catch(e){}
LMSDebug.Out("LMS reported an error, details: #"+sErr+", "+sErrStr+", "+sErrDiag)}},Queue:[],Out:function(msg,giveUp){if(this.debugWin&&!this.debugWin.closed){if(!this.debugWin.debugList){setTimeout(function(){LMSDebug.Out();},100)
if(msg)this.Queue.unshift(msg)
return}
for(var i=this.Queue.length;i--;)this.debugWin.debugList.appendChild(this.debugWin.document.createElement("LI")).appendChild(this.debugWin.document.createTextNode(this.Queue[i]))
this.Queue.length=0
if(msg)this.debugWin.debugList.appendChild(this.debugWin.document.createElement("LI")).appendChild(this.debugWin.document.createTextNode(msg))
this.debugWin.document.body.scrollTop=this.debugWin.document.body.scrollHeight}else{if(!giveUp){this.Init()
this.Out(msg,true)}else{alert("Debug window couldn't be initialized")}}}}
;/*@end @*/
var LMSInterface={API:null,Status:"not attempted",StartTime:new Date().getTime(),Init:function(){var oWin=top,oAPIWin=false
while(true){var oAPIWin=this.SearchAPI(oWin)
if(!oAPIWin&&oWin.opener){try{oWin=oWin.opener.top}catch(oErr){break}}
else break}
this.API=oAPIWin.API||false
this.Track=oConfig.firstChild.getAttribute("tracking")=="true"&&location.href.indexOf("http")==0
if(this.API){;/*@if(@debugMode)LMSDebug.Out("SCORM API found, calling initialize");/*@end @*/
try{var bInit=this.API.LMSInitialize("")
this.RegisterVariableInterface()
window.API={LMSGetLastError:function(){return LMSInterface.API.LMSGetLastError();},LMSGetErrorString:function(sErr){return LMSInterface.API.LMSGetErrorString(sErr);},LMSGetDiagnostic:function(sErr){return LMSInterface.API.LMSGetDiagnostic(sErr);},LMSGetValue:function(sProp){return LMSInterface.API.LMSGetValue(sProp);},LMSSetValue:function(sProp,sValue){return LMSInterface.API.LMSSetValue(sProp,sValue);},LMSInitialize:function(){return true;},LMSFinish:function(){return true;}}
try{if(parent&&!parent.API)parent.API=window.API;}catch(e){}}catch(oErr){;/*@if(@debugMode)LMSDebug.Out("LMSInitialize threw an exception, turning off SCORM");/*@end @*/
alert("A student tracking interface was detected (SCORM), but did not properly respond. This session will not be tracked. Please contact an administrator.")
this.API=null}
;/*@if(@debugMode)
LMSDebug.Out("LMSInitialize result was: "+bInit)
LMSDebug.Errors()
;/*@end @*/}else{;/*@if(@debugMode)LMSDebug.Out("SCORM API not found");/*@end @*/}
if(this.API||this.Track){this.SetDefaults()
onbeforeunload=this.Dispose}},SearchAPI:function(oWin){try{if(oWin.API)return oWin;}catch(oErr){}
try{for(var iFrame=0;iFrame<oWin.frames.length;iFrame++){try{var oFrame=this.SearchAPI(oWin.frames[iFrame])
if(oFrame)return oFrame}catch(oErr){}}}catch(oErr){}
return false},RegisterVariableInterface:function(){VarInterface.Types.Add("Scorm",LMSInterface.GetVariable)
VarInterface.Add("first name","Custom",function(){return getNamePart(1,"cmi.core.student_name");})
VarInterface.Add("last name","Custom",function(){return getNamePart(0,"cmi.core.student_name");})
VarInterface.Add("middle name","Custom",function(){return getNamePart(2,"cmi.core.student_name");})
VarInterface.Add("total hours","Custom",function(){return getTimePart(0,"cmi.core.total_time",LMSInterface.GetSessionTime())})
VarInterface.Add("total minutes","Custom",function(){return getTimePart(1,"cmi.core.total_time",LMSInterface.GetSessionTime())})
VarInterface.Add("current hours","Custom",function(){return getTimePart(0,LMSInterface.GetSessionTime())})
VarInterface.Add("current minutes","Custom",function(){return getTimePart(1,LMSInterface.GetSessionTime())})
VarInterface.Add("global score","Scorm","cmi.core.score.raw")
VarInterface.Add("status","Scorm","cmi.core.lesson_status")
function getNamePart(iIndex,sVarName){var sName=LMSInterface.GetVariable(sVarName);
if(sName!=null)return sName.split(/,? /g)[iIndex]
return null}
function getTimePart(iIndex,sVarName,sAdd){var sTime=LMSInterface.GetVariable(sVarName);
if(!sTime)return null
if(sAdd){var aAdd=sAdd.split(":"),aTime=sTime.split(":")
aTime[0]=+aTime[0]+aAdd[0]*1
aTime[1]=+aTime[1]+aAdd[1]*1
if(aTime[1]>59){aTime[0]++
aTime[1]-=60}
sTime=aTime.join(":")}
return sTime.split(":")[iIndex]}},GetSessionTime:function(){var iTimeSpent=(new Date().getTime()-LMSInterface.StartTime)/1000/60,iHours=Math.floor(iTimeSpent/60),iMinutes=Math.floor(iTimeSpent%60)
if(iHours<10)iHours="0"+iHours
if(iMinutes<10)iMinutes="0"+iMinutes
return iHours+":"+iMinutes+":00"},ResetObjective:function(oTestNode){if(!this.API)return null;
var iIdx=oTestNode.getAttribute("scormIndex")
if(iIdx!=null){var sObv="cmi.objectives."+iIdx
this.SetVariable(sObv+".score.raw","0")
this.SetVariable(sObv+".status","not attempted")}},GetIndexById:function(sBag,sId){sBag+="."
var iCount=this.GetVariable(sBag+"_count")
if(iCount===null)return null;
for(var iItem=0;iItem<iCount;iItem++){var sCurId=this.GetVariable(sBag+iItem+".id")
if(sCurId==sId)return iItem
if(sCurId=="")this.FilterId.unique=true;}
return iCount},RegisterObjective:function(oTestNode){if(!this.API)return null;
var iIdx=this.GetIndexById("cmi.objectives",this.FilterId(oTestNode))
if(iIdx==null)return null;
var sObv="cmi.objectives."+iIdx
this.SetVariable(sObv+".id",this.FilterId(oTestNode))
this.SetVariable(sObv+".score.raw",oTestNode.getAttribute("totalscore"))
this.SetVariable(sObv+".score.max","100")
this.SetVariable(sObv+".score.min","0")
this.SetVariable(sObv+".status",oTestNode.getAttribute("status"))
oTestNode.setAttribute("scormIndex",iIdx)},ResetInteraction:function(oNavNode){if(!this.API)return null;
var iIdx=oNavNode.getAttribute("scormIndex")
if(iIdx!=null){var sIrn="cmi.interactions."+iIdx
this.SetVariable(sIrn+".time","00:00:00")
this.SetVariable(sIrn+".result","neutral")}},RegisterInteraction:function(oNavNode,iTotal,iCorrect,sType){if(!this.API||this.GetVariable("cmi.interactions._count")==null)return null;
if(!this.ActivityIndex)this.ActivityIndex=0;
var iOldIdx=oNavNode.getAttribute("scormIndex"),iIdx=iOldIdx==null?this.ActivityIndex:iOldIdx
var sIrn="cmi.interactions."+iIdx
this.SetVariable(sIrn+".id",this.FilterId(oNavNode))
var dTime=new Date()
function pad(iNum){return iNum<10?"0"+iNum:iNum;}
this.SetVariable(sIrn+".time",pad(dTime.getHours())+":"+pad(dTime.getMinutes())+":"+pad(dTime.getSeconds()))
if(oNavNode.parentNode.tagName=="section"){this.SetVariable(sIrn+".objectives.0.id",this.FilterId(oNavNode.parentNode.parentNode))
this.SetVariable(sIrn+".weighting",oNavNode.getAttribute("maxScore"))}else{this.SetVariable(sIrn+".weighting","0")}
var oTypes={dragdrop:"matching",fillblank:"fill-in",multichoice:"choice"}
this.SetVariable(sIrn+".type",oTypes[sType]||"choice")
var sResult="wrong"
if(iCorrect>0){sResult=iTotal==iCorrect?"correct":Math.round((iCorrect/iTotal)*100)}
this.SetVariable(sIrn+".result",sResult||"neutral")
oNavNode.setAttribute("scormIndex",iIdx)
this.ActivityIndex++},FilterId:function(oNavNode){return oNavNode.getAttribute("title").replace(/\b[a-z]/g,function(sMatch){return sMatch.toUpperCase();}).replace(/[^0-9a-zA-Z]/g,"")+
"UID"+oNavNode.getAttribute("id").replace(/[^a-z0-9]/gi,"V")+
(arguments.callee.unique?new Date().getTime().toString(36):"")},SetDefaults:function(){this.SetVariable("cmi.core.score.max","100")
this.SetVariable("cmi.core.score.min","0")
var sStatus=this.GetVariable("cmi.core.lesson_status")
if(sStatus)this.Status=sStatus
if(!sStatus||sStatus=="not attempted"||sStatus=="browsed"){this.Status="incomplete"
this.SetVariable("cmi.core.lesson_status","incomplete")}},GetVariable:function(sVarName){if(!LMSInterface.API)return null
var sValue=LMSInterface.API.LMSGetValue(sVarName)
;/*@if(@debugMode)
LMSDebug.Out("GetValue "+sVarName+" ("+sValue+")")
LMSDebug.Errors()
;/*@end @*/
return LMSInterface.API.LMSGetLastError()==0?sValue:null},SetVariable:function(sVarName,sValue){if(!LMSInterface.API)return null
var bSuccess=LMSInterface.API.LMSSetValue(sVarName,sValue+"")
;/*@if(@debugMode)
LMSDebug.Out("SetValue "+sVarName+" = "+sValue+" ("+bSuccess+")")
LMSDebug.Errors()
;/*@end @*/
return bSuccess&&LMSInterface.API.LMSGetLastError()==0},Dispose:function(){if(!LMSInterface.API&&!LMSInterface.Track)return null
LMSInterface.SetVariable("cmi.core.session_time",LMSInterface.GetSessionTime())
var oTests=oConfig.selectNodes("//structure//test"),sMarker=oConfig.firstChild.getAttribute("lessonStatus")||"normal",sCondition=oConfig.firstChild.getAttribute("lessonCondition")||"normal",iSum=0,iCount=0,bPass="passed",bVisitedAll=VarInterface.Get("total done")>=VarInterface.Get("total pages"),Track={}
for(var iTest=0;iTest<oTests.length;iTest++){if(oTests[iTest].getAttribute("globalScore")!="false"){iCount++
iSum+=oTests[iTest].getAttribute("totalscore")*1
if(oTests[iTest].getAttribute("status")!="passed")bPass="failed";}}
var finalStatus="ignore"
if(bPass=="failed")finalStatus=false
if((sCondition=="normal"&&((!iCount&&bVisitedAll)||(iCount&&bPass=="passed")))||(sCondition=="passed|any"&&bPass=="passed")||(sCondition=="viewed+passed"&&bVisitedAll&&bPass=="passed")){finalStatus=true}
if(finalStatus!="ignore"){if(iCount&&sMarker=="normal")finalStatus=bPass
else finalStatus=finalStatus?"completed":"incomplete"
LMSInterface.SetVariable("cmi.core.lesson_status",finalStatus)
LMSInterface.Status=finalStatus}
if(iCount){LMSInterface.SetVariable("cmi.core.score.raw",Math.round(iSum/iCount).toString())
if(LMSInterface.Track){Track.score=Math.round(iSum/iCount).toString()}}
if(LMSInterface.Track){Track.student=VarInterface.Get("composica_student_id")||""
Track.start=new Date(LMSInterface.StartTime).toString()
Track.end=new Date().toString()
Track.status=LMSInterface.Status
var sMode=oConfig.firstChild.getAttribute("courseMode"),sOrigId=oConfig.firstChild.getAttribute("publicId"),sPost=""
for(var sKey in Track)sPost+=sKey+"="+encodeURIComponent(Track[sKey])+"&"
httpLoader("POST",sMode=="web"?"../../Track/record.asp?p="+encodeURIComponent(sOrigId):"Runtime/Track/record.asp",function(oXH){if(oXH.responseText!="SUCCESS"){alert("The server could not track your learning performance:\r\n\r\n"+oXH.responseText)}},sPost,true)}
if(LMSInterface.API){;/*@if(@debugMode)LMSDebug.Out("Done, calling finish");/*@end @*/
var bFin=LMSInterface.API.LMSFinish("")
;/*@if(@debugMode)
LMSDebug.Out("LMSFinish result was: "+bFin)
LMSDebug.Errors()
;/*@end @*/}}}