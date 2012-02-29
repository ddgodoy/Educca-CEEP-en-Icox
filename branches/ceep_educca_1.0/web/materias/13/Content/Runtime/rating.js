function Rating(oEl,sOwnerId,oRating,bReadOnly){var oProject=window.oConfig&&oConfig.firstChild
this.el=oEl
this.persisted=oEl.getAttribute("alreadyDone")=="true"
this.readOnly=bReadOnly
this.accumulate=oEl.getAttribute("accumulate")!="false"
this.autoscorm=oEl.getAttribute("autoscorm")!="false"
this.value=0
this.projectNode=oProject
this.count=oEl.getAttribute("count")||5
this.tags={"ratingon":[],"ratingedit":[],"ratingoff":[]}
if(!this.persisted){this.runTags("prepare")}else{this.clearSplit()
this.runTags("reprepare")}
this.createSplit()
if(sOwnerId){this.fetcher=new FeedFetcher()
this.fetcher.setHandler("rating",sOwnerId)
this.ownerId=sOwnerId
this.apply(oRating)}else{var sPrjId=oProject&&oProject.getAttribute("publicId")
sDocId=window.oResource&&oResource.getAttribute("id"),sRateId=oEl.id
this.render(0)
if(sPrjId&&sDocId&&sRateId){if(this.accumulate){this.fetcher=new FeedFetcher()
this.fetcher.setHandler("rating",sPrjId,sDocId,sRateId)
this.ownerId=[sPrjId,sDocId,sRateId].join(",")}
this.fetch()}}}
Rating.cache={}
Rating.prototype={fetch:function(){if(this.accumulate){this.fetcher.enqueueForce(this,"fetched")}else{this.fetched()}},fetched:function(oXML){if(this.accumulate){var oScore=oXML.selectSingleNode("cmp:score"),oVotes=oXML.selectSingleNode("cmp:votes"),iScore=+oScore.text||0,iVotes=+oVotes.text||0}else{var iScore=0,iVotes=0}
this.set(iScore,iVotes)
this.cacheScore(iScore,iVotes)
this.enable()},apply:function(oNode){var iScore=0,iVotes=0
if(Rating.cache[this.ownerId]){iScore=Rating.cache[this.ownerId].score||0
iVotes=Rating.cache[this.ownerId].votes||0}else if(oNode){var oScore=oNode.selectSingleNode("cmp:score"),oVotes=oNode.selectSingleNode("cmp:votes")
if(oScore){iScore=+oScore.text||0
iVotes=+oVotes.text||0}else{var iMin=+oNode.getAttribute("min")||0,iMax=+oNode.getAttribute("max")||1
iScore=((+oNode.getAttribute("average")||0)-iMin)/(iMax-iMin)
iVotes=(+oNode.getAttribute("numRaters")||0)}}
this.set(iScore,iVotes)
this.enable()},cacheScore:function(iScore,iVotes){if(this.ownerId){Rating.cache[this.ownerId]={score:iScore,votes:iVotes}}},set:function(iValue,iVotes){var iScore=Math.round(iValue*this.count*100)/100
this.render(iScore)
this.value=iScore
this.el.setAttribute("score",this.accumulate?iScore.toFixed(2):Math.round(iScore))
this.el.setAttribute("votes",iVotes)
try{this.el.fireVarChange();}catch(e){}
if(!this.isReady){Classes.add(this.el,"isReady")
this.isReady=true}},render:function(iScore,bEdit){var sOn=bEdit&&this.tags["ratingedit"].length?"ratingedit":"ratingon",sOff="ratingoff",iFraction=iScore-Math.floor(iScore)
this.runTags("hide")
this.show(sOn,Math.floor(iScore))
this.split(sOn,sOff,Math.ceil(iScore),iFraction)
this.show(sOff,this.count-Math.ceil(iScore),Math.ceil(iScore))},runTags:function(){var sFunc=arguments[0],aArgs=arguments
for(var sTag in this.tags){aArgs[0]=sTag
this[sFunc].apply(this,aArgs)}},prepare:function(sTag){var aEls=this.el.getElementsByTagName(sTag),oLast=aEls[aEls.length-1]
if(oLast){for(var i=0;i<aEls.length;i++){var oEl=aEls[i]
opacityOverlay(oEl)
oEl.setAttribute("curDisp",oEl.style.display)
this.tags[sTag].push(oEl)}
for(var i=aEls.length;i<this.count;i++){var oEl=oLast.parentNode.insertBefore(oLast.cloneNode(true),oLast.nextSibling)
this.tags[sTag].push(oEl)
oLast=oEl}}},reprepare:function(sTag){var aEls=this.el.getElementsByTagName(sTag)
for(var i=0;i<aEls.length;i++){var oEl=aEls[i]
this.tags[sTag].push(oEl)}},hide:function(sTag){var aEls=this.tags[sTag]
for(var i=0;i<aEls.length;i++){var oEl=aEls[i]
oEl.style.display="none"
oEl.removeAttribute("idx")}},show:function(sTag,iStars,iOff){var aEls=this.tags[sTag]
iStars=Math.min(iStars,aEls.length)
iOff=iOff||0
for(var i=0;i<iStars;i++){aEls[i].style.display=aEls[i].getAttribute("curDisp")
aEls[i].setAttribute("idx",iOff+i+1)}},clearSplit:function(){var oSpliter=this.el.getElementsByTagName("ratingsplit")[0]
if(oSpliter){oSpliter.parentNode.removeChild(oSpliter)}},createSplit:function(){var oElOn=this.tags["ratingon"][0],oElOff=this.tags["ratingoff"][0],oStub=oElOn,oSplit1,oSplit2
if(oElOn.offsetWidth==0){try{oStub=oElOn.cloneNode(true)
oElOn.document.getElementById("oDocContent").appendChild(oStub)}catch(oErr){}}
if(oElOn){var oSplit=oElOn.document.createElement("gm:ratingsplit"),sPos=oElOn.currentStyle.position,iTop=oElOn.currentStyle.top,iLeft=oElOn.currentStyle.left,iRight=oElOn.currentStyle.right,iBottom=oElOn.currentStyle.bottom,iWidth=oStub.offsetWidth,iHeight=oStub.offsetHeight
if(oStub!=oElOn){oStub.parentNode.removeChild(oStub)}
oSplit.style.position=sPos!="static"?sPos:"relative"
oSplit.style.top=sPos!="static"?iTop:0
oSplit.style.left=sPos!="static"?iLeft:0
oSplit.style.right=iLeft&&iLeft!="auto"||sPos=="static"?"auto":iRight
oSplit.style.bottom=iTop&&iTop!="auto"||sPos=="static"?"auto":iBottom
oSplit.style.width=iWidth
oSplit.style.height=iHeight
oSplit1=oSplit.appendChild(oElOn.cloneNode(true))
oSplit1.style.position="absolute"
oSplit1.style.top=0
oSplit1.style.left=0
oSplit1.style.bottom="auto"
oSplit1.style.right="auto"
oSplit1.setAttribute("spliter","true")
oSplit2=oSplit.appendChild(oElOff.cloneNode(true))
oSplit2.style.position="absolute"
oSplit2.style.top=0
oSplit2.style.left=0
oSplit2.style.bottom="auto"
oSplit2.style.right="auto"
oSplit2.setAttribute("spliter","true")
oSplit.style.display="none"
oElOff.parentNode.insertBefore(oSplit,oElOff)
this.splitEl=oSplit
this.splitW=iWidth}},split:function(sTag1,sTag2,iPos,iFraction){var oSplit=this.splitEl
if(oSplit){oSplit.style.display="none"
if(iFraction){var oSplit1=oSplit.firstChild,oSplit2=oSplit.lastChild,iWidth,iOff
if(oSplit1&&oSplit2){oSplit.style.display=""
iWidth=this.splitW
iOff=Math.round(iWidth*iFraction)
if(oSplit.currentStyle.direction=="rtl"){iOff=iWidth-iOff
oSplit1.style.clip="rect(auto auto auto "+iOff+")"
oSplit2.style.clip="rect(auto "+iOff+" auto auto)"}else{oSplit1.style.clip="rect(auto "+iOff+" auto auto)"
oSplit2.style.clip="rect(auto auto auto "+iOff+")"}
oSplit1.style.display=""
oSplit2.style.display=""
oSplit1.setAttribute("idx",iPos)
oSplit2.setAttribute("idx",iPos)}}}},enable:function(){if(!this.readOnly&&!this.restorePersist()){var oScope=this
this.el.onmouseover=function(){oScope.hover()}
this.el.onmouseout=function(){oScope.unhover()}
this.el.onmousedown=function(){oScope.post()}}},disable:function(){this.el.onmouseover=null
this.el.onmouseout=null
this.el.onmousedown=null},hover:function(){var oSrc=event.srcElement,oEl=this.el,iVal=0
while(oSrc&&oSrc!=this.el&&!this.tags[oSrc.tagName])oSrc=oSrc.parentNode
if(oSrc&&this.tags[oSrc.tagName]){iVal=oSrc.getAttribute("idx")
if(iVal!=this.curValue){this.render(iVal,true)
this.curValue=iVal}}},unhover:function(){var oTgt=event.toElement,oEl=this.el
if(oEl.contains(oTgt))while(oTgt&&oTgt!=this.el&&!this.tags[oTgt.tagName])oTgt=oTgt.parentNode
else oTgt=null
if(!oTgt||!this.tags[oTgt.tagName]){this.render(this.value)
delete this.curValue}},post:function(){if(this.curValue){var iVal=this.curValue
if(window.sProjectId&&sProjectId!="Res"){var iVotes=this.accumulate?+this.el.getAttribute("votes")+1:1,iScore=(this.value*(iVotes-1)/iVotes+this.curValue/iVotes)/this.count
this.set(iScore,iVotes)
this.cacheScore(iScore,iVotes)}else{this.storePersist()
if(this.accumulate){this.disable()
this.fetcher.post(this,"fetch",{score:this.curValue/this.count})
this.unhover()}else{var iScore=this.curValue/this.count
this.set(iScore,1)
this.cacheScore(iScore,iVotes)}}
try{if(this.autoscorm)this.el.commitInteraction(iVal);}catch(e){}}},storePersist:function(){if(this.ownerId){var oProject=this.projectNode,oDoc=oProject.ownerDocument,oRatings=oProject.selectSingleNode("ratings"),oVote=oDoc.createElement("vote")
if(!oRatings){oRatings=oDoc.createElement("ratings")
oProject.appendChild(oRatings)}
oVote.appendChild(oDoc.createTextNode(this.ownerId))
oRatings.appendChild(oVote)
State.store(oDoc,null,true)}},restorePersist:function(){var oProject=this.projectNode
if(!oProject||oProject.getAttribute("restoreLMS")!="true"&&oProject.getAttribute("restoreUserdata")!="true"){var oDoc=getXMLDocument()
if(!State.restore(oDoc,null,true)){oDoc.loadXML("<project><ratings></ratings></project>")}
oProject=oDoc.firstChild}
return oProject.selectSingleNode('ratings/vote[text()="'+this.ownerId+'"]')}};