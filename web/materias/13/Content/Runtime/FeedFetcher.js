if(!window.FeedFetcher){window.FeedFetcher=function(){this.cache={}
this.extMode=false}
FeedFetcher.BASE_URL=window.oConfig&&oConfig.firstChild&&oConfig.firstChild.getAttribute("runtimeBackend")||"/composica/blogs/"
FeedFetcher.queue=[]
FeedFetcher.active=[]
FeedFetcher.extFetchers=[]
FeedFetcher.clear=function(){this.queue=[]
this.extFetchers=[]}
FeedFetcher.enqueue=function(oReq){var oFetcher=oReq.fetcher,iIndex=0
if(oFetcher.extMode){for(var i=this.extFetchers.length;i--;)if(this.extFetchers[i]==oFetcher){iIndex=i+1
break}
if(!iIndex)this.extFetchers.push(oFetcher)
oFetcher.extEnqueue(oReq)}else{for(var i=this.queue.length;i--;)if(this.queue[i].fetcher==oFetcher){iIndex=i+1
break}
if(iIndex)this.queue.splice(iIndex,0,oReq)
else this.queue.push(oReq)}
window.document.body.detachEvent("onfinishpage",FeedFetcher.finishPage)
window.document.body.attachEvent("onfinishpage",FeedFetcher.finishPage)
this.commitAsync()}
FeedFetcher.commitAsync=function(){clearTimeout(this.commitTimer)
this.commitTimer=setTimeout(function(){FeedFetcher.commit()},10)}
FeedFetcher.commit=function(){var aQueue=this.queue,aExtFetchers=this.extFetchers,oLocalCache={},aQueries=[],aQuery,oLast
this.clear()
for(var i=0;i<aExtFetchers.length;i++){aExtFetchers[i].extCommit()}
for(var i=0;i<aQueue.length;i++){var oReq=aQueue[i],oFetcher=oReq.fetcher,sHandler=oFetcher.handler,sReq=oReq.req
if(!sReq||!oFetcher.cache[sReq]&&!oLocalCache[sHandler+"|"+sReq]){if(oFetcher!=oLast){if(aQuery){aQueries[aQueries.length-1]=aQuery.join(";")
aQuery.length=0}else aQuery=[]
aQueries.push(aQuery)
aQuery.push(sHandler)
oLast=oFetcher}
if(sReq){aQuery.push(sReq)
oLocalCache[sHandler+"|"+sReq]=true}}
else oReq.cached=true}
if(aQuery)aQueries[aQueries.length-1]=aQuery.join(";")
if(aQueries.length>0){this.loadScript("get.asp?q="+encodeURIComponent(aQueries.join("|")),this,"runHandlers",aQueue)}else if(aQueue){this.runHandlers(null,aQueue)}}
FeedFetcher.runHandlers=function(oXML,aQueue){var aResults=oXML&&oXML.selectNodes("/cmp:results/cmp:result"),iResult=0
for(var iQ=0;iQ<aQueue.length;iQ++){var oReq=aQueue[iQ],sReq=oReq.req,oFetcher=oReq.fetcher,oScope=oReq.scope,sFunc=oReq.func
if(typeof oScope[sFunc]=="function"){if(!oFetcher.cache[sReq]){oFetcher.cache[sReq]=aResults&&aResults[iResult]}
if(oFetcher.cache[sReq]){oScope[sFunc](oFetcher.cache[sReq],oReq.args)}
if(!oReq.cached){iResult++}}}}
FeedFetcher.loadScript=function(sURL,oScope,sCallback,oArg){var sBase=FeedFetcher.BASE_URL,fHandler,fFailHandler
fHandler=function(sXML){try{if(arguments.callee.aborted)return
var oXML=getXMLDocument()
oXML.setProperty("SelectionNamespaces",'xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:gd="http://schemas.google.com/g/2005" xmlns:thr="http://purl.org/syndication/thread/1.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:cmp="http://composica.com/ns/atom-ext/"')
oXML.setProperty("SelectionLanguage","XPath")
oXML.loadXML(sXML)
oScope.inProgress=false
for(var i=FeedFetcher.active.length;i--;)if(FeedFetcher.active[i]==arguments.callee)FeedFetcher.active.splice(i,1)
FeedFetcher.hideLoader()
oScope[sCallback](oXML,oArg)}catch(vErr){alert("Failed to load feed: "+(vErr.description||(vErr.number?"Error code: "+(0x100000000+vErr.number).toString(16):vErr)))}}
fFailHandler=function(){FeedFetcher.hideLoader()}
oScope.inProgress=true
FeedFetcher.active.push(fHandler)
FeedFetcher.showLoader()
scriptLoader(sBase+sURL,fHandler,fFailHandler)}
FeedFetcher.loadLocal=function(sURL,oScope,sCallback,oArg){var fHandler=function(oXH){try{if(arguments.callee.aborted)return
var sXML=oXH.responseText,oXML=getXMLDocument()
oXML.setProperty("SelectionNamespaces",'xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:gd="http://schemas.google.com/g/2005" xmlns:thr="http://purl.org/syndication/thread/1.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:cmp="http://composica.com/ns/atom-ext/"')
oXML.setProperty("SelectionLanguage","XPath")
oXML.loadXML(sXML)
oScope.inProgress=false
for(var i=FeedFetcher.active.length;i--;)if(FeedFetcher.active[i]==arguments.callee)FeedFetcher.active.splice(i,1)
FeedFetcher.hideLoader()
oScope[sCallback](oXML,oArg)}catch(vErr){alert("Failed to load feed: "+(vErr.description||(vErr.number?"Error code: "+(0x100000000+vErr.number).toString(16):vErr)))}}
sURL=location.href.replace(/[^\/]+$/,"")+"Runtime/"+sURL
oScope.inProgress=true
FeedFetcher.active.push(fHandler)
FeedFetcher.showLoader()
httpLoader("GET",sURL,fHandler)}
FeedFetcher.encodeArg=function(s){if(s){return(""+s).replace(/%/g,"%25").replace(/\,/g,"%2C").replace(/\;/g,"%3B").replace(/\|/g,"%7C")}
return""}
FeedFetcher.showLoader=function(){var oLoader
clearTimeout(FeedFetcher.loaderTimer)
try{oLoader=parent&&parent.document.getElementById("oLoader");}catch(e){}
if(oLoader){FeedFetcher.loaderTimer=setTimeout(function(){oLoader.style.visibility="visible";},500)}}
FeedFetcher.hideLoader=function(){var oLoader
clearTimeout(FeedFetcher.loaderTimer)
try{oLoader=parent&&parent.document.getElementById("oLoader");}catch(e){}
if(oLoader){oLoader.style.visibility="hidden"}}
FeedFetcher.finishPage=function(){clearTimeout(FeedFetcher.commitTimer)
FeedFetcher.clear()
while(FeedFetcher.active.length)FeedFetcher.active.pop().aborted=true
FeedFetcher.hideLoader()}
FeedFetcher.prototype={setHandler:function(){var aHandler=[]
for(var i=0;i<arguments.length;i++)aHandler.push(FeedFetcher.encodeArg(arguments[i]))
this.handler=aHandler.join(",")},enqueue:function(oScope,sFunc){var aArgs=Array.prototype.slice.call(arguments,2),sName,aReq=[]
for(var i=aArgs.length;i--;)aReq[i]=FeedFetcher.encodeArg(aArgs[i]||"")
sName=aArgs.shift()
var oReq={fetcher:this,name:sName,scope:oScope,func:sFunc,args:aArgs,req:aReq.join(",").replace(/,+$/,"")}
if(this.extXML&&sName=="comments"){this.extComments(oReq)}
FeedFetcher.enqueue(oReq)
return oReq},enqueueForce:function(){var oReq=this.enqueue.apply(this,arguments)
delete this.cache[oReq.req]},extLoad:function(sURL){this.extMode=true
this.extQueue=[]
if(sURL.indexOf(":")>0){sURL="externalFeed.asp?u="+encodeURIComponent(sURL)
FeedFetcher.loadScript(sURL,this,"extLoadDone")}else{FeedFetcher.loadLocal(sURL,this,"extLoadDone")}},extLoadDone:function(oXML){this.extXML=oXML
this.extCommit()},extEnqueue:function(oReq){this.extQueue.push(oReq)},extCommit:function(){if(this.extXML&&!this.inProgress){var aQueue=this.extQueue
this.extQueue=[]
for(var i=0;i<aQueue.length;i++){var oReq=aQueue[i],sName=oReq.name,sReq=oReq.req
if(!this.cache[sReq]){this.cache[sReq]=this.extBuild(sName,oReq)}}
FeedFetcher.runHandlers(null,aQueue)}},extBuild:function(sName,oReq){var oExt=this.extXML
switch(sName){case"total":var oResult=oExt.createNode(1,"result","http://composica.com/ns/atom-ext/"),sFilter=oReq.args[0],sQuery="/atom:feed/atom:entry|/rss/channel/item"
if(sFilter){sFilter=sFilter.replace(/[\"\\]/g,'\\$&')
sQuery='/atom:feed/atom:entry[atom:category/@term="'+sFilter+'" or atom:category/@label="'+sFilter+'"]|/rss/channel/item[category="'+sFilter+'"]'}
oResult.text=oExt.selectNodes(sQuery).length
return oResult
case"post":var sId=oReq.args[0]
if(sId){var sId=sId.replace(/[\"\\]/g,'\\$&'),oNode=oExt.selectSingleNode('//item[guid="'+sId+'"]|//item[not(guid) and link="'+sId+'"]|//atom:entry[atom:id="'+sId+'"]'),oResult=oExt.createNode(1,"result","http://composica.com/ns/atom-ext/")
if(oNode){var oDirs={previous:oNode.previousSibling,next:oNode.nextSibling}
oNode=oNode.cloneNode(true)
for(var sDir in oDirs){var oItem=oDirs[sDir]
while(oItem&&oItem.nodeName!=oNode.nodeName){oItem=oItem[sDir+"Sibling"]}
if(oItem){var oItemId=FeedRender.Getter.id(oItem),oItemTitle=FeedRender.Getter.title(oItem),oItemNode=oExt.createNode(1,sDir,"http://composica.com/ns/atom-ext/")
if(oItemId){oItemNode.appendChild(oItemId.cloneNode(true))}
if(oItemTitle){oItemNode.appendChild(oItemTitle.cloneNode(true))}
oNode.appendChild(oItemNode)}}
oResult.appendChild(oNode)}
return oResult}
break
case"posts":case"recent":case"archive":var iCount=+oReq.args[0],iStart=+oReq.args[1],iWords=+oReq.args[2],sFilter=oReq.args[3]
if(iCount>0||iWords>0||sFilter)oExt=oExt.cloneNode(true)
if(sFilter){var sFilter=sFilter.replace(/[\"\\]/g,'\\$&'),aEntries=oExt.selectNodes('/atom:feed/atom:entry[not(atom:category/@term="'+sFilter+'" or atom:category/@label="'+sFilter+'")]|/rss/channel/item[not(category="'+sFilter+'")]')
for(var i=aEntries.length;i--;){aEntries[i].parentNode.removeChild(aEntries[i])}}
if(iCount>0){var iMax=iStart+iCount,aEntries=oExt.selectNodes("/atom:feed/atom:entry|/rss/channel/item")
for(var i=aEntries.length;i--;)if(i>=iMax||i<iStart){aEntries[i].parentNode.removeChild(aEntries[i])}}
if(iWords>0){var aNodes=oExt.selectNodes("//atom:content|//content:encoded")
for(var i=0;i<aNodes.length;i++){var oNode=aNodes[i],oParent=oNode.parentNode
if(oParent&&oParent.selectSingleNode("atom:summary|description")){oParent.removeChild(oNode)}else{var sHTML=oNode.text,sText=sHTML.replace(/<(?:[^=>]+=\s*(?:([\"\'`])[\s\S]*?\1|[^\s>]+))*[^>]*(?:>|$)|&nbsp;|&#160;|&#xA0;|\xA0/gi,"").replace(/^\s+|\s+$|(\s)\s+/g,"$1")
if(new RegExp("^((?:\\S+\\s+){"+iWords+"})").test(sText)){sText=RegExp.$1+" [...]"}else if(/<img/i.test(sHTML)){sText=sText+" [...]"}
oNode.text=sText}}}
return oExt
case"categories":case"tagcloud":var aCats=oExt.selectNodes("/atom:feed/atom:entry/atom:category/@term|/atom:feed/atom:entry/atom:category[not(@term)]/@label|/rss/channel/item/category"),oResult=oExt.createNode(1,"result","http://composica.com/ns/atom-ext/"),iCount=+oReq.args[0],oCounts={},aTags=[]
for(var i=0;i<aCats.length;i++){var sTag=aCats[i].text
if(sTag){if(oCounts[sTag])oCounts[sTag]++
else{oCounts[sTag]=1
aTags.push(sTag)}}}
aTags.sort(function(sA,sB){return oCounts[sA]==oCounts[sB]?sA<sB?-1:1:oCounts[sA]>oCounts[sB]?-1:1})
if(iCount>0)aTags=aTags.slice(0,iCount)
for(var i=0;i<aTags.length;i++){var oEntry=oExt.createNode(1,"entry","http://www.w3.org/2005/Atom"),oTitle=oExt.createNode(1,"title","http://www.w3.org/2005/Atom"),oCount=oExt.createNode(1,"count","http://composica.com/ns/atom-ext/"),sTag=aTags[i]
oTitle.text=sTag
oCount.text=oCounts[sTag]
oEntry.appendChild(oTitle)
oEntry.appendChild(oCount)
oResult.appendChild(oEntry)}
return oResult
default:return oExt.createNode(1,"result","http://composica.com/ns/atom-ext/")}},extComments:function(oReq){if(!this.cache[oReq.req]){var sId=(oReq.args[0]||"").replace(/[\"\\]/g,'\\$&'),oNode,sURL
oReq.processed=true
oNode=this.extXML.selectSingleNode('//item[guid="'+sId+'"]/wfw:commentRss|//item[not(guid) and link="'+sId+'"]/wfw:commentRss|//atom:entry[atom:id="'+sId+'"]/atom:link[@rel="replies" and (@type="application/atom+xml" or not(@type))]/@href')
if(oNode){sURL=oNode.text
if(sURL){if(sURL.indexOf(":")>0){sURL="externalFeed.asp?u="+encodeURIComponent(sURL)
FeedFetcher.loadScript(sURL,this,"extCommentsDone",oReq)}else{FeedFetcher.loadLocal(sURL,this,"extCommentsDone",oReq)}}}}},extCommentsDone:function(oXML,oReq){this.cache[oReq.req]=oXML
this.extCommit()},post:function(oScope,sFunc,oVals){var oDoc=window.document,sBase=FeedFetcher.BASE_URL,oDiv=oDoc.createElement("div"),oForm=oDoc.createElement("form"),sFrame="frame_"+new Date().getTime().toString(36),oFrame,fHandler
if(!oVals.handler)oVals.handler=this.handler
oDiv.style.display="none"
oDiv.innerHTML='<iframe name="'+sFrame+'" src="about:blank" />'
oFrame=oDiv.firstChild
fHandler=function(event){if(oFrame.readyState=="complete"||event.type=="load"){oFrame.detachEvent("onload",fHandler)
oFrame.detachEvent("onreadystatechange",fHandler)
oFrame.src="about:blank"
oDiv.removeNode(true)
FeedFetcher.hideLoader()
oScope[sFunc](oVals)}}
oFrame.attachEvent("onload",fHandler)
oFrame.attachEvent("onreadystatechange",fHandler)
oForm.action=sBase+"post.asp"
oForm.method="post"
oForm.target=sFrame
for(var sName in oVals)if(oVals[sName]){var oInp=oDoc.createElement("input")
oInp.type="hidden"
oInp.name=sName
oInp.value=oVals[sName]
oForm.appendChild(oInp)}
oDiv.appendChild(oForm)
oDoc.body.appendChild(oDiv)
FeedFetcher.showLoader()
oForm.submit()}}}