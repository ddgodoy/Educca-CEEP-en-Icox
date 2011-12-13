httpLoader.cache={}
function httpLoader(sMethod,sURL,fExecDone,sPostData,bSync){var oCache=httpLoader.cache[sURL]
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
httpLoader.cache[sURL]={status:oXH.status,text:oXH.responseText}
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