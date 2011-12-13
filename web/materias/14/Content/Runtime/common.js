
httpLoader.cache={}
function httpLoader(sMethod,sURL,fExecDone,sPostData,bSync,bSkipCache){var oCache=httpLoader.cache[sURL]
if(oCache){if(fExecDone)fExecDone({readyState:4,status:oCache.status,responseText:oCache.text})
return}
var oXH,bDone=false
try{oXH=new ActiveXObject("MSXML2.XMLHTTP")}
catch(oErr){oXH=new ActiveXObject("Microsoft.XMLHTTP")}
oXH.open(sMethod,sURL,!bSync)
oXH.setRequestHeader("Content-type","application/x-www-form-urlencoded")
if(!bSync)oXH.onreadystatechange=invokeDone
try{oXH.send(sPostData)}catch(oErr){handleException()}
if(bSync)invokeDone()
function invokeDone(){if(!bDone&&oXH.readyState==4){if(fExecDone)fExecDone(oXH)
if(!bSkipCache)httpLoader.cache[sURL]={status:oXH.status,text:oXH.responseText}
bDone=true
oXH=null
fExecDone=null}}
function handleException(){if(fExecDone)fExecDone({readyState:4,status:404,responseText:""})
bDone=true
oXH=null
fExecDone=null}}
function getXMLDocument(){var xmlVersions=["MSXML2.DOMDocument.6.0","MSXML2.DOMDocument.3.0","MSXML2.DOMDocument","Microsoft.XMLDOM"]
for(var i=0;i<xmlVersions.length;i++)try{return new ActiveXObject(xmlVersions[i]);}catch(e){}
return null}
function scriptLoader(sURL,fExecDone,fExecFail){var oWin=window,oDoc=oWin.document,sID="scrldr_"+new Date().getTime().toString(36),oScript=oDoc.createElement("script"),bLoaded
oWin[sID]=function(){bLoaded=true
var bSuccess=Array.prototype.shift.call(arguments)
if(bSuccess){fExecDone.apply(oWin,arguments)}else{alert(arguments[0])}
setTimeout(cleanUp,50)}
oScript.setAttribute("type","text/javascript")
oScript.onreadystatechange=function(){if(oScript.readyState=="loaded"){setTimeout(verifyLoad,1000);}}
oScript.onerror=verifyLoad
oScript.setAttribute("src",sURL+(sURL.indexOf("?")>-1?"&":"?")+"f="+sID)
oDoc.body.appendChild(oScript)
function verifyLoad(){if(!bLoaded){if(fExecFail)fExecFail()
cleanUp()}}
function cleanUp(){window[sID]=null
if(oScript&&oScript.parentNode){oScript.parentNode.removeChild(oScript)}}}
var VarInterface={Init:function(oDoc){this.Types.Add("Direct",function(sParam){return sParam;})
this.Types.Add("Custom",function(fParam){return fParam();})
oDoc.body.isVarSupported=function(sVarName){return VarInterface.Variables[sVarName]!==undefined}
oDoc.body.getVarValue=function(sVarName){return VarInterface.Get(sVarName)}},Variables:{},Types:{Add:function(sType,fImplementation){this[sType]=fImplementation;}},Add:function(sVar,sType,vParam){this.Variables[sVar]={Param:vParam,Type:sType}},Get:function(sVar){return this.Types[this.Variables[sVar].Type](this.Variables[sVar].Param)}}
;/*@cc_on @*/
function switchEmbeds(oEl,sState,bKill){var aNavs=oEl.tagName.toLowerCase()=="navbutton"?[oEl]:oEl.getElementsByTagName("navbutton")
for(var iNav=0;iNav<aNavs.length;iNav++){if(sState!="off"&&aNavs[iNav].getAttribute("trigger")=="reveal")try{return aNavs[iNav].revealed();}catch(e){}}
var aPlayers=oEl.tagName.toLowerCase()=="mplayer"?[oEl]:oEl.getElementsByTagName("mplayer")
for(var iPlayer=0;iPlayer<aPlayers.length;iPlayer++){if(sState=="off")try{aPlayers[iPlayer].stop();}catch(e){}
else try{aPlayers[iPlayer].play();}catch(e){}}
var aEmbeds=oEl.tagName=="EMBED"?[oEl]:oEl.getElementsByTagName("embed"),aStates={on:["Play","PlayMovie"],off:["Stop","StopMovie","StopPlay","Rewind"]}[sState]
;/*@if(!@_jscript)@*/ //Avoid calling Rewind when forcing kill(emulation only)
if(bKill&&sState=="off")aStates.length--
;/*@end @*/
for(var iEmbed=0;iEmbed<aEmbeds.length;iEmbed++){var oEmbed=aEmbeds[iEmbed],bSuccess=false
if(oEmbed.parentNode.tagName.toLowerCase()=="mpstage")continue;
if(sState=="off"||oEmbed.parentNode.currentStyle.display!="none"){for(var iCall=0;iCall<aStates.length;iCall++){try{oEmbed[aStates[iCall]]()
bSuccess=true}catch(e){}}}
;/*@if(!@_jscript)@*/ //(emulation only)
if(bKill){oEmbed.style.display="none"
oEmbed.offsetWidth}
else if(!bSuccess&&oEmbed.comptype=="media"){oEmbed.autoStart=sState=="on"?"1":"0"
setTimeout(function(){oEmbed.style.display="none"
oEmbed.offsetWidth
oEmbed.style.display=""},0)}
;/*@end @*/}}
function getPrecision(iNum){return Math.floor(100000*iNum)/100000}
function getFixed(iNum,iPrec){iPrec=iPrec?Math.pow(10,iPrec):100
return Math.round(iPrec*iNum)/iPrec}
function getDuration(sDur){if(/^(-?\d+(?:\.\d+)?)(ms|sec|min)?$/.test(sDur)){var iDur=+RegExp.$1
if(RegExp.$2=="sec")iDur*=1000
if(RegExp.$2=="min")iDur*=60000
return iDur}
return null}
String.prototype.toRX=function(){return this.replace(/[\$\(\)\*\+\.\[\]\?\\\^\{\}\|]/g,"\\$&")}
String.prototype.escapeHTML=function(){return this.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/\"/g,"&quot;").replace(/\'/g,"&#39;")}
if(typeof(cacheURL)=="undefined"){var cacheURL=function(sURL){return sURL}}
function addLink(sId,sHref){var sLink='<link rel="stylesheet" id="'+sId+'" type="text/css"'
if(sHref)return document.write(sLink+' href="'+sHref+'">')
;/*@if(@_jscript)return document.write(sLink+' href="">');/*@end @*/
return document.write(sLink+">")}