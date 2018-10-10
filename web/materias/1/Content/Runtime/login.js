if(!window.Login){window.Login={auth:false,name:null,id:null,_listeners:[],init:function(oDoc){if(this.hasInit)return
this.hasInit=true
var oProject=window.oConfig&&oConfig.firstChild,sBase=oProject&&oProject.getAttribute("runtimeBackend")||"/composica/blogs/",sMode=oProject&&oProject.getAttribute("learnerAuth")
if(!sMode||sMode=="default"){try{var oRunInfo=top.opener.oRunInfo
if(oRunInfo&&oRunInfo.firstChild){sMode=oRunInfo.firstChild.getAttribute("learnerAuth")}}catch(e){}}
this.baseURL=sBase
this.mode=sMode
oDoc.body.detachEvent("onfinishpage",Login.clearListeners)
oDoc.body.attachEvent("onfinishpage",Login.clearListeners)
if(sMode&&this.Modes[sMode])this.Modes[sMode](oDoc)},post:function(oArgs,fFail){if(window.sProjectId&&sProjectId!="Res"){if(oArgs.m=="custom"&&oArgs.u&&oArgs.p&&oArgs.r&&oArgs.p==oArgs.r){Login.set(oArgs.u)}else if(fFail){fFail()}}else{var aArgs=[]
for(var sArg in oArgs){if(oArgs[sArg])aArgs.push(sArg+"="+encodeURIComponent(oArgs[sArg]))}
scriptLoader(this.baseURL+"login.asp?"+aArgs.join("&"),function(sUserName,sUserId){if(sUserName){Login.set(sUserName,sUserId)}else if(fFail){fFail.apply(this,arguments)}})}},set:function(sName,sId){this.auth=true
this.name=sName
this.id=sId
this.dispatch()},unset:function(){this.auth=false
this.name=null
this.id=null},listen:function(oScope,sCallback,aArgs){this._listeners.push({scope:oScope,callback:sCallback,args:aArgs})},unlisten:function(oScope,sCallback,aArgs){for(var i=this._listeners.length;i--;){var oListener=this._listeners[i]
if(oListener.scope==oScope&&oListener.callback==sCallback){this._listeners.splice(i,1)}}},dispatch:function(){for(var i=0;i<this._listeners.length;i++){var oListener=this._listeners[i]
if(oListener.args)oListener.scope[oListener.callback].apply(oListener.scope,oListener.args)
else oListener.scope[oListener.callback]()}},clearListeners:function(){Login._listeners.length=0},Modes:{lms:function(){var sUserId=LMSInterface.GetUserId()
if(sUserId){var sUserName=VarInterface.Get("first name")+" "+VarInterface.Get("last name")
Login.post({m:"lms",u:sUserName,p:sUserId})}},win:function(oDoc){var oDiv=oDoc.createElement("div"),oFrame
oDiv.style.display="none"
oDiv.innerHTML='<iframe src="about:blank" />'
oFrame=oDiv.firstChild
oFrame.attachEvent("onload",function(){Login.post({m:"win"})
setTimeout(function(){oDoc.body.removeChild(oDiv)
oDiv=null
oFrame=null},50)})
oDoc.body.appendChild(oDiv)
oFrame.src=Login.baseURL+"winAuth.asp"},custom:function(){Login.post({m:"custom"})}}}}