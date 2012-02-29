/*@cc_on @*/
var sProjectId,oResource,sCurrentTheme="@NONE",oScope,oHistory={back:[],forward:[]},oPersist={},oConfig=getXMLDocument()
try{document.execCommand("BackgroundImageCache",false,true)}
catch(oErr){}
onload=function(){var oRequest={},aQS=location.href.replace(/.*?\?/,"").split("&")
for(var iQS=0;iQS<aQS.length;iQS++){var aPair=aQS[iQS].split("=")
oRequest[aPair[0]]=decodeURIComponent(aPair[1])}
if(oDocContent.parentNode!==oContentArea){var oNode=document.createElement("div")
oTopLevelLayer.replaceChild(oNode,oContentArea)
oNode.id="oContentArea"
oNode.appendChild(oDocContent)
oNode.appendChild(oMenuContent)
oNode.appendChild(oMasterContent)
oContentArea=oNode}
VarInterface.Init(document)
if(oRequest.nobehavior!="1"){oBehaveStyle.href="Runtime/behavior.css"}else{document.body.addBehavior("Runtime/runtimeEvents.htc")
document.body.appendChild(document.createElement("gm:transalpha"))}
waitForProject()
setInterval(function(){document.body.offsetTop;},10)
function waitForProject(){if(document.body.readyState=="complete"&&oBehaveStyle.readyState=="complete"){initLoad(oRequest)}else{setTimeout(waitForProject,30)}}}
function initLoad(oRequest){try{focus();}catch(oErr){}
if(!document.body.isReady){var oWin=window
try{if(parent.document&&parent.oCourse==oWin)oWin=parent;}catch(e){}
return oWin.document.body.innerHTML='<div class="failMsg"><p><strong>The course cannot start because Script Behaviors could not be loaded.</strong></p><p>This might be a result of:</p><ul><li>A browser configuration issue: Please go to Tools -&gt; Internet Options -&gt; Security -&gt; Custom -&gt; Binary and script behaviors -&gt; Allow.</li><li>A web-server configuration issue: For Script Behaviors to operate properly, the Content-Type header of HTC files must be set to \'text/x-component\' in the hosting web-server. Please see <a href="http://support.microsoft.com/kb/306231">http://support.microsoft.com/kb/306231</a> for more information and configuration assistance.</div>'}
sProjectId=document.ProjectId||oRequest.project
loadProject(sProjectId,oRequest)}
function loadProject(sId,oDefaults){var oXML=oConfig
oXML.onreadystatechange=function(){if(oXML&&oXML.readyState==4){oXML.onreadystatechange=function(){}
var oProject=oConfig.firstChild
if(oProject){var bPersist
LMSInterface.Init()
if(oDefaults.mode=="solo")oProject.removeAttribute("restoreUserdata");
if(sProjectId=="Res"&&!oDefaults.skipRestore){bPersist=State.restore(oXML,oDefaults)}
var oStruct=oXML.selectSingleNode("//structure")
oProject=oConfig.firstChild;
if(!bPersist)prepareTests(oStruct,oDefaults.resource)
oXML=null
document.title=oProject.getAttribute("title")
oTopLevelLayer.runtimeStyle.width=oProject.getAttribute("windowWidth")
oTopLevelLayer.runtimeStyle.height=oProject.getAttribute("windowHeight")
oContentArea.runtimeStyle.width=oProject.getAttribute("windowWidth")
oContentArea.runtimeStyle.height=oProject.getAttribute("windowHeight")
oTopLevelLayer.runtimeStyle.overflow="hidden"
oTopLevelLayer.setAttribute("baseStyle",oTopLevelLayer.style.cssText)
oCustomRules.href=cacheURL(GET_CUSTOM_STYLESHEET+"?project="+encodeURIComponent(sId))
oBaseTheme.href=cacheURL(GENERIC_REDIRECTOR+"?url="+encodeURIComponent(cacheURL(GET_PROJECT_RESOURCE+"?readonly=1&project="+encodeURIComponent(sProjectId)+"&resource="+encodeURIComponent("../../Themes/baseTheme.css"))))
if(oDefaults.resource){oResource=oStruct.selectSingleNode(".//*[@id=\""+oDefaults.resource+"\"]")
if(!oResource){var oNonStdResource=oStruct.selectSingleNode("//*[@id=\""+oDefaults.resource+"\"]")
if(oNonStdResource){oResource=oStruct.ownerDocument.createElement("page")
for(var iAttr=0;iAttr<oNonStdResource.attributes.length;iAttr++){oResource.setAttributeNode(oNonStdResource.attributes[iAttr].cloneNode(true))}
oResource.setAttribute("master","@NONE")
oResource.setAttribute("menu","@NONE")
oStruct.insertBefore(oResource,oStruct.firstChild)}}
if(oResource){if(oDefaults.theme)oResource.setAttribute("theme",oDefaults.theme)
if(oDefaults.master)oResource.setAttribute("master",oDefaults.master)
if(oDefaults.menu)oResource.setAttribute("menu",oDefaults.menu)
if(oDefaults.mode=="solo"){var oKeep
if(oResource.tagName=="test"||oResource.selectSingleNode("test"))oKeep=oResource.cloneNode(true)
else oKeep=oResource.cloneNode(false)
while(oStruct.hasChildNodes())oStruct.removeChild(oStruct.firstChild)
oStruct.appendChild(oKeep)
oResource=oKeep}}}
if(!oResource)oResource=oStruct.firstChild
if(oResource){var oNavId=getNavNode(oResource);
if(!oNavId)oNavId=getNavNode(oResource,"previous");
if(oNavId!==oResource)oResource=oNavId
if(oResource){var oNum=getNavNode(oStruct.firstChild,null,null,true),iTotal=0,iChapTotal
while(oNum){iTotal++
oNum.setAttribute("pageNum",iTotal)
iChapTotal=+oNum.parentNode.getAttribute("chapPageTotal")+1
oNum.parentNode.setAttribute("chapPageTotal",iChapTotal)
oNum.setAttribute("chapPageNum",iChapTotal)
oNum=getNavNode(oNum,"next",null,true)}
oProject.setAttribute("totalPages",iTotal)
VarInterface.Add("project title","Direct",document.title)
VarInterface.Add("location title","Custom",function(){return oResource.getAttribute("title");})
VarInterface.Add("total pages","Direct",iTotal)
VarInterface.Add("page number","Custom",function(){return oResource.getAttribute("pageNum");})
VarInterface.Add("total done","Custom",function(){return oStruct.selectNodes(".//*[@done=\"true\" and (@skip=\"false\" or not(@skip))]").length;})
VarInterface.Add("chapter page number","Custom",function(){return oResource.getAttribute("chapPageNum");})
VarInterface.Add("chapter total pages","Custom",function(){return oResource.parentNode.getAttribute("chapPageTotal");})
VarInterface.Add("chapter total done","Custom",function(){return oResource.parentNode.selectNodes("*[@done=\"true\" and (@skip=\"false\" or not(@skip))]").length;})
VarInterface.Add("current global score","Custom",function(){var aTests=oStruct.selectNodes('.//test[not(@globalScore) or @globalScore="true"]')
if(aTests.length>0){var iSum=0
for(var iTest=0;iTest<aTests.length;iTest++)iSum+=aTests[iTest].getAttribute("totalscore")*1
return getFixed(iSum/aTests.length)||0}
return 100})
VarInterface.Add("composica_student_id","Custom",function(){return oProject.getAttribute("composicaStudentId");})
oStruct.setAttribute("visited","true")
var oCacher
try{oCacher=parent.CacheManager;}catch(e){}
if(oCacher&&oCacher.isCapable(oProject)){var aToCache=[],oLastNode=oResource
for(var iId=0;iId<oCacher.cacheAhead;iId++){if(oLastNode)aToCache.push(oLastNode.getAttribute("id"),findAttribute("master",oLastNode),findAttribute("menu",oLastNode))
else break
oLastNode=getNavNode(oLastNode,"next",null,true)}
document.body.attachEvent("onnavigate",function(event){if(arguments.callee.ready){var oLastNode=oResource,bAccept=false
do{oLastNode=getNavNode(oLastNode,"next",null,true)
if(oLastNode)bAccept=oCacher.cache(oLastNode.getAttribute("id"))}while(oLastNode&&!bAccept)
if(bAccept){oCacher.cache(findAttribute("master",oLastNode))
oCacher.cache(findAttribute("menu",oLastNode))}}
arguments.callee.ready=true})
return oCacher.init(aToCache,function(){loadResource(oResource);})}
if(oCacher)oCacher.disable()
return loadResource(oResource)}}
alert("Recurso no encontrado.")}else{oXML=null
alert("Proyecto no encontrado.")}}}
oXML.load(cacheURL(GET_PROJECT_STATE+"?wizard="+(oDefaults.wizard||"")+"&readonly=1&project="+encodeURIComponent(sId)))}
function prepareTests(oStruct,forceIncludeId){var aTests=oStruct.selectNodes(".//test"),sIncludeTestId,sIncludeSectId
if(!!forceIncludeId){var oInclude=oStruct.selectSingleNode("//*[@id=\""+forceIncludeId+"\"]")
if(oInclude.parentNode.tagName!="section"&&oInclude.tagName!="section"){forceIncludeId=null}else{sIncludeTestId=oInclude.tagName=="section"?oInclude.parentNode.getAttribute("id"):oInclude.parentNode.parentNode.getAttribute("id")}}
for(var iTest=0;iTest<aTests.length;iTest++){var oTest=aTests[iTest],sMode=oTest.getAttribute("testMode")
if(oTest.getAttribute("testMode")=="globalbank"){var iCurLen=oTest.selectNodes(".//page").length,sLen=oTest.getAttribute("questNumber"),iGlobalLen=!sLen||sLen=="All"?iCurLen:+sLen
if(iCurLen>iGlobalLen){var aSects=oTest.childNodes,iSectLen=aSects.length,iTargetLen=0,aVSects=[]
for(var iS=0;iS<iSectLen;iS++){aVSects[iS]={current:+aSects[iS].childNodes.length,target:0}}
var iSect=-1
if(!!forceIncludeId&&sIncludeTestId==oTest.getAttribute("id")){var sIncSectId=oInclude.parentNode.getAttribute("id")
for(var iS=0;iS<iSectLen;iS++){if(aSects[iS].getAttribute("id")==sIncSectId){iSect=iS
break}}}
if(iSect==-1){iSect=Math.floor(Math.random()*iSectLen)}
while(iTargetLen<iGlobalLen){oVSect=aVSects[iSect]
if(oVSect.current){oVSect.current--
oVSect.target++
iTargetLen++}
iSect=(iSect+1)%iSectLen}
for(var iSect=0;iSect<iSectLen;iSect++){aSects[iSect].setAttribute("questNumber",aVSects[iSect].target)}
oTest.setAttribute("testMode","bank")}}
if(oTest.getAttribute("testMode")=="bank"){var aSects=oTest.childNodes
for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect],iCurLen=oSect.childNodes.length
sLen=oSect.getAttribute("questNumber"),iDesiredLen=!sLen||sLen=="All"?iCurLen:+sLen
while(iCurLen>iDesiredLen){var oSelNode=oSect.childNodes[Math.floor(Math.random()*iCurLen)]
if(oSelNode.getAttribute("id")!=forceIncludeId){oSect.removeChild(oSelNode)
iCurLen--}}}}
if(oTest.getAttribute("scoreMethod")=="normal"||oTest.getAttribute("scoreMethod")==null){var aQuests=oTest.selectNodes(".//page"),aSects=oTest.childNodes,iQuestLen=aQuests.length
if(iQuestLen>0){var iScore=getPrecision(100/iQuestLen)
for(var iQst=0;iQst<iQuestLen;iQst++)aQuests[iQst].setAttribute("maxScore",iScore)
for(var iSect=0;iSect<aSects.length;iSect++){var iWeight=aSects[iSect].childNodes.length*iScore
aSects[iSect].setAttribute("weight",iWeight)}}}else if(oTest.getAttribute("scoreMethod")=="sect"){var aSects=oTest.childNodes,iAutoSect=0,iNoneSect=0,iDiff,iConfigScore=0
for(var iSect=0;iSect<aSects.length;iSect++){var iWeight=aSects[iSect].getAttribute("weight")
if(iWeight=="Auto"||iWeight==null){iAutoSect++}else if(iWeight=="None"){aSects[iSect].setAttribute("weight","0")
iNoneSect++}else{iConfigScore+=iWeight*1||0}}
if(iConfigScore<100){if(iAutoSect==0){iDiff=getPrecision((100-iConfigScore)/(aSects.length-iNoneSect))
for(var iSect=0;iSect<aSects.length;iSect++){var iW=aSects[iSect].getAttribute("weight")
if(iW!=="0"){aSects[iSect].setAttribute("weight",+iW+iDiff)}}}else{iDiff=getPrecision((100-iConfigScore)/iAutoSect)}}
for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect],aQuests=oSect.selectNodes(".//page"),iQuestLen=aQuests.length
if(iQuestLen>0){var iScore=oSect.getAttribute("weight")
if(iScore=="Auto"||iScore==null){iScore=iDiff
oSect.setAttribute("weight",iScore)}
iScore=getPrecision(iScore/iQuestLen)
for(var iQst=0;iQst<iQuestLen;iQst++){var oQuestNode=aQuests[iQst]
oQuestNode.setAttribute("maxScore",iScore)
oQuestNode.setAttribute("sectType",oSect.getAttribute("sectType")||"question")}}}}
var sTL=oTest.getAttribute("timeLimit")
if(sTL){var aSects=oTest.childNodes,sPeriod=oTest.getAttribute("limitPeriod")
if(sTL=="limited"||sTL=="sect"){for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect],sSectMode=oSect.getAttribute("timeLimit")
if(sSectMode=="global"){if((!oTest.getAttribute("sectionOrder")||oTest.getAttribute("sectionOrder")=="normal")&&(!oTest.getAttribute("questionOrder")||oTest.getAttribute("questionOrder")=="normal")){oSect.setAttribute("globalTime",(oSect.getAttribute("limitPeriod")||"10min"))}}else{var aQuests=oSect.selectNodes(".//page"),iQuestLen=aQuests.length,sSectPeriod=sTL=="sect"?(sSectMode=="limited"?(oSect.getAttribute("limitPeriod")||"5sec"):0):(sPeriod||"5sec")
if(sSectPeriod!=0){for(var iQst=0;iQst<iQuestLen;iQst++){aQuests[iQst].setAttribute("limitPeriod",sSectPeriod)}}}}}
if(sTL=="global"){oTest.setAttribute("globalTime",(sPeriod||"10min"))}}
if(oTest.getAttribute("questionOrder")=="rand"){if(sIncludeTestId&&oTest.getAttribute("id")==sIncludeTestId&&oInclude.tagName=="section"&&oTest.childNodes.length>1){oTest.insertBefore(oInclude,oTest.firstChild)}
for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect],aQuests=oSect.selectNodes(".//page"),iQuestLen=aQuests.length
oSect.setAttribute("vtitle",oSect.getAttribute("title"))
for(var iQst=0;iQst<iQuestLen;iQst++){aQuests[iQst].setAttribute("vsectindex",iSect)}}
oTest.setAttribute("vsections","true")
for(var iSc=oTest.childNodes.length-1;iSc>0;iSc--){var oS=oTest.childNodes[iSc]
while(oS.hasChildNodes()){oTest.firstChild.appendChild(oS.firstChild)}
oS.setAttribute("skip","hide")}
if(oTest.firstChild.getAttribute("skip")!="hide"){oTest.firstChild.setAttribute("skip","true")}
oTest.firstChild.setAttribute("questionOrder","rand")
oTest.setAttribute("questionOrder","sect")}
if(oTest.getAttribute("questionOrder")=="sect"){var aSects=oTest.childNodes
for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect]
if(oSect.getAttribute("questionOrder")=="rand"){var oNewSect=oSect.cloneNode(false)
while(oSect.hasChildNodes()){oNewSect.appendChild(oSect.childNodes[Math.floor(Math.random()*oSect.childNodes.length)])}
oTest.replaceChild(oNewSect,oSect)}}}
if(oTest.getAttribute("sectionOrder")=="rand"&&oTest.getAttribute("vsections")!="true"){var oNewTest=oTest.cloneNode(false)
while(oTest.hasChildNodes()){oNewTest.appendChild(oTest.childNodes[Math.floor(Math.random()*oTest.childNodes.length)])}
oTest.parentNode.replaceChild(oNewTest,oTest)}}}
function loadResource(oResNode,bExcludeLayers){var sId=oResNode.getAttribute("id"),oXML=oConfig.getElementsByTagName("config")[0]
document.body.clearListeners("onstatuschange")
document.body.clearListeners("onvarchange")
document.body.clearListeners("oninitpage")
document.body.clearListeners("onfinishpage")
document.body.clearRehash(oDocContent)
oResource=oResNode
oTopLevelLayer.style.cssText=oTopLevelLayer.getAttribute("baseStyle")
if(window.oGameStyle&&!oGameStyle.disabled)oGameStyle.disabled=true
loadTheme(findAttribute("theme",oResNode))
var bRedraw=false
waitForTheme()
function waitForTheme(){var bSkip=false
;/*@if(@_jscript)bSkip=true;@end @*/
if(bSkip||(oBaseTheme.readyState=="complete"&&oCustomRules.readyState=="complete"&&oTheme.readyState=="complete")){if(!bExcludeLayers){var sMaster=findAttribute("master",oResNode)
loadLayer(oMasterContent,sMaster,loadMenuLayer)}else{layerDone()}}else{if(!bRedraw){bRedraw=true
oDocContent.style.display=oMasterContent.style.display=oMenuContent.style.display="none"}
setTimeout(waitForTheme,50)}}
function loadMenuLayer(){var sLayer=findAttribute("menu",oResNode)
if(sLayer!="@NONE"){var oLayerNode=oConfig.selectSingleNode(".//*[@id=\""+sLayer+"\"]")
if(oLayerNode){var sApply=oLayerNode.getAttribute("dynApply"),sPosition=oLayerNode.getAttribute("dynPosition")||"below"
if(sApply=="all"||(sApply=="chapter"&&oResNode.tagName!="page")||(sApply=="page"&&oResNode.tagName=="page")){loadLayer(oMenuContent,sLayer,layerDone)
if(oMenuContent.className!=sPosition)oMenuContent.className=sPosition
return}}}
loadLayer(oMenuContent,"@NONE",layerDone)}
function layerDone(){var sId=oResource.getAttribute("id")
if(oPersist[sId]){resourceLoaded({persist:sId})}else{httpLoader("GET",cacheURL(GET_PROJECT_RESOURCE+"?readonly=1&project="+encodeURIComponent(sProjectId)+"&resource="+encodeURIComponent(sId)),resourceLoaded)}}
function resourceLoaded(oXH){if(oXH.persist){var sId=oXH.persist
setContent(oPersist[sId].content,oPersist[sId].globalStyle)}else{if(oXH.status==200||oXH.status==0){var sText=oXH.responseText.replace(/<!-- (.*) -->\r\n/,"")
setContent(sText,RegExp.$1)}else{setContent("","")}}
if(bRedraw){oDocContent.style.display=oMasterContent.style.display=oMenuContent.style.display="block"}
initPage(oResNode)
document.body.raiseNavigate()
oResNode=null
oModule=null
oXML=null}}
function setContent(sContent,sGlobalStyle){if(sGlobalStyle!=null){if(sGlobalStyle!=oDocContent.style.cssText)oDocContent.style.cssText=sGlobalStyle
var aProps=sGlobalStyle.match(/background[^;]*/ig)
if(aProps)oTopLevelLayer.style.cssText+=";"+aProps.join(";")}
switchEmbeds(oDocContent,"off",true);
oDocContent.innerHTML=sContent
setAreaVisibility(oDocContent)
mediaMonitor.media=[]
var oEmbeds=oDocContent.getElementsByTagName("embed")
for(var iEmbed=0;iEmbed<oEmbeds.length;iEmbed++){if(oEmbeds[iEmbed].comptype=="media")mediaMonitor.media.push(oEmbeds[iEmbed])}
mediaMonitor()}
function loadTheme(sTheme){if(sTheme&&sTheme!=sCurrentTheme){if(sTheme.charAt(0)!="@"){oTheme.href=cacheURL(GENERIC_REDIRECTOR+"?url="+encodeURIComponent(cacheURL(GET_PROJECT_RESOURCE+"?readonly=1&project="+encodeURIComponent(sProjectId)+"&resource="+encodeURIComponent(sTheme))))}else{oTheme.href="javascript:'NONE'"}
sCurrentTheme=sTheme}}
function loadLayer(oLayer,sId,fCallback){var sLastId=oLayer.current
if(!sId||sId.charAt(0)=="@")sId="@"
if(sLastId!=sId){oLayer.current=sId
document.body.clearRehash(oLayer)
if(sId=="@"){setLayerContent(oLayer,"","")
oLayer.cachedStyle=""
oLayer.cachedContent=""
if(fCallback)fCallback()}else{httpLoader("GET",cacheURL(GET_PROJECT_RESOURCE+"?readonly=1&project="+encodeURIComponent(sProjectId)+"&resource="+encodeURIComponent(sId)),function(oXH){if(oXH.status==200||oXH.status==0){var sText=oXH.responseText.replace(/<!-- (.*) -->\r\n/,"")
oLayer.cachedStyle=RegExp.$1
oLayer.cachedContent=sText
setLayerContent(oLayer,RegExp.$1,sText)}else{oLayer.cachedStyle=""
oLayer.cachedContent=""
setLayerContent(oLayer,"","")}
if(fCallback)fCallback()})}}else{setLayerContent(oLayer,oLayer.cachedStyle,null)
document.body.raiseRehash(oLayer)
if(fCallback)fCallback()}}
function setLayerContent(oLayer,sStyle,sContent){if(oLayer.style.cssText!=sStyle)oLayer.style.cssText=sStyle
if(sStyle){var aProps=sStyle.match(/background[^;]*/ig)
if(aProps)oTopLevelLayer.style.cssText+=";"+aProps.join(";")}
if(sContent!==null){switchEmbeds(oLayer,"off",true);
oDocContent.innerHTML=""
oLayer.innerHTML=sContent}
setAreaVisibility(oLayer)}
function mediaMonitor(){var aActive=mediaMonitor.media
if(aActive.length){for(var iMedia=0;iMedia<aActive.length;iMedia++){if(aActive[iMedia].HasError&&aActive[iMedia].Duration==0){if(aActive[iMedia].ReadyState==4){aActive[iMedia].Open(decodeURIComponent(aActive[iMedia].getAttribute("filename")))}}else if(aActive[iMedia].ReadyState==4){aActive.splice(iMedia,1)}}
if(aActive.length)setTimeout(mediaMonitor,250)}}
function setAreaVisibility(oEl){var oParent=oEl,oEl=oEl.firstChild,sOrig=oParent.innerHTML
oParent.style.visibility="visible"
while(oEl){if(oEl.parentNode!=oParent){oParent.innerHTML=sOrig
return}
if(oEl.nodeType==1){var bSkip=false
if(!oEl.currentStyle.hasLayout){oEl.style.zoom=1
if(/\s$/.test(oEl.innerHTML)){oParent.insertBefore(document.createTextNode(" "),oEl.nextSibling)
bSkip=true}}
;/*@if(@_jscript)
if(oEl.tagName=="IMG"&&!/\.(jpe?g|png|bmp)$/i.test(oEl.src)){if(oEl.readyState=="complete"){oEl=wrapImage(oEl)}else{oEl.attachEvent("onload",wrapImageHandler)}}
;/*@end @*/
if(oEl.style.visibility!="hidden"&&oEl.currentStyle.visibility!="hidden")oEl.style.visibility="visible"
if(bSkip)oEl=oEl.nextSibling
oEl=oEl.nextSibling}else{var oNew=document.createElement("span")
oParent.insertBefore(oNew,oEl)
oNew.appendChild(oEl)
oNew.innerHTML=oNew.innerHTML.replace(/(\S+)/g,"<span style=\"z-index:-1;visibility:visible;zoom:1\">$1</span>")
oEl=oNew.nextSibling
oNew.removeNode(false)}}
oParent.style.visibility="hidden"}
function wrapImageHandler(event){event.srcElement.detachEvent("onload",wrapImageHandler)
wrapImage(event.srcElement)}
function wrapImage(oEl){var oNew=document.createElement("gm:imagenodewrapper"),oParent=oEl.parentNode,iOrigWidth=oEl.clientWidth,iOrigHeight=oEl.clientHeight
if(iOrigWidth==0||iOrigHeight==0){var oCur=oEl,aNone=[]
while(oCur&&oCur.nodeType==1){if(oCur.currentStyle.display=="none"){oCur.runtimeStyle.display="block"
aNone.push(oCur)}
oCur=oCur.parentNode}
iOrigWidth=oEl.offsetWidth
iOrigHeight=oEl.offsetHeight
for(var iNone=aNone.length;iNone--;)aNone[iNone].runtimeStyle.removeAttribute("display")}
oParent.replaceChild(oNew,oEl)
oNew.appendChild(oEl)
oNew.style.cssText=oEl.style.cssText
if(/auto|%/.test(oNew.currentStyle.width))oNew.style.width=iOrigWidth
if(/auto|%/.test(oNew.currentStyle.height))oNew.style.height=iOrigHeight
oNew.className=oEl.className
oEl.className=""
for(var sAttr in oEl){if(sAttr.indexOf("trans")==0){oNew.setAttribute(sAttr,oEl.getAttribute(sAttr))
oEl.removeAttribute(sAttr)}}
oEl.style.cssText="top:0;left:0;position:relative;z-index:-1"
oEl.style.width=oNew.currentStyle.width
oEl.style.height=oNew.currentStyle.height
return oNew}
function findAttribute(sAttr,oFinder,sDefault){var sRes
sDefault=sDefault||"@NONE"
while(oFinder&&oFinder.nodeType==1&&!sRes){sRes=oFinder.getAttribute(sAttr)
oFinder=oFinder.parentNode}
return sRes||sDefault}
function getNavNode(oResNode,sNavDir,bNoSkip,bSilent,bNoPageSkip){var oNode=oResNode,oNavNode
if(oNode){var sLock=oNode.getAttribute("lock")
if(!sLock){sLock=findAttribute("lock",oNode,"false")}
switch(sNavDir){case"next":if(!oNode.hasChildNodes()||sLock=="true"){oNavNode=oNode.nextSibling
while(!oNavNode){oNode=oNode.parentNode
if(oNode.tagName=="structure")break
oNavNode=oNode.nextSibling}}else{oNavNode=oNode.firstChild}
break
case"previous":oNavNode=oNode.previousSibling
if(oNavNode&&sLock!="true"){while(oNavNode.hasChildNodes()){oNavNode=oNavNode.lastChild}}else if(oNode.parentNode&&oNode.parentNode.tagName!="structure"){oNavNode=oNode.parentNode}
break
case"up":if(oNode.parentNode.tagName!="structure"){oNavNode=oNode.parentNode}
break
default:oNavNode=oResNode
break}
if(!oNavNode){return false}
var sSkip=bNoSkip?"false":oNavNode.getAttribute("skip"),sLock=oNavNode.getAttribute("lock")
if(oNavNode.tagName!="page"){if(!sSkip||sSkip=="@DEFAULT"){sSkip=findAttribute("skip",oNavNode,"false")
oNavNode.setAttribute("skip",sSkip)}
if(!bSilent&&(sSkip=="true"||sSkip=="hide")){oNavNode.setAttribute("visited","true")}}
if(!bSilent&&oNavNode.tagName=="page"&&(sSkip=="true"||sSkip=="hide")){oNavNode.setAttribute("visited","true")
oNavNode.setAttribute("done","true")}
if(!sLock){sLock=findAttribute("lock",oNavNode,"false")}
if(bNoPageSkip==true&&oNavNode.tagName=="page"&&(sSkip=="true"||sSkip=="hide")){sSkip="false"}
if(sSkip=="true"||sSkip=="hide"||sLock=="true"){var oNewNav=getNavNode(oNavNode,(sNavDir||"next"),null,bSilent,bNoPageSkip)
if(oNewNav){return oNewNav}else{return false}}else{return oNavNode}}
return false}
function initPage(oResNode,bPartial,fActivityDone){var oAncestor=oResNode.parentNode.parentNode,iScormNdxCnt=0
window.oStatus={}
oResNode.setAttribute("visited","true")
if(oResNode.tagName=="page"){var aFB=document.getElementsByTagName("FEEDBACK"),oLockTags={hotpop:"hotspots",mplayer:"mplayer",objtrans:"objtrans"},iLock=0
for(var i=0;i<aFB.length;i++){var oFB=aFB[i]
if((oFB.getAttribute("locknext")=="true"||oFB.getAttribute("locknext")=="all")&&!bPartial){iLock++}
if(oAncestor.getAttribute("game")=="true"&&oAncestor.getAttribute("forceOneTry")=="true"){oFB.setAttribute("attempts","1")}
oFB.setAttribute("scormSubNdx",iScormNdxCnt++)
oFB.onactivityinit=activityInit
oFB.onactivitycheck=activityCheck
oFB.onactivitydone=fActivityDone?fActivityDone:activityDone}
var oSVs=document.getElementsByTagName("SURVEY")
for(var iS=0;iS<oSVs.length;iS++){var oSV=oSVs[iS],bItems=oSV.getAttribute("storeitems")=="true",bTotal=oSV.getAttribute("storetotal")=="true",bAvg=oSV.getAttribute("storeavg")=="true"
if(bItems){var oItems=oSV.getElementsByTagName("svitem")
for(var iI=0;iI<oItems.length;iI++){oItems[iI].setAttribute("scormSubNdx",iScormNdxCnt++)}}
if(bTotal)oSV.setAttribute("scormSubNdx_total",iScormNdxCnt++)
if(bAvg)oSV.setAttribute("scormSubNdx_avg",iScormNdxCnt++)
oSV.onactivityinit=activityInit
oSV.onactivitycheck=activityCheck
oSV.onactivitydone=activityDone}
var oRs=document.getElementsByTagName("RATING")
for(var iR=0;iR<oRs.length;iR++){var oR=oRs[iR]
if(oR.getAttribute("autoscorm")!="false"){oR.setAttribute("scormSubNdx",iScormNdxCnt++)
oR.onactivityinit=activityInit
oR.onactivitycheck=activityCheck
oR.onactivitydone=activityDone}}
for(var sTag in oLockTags){var aLE=document.getElementsByTagName(sTag)
for(var iL=0;iL<aLE.length;iL++){var oLE=aLE[iL]
if(oLE.getAttribute("locknext")=="true"){while(oLE.tagName!=oLockTags[sTag]&&oLE.tagName!="body")oLE=oLE.parentNode
if(oLE.tagName==oLockTags[sTag]){oLE.oncomplete=activityCompleted
iLock++}}}}
if(iLock>0&&oResNode.getAttribute("unlocked")!="true"){oStatus.locked=iLock
lockNextNav(true)}else{setResDone(oResNode)}}else{setResDone(oResNode)}
if(oAncestor.tagName=="test"){var sFeedbackMode=oAncestor.getAttribute("feedbackMode")||"test"
oResNode.setAttribute("testPage","true")
oResNode.setAttribute("persist","true")
oResNode.setAttribute("partial",oAncestor.getAttribute("partial")||"normal")
if(sFeedbackMode=="test"){var oCheck=document.getElementsByTagName("FBVALIDATE")
for(var i=0;i<oCheck.length;i++){oCheck[i].style.visibility="hidden"}}
if(oAncestor.getAttribute("reviewMode")=="true"){var aFB=document.getElementsByTagName("FEEDBACK")
for(var i=0;i<aFB.length;i++){aFB[i].review=true}}else{oResource.setAttribute("total",oResource.getAttribute("finalTotal")||0)
oResource.setAttribute("correct",oResource.getAttribute("finalCorrect")||0)
oResource.removeAttribute("accumulatedScore")}}
if(!bPartial){if(oAncestor.tagName=="test"||oResNode.tagName=="section"){var oGlobal,oGlobalTimer
if(oAncestor.getAttribute("globalTime")||oResNode.parentNode.getAttribute("globalTime")||oResNode.getAttribute("globalTime")){if(oAncestor.getAttribute("globalTime")&&oAncestor.getAttribute("globalTimeStarted")!="true"){oGlobal=oAncestor}else if(oResNode.getAttribute("globalTime")&&oResNode.getAttribute("globalTimeStarted")!="true"){oGlobal=oResNode}else if(oResNode.parentNode.getAttribute("globalTime")&&oResNode.parentNode.getAttribute("globalTimeStarted")!="true"){oGlobal=oResNode.parentNode}
if(oGlobal){initGlobalTimer(oGlobal)}}else if(oAncestor.tagName=="test"&&oAncestor.getAttribute("game")!="true"){initLocalTimer(oResNode,oAncestor)}}
document.body.attachEvent("oninitpage",Hover.initpage)
document.body.attachEvent("onfinishpage",Hover.finishpage)
var aBox=oTopLevelLayer.getElementsByTagName("box")
for(var iBox=aBox.length;iBox--;){var oBox=aBox[iBox]
if(oBox.getAttribute("overrule")||oBox.getAttribute("vhref"))opacityOverlay(aBox[iBox])}
var aLinks=oTopLevelLayer.getElementsByTagName("A")
for(var iL=0;iL<aLinks.length;iL++){var oL=aLinks[iL],sURL=oL.getAttribute("url")
if(sURL){oL.href=sURL}}
if(oResNode.tagName=="test"&&document.getElementsByTagName("stage").length){initGameStyle()}
document.body.raiseInitPage()
if(sProjectId=="Res"){State.store(oConfig,oResNode.getAttribute("id"))}}}
function initGameStyle(){var oG=document.getElementsByTagName("stage")[0].parentNode,sG=oG.getAttribute("moduleName")
if(sG){oGameStyle.disabled=false
oGameStyle.href=cacheURL(GENERIC_REDIRECTOR+"?url="+encodeURIComponent(cacheURL(GET_PROJECT_RESOURCE+"?readonly=1&project="+encodeURIComponent(sProjectId)+"&resource="+encodeURIComponent("../../Themes/"+sG+".css"))))}}
function initGlobalTimer(oGlobal,iRate,bUnCache){var targetNode
oGlobalTimer=oTopLevelLayer.children.tags("navtimer")[0]
if(oGlobalTimer&&oGlobalTimer.globalTimer){oGlobalTimer.persisted=true
oGlobalTimer.invalidateTimer()}else{oGlobalTimer=creatNavTimer(oTopLevelLayer)}
if(oGlobalTimer){if(oGlobal.tagName=="test"){targetNode=oGlobal.nextSibling}else{targetNode=oGlobal==oGlobal.parentNode.lastChild?oGlobal.parentNode.nextSibling:getNavNode(oGlobal.lastChild,"next")}
oGlobal.setAttribute("globalTimeStarted","true")
oGlobalTimer.setAttribute("period",oGlobal.getAttribute("globalTime"))
oGlobalTimer.setAttribute("ontimer","custom")
if(targetNode){oGlobalTimer.setAttribute("id",targetNode.getAttribute("id"))}
oGlobalTimer.globalTimer=true
oTopLevelLayer.appendChild(oGlobalTimer)
if(oGlobalTimer.persisted){oGlobalTimer.initTimer()}}
if(!oGlobalTimer){oGlobalTimer=oTopLevelLayer.children.tags("navtimer")[0]}
if(oGlobalTimer){var oTimers=document.getElementsByTagName("navtimer")
if(bUnCache){window.cachedTimer=null}
for(var iT=0;iT<oTimers.length;iT++){var oTimer=oTimers[iT]
if(oTimer.uniqueID!=window.cachedTimer&&(oTimer.getAttribute("ontimer")=="auto"||!oTimer.getAttribute("ontimer"))&&!oTimer.globalTimer){setTimeout(function(){try{window.gTimer={}
window.gTimer.timer=oGlobalTimer
window.gTimer.rate=iRate
oTimer.initTimer(oGlobalTimer,iRate)}catch(oErr){}},100)
window.cachedTimer=oTimer.uniqueID
break}}}
return oGlobalTimer?{main:oGlobalTimer,visual:oTimers}:false}
function initLocalTimer(oResNode,oAncestor){var sPeriod=oResNode.getAttribute("limitPeriod"),bNew=false
if(sPeriod){var oTimer=oContentArea.getElementsByTagName("navtimer")[0]
if(!oTimer||oTimer.globalTimer){oTimer=creatNavTimer()
bNew=true}
if(oTimer){oTimer.setAttribute("ontimer",oAncestor.getAttribute("feedbackMode")=="question"?"check":"check and next")
if(!oTimer.getAttribute("period")||oTimer.getAttribute("period")=="auto"){oTimer.setAttribute("period",sPeriod)}
if(bNew){oDocContent.appendChild(oTimer)}else{try{oTimer.initTimer()}catch(oError){}}}
return{main:oTimer}}
return false}
function creatNavTimer(){var oNT=document.createElement("gm:navtimer")
oNT.setAttribute("visible","false")
oNT.setAttribute("showmsg","false")
oNT.setAttribute("mode","horizontal")
oNT.setAttribute("ontimer","auto")
oNT.setAttribute("period","auto")
return oNT}
function evaluatePage(oCurResource,oNewResource,bForceFB,bExit){var oTestNode=oCurResource
while(oTestNode.tagName!="test"){oTestNode=oTestNode.parentNode
if(oTestNode.tagName=="structure")break}
if(oTestNode.tagName=="test"&&oTestNode.getAttribute("reviewMode")!="true"){if(oCurResource.tagName=="page"&&oCurResource.getAttribute("timerDone")!="true"){var aFB=document.getElementsByTagName("FEEDBACK")
var	bShowFB=bForceFB&&oTestNode.getAttribute("feedbackMode")=="question"
for(var i=0;i<aFB.length;i++){var oFB=aFB[i]
if(oFB.done!="1"){oFB.silent=!bShowFB
oFB.checkAnswer(bForceFB)}}
calcResScore(oCurResource)}
var oLastPage=oTestNode.lastChild&&oTestNode.lastChild.lastChild
if((bExit&&oLastPage&&!getNavNode(oLastPage,"next")&&!oTestNode.selectSingleNode(".//page[not(@visited)]"))||(oNewResource&&oNewResource!=oTestNode&&oNewResource.parentNode!=oTestNode&&oNewResource.parentNode.parentNode!=oTestNode)){evaluateTest(oTestNode)}}
if(oNewResource){loadResource(oNewResource)}}
function calcResScore(oCurResource){var iTotal=oCurResource.getAttribute("total")||0,iCorrect=oCurResource.getAttribute("correct")||0,iMaxScore=oCurResource.getAttribute("maxScore")||0,iScore=0
if(iTotal!=0){var iAccuScore=(oResource.getAttribute("accumulatedScore")||0)*1
if(iAccuScore){if(iCorrect==iTotal)iAccuScore=iMaxScore
iScore=getPrecision(iAccuScore)}else{iScore=calcScoreByRules(oCurResource,iCorrect,iTotal,iMaxScore)}}
oCurResource.setAttribute("score",iScore)}
function calcScoreByRules(oCurResource,iCorrect,iTotal,iMaxScore){var sPartial=oCurResource.getAttribute("partial"),iFactor=iCorrect/iTotal,iScore=0
if(sPartial!="normal"&&iFactor>0&&iFactor<1){iFactor=sPartial=="full"?1:0}
iScore=getPrecision(iFactor*iMaxScore)
return iScore}
function evaluateTest(oTestNode,bForceUsed){if(oTestNode&&oTestNode.getAttribute("reviewMode")!="true"){var aSects=oTestNode.childNodes,oResults={totalscore:0,totalquestions:0,correct:0,incorrect:0,partial:0,hints:0,sections:[]},bVSectsion=oTestNode.getAttribute("vsections")=="true",iMaxAttempts=(oTestNode.getAttribute("attempts")||0)*1
if(iMaxAttempts){var iCurAttempts=(oTestNode.getAttribute("curAttempts")||0)*1
oTestNode.setAttribute("curAttempts",iCurAttempts+1)}
for(var iSect=0;iSect<aSects.length;iSect++){var oSect=aSects[iSect],oSectResults={totalquestions:0,totalscore:0,correct:0,incorrect:0,partial:0,hints:0,title:oSect.getAttribute(bVSectsion?"vtitle":"title")},aQuest=bVSectsion?oTestNode.selectNodes(".//page[@vsectindex=\""+iSect+"\"]"):oSect.childNodes
oResults.sections[iSect]=oSectResults
for(var iQuest=0;iQuest<aQuest.length;iQuest++){var oQuest=aQuest[iQuest],iScore=+oQuest.getAttribute("score")||0,iMaxScore=+oQuest.getAttribute("maxScore"),bCount=!bForceUsed||(oQuest.getAttribute("score")!==null)
setResDone(oQuest,true)
if(iMaxScore==0)continue
oSectResults.totalscore+=iScore
if(bCount)oSectResults.totalquestions++
if(iMaxScore&&getFixed(iScore)==getFixed(iMaxScore)){oSectResults.correct++}else if(!iScore){oSectResults.incorrect++}else{oSectResults.partial++}
if(oQuest.getAttribute("hints")){oSectResults.hints++}}
setResDone(oSect,true)
if(oSectResults.totalquestions&&oSectResults.correct==oSectResults.totalquestions&&!bForceUsed&&!oSectResults.hints){oSectResults.totalscore=+oSect.getAttribute("weight")}
oSect.setAttribute("totalscore",oSectResults.totalscore)
oSect.setAttribute("totalquestions",oSectResults.totalquestions)
oSect.setAttribute("correct",oSectResults.correct)
oSect.setAttribute("incorrect",oSectResults.incorrect)
oSect.setAttribute("part",oSectResults.partial)
oResults.totalscore+=oSectResults.totalscore
oResults.totalquestions+=oSectResults.totalquestions
oResults.correct+=oSectResults.correct
oResults.incorrect+=oSectResults.incorrect
oResults.partial+=oSectResults.partial
oResults.hints+=oSectResults.hints}
if(oResults.totalquestions&&oResults.correct==oResults.totalquestions&&!oResults.hints){oResults.totalscore=100}
oTestNode.setAttribute("totalscore",getFixed(oResults.totalscore))
oTestNode.setAttribute("totalquestions",oResults.totalquestions)
oTestNode.setAttribute("correct",oResults.correct)
oTestNode.setAttribute("incorrect",oResults.incorrect)
oTestNode.setAttribute("part",oResults.partial)
var sStatus="failed"
if(getFixed(oResults.totalscore)>=(oTestNode.getAttribute("passScore")*1||0))sStatus="passed"
oTestNode.setAttribute("status",sStatus)
LMSInterface.RegisterObjective(oTestNode)
if(oTestNode.getAttribute("allowReview")=="false"){oTestNode.setAttribute("lock","true")}else{oTestNode.setAttribute("reviewMode","true")}}}
function finishPage(){var bRes=document.body.raiseFinishPage()!==false
if(bRes){persistPage()}
return bRes}
function persistPage(){var sPersist=findAttribute("persist",oResource,"true")
if(sPersist=="true"&&(oDocContent.getElementsByTagName("feedback").length||oDocContent.getElementsByTagName("hotspots").length)){var sContent=oDocContent.innerHTML,sId=oResource.getAttribute("id")
oPersist[sId]={content:sContent,globalStyle:oDocContent.style.cssText}}else{oResource.removeAttribute("unlocked")}}
function activityInit(){if(event.activity&&"correctPattern"in event){var oSrc=event.srcElement,iSubNdx=event.subindex!==null&&event.subindex!=undefined?event.subindex:oSrc.getAttribute("scormSubNdx"),iTotalEl=document.getElementsByTagName("FEEDBACK").length
if(LMSInterface.PreRegisterInteraction)LMSInterface.PreRegisterInteraction(oResource,iSubNdx,iTotalEl,event.activity,event.correctPattern,event.unscored,event.start,event.desc)}}
function activityCheck(){var oSrc=event.srcElement,sLock=oSrc.getAttribute("locknext"),iSubNdx=event.subindex!==null&&event.subindex!=undefined?event.subindex:oSrc.getAttribute("scormSubNdx")
if(oStatus.locked&&(sLock=="true"||sLock=="all")){if(sLock=="true"||event.correct==event.total||event.lastAttempt){oStatus.locked--
if(oStatus.locked==0){lockNextNav(false,true)
oResource.setAttribute("unlocked","true")
setResDone(oResource)}}}
if("userPattern"in event){if(LMSInterface.InteractionAnswered)LMSInterface.InteractionAnswered(oResource,iSubNdx,event.userPattern,event.checkTime,event.total,event.correct)}}
function activityDone(){var oSrc=event.srcElement
iSubNdx=event.subindex!==null&&event.subindex!=undefined?event.subindex:oSrc.getAttribute("scormSubNdx"),iQIP=document.getElementsByTagName("FEEDBACK").length
if(!oSrc.activityDone&&!event.unscored){if(oResource.getAttribute("testPage")=="true"){var iTotal=oResource.getAttribute("total")||0,iCorrect=oResource.getAttribute("correct")||0,iFinalTotal=oResource.getAttribute("finalTotal")||0,iFinalCorrect=oResource.getAttribute("finalCorrect")||0,iActivityTotal=event.total,iActivityCorrect=event.correct,iMaxScore=oResource.getAttribute("maxScore")||0
if(event.isDone&&!oSrc.silent){oResource.setAttribute("finalTotal",iFinalTotal*1+iActivityTotal)
oResource.setAttribute("finalCorrect",iFinalCorrect*1+iActivityCorrect)}
oResource.setAttribute("total",iTotal*1+iActivityTotal)
oResource.setAttribute("correct",iCorrect*1+iActivityCorrect)
if(iQIP>1){var iMaxPerQ=iMaxScore/iQIP,sAccuScore=oResource.getAttribute("accumulatedScore"),iAccuScore=sAccuScore?sAccuScore*1:0,iScore=calcScoreByRules(oResource,iActivityCorrect,iActivityTotal,iMaxPerQ)
oResource.setAttribute("accumulatedScore",iScore*1+iAccuScore)}}
oSrc.activityDone=true}
if(LMSInterface.RegisterInteraction)LMSInterface.RegisterInteraction(oResource,iSubNdx,iQIP,event.total,event.correct,event.activity,event.userPattern,event.unscored)}
function activityCompleted(){if(oStatus.locked&&event.targetElement.getAttribute("locknext")=="true"){oStatus.locked--
if(oStatus.locked==0){lockNextNav(false,true)
oResource.setAttribute("unlocked","true")
setResDone(oResource)}}}
function lockNextNav(bMode,bForce){var oNext=document.getElementsByTagName("NAVBUTTON"),aMonitor=[]
for(var i=0;i<oNext.length;i++){if(oNext[i].getAttribute("operation")=="next"){var oNextBtn=oNext[i]
if(bForce){oNextBtn.inactive=bMode}else{aMonitor.push(oNextBtn)}}}
if(aMonitor.length>0){var oIntv=setInterval(function(){for(var i=aMonitor.length;i--;){var oNextBtn=aMonitor[i]
if(oNextBtn.initdone){oNextBtn.inactive=oNextBtn.inactive||bMode
oNextBtn.initdone=null
aMonitor.splice(i,1)
if(aMonitor.length==0)clearInterval(oIntv)}}},10)}}
function setResDone(oResNode,bForce){var iChild=oResNode.childNodes.length
if(bForce)oResNode.setAttribute("visited","true")
if(oResNode.getAttribute("visited")=="true"&&(iChild==0||iChild==oResNode.selectNodes("*[@done=\"true\"]").length)){oResNode.setAttribute("done","true")
document.body.raiseStatusEvent({resource:oResNode})
if(oResNode.tagName!="structure"){setResDone(oResNode.parentNode)}}}
function opacityOverlay(oElem){;/*@if(@_jscript)
if(oElem.currentStyle.backgroundColor=="transparent"&&oElem.currentStyle.position!="static"&&(oElem.currentStyle.backgroundImage==null||/^(?:none$|url\([\'\"]?(?:javascript:|.*#compnone))/.test(oElem.currentStyle.backgroundImage))&&(oElem.children.tags("transalpha").length==0)){var oTransObj=oElem.document.createElement("gm:transalpha")
oElem.insertBefore(oTransObj,oElem.firstChild)
var pLeft=parseInt(oElem.currentStyle.paddingLeft),pRight=parseInt(oElem.currentStyle.paddingRight)
if(pLeft||pRight){var oFiller=oElem.document.createElement("gm:transalpha")
oFiller.style.left="auto"
oFiller.style.right=0
oFiller.style.width=pLeft+pRight
oElem.insertBefore(oFiller,oTransObj)}}
;/*@end @*/}
oScope={timerProxy:function(oOrigin,sTimerProc,oArg,iDelay){var oTimer=setTimeout(getTimerProc(oOrigin,sTimerProc,oArg),iDelay)
oOrigin=null
oArg=null
return oTimer}}
function getTimerProc(oOrigin,sTimerProc,oArg){return function(){try{if(oOrigin&&oOrigin.destroyed!==true){oOrigin[sTimerProc](oArg)}}catch(oError){}
oArg=null}}
var Navigation={_goTo:function(sOperation,sId){var oNavWrap=document.createElement("div")
oNavWrap.style.visibility="hidden"
oDocContent.appendChild(oNavWrap)
document.body.attachEvent("onfinishpage",function(){document.body.detachEvent("onfinishpage",arguments.callee)
oNavWrap.outerHTML=""
oNavWrap=null})
oNavWrap.innerHTML='<gm:navbutton inactiveMode="disable" inactivate="default" activate="default" trigger="auto" operation="'+sOperation+'" '+(sId?'id="'+sId+'" ':'')+'/>'},next:function(){this._goTo("next");},previous:function(){this._goTo("previous");},up:function(){this._goTo("up");},custom:function(sId){this._goTo("custom",sId);}}
var Compress={flag:"\uF849",attributes:["title","description","menu","theme","master","persist","pageNum","chapPageTotal","chapPageNum"],replaces:[[/<config>[\s\S]*?<\/config>/g,""],["<page","\uF850"],["<chapter","\uF851"],["<test","\uF852"],["<section","\uF853"],["</chapter>","\uF854"],["</test>","\uF855"],["</section>","\uF856"],["page/","\uF860"],["chapter/","\uF861"],["test/","\uF862"],["section/","\uF863"],[" pageNum=","\uF864"],[" visited=\"true\"","\uF865"],["true","\uF866"],["false","\uF867"],[".html","\uF868"],[" id=\"","\uF869"]],compress:function(sStr){var aStr=Compress.getStr(),aRX=Compress.getRX(),sStr
for(var i=0;i<aRX.length;i++){sStr=sStr.replace(aRX[i][0],aStr[i][1])}
return Compress.flag+sStr},restore:function(sStr,oOrig){if(sStr.charAt(0)!=Compress.flag)return sStr
var sStr=sStr.substr(1),aStr=Compress.getStr(),aRX=Compress.getRX(),oXML=getXMLDocument(),oConfig=oOrig&&oOrig.selectSingleNode("/project/config")
for(var i=0;i<aStr.length;i++){if(aStr[i][1])sStr=sStr.replace(aRX[i][1],aStr[i][0])}
if(oXML.loadXML(sStr)&&oXML.firstChild){if(oConfig)oXML.firstChild.insertBefore(oConfig.cloneNode(true),oXML.firstChild.firstChild)
if(oOrig){var aNodes=oXML.selectNodes("//*[@id]"),oHash={}
for(var i=0;i<aNodes.length;i++){var oNode=aNodes[i]
oHash[oNode.getAttribute("id")]=oNode}
var aNodes=oOrig.selectNodes("//*[@id]")
for(var i=0;i<aNodes.length;i++){var oNode=aNodes[i],oResNode=oHash[oNode.getAttribute("id")]
if(oResNode)Compress.copyAttributes(oNode,oResNode)}
Compress.copyAttributes(oOrig.firstChild,oXML.firstChild)}
return oXML.xml}
return null},getStr:function(){if(Compress.replaceStr)return Compress.replaceStr
return Compress.replaceStr=[[new RegExp(' ('+Compress.attributes.join('|')+')="[^"]*"',"g"),""]].concat(Compress.replaces)},getRX:function(){if(Compress.replaceRX)return Compress.replaceRX
var aStr=Compress.getStr(),aRX=[]
for(var i=0;i<aStr.length;i++){var xA=aStr[i][0],xB=aStr[i][1]
if(typeof xA=="string")xA=Compress.createRX(xA)
if(typeof xB=="string")xB=Compress.createRX(xB)
aRX.push([xA,xB])}
Compress.replaceRX=aRX
return aRX},createRX:function(sMatch){return new RegExp(sMatch.toRX(),"g")},copyAttributes:function(oFrom,oTo){var aAttr=Compress.attributes
for(var i=0;i<aAttr.length;i++){var sName=aAttr[i],sVal=oFrom.getAttribute(sName)
if(sVal!==null&&!oTo.getAttribute(sName)){oTo.setAttribute(sName,sVal)}}}}
var State={generate:function(oXML){var sXML=oXML.xml
if(this.rawXML!=sXML){this.rawXML=sXML
this.data=Compress.compress(sXML)}
return this.data},store:function(oXML,sLocation,bForce){if(LMSInterface.RegisterBookmark&&oConfig.firstChild.getAttribute("restoreLMS")=="true"){if(!sLocation){var oRestore=LMSInterface.GetBookmark()
if(oRestore)sLocation=oRestore.location}
LMSInterface.RegisterBookmark(this.generate(oXML),sLocation)}
if(oConfig.firstChild.getAttribute("restoreUserdata")=="true"||bForce){var oStorage,oRoot
try{oStorage=top.oRestore.oStorage||oTopLevelLayer;}
catch(e){oStorage=oTopLevelLayer;}
oStorage.XMLDocument.loadXML("<ROOTSTUB/>")
oRoot=oStorage.XMLDocument.firstChild
if(sLocation)oRoot.setAttribute("location",sLocation)
oRoot.appendChild(oStorage.XMLDocument.createCDATASection(this.generate(oXML)))
oStorage.save("ProjectData")}},restore:function(oXML,oDefaults,bForce){var oProject=oConfig.firstChild,oRestore,bSuccess
if(oProject.getAttribute("restoreLMS")=="true"&&LMSInterface.GetBookmark){oRestore=LMSInterface.GetBookmark()}
if(!oRestore&&(oProject.getAttribute("restoreUserdata")=="true"||bForce)){var oStorage,oRoot
try{oStorage=top.oRestore.oStorage;}catch(e){}
if(!oStorage)oStorage=oTopLevelLayer
oStorage.load("ProjectData")
oRoot=oStorage.XMLDocument.firstChild
oRestore={}
if(oRoot.firstChild){oRestore.xml=oRoot.firstChild.nodeValue}else{oRestore.xml=oRoot.getAttribute("project")}
oRestore.location=oRoot.getAttribute("location")}
if(oRestore&&oRestore.xml){oRestore.xml=Compress.restore(oRestore.xml,oConfig)
if(oRestore.xml){var sOrigXML=oXML.xml,sCurId=oProject.getAttribute("publicId"),sCurTag=oProject.getAttribute("publishTag")
bSuccess=oXML.loadXML(oRestore.xml)
if(bSuccess){if(oXML.firstChild.getAttribute("publicId")!=sCurId||oXML.firstChild.getAttribute("publishTag")!=sCurTag){bSuccess=false}else{if(oRestore.location&&oDefaults&&!oDefaults.resource)oDefaults.resource=oRestore.location}}
if(!bSuccess)oXML.loadXML(sOrigXML)
sOrigXML=null}}
return bSuccess}}
var Classes={set:function(oEl,sClass){oEl.className=sClass},get:function(oEl){return oEl.className},has:function(oEl,sClass){if(oEl&&sClass)return new RegExp("\\b"+sClass.toRX()+"\\b").test(oEl.className)},add:function(oEl,sClass,bHover){if(oEl&&sClass){var sCurrent=oEl.className,sBase=oEl.getAttribute("baseClass"),sSuper=oEl.getAttribute("superClass")
if(sBase===null){oEl.setAttribute("baseClass",sCurrent)
sBase=sCurrent}
if(bHover){Classes.promote(sClass,sBase)
Classes.promote(sClass,sSuper,true)}else{Classes.promote(sClass,sCurrent)
oEl.setAttribute("superClass",(sSuper||"")+" "+sClass)}
return oEl.className+=" "+sClass}},remove:function(oEl,sClass){if(oEl&&sClass){var rxClass=new RegExp("(?:\\b|\\s+)"+sClass.toRX()+"(?:\\b|\\s+)")
var sSuper=oEl.getAttribute("superClass")
if(sSuper){sSuper=sSuper.replace(rxClass,"")
if(sSuper)oEl.setAttribute("superClass",sSuper)
else oEl.removeAttribute("superClass")}
return oEl.className=oEl.className.replace(rxClass,"")}},promote:function(sClass,sOther,bRev){var aOther=sOther&&sOther.match(/\S+/g),oOther,aClass,oClass
if(aOther&&aOther.length){sClass=sClass.toLowerCase()
aClass=sClass.match(/\S+/g)
oClass={}
for(var i=0;i<aClass.length;i++)oClass[aClass[i].toLowerCase()]=true
aClass=null
oOther={}
for(var i=0;i<aOther.length;i++)oOther[aOther[i].toLowerCase()]=true
aOther=null
;/*@if(@_jscript)
var aRules=oCustomRules.styleSheet.rules,rxClass=/\.(\S+)$/,iIndex
;/*@else @*/ //Emulation only
var sRules=unescape(oCustomRules.getAttribute("href").slice(14)),aRules=sRules.match(/.+?\{[\s\S]+?\}\s*/g),rxClass=/\.(\S+)\s*\{/
if(!aRules)return
;/*@end @*/
var vMatch,bApply=false
for(var i=bRev?0:aRules.length-1;bRev?i<aRules.length:i>=0;bRev?i++:i--){var vCur=aRules[i]
;/*@if(@_jscript)
var sSelector=vCur.selectorText
;/*@else @*/ //Emulation only
var sSelector=vCur
;/*@end @*/
if(rxClass.test(sSelector)){var sName=RegExp.$1.toLowerCase()
if(oClass[sName]){vMatch=vCur
;/*@if(@_jscript)
iIndex=i
;/*@end @*/
break}else if(oOther[sName]){bApply=true}}}
if(bApply&&vMatch){;/*@if(@_jscript)
var sSelector=vMatch.selectorText,sCSS=vMatch.style.cssText
oCustomRules.styleSheet.removeRule(iIndex)
oCustomRules.styleSheet.addRule(sSelector,sCSS,bRev?0:-1)
;/*@else @*/ //Emulation only
sRules=sRules.replace(vMatch,"")
sRules=bRev?vMatch+sRules:sRules+vMatch
setTimeout(function(){oCustomRules.setAttribute("href","data:text/css,"+escape(sRules));},10)
;/*@end @*/}}}}
var Hover={apply:function(oEl,bClear){while(oEl&&oEl!=document.body&&oEl.nodeType==1){var sClass=oEl.getAttribute("overrule")
if(sClass!==null&&oEl.disabled!==true){if(bClear&&oEl.getAttribute("overruleactive")){Classes.remove(oEl,sClass)
oEl.removeAttribute("overruleactive")}else if(!bClear&&!oEl.getAttribute("overruleactive")){Classes.add(oEl,sClass,true)
oEl.setAttribute("overruleactive","1")}}
oEl=oEl.parentNode}},clear:function(oEl){Hover.apply(oEl,true)},mouseover:function(){Hover.apply(event.srcElement)},mouseout:function(){Hover.clear(event.srcElement)},initpage:function(){var iRatio=window.scaleRatio||1,oOver=document.elementFromPoint(event.clientX/iRatio,event.clientY/iRatio)
if(oOver)Hover.apply(oOver)
document.attachEvent("onmouseover",Hover.mouseover)
document.attachEvent("onmouseout",Hover.mouseout)},finishpage:function(){document.detachEvent("onmouseover",Hover.mouseover)
document.detachEvent("onmouseout",Hover.mouseout)
var iRatio=window.scaleRatio||1,oOver=document.elementFromPoint(event.clientX/iRatio,event.clientY/iRatio)
if(oOver)Hover.clear(oOver)}}
document.attachEvent("onmouseup",function(event){try{var oSrc=event.srcElement
if(oSrc.tagName=="EMBED"&&(oSrc.comptype=="flash"||oSrc.GetVariable("Stage"))){oSrc.fireEvent("onclick")}}catch(oErr){}})
document.attachEvent("onkeydown",function(event){if(event.keyCode=="9"){if(!("fresh"in navigKeyReset)){document.body.attachEvent("onnavigate",navigKeyReset)
navigKeyReset()}
if(navigKeyReset.fresh){navigKeyReset.fresh=false
var aEls=oTopLevelLayer.getElementsByTagName("*")
for(var i=aEls.length;i--;){var oEl=aEls[i]
if((window.KeyNav&&KeyNav[oEl.tagName.toUpperCase()]||oEl.getAttribute("vhref"))&&(!oEl.attributes.tabIndex||!oEl.attributes.tabIndex.specified))oEl.tabIndex=0
if(oEl.hideFocus)oEl.hideFocus=false}}}
var oSrc=event.srcElement
if(event.keyCode==13&&oSrc.tagName!="A"){try{oSrc.fireEvent("onmousedown");oSrc.fireEvent("onclick");oSrc.fireEvent("onmouseup");}catch(e){}}})
function navigKeyReset(){navigKeyReset.fresh=true}
;/*@if(@_jscript)
try{top.document.attachEvent("onkeydown",printListen);}catch(e){}
document.attachEvent("onkeydown",printListen)
;/*@end @*/
function printListen(event){if(event.keyCode==80&&event.ctrlKey){event.returnValue=false
event.keyCode=0
printWin()
return false}}
function printWin(){if(!printWin.instance){httpLoader("GET","print.html",function(oXH){var oPrint=document.createElement('<object data="print.html" type="text/html" style="position:absolute;left:-2000em;width:200px;height:200px">')
document.body.appendChild(oPrint)
var printReady=setInterval(function(){try{var oPrintDoc=oPrint.object
if(oPrintDoc&&oPrintDoc.location.href.indexOf("print.html")){clearInterval(printReady)
printWin.instance=oPrintDoc
printWin.html=oXH.responseText
initPrintWin()
oPrintDoc=null
oPrint=null}}catch(oErr){}},200)})}else{initPrintWin()}}
;/*@if(!@_jscript)@*/ //Emulation only
function printWin(){print()}
;/*@end @*/
function initPrintWin(){var oDoc=printWin.instance
oDoc.open()
oDoc.write(printWin.html)
oDoc.close()
setTimeout(fillPrintWin,1)}
function fillPrintWin(){var oPrintWin=printWin.instance.parentWindow
oPrintWin.oBaseTheme.href=oBaseTheme.href
try{if(document.styleSheets.oTheme.rules.length>0)oPrintWin.oTheme.href=oTheme.href}catch(e){}
oPrintWin.oCustomRules.href=oCustomRules.href
oPrintWin.document.body.innerHTML=oTopLevelLayer.outerHTML
oPrintWin.document.title=document.title
oPrintWin.oRuntimeStyle.disabled=true
oPrintWin.oRuntimeStyle.disabled=false
var aEmbeds=oPrintWin.document.getElementsByTagName("embed")
for(var i=aEmbeds.length;i--;)aEmbeds[i].setAttribute("autoPlay","0")
switchEmbeds(oPrintWin.document.body,"off")
oPrintWin.oTopLevelLayer.style.width=oTopLevelLayer.runtimeStyle.width
oPrintWin.oTopLevelLayer.style.height=oTopLevelLayer.runtimeStyle.height
oPrintWin.document.body.onafterprint=killPrintWin
setTimeout(function(){oPrintWin.focus()
oPrintWin.print()
oPrintWin=null
aEmbeds=null},1000)}
function killPrintWin(){var sTitle=document.title
printWin.instance.open()
printWin.instance.close()
focus()
try{document.title=sTitle
top.document.title=sTitle}catch(oErr){}}