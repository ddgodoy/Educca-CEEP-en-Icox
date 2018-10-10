/*@cc_on @*/
if(oCourse.contentWindow)oCourse=oCourse.contentWindow
oCourse.location.href="runtime.html"+location.href.replace(/^[^?]+/,"")
var oCourseFrame=document.all.oCourse,oBD=document.body,defWidth,defHeight,iChromeHeight=0,iChromeWidth=0,winTooSmall,winTooLarge,bCanZoom=oCourseFrame.currentStyle.zoom!==undefined,bAccessTop=false,bLocal=false
try{if(top.document){bAccessTop=true
bLocal=/[\/\\]run\.hta$/i.test(top.location.pathname)}}catch(e){}
function scaleInit(){if(!oCourse.oMasterContent||!oCourse.oMenuContent)return setTimeout(scaleInit,100)
var oPrj=oCourse.oConfig.firstChild
if(bAccessTop)top.document.title=oPrj.getAttribute("title")
defWidth=+oPrj.getAttribute("windowWidth")
defHeight=+oPrj.getAttribute("windowHeight")
var winType=oPrj.getAttribute("windowType")
sizeMatch=bLocal&&winType!="max"||winType==null||winType=="new"||winType.indexOf("resize")>-1
winTooSmall=(location.href.indexOf("forcezoom=1")!=-1)?"zoom":(oPrj.getAttribute("windowTooSmall")||"zoom")
winTooLarge=oPrj.getAttribute("windowTooLarge")||"zoom"
if(sizeMatch&&bAccessTop&&(top==window||(top.document.body.clientWidth==document.body.offsetWidth&&top.document.body.clientHeight==document.body.offsetHeight)||bLocal)){ensureWinSize(defWidth,defHeight)
var iWidthDif=(screen.availWidth-iChromeWidth)/defWidth,iHeightDif=(screen.availHeight-iChromeHeight)/defHeight
if(iWidthDif<1||iHeightDif<1){var iScale=iWidthDif>iHeightDif?iHeightDif:iWidthDif,iFinWidth=Math.round(defWidth*iScale)+iChromeWidth,iFinHeight=Math.round(defHeight*iScale)+iChromeHeight
top.moveTo(Math.round((screen.availWidth-iFinWidth)/2),Math.round((screen.availHeight-iFinHeight)/2))
top.resizeTo(iFinWidth,iFinHeight)
scaleContent()}}else{scaleContent()}
window.attachEvent("onresize",scaleContent)
oCourse.attachEvent("onresize",scaleContent)
oCourse.attachEvent("onunload",reloadScaler)
oCourse.oDocContent.attachEvent("onpropertychange",checkScaleRequired)
oCourse.oMasterContent.attachEvent("onpropertychange",checkScaleRequired)
oCourse.oMenuContent.attachEvent("onpropertychange",checkScaleRequired)
if(oPrj.getAttribute("allowSelection")!="true"){;/*@if(@_jscript)@*/ //IE only
document.attachEvent("onselectstart",disableDefault)
document.attachEvent("ondragstart",disableDefault)
oCourse.document.attachEvent("onselectstart",disableDefault)
oCourse.document.attachEvent("ondragstart",disableDefault)
;/*@else @*/ //Emulation only
document.body.style.MozUserSelect="none"
oCourse.document.body.style.MozUserSelect="none"
;/*@end @*/}
if(oPrj.getAttribute("allowContextMenu")!="true"){document.attachEvent("oncontextmenu",disableDefault)
oCourse.document.attachEvent("oncontextmenu",disableDefault)}
if(oPrj.getAttribute("disableClearType")=="true"){oCourse.document.body.style.filter="revealTrans(duration=0)"}
var bgColor=oPrj.getAttribute("windowBackColor")||"gray"
oCourse.document.body.style.backgroundColor=bgColor
document.body.style.backgroundColor=bgColor
if(winType=="max")document.body.style.borderWidth=0
oInitLoader.style.visibility="hidden"
oCourseFrame.style.visibility="visible"}
var CacheManager={isCapable:function(oPrj){if(bLocal)return false
this.cacheAhead=+(oPrj.getAttribute("cacheAhead")||3)
if(this.cacheAhead==0)return false
this.schemeNode=oPrj.selectSingleNode("config/cacheScheme")
if(!this.schemeNode||!this.schemeNode.getAttribute("data"))return false
this.capable=true
return true},init:function(aIdsToCache,fCallback){if(this.capable||this.isCapable()){this.scheme=this.parse(this.schemeNode.getAttribute("data"))
this.dump=document.body.appendChild(document.createElement("div"))
this.dump.id="oDump"
this.initMode=true
this._initCallback=fCallback
if(!this.scheme.global)this.scheme.global=[]
this.scheme.global.push("../../Runtime/navigation.htc","../../Runtime/objTrans.htc","../../Runtime/objTrans.js","../../Runtime/variable.htc","../../Runtime/Images/trans.gif");
this.cache("global",true)
for(var iReq=0;iReq<aIdsToCache.length;iReq++)this.cache(aIdsToCache[iReq])}
delete this.init},parse:function(sData){var aData=sData.split("|!|"),oFileId={},oData={}
for(var iDoc=0,iLen=aData.length;iDoc<iLen;iDoc++){var aFiles,aMerge=null
if(aData[iDoc]){aFiles=aData[iDoc].split("|")
var sId=aFiles.splice(0,1)[0]
if(oData[sId])aMerge=oData[sId]
oData[sId]=aFiles
for(var iFile=0,iFileLen=aFiles.length;iFile<iFileLen;iFile++){var sFile=aFiles[iFile]
if(sFile.indexOf(":")>-1){var aIdFile=sFile.split(":")
oFileId[aIdFile[0]]=aIdFile[1]
aFiles[iFile]=aIdFile[1]}else{aFiles[iFile]=oFileId[sFile]}}
if(aMerge)oData[sId]=oData[sId].concat(aMerge)}}
return oData},cache:function(sId,bSkipId){if(sId in this.scheme){if(!bSkipId){this._pending++
oCourse.httpLoader("GET","Projects/Res/"+sId,this.itemComplete)}
var aFiles=this.scheme[sId]
if(aFiles){for(var iFile=aFiles.length;iFile--;){var sFile="Projects/Res/"+aFiles[iFile]
if(!this._done[sFile]){this._pending++
if(/\.(?:js|htc|html?|txt|xml)$/i.test(sFile))oCourse.httpLoader("GET",sFile,this.itemComplete,"",false,true)
else{var oPreload=this.dump.appendChild(document.createElement("img"))
oPreload.onload=oPreload.onerror=this.itemComplete
oPreload.src=sFile}
this._done[sFile]=true}}}
delete this.scheme[sId]
return true}
return false},itemComplete:function(){CacheManager._pending--
if(CacheManager._pending==0){if(CacheManager.initMode){scaleInit()
delete CacheManager.initMode}
if(CacheManager._initCallback){CacheManager._initCallback()
delete CacheManager._initCallback}}},disable:function(){scaleInit()},_done:{},_pending:0}
function reloadScaler(){;/*@if(@_jscript)
location.reload()
;/*@end @*/}
function disableDefault(event){event.returnValue=event.srcElement.tagName=="INPUT"||event.srcElement.tagName=="TEXTAREA"}
function ensureWinSize(iWidth,iHeight){try{var iRWidth=Math.min(iWidth+6,screen.availWidth),iRHeight=Math.min(iHeight+30,screen.availHeight)
if(top.screenLeft+iRWidth>screen.availWidth||top.screenTop+iRHeight>screen.availHeight)top.moveTo(screen.availWidth-iRWidth,screen.availHeight-iRHeight)
top.resizeTo(iRWidth,iRHeight)
iChromeWidth=iRWidth-oBD.offsetWidth
iChromeHeight=iRHeight-oBD.offsetHeight
top.moveTo(Math.round((screen.availWidth-iWidth-iChromeWidth)/2),Math.round((screen.availHeight-iHeight-iChromeHeight)/2))
top.resizeTo(iWidth+iChromeWidth,iHeight+iChromeHeight)}catch(e){}}
function scaleContent(tooSmall,tooLarge){var fHeight=oBD.clientHeight,fWidth=oBD.clientWidth,iZoom=Math.min(fWidth/defWidth,fHeight/defHeight)
tooSmall=(typeof tooSmall=="string"&&tooSmall)||winTooSmall
tooLarge=(typeof tooLarge=="string"&&tooLarge)||winTooLarge
if(((iZoom<1&&tooSmall=="zoom")||(iZoom>1&&tooLarge=="zoom"))&&isScalable()){oCourseFrame.style.zoom=iZoom
oCourse.scaleRatio=iZoom}else{oCourseFrame.style.zoom=1
oCourse.scaleRatio=null
if(iZoom<1){if(!document.body.style.overflow){oCourseFrame.style.height=defHeight
oCourseFrame.style.width=defWidth
document.body.style.overflow="auto"}
var iMarginHeight=Math.floor((document.body.clientHeight-oCourse.oTopLevelLayer.offsetHeight)/2),iMarginWidth=Math.floor((document.body.clientWidth-oCourse.oTopLevelLayer.offsetWidth)/2)
oCourseFrame.style.marginTop=iMarginHeight>1?iMarginHeight:0
oCourseFrame.style.marginLeft=iMarginWidth>1?iMarginWidth:0}}
if((iZoom>1||oCourseFrame.style.zoom!=1)&&document.body.style.overflow){oCourseFrame.style.removeAttribute("height")
oCourseFrame.style.removeAttribute("width")
oCourseFrame.style.removeAttribute("marginTop")
oCourseFrame.style.removeAttribute("marginLeft")
document.body.style.removeAttribute("overflow")}
var iMarginWidth=Math.floor((oCourse.document.body.offsetWidth-oCourse.oTopLevelLayer.offsetWidth)/2),iMarginHeight=Math.floor((oCourse.document.body.offsetHeight-oCourse.oTopLevelLayer.offsetHeight)/2)
oCourse.document.body.style.marginLeft=iMarginWidth>1?iMarginWidth:0
oCourse.document.body.style.marginTop=iMarginHeight>1?iMarginHeight:0}
function checkScaleRequired(event){if(event.propertyName=="innerHTML"){delete isScalable.cacheReturn
scaleContent()}}
function isScalable(){if(isScalable.cacheReturn!=undefined)return isScalable.cacheReturn
if(bCanZoom){var aMedia=oCourse.oTopLevelLayer.getElementsByTagName("embed")
for(var iMedia=0;iMedia<aMedia.length;iMedia++){var oMedia=aMedia[iMedia],sWin=(oMedia.getAttribute("WindowlessVideo")||"").toLowerCase(),sMode=(oMedia.getAttribute("WMode")||"").toLowerCase()
if(sWin=="true"||sWin=="1"||sMode=="opaque"||sMode=="transparent"){return isScalable.cacheReturn=false}}
return isScalable.cacheReturn=true}
return isScalable.cacheReturn=false}