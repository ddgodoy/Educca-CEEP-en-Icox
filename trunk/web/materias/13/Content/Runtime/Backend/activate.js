
Activation={courseURL:"",tagPrefix:"",blogs:[],widgets:{"navhome":1,"navadd":1,"navedit":1,"navdel":1,"recent":1,"recentcom":1,"archive":1,"toprated":1,"categories":1,"tagcloud":1},props:[{name:"subtype",path:"@subType"},{name:"footer",path:"@footer"},{name:"noindex",path:"@noindex"},{name:"dateformat",path:"@dateformat"},{name:"words",path:"@words"},{name:"add",path:"blognavadd",type:"bool"},{name:"addauth",path:"blognavadd/@auth"},{name:"addapproval",path:"blognavadd/@approval"},{name:"edit",path:"blognavedit",type:"bool"},{name:"editmode",path:"blognavedit/@mode"},{name:"del",path:"blognavdel",type:"bool"},{name:"delmode",path:"blognavdel/@mode"},{name:"recentcount",path:"blogrecent/@count",type:"number"},{name:"recentcomcount",path:"blogrecentcom/@count",type:"number"},{name:"recentcomwords",path:"blogrecentcom/@words",type:"number"},{name:"topratedcount",path:"blogtoprated/@count",type:"number"},{name:"categoriescount",path:"blogcategories/@count",type:"number"},{name:"tagcloudcount",path:"blogtagcloud/@count",type:"number"},{name:"navcount",path:"blognav/@count",type:"number"},{name:"prevtitle",path:"blognavprev"},{name:"nexttitle",path:"blognavnext"},{name:"feedlink",path:"a[feedlink]"},{name:"rating",path:"blogpost/rating",type:"bool"},{name:"ratinginfo",path:"blogpost/rating/ratinginfo",type:"ratinginfo"},{name:"ratingmax",path:"blogpost/rating/@count",type:"number"},{name:"comrating",path:"blogcompost/rating",type:"bool"},{name:"comratinginfo",path:"blogcompost/rating/ratinginfo",type:"ratinginfo"},{name:"comratingmax",path:"blogcompost/rating/@count",type:"number"},{name:"formtitlelabel",path:"blogpostedit/blogtitlelabel"},{name:"formauthor",path:"blogpostedit/blogauthorlabel",type:"bool"},{name:"formauthorlabel",path:"blogpostedit/blogauthorlabel"},{name:"formtags",path:"blogpostedit/blogtagslabel",type:"bool"},{name:"formtagslabel",path:"blogpostedit/blogtagslabel"},{name:"formtextlabel",path:"blogpostedit/blogtextlabel"},{name:"formsubmitlabel",path:"blogpostedit/blogsubmit"},{name:"formnotice",path:"blogpostedit/notice/@items",type:"notice"},{name:"comments",path:"blogcom",type:"bool"},{name:"comform",path:"blogcomedit",type:"bool"},{name:"comauth",path:"blogcomedit/@auth"},{name:"comapproval",path:"blogcomedit/@approval"},{name:"comauthor",path:"blogcomedit/blogauthorlabel",type:"bool"},{name:"comauthorlabel",path:"blogcomedit/blogauthorlabel"},{name:"comtextlabel",path:"blogcomedit/blogtextlabel"},{name:"comsubmitlabel",path:"blogcomedit/blogsubmit"},{name:"comnotice",path:"blogcomedit/notice/@items",type:"notice"}],loginProps:[{name:"loginuserlabel",path:"loginuserlabel"},{name:"loginpasslabel",path:"loginpasslabel"},{name:"loginsubmitlabel",path:"loginsubmit"},{name:"loginreglabel",path:"loginreglabel"},{name:"loginrepasslabel",path:"loginrepasslabel"},{name:"loginregisterlabel",path:"loginregister"},{name:"loginnotice",path:"notice/@items",type:"notice"}],stages:[function(){this.container=document.createElement("div")
this.container.style.display="none"
this.container.innerHTML='<iframe name="oFrame" src="about:blank" />'
document.body.appendChild(this.container)
this.frame=this.container.firstChild
this.frameDoc=frames.oFrame.document
this.load("project.xml","projectXML","xml")
return},function(){if(this.projectXML){var oProject=this.projectXML.documentElement,sPrjId=oProject.getAttribute("publicId"),sDocs=oProject.getAttribute("blogIndex")
if(sPrjId){this.projectId=sPrjId
this.publishTag=oProject.getAttribute("publishTag")
this.engineURL=oProject.getAttribute("runtimeBackend")||"/composica/blogs/"
this.loginMode=oProject.getAttribute("learnerAuth")
this.modPrvPass=oProject.getAttribute("moderationToken")
this.modPubPass=oProject.getAttribute("moderationPassword")
if(sDocs){var aDocs=sDocs.split("|")
if(aDocs.length>0){this.docs=[]
for(var i=0;i<aDocs.length;i++){var aDoc=aDocs[i].split(",")
this.docs[i]={id:decodeURIComponent(aDoc[0]),login:aDoc.length>1?decodeURIComponent(aDoc[1]):null}}
this.docIndex=0
this.baseObj={}
this.next()
return}}}}
this.finish()},function(){var oDoc=this.docs[this.docIndex]
if(oDoc.login){var sLoginId=oDoc.login
delete oDoc.login
this.docState="login"
this.load(sLoginId,"docHTML","text")
return}
this.docId=oDoc.id
this.docState="doc"
this.load(oDoc.id,"docHTML","text")},function(){var sHTML=this.docHTML.replace(/<!-- (.*) -->\r\n/,""),sStyle=RegExp.$1
this.frameDoc.write(sHTML)
this.frameDoc.close()
this.frameDoc.documentElement.style.cssText=sStyle
if(!this.frameDoc.namespaces||!this.frameDoc.namespaces.gm)this.tagPrefix="gm:"
if(this.docState=="login"){var oForm=this.frameDoc.getElementsByTagName(this.tagPrefix+"loginform")[0],oBtn,sTitle
if(oForm){oBtn=oForm.parentNode
this.baseObj.login="true"
this.processProperties(this.baseObj,oForm,this.loginProps)
if(oBtn){oBtn.removeChild(oForm)
sTitle=this.extractText(oBtn)
if(sTitle)this.baseObj.logintitle=sTitle}}
this.docState="doc"
this.prev()}else{var aBlogs=this.frameDoc.getElementsByTagName(this.tagPrefix+"blog"),oDoc=this.findNode(this.projectXML,'/project/structure//*[@id="'+this.docId+'" and @title]')
for(var i=0;i<aBlogs.length;i++){var oBlog=aBlogs[i],sDir=this.getStyle(oBlog,"direction"),oObj={}
if(oBlog.getAttribute("feed"))continue
for(var sKey in this.baseObj){oObj[sKey]=this.baseObj[sKey]}
oObj.id=oBlog.id
oObj.docid=this.docId
oObj.publishtag=this.publishTag
if(oDoc)oObj.title=oDoc.getAttribute("title")
if(this.loginMode)oObj.loginmode=this.loginMode
if(sDir&&sDir!="ltr")oObj.direction=sDir
var aWidgets=[],oWidgets=oBlog.getElementsByTagName(this.tagPrefix+"blogwidgets")[0]
if(oWidgets){for(var i=0;i<oWidgets.childNodes.length;i++){var oWidget=oWidgets.childNodes[i],sWidget=oWidget.nodeType==1&&oWidget.tagName.toLowerCase().substr((this.tagPrefix+"blog").length)
if(sWidget&&this.widgets[sWidget]){var oTitle=oWidget.getElementsByTagName(this.tagPrefix+"blogwidgettitle")[0],sTitle
sTitle=this.extractText(oTitle||oWidget)
if(sTitle)oObj[sWidget+"title"]=sTitle
aWidgets.push(sWidget)}}}
if(aWidgets.length>0)oObj.widgets=aWidgets.join(",")
this.processProperties(oObj,oBlog,this.props)
this.blogs.push(oObj)}
if(++this.docIndex<this.docs.length){this.baseObj={}
this.prev()}else{delete this.docState
this.next()}}},function(){var aBlogs=[],oForm=document.createElement("form"),oInp
for(var i=0;i<this.blogs.length;i++){var oObj=this.blogs[i],aBlog=[]
for(var sKey in oObj){var sVal=oObj[sKey].replace(/%/g,"%25").replace(/\=/g,"%3D").replace(/\:/g,"%3A").replace(/\|/g,"%7C")
aBlog.push(sKey+"="+sVal)}
aBlogs.push(aBlog.join(":"))}
oForm.action=this.engineURL+"activate.asp"
oForm.method="post"
oForm.target="oFrame"
oInp=document.createElement("input")
oInp.type="hidden"
oInp.name="p"
oInp.value=this.projectId
oForm.appendChild(oInp)
oInp=document.createElement("input")
oInp.type="hidden"
oInp.name="d"
oInp.value=aBlogs.join("|")
oForm.appendChild(oInp)
this.container.appendChild(oForm)
this.form=oForm
this.next()},function(){var oScope=this
this.frameHandler(this.frame,function(){oScope.next()})
this.form.submit()},function(){if(this.modPrvPass&&this.modPubPass&&this.frame.attachEvent&&MD5){var oScope=this,bSuccess=false,sModURL=this.engineURL+"mod.asp?i="+encodeURIComponent(this.projectId)+"&r="+encodeURIComponent(this.modPrvPass)+"&p="+encodeURIComponent(MD5(this.modPubPass))
this.frameHandler(this.frame,function(){oScope.finish(bSuccess,sModURL)},function(){if(oScope.frame.src=="about:blank")bSuccess=true})
this.frame.src=sModURL+"&auto"}else{this.finish(true)}}],finish:function(bSuccess,sModURL){if(this.frame&&this.frame.src!="about:blank")this.frame.src="about:blank"
if(this.container&&this.container.parentNode)document.body.removeChild(this.container)
delete this.cache
delete this.frameDoc
delete this.frame
delete this.form
delete this.container
if(this.callback)this.callback(bSuccess,sModURL)},run:function(fCallback,sURL,oCache){this.callback=fCallback
this.courseURL=sURL
this.cache=oCache||{}
this.curStage=0
this.exec()},next:function(){if(++this.curStage<this.stages.length){this.exec()}},prev:function(){if(--this.curStage>=0){this.exec()}},exec:function(){this.stages[this.curStage].call(this)},load:function(sURL,sProp,sType){if(this.cache&&this.cache[sURL]){if(sType=="xml"){var oXML
try{oXML=new ActiveXObject("MSXML2.DOMDocument");}
catch(oErr){oXML=new ActiveXObject("Microsoft.XMLDOM");}
oXML.loadXML(this.cache[sURL])
this[sProp]=oXML}else{this[sProp]=this.cache[sURL]}
this.next()}else if(!this.courseURL){this.finish()}else{var oXH,bDone=false,oScope=this
try{oXH=new ActiveXObject("MSXML2.XMLHTTP");}
catch(e){try{oXH=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){}}
if(!oXH&&window.XMLHttpRequest)oXH=new XMLHttpRequest()
if(oXH){oXH.open("GET",this.courseURL+sURL,true)
oXH.onreadystatechange=function(){if(!bDone&&oXH.readyState==4){if(oXH.status==200||oXH.status==0){bDone=true
oScope.cache[sURL]=oXH.responseText
oXH=null
oScope.load(sURL,sProp,sType)}else{oScope.finish()}
oScope=null}}
oXH.send("")}}},processProperties:function(oObj,oEl,aProps){for(var i=0;i<aProps.length;i++){var oProp=aProps[i],sVal=this.getProperty(oEl,oProp.path,oProp.type)
if(oProp.type=="bool"){oObj[oProp.name]=sVal?"true":"false"}else if(sVal){if(oProp.type=="notice"){var aVals=sVal.split("\3")
for(var j=0;j<aVals.length;j++){oObj[oProp.name+j]=aVals[j]}}else{oObj[oProp.name]=sVal}}}},getProperty:function(oEl,sPath,sType){var oContext=oEl,aPath=sPath.split("/"),sRes
for(var i=0;i<aPath.length;i++){var sPart=aPath[i]
if(sPart.charAt(0)=="@"){sRes=oContext.getAttribute(sPart.substr(1))
return sType=="number"&&isNaN(sRes)?null:sRes}else{if(/^([^\[]+)\[([^\]]+)\]$/.test(sPart)){var sTag=RegExp.$1,sClass=RegExp.$2,aEls=oContext.getElementsByTagName(this.tagPrefix+sTag)
oContext=null
for(var j=0;j<aEls.length&&!oContext;j++)if(aEls[i].className==sClass)oContext=aEls[i]}else{oContext=oContext.getElementsByTagName(this.tagPrefix+sPart)[0]}
if(!oContext)return null}}
if(sType=="bool")return true
if(sType=="ratinginfo"){var aVars=oContext.getElementsByTagName(this.tagPrefix+"variable")
for(var i=0;i<aVars.length;i++){var oVar=aVars[i]
if(/^rating (\S+)$/.test(oVar.getAttribute("vardesc"))){oVar.innerHTML="&#3;"+RegExp.$1+"&#3;"}}}
sRes=this.extractText(oContext)
if(sType=="number"&&isNaN(sRes))return null
return sRes},findNode:function(oXML,sXPath){if(oXML&&sXPath){if(typeof oXML.selectSingleNode!="undefined"){return oXML.selectSingleNode(sXPath)}else if(oXML.createNSResolver){var oNSResolver=oXML.createNSResolver(oXML.documentElement),aItems=oXML.evaluate(sXPath,oXML,oNSResolver,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,null),aResult=[]
if(aItems.snapshotLength)return aItems.snapshotItem(0)}}
return null},extractText:function(oNode){return(oNode.innerText||oNode.textContent||"").replace(/^[\s\xA0]+|[\s\xA0]+$/g,"").replace(/[\s\xA0]+/g," ")},getStyle:function(oEl,sStyle){if(oEl.currentStyle)return oEl.currentStyle[sStyle]
else if(getComputedStyle)return getComputedStyle(oEl,"").getPropertyValue(sStyle)},frameHandler:function(oFrame,fDone,fStep){if(oFrame.attachEvent){var fHandler=function(){if(fStep)fStep()
if(oFrame.readyState=="complete"||event.type=="load"){oFrame.detachEvent("onload",fHandler)
oFrame.detachEvent("onreadystatechange",fHandler)
fDone()}}
oFrame.attachEvent("onload",fHandler)
oFrame.attachEvent("onreadystatechange",fHandler)}else{oFrame.addEventListener("load",function(){oFrame.removeEventListener("load",arguments.callee,false)
fDone()},false)}}}