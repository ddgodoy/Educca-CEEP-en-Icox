
(function(){if(window.Adaptie)return false
function _(xField){var aClasses=Array.prototype.slice.call(arguments,1)
xField._classes=aClasses
return xField}
window.Adaptie={canAdapt:false,ZINDEX_BASE:10000,TagBehaviors:{},ClassBehaviors:{},IdBehaviors:{},HasInlineBlock:false,init:function(){var oTemp=document.createElement("div")
document.body.appendChild(oTemp)
oTemp.style.overflow="scroll"
Adaptie.Window.Scrollbars.width=oTemp.offsetWidth-oTemp.scrollWidth
Adaptie.Window.Scrollbars.height=oTemp.offsetHeight-oTemp.scrollHeight
oTemp.style.display="inline-block"
if(oTemp.currentStyle.getPropertyValue("display")=="inline-block"){Adaptie.HasInlineBlock=true}
document.body.removeChild(oTemp)},adaptMethod:function(oClass,sMethod,fReplacement){var sClass=oClass
if(typeof oClass=="string")oClass=window[oClass].prototype
if(oClass){if(oClass[sMethod]){oClass["__"+sMethod]=oClass[sMethod]}
oClass[sMethod]=fReplacement
return true}else return false},adaptProperty:function(oClass,sProp,oProp){if(typeof oClass=="string")oClass=window[oClass].prototype
if(oClass){if(oProp.get){var fOldGetter=oClass.__lookupGetter__(sProp)
if(fOldGetter){oClass.__defineGetter__("__"+sProp,fOldGetter)}
oClass.__defineGetter__(sProp,oProp.get)}
if(oProp.set){var fOldSetter=oClass.__lookupSetter__(sProp)
if(fOldSetter){oClass.__defineSetter__("__"+sProp,fOldSetter)}
oClass.__defineSetter__(sProp,oProp.set)}
return true}else return false},Window:{ActiveXObject:_(function(sID){if(sID.indexOf("XMLDOM")>-1||sID.indexOf("DOMDocument")>-1){return Adaptie.XML.createDocument();}else if(sID.indexOf("XMLHTTP")>-1){return new XMLHttpRequest()}
return null},"Window"),createEventObject:_(function(){return this.document.createEventObject()},"Window"),showDialog:function(sUrl,vArgs,sFeatures,bModal){sFeatures=sFeatures.replace(/;/g,",")
sFeatures=sFeatures.replace(/:/g,"=")
sFeatures=sFeatures.replace("dialogLeft","left")
sFeatures=sFeatures.replace("dialogTop","top")
sFeatures=sFeatures.replace("dialogWidth","width")
sFeatures=sFeatures.replace("dialogHeight","height")
sFeatures=sFeatures.replace("center","centerscreen")
sFeatures=sFeatures.replace("scroll","scrollbars")
var oWin=open(sUrl,"_blank",sFeatures)
oWin.dialogArguments=vArgs
return oWin},showModalDialog:_(function(sUrl,vArgs,sFeatures){Adaptie.Window.showDialog(sUrl,vArgs,sFeatures,false)},"Window"),showModelessDialog:_(function(sUrl,vArgs,sFeatures){return Adaptie.Window.showDialog(sUrl,vArgs,sFeatures,false)},"Window"),open:_(function(sUrl,sName,sFeatures){if(/\bfullscreen\s*=\s*(?:1|yes|true)\b/i.test(sFeatures)){sFeatures=sFeatures.replace(/(?:,|^)\s*(?:top|left|width|height)\s*=\s*[^,]+\b/gi,"")
sFeatures+=",top=0,left=0,width="+screen.availWidth+",height="+screen.availHeight}
return window.__open(sUrl,sName,sFeatures)},"Window"),setTimeout:_(function(xFunc,iDelay){if(typeof xFunc=="function"){return this.__setTimeout(function(){xFunc()},iDelay)}else{return this.__setTimeout.apply(this,arguments)}},"Window"),Scrollbars:{width:0,height:0}},Document:{createElement:_(function(sTag){var oEl,iColon=sTag.indexOf(":")
if(iColon>0){oEl=this.__createElement("fieldset")
oEl.setAttribute("scopeName",sTag.slice(0,iColon))
sTag=sTag.slice(iColon+1)
oEl.setAttribute("tagType",sTag)
oEl.setAttribute("tagtypelc",sTag.toLowerCase())
Adaptie.NSElement.init(oEl)
Adaptie.Element.nbspify(oEl)}else{if(sTag.toLowerCase()=="xml"){return Adaptie.XML.createDocument(true);}
oEl=this.__createElement(sTag)}
oEl.setAttributeNS("","layoutfixed","1")
Adaptie.Element.fixZIndex(oEl)
return oEl},"HTMLDocument"),createEventObject:_(function(){return this.createEvent("HTMLEvents")},"HTMLDocument"),createStyleSheet:_(function(sURL){var oLink=document.createElement('link')
oLink.rel='stylesheet'
oLink.isCreateStyleSheetRequest=true
this.getElementsByTagName("head")[0].appendChild(oLink)
oLink.href=sURL
return oLink},"HTMLDocument"),elementFromPoint:_(function(iX,iY){if(iX==undefined||iY==undefined)return null
var oRes=this.body.elementFromPoint(iX,iY)
return oRes},"HTMLDocument"),getElementsByTagName:_(function(sTagName){var aList=new GMNodeList(),aNodes=this.__getElementsByTagName(sTagName);
if(aNodes.length>0){for(var i=0;i<aNodes.length;i++){aList.push(aNodes[i])}}else if(sTagName!="*"){var sXPath='.//*[@tagtypelc="'+sTagName.toLowerCase()+'"]',oNSResolver=document.createNSResolver(document.documentElement),aNodes=document.evaluate(sXPath,this,oNSResolver,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,null)
for(var i=0;i<aNodes.snapshotLength;i++)aList.push(aNodes.snapshotItem(i))}
return aList},"HTMLDocument","HTMLElement","HTMLBodyElement","HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement")},Element:{uidCounter:0,appendChild:_(function(oEl){return this.insertBefore(oEl,null)},"HTMLDocument","HTMLElement","HTMLBodyElement","HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement"),cloneNode:_(function(bDeep){var oNode=this.__cloneNode(bDeep),aNodes=oNode.getElementsByTagName("*"),oTagProps={}
aNodes=Array.prototype.slice.call(aNodes,0)
aNodes.unshift(oNode)
for(var i=0;i<aNodes.length;i++){var oEl=aNodes[i]
oEl.removeAttributeNS("","layoutfixed")
if(oEl.hasAttributeNS("","origWidth"))oEl.style.width=""
var oProps={},sTagName=oEl.nodeName,aAttr=oEl.attributes
for(var iAttr=aAttr.length;iAttr--;){var sProp=aAttr[iAttr].name,sVal=aAttr[iAttr].value
if(sProp.toLowerCase()=="tagtype")sTagName=sVal
oProps[sProp]=1}
if(!oTagProps[sTagName]){oTagProps[sTagName]=oProps}else{for(var sProp in oProps){oTagProps[sTagName][sProp]=1}}}
oNode.addEventListener("DOMNodeInserted",function(e){if(e.target==oNode){Adaptie.Element.postProcess(oNode,oTagProps,true)
oNode.removeEventListener("DOMNodeInserted",arguments.callee,false)}},false)
return oNode},"HTMLElement","HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement"),contains:_(function(oElement){while(oElement){if(oElement==this)return true
oElement=oElement.parentNode}
return false},"HTMLElement"),click:_(function(){var oEvent=this.ownerDocument.createEvent("HTMLEvents")
oEvent.initEvent("click",false,true)
this.dispatchEvent(oEvent)},"HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement"),elementFromPoint:_(function(iX,iY){if(this.currentStyle.display=="none")return null
if(this.childNodes.length>0){var iTop,oTop
for(var i=0;i<this.childNodes.length;i++){var oEl=this.childNodes[i]
if(oEl.nodeType==1){var oRes=oEl.elementFromPoint(iX,iY)
if(oRes){var iZ=+oEl.currentStyle.getPropertyValue("z-index")
if(iZ>=iTop||iTop==undefined){iTop=iZ
oTop=oRes}}}}
if(oTop)return oTop}
var oBox=this.ownerDocument.getBoxObjectFor(this)
if(iX>=oBox.x&&iY>=oBox.y&&iX<=oBox.x+oBox.width&&iY<=oBox.y+oBox.height&&this.currentStyle.visibility=="visible"){return this}
return null},"HTMLElement"),insertBefore:_(function(oEl,oChild){this.__insertBefore(oEl,oChild)
if(oEl.hasAttributeNS&&oEl.hasAttributeNS("","layoutfixed")){var sQName=((oEl.scopeName!="HTML"?oEl.scopeName+":":"")+oEl.tagName).toLowerCase()
if(Adaptie.TagBehaviors&&Adaptie.TagBehaviors[sQName]){oEl.addBehavior(Adaptie.TagBehaviors[sQName])}}
return oEl},"HTMLDocument","HTMLElement","HTMLBodyElement","HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement"),insertAdjacentElement:_(function(sWhere,oElement){switch(sWhere){case"beforeBegin":this.parentNode.insertBefore(oElement,this)
break
case"afterBegin":this.insertBefore(oElement,this.firstChild)
break
case"beforeEnd":this.appendChild(oElement)
break
case"afterEnd":this.parentNode.insertBefore(oElement,this.nextSibling)
break}
return oElement},"HTMLElement"),selectNodes:_(function(cXPathString){return this.ownerDocument.selectNodes(cXPathString,this)},"Element"),selectSingleNode:_(function(cXPathString){return this.ownerDocument.selectSingleNode(cXPathString,this)},"Element"),swapNode:_(function swapNode(b){var aLoc=this.nextSibling,aParent=this.parentNode
b.parentNode.insertBefore(this,b)
aParent.insertBefore(b,aLoc)
return this},"HTMLElement"),all:_({get:function(){return this.getElementsByTagName("*");}},"HTMLElement"),behaviorUrns:_({get:function(){if(this.__behaviorUrns&&this.__behaviorUrns instanceof Array)return this.__behaviorUrns.concat()
else return[]},set:function(aUrns){return this.__behaviorUrns=aUrns}},"HTMLElement"),children:_({get:function(){var aList=new GMNodeList()
for(var i=0;i<this.childNodes.length;i++){var oChild=this.childNodes[i]
if(oChild.nodeType==1){aList.push(oChild)}}
return aList}},"HTMLElement","HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLInputElement","HTMLQuoteElement"),className:_({get:function(){return this.__className;},set:function(sClass){this.__className=sClass
Adaptie.Element.fixZIndex(this)
return sClass}},"HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLInputElement","HTMLQuoteElement"),currentStyle:_({get:function(){return getComputedStyle(this,"")}},"HTMLElement"),disabled:_({get:function(){return this.hasAttributeNS("","disabled");},set:function(bDisabled){if(bDisabled){this.setAttributeNS("","disabled",1)
return true}else{if(this.hasAttributeNS("","disabled")){this.removeAttributeNS("","disabled")}
return false}}},"HTMLElement"),document:_({get:function(){return this.ownerDocument;}},"HTMLDocument","HTMLElement"),id:_({get:function(){return this.__id;},set:function(sId){this.__id=sId
Adaptie.Element.fixZIndex(this)
return sId}},"HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLInputElement","HTMLQuoteElement"),innerHTML:_({set:function(sHTML){var oRange=this.ownerDocument.createRange()
oRange.selectNodeContents(this)
oRange.deleteContents()
sHTML=""+sHTML
if(!sHTML){if(this.scopeName!="HTML")Adaptie.Element.nbspify(this)
return}
this.removeEventListener("DOMNodeInserted",Adaptie.Element.unnbspify,false)
while(/<[^>]+?[a-z]\s?=\s?\"[^\"]*>/i.test(sHTML))sHTML=sHTML.replace(/(<[^>]+?[a-z]\s?=\s?\"[^\"]*)>/gi,"$1&gt;")
while(/<[^>]+?[a-z]\s?=\s?\'[^\']*>/i.test(sHTML))sHTML=sHTML.replace(/(<[^>]+?[a-z]\s?=\s?\'[^\']*)>/gi,"$1&gt;")
sHTML=sHTML.replace(/<gmv:rect([^>]+)>\s*<gmv:imagedata([^>]+)>[\s\S]+?<\/gmv:rect>/ig,"<img$1$2>")
sHTML=sHTML.replace(/<([^>\s\/?:]+):([^\s>]+)/g,function(sMatch,sScope,sTag){return'<fieldset scopeName="'+sScope+'" tagType="'+sTag+'" tagtypelc="'+sTag.toLowerCase()+'"'})
sHTML=sHTML.replace(/<\/[^>\s\/?:]+:[^\s>]+/g,"</fieldset")
sHTML=sHTML.replace(/(<fieldset[^>]+)\/>/g,"$1></fieldset>")
var oTagProps={},bGameStage=false,rxTag=/<[^?/][^>]+/ig,rxTagName=/^<(\S+)/i,rxProp=/([^\s=]+)=([\"\'])([\s\S]*?)\2/g,aTags=sHTML.match(rxTag)
if(aTags){for(var i=0;i<aTags.length;i++){var sTag=aTags[i],sTagName,aProp,oProps
if(rxTagName.test(sTag)){sTagName=RegExp.$1.toUpperCase()
oProps={}
while(aProp=rxProp.exec(sTag)){var sProp=aProp[1]
if(sProp.toLowerCase()=="tagtype")sTagName=aProp[3]
oProps[sProp]=1}
if(!oTagProps[sTagName]){oTagProps[sTagName]=oProps}else{for(var sProp in oProps){oTagProps[sTagName][sProp]=1}}
if(sTagName=="stage")bGameStage=true}}}
sHTML=sHTML.replace(/<fieldset([^>]+?)contentEditable=(["'])?true\2([^>]*)>([^<]*)<\/fieldset>/gi,"<input$1 $3 />")
sHTML=sHTML.replace(/<embed([^>]*?)id=(([\"\'])[\s\S]+?\3|[^\s>]+)/ig,"<embed$1id=$2 name=$2")
sHTML=sHTML.replace(/<script\s+(?:[^=]+\s+)?([^=]+)=([\"\']?)(\S+)\2\s+(?:[^=]+\s+)?([^=]+)=([\"\']?)(\S+)\5[^>]*>([\s\S]+?)<\/script>/ig,function(sMatch,sAttr1,sQ1,sVal1,sAttr2,sQ2,sVal2,sCode){var oAttr={}
oAttr[sAttr1.toLowerCase()]=sVal1
oAttr[sAttr2.toLowerCase()]=sVal2
if(oAttr["event"]&&oAttr["for"]){return'<script type="text/javascript">function '+oAttr["for"]+'_Do'+oAttr["event"].replace(/fscommand/i,"FSCommand")+' {\r\n'+sCode+'\r\n}</script>'}else{return sMatch}})
sHTML=sHTML.replace(/<embed[^>]*?type=([\"\']?)application\/x-mplayer2\1[^>]*/ig,function(sMatch){sMatch=sMatch.replace(/([^\s=]+)=([\"\']?)(true|false)\2/ig,function(sMatch,sName,sQuote,sVal){if(sName.indexOf("trans")!=0){if(sVal.toLowerCase()=="true")sVal="1"
if(sVal.toLowerCase()=="false")sVal="0"}
return sName+'='+sQuote+sVal+sQuote})
return sMatch})
sHTML=Adaptie.Style.Rules.processHTML(sHTML,this)
this.appendChild(oRange.createContextualFragment(sHTML))
if(bGameStage){Adaptie.Element.postProcessGame(this,oTagProps)}else{Adaptie.Element.postProcess(this,oTagProps)}
return sHTML}},"HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLQuoteElement"),innerText:_({get:function(){return this.textContent;},set:function(sText){sText=""+sText
if(sText!=""){this.removeEventListener("DOMNodeInserted",Adaptie.Element.unnbspify,false)
this.textContent=sText.replace(/\t/g," ").replace(/  /g," \u200B ")}else{Adaptie.Element.nbspify(this)}
return sText}},"HTMLElement"),outerHTML:_({get:function(){var oEl=this.ownerDocument.createElement("div")
oEl.appendChild(this.cloneNode(true))
return oEl.innerHTML},set:function(sHTML){var oEl=this.ownerDocument.createElement("div"),oRange=this.ownerDocument.createRange()
oEl.innerHTML=sHTML
oRange.selectNodeContents(oEl)
this.parentNode.replaceChild(oRange.extractContents(),this)
return sHTML}},"HTMLElement"),parentElement:_({get:function(){return this.parentNode!=this.ownerDocument?this.parentNode:null;}},"HTMLElement"),pctWidth:_({get:function(){var sW=this.style.width
if(sW){if(sW.indexOf("%")>-1)return sW}else{if(/\D+(\d+)/.test(this.currentStyle.getPropertyValue("-moz-outline-color"))){var sW=RegExp.$1
if(+sW>0)return sW+"%"}}
return""}},"HTMLElement"),readyState:_({get:function(){return this.__readyState!==undefined?this.__readyState:this.complete===false?"loading":"complete";},set:function(sState){return this.__readyState=sState;}},"HTMLDocument","HTMLElement"),runtimeStyle:_({get:function(){return this.style;}},"HTMLElement"),scopeName:_({get:function(){return this.getAttributeNS("","scopename")||"HTML";}},"HTMLElement"),style:_({get:function(){var oStyle=this.__style
oStyle.element=this
return oStyle}},"HTMLDivElement","HTMLSpanElement","HTMLFieldSetElement","HTMLInputElement","HTMLEmbedElement","HTMLImageElement","HTMLTableElement","HTMLAnchorElement","HTMLIFrameElement","HTMLQuoteElement"),tagName:_({get:function(){return this.getAttributeNS("","tagtype")||this.__tagName;}},"HTMLElement","HTMLFieldSetElement","HTMLDivElement","HTMLInputElement","HTMLQuoteElement"),uniqueID:_({get:function(){return this.__UID?this.__UID:this.__UID="emu__id"+(++Adaptie.Element.uidCounter);}},"HTMLDocument","HTMLElement"),postProcess:function(oNode,oTagProps,bIncludeRoot){var aNodes=oNode.getElementsByTagName("*"),aRestore=[],aBehaviors=[],aEmbeds=[]
if(bIncludeRoot){aNodes=Array.prototype.slice.call(aNodes,0)
aNodes.unshift(oNode)}
for(var i=aNodes.length;i--;){var oEl=aNodes[i]
if(oEl.scopeName=="gmv"){oEl.removeNode()
continue}
if(oEl.id)window[oEl.id]=oEl
if(oEl.nodeName=="FIELDSET"&&(oEl.currentStyle.overflowX!="visible"||oEl.currentStyle.overflowY!="visible")&&oEl.currentStyle.position=="absolute"){var oDiv=document.__createElement("blockquote")
for(var j=0;j<oEl.attributes.length;j++){var oAttr=oEl.attributes[j]
if(oAttr.specified){oDiv.setAttributeNS("",oAttr.name,oAttr.value)}}
if(!oEl.style.overflowX||!oEl.style.overflowY){oEl.style.overflowX="";oEl.style.overflowY=""
var sCurX=oEl.currentStyle.overflowX,sCurY=oEl.currentStyle.overflowY
if(/\D+\d+\D+\d+\D+(\d+)/.test(oEl.currentStyle.getPropertyValue("-moz-outline-color"))){var o=Adaptie.Style.Overflow.decode(+RegExp.$1)
if(o.x)sCurX=o.x
if(o.y)sCurY=o.y}
if(!oDiv.style.overflowX)oDiv.style.overflowX=sCurX
if(!oDiv.style.overflowY)oDiv.style.overflowY=sCurY}
oEl.parentNode.insertBefore(oDiv,oEl)
while(oEl.hasChildNodes()){oDiv.appendChild(oEl.firstChild)}
oEl.removeNode(false)
oEl=oDiv
oDiv=null}
if(oEl.currentStyle.display=="none"&&oEl.tagName!="SCRIPT"){oEl.setAttributeNS("","forceshow","1")
aRestore.push(oEl)}}
aNodes=oNode.getElementsByTagName("*")
if(bIncludeRoot){aNodes=Array.prototype.slice.call(aNodes,0)
aNodes.unshift(oNode)}
for(var i=0;i<aNodes.length;i++){var oEl=aNodes[i]
if(oEl.tagName=="SCRIPT"||oEl.tagName=="BR")continue
if(oEl.scopeName!="HTML"&&oEl.hasAttribute("tagType")){Adaptie.NSElement.init(oEl)}
var sQName=((oEl.scopeName!="HTML"?oEl.scopeName+":":"")+oEl.tagName).toLowerCase()
if(Adaptie.TagBehaviors&&Adaptie.TagBehaviors[sQName]){aBehaviors.push({el:oEl,file:Adaptie.TagBehaviors[sQName]})
oEl.readyState="uninitialized"}
if(Adaptie.ClassBehaviors&&Adaptie.ClassBehaviors[oEl.className]){aBehaviors.push({el:oEl,file:Adaptie.ClassBehaviors[oEl.className]})
oEl.readyState="uninitialized"}
if(Adaptie.IdBehaviors&&Adaptie.IdBehaviors[oEl.id]){aBehaviors.push({el:oEl,file:Adaptie.IdBehaviors[oEl.id]})
oEl.readyState="uninitialized"}
if(oEl.nodeName=="MARQUEE"&&oEl.init)try{oEl.init();}catch(e){}
if(oEl.nodeName=="IMG"&&oEl.currentStyle.position!="absolute"&&(oEl.style.height==""||oEl.style.width==""||oEl.style.height=="auto"||oEl.style.width=="auto")){if(oEl.complete)Adaptie.Element.imageLoaded({target:oEl})
else oEl.addEventListener("load",Adaptie.Element.imageLoaded,false)}
if(oEl.nodeName=="INPUT"||oEl.nodeName=="TEXTAREA")Adaptie.Input.init(oEl)
var oProps=oTagProps[oEl.tagName],oSkip={"tagtype":1,"scopename":1,"id":1,"style":1,"class":1,"zindexfixed":1,"zindexinline":1}
if(oProps){for(var sProp in oProps){if(!oSkip[sProp.toLowerCase()]&&!(sProp in oEl)&&typeof oEl[sProp]=="undefined"){Adaptie.Element.wrapAttribute(oEl,sProp)}}}
if(oEl.tagName=="TD"&&oEl.offsetParent){Adaptie.Element.fixTDChildren(oEl)}
Adaptie.Element.fixLayout(oEl)
Adaptie.Element.fixZIndex(oEl)
oEl.disabled=oEl.hasAttributeNS("","disabled")
if(oEl.tagName=="EMBED"&&oEl.currentStyle.visibility=="hidden"){oEl.setAttributeNS("","forceplay","1")
aEmbeds.push(oEl)}}
for(var i=0;i<aRestore.length;i++){aRestore[i].removeAttributeNS("","forceshow")}
if(aEmbeds.length>0){setTimeout(function(){for(var i=0;i<aEmbeds.length;i++){aEmbeds[i].removeAttributeNS("","forceplay")}},0)}
for(var i=0;i<aBehaviors.length;i++){var oEl=aBehaviors[i].el
oEl.addEventListener("emulationdone",Adaptie.Element.emulationDone,false)
oEl.addBehavior(aBehaviors[i].file)}},postProcessGame:function(oNode,oTagProps){setTimeout(waitForTheme,10)
function waitForTheme(){if(oGameStyle.readyState=="complete"){Adaptie.Element.postProcess(oNode,oTagProps)}else{setTimeout(waitForTheme,50)}}},emulationDone:function(oEvent){var oNode=oEvent.target,aNodes=oNode.getElementsByTagName("*"),aRestore=Adaptie.Element.forceShow(oNode);
for(var i=0;i<aNodes.length;i++){var oEl=aNodes[i],oCurStyle=oEl.currentStyle
if(oEl.tagName=="SCRIPT"||oEl.tagName=="BR")continue
Adaptie.Element.fitHeightToContent(oEl)}
Adaptie.Element.forceShow(null,aRestore)
oNode.removeEventListener("emulationdone",Adaptie.Element.emulationDone,false)},imageLoaded:function(event){var oSrc=event.target
setTimeout(function(){Adaptie.Element.fitParentsHeight(oSrc);},0)},fixLayout:function(oEl){if(!oEl.hasAttributeNS("","layoutfixed")){var oCurStyle=oEl.currentStyle
if(oEl.style.left&&oEl.style.left!="auto")oEl.style.right="auto"
if(oEl.style.right&&oEl.style.right!="auto")oEl.style.left="auto"
if(oEl.style.top&&oEl.style.top!="auto")oEl.style.bottom="auto"
if(oEl.style.bottom&&oEl.style.bottom!="auto")oEl.style.top="auto"
if(oEl.nodeName=="FIELDSET"&&!oEl.innerHTML.replace(/[ \f\n\r\t\v]+/,"")){Adaptie.Element.nbspify(oEl)}
if(!Adaptie.HasInlineBlock&&oEl.nodeName=="FIELDSET"&&oCurStyle.position!="absolute"&&oCurStyle.display!="block"&&(!oEl.style.width||oEl.style.width=="auto")&&!oEl.pctWidth){Adaptie.Element.fitWidthToContent(oEl)
var fHandler=Adaptie.Element.fitWidthToContentClosure(oEl)
oEl.addEventListener("DOMNodeInserted",fHandler,false)
oEl.addEventListener("DOMNodeRemoved",fHandler,false)}
var sW=oEl.pctWidth
if(sW&&oEl.nodeName=="FIELDSET"&&oEl.offsetParent){oEl.style.width=Adaptie.Element.getRelativeWidth(oEl,parseFloat(sW))}
Adaptie.Element.fitHeightToContent(oEl)
if(oEl.style.overflowX=="visible"&&oCurStyle.overflowX!="visible"&&oCurStyle.position=="absolute"){var fHandler=Adaptie.Element.fixOverflowClosure(oEl,"width")
if(oEl.readyState=="complete")fHandler()
else oEl.addEventListener("emulationdone",fHandler,false)}
if(oEl.style.overflowY=="visible"&&oCurStyle.overflowY!="visible"&&oCurStyle.position=="absolute"){var fHandler=Adaptie.Element.fixOverflowClosure(oEl,"height")
if(oEl.readyState=="complete")fHandler()
else oEl.addEventListener("emulationdone",fHandler,false)}
Adaptie.Element.fixOddPosition(oEl,"right")
Adaptie.Element.fixOddPosition(oEl,"bottom")
Adaptie.Element.fixPaddingPosition(oEl)
if(!Adaptie.HasInlineBlock&&oEl.nodeName=="FIELDSET"&&oCurStyle.position!="absolute"&&oEl.parentNode.currentStyle.getPropertyValue("display")=="inline"){var oFixer=document.createElement("span")
var oImg=document.createElement("img")
oFixer.appendChild(oImg)
if(oCurStyle.position=="static"){oEl.style.top="auto"
oEl.style.right="auto"}
oFixer.appendChild(oEl.parentNode.replaceChild(oFixer,oEl))
oFixer.className="fixer"
oImg.style.width=oEl.offsetWidth
oImg.style.height=oEl.offsetHeight
oImg.style.height=oEl.offsetHeight-(oEl.offsetTop-oImg.offsetTop)}
if(oCurStyle.position=="absolute"&&(!oEl.style.width||oEl.style.width=="auto")&&oEl.offsetParent&&(oEl.offsetLeft+oEl.offsetWidth)>oEl.offsetParent.offsetWidth){var oNBSP=document.createTextNode("0xA0"),iOrigWidth=oEl.offsetWidth
oEl.appendChild(oNBSP)
if(oEl.offsetWidth>iOrigWidth){var pLeft=parseInt(oEl.offsetParent.currentStyle.paddingLeft),pRight=parseInt(oEl.offsetParent.currentStyle.paddingRight)
oEl.style.width=oEl.offsetParent.offsetWidth-oEl.offsetLeft-pLeft-pRight}
oEl.removeChild(oNBSP)}
if(oEl.currentStyle.fontFamily.toLowerCase().indexOf("dings")>-1&&oEl.nodeName!="FONT"){if(oEl.currentStyle.getPropertyValue("-moz-outline-offset")=="1px"){oEl.innerHTML="&bull;"}else if(navigator.platform.substr(0,3)=="Win"){var sFont=oEl.currentStyle.fontFamily
var oRange=oEl.ownerDocument.createRange(),oFont=oEl.ownerDocument.createElement("font")
oFont.face=sFont
oRange.selectNodeContents(oEl)
oFont.appendChild(oRange.extractContents())
oEl.appendChild(oFont)}else{oEl.style.visibility="hidden"}}
if(oEl.tagName=="UL"){if((!oEl.previousSibling||oEl.previousSibling.nodeType==oEl.TEXT_NODE&&oEl.previousSibling==oEl.parentNode.firstChild&&!oEl.previousSibling.nodeValue.replace(/\s+/,""))&&(!oEl.style.marginTop||oEl.style.marginTop=="auto")){oEl.style.marginTop="0"}}
oEl.setAttributeNS("","layoutfixed","1")}},fixZIndex:function(oEl){if(oEl.hasAttributeNS("","zindexfixed")){if(oEl.hasAttributeNS("","zindexinline")){return}
oEl.style.setProperty("z-index","","")}
if(oEl.style.getPropertyValue("z-index"))oEl.setAttributeNS("","zindexinline",1)
var sZIndex=oEl.currentStyle.getPropertyValue("z-index")
if(sZIndex=="auto")sZIndex=0
oEl.style.setProperty("z-index",+sZIndex+Adaptie.ZINDEX_BASE,"")
oEl.setAttributeNS("","zindexfixed","1")},fitHeightToContent:function(oEl,bSkip){if((oEl.currentStyle.overflowY=="visible"||oEl.style.overflowY=="visible"||!oEl.style.overflowY&&oEl.currentStyle.overflowY=="auto"&&oEl.currentStyle.overflowX=="hidden"||oEl.nodeName=="INPUT")&&oEl.nodeName!="IFRAME"&&oEl.offsetParent&&!oEl.height&&oEl.nodeName!="EMBED"){var curHeight=oEl.__curHeight!==undefined?oEl.__curHeight:oEl.offsetHeight,origHeight=oEl.__origHeight!==undefined?oEl.__origHeight:oEl.style.height,iLineHeight=Math.round(parseFloat(oEl.currentStyle.lineHeight))
oEl.__curHeight=curHeight
oEl.__origHeight=origHeight
oEl.style.setProperty("height","auto","")
if(oEl.offsetHeight<=curHeight){if(oEl.offsetHeight==curHeight&&iLineHeight>curHeight&&(!origHeight||origHeight=="auto")&&!oEl.textContent.replace(/[ \f\n\r\t\v]+/,"")){oEl.style.setProperty("height",iLineHeight,"")}else{oEl.style.setProperty("height",origHeight,"")}}else if(!bSkip){Adaptie.Element.fitParentsHeight(oEl)}}},fitParentsHeight:function(oEl){if(oEl.currentStyle.position!="absolute"){while((oEl=oEl.parentNode)&&oEl.offsetParent){Adaptie.Element.fitHeightToContent(oEl,true)
if(oEl.currentStyle.position=="absolute")break}}},fitWidthToContent:function(oEl){oEl.style.width=""
var origWidth=oEl.getAttributeNS("","origWidth")||oEl.offsetWidth,origPos=oEl.style.position
oEl.setAttributeNS("","origWidth",origWidth)
oEl.style.position="absolute"
if(oEl.offsetWidth<origWidth)oEl.style.width=oEl.offsetWidth
oEl.style.position=origPos},fitWidthToContentClosure:function(oEl){return function(){var aRestore=Adaptie.Element.forceShow(oEl)
Adaptie.Element.fitWidthToContent(oEl)
Adaptie.Element.forceShow(null,aRestore)}},forceShow:function(oEl,aRestore){if(oEl){var oParent,aRestore=[]
if(!oEl.offsetParent){oParent=oEl
do{oParent.setAttributeNS("","forceshow","1")
aRestore.push(oParent)
oParent=oParent.parentNode}while(oParent&&!oEl.offsetParent)}
return aRestore}else if(aRestore){for(var i=aRestore.length;i--;){aRestore[i].removeAttributeNS("","forceshow")}}},fixOverflow:function(oEl,sProp){if(oEl.origVal)oEl.style[sProp]=oEl.origVal
oEl.setAttributeNS("","nomargins","1")
var curVal=oEl[sProp=="width"?"clientWidth":"clientWidth"],scrVal=oEl[sProp=="width"?"scrollWidth":"scrollHeight"]
if(scrVal>curVal){if(oEl[sProp=="width"?"scrollHeight":"scrollWidth"]>oEl[sProp=="width"?"offsetHeight":"offsetWidth"]){scrVal+=Adaptie.Window.Scrollbars[sProp]}
oEl.origVal=oEl.style[sProp]
oEl.style[sProp]=scrVal
oEl.style[sProp=="width"?"overflowX":"overflowY"]="hidden"}
oEl.removeAttributeNS("","nomargins")},fixOverflowClosure:function(oEl,sProp){return function(){oEl.removeEventListener("emulationdone",arguments.callee,false)
Adaptie.Element.fixOverflow(oEl,sProp)}},fixRenderBugs:function(oEl){if(!Adaptie.HasInlineBlock){if(oEl.currentStyle.position=="absolute"){Adaptie.Element.fixOffsetParent(oEl)}else{Adaptie.Element.fixRenderOrder(oEl)}}},fixRenderOrder:function(oEl){var oParent=oEl.parentNode
if(oParent){oParent.setAttributeNS("","forcehide","1")
oParent.offsetWidth
oParent.removeAttributeNS("","forcehide")
Adaptie.Element.fixOffsetParent(oParent)}},fixOffsetParent:function(oEl){var oParent=oEl.parentNode
while(oParent&&oEl.offsetParent!=oParent&&oParent.currentStyle.getPropertyValue("display")=="table-caption"){if(oParent.currentStyle.position!="static"){oParent.setAttributeNS("","forceblock","1")
oParent.offsetWidth
oParent.removeAttributeNS("","forceblock")
break}
oParent=oParent.parentNode}},fixTDChildren:function(oTD){var aNodes=oTD.getElementsByTagName("*"),oTable=oTD.offsetParent,oParent=oTable.offsetParent,iLeft=oTD.offsetLeft+oTable.offsetLeft,iTop=oTD.offsetTop+oTable.offsetTop
for(var i=0;i<aNodes.length;i++){var oNode=aNodes[i]
if(oNode.offsetParent==oParent&&oNode.currentStyle.position=="absolute"){oNode.style.left=oNode.offsetLeft+iLeft
oNode.style.right="auto"
oNode.style.top=oNode.offsetTop+iTop
oNode.style.bottom="auto"}}},fixOddPosition:function(oEl,sProp){var sOppProp=sProp=="right"?"left":"top"
if(oEl.style[sProp]&&oEl.style[sProp]!="auto"&&oEl.offsetParent&&(oEl.offsetParent[sProp=="right"?"offsetWidth":"offsetHeight"]%2)==1){var iCur=parseInt(oEl.currentStyle[sProp]),iTemp
oEl.style[sProp]="0"
iTemp=parseInt(oEl.currentStyle[sProp])
oEl.style[sProp]=iCur-iTemp+1}},fixPaddingPosition:function(oEl){if(oEl.currentStyle.position=="absolute"&&oEl.offsetParent&&oEl.offsetParent.nodeName=="FIELDSET"){var pTop=parseInt(oEl.offsetParent.currentStyle.paddingTop),pLeft=parseInt(oEl.offsetParent.currentStyle.paddingLeft),pBottom=parseInt(oEl.offsetParent.currentStyle.paddingBottom),pRight=parseInt(oEl.offsetParent.currentStyle.paddingRight)
if(oEl.offsetTop==-2000&&(oEl.hasAttributeNS("","curtop")||oEl.hasAttributeNS("","curTop"))&&pTop>0){oEl.style.top=oEl.curTop||""
oEl.curTop=oEl.offsetTop-pTop
oEl.style.top="-2000px"}else if(pTop>0||pBottom>0){if(oEl.style.bottom&&oEl.style.bottom!="auto"){var iCurBottom=parseInt(oEl.currentStyle.bottom),iTempBottom,pFix
oEl.style.bottom=0
iTempBottom=parseInt(oEl.currentStyle.bottom)
if(iTempBottom==0){oEl.style.bottom=iCurBottom-iTempBottom-pBottom}else{oEl.style.bottom=iCurBottom-iTempBottom+pTop}}else if(pTop>0){oEl.style.top=oEl.offsetTop-pTop
oEl.style.bottom="auto"}}
if(pLeft>0||pBottom>0){if(oEl.style.right&&oEl.style.right!="auto"){var iCurRight=parseInt(oEl.currentStyle.right),iTempRight
oEl.style.right=0
iTempRight=parseInt(oEl.currentStyle.right)
if(iTempRight==0){oEl.style.right=iCurRight-iTempRight-pRight}else{oEl.style.right=iCurRight-iTempRight+pLeft}}else if(pLeft>0){oEl.style.left=oEl.offsetLeft-pLeft
oEl.style.right="auto"}}}},getRelativeWidth:function(oEl,iPct){var pLeft=parseInt(oEl.parentNode.currentStyle.paddingLeft),pRight=parseInt(oEl.parentNode.currentStyle.paddingRight),bLeft=parseInt(oEl.parentNode.currentStyle.borderLeftWidth),bRight=parseInt(oEl.parentNode.currentStyle.borderRightWidth),mLeft=0,mRight=0,pW
if(oEl.currentStyle.position!="absolute"){mLeft=parseInt(oEl.currentStyle.marginLeft)
mRight=parseInt(oEl.currentStyle.marginRight)}
oEl.parentNode.setAttributeNS("","nomargins","1")
if(oEl.parentNode.currentStyle.overflowX=="hidden")oEl.parentNode.setAttributeNS("","forcehidechild","1")
pW=oEl.parentNode.offsetWidth-pLeft-pRight-bLeft-bRight-mLeft-mRight
oEl.parentNode.removeAttributeNS("","nomargins")
oEl.parentNode.removeAttributeNS("","forcehidechild")
return pW*(iPct/100)},nbspify:function(oEl){oEl.textContent="\xA0"
oEl.addEventListener("DOMNodeInserted",Adaptie.Element.unnbspify,false)},unnbspify:function(event){var oEl=event.currentTarget,oNode=oEl.firstChild
if(oNode.nodeType==oNode.TEXT_NODE&&oNode.nodeValue=="\xA0")oEl.removeChild(oNode)
oEl.removeEventListener("DOMNodeInserted",arguments.callee,false)},wrapAttribute:function(oEl,sProp){var oAttr=oEl.ownerDocument.createAttributeNS("",sProp)
oAttr.value=oEl.getAttributeNS("",sProp.toLowerCase())
oAttr.expando=true
oEl.removeAttributeNS("",sProp.toLowerCase())
oEl.setAttributeNodeNS(oAttr)
oEl["__"+sProp+"__val"]=oAttr.value
Adaptie.adaptProperty(oEl,sProp,{get:function(){return this["__"+sProp+"__val"]},set:function(xVal){this["__"+sProp+"__val"]=xVal
this.setAttributeNS("",sProp,xVal)
return xVal}})}},NSElement:{init:function(oEl){var sTagType=oEl.getAttribute("tagType")
oEl.getAttribute=Adaptie.NSElement.proxyAttribute.get
oEl.setAttribute=Adaptie.NSElement.proxyAttribute.set
oEl.removeAttribute=Adaptie.NSElement.proxyAttribute.remove
oEl.hasAttribute=Adaptie.NSElement.proxyAttribute.has
oEl.tagType=sTagType
oEl.setAttributeNS("","tagType",sTagType)
if(oEl.currentStyle.getPropertyValue("display")=="inline")oEl.style.display=Adaptie.HasInlineBlock?"inline-block":"table-caption"},proxyAttribute:{get:function(sName){var xVal=this[sName]
return xVal!==undefined?xVal:null},set:function(sName,xVal){this[sName]=xVal
this.setAttributeNS("",sName,xVal)
return xVal},remove:function(sName){this[sName]=null
this.removeAttributeNS("",sName)},has:function(sName){return this[sName]!==undefined&&this[sName]!==null}}},Input:{init:function(oEl){oEl.addEventListener("change",Adaptie.Input.onchange,false)
oEl.addEventListener("focus",Adaptie.Input.onfocus,false)
oEl.addEventListener("blur",Adaptie.Input.onblur,false)
var aAttrs=["color","fontFamily","fontSize","fontStyle","fontVariant","fontWeight","letterSpacing","lineHeight","textAlign","textDecoration","textIndent","textTransform"],oParentStyle=oEl.parentNode.currentStyle
for(var i=0;i<aAttrs.length;i++){var sAttr=aAttrs[i]
if(!oEl.style[sAttr]){oEl.style[sAttr]=oParentStyle[sAttr]}}},contentEditable:_({get:function(){return!this.readOnly;},set:function(bEdit){this.readOnly=!bEdit;return!!bEdit;}},"HTMLInputElement"),innerText:_({get:function(){return this.value;},set:function(sText){sText=""+sText
this.value=sText
this.setAttributeNS("","value",sText)
return sText}},"HTMLInputElement"),onblur:function(oEvent){var oDoc=oEvent.target.ownerDocument
oDoc.body.style.MozUserSelect=oDoc.oldMozUserSelect?oDoc.oldMozUserSelect:""},onchange:function(oEvent){oEvent.target.setAttributeNS("","value",oEvent.target.value)},onfocus:function(oEvent){var oDoc=oEvent.target.ownerDocument
oDoc.oldMozUserSelect=oDoc.body.style.MozUserSelect
oDoc.body.style.MozUserSelect=""}},Node:{getAttribute:_(function(){return null},"Node"),removeNode:_(function(bRemoveChildren){if(!this.parentNode)return this
if(Boolean(bRemoveChildren))return this.parentNode.removeChild(this)
else{var oRange=document.createRange()
oRange.selectNodeContents(this)
return this.parentNode.replaceChild(oRange.extractContents(),this)}},"Node"),replaceNode:_(function(oNewNode){return this.parentNode.replaceChild(oNewNode,this)},"Node"),parentElement:_({get:function(){return this.parentNode;}},"Node"),text:_({get:function(){return this.textContent;},set:function(sVal){return this.textContent=sVal;}},"Node")},Attr:{expando:_({get:function(){return this.__expando==true;},set:function(bExpando){return this.__expando=bExpando;}},"Attr")},Event:{knownEvents:["onfocus","onblur","onchange","onmouseover","onmousedown","onmousemove","onmouseup","onmouseout","onclick","ondblclick","onkeydown","onkeypress","onkeyup","onresize","onscroll"],attachEvent:_(function(sEvent,fHandler){var fWrapper=function(oEvent){if(oEvent instanceof MouseEvent&&oEvent.target.disabled)return false
var oOldEvent=window.event
window.event=oEvent
var xRet=fHandler(oEvent)
window.event=oOldEvent
return xRet},sUID=this.uniqueID
var oCache=fHandler["__"+sEvent]
if(!oCache){fHandler["__"+sEvent]=oCache={}}
if(!oCache[sUID]){oCache[sUID]=[]}
oCache[sUID].push(fWrapper)
this.addEventListener(sEvent.slice(2),fWrapper,false)},"Window","HTMLDocument","HTMLElement"),detachEvent:_(function(sEvent,fHandler){var fWrapper
var sUID=this.uniqueID,oCache=fHandler["__"+sEvent]
if(sUID&&oCache&&oCache[sUID]){fWrapper=oCache[sUID].pop()
if(oCache[sUID].length==0)delete oCache[sUID]}else{fWrapper=fHandler}
this.removeEventListener(sEvent.slice(2),fWrapper,false)},"Window","HTMLDocument","HTMLElement"),fireEvent:_(function(sEvent,oEvent){if(!oEvent){var oDoc=this instanceof Document?this:this.ownerDocument
oEvent=oDoc.createEventObject()}
var bKnown=Adaptie.Event.knownEvents.indexOf(sEvent)>-1
oEvent.initEvent(sEvent.slice(2),bKnown,true)
var oOldEvent=window.event
window.event=oEvent
if(typeof this[sEvent]=="function"&&!bKnown){oEvent.forceTarget=this
this[sEvent]()}
var bReturn=this.dispatchEvent(oEvent)
window.event=oOldEvent
return bReturn},"HTMLDocument","HTMLElement"),fromElement:_({get:function(){return this.relatedTarget}},"MouseEvent"),cancelBubble:_({set:function(b){if(b)this.stopPropagation();}},"Event"),keyCode:_({set:function(){}},"KeyboardEvent"),offsetX:_({get:function(){return this.layerX;}},"MouseEvent"),offsetY:_({get:function(){return this.layerY;}},"MouseEvent"),returnValue:_({set:function(b){if(!b)this.preventDefault();}},"Event"),srcElement:_({get:function(){return this.forceTarget||this.target;}},"Event"),toElement:_({get:function(){return this.relatedTarget}},"MouseEvent"),Wrapper:{init:function(sClass){var aEvents=Adaptie.Event.knownEvents
for(var i=0;i<aEvents.length;i++){Adaptie.Event.Wrapper.wrap(sClass,aEvents[i])}},wrap:function(sClass,sEvent){Adaptie.adaptProperty(sClass,sEvent,{get:function(){return Adaptie.Event.Wrapper.get(this,sEvent)},set:function(fCallback){Adaptie.Event.Wrapper.set(this,sEvent,fCallback)
return fCallback}})},get:function(oEl,sEvent){var fWrapper=oEl["__"+sEvent+"__wrapper"]
if(fWrapper){return fWrapper.callback}},set:function(oEl,sEvent,fCallback){var fWrapper
if(fCallback){Adaptie.Event.Wrapper.set(oEl,sEvent,null)
fWrapper=function(){fCallback.call(oEl);}
fWrapper.callback=fCallback
oEl["__"+sEvent+"__wrapper"]=fWrapper
Adaptie.Event.attachEvent.call(oEl,sEvent,fWrapper);}else{fWrapper=oEl["__"+sEvent+"__wrapper"]
if(fWrapper){Adaptie.Event.detachEvent.call(oEl,sEvent,fWrapper);}
delete oEl["__"+sEvent+"__wrapper"]}}},Capture:{element:null,events:["mousedown","mouseup","mousemove","click","dblclick","mouseover","mouseout"],listener:function(oE){var oCap=Adaptie.Event.Capture
if(!oCap.element)return
oE.stopPropagation()
var oEvent=document.createEvent("MouseEvents")
oEvent.initMouseEvent(oE.type,false,oE.cancelable,oE.view,oE.detail,oE.screenX,oE.screenY,oE.clientX,oE.clientY,oE.ctrlKey,oE.altKey,oE.shiftKey,oE.metaKey,oE.button,oE.relatedTarget)
document.removeEventListener(oE.type,oCap.listener,true)
oCap.element.dispatchEvent(oEvent)
document.addEventListener(oE.type,oCap.listener,true)},setCapture:_(function(){var oCap=Adaptie.Event.Capture
this.releaseCapture()
oCap.element=this
for(var i=0;i<oCap.events.length;i++){document.addEventListener(oCap.events[i],oCap.listener,true)}},"HTMLElement"),releaseCapture:_(function(){var oCap=Adaptie.Event.Capture
for(var i=0;i<oCap.events.length;i++){document.removeEventListener(oCap.events[i],oCap.listener,true)}
oCap.element=null},"HTMLElement")},MouseTrack:{props:["clientX","clientY","offsetX","offsetY","screenX","screenY"],init:function(){var aProps=Adaptie.Event.MouseTrack.props
for(var i=0;i<aProps.length;i++){var sProp=aProps[i]
Adaptie.adaptProperty("Event",sProp,{get:Adaptie.Event.MouseTrack.getter(sProp)})}
Adaptie.Event.MouseTrack.values={}
window.addEventListener("mousemove",Adaptie.Event.MouseTrack.handler,true)},handler:function(event){var aProps=Adaptie.Event.MouseTrack.props,oVals=Adaptie.Event.MouseTrack.values
for(var i=0;i<aProps.length;i++){var sProp=aProps[i]
oVals[sProp]=event[sProp]}},getter:function(sProp){return function(){return Adaptie.Event.MouseTrack.values[sProp]}}}},XML:{createDocument:function(bHTML){var oXML=document.implementation.createDocument("","",null)
if(oXML.readyState==null){if(bHTML){oXML.readyState="loading"
oXML.hasLoaded=function(){oXML.readyState="interactive"
if(typeof oXML.onreadystatechange=="function")oXML.onreadystatechange()
oXML.readyState="complete"
if(typeof oXML.onreadystatechange=="function")oXML.onreadystatechange()}}else{oXML.readyState=1
oXML.hasLoaded=function(){oXML.readyState=3
if(typeof oXML.onreadystatechange=="function")oXML.onreadystatechange()
oXML.readyState=4
if(typeof oXML.onreadystatechange=="function")oXML.onreadystatechange()}}}
return oXML},cloneNode:_(function(bDeep){var oNode=this.__cloneNode(bDeep)
if(!oNode.__props)oNode.__props={}
for(var sKey in this.__props){oNode.__props[sKey]=this.__props[sKey]}
return oNode},"XMLDocument"),createNode:_(function(iType,sName,sURI){switch(iType){case this.ELEMENT_NODE:return sURI?this.createElementNS(sURI,sName):this.createElement(sName)
case this.ATTRIBUTE_NODE:return sURI?this.createAttributeNS(sURI,sName):this.createAttribute(sName)
case this.TEXT_NODE:return this.createTextNode("")
case this.CDATA_SECTION_NODE:return this.createCDATASection("")
case this.ENTITY_REFERENCE_NODE:return this.createEntityReference(sName)
case this.PROCESSING_INSTRUCTION_NODE:return this.createProcessingInstruction(sName,"")
case this.COMMENT_NODE:return this.createComment("")
case this.DOCUMENT_FRAGMENT_NODE:return this.createDocumentFragment()}},"XMLDocument"),createNSResolver:_(function(oNode){var oNSResolver=this.__createNSResolver(oNode),sNS=this.getProperty("SelectionNamespaces")
if(sNS){var aMatch,oNS={}
while(aMatch=/xmlns:([^=]+)=([\"\'])(.*?)\2/g.exec(sNS)){var sPrefix=aMatch[1],sURI=aMatch[3]
if(sPrefix&&sURI){oNS[sPrefix]=sURI}}
return function(sPrefix){return oNS[sPrefix]||oNSResolver.lookupNamespaceURI(sPrefix)}}
return oNSResolver},"XMLDocument"),getAttribute:_(function(attrName){return this[attrName]},"XMLDocument"),getProperty:_(function(sName,sVal){return this.__props?this.__props[sName]:undefined},"XMLDocument"),load:_(function(sURL){this.loadXML("")
var oXML=this,oXH=new XMLHttpRequest()
oXH.open("GET",sURL,true)
oXH.onreadystatechange=function(){if(oXH.readyState==4){var oResXML=oXH.responseXML
if(oResXML){for(var iNode=0;iNode<oResXML.childNodes.length;iNode++)oXML.appendChild(oXML.importNode(oResXML.childNodes[iNode],true))}
oXML.hasLoaded()}}
oXH.send(null)},"XMLDocument",true),loadXML:_(function(sXML){try{while(this.hasChildNodes())this.removeChild(this.lastChild)
if(sXML){var oXMLParser=new DOMParser().parseFromString(sXML,"text/xml")
if(oXMLParser.firstChild&&oXMLParser.firstChild.tagName=="parsererror")throw new Error("Parse error")
for(var iNode=0;iNode<oXMLParser.childNodes.length;iNode++)this.appendChild(this.importNode(oXMLParser.childNodes[iNode],true))}
return true}catch(oErr){return false}},"XMLDocument"),selectNodes:_(function(cXPathString,xNode){if(!xNode)xNode=this
var oNSResolver=this.createNSResolver(this.documentElement),aItems=this.evaluate(cXPathString,xNode,oNSResolver,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,null),aResult=[]
for(var i=0;i<aItems.snapshotLength;i++)aResult[i]=aItems.snapshotItem(i)
return aResult},"XMLDocument"),selectSingleNode:_(function(cXPathString,xNode){if(!xNode)xNode=this
var xItems=this.selectNodes(cXPathString,xNode)
if(xItems.length>0)return xItems[0]
return null},"XMLDocument"),setAttribute:_(function(attrName,attrValue){return this[attrName]=attrValue},"XMLDocument"),setProperty:_(function(sName,sVal){if(!this.__props)this.__props={}
this.__props[sName]=sVal},"XMLDocument"),xml:_({get:function(){return new XMLSerializer().serializeToString(this);}},"XMLDocument")},Style:{init:function(){for(var i=0;i<this.length;i++){var prop=this.item(i)
this[prop]=this.getPropertyValue(prop)}},removeAttribute:_(function(sName){this[sName]=""
this.removeProperty(sName)
return true},"CSSStyleDeclaration"),backgroundImage:_({get:function(){return this.getPropertyValue("background-image");},set:function(sImg){sImg=sImg.replace(/^url\(\s*([\"\'])?(.+?)\1\s*\)$/gi,'url("$2")')
this.setProperty("background-image",sImg,"")
return sImg}},"CSSStyleDeclaration"),cssText:_({set:function(sCSS){sCSS=sCSS||""
sCSS=Adaptie.Style.Rules.processCursor(sCSS)
sCSS=sCSS.replace(/url\(\s*([\"\'])?(.+?)\1\s*\)\s*(;|$)/gi,'url("$2")$3')
sCSS=sCSS.replace(/font-family\s*:\s*([\"\'])?([^,;]+?)\1\s*(;|$)/gi,'font-family:"$2"$3')
this.__cssText=sCSS
if(this.element)Adaptie.Element.fixZIndex(this.element)
return sCSS}},"CSSStyleDeclaration"),cursor:_({get:function(){var sCursor=this.getPropertyValue("cursor")
return sCursor=="pointer"?"hand":sCursor},set:function(sCursor){if(sCursor=="hand")sCursor="pointer"
this.setProperty("cursor",sCursor,"")
return sCursor}},"CSSStyleDeclaration","ComputedCSSStyleDeclaration"),display:_({get:function(){var sDisp=this.getPropertyValue("display");return sDisp=="table-caption"||sDisp=="inline-block"?"inline":sDisp;},set:function(sDisp){sDisp=(sDisp||"").toLowerCase()
if(sDisp=="inline")sDisp=Adaptie.HasInlineBlock?"inline-block":"table-caption"
this.setProperty("display",sDisp,"")
if(this.element){if(sDisp!="none"){Adaptie.Element.fixRenderBugs(this.element)
var aNodes=this.element.getElementsByTagName("*")
for(var i=0;i<aNodes.length;i++){Adaptie.Element.fitHeightToContent(aNodes[i],true)}}
Adaptie.Element.fitParentsHeight(this.element)}
return sDisp}},"CSSStyleDeclaration","ComputedCSSStyleDeclaration"),filter:_({get:function(){if(this.opacity){return"alpha(opacity="+this.opacity*100+")"}
return""},set:function(sFilter){if(sFilter){if(/(?:progid:DXImageTransform\.Microsoft\.)?alpha\(opacity=([\d\.]+)\)/.test(sFilter)){this.opacity=RegExp.$1/100}}else{this.opacity=""}
return sFilter}},"CSSStyleDeclaration"),hasLayout:_({get:function(){return true;}},"ComputedCSSStyleDeclaration"),height:_({get:function(){return this.getPropertyValue("height");},set:function(sVal){this.setProperty("height",sVal,"")
if(this.element){delete this.element.__curHeight
delete this.element.__origHeight
if(sVal!="auto"){Adaptie.Element.fitHeightToContent(this.element)}}
return sVal}},"CSSStyleDeclaration"),opacity:_({get:function(){return this.getPropertyValue("opacity");},set:function(sOpacity){var iCur=this.element.currentStyle.opacity,iNew=+sOpacity,bParentFix=iCur==1&&iNew!=1||iCur!=1&&iNew==1
this.setProperty("opacity",sOpacity,"")
if(bParentFix&&this.element){Adaptie.Element.fixRenderBugs(this.element)}
return sOpacity}},"CSSStyleDeclaration"),position:_({get:function(){return this.getPropertyValue("position");},set:function(sPos){this.setProperty("position",sPos,"")
if(this.element){Adaptie.Element.fixRenderBugs(this.element)}
return sPos}},"CSSStyleDeclaration"),zIndex:_({get:function(){var sVal=this.getPropertyValue("z-index")
return+(sVal=="auto"?0:sVal)-Adaptie.ZINDEX_BASE},set:function(xVal){xVal=+xVal
this.setProperty("z-index",+xVal+Adaptie.ZINDEX_BASE,"")
if(this.element)this.element.setAttributeNS("","zindexinline",1)
return xVal}},"CSSStyleDeclaration","ComputedCSSStyleDeclaration"),Link:{href:_({set:function(sURL){if(sURL.indexOf("javascript")!=0){var sBaseURL=sURL.replace(/\?.*$/,"").replace(/[^\/]*$/,""),sHost=location.href.replace(/^([^:]+:\/+[^\/]+).*$/,"$1"),oSheet=this,aBehaviors=[]
if(sBaseURL.charAt(0)=="/"){sBaseURL=sHost+sBaseURL}else{sBaseURL=location.href.replace(/\?.*$/,"").replace(/#.*$/,"").replace(/[^\/]*$/,"")+sBaseURL}
sBaseURL=sBaseURL.replace(/\(/g,"\\28 ").replace(/\)/g,"\\29 ")
this.readyState="loading"
httpLoader("GET",sURL,function(oXML){var sCSS=oXML.responseText
if(!sCSS||(oXML.status!=200&&oXML.status!=0)){oSheet.__href=sURL
oSheet.readyState="complete"
return}
if(sCSS){sCSS=sCSS.replace(/([^\s]+)\s*\{\s*behavior:url\(([^}]+)\)[^}]*\}/gi,function(sMatch,sSelector,sURL){if(sSelector.indexOf("#")==0){var sId=sSelector.substr(1)
Adaptie.IdBehaviors[sId]=sURL
aBehaviors.push({id:sId,url:sURL})}else if(sSelector.indexOf(".")==0){var sClass=sSelector.substr(1)
Adaptie.ClassBehaviors[sClass]=sURL}else{var sTag=sSelector.replace(/\\:/g,":").toLowerCase()
Adaptie.TagBehaviors[sTag]=sURL
aBehaviors.push({tag:sTag,url:sURL})}
return""})
sCSS=sCSS.replace(/\bgm\\:contentarea/gi,"#oContentArea")
sCSS=sCSS.replace(/\b(\S+?)\\:([^\s\.#,]+)/g,function(sMatch,sNS,sTag){return'*[scopeName="'+sNS+'"][tagtypelc="'+sTag.toLowerCase()+'"]'})
sCSS=sCSS.replace(/url\(([\"\'])?(?=\/)/gi,"url($1"+sHost)
sCSS=sCSS.replace(/url\(([\"\'])?(?!http)/gi,"url($1"+sBaseURL)
sCSS=sCSS.replace(/#oTopLevelLayer\s+\./g,"#oTopLevelLayer #oContentArea .")
sCSS=sCSS.replace(/#oTopLevelLayer/g,"#oTopLevelLayer.topLevelLayer")
sCSS=Adaptie.Style.Rules.processCSS(sCSS)
if(!oSheet.id)oSheet.id=oSheet.uniqueID
sCSS+="\n#"+oSheet.id+" { -moz-outline-offset:1px; }"
oSheet.setAttribute("href","data:text/css,"+escape(sCSS))}else{oSheet.setAttribute("href","javascript:''")}
function waitForCSS(){if(oSheet.currentStyle.getPropertyValue("-moz-outline-offset")!="1px"){setTimeout(waitForCSS,10)
return}
for(var i=0;i<aBehaviors.length;i++){if(aBehaviors[i].tag){var sScope="HTML",sTag=aBehaviors[i].tag
if(sTag.indexOf(":")>-1){sScope=sTag.replace(/:.*$/,"")
sTag=sTag.replace(/^.*:/,"")}
var oNodes=document.getElementsByTagName(sTag)
for(var j=0;j<oNodes.length;j++){if(oNodes[j].scopeName==sScope){oNodes[j].addBehavior(aBehaviors[i].url)}}}else if(aBehaviors[i].id){var oNode=document.getElementById(aBehaviors[i].id)
if(oNode){oNode.addBehavior(aBehaviors[i].url)}}}
oSheet.readyState="complete"
oSheet.fireEvent("onload")}
waitForCSS()},null,this.isCreateStyleSheetRequest||false)}else{this.__href=sURL
this.readyState="complete"}
return sURL}},"HTMLLinkElement")},Overflow:{hash:{"visible":1,"hidden":2,"scroll":3,"auto":4},rxX:/[\s;{](?:overflow-x\s*:\s*(visible|hidden|scroll|auto))/i,rxY:/[\s;{](?:overflow-y\s*:\s*(visible|hidden|scroll|auto))/i,encode:function(sOverflowX,sOverflowY){var iX=Adaptie.Style.Overflow.hash[sOverflowX]||0,iY=Adaptie.Style.Overflow.hash[sOverflowY]||0
return(iX<<3)|iY},decode:function(iCode){var iX=iCode>>3,iY=iCode&7
return{x:lookup(iX),y:lookup(iY)}
function lookup(i){for(var s in Adaptie.Style.Overflow.hash){if(Adaptie.Style.Overflow.hash[s]==i)return s}
return""}}},Rules:{processCSS:function(sCSS){sCSS=Adaptie.Style.Rules.processCursor(sCSS)
sCSS=Adaptie.Style.Rules.processBullet(sCSS)
sCSS=Adaptie.Style.Rules.processBorder(sCSS)
sCSS=sCSS.replace(/url\(\s*([\"\'])?(.+?)\1\s*\)\s*([;}]|$)/g,function(sMatch,sQuote,sURL,sDelim){return'url("'+sURL.replace(/\{/g,"%7B").replace(/\}/g,"%7D")+'")'+sDelim})
sCSS=sCSS.replace(/font-family\s*:\s*([\"\'])?([^,;]+?)\1\s*([;}]|$)/gi,'font-family:"$2"$3')
sCSS=sCSS.replace(/(\{)([^}]+)/g,function(sAll,sPreText,sRuleText){sRuleText=Adaptie.Style.Rules.processBGPosition(sRuleText)
if(/[\s;{]width\s*:\s*(?:([\d\.]+)%)?/i.test(sRuleText)){var iPctWidth=RegExp.$1?Math.round(RegExp.$1):0
var sOverflowX="",sOverflowY="",iOverflow
if(Adaptie.Style.Overflow.rxX.test(sRuleText))sOverflowX=RegExp.$1.toLowerCase()
if(Adaptie.Style.Overflow.rxY.test(sRuleText))sOverflowY=RegExp.$1.toLowerCase()
iOverflow=Adaptie.Style.Overflow.encode(sOverflowX,sOverflowY)
sRuleText+=";-moz-outline-color:rgb("+iPctWidth+",0,"+iOverflow+");"}
if(/left\s*:\s*([^\s;]+)?/i.test(sRuleText)&&RegExp.$1!="auto")sRuleText+=";right:auto;"
if(/top\s*:\s*([^\s;]+)?/i.test(sRuleText)&&RegExp.$1!="auto")sRuleText+=";bottom:auto;"
return sPreText+sRuleText})
return sCSS},processHTML:function(sHTML,oParent){return sHTML.replace(/(<[^>]+\sstyle\s*=\s*)(([\"\'])[\s\S]+?(?=\3)|[^\s>]+)/ig,function(sAll,sPreText,sRuleText){sRuleText=Adaptie.Style.Rules.processBGPosition(sRuleText)
sRuleText=sRuleText.replace(/url\((?!&quot;)([\"\'])?(.+?)\1\)\s*(;|$)/gi,function(sAll,sQuote,sUrl){return"url(&quot;"+sUrl.replace(/&/g,"&amp;")+"&quot;);"})
sRuleText=Adaptie.Style.Rules.processCursor(sRuleText)
sRuleText=Adaptie.Style.Rules.processBullet(sRuleText)
sRuleText=Adaptie.Style.Rules.processBorder(sRuleText)
sRuleText=sRuleText.replace(/font-family\s*:(?!\s*&quot;)\s*([\"\'])?([^,;]+?)\1\s*(;|$)/gi,"font-family:&quot;$2&quot;"+(oParent?","+oParent.currentStyle.fontFamily.replace(/\"/g,"&quot;"):"")+"$3")
return sPreText+sRuleText})},processBGPosition:function(sRuleText){var oPos={}
sRuleText=sRuleText.replace(/\s*background-position-(x|y)\s*:\s*([^\s};]+)\s*(?:!important)?;?/gi,function(sAll,xy,val){oPos[xy.toLowerCase()]=val
return""})
if(oPos.x||oPos.y)return sRuleText+";background-position:"+(oPos.x||"0")+" "+(oPos.y||"0")+";"
return sRuleText},processCursor:function(sCSS){return sCSS.replace(/cursor\s*:\s*hand\s*;?/ig,"cursor:pointer;")},processBullet:function(sCSS){return sCSS.replace(/mso-special-format:\s*bullet[^\s;]*/gi,"-moz-outline-offset:1px")},processBorder:function(sCSS){return sCSS.replace(/border(-(?:top|right|bottom|left))?\s*:\s*([^\s;}]+)(?:\s+([^\s;}]+))?(?:\s+([^\s;}]+))?/gi,function(sAll,sDir){var sWidth="4px",sStyle="none",sColor=""
for(var i=2;i<5;i++){var sArg=arguments[i]
if(/^(none|dotted|dashed|solid|double|groove|ridge|inset|outset)$/i.test(sArg))sStyle=sArg
else if(/^[\d.]+([a-zA-Z]{2})?$/.test(sArg))sWidth=sArg
else if(sArg)sColor=sArg}
return"border"+sDir+"-width:"+sWidth+"; border"+sDir+"-style:"+sStyle+(sColor?"; border"+sDir+"-color:"+sColor:"")})}}}}
try{if(Object.__defineSetter__&&Object.__defineGetter__){function adaptFields(oObj){for(var sField in oObj){var xField=oObj[sField],sType=typeof xField
if(sType=="object"&&xField||sType=="function"){if(xField.hasOwnProperty("_classes")){var aClasses=xField._classes,bForce=xField._force,fAdapt=sType=="function"?Adaptie.adaptMethod:Adaptie.adaptProperty
for(var i=0;i<aClasses.length;i++){fAdapt(aClasses[i],sField,xField,bForce)}
delete xField._classes
delete xField._force}else if(sType=="object"){adaptFields(xField)}}}}
adaptFields(Adaptie)
window.event=null
Adaptie.Event.Wrapper.init("HTMLElement")
Adaptie.Event.MouseTrack.init()
CSSStyleDeclaration.prototype=Adaptie.Style.init
function GMNodeList(){}
GMNodeList.prototype=new Array()
GMNodeList.prototype.item=function(vIndex){return this[vIndex]}
GMNodeList.prototype.tags=function(sTag){sTag=sTag.toLowerCase()
var aList=new GMNodeList()
for(var i=0;i<this.length;i++){var oNode=this[i]
if(oNode.tagName.toLowerCase()==sTag){aList.push(oNode)}}
return aList}
GMNodeList.prototype.concat=function(){var aRes=new GMNodeList()
for(var i=0;i<this.length;i++){aRes.push(this[i])}
for(var i=0;i<arguments.length;i++){var xArg=arguments[i]
if(xArg instanceof Array){for(var j=0;j<xArg.length;j++){aRes.push(xArg[j])}}else{aRes.push(xArg)}}
return aRes}
addEventListener("load",Adaptie.init,true)
Adaptie.canAdapt=true}}catch(e){Adaptie.canAdapt=false}})();