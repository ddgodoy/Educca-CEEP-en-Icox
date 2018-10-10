function EmuBehavior(xArg){this.elemQueue=[];
this.pendCount=0;
if(typeof xArg=="string"){this.status="uninitialized";
this.parsed=false;
this.file=xArg;
this.loadFromFile();}else{this.status="complete";
this.parsed=false;
for(var sProp in xArg){this[sProp]=xArg[sProp]}}}
EmuBehavior.Cache={}
EmuBehavior.loadBehavior=function(oElem,sFile){if(oElem.behaviorFiles){if(oElem.behaviorFiles[sFile])return}else{oElem.behaviorFiles={}
oElem.behaviorFiles[sFile]=true}
var oEmu=EmuBehavior.Cache[sFile]
if(!oEmu){if(sFile.indexOf("#")==0){alert("Non-supported built-in behavior.")
return}
EmuBehavior.Cache[sFile]=oEmu=new EmuBehavior(sFile)}
oEmu.attachToElement(oElem)}
EmuBehavior.prototype={loadFromFile:function(){this.status="loading"
httpLoader("GET",this.file,Delegate.create(this,"parseFile"))},parseFile:function(oXH){if(oXH.status!=200&&oXH.status!=0){alert("HTC not found: '"+this.file+"'")
return}
var sHTC=oXH.responseText,aScripts=this.scripts=[],aProps=this.props=[],aMethods=this.methods=[]
aScripts.push("var element=arguments[0];")
var rxScript=/<script(?:[^>]*src="([^"]+)")?[^>]*>([\s\S]*?)<\/script>/ig,oScript
while(oScript=rxScript.exec(sHTC)){var sSrc=oScript[1],sScript=oScript[2]
aScripts.push(sScript)
if(sSrc){this.loadScript(sSrc,aScripts.length-1)}}
var aPropNodes=sHTC.match(/<public:(?:emu)?property[^>]*>/ig)
if(aPropNodes){for(var i=0;i<aPropNodes.length;i++){var sProp=aPropNodes[i],sName="",sGetter="",sSetter="",bEmu=false
if(/name="([^"]+)"/.test(sProp))sName=RegExp.$1
if(/get="([^"]+)"/.test(sProp))sGetter=RegExp.$1
if(/put="([^"]+)"/.test(sProp))sSetter=RegExp.$1
if(/^<public:emu/.test(sProp))bEmu=true
if(sName){if(!sGetter||!sSetter)aScripts.push("if (element.hasAttributeNS(\"\",\""+sName+"\")) { var "+sName+"=element.getAttributeNS(\"\",\""+sName+"\"); } else { var "+sName+"; }")
aScripts.push("this.__get_"+sName+"="+(sGetter?sGetter:"function () { return "+sName+"; }")+";")
aScripts.push("this.__set_"+sName+"="+(sSetter?sSetter:"function (val) { "+sName+"=val;"+(bEmu?"element.setAttributeNS(\"\",\""+sName+"\",val);":"")+" }")+";");
aProps.push(sName)}}}
var aMethodNodes=sHTC.match(/<public:method[^>]*>/ig)
if(aMethodNodes){for(var i=0;i<aMethodNodes.length;i++){var sMethod=aMethodNodes[i],sName=""
if(/name="([^"]+)"/.test(sMethod))sName=RegExp.$1
if(sName){aScripts.push("this.__method_"+sName+"="+sName+";")
aMethods.push(sName)}}}
var aEventNodes=sHTC.match(/<public:event[^>]*>/ig)
if(aEventNodes){for(var i=0;i<aEventNodes.length;i++){var sEvent=aEventNodes[i],sName="",sId=""
if(/name="([^"]+)"/.test(sEvent))sName=RegExp.$1
if(/id="([^"]+)"/.test(sEvent))sId=RegExp.$1
if(sName&&sId){aScripts.push("var "+sId+"=new EmuEvent(element,\""+sName+"\");")}}}
var aAttachNodes=sHTC.match(/<public:attach[^>]*>/ig)
if(aAttachNodes){for(var i=0;i<aAttachNodes.length;i++){var sAttach=aAttachNodes[i],sEvent="",sFor="",sOnEvent=""
if(/event="([^"]+)"/.test(sAttach))sEvent=RegExp.$1
if(/for="([^"]+)"/.test(sAttach))sFor=RegExp.$1
if(/onevent="([^"]+)"/.test(sAttach))sOnEvent=RegExp.$1
if(sEvent&&sFor&&sOnEvent){aScripts.push(sFor+".attachEvent(\""+sEvent+"\",function (event) { "+sOnEvent+" });")}}}
if(this.pendCount==0){this.createBehavior()}
this.parsed=true},loadScript:function(sSrc,iIdx){this.pendCount++
httpLoader("GET",sSrc,Delegate.create(this,"parseScript",sSrc,iIdx))},parseScript:function(oXH,sSrc,iIdx){if(oXH.status!=200&&oXH.status!=0){alert("JS not found: '"+sSrc+"' while processing: '"+this.file+"'")
return}
this.scripts[iIdx]=oXH.responseText
this.pendCount--
if(this.pendCount==0&&this.parsed){this.createBehavior()}},createBehavior:function(){var sScript=this.scripts.join("\n")
try{var oClass=this.func=new Function(sScript);}
catch(oErr){this.handleError(oErr,"creation")
return}
this.status="complete"
while(this.elemQueue.length>0){this.attachToElement(this.elemQueue.pop())}},attachToElement:function(oElem){if(this.status=="complete"){var aProps=this.props,aMethods=this.methods
try{var oInstance=new this.func(oElem)}
catch(oErr){this.handleError(oErr,"instantiation")
return}
for(var i=0;i<aProps.length;i++){var sProp=aProps[i]
Adaptie.adaptProperty(oElem,sProp,{get:oInstance["__get_"+sProp],set:oInstance["__set_"+sProp]})
if(oElem.hasAttributeNS("",sProp)){oElem[sProp]=oElem.getAttributeNS("",sProp)}}
for(var i=0;i<aMethods.length;i++){var sMethod=aMethods[i]
oElem[sMethod]=oInstance["__method_"+sMethod]}
oElem.addEventListener("DOMNodeRemoved",function(e){if(e.eventPhase==Event.AT_TARGET){oElem.destroyed=true
if(oElem.id&&window[oElem.id])window[oElem.id]=undefined}},true)
oElem.fireEvent("onemulation")
oElem.fireEvent("oncontentready")
oElem.readyState="complete"
oElem.fireEvent("onreadystatechange")
oElem.behaviorUrns=oElem.behaviorUrns.concat("")
oElem.fireEvent("ondocumentready")
oElem.fireEvent("onemulationdone")}else{oElem.readyState="loading"
this.elemQueue.push(oElem)
if(oElem.currentStyle.visibility!="hidden"){var sVisibility=oElem.currentStyle.visibility
oElem.style.visibility="hidden"
oElem.addEventListener("emulation",function(event){this.style.visibility=sVisibility},false)}}},handleError:function(oErr,sEvent){try{var iLineOffset=183,iLine=oErr.lineNumber-iLineOffset,aLines=this.scripts.join("\n").split(/\n/)
alert("Error on "+sEvent+" of '"+this.file+"': "+oErr.message+
(iLine<aLines.length?"\n\n\t"+aLines[iLine].replace(/^\s+|\s+$/g,""):""))}
catch(oErr){alert("Error on error reporting: "+sEvent)}}}
EmuBehavior.Cache["#default#userData"]=new EmuBehavior({func:function(oElem){var oXML,sDomain=location.hostname,sBase,sProtocol=location.protocol,sPort=location.port,sPath=location.pathname,iSep=sPath.lastIndexOf("/")
if(sDomain.indexOf(".")<0)sDomain+=".localdomain"
if(!sPort)sPort="80"
sBase=sProtocol+sPort+sPath.substr(0,iSep)+"/"
function initXML(){oXML=document.createElement("xml")
oXML.appendChild(oXML.createElement("ROOTSTUB"))}
initXML()
this.__method_load=function(sStoreName){try{if(!sStoreName)return
var sXML=globalStorage[sDomain][sBase+sStoreName]
if(sXML)oXML.loadXML(sXML)
else initXML()}catch(oErr){initXML()}}
this.__method_save=function(sStoreName){try{if(!sStoreName)return
globalStorage[sDomain][sBase+sStoreName]=oXML.xml}catch(oErr){}}
this.__get_XMLDocument=function getXML(){return oXML}
this.__set_XMLDocument=function(oVal){oXML=oVal}},props:["XMLDocument"],methods:["load","save"]})
function EmuEvent(oElem,sEvent){this.fire=function(oEvent){return oElem.fireEvent(sEvent,oEvent)}}
Delegate={create:function(oObj,sFunc){var aDelegArgs=Array.prototype.slice.call(arguments,2)
return function(){var aArgs=Array.prototype.slice.call(arguments,0).concat(aDelegArgs)
oObj[sFunc].apply(oObj,aArgs)}}}
if(window.Adaptie&&Adaptie.canAdapt){try{Adaptie.adaptMethod("HTMLElement","addBehavior",Adaptie.Element.addBehavior=function(sURL){EmuBehavior.loadBehavior(this,sURL)})}catch(e){Adaptie.canAdapt=false}}