/*@cc_on @*/
function Transition(oElem,oHost){try{this.elem=oElem
this.host=oHost
if(oElem.activetrans)oElem.activetrans.stop()}
catch(oErr){}}
Transition.activeHash={}
Transition.stopAll=function(){for(var sT in Transition.activeHash){try{var oT=Transition.activeHash[sT]
if(oT){oT.stop()}}catch(oErr){}}}
Transition.prototype.init=function(){var oRef=this.elem.transtype&&this.elem.transtype!="inherit"&&this.elem.transtype!="heredar"||!this.host?this.elem:this.host
this.type=oRef.transtype
this.prop=(oRef.transprop||"").hash()
oRef=this.elem.transduration&&this.elem.transduration!="inherit"&&this.elem.transtype!="heredar"||!this.host?this.elem:this.host
this.duration=Transition.getDuration(oRef.transduration||"1500")
this.mode=this.elem.currentStyle.visibility=="visible"?"hidden":"visible"
this.container=oContentArea
Transition.activeHash[this.elem.uniqueID]=this}
Transition.prototype.play=function(){try{var oChild,aFound=[],oChildren=this.elem.all
try{for(var iC=0;iC<oChildren.length;iC++){oChild=oChildren[iC]
if(oChild.currentStyle.filter.indexOf("opacity=0")!=-1){oChild.restoreDisplay=oChild.currentStyle.display
oChild.style.display="none"
aFound[aFound.length]=oChild}}}
catch(oErr){}
this.tpElems=aFound
this.conf=Transition.getConfig(this.type)||Transition.config.Show
;/*@if(!@_jscript)@*/
if(this.elem.tagName=="EMBED"||this.elem.getElementsByTagName("embed").length)this.conf=Transition.config.Show
;/*@end @*/
this.func=this[this.conf.func]?this.conf.func:"show"
this.elem.activetrans=this
if(this.func!="show"&&this.elem.scopeName!="gmv"){this.wrapElem()}
this[this.func].play(this)}
catch(oErr){this.stop(this)}}
Transition.prototype.stop=function(){if(this.elem.activetrans){this.elem.style.filter=""
if(this[this.func].stop)this[this.func].stop(this)
this.elem.style.visibility=this.mode
this.unwrapElem()
this.elem.activetrans=null
if(this.onFinish)this.onFinish()
Transition.activeHash[this.elem.uniqueID]=null
try{for(var iF=0;iF<this.tpElems.length;iF++){var oChild=this.tpElems[iF]
if(oChild.restoreDisplay){oChild.style.display=oChild.restoreDisplay
oChild.removeAttribute("restoreDisplay")}}}
catch(oErr){}}}
Transition.prototype.wrapElem=function(){if(this.elem.tagName!="transwrapper"){var oEl=this.elem,oNew=oEl.document.createElement("gm:transwrapper"),oParent=oEl.parentNode,oTemp=oEl.document.createElement("div"),iW=oEl.tagName=="IMG"?oEl.clientWidth:oEl.offsetWidth,iH=oEl.tagName=="IMG"?oEl.clientHeight:oEl.offsetHeight
oParent.appendChild(oNew)
oNew.appendChild(oTemp)
oEl.swapNode(oNew)
oEl.swapNode(oTemp)
oTemp.removeNode()
Transition.copyize(oNew,oEl)
oNew.style.width=iW
oNew.style.height=iH
oNew.activetrans=oEl.activetrans
oEl.setAttribute("oldWidth",oEl.style.width)
oEl.setAttribute("oldHeight",oEl.style.height)
oEl.style.position="relative"
oEl.style.top="0"
oEl.style.left="0"
oEl.style.right="auto"
oEl.style.bottom="auto"
oEl.style.width=iW
oEl.style.height=iH
oEl.style.visibility="inherit"
this.elem=oNew
;/*@if(!@_jscript)@*/
if(oEl.tagName=="IMG"&&!oEl.complete){oEl.addEventListener("load",function(e){oEl.style.width=""
oEl.style.height=""
oEl.style.width=oEl.width
oEl.style.height=oEl.height
oNew.style.width=oEl.width
oNew.style.height=oEl.height
oEl.removeEventListener("load",arguments.callee,false)},false)}
;/*@end @*/}}
Transition.prototype.unwrapElem=function(){if(this.elem.tagName=="transwrapper"){var oWrapper=this.elem,oElem=oWrapper.firstChild,oParent=oWrapper.parentNode
if(oElem){Transition.copyize(oElem,oWrapper)
oElem.style.width=oElem.getAttribute("oldWidth")
oElem.style.height=oElem.getAttribute("oldHeight")
oElem.removeAttribute("oldWidth")
oElem.removeAttribute("oldHeight")}
if(oParent){var oTemp=oElem.document.createElement("div")
oParent.insertBefore(oTemp,oWrapper)
oTemp.swapNode(oElem)
oWrapper.removeNode(true)}
if(oElem){this.elem=oElem}}}
Transition.copyize=function(oEl,oSrc){var sPos=oSrc.currentStyle.position,iTop=oSrc.currentStyle.top,iLeft=oSrc.currentStyle.left,iRight=oSrc.currentStyle.right,iBottom=oSrc.currentStyle.bottom,sVisibility=oSrc.currentStyle.visibility
oEl.style.position=sPos
oEl.style.top=iTop
oEl.style.left=iLeft
oEl.style.right=iLeft&&iLeft!="auto"?"auto":iRight
oEl.style.bottom=iTop&&iTop!="auto"?"auto":iBottom
oEl.style.visibility=sVisibility}
Transition.getDuration=function(sDur){var iDur=sDur.replace(/[^0-9\.\-]/g,""),iUnit=sDur.replace(/\-?\d*\.?/g,"")
if(iUnit=="sec")iDur*=1000
if(iUnit=="min")iDur*=60000
return iDur*1}
Transition.getConfig=function(sType){var pTransObj=Transition.config[sType]
while(pTransObj&&pTransObj.alias)pTransObj=Transition.config[pTransObj.alias]
return pTransObj}
Transition.prototype.show={play:function(oTrans){setTimeout(function(){oTrans.stop();},oTrans.prop.delay||10)}}
Transition.prototype.random={play:function(oTrans){var aTypes=[],sType,oConf,sProp,oProp
for(sType in Transition.config){oConf=Transition.getConfig(sType)
if(oConf.func=="random"||oConf.func=="show")continue
aTypes[aTypes.length]=sType}
sType=aTypes[Math.floor(Math.random()*aTypes.length)]
oConf=Transition.getConfig(sType)
oTrans.randType=oTrans.type
try{if(typeof(element)!="undefined"&&element.document.getElementById("_randView_")){element.document.getElementById("_randView_").innerText=sType}}catch(oErr){}
oTrans.type=sType
oTrans.conf=oConf
for(sProp in oConf.prop){oProp=oConf.prop[sProp]
if(oProp.type=="select"){oTrans.prop[sProp]=oProp.opt[Math.floor(Math.random()*oProp.opt.length)]
if(oProp.map){oTrans.prop[sProp]=oProp.map[oTrans.prop[sProp]]}}else if(oProp.type=="number"&&oProp.def){oTrans.prop[sProp]=oProp.def
if(oProp.factor){oTrans.prop[sProp]=oTrans.prop[sProp]*oProp.factor}}}
oTrans[oTrans.randFunc=oConf.func].play(oTrans)},stop:function(oTrans){oTrans.type=oTrans.randType
oTrans[oTrans.randFunc].stop(oTrans)}}
;/*@if(@_jscript)@*/ //IE-only:apply transition filters
Transition.prototype.filter={play:function(oTrans){var sFilter="progid:DXImageTransform.Microsoft."+oTrans.type.replace(/\s/g,"")+"()"
oTrans.elem.style.filter=sFilter
oTrans.elem.onfilterchange=function(){if(this.filters[0].status==0){this.onfilterchange=null
oTrans.stop()}}
try{for(var sP in oTrans.prop){oTrans.elem.filters[0][sP]=oTrans.prop[sP]}
oTrans.elem.filters[0].duration=oTrans.duration/1000
oTrans.elem.filters[0].Apply()
oTrans.elem.style.visibility=oTrans.mode
if(oTrans.elem.getAttribute("transwrapper"))oTrans.elem.firstChild.style.visibility=oTrans.mode
oTrans.elem.filters[0].Play()}catch(oErr){}},stop:function(oTrans){oTrans.elem.onfilterchange=null}}
;/*@else @*/ //Non-IE:manually fade
Transition.prototype.filter={play:function(oTrans){var self=this
if(oTrans.mode=="visible"){oTrans.elem.style.visibility="visible"
oTrans.orig=oTrans.elem.style.opacity
oTrans.target=+oTrans.elem.currentStyle.opacity
oTrans.elem.style.opacity=0}else{oTrans.orig=oTrans.elem.style.opacity
oTrans.target=0}
oTrans.start=new Date()
oTrans.base=+oTrans.elem.currentStyle.opacity
oTrans.step=(oTrans.target-oTrans.elem.currentStyle.opacity)/oTrans.duration
oTrans.delay=30
oTrans.interval=setInterval(function(){self.step(oTrans)},oTrans.delay)},stop:function(oTrans){oTrans.elem.style.visibility=oTrans.mode
oTrans.elem.style.opacity=oTrans.orig
if(oTrans.interval){clearTimeout(oTrans.interval)
oTrans.interval=null}},step:function(oTrans){var iTime=new Date()-oTrans.start
if(iTime>=oTrans.duration){oTrans.stop()}else{oTrans.elem.style.opacity=oTrans.base+iTime*oTrans.step}}}
;/*@end @*/
Transition.prototype.fly={play:function(oTrans){for(var sProp in oTrans.conf.prop){var oProp=oTrans.conf.prop[sProp]
while(oTrans.prop[sProp]=="random")oTrans.prop[sProp]=oProp.opt[Math.floor(Math.random()*oProp.opt.length)]}
var oActivePos={left:"left",right:"left",top:"top",bottom:"top"},sDirection=oTrans.mode=="hidden"&&oTrans.prop.outDirection||oTrans.prop.inDirection||"left",getOffsetFunc=sDirection=="left"||sDirection=="right"?getOffsetLeft:getOffsetTop,offsetDim=sDirection=="left"||sDirection=="right"?"offsetWidth":"offsetHeight",self=this
oTrans.activePos=oActivePos[sDirection]
oTrans.originalPos=getOffsetFunc(oTrans.elem,oTrans.container)
if(oTrans.container.id!="oPreview"){var oTargetParent=oTrans.elem.parentElement,oPlaceHolder=oTrans.elem.document.createElement("gm:box"),oRect
while(oTargetParent.parentElement!=oTrans.container){oTargetParent=oTargetParent.parentElement}
oRect={left:getOffsetLeft(oTrans.elem,oTargetParent),top:getOffsetTop(oTrans.elem,oTargetParent)}
oRect.right=oRect.left+oTrans.elem.offsetWidth
oRect.bottom=oRect.top+oTrans.elem.offsetHeight
oPlaceHolder.style.cssText=oTrans.elem.style.cssText
oPlaceHolder.className=oTrans.elem.className
oPlaceHolder.style.visibility="hidden"
oPlaceHolder.style.width=oRect.right-oRect.left
oPlaceHolder.style.height=oRect.bottom-oRect.top
oPlaceHolder.style.left=oTrans.elem.currentStyle.left
oPlaceHolder.style.top=oTrans.elem.currentStyle.top
oPlaceHolder.activetrans=oTrans.elem.activetrans
oTargetParent.appendChild(oPlaceHolder)
oTrans.elem.swapNode(oPlaceHolder)
oTrans.elem.style.position="absolute"
oTrans.elem.style.margin=0
oTrans.elem.style.zIndex=1000
oTrans.elem.style.removeAttribute("right")
oTrans.elem.style.removeAttribute("bottom")
oTrans.elem.style.left=oRect.left
oTrans.elem.style.top=oRect.top
oTrans.elem.placeholder=oPlaceHolder}
if(oTrans.mode=="visible"){oTrans.target=getOffsetFunc(oTrans.elem,oTrans.container)
if(sDirection=="left"||sDirection=="top"){oTrans.elem.style[sDirection]=-oTrans.elem[offsetDim]}else{oTrans.elem.style[oTrans.activePos]=oTrans.container[offsetDim]}
oTrans.elem.style.visibility="visible"}else{if(sDirection=="left"||sDirection=="top"){oTrans.target=-oTrans.elem[offsetDim]}else{oTrans.target=oTrans.container[offsetDim]}}
oTrans.start=getOffsetFunc(oTrans.elem,oTrans.container)
oTrans.dist=oTrans.target-oTrans.start
oTrans.time=0
oTrans.duration=oTrans.duration
oTrans.delay=30
oTrans.lastPos=0
oTrans.flyFunc=this.getFunc(oTrans.mode=="visible"&&(oTrans.prop.inType||"ease soft in")||oTrans.prop.outType||"linear")
oTrans.bAlpha=oTrans.type=="Fly Fade"
oTrans.iBlurDir=oTrans.type=="Fly Blur"&&((sDirection=="top"||sDirection=="bottom")&&"180"||"90")
oTrans.interval=setInterval(function(){self.step(oTrans)},oTrans.delay)},stop:function(oTrans){if(oTrans.interval){clearInterval(oTrans.interval)
oTrans.interval=null}
oTrans.elem.style[oTrans.activePos]=oTrans.originalPos
var oPlaceHolder=oTrans.elem.placeholder
if(oPlaceHolder){try{oTrans.elem.style.margin=oPlaceHolder.style.margin
oTrans.elem.style.position=oPlaceHolder.style.position
oTrans.elem.style.left=oPlaceHolder.currentStyle.left
oTrans.elem.style.top=oPlaceHolder.currentStyle.top
oTrans.elem.style.right=oPlaceHolder.currentStyle.right
oTrans.elem.style.bottom=oPlaceHolder.currentStyle.bottom
oTrans.elem.style.zIndex=oPlaceHolder.currentStyle.zIndex
oPlaceHolder.replaceNode(oTrans.elem)}catch(oErr){}}},step:function(oTrans){if((oTrans.time+=oTrans.delay)>=oTrans.duration){oTrans.stop()}else{var iPos=oTrans.flyFunc(oTrans.time,0,1,oTrans.duration)
oTrans.elem.style[oTrans.activePos]=oTrans.start+iPos*oTrans.dist
if(oTrans.iBlurDir){var iBlurStr=oTrans.lastPos!==undefined?(iPos-oTrans.lastPos)*oTrans.dist*1.5:0,iBlurDir=iBlurStr<0?oTrans.iBlurDir:(+oTrans.iBlurDir+180)
oTrans.elem.style.filter="progid:DXImageTransform.Microsoft.MotionBlur(strength="+Math.abs(iBlurStr)+",direction="+iBlurDir+")"}
oTrans.lastPos=iPos
if(oTrans.bAlpha){iPos*=100
if(oTrans.mode=="hidden")iPos=100-iPos
oTrans.elem.style.filter="progid:DXImageTransform.Microsoft.alpha(opacity="+Math.min(Math.max(iPos,0),100)+")"}}},getFunc:function(sType){switch(sType){case"ease soft in":return function(t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;}
case"ease soft out":return function(t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;}
case"ease hard in":return function(t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;}
case"ease hard out":return function(t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;}
case"ease back in":return function(t,b,c,d){return c*((t=t/d-1)*t*(2.70158*t+1.70158)+1)+b;}
case"ease back out":return function(t,b,c,d){return c*(t/=d)*t*(2.70158*t-1.70158)+b;}
case"elastic in":return function(t,b,c,d){if(t==0)return b;if((t/=d)==1)return b+c
var p=650,s=p/4,a=c
return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b}
case"elastic out":return function(t,b,c,d){if(t==0)return b;if((t/=d)==1)return b+c
var p=650,s=p/4,a=c
return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b}
case"bounce in":return function(t,b,c,d){if((t/=d)<(1/2.75))return c*(7.5625*t*t)+b
else if(t<(2/2.75))return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b
else if(t<(2.5/2.75))return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b
else return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}
case"bounce out":return function(t,b,c,d){return c-this.fly.getFunc("bounce in")(d-t,0,c,d)+b}
default:return function(t,b,c,d){return b+c*t/d;}}}}
Transition.prototype.blink={play:function(oTrans){var sTrans="progid:DXImageTransform.Microsoft.",self=this
if(!oTrans.prop.count)oTrans.prop.count=4
oTrans.delay=oTrans.duration/(oTrans.prop.count*2)
oTrans.count=0
oTrans.time=oTrans.duration+oTrans.delay
oTrans.start=new Date().getTime()
if(oTrans.prop.rate=="decelerate"){oTrans.delay/=50}
if(oTrans.prop.effect=="alpha"){if(oTrans.elem.style.visibility=="visible"){var iOp=100
oTrans.opdir=-1}else{var iOp=1
oTrans.opdir=1}
oTrans.elem.style.filter=sTrans+"alpha(opacity="+iOp+")"}else if(oTrans.prop.effect=="flip"){oTrans.elem.style.filter=sTrans+"BasicImage(rotation=2,mirror=1)"}else if(oTrans.prop.effect&&oTrans.prop.effect!="none"){oTrans.elem.style.filter=sTrans+"BasicImage("+oTrans.prop.effect+"=1)"}
oTrans.interval=setTimeout(function(){self.step(oTrans)},oTrans.delay)},stop:function(oTrans){oTrans.elem.style.visibility=oTrans.mode
if(oTrans.interval){clearTimeout(oTrans.interval)
oTrans.interval=null}},step:function(oTrans){var self=this
if(new Date().getTime()-oTrans.start>=oTrans.time&&oTrans.count%2){oTrans.stop()}else{oTrans.count++
if(oTrans.elem.style.visibility=="visible"){oTrans.elem.style.visibility="hidden"}else{var iOpacity
if(oTrans.prop.rate=="accelerate"){oTrans.delay*=0.85
iOpacity=3}else if(oTrans.prop.rate=="decelerate"){oTrans.delay*=1.15
iOpacity=3}else{iOpacity=(100/oTrans.prop.count)}
try{if(oTrans.prop.effect=="alpha"){oTrans.elem.filters[0].opacity+=iOpacity*oTrans.opdir}else if(oTrans.prop.effect=="mirror"){oTrans.elem.filters[0].mirror=(oTrans.elem.filters[0].mirror+1)%2}else if(oTrans.prop.effect=="flip"){oTrans.elem.filters[0].mirror=(oTrans.elem.filters[0].mirror+1)%2
oTrans.elem.filters[0].rotation=(oTrans.elem.filters[0].rotation+2)%4}}catch(oErr){}
oTrans.elem.style.visibility="visible"}
oTrans.interval=setTimeout(function(){self.step(oTrans)},oTrans.delay)}}}
Transition.revealElementDef=function(oElem,oDefElem,sDisplay,sVisible,fCallback){sVisible=sVisible||"visible"
oElem.style.visibility=sVisible=="visible"?"hidden":"visible"
if(sVisible=="visible"){if(sDisplay)oElem.style.display=sDisplay}
var oTrans=new Transition(oElem,oDefElem)
if(fCallback){oTrans.onFinish=fCallback}
oTrans.init()
if(oElem.getAttribute("transactive")!="true"&&(!oDefElem||oDefElem.getAttribute("transactive")!="true"))oTrans.type="Show"
if(sVisible=="hidden"&&sDisplay)oTrans.onFinish=function(){this.elem.style.display=sDisplay;}
oTrans.play()}
Transition.config={Show:{func:"show"},Fly:{func:"fly",prop:{inDirection:{type:"select",opt:["left","right","top","bottom","random"],optText:["izquierda","derecha","arriba","abajo","aleatorio"]},inType:{type:"select",opt:["ease soft in","ease soft out","ease hard in","ease hard out","ease back in","ease back out","elastic in","elastic out","bounce in","bounce out","linear","random"],optText:["entrada suave","salida suave","entrada dura","salida dura","entrada atrás","salida atrás","entrada elástica","salida elástica","entrada botando","salida botando","linear","aleatorio"]},outDirection:{type:"select",opt:["left","right","top","bottom","random"],optText:["izquierda","derecha","arriba","abajo","aleatorio"]},outType:{type:"select",opt:["ease soft in","ease soft out","ease hard in","ease hard out","ease back in","ease back out","elastic in","elastic out","bounce in","bounce out","linear","random"],optText:["entrada suave","salida suave","entrada dura","salida dura","entrada atrás","salida atrás","entrada elástica","salida elástica","entrada botando","salida botando","linear","aleatorio"]}}},"Fly Fade":{alias:"Fly"},"Fly Blur":{alias:"Fly"},Blink:{func:"blink",prop:{count:{type:"number",step:1,low:2,high:10,def:4},rate:{type:"select",opt:["normal","accelerate","decelerate"],optText:["normal","acelerar","desacelerar"]},effect:{type:"select",opt:["none","alpha","grayscale","invert","mirror","flip","xray"],optText:["ninguno","alfa","escala de gris","invertir","espejo","voltear","rayosx"]}}},Barn:{func:"filter",prop:{motion:{type:"select",opt:["out","in"],optText:["fuera","dentro"]},orientation:{type:"select",opt:["vertical","horizontal"],optText:["vertical","horizontal"]}}},Blinds:{func:"filter",prop:{direction:{type:"select",opt:["down","up","left","right"],optText:["abajo","arriba","izquierda","derecha"]},bands:{type:"number",step:1,low:1,high:100,def:10}}},"Checker Board":{func:"filter",prop:{direction:{type:"select",opt:["up","down","left","right"],optText:["arriba","abajo","izquierda","derecha"]},squaresX:{type:"number",step:1,low:2,high:100,def:12},squaresY:{type:"number",step:1,low:2,high:100,def:10}}},Fade:{func:"filter"},"Gradient Wipe":{func:"filter",prop:{motion:{type:"select",opt:["forward","reverse"],optText:["adelante","inverso"]},wipeStyle:{type:"select",opt:["horizontal","vertical"],optText:["horizontal","vertical"],map:{horizontal:"0",vertical:"1"}},gradientSize:{type:"number",step:1,low:1,high:100,def:25,factor:0.01}}},Inset:{func:"filter"},Iris:{func:"filter",prop:{irisStyle:{type:"select",opt:["plus","diamond","circle","cross","square","star"],optText:["plus","diamante","círculo","cruz","cuadrado","estrella"]},motion:{type:"select",opt:["out","in"],optText:["fuera","dentro"]}}},Pixelate:{func:"filter",prop:{maxSquare:{type:"number",step:1,low:2,high:50,def:50}}},"Radial Wipe":{func:"filter",prop:{wipeStyle:{type:"select",opt:["clock","wedge","radial"],optText:["reloj","cuña","radial"]}}},"Random Bars":{func:"filter",prop:{orientation:{type:"select",opt:["horizontal","vertical"],optText:["horizontal","vertical"]}}},"Random Dissolve":{func:"filter"},Slide:{func:"filter",prop:{slideStyle:{type:"select",opt:["hide","push","swap"],optText:["ocultar","empujar","intercambiar"]},bands:{type:"number",step:1,low:1,high:100,def:1}}},Spiral:{func:"filter",prop:{gridSizeX:{type:"number",step:1,low:1,high:100,def:16},gridSizeY:{type:"number",step:1,low:1,high:100,def:16}}},Stretch:{func:"filter",prop:{stretchStyle:{type:"select",opt:["spin","hide","push"],optText:["girar","ocultar","empujar"]}}},Strips:{func:"filter",prop:{motion:{type:"select",opt:["leftdown","leftup","rightdown","rightup"],optText:["izquierda abajo","izquierda arriba","derecha abajo","derecha arriba"]}}},Wheel:{func:"filter",prop:{spokes:{type:"number",step:1,low:2,high:20,def:4}}},Zigzag:{func:"filter",prop:{gridSizeX:{type:"number",step:1,low:1,high:100,def:16},gridSizeY:{type:"number",step:1,low:1,high:100,def:16}}},Random:{func:"random"}}
String.prototype.hash=function(){var hasher={}
if(this!=""){var tmpArr=this.split(",")
for(var iT=0;iT<tmpArr.length;iT++){var itemArr=tmpArr[iT].split("=")
hasher[itemArr[0]]=itemArr[1]}}
return hasher}
function getOffsetTop(oEl,oFinal){for(var iY=0;oEl!=oFinal&&oEl!=null;oEl=oEl.offsetParent){iY+=oEl.offsetTop}
return iY}
function getOffsetLeft(oEl,oFinal){for(var iX=0;oEl!=oFinal&&oEl!=null;oEl=oEl.offsetParent){iX+=oEl.offsetLeft}
return iX}
