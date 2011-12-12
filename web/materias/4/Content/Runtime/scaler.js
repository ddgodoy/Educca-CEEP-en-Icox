/*@cc_on @*/
if(oCourse.contentWindow)oCourse=oCourse.contentWindow
oCourse.location.href="runtime.html"+location.href.replace(/^[^?]+/,"")
var monitorLoad=setInterval(scaleInit,100),oCourseFrame=document.all.oCourse,oBD=document.body,defWidth,defHeight,iChromeHeight=0,iChromeWidth=0,winTooSmall,winTooLarge,bCanZoom=oCourseFrame.currentStyle.zoom!==undefined
function scaleInit(){if(oCourse.oConfig&&oCourse.oConfig.firstChild&&oCourse.oMasterContent&&oCourse.oMenuContent){clearInterval(monitorLoad)
var bAccessTop=false,bLocal=false
try{if(top.document){bAccessTop=true
bLocal=/[\/\\]run\.hta$/i.test(top.location.pathname)}}catch(e){}
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
var bgColor=oPrj.getAttribute("windowBackColor")||"gray"
oCourse.document.body.style.backgroundColor=bgColor
document.body.style.backgroundColor=bgColor
if(winType=="max")document.body.style.borderWidth=0
oCourseFrame.style.visibility="visible"}}
function reloadScaler(){;/*@if(@_jscript)
location.reload()
;/*@end @*/}
function disableDefault(event){event.returnValue=false}
function ensureWinSize(iWidth,iHeight){var iRWidth=Math.min(iWidth+6,screen.availWidth),iRHeight=Math.min(iHeight+30,screen.availHeight)
if(top.screenLeft+iRWidth>screen.availWidth||top.screenTop+iRHeight>screen.availHeight)top.moveTo(screen.availWidth-iRWidth,screen.availHeight-iRHeight)
top.resizeTo(iRWidth,iRHeight)
iChromeWidth=iRWidth-oBD.offsetWidth
iChromeHeight=iRHeight-oBD.offsetHeight
top.moveTo(Math.round((screen.availWidth-iWidth-iChromeWidth)/2),Math.round((screen.availHeight-iHeight-iChromeHeight)/2))
top.resizeTo(iWidth+iChromeWidth,iHeight+iChromeHeight)}
function scaleContent(tooSmall,tooLarge){var fHeight=oBD.clientHeight,fWidth=oBD.clientWidth,iZoom=Math.min(fWidth/defWidth,fHeight/defHeight)
tooSmall=(typeof tooSmall=="string"&&tooSmall)||winTooSmall
tooLarge=(typeof tooLarge=="string"&&tooLarge)||winTooLarge
if(((iZoom<1&&tooSmall=="zoom")||(iZoom>1&&tooLarge=="zoom"))&&isScalable()){oCourseFrame.style.zoom=iZoom
oCourse.scaleRatio=iZoom}else{oCourseFrame.style.zoom=1
oCourse.scaleRatio=null
if(iZoom<1){if(!document.body.style.overflow){oCourseFrame.style.height=defHeight
oCourseFrame.style.width=defWidth
document.body.style.overflow="auto"}
var iMarginHeight=Math.floor((document.body.clientHeight-oCourse.oTopLevelLayer.offsetHeight)/2)
oCourseFrame.style.marginTop=iMarginHeight>1?iMarginHeight:0}}
if((iZoom>1||oCourseFrame.style.zoom!=1)&&document.body.style.overflow){oCourseFrame.style.removeAttribute("height")
oCourseFrame.style.removeAttribute("width")
oCourseFrame.style.removeAttribute("marginTop")
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