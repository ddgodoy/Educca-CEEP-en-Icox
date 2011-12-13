if(!window.FeedRender){window.FeedRender=function(oContainer,oStub,sDateFormat,bRevIndex){this.container=oContainer
this.itemStub=oStub
this.itemTag=oStub.tagName
if(sDateFormat)this.dateFormat=sDateFormat
if(bRevIndex)this.reverseIndex=true
var oEllipsis=this.itemStub.getElementsByTagName(this.itemTag+"ellipsis")[0]
if(oEllipsis){this.ellipsis=oEllipsis.outerHTML
oEllipsis.removeNode(true)}
this.clear()}
FeedRender.prototype={dateFormat:"mm-dd-yyyy hh:nn:ss",clear:function(){if(this.container){var aItems=this.container.getElementsByTagName(this.itemTag)
for(var i=aItems.length;i--;){if(aItems[i]!=this.itemStub)aItems[i].removeNode(true)}}},apply:function(oFeed){if(this.container){this.clear()
var aEntries=oFeed.selectNodes("atom:feed/atom:entry|rss/channel/item|atom:entry|item"),iCount=aEntries.length
for(var i=0;i<iCount;i++){var oEntry=aEntries[i],oItem=this.itemStub.cloneNode(true),aVars=oItem.getElementsByTagName("variable")
oItem.entry=oEntry
var oDate=FeedRender.Getter.date(oEntry),dDate=oDate&&this.strToDate(oDate.text)
if(dDate)oItem.entrydate=dDate
for(var j=0;j<aVars.length;j++){var oVar=aVars[j],sDesc=oVar.getAttribute("vardesc"),iHeight
if(sDesc.indexOf(FeedRender.VAR_PREFIX)==0){var sName=sDesc.substr(FeedRender.VAR_PREFIX_LEN)
if(sName=="date"&&dDate){oVar.innerText=this.dateToStr(dDate)}else{var oNode=FeedRender.Getter[sName]&&FeedRender.Getter[sName](oEntry)
if(oNode){if(oNode.length>0){var aVal=[],sVal
for(var k=0;k<oNode.length;k++){aVal.push(oNode[k].text)}
sVal=aVal.join(", ")
if(sVal)oVar.innerText=sVal}else if(oNode.length===undefined){var sType=oNode.nodeType==1&&oNode.getAttribute("type")
switch(sType){case"xhtml":var a=[]
for(var k=0;k<oNode.childNodes.length;k++){a.push(oNodes.childNodes[k].xml)}
oVar.innerHTML=a.join("")
break
case"html":var sHTML=oNode.text
if(sName=="content"&&this.ellipsis)sHTML=sHTML.replace(/\[\.\.\.\]$/,this.ellipsis)
oVar.innerHTML=sHTML
break
default:var sVal=oNode.text
oVar.innerText=sVal}}}}}else if(sDesc=="entry index"){oVar.innerText=this.reverseIndex?iCount-i:i+1}
if(oVar.offsetHeight==oVar.scrollHeight)oVar.style.height="auto"}
this.container.appendChild(oItem)}
this.itemStub.removeNode(true)
if(window.Adaptie&&Adaptie.canAdapt)Adaptie.Element.fitHeightToContent(this.container)}},strToDate:function(sVal){if(/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2}(?:\.\d+)?)(?:Z|([\+\-])(\d{2}):(\d{2}))$/.test(sVal)){var iYear=+RegExp.$1,iMon=+RegExp.$2,iDay=+RegExp.$3,iHour=+RegExp.$4,iMin=+RegExp.$5,iSec=+RegExp.$6,sTZDir=RegExp.$7,iTZHour=+RegExp.$8,iTZMin=+RegExp.$9
var dDate=new Date(Date.UTC(iYear,iMon-1,iDay,iHour,iMin,Math.floor(iSec),iSec*1000%1000))
if(sTZDir){if(iTZHour>0)dDate.setHours(dDate.getHours()+(sTZDir=="+"?-iTZHour:iTZHour))
if(iTZMin>0)dDate.setMinutes(dDate.getMinutes()+(sTZDir=="+"?-iTZMin:iTZMin))}}else dDate=new Date(sVal)
if(dDate&&!isNaN(dDate))return dDate
else return null},dateToStr:function(dDate){var oDate={y:dDate.getFullYear(),m:dDate.getMonth()+1,d:dDate.getDate(),h:dDate.getHours(),n:dDate.getMinutes(),s:dDate.getSeconds()}
sVal=this.dateFormat.replace(/[ymdhns]+/g,function(sFmt){var sPart=""+oDate[sFmt.charAt(0)]
while(sPart.length<sFmt.length)sPart="0"+sPart
return sPart})
return sVal}}
FeedRender.Getter={title:function(oNode){return oNode.selectSingleNode("atom:title")||oNode.selectSingleNode("title")},author:function(oNode){return oNode.selectSingleNode("atom:author/atom:name")||oNode.selectSingleNode("dc:creator")||oNode.selectSingleNode("author")},date:function(oNode){return oNode.selectSingleNode("atom:updated")||oNode.selectSingleNode("atom:published")||oNode.selectSingleNode("pubDate")},content:function(oNode){var oRes=oNode.selectSingleNode("atom:content")||oNode.selectSingleNode("atom:summary")
if(!oRes){oRes=oNode.selectSingleNode("content:encoded")||oNode.selectSingleNode("description")
if(oRes&&!oRes.getAttribute("type"))oRes.setAttribute("type","html")}
return oRes},id:function(oNode){return oNode.selectSingleNode("atom:id")||oNode.selectSingleNode("guid")||oNode.selectSingleNode("link")},tags:function(oNode){return oNode.selectNodes("atom:category/@label|atom:category[not(@label)]/@term|category")},url:function(oNode){return oNode.selectSingleNode('atom:link[@rel="alternate" and (not(@type) or @type="text/html")]/@href|link[not(@rel) and not(@href)]|guid[not(@isPermaLink="false")]')},parentId:function(oNode){return oNode.selectSingleNode("cmp:parent/atom:id")},parentTitle:function(oNode){return oNode.selectSingleNode("cmp:parent/atom:title")},subposts:function(oNode){return oNode.selectSingleNode('atom:link[@rel="replies"]/@thr:count')||oNode.selectSingleNode('slash:comments')},rating:function(oNode){return oNode.selectSingleNode("cmp:rating")||oNode.selectSingleNode("gd:rating")},count:function(oNode){return oNode.selectSingleNode("cmp:count")}}
FeedRender.VAR_PREFIX="feed "
FeedRender.VAR_PREFIX_LEN=FeedRender.VAR_PREFIX.length}