
function Notice(oEl){if(oEl){var sNotice=oEl.getAttribute("items")
if(sNotice)aNotices=sNotice.split("\3")
this.el=oEl
this.hide()}}
Notice.prototype.show=function(iIndex){var oEl=this.el
if(oEl&&aNotices&&aNotices[iIndex]){if(oEl.getAttribute("curDisp")!==null)oEl.style.display=oEl.getAttribute("curDisp")
oEl.innerText=aNotices[iIndex]}}
Notice.prototype.hide=function(){var oEl=this.el
if(oEl&&oEl.style.display!="none"){oEl.setAttribute("curDisp",oEl.style.display)
oEl.style.display="none"}}